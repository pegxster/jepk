<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;

class PageController extends Controller
{
    public function atelier()
    {
        return view('pages.atelier');
    }

    public function blog()
    {
        $posts = BlogPost::published()
            ->orderBy('published_at', 'desc')
            ->paginate(9);

        return view('pages.blog', compact('posts'));
    }

    public function blogPost($slug)
    {
        $post = BlogPost::where('slug', $slug)
            ->published()
            ->firstOrFail();

        if ($post->views !== null) {
            $post->update(['views' => $post->views + 1]);
        }

        return view('pages.blog_show', compact('post'));
    }

    public function contact()
    {
        return view('pages.contact');
    }

    public function about()
    {
        return view('pages.about');
    }

    public function shipping()
    {
        return view('pages.shipping');
    }

    public function terms()
    {
        return view('pages.terms');
    }

    public function privacy()
    {
        return view('pages.privacy');
    }

    public function faq()
    {
        return view('pages.faq');
    }
}
