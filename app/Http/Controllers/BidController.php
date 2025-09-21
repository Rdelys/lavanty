<?php

namespace App\Http\Controllers;

use App\Models\Bid;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BidController extends Controller
{
    // Liste des enchères pour un produit (AJAX)
    public function index(Product $product)
    {
        $bids = Bid::with('user')
            ->where('product_id', $product->id)
            ->orderByDesc('amount') // ordre décroissant pour montrer la plus haute en premier
            ->get();

        return response()->json($bids);
    }

    // Placer une enchère
    public function store(Request $request, Product $product)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0',
        ]);

        // Dernière enchère
        $lastBid = $product->bids()->orderByDesc('amount')->first();
        $minAmount = $lastBid ? $lastBid->amount + 1 : $product->starting_price;

        if ($request->amount < $minAmount) {
            return response()->json([
                'message' => "Votre enchère doit dépasser le dernier montant : ".number_format($minAmount, 0, ',', ' ')." Ar"
            ], 422);
        }

        $bid = Bid::create([
            'user_id' => Auth::id(),
            'product_id' => $product->id,
            'amount' => $request->amount,
        ]);

        $bid->load('user');

        return response()->json($bid);
    }
}
