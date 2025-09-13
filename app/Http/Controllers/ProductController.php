<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->get();
        return view('admin.dashboard', compact('products'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
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
    return response()->json($product);
}


    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
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

        return redirect()->route('products.index')->with('success', 'Produit mis à jour.');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Produit supprimé.');
    }

    public function toggleMiseEnVente(Product $product)
{
    $product->mise_en_vente = !$product->mise_en_vente;
    $product->save();

    return response()->json(['success' => true, 'mise_en_vente' => $product->mise_en_vente]);
}

}

