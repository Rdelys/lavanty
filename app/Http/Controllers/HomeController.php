<?php

namespace App\Http\Controllers;

use App\Models\Product;

class HomeController extends Controller
{
    public function index()
{
    $products = Product::where('mise_en_vente', 1)
        ->latest()
        ->take(3)
        ->get();

    return view('welcome', compact('products'));
}

    public function products()
{
    // récupérer uniquement les produits en vente
    $products = Product::where('mise_en_vente', 1)
        ->latest()
        ->get();

    return view('products', compact('products'));
}


public function productDetail($id)
{
    $product = Product::findOrFail($id);

    // si ton champ images est un JSON, on le décode en tableau
    $images = $product->images ? (is_array($product->images) ? $product->images : json_decode($product->images, true)) : [];

    return view('product-detail', compact('product', 'images'));
}

}
