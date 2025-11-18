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
        $lastBid = $product->bids()->orderByDesc('amount')->first();
        $currentAmount = $lastBid ? $lastBid->amount : $product->starting_price;
        $lastBidUserId = $lastBid ? $lastBid->user_id : null;

        // Si le nouvel auto-bid peut surenchérir (et que ce n'est pas déjà lui le dernier enchérisseur)
        if ($autoBid->max_price > $currentAmount && $lastBidUserId !== $userId) {

            // ⏳ Attente de 3 secondes avant de placer l'enchère
            sleep(3);

            // Calculer montant proposé (incrément)
            $increment = 50000;
            $newAmount = $currentAmount + $increment;

            if ($newAmount > $autoBid->max_price) {
                $newAmount = $autoBid->max_price;
            }

            // Création de l'enchère dans une transaction
            DB::transaction(function () use ($product, $userId, $newAmount, $autoBid) {
                Bid::create([
                    'user_id'    => $userId,
                    'product_id' => $product->id,
                    'amount'     => $newAmount
                ]);

                $product->last_bid_user_id = $userId;

                $remaining = $product->end_time->diffInSeconds(now());
                if ($remaining <= 300) {
                    $product->end_time = $product->end_time->addMinutes(5);
                }

                $product->save();
            });

            // Relancer la gestion des auto-bids
            self::processAutoBids($product);
        }

        return response()->json(['message' => '✅ Enchère automatique définie avec succès !']);
    }

    // Logique pour vérifier et appliquer les auto-bids
    public static function processAutoBids(Product $product)
    {
        $increment = 50000;

        while (true) {
            $lastBid = $product->bids()->orderByDesc('amount')->first();
            $currentAmount = $lastBid ? $lastBid->amount : $product->starting_price;
            $lastBidUserId = $lastBid ? $lastBid->user_id : null;

            $autoBids = AutoBid::where('product_id', $product->id)
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

                Bid::create([
                    'user_id' => $auto->user_id,
                    'product_id' => $product->id,
                    'amount' => $proposed
                ]);

                $product->last_bid_user_id = $auto->user_id;

                $remaining = $product->end_time->diffInSeconds(now());
                if ($remaining <= 300) {
                    $product->end_time = $product->end_time->addMinutes(5);
                }
                $product->save();

                $currentAmount = $proposed;
                $lastBidUserId = $auto->user_id;

                $placedAny = true;

                if ($auto->max_price <= $proposed) {
                    $auto->delete();
                }

                break;
            }

            if (! $placedAny) {
                break;
            }
        }
    }
}
