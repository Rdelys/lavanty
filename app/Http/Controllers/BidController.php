<?php

namespace App\Http\Controllers;

use App\Models\Bid;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\AutoBidController;
use App\Notifications\NewBidNotification;
use Illuminate\Support\Facades\DB as FacadeDB;
use Carbon\Carbon;

class BidController extends Controller
{
    public function index(Product $product)
    {
        $bids = Bid::with('user')
            ->where('product_id', $product->id)
            ->orderByDesc('amount')
            ->get();

        return response()->json($bids);
    }

    public function store(Request $request, Product $product)
    {
        $request->validate(['amount' => 'required|numeric|min:0']);
        $userId = auth()->id();

        // Vérifier montant minimal
        $lastBid = $product->bids()->orderByDesc('amount')->first();
        $currentAmount = $lastBid ? $lastBid->amount : $product->starting_price;

        if ($request->amount <= $currentAmount) {
            return response()->json([
                'message' => "Votre enchère doit dépasser le dernier montant : " . number_format($currentAmount + 1, 0, ',', ' ') . " Ar"
            ], 422);
        }

        // 🔒 Transaction + verrouillage
        \DB::transaction(function () use ($request, $product, $userId) {

            $lockedProduct = Product::where('id', $product->id)->lockForUpdate()->first();

            Bid::create([
                'user_id'    => $userId,
                'product_id' => $lockedProduct->id,
                'amount'     => $request->amount
            ]);

            $lockedProduct->last_bid_user_id = $userId;
            $lockedProduct->save();
        });

        // Rafraîchir produit
        $product = $product->fresh();

        // 🟢 LIRE LA DATE SQL SANS CONVERSION (FIX ULTRA IMPORTANT)
        $rawEnd = $product->getRawOriginal('end_time');   // YYYY-mm-dd HH:ii:ss EXACT SQL
        $end = Carbon::createFromFormat('Y-m-d H:i:s', $rawEnd);

        $now = now(); // GMT+3 réel
        $remainingSeconds = $end->diffInSeconds($now, false);

        \Log::info("DIFF CHECK FIX: NOW={$now}, RAW_END={$end}, REMAINS={$remainingSeconds}");

        // 🟢 SI end_time <= 5 minutes OU DÉJÀ PASSÉ → ajouter +5 minutes
        if ($remainingSeconds <= 300) {

            // Si déjà expiré → repartir sur maintenant + 5 min
            if ($remainingSeconds < 0) {
                FacadeDB::table('products')
                    ->where('id', $product->id)
                    ->update([
                        'end_time' => $now->addMinutes(5)
                    ]);

                \Log::info("EXTENSION RESTART (expired): new_end_time=" . $now);
            }

            // Sinon → prolonger normal
            else {
                FacadeDB::table('products')
                    ->where('id', $product->id)
                    ->update([
                        'end_time' => FacadeDB::raw("DATE_ADD(end_time, INTERVAL 5 MINUTE)")
                    ]);

                \Log::info("EXTENSION +5 MIN: OK");
            }

            // Recharger après extension
            $product = $product->fresh();
        }

        // Auto-bids
        AutoBidController::processAutoBids($product);

        // Notifications
        $previousBidders = \App\Models\User::whereIn(
            'id',
            \App\Models\Bid::where('product_id', $product->id)
                ->where('user_id', '!=', $userId)
                ->pluck('user_id')
                ->unique()
        )->get();

        foreach ($previousBidders as $user) {
            $user->notify(new NewBidNotification(
                $product,
                $request->amount,
                auth()->user()->pseudo
            ));
        }

        // Retour AJAX
        $bids = $product->bids()->with('user')->orderByDesc('amount')->get();

        return response()->json([
            'message' => '✅ Enchère placée avec succès !',
            'bids'    => $bids
        ]);
    }

    public function filter(Request $request)
    {
        $query = Bid::with(['user', 'product'])->orderByDesc('created_at');

        if ($request->client) {
            $query->where('user_id', $request->client);
        }

        if ($request->produit) {
            $query->where('product_id', $request->produit);
        }

        $bids = $query->take(30)->get();
        return response()->json($bids);
    }
}
