<?php

namespace App\Http\Controllers;

use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        // On prend uniquement les 3 produits les plus récents
        $products = Product::latest()->take(3)->get();

        return view('welcome', compact('products'));
    }

    public function products()
{
    // Récupérer tous les produits en ordre du plus récent au plus ancien
    $products = Product::latest()->get();
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
