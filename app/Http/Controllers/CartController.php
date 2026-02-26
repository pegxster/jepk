<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        return view('cart.index');
    }

    public function add(Request $request)
    {
        return back()->with('success', 'Produit ajouté au panier !');
    }

    public function update(Request $request)
    {
        return back();
    }

    public function remove(Request $request)
    {
        return back()->with('success', 'Article retiré.');
    }

    public function clear()
    {
        return back()->with('success', 'Panier vidé.');
    }

    public function applyPromo(Request $request)
    {
        return back();
    }

    public function mini()
    {
        return response()->json(['count' => 0, 'cart' => []]);
    }

    public function addAll()
    {
        return back();
    }
}