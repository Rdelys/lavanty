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
        // Boucle itérative (évite récursivité profonde)
        $increment = 50000;

        while (true) {
            $lastBid = $product->bids()->orderByDesc('amount')->first();
            $currentAmount = $lastBid ? $lastBid->amount : $product->starting_price;
            $lastBidUserId = $lastBid ? $lastBid->user_id : null;

            // Chercher les auto-bids valides (max_price > currentAmount) et pas du même utilisateur que lastBid
            $autoBids = AutoBid::where('product_id', $product->id)
                        ->where('max_price', '>', $currentAmount)
                        ->orderByDesc('max_price') // optional: prioriser le plus haut max
                        ->get();

            if ($autoBids->isEmpty()) {
                break;
            }

            $placedAny = false;

            foreach ($autoBids as $auto) {
                // Si le propriétaire de l'auto-bid est déjà le dernier enchérisseur, on skip
                if ($lastBidUserId && $lastBidUserId === $auto->user_id) {
                    continue;
                }

                // Calcul montant proposé
                $proposed = $currentAmount + $increment;
                if ($proposed > $auto->max_price) {
                    $proposed = $auto->max_price;
                }

                // Si le proposé ne dépasse pas le montant courant (sécurité), skip
                if ($proposed <= $currentAmount) {
                    // si son max est <= currentAmount, supprimer son auto-bid (max atteint)
                    if ($auto->max_price <= $currentAmount) {
                        $auto->delete();
                    }
                    continue;
                }

                // Créer l'enchère
                Bid::create([
                    'user_id' => $auto->user_id,
                    'product_id' => $product->id,
                    'amount' => $proposed
                ]);

                // Mettre à jour le produit
                $product->last_bid_user_id = $auto->user_id;
                $remaining = $product->end_time->diffInSeconds(now());
                if ($remaining <= 300) {
                    $product->end_time = $product->end_time->addMinutes(5);
                }
                $product->save();

                // Mettre à jour currentAmount et lastBidUserId pour la prochaine itération
                $currentAmount = $proposed;
                $lastBidUserId = $auto->user_id;

                $placedAny = true;

                // Si l'auto-bid a atteint son max (=> égal au proposé), on peut le supprimer
                if ($auto->max_price <= $proposed) {
                    $auto->delete();
                }

                // On continue la boucle while pour vérifier s'il existe un autre auto-bid capable de surenchérir
                break; // sortir foreach pour re-calculer la liste avec le nouveau currentAmount
            }

            if (! $placedAny) {
                // Aucun auto-bid n'a placé d'enchère => sortir
                break;
            }
        }
    }
}
