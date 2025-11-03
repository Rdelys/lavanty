<?php
namespace App\Http\Controllers;

use App\Models\AutoBid;
use App\Models\Bid;
use App\Models\Product;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use App\Jobs\ProcessAutoBidJob;

class AutoBidController extends Controller
{
    // Enregistre/Met à jour l'auto-bid et tente de placer une enchère immédiatement si nécessaire
    public function store(Request $request, Product $product)
    {
        $request->validate([
            'max_price' => 'required|numeric|min:0'
        ]);

        $userId = auth()->id();

        // Create or update auto-bid
        $autoBid = AutoBid::updateOrCreate(
            ['user_id' => $userId, 'product_id' => $product->id],
            ['max_price' => $request->max_price]
        );

        // Tenter de placer une enchère immédiatement si nécessaire
        // Récupérer le dernier montant et le dernier enchérisseur
        $lastBid = $product->bids()->orderByDesc('amount')->first();
        $currentAmount = $lastBid ? $lastBid->amount : $product->starting_price;
        $lastBidUserId = $lastBid ? $lastBid->user_id : null;

        // Si le nouvel auto-bid peut surenchérir (et que ce n'est pas déjà lui le dernier enchérisseur)
        if ($autoBid->max_price > $currentAmount && $lastBidUserId !== $userId) {
            // Calculer montant proposé (incrément)
            $increment = 50000; // garder le même incrément que le reste du système
            $newAmount = $currentAmount + $increment;

            // Ne pas dépasser le max de l'utilisateur
            if ($newAmount > $autoBid->max_price) {
                $newAmount = $autoBid->max_price;
            }

            // Création de l'enchère dans une transaction pour éviter race conditions
            DB::transaction(function () use ($product, $userId, $newAmount, $autoBid) {
                $bid = Bid::create([
                    'user_id'    => $userId,
                    'product_id' => $product->id,
                    'amount'     => $newAmount
                ]);

                // Mettre à jour dernier enchérisseur
                $product->last_bid_user_id = $userId;

                // Extension du temps si dans les dernières 5 minutes
                $remaining = $product->end_time->diffInSeconds(now());
                if ($remaining <= 300) {
                    $product->end_time = $product->end_time->addMinutes(5);
                }

                $product->save();
            });

            // Après la création on relance le traitement global des auto-bids pour gérer la compétition
            self::processAutoBids($product);
        }

        return response()->json(['message' => '✅ Enchère automatique définie avec succès !']);
    }

    // Logique pour vérifier et appliquer les auto-bids (améliorée)

public static function processAutoBids(Product $product)
{
    $increment = 50000;

    while (true) {
        $lastBid = $product->bids()->orderByDesc('amount')->first();
        $currentAmount = $lastBid ? $lastBid->amount : $product->starting_price;
        $lastBidUserId = $lastBid ? $lastBid->user_id : null;

        $autoBids = \App\Models\AutoBid::where('product_id', $product->id)
                    ->where('max_price', '>', $currentAmount)
                    ->orderByDesc('max_price')
                    ->get();

        if ($autoBids->isEmpty()) {
            break;
        }

        $placedAny = false;

        foreach ($autoBids as $auto) {
            if ($lastBidUserId && $lastBidUserId === $auto->user_id) {
                continue;
            }

            $proposed = $currentAmount + $increment;
            if ($proposed > $auto->max_price) {
                $proposed = $auto->max_price;
            }

            if ($proposed <= $currentAmount) {
                if ($auto->max_price <= $currentAmount) {
                    $auto->delete();
                }
                continue;
            }

            /**
             * 🕒 Planifier l’enchère automatique après 3 secondes
             */
            ProcessAutoBidJob::dispatch($auto, $product->id, $proposed)
                ->delay(now()->addSeconds(3));

            // Mettre à jour le produit immédiatement pour que le système suive l’état
            $product->last_bid_user_id = $auto->user_id;
            $product->save();

            if ($auto->max_price <= $proposed) {
                $auto->delete();
            }

            $placedAny = true;
            break;
        }

        if (! $placedAny) {
            break;
        }
    }
}

}
