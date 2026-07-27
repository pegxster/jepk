<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Quartier;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart  = session('cart', []);
        $total = array_sum(array_map(fn($i) => ($i['price'] ?? 0) * ($i['quantity'] ?? 1), $cart));

        return view('pages.checkout', compact('cart', 'total'));
    }

    public function process(Request $request)
    {
        $request->validate([
            'nom'             => 'required|string|max:100',
            'adresse'         => 'required|string|max:255',
            'quartier'        => 'nullable|string|max:150',
            'telephone'       => 'required|string|max:30',
            'ville'           => 'nullable|string|max:100',
            'payment_method'  => 'nullable|string|max:100',
        ]);

        // Retrouve le quartier saisi dans notre liste, ou l'y ajoute s'il est nouveau
        $quartier = Quartier::findOrCreateFromInput($request->input('quartier'));

        $cart = session('cart', []);

        if (empty($cart)) {
            return back()->with('error', 'Votre panier est vide. Ajoutez des produits avant de commander.');
        }

        $subtotal = array_sum(array_map(fn($i) => ($i['price'] ?? 0) * ($i['quantity'] ?? 1), $cart));
        $shipping = $subtotal >= 70000 ? 0 : 2000;
        $total    = $subtotal + $shipping;

        $user = auth()->user();

        $order = Order::create([
            'order_number'    => 'JKP-' . strtoupper(Str::random(6)),
            'user_id'         => $user?->_id ?? null,
            'customer_name'   => $request->input('nom', $user?->name ?? 'Cliente JEKP'),
            'customer_email'  => $user?->email ?? 'client@jekpstore.com',
            'customer_phone'  => $request->input('telephone', '0700000000'),
            'items'           => array_values($cart),
            'subtotal'        => $subtotal,
            'shipping_cost'   => $shipping,
            'discount'        => 0,
            'total'           => $total,
            'status'          => Order::STATUS_PENDING,
            'payment_method'  => $request->input('payment_method', 'Wave / Mobile Money'),
            'payment_status'  => 'pending',
            'shipping_address'=> [
                'adresse'  => $request->input('adresse', 'Abidjan'),
                'quartier' => $quartier->nom ?? $request->input('quartier'),
                'commune'  => $quartier->commune ?? null,
                'ville'    => $request->input('ville', 'Abidjan'),
            ],
        ]);

        // Vider le panier
        session()->forget('cart');

        return redirect()->route('checkout.success', $order->_id ?? 'demo')
            ->with('success', 'Votre commande #' . $order->order_number . ' a bien été enregistrée ! ✨');
    }

    public function success($orderId)
    {
        $order = Order::find($orderId);

        return view('pages.checkout_success', compact('order', 'orderId'));
    }

    public function webhook(Request $request)
    {
        return response()->json(['received' => true]);
    }
}