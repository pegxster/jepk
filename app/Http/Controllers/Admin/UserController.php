<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // ── Clients (inscrits sur le site) ──────────────────────────────────────

    public function index(Request $request)
    {
        $query = User::where('is_admin', '!=', true)->orderBy('created_at', 'desc');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name',  'like', '%' . $search . '%')
                  ->orWhere('email', 'like', '%' . $search . '%')
                  ->orWhere('prenom', 'like', '%' . $search . '%')
                  ->orWhere('nom',   'like', '%' . $search . '%');
            });
        }

        $clients = $query->paginate(15)->withQueryString();

        return view('admin.users.index', compact('clients'));
    }

    public function destroy(User $user)
    {
        if ($user->is_admin) {
            return back()->with('error', 'Utilisez la page Équipe pour gérer les administrateurs.');
        }

        $user->delete();

        return back()->with('success', 'Compte client supprimé.');
    }

    // ── Équipe admin ─────────────────────────────────────────────────────────

    public function team()
    {
        $team = User::where('is_admin', true)->orderBy('created_at', 'asc')->get();

        return view('admin.users.team', compact('team'));
    }

    public function teamStore(Request $request)
    {
        $request->validate([
            'prenom'   => 'required|string|max:100',
            'nom'      => 'required|string|max:100',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ], [
            'email.unique'       => 'Cet email est déjà utilisé.',
            'password.min'       => 'Le mot de passe doit comporter au moins 8 caractères.',
            'password.confirmed' => 'Les mots de passe ne correspondent pas.',
        ]);

        User::create([
            'name'           => $request->prenom . ' ' . $request->nom,
            'prenom'         => $request->prenom,
            'nom'            => $request->nom,
            'email'          => $request->email,
            'password'       => $request->password,
            'is_admin'       => true,
            'newsletter'     => false,
            'loyalty_points' => 0,
            'addresses'      => [],
            'wishlist'       => [],
        ]);

        return back()->with('success', 'Accès administrateur créé pour ' . $request->prenom . ' ' . $request->nom . '.');
    }

    public function teamDestroy(User $user)
    {
        if ((string) $user->_id === (string) Auth::id()) {
            return back()->with('error', 'Vous ne pouvez pas supprimer votre propre compte.');
        }

        if (!$user->is_admin) {
            return back()->with('error', 'Cet utilisateur n\'est pas un administrateur.');
        }

        $user->delete();

        return back()->with('success', 'Accès administrateur révoqué.');
    }
}
