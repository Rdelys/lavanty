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
                'message' => "Votre enchère doit dépasser le dernier montant : "
                    . number_format($currentAmount + 1, 0, ',', ' ') . " Ar"
            ], 422);
        }

        // 🔒 Transaction + verrouillage
        \DB::transaction(function () use ($request, $product, $userId) {

            $lockedProduct = Product::where('id', $product->id)
                ->lockForUpdate()
                ->first();

            Bid::create([
                'user_id'    => $userId,
                'product_id' => $lockedProduct->id,
                'amount'     => $request->amount
            ]);

            $lockedProduct->last_bid_user_id = $userId;
            $lockedProduct->save();
        });

        // Rafraîchir produit après transaction
        $product = $product->fresh();

        // ---------------------------------------------
        // 📌 Calcul FIABLE du temps restant (MySQL)
        // ---------------------------------------------
        $remainingSeconds = FacadeDB::selectOne("
            SELECT TIMESTAMPDIFF(SECOND, NOW(), end_time) AS diff
            FROM products
            WHERE id = ?
        ", [$product->id])->diff;

        \Log::info("MYSQL REMAINING = {$remainingSeconds} seconds for product {$product->id}");

        // ---------------------------------------------
        // 📌 Ajouter +5 minutes SI (≤ 5 minutes restantes)
        // ---------------------------------------------
        if ($remainingSeconds <= 300) {

            FacadeDB::table('products')
                ->where('id', $product->id)
                ->update([
                    'end_time' => FacadeDB::raw("DATE_ADD(end_time, INTERVAL 5 MINUTE)")
                ]);

            $product = $product->fresh();

            \Log::info("EXTENDED +5 MINUTES: NEW END TIME = {$product->end_time}");
        }

        // Traitement des auto-bids
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

        // Retour
        $bids = $product->bids()
            ->with('user')
            ->orderByDesc('amount')
            ->get();

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

        return response()->json($query->take(30)->get());
    }
}
