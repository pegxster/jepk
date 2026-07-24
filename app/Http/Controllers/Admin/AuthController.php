<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function loginForm()
    {
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');
        $remember    = $request->boolean('remember');

        if (!Auth::guard('admin')->attempt($credentials, $remember)) {
            return back()
                ->withErrors(['email' => 'Email ou mot de passe incorrect.'])
                ->withInput();
        }

        // Vérifier que l'utilisateur authentifié est bien admin
        $user = User::where('email', $request->email)->first();

        if (!$user || !$user->is_admin) {
            Auth::guard('admin')->logout();
            return back()
                ->withErrors(['email' => 'Ce compte n\'a pas les droits administrateur.'])
                ->withInput();
        }

        $request->session()->regenerate();
        return redirect()->route('admin.dashboard');
    }

    public function logout(Request $request)
    {
        // Déconnecte le guard admin UNIQUEMENT — le client reste connecté
        Auth::guard('admin')->logout();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login');
    }
}
