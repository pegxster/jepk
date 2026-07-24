<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $wishlistIds = $user->wishlist ?? [];
        $products = collect();

        if (!empty($wishlistIds)) {
            $products = Product::whereIn('_id', $wishlistIds)->get();
        }

        return view('account.wishlist', compact('products'));
    }

    public function add(Request $request)
    {
        $request->validate(['product_id' => 'required|string']);

        $user = Auth::user();
        $wishlist = $user->wishlist ?? [];

        if (!in_array($request->product_id, $wishlist)) {
            $wishlist[] = $request->product_id;
            $user->update(['wishlist' => $wishlist]);
        }

        if ($request->wantsJson()) {
            return response()->json(['success' => true, 'message' => 'Ajouté à vos favoris ♡']);
        }

        return back()->with('success', 'Ajouté à vos favoris ♡');
    }

    public function remove(Request $request, $id = null)
    {
        $productId = $id ?? $request->product_id;

        $user = Auth::user();
        $wishlist = array_values(array_filter(
            $user->wishlist ?? [],
            fn($item) => $item !== $productId
        ));

        $user->update(['wishlist' => $wishlist]);

        if ($request->wantsJson()) {
            return response()->json(['success' => true, 'message' => 'Retiré de vos favoris.']);
        }

        return back()->with('success', 'Retiré de vos favoris.');
    }

    public function toggle(Request $request)
    {
        $request->validate(['product_id' => 'required|string']);

        $user = Auth::user();
        $wishlist = $user->wishlist ?? [];
        $index = array_search($request->product_id, $wishlist);

        if ($index !== false) {
            unset($wishlist[$index]);
            $wishlist = array_values($wishlist);
            $added = false;
        } else {
            $wishlist[] = $request->product_id;
            $added = true;
        }

        $user->update(['wishlist' => $wishlist]);

        if ($request->wantsJson()) {
            return response()->json(['success' => true, 'added' => $added]);
        }

        return back()->with('success', $added ? 'Ajouté à vos favoris ♡' : 'Retiré de vos favoris.');
    }
}
