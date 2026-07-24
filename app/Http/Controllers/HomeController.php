<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Slide;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $slides     = Slide::active()->get();
        $featured   = Product::active()->featured()->limit(8)->get();
        $categories = Category::where('is_active', true)->orderBy('sort_order')->limit(6)->get();
        $nouveautes = Product::active()->orderBy('created_at', 'desc')->limit(4)->get();

        return view('pages.home', compact('slides', 'featured', 'categories', 'nouveautes'));
    }

    public function surMesure(Request $request)
    {
        $request->validate([
            'photo_inspiration' => 'nullable|image|mimes:jpeg,png,webp,gif|max:5120',
        ], [
            'photo_inspiration.image'  => 'Le fichier doit être une image.',
            'photo_inspiration.mimes'  => 'Formats acceptés : JPG, PNG, WEBP, GIF.',
            'photo_inspiration.max'    => 'La photo ne doit pas dépasser 5 Mo.',
        ]);

        // Sauvegarde de la photo si elle est fournie
        if ($request->hasFile('photo_inspiration')) {
            $request->file('photo_inspiration')
                    ->store('sur-mesure', 'public');
        }

        return back()->with('success', 'Demande envoyée ! Nous vous recontactons sous 24h. ✨');
    }
}
