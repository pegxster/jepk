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
        $pipelineStatuses = [
            Order::STATUS_PENDING,
            Order::STATUS_CONTACTED,
            Order::STATUS_DEPOSIT_RECEIVED,
            Order::STATUS_PROCESSING,
            Order::STATUS_READY,
            Order::STATUS_DELIVERED,
        ];

        $stats = [
            'products'        => Product::count(),
            'orders'          => Order::count(),
            'users'           => User::count(),
            'revenue'         => Order::where('status', Order::STATUS_DELIVERED)->sum('total'),
            'pending'         => Order::where('status', Order::STATUS_PENDING)->count(),
            'to_contact'      => Order::where('status', Order::STATUS_PENDING)->count(),
            'awaiting_deposit'=> Order::where('status', Order::STATUS_CONTACTED)->count(),
            'in_production'   => Order::where('status', Order::STATUS_PROCESSING)->count(),
            'ready'           => Order::where('status', Order::STATUS_READY)->count(),
        ];

        // Pipeline : commandes par statut actif avec les ordres
        $pipeline = [];
        foreach ($pipelineStatuses as $status) {
            $pipeline[$status] = Order::where('status', $status)
                ->orderBy('created_at', 'desc')
                ->limit(10)
                ->get();
        }

        $recent_orders = Order::orderBy('created_at', 'desc')->limit(10)->get();
        $recent_users  = User::where('is_admin', '!=', true)->orderBy('created_at', 'desc')->limit(6)->get();
        $categories    = Category::orderBy('sort_order')->get();
        $recent_prods  = Product::orderBy('created_at', 'desc')->limit(5)->get();

        // Nombre de produits par catégorie en une seule requête agrégée
        $prodCountByCategory = collect(
            Product::raw(fn ($col) => $col->aggregate([
                ['$group' => ['_id' => '$category_name', 'count' => ['$sum' => 1]]],
            ]))->toArray()
        )->keyBy('_id')->map(fn ($r) => $r['count']);

        // ── Graphique : revenus des 6 derniers mois ──
        $revenueChart = collect();
        for ($i = 5; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            $revenueChart->push([
                'label' => $month->translatedFormat('M'),
                'value' => (float) Order::where('status', Order::STATUS_DELIVERED)
                    ->whereYear('created_at', $month->year)
                    ->whereMonth('created_at', $month->month)
                    ->sum('total'),
            ]);
        }

        // ── Graphique : commandes par statut ──
        $ordersByStatus = collect();
        foreach ($pipelineStatuses as $status) {
            $count = Order::where('status', $status)->count();
            if ($count > 0) {
                $ordersByStatus->push(['label' => Order::statusLabel($status), 'value' => $count]);
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
            'stats', 'pipeline', 'recent_orders',
            'recent_users', 'categories', 'recent_prods', 'prodCountByCategory',
            'revenueChart', 'ordersByStatus', 'dailyOrders'
        ));
    }
}
