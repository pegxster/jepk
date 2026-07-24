<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    private array $categories = [
        'Tutoriels', 'Tendances', 'Matières', 'Sur Mesure', 'Inspiration', 'Actualités',
    ];

    public function show(BlogPost $post)
    {
        return redirect()->route('admin.blog.edit', $post);
    }

    public function index()
    {
        $posts = BlogPost::orderBy('created_at', 'desc')->paginate(12);
        return view('admin.blog.index', compact('posts'));
    }

    public function create()
    {
        $categories = $this->categories;
        return view('admin.blog.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'        => 'required|string|max:255',
            'excerpt'      => 'nullable|string|max:500',
            'content'      => 'required|string',
            'category'     => 'required|string',
            'tags'         => 'nullable|string',
            'is_published' => 'boolean',
            'image'        => 'nullable|image|max:3072',
        ]);

        $data['slug']        = Str::slug($data['title']);
        $data['is_published'] = $request->boolean('is_published');
        $data['author_id']   = Auth::id();
        $data['author_name'] = Auth::user()->name;
        $data['tags']        = $data['tags'] ? array_map('trim', explode(',', $data['tags'])) : [];
        $data['views']       = 0;
        $data['published_at'] = $data['is_published'] ? now() : null;

        $wordCount = str_word_count(strip_tags($data['content']));
        $data['reading_time'] = max(1, (int) ceil($wordCount / 200));

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('images/blog', 'public');
        }

        BlogPost::create($data);

        return redirect()->route('admin.blog.index')->with('success', 'Article créé !');
    }

    public function edit(BlogPost $post)
    {
        $categories = $this->categories;
        return view('admin.blog.edit', compact('post', 'categories'));
    }

    public function update(Request $request, BlogPost $post)
    {
        $data = $request->validate([
            'title'        => 'required|string|max:255',
            'excerpt'      => 'nullable|string|max:500',
            'content'      => 'required|string',
            'category'     => 'required|string',
            'tags'         => 'nullable|string',
            'is_published' => 'boolean',
            'image'        => 'nullable|image|max:3072',
        ]);

        $data['is_published'] = $request->boolean('is_published');
        $data['tags']         = $data['tags'] ? array_map('trim', explode(',', $data['tags'])) : [];

        if ($data['is_published'] && !$post->published_at) {
            $data['published_at'] = now();
        }

        $wordCount = str_word_count(strip_tags($data['content']));
        $data['reading_time'] = max(1, (int) ceil($wordCount / 200));

        if ($request->hasFile('image')) {
            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }
            $data['image'] = $request->file('image')->store('images/blog', 'public');
        }

        $post->update($data);

        return redirect()->route('admin.blog.index')->with('success', 'Article mis à jour !');
    }

    public function destroy(BlogPost $post)
    {
        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }
        $post->delete();

        return redirect()->route('admin.blog.index')->with('success', 'Article supprimé.');
    }
}
