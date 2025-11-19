<?php

namespace App\Http\Controllers;

use App\Models\Bid;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\AutoBidController;
use App\Notifications\NewBidNotification;
use Illuminate\Support\Facades\DB as FacadeDB;
use Carbon\Carbon;   // ✅ IMPORTANT (tu avais oublié)

class BidController extends Controller
{
    // Liste des enchères pour un produit (AJAX)
    public function index(Product $product){
        $bids = Bid::with('user')
            ->where('product_id', $product->id)
            ->orderByDesc('amount')
            ->get();
        return response()->json($bids);
    }

    // Placer une enchère
    public function store(Request $request, Product $product)
    {
        $request->validate(['amount'=>'required|numeric|min:0']);
        $userId = auth()->id();

        // Vérifier montant minimal
        $lastBid = $product->bids()->orderByDesc('amount')->first();
        $currentAmount = $lastBid ? $lastBid->amount : $product->starting_price;

        if ($request->amount <= $currentAmount) {
            return response()->json([
                'message'=>"Votre enchère doit dépasser le dernier montant : ".number_format($currentAmount+1,0,',',' ')." Ar"
            ],422);
        }

        // 🟢 1) Créer l'enchère + mettre à jour produit dans une transaction atomique
        \DB::transaction(function () use ($request, $product, $userId) {

            // Verrouiller la ligne du produit
            $lockedProduct = Product::where('id', $product->id)->lockForUpdate()->first();

            // Créer la bid
            Bid::create([
                'user_id' => $userId,
                'product_id' => $lockedProduct->id,
                'amount' => $request->amount
            ]);

            // Mettre à jour le dernier enchérisseur
            $lockedProduct->last_bid_user_id = $userId;
            $lockedProduct->save();
        });

        // 🟢 2) Après commit → recharger le produit
        $product = $product->fresh();

        // 🟢 3) Calcul correct entre maintenant et end_time
        $now = now();
        $end = Carbon::parse($product->end_time);

        $remainingSeconds = $end->diffInSeconds($now, false);

        \Log::info("DIFF CHECK: now={$now}, end={$end}, remaining={$remainingSeconds}");

        if ($remainingSeconds <= 300 && $remainingSeconds > 0) {

            // Mise à jour atomique SQL
            FacadeDB::table('products')
                ->where('id', $product->id)
                ->update([
                    'end_time' => FacadeDB::raw("DATE_ADD(end_time, INTERVAL 5 MINUTE)")
                ]);

            $product = $product->fresh();
            \Log::info("EXTENDED +5: new_end_time={$product->end_time}");
        }

        // 🟢 4) Exécuter auto-bids après extension
        AutoBidController::processAutoBids($product);

        // 🔔 5) notifier tous les anciens enchérisseurs
        $previousBidders = \App\Models\User::whereIn('id',
            \App\Models\Bid::where('product_id', $product->id)
                ->where('user_id', '!=', $userId)
                ->pluck('user_id')
                ->unique()
        )->get();

        foreach ($previousBidders as $user) {
            $user->notify(new NewBidNotification($product, $request->amount, auth()->user()->pseudo));
        }

        // 🟢 6) Retour
        $bids = $product->bids()->with('user')->orderByDesc('amount')->get();

        return response()->json([
            'message' => '✅ Enchère placée avec succès !',
            'bids' => $bids
        ]);
    }

    public function filter(Request $request)
    {
        $query = Bid::with(['user','product'])->orderByDesc('created_at');

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
