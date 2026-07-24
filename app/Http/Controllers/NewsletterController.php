<?php

namespace App\Http\Controllers;

use App\Models\Newsletter;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        Newsletter::updateOrCreate(
            ['email' => $request->email],
            [
                'is_active'     => true,
                'subscribed_at' => now(),
            ]
        );

        return back()->with('success', 'Merci pour votre inscription !');
    }

    public function unsubscribe($email)
    {
        Newsletter::where('email', $email)->update(['is_active' => false]);

        return view('pages.home')->with('success', 'Vous êtes désabonné(e).');
    }
}
