<?php

namespace App\Http\Controllers;

use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        Product::checkExpiredAuctions(); // ✅ vérifier avant d’afficher

        $products = Product::where('mise_en_vente', 1)
            ->where('end_time', '>', now())
            ->latest()
            ->take(3)
            ->get();

        return view('welcome', compact('products'));
    }


    public function products()
    {
        Product::checkExpiredAuctions(); // ✅

        $products = Product::where('mise_en_vente', 1)
            ->where('end_time', '>', now())
            ->latest()
            ->get();

        return view('products', compact('products'));
    }


    public function productDetail($id)
    {
        Product::checkExpiredAuctions(); // ✅

        $product = Product::findOrFail($id);

        $images = $product->images 
            ? (is_array($product->images) ? $product->images : json_decode($product->images, true)) 
            : [];

        return view('product-detail', compact('product', 'images'));
    }

}
