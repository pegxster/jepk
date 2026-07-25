<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('sort_order')->orderBy('name')->get();
        return view('admin.categories.index', compact('categories'));
    }

    public function show(Category $category)
    {
        return redirect()->route('admin.categories.index');
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_active'   => 'boolean',
            'sort_order'  => 'integer|min:0',
            'image'       => 'nullable|image|max:2048',
        ]);

        $data['slug']      = Str::slug($data['name']);
        $data['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('image')) {
            $filename = 'cat-' . Str::slug($data['name']) . '-' . time() . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path('assets/images/categories'), $filename);
            $data['image'] = 'assets/images/categories/' . $filename;
        }

        Category::create($data);

        return redirect()->route('admin.categories.index')->with('success', 'Catégorie créée !');
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_active'   => 'boolean',
            'sort_order'  => 'integer|min:0',
            'image'       => 'nullable|image|max:2048',
        ]);

        $data['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('image')) {
            if ($category->image && str_starts_with($category->image, 'assets/images/categories/')) {
                $oldPath = public_path($category->image);
                if (file_exists($oldPath)) @unlink($oldPath);
            }
            $filename = 'cat-' . Str::slug($data['name']) . '-' . time() . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path('assets/images/categories'), $filename);
            $data['image'] = 'assets/images/categories/' . $filename;
        }

        $category->update($data);

        return redirect()->route('admin.categories.index')->with('success', 'Catégorie mise à jour !');
    }

    public function destroy(Category $category)
    {
        if ($category->image && str_starts_with($category->image, 'assets/images/categories/')) {
            $path = public_path($category->image);
            if (file_exists($path)) @unlink($path);
        }
        $category->delete();

        return redirect()->route('admin.categories.index')->with('success', 'Catégorie supprimée.');
    }
}
