<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('pages.home');
    }

    public function surMesure(Request $request)
    {
        return back()->with('success', 'Demande envoyée ! Nous vous recontactons sous 24h. ✨');
    }
}