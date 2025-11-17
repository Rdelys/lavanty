<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Bid;

class ProductController extends Controller
{
    public function index()
{
            Product::checkExpiredAuctions(); // ✅ vérifier avant d’afficher

    $products = Product::latest()->get();

    // Produits pris (adjugés)
    $productsPrises = Product::with('lastBidUser')
        ->where('status', 'adjugé')
        ->get();

    // Produits non pris (terminés sans enchères)
    $productsNonPrises = Product::where('status', 'terminé')
        ->whereNull('last_bid_user_id')
        ->get();

    // Produits vendus
    $productsVendus = Product::where('status', 'vendu')->get();
    $users = User::all();
    $bids = Bid::with(['user','product'])->get();

    return view('admin.dashboard', compact(
        'products',
        'productsPrises',
        'productsNonPrises',
        'productsVendus',
        'users',
        'bids'
    ));

}



    public function store(Request $request)
    {
                Product::checkExpiredAuctions(); // ✅ vérifier avant d’afficher

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|in:Mobilier,Voitures,Equipements,High tech',
            'description' => 'required',
            'starting_price' => 'required|numeric|min:0',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
            'status' => 'required|in:a_venir,en_cours,termine',
            'mise_en_vente' => 'nullable|boolean',
            'images.*' => 'image|mimes:jpg,jpeg,png|max:2048',
        ]);


        $data['mise_en_vente'] = $request->has('mise_en_vente');

        $images = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $images[] = $file->store('products', 'public');
            }
        }
        $data['images'] = $images;

        Product::create($data);

        return redirect()->route('products.index')->with('success', 'Produit ajouté avec succès.');
    }

    public function edit(Product $product)
{
            Product::checkExpiredAuctions(); // ✅ vérifier avant d’afficher

    return response()->json([
        'id' => $product->id,
        'title' => $product->title,
        'description' => $product->description,
        'category' => $product->category,
        'starting_price' => $product->starting_price,
        'start_time' => $product->start_time ? $product->start_time->format('Y-m-d\TH:i') : null,
        'end_time' => $product->end_time ? $product->end_time->format('Y-m-d\TH:i') : null,
        'status' => $product->status,
        'mise_en_vente' => (bool) $product->mise_en_vente,
    ]);
}



    public function update(Request $request, Product $product)
    {
                Product::checkExpiredAuctions(); // ✅ vérifier avant d’afficher

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|in:Mobilier,Voitures,Equipements,High tech',
            'description' => 'required',
            'starting_price' => 'required|numeric|min:0',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
            'status' => 'required|in:a_venir,en_cours,termine',
            'mise_en_vente' => 'nullable|boolean',
            'images.*' => 'image|mimes:jpg,jpeg,png|max:2048',
        ]);


        $data['mise_en_vente'] = $request->has('mise_en_vente');


        $images = $product->images ?? [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $images[] = $file->store('products', 'public');
            }
        }
        $data['images'] = $images;

        $product->update($data);

if ($request->wantsJson() || $request->ajax()) {
    return response()->json(['success' => true, 'product' => $product]);
}

return redirect()->route('admin.dashboard')->with('success', 'Produit mis à jour.');    }

    public function destroy(Product $product)
    {
                Product::checkExpiredAuctions(); // ✅ vérifier avant d’afficher

        $product->delete();
        return redirect()->route('products.index')->with('success', 'Produit supprimé.');
    }

    public function toggleMiseEnVente(Product $product)
{
            Product::checkExpiredAuctions(); // ✅ vérifier avant d’afficher

    $product->mise_en_vente = !$product->mise_en_vente;
    $product->save();

    return response()->json(['success' => true, 'mise_en_vente' => $product->mise_en_vente]);
}

public function shop(Request $request)
{
    Product::checkExpiredAuctions();

    // 🔎 Recherche
    $search = $request->search;

    // 📁 Filtre catégorie
    $category = $request->category;

    // 📦 Requête produits EN COURS UNIQUEMENT
    $products = Product::query()
        ->where('status', 'en_cours')        // ← ICI ON FILTRE
        ->when($search, fn($q) => $q->where('title', 'like', "%$search%"))
        ->when($category, fn($q) => $q->where('category', $category))
        ->latest()
        ->get();

    // 📊 Nombre total par catégorie (on compte tout, pas seulement en cours)
    $categoriesCount = Product::where('status', 'en_cours')
    ->select('category')
    ->selectRaw('COUNT(*) as total')
    ->groupBy('category')
    ->pluck('total', 'category');


return view('products', compact('products', 'categoriesCount'));
}


}

