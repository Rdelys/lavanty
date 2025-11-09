<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

        $productsAdjug = Product::latest()->get();

        return view('welcome', compact('products', 'productsAdjug'));
    }

    public function products(Request $request)
    {
        Product::checkExpiredAuctions(); // ✅

        // Liste autorisée des catégories (à garder synchronisée avec celles utilisées ailleurs)
        $allowedCategories = ['Mobilier', 'Voitures', 'Equipements', 'High tech'];

        // Récupère et nettoie le paramètre category
        $category = $request->query('category');
        if ($category && !in_array($category, $allowedCategories)) {
            // Si catégorie non reconnue, on ignore (ou tu peux retourner 404)
            $category = null;
        }

        // Query : si category présent, on filtre
        $products = Product::query()
            ->when($category, fn($q) => $q->where('category', $category))
            ->where('mise_en_vente', 1)
            ->where('end_time', '>', now())
            ->latest()
            ->get();

        // transmet aussi la liste des catégories pour le select
        $categories = $allowedCategories;

        return view('products', compact('products', 'category', 'categories'));
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
