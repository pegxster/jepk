<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function index()
    {
        return view('account.wishlist');
    }

    public function add(Request $request)
    {
        return back()->with('success', 'Ajouté à votre wishlist ♡');
    }

    public function remove(Request $request, $id = null)
    {
        return back()->with('success', 'Retiré de votre wishlist.');
    }

    public function toggle(Request $request)
    {
        return back();
    }
}