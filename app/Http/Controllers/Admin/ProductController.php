<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::orderBy('created_at', 'desc');

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }
        if ($request->filled('status')) {
            $query->where('is_active', $request->status === 'active');
        }

        $products   = $query->paginate(15)->withQueryString();
        $categories = Category::where('is_active', true)->orderBy('name')->get();

        return view('admin.products.index', compact('products', 'categories'));
    }

    public function create()
    {
        $categories = Category::where('is_active', true)->orderBy('name')->get();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'              => 'required|string|max:255',
            'description'       => 'required|string',
            'short_description' => 'nullable|string|max:500',
            'price'             => 'required|numeric|min:0',
            'sale_price'        => 'nullable|numeric|min:0',
            'category_id'       => 'nullable|string',
            'stock'             => 'required|integer|min:0',
            'sku'               => 'nullable|string|max:100',
            'is_active'         => 'boolean',
            'is_featured'       => 'boolean',
            'badge'             => 'nullable|string|max:50',
            'tags'              => 'nullable|string',
            'materials'         => 'nullable|string',
            'colors'            => 'nullable|string',
            'images.*'          => 'nullable|image|max:2048',
        ]);

        $data['slug']       = Str::slug($data['name']);
        $data['is_active']  = $request->boolean('is_active');
        $data['is_featured'] = $request->boolean('is_featured');
        $data['tags']       = $data['tags'] ? array_map('trim', explode(',', $data['tags'])) : [];
        $data['materials']  = $data['materials'] ? array_map('trim', explode(',', $data['materials'])) : [];
        $data['colors']     = $data['colors'] ? array_map('trim', explode(',', $data['colors'])) : [];

        if (!empty($data['category_id'])) {
            $category = Category::find($data['category_id']);
            $data['category_name'] = $category ? $category->name : null;
        }

        $images = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('images/products', 'public');
                $images[] = $path;
            }
        }
        $data['images'] = $images;

        Product::create($data);

        return redirect()->route('admin.produits.index')->with('success', 'Produit créé avec succès !');
    }

    public function edit(Product $product)
    {
        $categories = Category::where('is_active', true)->orderBy('name')->get();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'name'              => 'required|string|max:255',
            'description'       => 'required|string',
            'short_description' => 'nullable|string|max:500',
            'price'             => 'required|numeric|min:0',
            'sale_price'        => 'nullable|numeric|min:0',
            'category_id'       => 'nullable|string',
            'stock'             => 'required|integer|min:0',
            'sku'               => 'nullable|string|max:100',
            'is_active'         => 'boolean',
            'is_featured'       => 'boolean',
            'badge'             => 'nullable|string|max:50',
            'tags'              => 'nullable|string',
            'materials'         => 'nullable|string',
            'colors'            => 'nullable|string',
            'images.*'          => 'nullable|image|max:2048',
            'remove_images'     => 'nullable|array',
        ]);

        $data['is_active']   = $request->boolean('is_active');
        $data['is_featured'] = $request->boolean('is_featured');
        $data['tags']        = $data['tags'] ? array_map('trim', explode(',', $data['tags'])) : [];
        $data['materials']   = $data['materials'] ? array_map('trim', explode(',', $data['materials'])) : [];
        $data['colors']      = $data['colors'] ? array_map('trim', explode(',', $data['colors'])) : [];

        if (!empty($data['category_id'])) {
            $category = Category::find($data['category_id']);
            $data['category_name'] = $category ? $category->name : null;
        }

        $existingImages = $product->images ?? [];

        if (!empty($request->remove_images)) {
            foreach ($request->remove_images as $path) {
                Storage::disk('public')->delete($path);
                $existingImages = array_filter($existingImages, fn($img) => $img !== $path);
            }
        }

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('images/products', 'public');
                $existingImages[] = $path;
            }
        }
        $data['images'] = array_values($existingImages);

        $product->update($data);

        return redirect()->route('admin.produits.index')->with('success', 'Produit mis à jour !');
    }

    public function destroy(Product $product)
    {
        foreach ($product->images ?? [] as $image) {
            Storage::disk('public')->delete($image);
        }
        $product->delete();

        return redirect()->route('admin.produits.index')->with('success', 'Produit supprimé.');
    }
}
