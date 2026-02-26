<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        return view('pages.checkout');
    }

    public function process(Request $request)
    {
        return back()->with('success', 'Commande passée !');
    }

    public function success($order)
    {
        return view('pages.checkout');
    }

    public function webhook(Request $request)
    {
        return response()->json(['received' => true]);
    }
}