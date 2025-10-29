<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Afficher le modal login
    public function showLogin()
    {
        return view('auth.login'); // on peut laisser vide si modal
    }

    // Traiter la connexion
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/'); // redirige vers l'accueil
        }

        return back()->withErrors([
            'email' => 'Les informations fournies ne correspondent pas.',
        ]);
    }

    // Déconnexion
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    // Afficher le modal register
    public function showRegister()
    {
        return view('auth.register'); // modal
    }

    // Traiter l'inscription
    // Traiter l'inscription
public function register(Request $request)
{
    $data = $request->validate([
        'nom' => 'required|string|max:255',
        'prenoms' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'telephone' => 'required|string|max:20',
        'password' => 'required|string|confirmed|min:6',
    ]);

    // 🧮 Générer un pseudo automatique
    // Cherche le dernier pseudo existant
    $lastUser = User::where('pseudo', 'like', '#101%')
                    ->orderByDesc('id')
                    ->first();

    if ($lastUser && preg_match('/#(\d+)/', $lastUser->pseudo, $matches)) {
        $nextNumber = intval($matches[1]) + 1;
    } else {
        $nextNumber = 101000;
    }

    $pseudo = '#' . $nextNumber;

    // 🔐 Crée l'utilisateur avec le pseudo auto
    $user = User::create([
        'nom' => $data['nom'],
        'prenoms' => $data['prenoms'],
        'email' => $data['email'],
        'telephone' => $data['telephone'],
        'pseudo' => $pseudo,
        'password' => Hash::make($data['password']),
    ]);

    Auth::login($user);

    return redirect('/');
}

}
