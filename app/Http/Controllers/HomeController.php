<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Slide;
use App\Models\CustomOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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
        $data = $request->validate([
            'nom'             => 'required|string|max:150',
            'telephone'       => 'required|string|max:30',
            'type_creation'   => 'required|string|max:100',
            'taille'          => 'nullable|string|max:50',
            'coloris'         => 'nullable|string|max:255',
            'description'     => 'required|string|max:2000',
            'budget'          => 'nullable|string|max:100',
            'delai'           => 'nullable|string|max:100',
            'photo_inspiration' => 'nullable|image|mimes:jpeg,png,webp,gif|max:5120',
        ], [
            'nom.required'            => 'Veuillez indiquer votre nom.',
            'telephone.required'      => 'Veuillez indiquer un numéro pour être recontactée.',
            'type_creation.required' => 'Veuillez choisir un type de création.',
            'description.required'   => 'Veuillez décrire votre projet.',
            'description.max'        => 'La description ne doit pas dépasser 2000 caractères.',
            'photo_inspiration.image'  => 'Le fichier doit être une image.',
            'photo_inspiration.mimes'  => 'Formats acceptés : JPG, PNG, WEBP, GIF.',
            'photo_inspiration.max'    => 'La photo ne doit pas dépasser 5 Mo.',
        ]);

        $photo = null;
        if ($request->hasFile('photo_inspiration')) {
            $photo = store_image_in_db($request->file('photo_inspiration'), 'sur-mesure');
        }

        CustomOrder::create([
            'user_id'        => auth()->id(),
            'customer_name'  => $data['nom'],
            'customer_phone' => $data['telephone'],
            'type_creation'  => $data['type_creation'],
            'taille'         => $data['taille'] ?? null,
            'coloris'        => $data['coloris'] ?? null,
            'description'    => $data['description'],
            'budget'         => $data['budget'] ?? null,
            'delai'          => $data['delai'] ?? null,
            'photo'          => $photo,
            'status'         => CustomOrder::STATUS_NOUVEAU,
        ]);

        return back()->with('success', 'Demande envoyée ! Nous vous recontactons sous 24h. ✨');
    }
}
