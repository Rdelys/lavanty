<?php

namespace App\Http\Controllers;

use App\Models\Bid;
use App\Models\Product;
use Illuminate\Http\Request;

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
    public function store(Request $request, Product $product){
        $request->validate(['amount'=>'required|numeric|min:0']);
        $userId = auth()->id();

        $lastBid = $product->bids()->orderByDesc('amount')->first();
        $currentAmount = $lastBid ? $lastBid->amount : $product->starting_price;

        if($request->amount <= $currentAmount){
            return response()->json([
                'message'=>"Votre enchère doit dépasser le dernier montant : ".number_format($currentAmount+1,0,',',' ')." Ar"
            ],422);
        }

        $bid = Bid::create([
            'user_id'=>$userId,
            'product_id'=>$product->id,
            'amount'=>$request->amount
        ]);
        $bid->load('user');

        return response()->json([
            'message'=>'✅ Enchère placée avec succès !',
            'bids'=>$product->bids()->with('user')->orderByDesc('amount')->get()
        ]);
    }
}
