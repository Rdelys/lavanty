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
}
