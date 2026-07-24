@extends('admin.layouts.app')
@section('title', 'Tableau de bord')

@push('styles')
<style>
.db-greeting{margin-bottom:32px}
.db-greeting h2{font-family:'Cormorant Garamond',serif;font-size:32px;font-weight:300;color:var(--dark);margin-bottom:6px}
.db-greeting p{font-size:14px;color:#9A8070}

/* Stats row */
.db-stats{display:grid;grid-template-columns:repeat(4,1fr);gap:20px;margin-bottom:32px}
.db-stat{background:#fff;border-radius:18px;padding:28px 26px;box-shadow:0 1px 3px rgba(61,43,31,.04);border:1px solid #F5EFE8;position:relative;overflow:hidden;transition:all .25s}
.db-stat:hover{transform:translateY(-3px);box-shadow:0 8px 28px rgba(61,43,31,.1)}
.db-stat::after{content:'';position:absolute;top:0;right:0;width:90px;height:90px;border-radius:50%;opacity:.06;transform:translate(20px,-20px)}
.db-stat.rose::after{background:var(--rose)}
.db-stat.peach::after{background:var(--peach)}
.db-stat.lav::after{background:var(--lav)}
.db-stat.green::after{background:#27AE60}
.db-stat-head{display:flex;align-items:center;gap:16px;margin-bottom:18px}
.db-stat-icon{width:50px;height:50px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:20px;flex-shrink:0}
.db-stat-icon.rose{background:rgba(212,84,122,.1);color:var(--rose)}
.db-stat-icon.peach{background:rgba(232,137,106,.1);color:var(--peach)}
.db-stat-icon.lav{background:rgba(155,142,196,.1);color:var(--lav)}
.db-stat-icon.green{background:rgba(39,174,96,.1);color:#27AE60}
.db-stat-label{font-size:13px;color:#9A8070;font-weight:500}
.db-stat-val{font-family:'Cormorant Garamond',serif;font-size:36px;font-weight:600;color:var(--dark);line-height:1}

/* Grid layout — 2 columns better balanced */
.db-grid{display:grid;grid-template-columns:1fr 1fr;gap:22px;align-items:start}

/* Cards */
.db-card{background:#fff;border-radius:18px;box-shadow:0 1px 3px rgba(61,43,31,.04);border:1px solid #F5EFE8;overflow:hidden}
.db-card-head{padding:20px 24px;border-bottom:1px solid #F5EFE8;display:flex;align-items:center;justify-content:space-between}
.db-card-title{font-family:'Cormorant Garamond',serif;font-size:19px;font-weight:600;color:var(--dark);display:flex;align-items:center;gap:10px}
.db-card-title i{font-size:16px;opacity:.5}
.db-card-link{font-size:13px;color:var(--rose);text-decoration:none;font-weight:600;display:flex;align-items:center;gap:6px;transition:color .2s}
.db-card-link:hover{color:var(--rose-dk)}

/* Table */
.db-table{width:100%;border-collapse:collapse}
.db-table th{text-align:left;font-size:11px;font-weight:700;letter-spacing:1px;text-transform:uppercase;color:#B0A098;padding:13px 20px;background:#FBF8F5;border-bottom:1px solid #F0E8E0}
.db-table td{padding:14px 20px;font-size:14px;color:var(--texte);border-bottom:1px solid #F8F3EF}
.db-table tr:last-child td{border-bottom:none}
.db-table tr:hover td{background:#FDF9F6}

/* Status */
.db-status{display:inline-flex;align-items:center;gap:7px;font-size:13px;font-weight:600}
.db-status::before{content:'';width:8px;height:8px;border-radius:50%;background:currentColor;flex-shrink:0}
.db-status.s-pending{color:#E8896A}
.db-status.s-confirmed{color:#9B8EC4}
.db-status.s-processing{color:#4A90D9}
.db-status.s-shipped{color:#27AE60}
.db-status.s-delivered{color:#2ECC71}
.db-status.s-cancelled{color:#E74C3C}

/* List items */
.db-list-item{display:flex;align-items:center;gap:16px;padding:16px 24px;border-bottom:1px solid #F8F3EF;transition:background .15s}
.db-list-item:last-child{border-bottom:none}
.db-list-item:hover{background:#FDF9F6}
.db-list-thumb{width:48px;height:48px;border-radius:12px;object-fit:cover;flex-shrink:0;background:#F5EFE8}
.db-list-info{flex:1;min-width:0}
.db-list-name{font-size:14px;font-weight:600;color:var(--dark);white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
.db-list-sub{font-size:12px;color:#9A8070;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
.db-list-right{font-size:12px;color:#B0A098;white-space:nowrap;flex-shrink:0}
.db-list-avatar{width:46px;height:46px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:16px;color:#fff;font-weight:600;flex-shrink:0}

/* Quick actions */
.db-quick{display:grid;grid-template-columns:1fr 1fr;gap:12px;padding:22px}
.db-quick-btn{display:flex;align-items:center;gap:12px;padding:14px 16px;background:#FBF8F5;border:1.5px solid #F0E8E0;border-radius:12px;text-decoration:none;color:var(--dark);font-size:13px;font-weight:600;transition:all .2s}
.db-quick-btn i{font-size:16px;color:var(--rose);width:20px;text-align:center}
.db-quick-btn:hover{background:rgba(212,84,122,.06);border-color:rgba(212,84,122,.25);transform:translateY(-1px)}

/* Low stock */
.db-low-stock{display:flex;align-items:center;gap:14px;padding:14px 24px;border-bottom:1px solid #F8F3EF}
.db-low-stock:last-child{border-bottom:none}
.db-low-badge{font-size:12px;font-weight:700;color:#E8896A;background:rgba(232,137,106,.1);padding:4px 10px;border-radius:8px;white-space:nowrap}

/* Category icon */
.db-cat-icon{width:42px;height:42px;border-radius:11px;display:flex;align-items:center;justify-content:center;font-size:16px;flex-shrink:0}

/* Charts */
.db-charts{display:grid;grid-template-columns:2fr 1fr;gap:20px;margin-bottom:22px}
.db-chart-card{background:#fff;border-radius:18px;box-shadow:0 1px 3px rgba(61,43,31,.04);border:1px solid #F5EFE8;padding:24px}
.db-chart-title{font-family:'Cormorant Garamond',serif;font-size:19px;font-weight:600;color:var(--dark);margin-bottom:18px;display:flex;align-items:center;gap:10px}
.db-chart-title i{font-size:16px;opacity:.5}
.db-chart-wrap{position:relative;height:260px}
.db-chart-half{height:220px}

/* Bottom row: 3 cards side by side */
.db-bottom{display:grid;grid-template-columns:1fr 1fr 1fr;gap:22px;margin-top:22px;align-items:start}

/* Responsive */
@media(max-width:1200px){.db-grid{grid-template-columns:1fr}.db-bottom{grid-template-columns:1fr 1fr}}
@media(max-width:900px){.db-stats{grid-template-columns:repeat(2,1fr)}.db-charts{grid-template-columns:1fr}.db-bottom{grid-template-columns:1fr}}
@media(max-width:600px){.db-stats{grid-template-columns:1fr}.db-quick{grid-template-columns:1fr}}
</style>
@endpush

@section('topbar-actions')
    <a href="{{ route('admin.produits.create') }}" class="topbar-btn">
        <i class="fa-solid fa-plus"></i> Nouveau produit
    </a>
@endsection

@section('content')

<div class="db-greeting">
    <h2>Bonjour, {{ auth()->user()->name }} 👋</h2>
    <p>Voici un résumé de votre boutique aujourd'hui.</p>
</div>

{{-- Stats --}}
<div class="db-stats">
    <div class="db-stat rose">
        <div class="db-stat-head">
            <div class="db-stat-icon rose"><i class="fa-solid fa-box-open"></i></div>
            <div class="db-stat-label">Produits</div>
        </div>
        <div class="db-stat-val">{{ $stats['products'] }}</div>
    </div>
    <div class="db-stat peach">
        <div class="db-stat-head">
            <div class="db-stat-icon peach"><i class="fa-solid fa-shopping-bag"></i></div>
            <div class="db-stat-label">Commandes</div>
        </div>
        <div class="db-stat-val">{{ $stats['orders'] }}</div>
    </div>
    <div class="db-stat lav">
        <div class="db-stat-head">
            <div class="db-stat-icon lav"><i class="fa-solid fa-users"></i></div>
            <div class="db-stat-label">Clients</div>
        </div>
        <div class="db-stat-val">{{ $stats['users'] }}</div>
    </div>
    <div class="db-stat green">
        <div class="db-stat-head">
            <div class="db-stat-icon green"><i class="fa-solid fa-coins"></i></div>
            <div class="db-stat-label">Revenus</div>
        </div>
        <div class="db-stat-val">{{ number_format($stats['revenue'], 0, ',', ' ') }} <span style="font-size:16px;font-weight:400;color:#9A8070">FCFA</span></div>
    </div>
</div>

{{-- Graphiques --}}
<div class="db-charts">
    <div class="db-chart-card">
        <div class="db-chart-title"><i class="fa-solid fa-chart-line" style="color:var(--rose)"></i> Revenus — 6 derniers mois</div>
        <div class="db-chart-wrap"><canvas id="revenueChart"></canvas></div>
    </div>
    <div class="db-chart-card">
        <div class="db-chart-title"><i class="fa-solid fa-chart-pie" style="color:var(--lav)"></i> Commandes par statut</div>
        <div class="db-chart-wrap db-chart-half"><canvas id="statusChart"></canvas></div>
    </div>
</div>
<div class="db-charts">
    <div class="db-chart-card" style="grid-column:1/-1">
        <div class="db-chart-title"><i class="fa-solid fa-calendar-days" style="color:var(--peach)"></i> Commandes — 7 derniers jours</div>
        <div class="db-chart-wrap"><canvas id="dailyChart"></canvas></div>
    </div>
</div>

{{-- Commandes récentes --}}
<div class="db-card">
    <div class="db-card-head">
        <div class="db-card-title"><i class="fa-solid fa-receipt"></i> Commandes récentes</div>
        <a href="{{ route('admin.orders.index') }}" class="db-card-link">Tout voir <i class="fa-solid fa-arrow-right" style="font-size:11px"></i></a>
    </div>
    <table class="db-table">
        <thead>
            <tr>
                <th>N° commande</th>
                <th>Client</th>
                <th>Total</th>
                <th>Statut</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @forelse($recent_orders as $order)
            <tr>
                <td><strong style="color:var(--rose)">#{{ $order->order_number ?? 'N/A' }}</strong></td>
                <td>{{ $order->customer_name ?? '—' }}</td>
                <td><strong>{{ number_format($order->total ?? 0, 0, ',', ' ') }} FCFA</strong></td>
                <td>
                    @php
                        $statusClass = [
                            'pending'    => 's-pending',
                            'confirmed'  => 's-confirmed',
                            'processing' => 's-processing',
                            'shipped'    => 's-shipped',
                            'delivered'  => 's-delivered',
                            'cancelled'  => 's-cancelled',
                        ];
                        $sc = $statusClass[$order->status ?? 'pending'] ?? 's-pending';
                    @endphp
                    <span class="db-status {{ $sc }}">
                        {{ \App\Models\Order::statusLabel($order->status ?? 'pending') }}
                    </span>
                </td>
                <td style="color:#B0A098;font-size:13px">{{ $order->created_at?->format('d/m/Y') ?? '—' }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="text-align:center;padding:48px 20px;color:#C0B0A8">
                    <i class="fa-solid fa-inbox" style="font-size:32px;display:block;margin-bottom:12px;opacity:.4"></i>
                    Aucune commande pour l'instant
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

{{-- Bottom row: 3 cards --}}
<div class="db-bottom">

    {{-- Stock faible --}}
    <div class="db-card">
        <div class="db-card-head">
            <div class="db-card-title" style="color:#E8896A"><i class="fa-solid fa-triangle-exclamation"></i> Stock faible</div>
        </div>
        @if($low_stock->count())
            @foreach($low_stock as $p)
            <div class="db-low-stock">
                @if(!empty($p->images[0]))
                    <img src="{{ product_image_url($p->images[0]) }}" class="db-list-thumb" alt="">
                @else
                    <div class="db-list-thumb" style="display:flex;align-items:center;justify-content:center;color:#C0B0A8"><i class="fa-solid fa-image" style="font-size:16px"></i></div>
                @endif
                <div class="db-list-info">
                    <div class="db-list-name">{{ Str::limit($p->name, 28) }}</div>
                    <div class="db-list-sub">SKU: {{ $p->sku ?? '—' }}</div>
                </div>
                <div class="db-low-badge">{{ $p->stock }}</div>
                <a href="{{ route('admin.produits.edit', $p) }}" class="db-card-link" style="flex-shrink:0"><i class="fa-solid fa-pen" style="font-size:12px"></i></a>
            </div>
            @endforeach
        @else
            <div style="text-align:center;padding:36px 20px;color:#C0B0A8">
                <i class="fa-solid fa-check-circle" style="font-size:28px;display:block;margin-bottom:10px;color:#27AE60;opacity:.4"></i>
                <span style="font-size:13px">Stock suffisant</span>
            </div>
        @endif
    </div>

    {{-- Nouveaux clients --}}
    <div class="db-card">
        <div class="db-card-head">
            <div class="db-card-title"><i class="fa-solid fa-user-plus" style="color:var(--lav)"></i> Nouveaux clients</div>
            <a href="{{ route('admin.users.index') }}" class="db-card-link">Tous <i class="fa-solid fa-arrow-right" style="font-size:11px"></i></a>
        </div>
        @forelse($recent_users as $u)
        <div class="db-list-item">
            <div class="db-list-avatar" style="background:linear-gradient(135deg,var(--rose),var(--lav))">
                {{ strtoupper(substr($u->prenom ?? $u->name ?? 'C', 0, 1)) }}
            </div>
            <div class="db-list-info">
                <div class="db-list-name">{{ $u->prenom ?? '' }} {{ $u->nom ?? $u->name ?? '' }}</div>
                <div class="db-list-sub">{{ $u->email }}</div>
            </div>
            <div class="db-list-right">{{ $u->created_at?->diffForHumans() ?? '—' }}</div>
        </div>
        @empty
        <div style="text-align:center;padding:36px 20px;color:#C0B0A8">
            <i class="fa-solid fa-user-group" style="font-size:28px;display:block;margin-bottom:10px;opacity:.4"></i>
            <span style="font-size:13px">Aucun client inscrit</span>
        </div>
        @endforelse
    </div>

    {{-- Catégories + Accès rapide --}}
    <div class="db-card">
        <div class="db-card-head">
            <div class="db-card-title"><i class="fa-solid fa-tags" style="color:var(--lav)"></i> Catégories</div>
            <a href="{{ route('admin.categories.index') }}" class="db-card-link">Gérer <i class="fa-solid fa-arrow-right" style="font-size:11px"></i></a>
        </div>
        @php
        $catIcons = ['maison'=>'fa-house','adulte'=>'fa-shirt','enfant'=>'fa-child','accessoires'=>'fa-bag-shopping'];
        $catBg    = ['maison'=>'rgba(232,137,106,.1)','adulte'=>'rgba(212,84,122,.1)','enfant'=>'rgba(155,142,196,.1)','accessoires'=>'rgba(39,174,96,.1)'];
        $catColor = ['maison'=>'#E8896A','adulte'=>'#C96880','enfant'=>'#9B8EC4','accessoires'=>'#27AE60'];
        @endphp
        @forelse($categories as $cat)
        <div class="db-list-item">
            @php
                $s  = strtolower($cat->slug);
                $ic = $catIcons[$s]  ?? 'fa-tag';
                $bg = $catBg[$s]     ?? 'rgba(155,142,196,.1)';
                $cl = $catColor[$s]  ?? '#9B8EC4';
            @endphp
            <div class="db-cat-icon" style="background:{{ $bg }}">
                <i class="fa-solid {{ $ic }}" style="color:{{ $cl }}"></i>
            </div>
            <div class="db-list-info">
                <div class="db-list-name">{{ $cat->name }}</div>
                @if($cat->description)<div class="db-list-sub">{{ Str::limit($cat->description, 32) }}</div>@endif
            </div>
            <span class="badge {{ $cat->is_active ? 'badge-active' : 'badge-inactive' }}">{{ $cat->is_active ? 'Active' : 'Inactive' }}</span>
        </div>
        @empty
        <div style="text-align:center;padding:36px 20px;color:#C0B0A8">
            <i class="fa-solid fa-tags" style="font-size:28px;display:block;margin-bottom:10px;opacity:.4"></i>
            <span style="font-size:13px">Aucune catégorie</span>
        </div>
        @endforelse

        <div style="border-top:1px solid #F5EFE8;padding:20px 24px">
            <div style="font-size:13px;font-weight:600;color:var(--dark);margin-bottom:12px">Accès rapide</div>
            <div class="db-quick" style="padding:0">
                <a href="{{ route('admin.produits.create') }}" class="db-quick-btn"><i class="fa-solid fa-plus"></i> Produit</a>
                <a href="{{ route('admin.blog.create') }}" class="db-quick-btn"><i class="fa-solid fa-pen-to-square"></i> Article</a>
                <a href="{{ route('admin.categories.index') }}" class="db-quick-btn"><i class="fa-solid fa-tags"></i> Catégories</a>
                <a href="{{ route('admin.media.index') }}" class="db-quick-btn"><i class="fa-solid fa-upload"></i> Images</a>
            </div>
        </div>
    </div>

</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.4/dist/chart.umd.min.js"></script>
<script>
const rose = '#C96880', roseLight = 'rgba(201,104,128,.15)';
const peach = '#E8896A', peachLight = 'rgba(232,137,106,.15)';
const lav = '#9B8EC4', lavLight = 'rgba(155,142,196,.15)';
const green = '#27AE60';

const defaultFont = { family: "'Nunito', sans-serif", size: 12, weight: '500' };
const gridColor = '#F0E8E0';

Chart.defaults.font = defaultFont;
Chart.defaults.color = '#9A8070';

// ── Revenus 6 mois (Bar) ──
new Chart(document.getElementById('revenueChart'), {
    type: 'bar',
    data: {
        labels: {!! json_encode($revenueChart->pluck('label')) !!},
        datasets: [{
            label: 'Revenus FCFA',
            data: {!! json_encode($revenueChart->pluck('value')) !!},
            backgroundColor: roseLight,
            borderColor: rose,
            borderWidth: 2,
            borderRadius: 8,
            borderSkipped: false,
            hoverBackgroundColor: rose,
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: { legend: { display: false } },
        scales: {
            x: { grid: { display: false }, border: { display: false } },
            y: { grid: { color: gridColor }, border: { display: false }, ticks: { callback: v => v >= 1000 ? (v/1000)+'k' : v } }
        }
    }
});

// ── Commandes par statut (Doughnut) ──
const statusData = {!! json_encode($ordersByStatus) !!};
const statusColors = { 'En attente': '#E8896A', 'Confirmées': '#9B8EC4', 'En traitement': '#4A90D9', 'Expédiées': '#27AE60', 'Livrées': '#2ECC71', 'Annulées': '#E74C3C' };
new Chart(document.getElementById('statusChart'), {
    type: 'doughnut',
    data: {
        labels: statusData.map(d => d.label),
        datasets: [{
            data: statusData.map(d => d.value),
            backgroundColor: statusData.map(d => statusColors[d.label] || '#999'),
            borderWidth: 0,
            hoverOffset: 6,
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        cutout: '65%',
        plugins: {
            legend: { position: 'bottom', labels: { padding: 14, usePointStyle: true, pointStyleWidth: 8 } }
        }
    }
});

// ── Commandes 7 jours (Line) ──
new Chart(document.getElementById('dailyChart'), {
    type: 'line',
    data: {
        labels: {!! json_encode($dailyOrders->pluck('label')) !!},
        datasets: [{
            label: 'Commandes',
            data: {!! json_encode($dailyOrders->pluck('value')) !!},
            borderColor: peach,
            backgroundColor: peachLight,
            fill: true,
            tension: 0.4,
            pointBackgroundColor: '#fff',
            pointBorderColor: peach,
            pointBorderWidth: 2,
            pointRadius: 4,
            pointHoverRadius: 6,
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: { legend: { display: false } },
        scales: {
            x: { grid: { display: false }, border: { display: false } },
            y: { grid: { color: gridColor }, border: { display: false }, beginAtZero: true, ticks: { stepSize: 1 } }
        }
    }
});
</script>
@endpush
