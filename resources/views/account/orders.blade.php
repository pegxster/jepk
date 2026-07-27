@extends('layouts.app')
@section('title','Mes Commandes — JEKP Store')
@push('styles')
<style>
.page-hero{background:linear-gradient(135deg,var(--creme2) 0%,var(--blanc) 50%,var(--peche) 100%);padding:60px 50px;text-align:center;border-bottom:1px solid var(--peche);position:relative;overflow:hidden}
.page-hero::before{content:'';position:absolute;right:-100px;top:-100px;width:320px;height:320px;border-radius:50%;background:linear-gradient(135deg,var(--peche),var(--rose-p));opacity:.1;pointer-events:none}
.breadcrumb{display:flex;gap:8px;align-items:center;font-size:11px;color:var(--texte2);justify-content:center;margin-top:14px}
.breadcrumb a{color:var(--texte2);text-decoration:none;transition:color .3s}.breadcrumb a:hover{color:var(--rose-v)}
.breadcrumb span{color:var(--rose-p)}
.account-layout{max-width:1200px;margin:0 auto;padding:60px 50px;display:grid;grid-template-columns:260px 1fr;gap:36px;align-items:start}
.account-sidebar{background:var(--blanc);border-radius:18px;padding:28px;box-shadow:var(--ombre-sm);position:sticky;top:100px;border:1px solid var(--peche)}
.acc-nav{list-style:none}.acc-nav li{margin-bottom:3px}
.acc-nav a{display:flex;align-items:center;gap:10px;padding:10px 14px;border-radius:10px;text-decoration:none;color:var(--texte2);font-size:13px;transition:var(--trans)}
.acc-nav a:hover,.acc-nav a.on{background:var(--peche);color:var(--rose-v)}.acc-nav a.on{font-weight:500}
.acc-nav i{width:16px;text-align:center;font-size:13px;flex-shrink:0}
.acc-bloc{background:var(--blanc);border-radius:14px;padding:26px;box-shadow:var(--ombre-sm);border:1px solid var(--peche)}
.acc-bloc-header{display:flex;justify-content:space-between;align-items:center;margin-bottom:18px;padding-bottom:14px;border-bottom:1px solid var(--peche)}
.acc-bloc-titre{font-family:var(--f-titre);font-size:19px;font-weight:300;color:var(--texte)}
.acc-titre{font-family:var(--f-titre);font-size:26px;font-weight:300;color:var(--texte);margin-bottom:4px}
.acc-sous{font-size:13px;color:var(--texte2);margin-bottom:24px}
.cmd-table{width:100%;border-collapse:collapse}
.cmd-table th{text-align:left;font-size:10px;letter-spacing:2px;text-transform:uppercase;color:var(--texte2);padding:8px 12px;border-bottom:1px solid var(--peche)}
.cmd-table td{padding:14px 12px;border-bottom:1px solid var(--creme2);font-size:13px;color:var(--texte)}
.cmd-table tr:hover td{background:var(--creme2);border-radius:8px}
.cmd-table tr:last-child td{border-bottom:none}
.statut{padding:4px 12px;border-radius:50px;font-size:10px;font-weight:500;letter-spacing:.5px;display:inline-block}
.s-livre{background:#f0faf5;color:#2d6a4f}.s-transit{background:var(--peche);color:var(--rose-f)}
.s-attente{background:var(--lavande);color:#6a4a9f}.s-annule{background:#fff0f0;color:#c0392b}
.cmd-link{color:var(--rose-v);text-decoration:none;font-size:12px;transition:color .3s;display:inline-flex;align-items:center;gap:4px}
.cmd-link:hover{color:var(--rose-f)}
.pagination{display:flex;gap:6px;align-items:center;margin-top:24px;justify-content:center}
.pagination a,.pagination span{display:inline-flex;align-items:center;justify-content:center;min-width:36px;height:36px;padding:0 10px;border-radius:50px;font-size:13px;text-decoration:none;transition:var(--trans)}
.pagination a{background:var(--blanc);color:var(--texte);border:1.5px solid var(--peche)}
.pagination a:hover{border-color:var(--rose-v);color:var(--rose-v)}
.pagination .active{background:var(--rose-v);color:var(--blanc);border:1.5px solid var(--rose-v)}
.vide{text-align:center;padding:60px 0;color:var(--texte2)}
.vide i{font-size:40px;color:var(--peche2);margin-bottom:14px;display:block}
@media(max-width:700px){
    .page-hero{padding:32px 16px}
    .page-hero h1{font-size:24px}
    .account-layout{display:flex;flex-direction:column;gap:20px;padding:20px 14px}
    .account-sidebar{position:static;border-radius:14px;padding:20px 16px}
    .account-sidebar .acc-nav{display:flex;gap:6px;overflow-x:auto;-webkit-overflow-scrolling:touch;scrollbar-width:none;padding:2px 0 4px}
    .account-sidebar .acc-nav::-webkit-scrollbar{display:none}
    .account-sidebar .acc-nav li{margin:0;flex-shrink:0}
    .account-sidebar .acc-nav a{padding:8px 14px;font-size:11px;white-space:nowrap;border-radius:8px;gap:6px}
    .account-sidebar .acc-nav a i{font-size:11px}
    .account-sidebar .acc-nav a.on{font-weight:500}
    .acc-titre{font-size:20px}
    .cmd-scroll{overflow-x:auto;-webkit-overflow-scrolling:touch;margin:0 -14px;padding:0 14px 8px}
    .cmd-table{min-width:580px}
    .cmd-table th,.cmd-table td{padding:10px 8px;font-size:12px}
    .statut{font-size:9px;padding:3px 8px}
    .vide{padding:40px 0}
    .pagination{flex-wrap:wrap;gap:4px}
}
</style>
@endpush
@section('content')
<div class="page-hero">
    <span class="s-label">Espace Personnel</span>
    <h1 class="s-titre">Mes <em>Commandes</em></h1>
    <div class="breadcrumb"><a href="{{ route('home') }}">Accueil</a> <i class="fas fa-chevron-right" style="font-size:9px"></i> <a href="{{ route('account.index') }}">Mon Compte</a> <i class="fas fa-chevron-right" style="font-size:9px"></i> <span>Commandes</span></div>
</div>
<div class="account-layout">
    <aside class="account-sidebar">
        <ul class="acc-nav">
            <li><a href="{{ route('account.index') }}"><i class="fas fa-home"></i> Tableau de bord</a></li>
            <li><a href="{{ route('account.orders') }}" class="on"><i class="fas fa-box"></i> Mes commandes</a></li>
            <li><a href="{{ route('wishlist.index') }}"><i class="far fa-heart"></i> Ma wishlist</a></li>
            <li><a href="{{ route('account.addresses') }}"><i class="fas fa-map-marker-alt"></i> Mes adresses</a></li>
            <li><a href="{{ route('account.profile') }}"><i class="far fa-user"></i> Mon profil</a></li>
            <li><a href="{{ route('account.notifications') }}"><i class="fas fa-bell"></i> Notifications</a></li>
        </ul>
    </aside>
    <div>
        <h2 class="acc-titre">Toutes vos <em>commandes</em></h2>
        <p class="acc-sous">Suivez l'état de vos commandes et consultez leurs détails.</p>
        <div class="acc-bloc">
            <div class="cmd-scroll">
            <table class="cmd-table">
                <thead><tr><th>Commande</th><th>Date</th><th>Articles</th><th>Montant</th><th>Statut</th><th></th></tr></thead>
                <tbody>
                    @forelse($orders as $order)
                    @php
                        $statusMap = [
                            'pending'    => ['label'=>'En attente','class'=>'s-attente'],
                            'confirmed'  => ['label'=>'Confirmée','class'=>'s-attente'],
                            'processing' => ['label'=>'En cours','class'=>'s-attente'],
                            'shipped'    => ['label'=>'En transit','class'=>'s-transit'],
                            'delivered'  => ['label'=>'Livré','class'=>'s-livre'],
                            'cancelled'  => ['label'=>'Annulée','class'=>'s-annule'],
                        ];
                        $s = $statusMap[$order->status ?? 'pending'] ?? ['label'=>'En attente','class'=>'s-attente'];
                        $itemCount = is_array($order->items) ? array_sum(array_column($order->items, 'quantity')) : 0;
                    @endphp
                    <tr>
                        <td><strong>#{{ $order->order_number ?? strtoupper(substr((string)$order->_id, 6)) }}</strong></td>
                        <td>{{ $order->created_at?->format('d M. Y') ?? '—' }}</td>
                        <td>{{ $itemCount }} article(s)</td>
                        <td><strong>{{ number_format($order->total ?? 0, 0, ',', ' ') }} F CFA</strong></td>
                        <td><span class="statut {{ $s['class'] }}">{{ $s['label'] }}</span></td>
                        <td><a href="{{ route('account.order', $order->_id) }}" class="cmd-link">Détail <i class="fas fa-chevron-right" style="font-size:9px"></i></a></td>
                    </tr>
                    @empty
                    <tr><td colspan="6" class="vide">
                        <i class="fas fa-box-open"></i>
                        <p>Vous n'avez pas encore passé de commande.</p>
                        <a href="{{ route('shop.index') }}" class="btn btn-rose" style="margin-top:14px">Découvrir la boutique</a>
                    </td></tr>
                    @endforelse
                </tbody>
            </table>
            </div>
        </div>
        @if(method_exists($orders, 'links'))
            <div class="pagination">{{ $orders->links() }}</div>
        @endif
    </div>
</div>
@endsection
