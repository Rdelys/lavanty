<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    public function showLogin()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors([
            'email' => 'Identifiants incorrects.',
        ]);
    }

    public function logout(Request $request)
{
    Auth::guard('admin')->logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('admin.login');
}

}

