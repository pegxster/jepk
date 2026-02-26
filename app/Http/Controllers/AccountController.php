<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function index()
    {
        return view('account.index');
    }

    public function orders()
    {
        return view('account.index');
    }

    public function orderDetail($order)
    {
        return view('account.index');
    }

    public function invoice($order)
    {
        return back();
    }

    public function profile()
    {
        return view('account.profile');
    }

    public function profileUpdate(Request $request)
    {
        return back()->with('success', 'Profil mis à jour !');
    }

    public function passwordUpdate(Request $request)
    {
        return back()->with('success', 'Mot de passe modifié !');
    }

    public function addresses()
    {
        return view('account.index');
    }

    public function addressStore(Request $request)
    {
        return back()->with('success', 'Adresse ajoutée !');
    }

    public function addressUpdate(Request $request, $address)
    {
        return back()->with('success', 'Adresse modifiée !');
    }

    public function addressDestroy($address)
    {
        return back()->with('success', 'Adresse supprimée.');
    }

    public function addressDefault($address)
    {
        return back()->with('success', 'Adresse par défaut mise à jour !');
    }

    public function notifications()
    {
        return view('account.index');
    }

    public function markRead(Request $request)
    {
        return back();
    }
}