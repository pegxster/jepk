<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Order;
use App\Models\User;
use App\Models\BlogPost;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'products'   => Product::count(),
            'orders'     => Order::count(),
            'users'      => User::count(),
            'revenue'    => Order::whereIn('status', ['delivered', 'shipped'])->sum('total'),
            'pending'    => Order::where('status', Order::STATUS_PENDING)->count(),
            'low_stock'  => Product::where('stock', '<=', 5)->where('stock', '>', 0)->count(),
        ];

        $recent_orders = Order::orderBy('created_at', 'desc')->limit(8)->get();
        $low_stock     = Product::where('stock', '<=', 5)->where('stock', '>', 0)->orderBy('stock')->limit(5)->get();
        $recent_posts  = BlogPost::orderBy('created_at', 'desc')->limit(3)->get();
        $recent_users  = User::where('is_admin', '!=', true)->orderBy('created_at', 'desc')->limit(8)->get();
        $categories    = Category::orderBy('sort_order')->get();

        // ── Graphique : revenus des 6 derniers mois ──
        $revenueChart = collect();
        for ($i = 5; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            $revenueChart->push([
                'label' => $month->format('M'),
                'value' => (float) Order::whereIn('status', ['delivered', 'shipped'])
                    ->whereYear('created_at', $month->year)
                    ->whereMonth('created_at', $month->month)
                    ->sum('total'),
            ]);
        }

        // ── Graphique : commandes par statut ──
        $statusLabels = [
            'pending'    => 'En attente',
            'confirmed'  => 'Confirmées',
            'processing' => 'En traitement',
            'shipped'    => 'Expédiées',
            'delivered'  => 'Livrées',
            'cancelled'  => 'Annulées',
        ];
        $ordersByStatus = collect();
        foreach ($statusLabels as $key => $label) {
            $count = Order::where('status', $key)->count();
            if ($count > 0) {
                $ordersByStatus->push(['label' => $label, 'value' => $count]);
            }
        }

        // ── Graphique : commandes des 7 derniers jours ──
        $dailyOrders = collect();
        for ($i = 6; $i >= 0; $i--) {
            $day = Carbon::now()->subDays($i);
            $dailyOrders->push([
                'label' => $day->format('d/m'),
                'value' => Order::whereDate('created_at', $day->toDateString())->count(),
            ]);
        }

        return view('admin.dashboard', compact(
            'stats', 'recent_orders', 'low_stock', 'recent_posts',
            'recent_users', 'categories', 'revenueChart',
            'ordersByStatus', 'dailyOrders'
        ));
    }
}
