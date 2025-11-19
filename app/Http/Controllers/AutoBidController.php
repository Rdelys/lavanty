<?php

namespace App\Http\Controllers;

use App\Models\AutoBid;
use App\Models\Bid;
use App\Models\Product;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;

class AutoBidController extends Controller
{
    /**
     * 🔁 Logique ANTI-SNIPE utilisée partout
     * → Si expiré → restart 5 min
     * → Si <= 5 minutes → remettre à 5 minutes EXACT
     */
    private static function applyAntiSnipe(Product $product)
    {
        $rawEnd = $product->getRawOriginal('end_time');
        $end = Carbon::createFromFormat('Y-m-d H:i:s', $rawEnd);
        $now = now();

        $remaining = $end->diffInSeconds($now, false);

        // Déjà expiré ⇒ restart
        if ($remaining < 0) {
            $product->end_time = $now->clone()->addMinutes(5);
            $product->save();

            \Log::info("AUTO-BID: Restart to 5min (expired)");
            return;
        }

        // Si ≤ 5 minutes → remettre à EXACTEMENT 5 minutes restantes
        if ($remaining <= 300) {
            $product->end_time = $now->clone()->addMinutes(5);
            $product->save();

            \Log::info("AUTO-BID: Reset countdown to EXACT 5 minutes");
        }
    }

    /**
     * =============================
     *    ACTIVER / METTRE À JOUR AUTO-BID
     * =============================
     */
    public function store(Request $request, Product $product)
    {
        $request->validate([
            'max_price' => 'required|numeric|min:0'
        ]);

        $userId = auth()->id();

        // Create/update auto-bid
        $autoBid = AutoBid::updateOrCreate(
            ['user_id' => $userId, 'product_id' => $product->id],
            ['max_price' => $request->max_price]
        );

        // Infos actuelles
        $lastBid = $product->bids()->orderByDesc('amount')->first();
        $currentAmount = $lastBid ? $lastBid->amount : $product->starting_price;
        $lastBidUserId = $lastBid ? $lastBid->user_id : null;

        // Si l'utilisateur n'est pas déjà le dernier enchérisseur
        if ($autoBid->max_price > $currentAmount && $lastBidUserId !== $userId) {

            sleep(1); // petit délai optionnel

            $increment = 50000;
            $newAmount = min($currentAmount + $increment, $autoBid->max_price);

            // Transaction atomique
            DB::transaction(function () use ($product, $userId, $newAmount) {

                $lockedProduct = Product::where('id', $product->id)
                    ->lockForUpdate()
                    ->first();

                Bid::create([
                    'user_id' => $userId,
                    'product_id' => $lockedProduct->id,
                    'amount' => $newAmount
                ]);

                $lockedProduct->last_bid_user_id = $userId;
                $lockedProduct->save();
            });

            // Recharger le produit après transaction
            $product = $product->fresh();

            // 🟢 applique la même logique ANTI-SNIPE que BidController
            self::applyAntiSnipe($product);

            // Relancer auto-bids (en cascade si besoin)
            self::processAutoBids($product);
        }

        return response()->json(['message' => '✅ Enchère automatique définie avec succès !']);
    }


    /**
     * =============================
     *        EXECUTION AUTO-BIDS
     * =============================
     */
    public static function processAutoBids(Product $product)
    {
        $increment = 50000;

        while (true) {

            $lastBid = $product->bids()->orderByDesc('amount')->first();
            $currentAmount = $lastBid ? $lastBid->amount : $product->starting_price;
            $lastBidUserId = $lastBid ? $lastBid->user_id : null;

            // Chercher les auto-bids encore valides
            $autoBids = AutoBid::where('product_id', $product->id)
                ->where('max_price', '>', $currentAmount)
                ->orderByDesc('max_price')
                ->get();

            if ($autoBids->isEmpty()) {
                break;
            }

            $placed = false;

            foreach ($autoBids as $auto) {

                // Si c'est déjà lui le dernier → skip
                if ($lastBidUserId === $auto->user_id) {
                    continue;
                }

                $proposed = min($currentAmount + $increment, $auto->max_price);

                if ($proposed <= $currentAmount) {
                    if ($auto->max_price <= $currentAmount) {
                        $auto->delete();
                    }
                    continue;
                }

                // Placement auto
                Bid::create([
                    'user_id' => $auto->user_id,
                    'product_id' => $product->id,
                    'amount' => $proposed
                ]);

                $product->last_bid_user_id = $auto->user_id;
                $product->save();

                // 🟢 appliquer même logique anti-snipe
                self::applyAntiSnipe($product);

                $currentAmount = $proposed;
                $lastBidUserId = $auto->user_id;
                $placed = true;

                // Auto-bid atteint → supprimer
                if ($auto->max_price <= $proposed) {
                    $auto->delete();
                }

                break; // Ne placer qu'une enchère à la fois
            }

            if (! $placed) break;
        }
    }
}

