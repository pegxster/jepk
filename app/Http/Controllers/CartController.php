<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    private function getCart(): array
    {
        return session('cart', []);
    }

    private function saveCart(array $cart): void
    {
        session(['cart' => $cart]);
    }

    private function cartCount(array $cart): int
    {
        return array_sum(array_column($cart, 'quantity'));
    }

    public function index()
    {
        $cart  = $this->getCart();
        $total = array_sum(array_map(fn($i) => $i['price'] * $i['quantity'], $cart));
        $promoDiscount = session('cart_discount', 0);
        $finalTotal = max(0, $total - $promoDiscount);

        return view('cart.index', compact('cart', 'total', 'promoDiscount', 'finalTotal'));
    }

    public function add(Request $request)
    {
        $request->validate(['product_id' => 'required', 'quantity' => 'integer|min:1']);

        $product = Product::findOrFail($request->product_id);
        $cart    = $this->getCart();
        $id      = (string) $product->_id;
        $qty     = (int) ($request->quantity ?? 1);
        $price   = (float) ($product->sale_price ?? $product->price);

        if (isset($cart[$id])) {
            $newQty = $cart[$id]['quantity'] + $qty;
            if ($product->stock !== null && $newQty > $product->stock) {
                $newQty = (int) $product->stock;
            }
            $cart[$id]['quantity'] = $newQty;
        } else {
            $cart[$id] = [
                'product_id' => $id,
                'name'       => $product->name,
                'price'      => $price,
                'image'      => product_image_url($product->images[0] ?? null),
                'slug'       => $product->slug,
                'quantity'   => min($qty, (int) ($product->stock ?? 999)),
            ];
        }

        $this->saveCart($cart);

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'count'   => $this->cartCount($cart),
                'message' => 'Produit ajouté au panier !',
            ]);
        }

        return back()->with('success', '« ' . $product->name . ' » ajouté au panier !');
    }

    public function update(Request $request)
    {
        $request->validate(['product_id' => 'required', 'quantity' => 'integer|min:0']);

        $cart = $this->getCart();
        $id   = $request->product_id;

        if ((int) $request->quantity === 0) {
            unset($cart[$id]);
        } elseif (isset($cart[$id])) {
            $cart[$id]['quantity'] = (int) $request->quantity;
        }

        $this->saveCart($cart);
        return back();
    }

    public function remove(Request $request)
    {
        $cart = $this->getCart();
        unset($cart[$request->product_id]);
        $this->saveCart($cart);

        return back()->with('success', 'Article retiré du panier.');
    }

    public function clear()
    {
        $this->saveCart([]);
        session()->forget('cart_promo');
        session()->forget('cart_discount');
        return back()->with('success', 'Panier vidé.');
    }

    public function applyPromo(Request $request)
    {
        $request->validate(['code' => 'required|string']);

        $code = strtoupper(trim($request->code));

        $promoCodes = [
            'BIENVENUE10'  => ['type' => 'percent', 'value' => 10, 'min' => 20000, 'label' => '10% de réduction'],
            'JEPK2024'     => ['type' => 'percent', 'value' => 15, 'min' => 50000, 'label' => '15% de réduction'],
            'FIDELITE'     => ['type' => 'fixed',   'value' => 5000, 'min' => 30000, 'label' => '5 000 F CFA de réduction'],
            'LIVRAISON'    => ['type' => 'shipping', 'value' => 0, 'min' => 0, 'label' => 'Livraison offerte'],
        ];

        if (!isset($promoCodes[$code])) {
            return back()->with('error', 'Code promo non reconnu.');
        }

        $promo = $promoCodes[$code];
        $cart  = $this->getCart();
        $total = array_sum(array_map(fn($i) => $i['price'] * $i['quantity'], $cart));

        if ($total < $promo['min']) {
            return back()->with('error', 'Montant minimum de ' . number_format($promo['min'], 0, ',', ' ') . ' F CFA requis pour ce code promo.');
        }

        $discount = 0;
        if ($promo['type'] === 'percent') {
            $discount = $total * ($promo['value'] / 100);
        } elseif ($promo['type'] === 'fixed') {
            $discount = min($promo['value'], $total);
        }

        session(['cart_promo' => $code, 'cart_discount' => $discount]);

        return back()->with('success', 'Code promo appliqué : ' . $promo['label'] . ' !');
    }

    public function mini()
    {
        $cart  = $this->getCart();
        $count = $this->cartCount($cart);
        $total = array_sum(array_map(fn($i) => $i['price'] * $i['quantity'], $cart));

        return response()->json([
            'count' => $count,
            'total' => number_format($total, 0, ',', ' '),
            'items' => array_values($cart),
        ]);
    }

    public function addAll()
    {
        if (!auth()->check()) {
            return redirect()->guest(route('auth.login'))
                ->with('info', 'Connectez-vous pour ajouter des articles à votre panier.');
        }

        $user = auth()->user();
        $wishlistIds = $user->wishlist ?? [];

        if (empty($wishlistIds)) {
            return back()->with('info', 'Votre liste de favoris est vide.');
        }

        $products = Product::whereIn('_id', $wishlistIds)->get();
        $cart = $this->getCart();
        $added = 0;

        foreach ($products as $product) {
            $id = (string) $product->_id;
            $price = (float) ($product->sale_price ?? $product->price);

            if (!isset($cart[$id])) {
                $cart[$id] = [
                    'product_id' => $id,
                    'name'       => $product->name,
                    'price'      => $price,
                    'image'      => product_image_url($product->images[0] ?? null),
                    'slug'       => $product->slug,
                    'quantity'   => 1,
                ];
                $added++;
            }
        }

        $this->saveCart($cart);

        return back()->with('success', $added . ' article(s) ajouté(s) au panier depuis vos favoris.');
    }
}
