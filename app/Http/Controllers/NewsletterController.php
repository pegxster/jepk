<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        return back()->with('success', 'Merci pour votre inscription ! 💌');
    }

    public function unsubscribe($email)
    {
        return view('pages.home');
    }
}