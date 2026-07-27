<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AccountController extends Controller
{
    public function index()
    {
        $user          = Auth::user();
        $ordersCount   = Order::where('user_id', (string) $user->_id)->count();
        $wishlistCount = count($user->wishlist ?? []);
        $recentOrders  = Order::where('user_id', (string) $user->_id)
                            ->orderBy('created_at', 'desc')
                            ->limit(5)
                            ->get();

        return view('account.index', compact('ordersCount', 'wishlistCount', 'recentOrders'));
    }

    public function orders()
    {
        $orders = Order::where('user_id', (string) Auth::id())
                    ->orderBy('created_at', 'desc')
                    ->paginate(10);

        return view('account.orders', compact('orders'));
    }

    public function orderDetail($orderId)
    {
        $order = Order::where('user_id', (string) Auth::id())
                    ->where('_id', $orderId)
                    ->firstOrFail();

        return view('account.order_detail', compact('order'));
    }

    public function invoice($orderId)
    {
        return back();
    }

    public function profile()
    {
        return view('account.profil');
    }

    public function profileUpdate(Request $request)
    {
        $user = Auth::user();

        $data = $request->validate([
            'prenom'    => 'required|string|max:100',
            'nom'       => 'required|string|max:100',
            'email'     => 'required|email',
            'telephone' => 'nullable|string|max:20',
            'birthday'  => 'nullable|date',
            'avatar'    => 'nullable|image|max:2048',
        ]);

        $data['name'] = $data['prenom'] . ' ' . $data['nom'];

        if ($request->hasFile('avatar')) {
            if ($user->avatar && !str_starts_with($user->avatar, 'http') && !str_starts_with($user->avatar, 'assets/')) {
                delete_uploaded_file($user->avatar);
            }
            $data['avatar'] = save_uploaded_file($request->file('avatar'), 'avatars');
        }

        $user->update($data);

        return back()->with('success', 'Votre profil a été mis à jour !');
    }

    public function passwordUpdate(Request $request)
    {
        $request->validate([
            'current_password'      => 'required',
            'new_password'          => 'required|string|min:8|confirmed',
        ], [
            'new_password.min'       => 'Le nouveau mot de passe doit comporter au moins 8 caractères.',
            'new_password.confirmed' => 'Les mots de passe ne correspondent pas.',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Mot de passe actuel incorrect.']);
        }

        $user->update(['password' => $request->new_password]);

        return back()->with('success', 'Mot de passe modifié avec succès !');
    }

    public function addresses()
    {
        $addresses = Auth::user()->addresses ?? [];
        return view('account.addresses', compact('addresses'));
    }

    public function addressStore(Request $request)
    {
        $data = $request->validate([
            'label'       => 'required|string|max:50',
            'name'        => 'required|string|max:200',
            'address'     => 'required|string|max:500',
            'city'        => 'required|string|max:100',
            'postal_code' => 'nullable|string|max:20',
            'country'     => 'required|string|max:100',
            'phone'       => 'nullable|string|max:20',
        ]);

        $user      = Auth::user();
        $addresses = $user->addresses ?? [];
        $data['id'] = uniqid();
        $data['is_default'] = empty($addresses);
        $addresses[] = $data;

        $user->update(['addresses' => $addresses]);

        return back()->with('success', 'Adresse ajoutée !');
    }

    public function addressUpdate(Request $request, $id)
    {
        $data = $request->validate([
            'label'       => 'required|string|max:50',
            'name'        => 'required|string|max:200',
            'address'     => 'required|string|max:500',
            'city'        => 'required|string|max:100',
            'postal_code' => 'nullable|string|max:20',
            'country'     => 'required|string|max:100',
            'phone'       => 'nullable|string|max:20',
        ]);

        $user      = Auth::user();
        $addresses = array_map(function ($addr) use ($id, $data) {
            if (($addr['id'] ?? '') === $id) {
                return array_merge($addr, $data);
            }
            return $addr;
        }, $user->addresses ?? []);

        $user->update(['addresses' => $addresses]);

        return back()->with('success', 'Adresse modifiée !');
    }

    public function addressDestroy($id)
    {
        $user      = Auth::user();
        $addresses = array_values(array_filter(
            $user->addresses ?? [],
            fn($a) => ($a['id'] ?? '') !== $id
        ));

        $user->update(['addresses' => $addresses]);

        return back()->with('success', 'Adresse supprimée.');
    }

    public function addressDefault($id)
    {
        $user      = Auth::user();
        $addresses = array_map(function ($addr) use ($id) {
            $addr['is_default'] = ($addr['id'] ?? '') === $id;
            return $addr;
        }, $user->addresses ?? []);

        $user->update(['addresses' => $addresses]);

        return back()->with('success', 'Adresse par défaut mise à jour !');
    }

    public function notifications()
    {
        return view('account.notifications');
    }

    public function markRead(Request $request)
    {
        return back();
    }
}
