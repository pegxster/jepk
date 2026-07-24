<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function loginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            $request->session()->regenerate();

            if (Auth::user()->isAdmin()) {
                return redirect()->route('admin.dashboard');
            }

            return redirect()->intended(route('account.index'));
        }

        return back()->withErrors(['email' => 'Email ou mot de passe incorrect.'])->withInput();
    }

    public function registerForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'prenom'    => 'required|string|max:100',
            'nom'       => 'required|string|max:100',
            'email'     => 'required|email|unique:users,email',
            'telephone' => 'nullable|string|max:20',
            'password'  => 'required|string|min:8|confirmed',
            'cgu'       => 'accepted',
        ], [
            'prenom.required'    => 'Le prénom est obligatoire.',
            'nom.required'       => 'Le nom est obligatoire.',
            'email.required'     => 'L\'email est obligatoire.',
            'email.unique'       => 'Cet email est déjà utilisé.',
            'password.min'       => 'Le mot de passe doit comporter au moins 8 caractères.',
            'password.confirmed' => 'Les mots de passe ne correspondent pas.',
            'cgu.accepted'       => 'Vous devez accepter les CGV.',
        ]);

        $user = User::create([
            'name'           => $request->prenom . ' ' . $request->nom,
            'prenom'         => $request->prenom,
            'nom'            => $request->nom,
            'email'          => $request->email,
            'telephone'      => $request->telephone,
            'password'       => $request->password,
            'newsletter'     => $request->boolean('newsletter'),
            'is_admin'       => false,
            'loyalty_points' => 0,
            'addresses'      => [],
            'wishlist'       => [],
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('account.index')
            ->with('success', 'Bienvenue ' . $request->prenom . ' ! Votre compte a été créé avec succès.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect(route('home'));
    }

    public function forgotForm()
    {
        return view('auth.forgot');
    }

    public function forgotSend(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $user = User::where('email', $request->email)->first();

        if ($user) {
            $token = Str::random(64);
            $user->update(['reset_token' => $token, 'reset_token_at' => now()]);
        }

        return back()->with('status', 'Si cet email existe, un lien de réinitialisation vous a été envoyé.');
    }

    public function resetForm(Request $request, $token)
    {
        $user = User::where('reset_token', $token)
            ->where('reset_token_at', '>=', now()->subHours(2))
            ->first();

        if (!$user) {
            return redirect()->route('auth.forgot')
                ->with('error', 'Ce lien de réinitialisation est invalide ou a expiré.');
        }

        return view('auth.reset', ['token' => $token, 'email' => $user->email]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token'    => 'required|string',
            'email'    => 'required|email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::where('email', $request->email)
            ->where('reset_token', $request->token)
            ->where('reset_token_at', '>=', now()->subHours(2))
            ->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Lien de réinitialisation invalide ou expiré.']);
        }

        $user->update([
            'password'      => $request->password,
            'reset_token'   => null,
            'reset_token_at'=> null,
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('account.index')
            ->with('success', 'Votre mot de passe a été réinitialisé avec succès !');
    }

    public function socialRedirect($provider)
    {
        return back()->with('info', 'Connexion sociale bientôt disponible.');
    }

    public function socialCallback($provider)
    {
        return back()->with('info', 'Connexion sociale bientôt disponible.');
    }
}
