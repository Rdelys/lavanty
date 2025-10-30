<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bid;

class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $bids = Bid::with('product')
                    ->where('user_id', $user->id)
                    ->orderByDesc('created_at')
                    ->get();

        return view('profile', compact('user', 'bids'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenoms' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'telephone' => 'required|string|max:20',
        ]);

        $user->update($validated);

        return back()->with('success', '✅ Profil mis à jour avec succès.');
    }
}
