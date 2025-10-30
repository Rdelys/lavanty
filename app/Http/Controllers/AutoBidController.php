<?php
namespace App\Http\Controllers;

use App\Models\AutoBid;
use App\Models\Bid;
use App\Models\Product;
use Illuminate\Http\Request;

class AutoBidController extends Controller
{
    public function store(Request $request, Product $product)
    {
        $request->validate([
            'max_price' => 'required|numeric|min:0'
        ]);

        $autoBid = AutoBid::updateOrCreate(
            ['user_id' => auth()->id(), 'product_id' => $product->id],
            ['max_price' => $request->max_price]
        );

        return response()->json(['message' => '✅ Enchère automatique définie avec succès !']);
    }

    // Logique pour vérifier et appliquer les auto-bids
    public static function processAutoBids(Product $product)
    {
        $lastBid = $product->bids()->orderByDesc('amount')->first();
        $currentAmount = $lastBid ? $lastBid->amount : $product->starting_price;

        // Chercher tous les auto-bids valides
        $autoBids = AutoBid::where('product_id', $product->id)
            ->where('max_price', '>', $currentAmount)
            ->get();

        foreach ($autoBids as $auto) {
            if ($lastBid && $lastBid->user_id === $auto->user_id) continue;

            $newAmount = $currentAmount + 1000;

            if ($newAmount <= $auto->max_price) {
                // Après chaque création d’enchère automatique :
                $bid = Bid::create([
                    'user_id' => $auto->user_id,
                    'product_id' => $product->id,
                    'amount' => $newAmount
                ]);

                $product->update(['last_bid_user_id' => $auto->user_id]);

                // 🔥 Vérifier si on est dans les 5 dernières minutes
                if ($product->end_time->diffInSeconds(now(), false) * -1 <= 300) {
                    $product->end_time = $product->end_time->addMinutes(5);
                    $product->save();
                }

                $currentAmount = $newAmount;

                // relancer récursivement pour traiter la compétition
                return self::processAutoBids($product);
            } else {
                // max atteint -> suppression
                $auto->delete();
            }
        }
    }
}
