<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private static array $defaults = [
        'maison'      => ['nom' => 'Maison',      'img' => 'assets/images/jepk42.jpg', 'desc' => 'Coussins · Nappes · Plaids · Tapis'],
        'adulte'      => ['nom' => 'Adulte',      'img' => 'assets/images/jepk5.jpg',  'desc' => 'Pulls · Écharpes · Bonnets · Mode'],
        'enfant'      => ['nom' => 'Enfant',      'img' => 'assets/images/jepk10.jpg', 'desc' => 'Layettes · Doudous · Vêtements'],
        'accessoires' => ['nom' => 'Accessoires', 'img' => 'assets/images/jepk25.jpg', 'desc' => 'Sacs · Bijoux · Idées Cadeaux'],
    ];

    public function index()
    {
        return view('categories.index');
    }

    public function show(Request $request, string $slug)
    {
        // Chercher la catégorie en BDD
        $category = Category::where('slug', $slug)->where('is_active', true)->first();

        // Fallback sur les catégories codées en dur
        if (!$category && !isset(self::$defaults[$slug])) {
            abort(404);
        }

        $catName = $category ? $category->name : self::$defaults[$slug]['nom'];
        $catDesc = $category ? ($category->description ?? '') : self::$defaults[$slug]['desc'];
        $catImg  = $category && $category->image
            ? (str_starts_with($category->image, 'http') ? $category->image : asset($category->image))
            : asset(self::$defaults[$slug]['img'] ?? 'assets/images/jepk42.jpg');

        // Produits de la catégorie
        $query = Product::active();

        if ($category) {
            $query->where('category_id', (string) $category->_id);
        } else {
            $query->where(function ($q) use ($catName) {
                $q->where('category_name', 'like', '%' . $catName . '%')
                  ->orWhere('category_name', 'like', '%' . strtolower($catName) . '%');
            });
        }

        // Tri
        match($request->tri ?? 'nouveaute') {
            'prix_asc'  => $query->orderBy('price', 'asc'),
            'prix_desc' => $query->orderBy('price', 'desc'),
            default     => $query->orderBy('created_at', 'desc'),
        };

        $products = $query->paginate(12)->withQueryString();

        return view('categories.show', compact('slug', 'catName', 'catDesc', 'catImg', 'products'));
    }
}
