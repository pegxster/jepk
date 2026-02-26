<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        return view('shop.index');
    }

    public function search(Request $request)
    {
        return view('shop.index');
    }

    public function show($slug)
    {
        return view('shop.index');
    }
}