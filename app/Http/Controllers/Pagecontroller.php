<?php

namespace App\Http\Controllers;

class PageController extends Controller
{
    public function atelier()
    {
        return view('pages.atelier');
    }

    public function blog()
    {
        return view('pages.blog');
    }

    public function blogPost($slug)
    {
        return view('pages.blog');
    }

    public function contact()
    {
        return view('pages.home');
    }

    public function about()
    {
        return view('pages.home');
    }

    public function shipping()
    {
        return view('pages.home');
    }

    public function terms()
    {
        return view('pages.home');
    }

    public function privacy()
    {
        return view('pages.home');
    }

    public function faq()
    {
        return view('pages.home');
    }
}
