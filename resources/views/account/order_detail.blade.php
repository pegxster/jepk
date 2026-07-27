@extends('layouts.app')
@section('title','Détail Commande — JEKP Store')
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
.acc-titre{font-family:var(--f-titre);font-size:26px;font-weight:300;color:var(--texte);margin-bottom:4px}
.acc-sous{font-size:13px;color:var(--texte2);margin-bottom:24px}
.detail-card{background:var(--blanc);border-radius:14px;padding:26px;box-shadow:var(--ombre-sm);border:1px solid var(--peche);margin-bottom:20px}
.detail-card h3{font-family:var(--f-titre);font-size:18px;font-weight:300;color:var(--texte);margin-bottom:16px;padding-bottom:12px;border-bottom:1px solid var(--peche);display:flex;align-items:center;gap:8px}
.detail-card h3 i{color:var(--rose-v)}
.statut{padding:4px 12px;border-radius:50px;font-size:10px;font-weight:500;letter-spacing:.5px;display:inline-block}
.s-livre{background:#f0faf5;color:#2d6a4f}.s-transit{background:var(--peche);color:var(--rose-f)}
.s-attente{background:var(--lavande);color:#6a4a9f}.s-annule{background:#fff0f0;color:#c0392b}
.info-grid{display:grid;grid-template-columns:1fr 1fr;gap:16px}
.info-item label{font-size:10px;letter-spacing:2px;text-transform:uppercase;color:var(--texte2);display:block;margin-bottom:4px}
.info-item span{font-size:14px;color:var(--texte)}
.cmd-table{width:100%;border-collapse:collapse}
.cmd-table th{text-align:left;font-size:10px;letter-spacing:2px;text-transform:uppercase;color:var(--texte2);padding:8px 12px;border-bottom:1px solid var(--peche)}
.cmd-table td{padding:12px;border-bottom:1px solid var(--creme2);font-size:13px;color:var(--texte)}
.cmd-table tr:last-child td{border-bottom:none}
.total-row td{font-weight:600;font-size:15px;color:var(--brun-d);border-top:2px solid var(--peche);padding-top:14px}
.back-link{color:var(--rose-v);text-decoration:none;font-size:13px;display:inline-flex;align-items:center;gap:6px;transition:color .3s}
.back-link:hover{color:var(--rose-f)}
@media(max-width:900px){
    .page-hero{padding:36px 20px}
    .account-layout{grid-template-columns:1fr;padding:24px 16px;gap:20px}
    .account-sidebar{
        position:static;
        display:grid;grid-template-columns:auto 1fr;gap:0;align-items:center;
        padding:16px;border-radius:14px;
    }
    .account-sidebar .acc-nav{display:flex;gap:4px;overflow-x:auto;-webkit-overflow-scrolling:touch;padding:0 0 0 12px;scrollbar-width:none}
    .account-sidebar .acc-nav::-webkit-scrollbar{display:none}
    .account-sidebar .acc-nav li{margin-bottom:0;flex-shrink:0}
    .account-sidebar .acc-nav a{padding:8px 12px;font-size:11px;white-space:nowrap;border-radius:8px;gap:6px}
    .account-sidebar .acc-nav i{font-size:12px}
    .info-grid{grid-template-columns:1fr}
}
@media(max-width:600px){
    .page-hero h1{font-size:28px}
    .acc-titre{font-size:22px}
    .detail-card{padding:18px 14px}
    .detail-card h3{font-size:16px}
    .cmd-scroll{overflow-x:auto;-webkit-overflow-scrolling:touch;margin:0 -14px;padding:0 14px 8px}
    .cmd-table{min-width:420px}
    .cmd-table th,.cmd-table td{padding:10px 8px;font-size:12px}
    .back-link{font-size:12px}
}
@media(max-width:400px){
    .account-sidebar{grid-template-columns:1fr}
    .account-sidebar .acc-nav{justify-content:center;flex-wrap:wrap;padding:8px 0 0}
}
</style>
@endpush
@section('content')
<div class="page-hero">
    <span class="s-label">Espace Personnel</span>
    <h1 class="s-titre">Détail <em>Commande</em></h1>
    <div class="breadcrumb"><a href="{{ route('home') }}">Accueil</a> <i class="fas fa-chevron-right" style="font-size:9px"></i> <a href="{{ route('account.index') }}">Mon Compte</a> <i class="fas fa-chevron-right" style="font-size:9px"></i> <a href="{{ route('account.orders') }}">Commandes</a> <i class="fas fa-chevron-right" style="font-size:9px"></i> <span>Détail</span></div>
</div>
<div class="account-layout">
    <aside class="account-sidebar">
        <ul class="acc-nav">
            <li><a href="{{ route('account.index') }}"><i class="fas fa-home"></i> Tableau de bord</a></li>
            <li><a href="{{ route('account.orders') }}" class="on"><i class="fas fa-box"></i> Mes commandes</a></li>
            <li><a href="{{ route('wishlist.index') }}"><i class="far fa-heart"></i> Ma wishlist</a></li>
            <li><a href="{{ route('account.addresses') }}"><i class="fas fa-map-marker-alt"></i> Mes adresses</a></li>
            <li><a href="{{ route('account.profile') }}"><i class="far fa-user"></i> Mon profil</a></li>
        </ul>
    </aside>
    <div>
        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:20px">
            <div>
                <h2 class="acc-titre">Commande <em>#{{ $order->order_number ?? strtoupper(substr((string)$order->_id, 6)) }}</em></h2>
                <p class="acc-sous">Passée le {{ $order->created_at?->format('d M. Y à H\hi') ?? '—' }}</p>
            </div>
            <a href="{{ route('account.orders') }}" class="back-link"><i class="fas fa-arrow-left"></i> Retour aux commandes</a>
        </div>

        @php
            $statusMap = [
                'pending'    => ['label'=>'En attente','class'=>'s-attente'],
                'confirmed'  => ['label'=>'Confirmée','class'=>'s-attente'],
                'processing' => ['label'=>'En traitement','class'=>'s-attente'],
                'shipped'    => ['label'=>'Expédiée','class'=>'s-transit'],
                'delivered'  => ['label'=>'Livrée','class'=>'s-livre'],
                'cancelled'  => ['label'=>'Annulée','class'=>'s-annule'],
            ];
            $s = $statusMap[$order->status ?? 'pending'] ?? ['label'=>'En attente','class'=>'s-attente'];
        @endphp

        <div class="detail-card">
            <h3><i class="fas fa-info-circle"></i> Informations de la commande</h3>
            <div class="info-grid">
                <div class="info-item"><label>Statut</label><span class="statut {{ $s['class'] }}">{{ $s['label'] }}</span></div>
                <div class="info-item"><label>Moyen de paiement</label><span>{{ $order->payment_method ?? 'Wave' }}</span></div>
                <div class="info-item"><label>Email</label><span>{{ $order->customer_email ?? auth()->user()->email }}</span></div>
                <div class="info-item"><label>Téléphone</label><span>{{ $order->customer_phone ?? auth()->user()->telephone ?? '—' }}</span></div>
            </div>
        </div>

        @if($order->shipping_address)
        <div class="detail-card">
            <h3><i class="fas fa-map-marker-alt"></i> Adresse de livraison</h3>
            <div class="info-grid">
                <div class="info-item"><label>Nom</label><span>{{ $order->shipping_address['name'] ?? '—' }}</span></div>
                <div class="info-item"><label>Téléphone</label><span>{{ $order->shipping_address['phone'] ?? '—' }}</span></div>
                <div class="info-item" style="grid-column:1/-1"><label>Adresse</label><span>{{ $order->shipping_address['address'] ?? '—' }}, {{ $order->shipping_address['city'] ?? '' }} {{ $order->shipping_address['postal_code'] ?? '' }}</span></div>
            </div>
        </div>
        @endif

        <div class="detail-card">
            <h3><i class="fas fa-shopping-bag"></i> Articles commandés</h3>
            <div class="cmd-scroll">
            <table class="cmd-table">
                <thead><tr><th>Produit</th><th>Prix unitaire</th><th>Qté</th><th>Sous-total</th></tr></thead>
                <tbody>
                    @if(is_array($order->items))
                        @foreach($order->items as $item)
                        <tr>
                            <td style="display:flex;align-items:center;gap:12px">
                                @php $iImg = $item['image'] ?? null; @endphp
                                @if($iImg)
                                    <img src="{{ product_image_url($iImg) }}" alt="{{ $item['name'] ?? '' }}" style="width:48px;height:48px;object-fit:cover;border-radius:10px;flex-shrink:0">
                                @endif
                                <strong>{{ $item['name'] ?? 'Produit' }}</strong>
                            </td>
                            <td>{{ number_format($item['price'] ?? 0, 0, ',', ' ') }} F CFA</td>
                            <td>{{ $item['quantity'] ?? 1 }}</td>
                            <td><strong>{{ number_format(($item['price'] ?? 0) * ($item['quantity'] ?? 1), 0, ',', ' ') }} F CFA</strong></td>
                        </tr>
                        @endforeach
                    @else
                        <tr><td colspan="4" style="text-align:center;color:var(--texte2)">Aucun article</td></tr>
                    @endif
                    <tr class="total-row">
                        <td colspan="3" style="text-align:right">Sous-total</td>
                        <td>{{ number_format($order->subtotal ?? $order->total ?? 0, 0, ',', ' ') }} F CFA</td>
                    </tr>
                    @if(($order->shipping_cost ?? 0) > 0)
                    <tr>
                        <td colspan="3" style="text-align:right;color:var(--texte2)">Livraison</td>
                        <td>{{ number_format($order->shipping_cost, 0, ',', ' ') }} F CFA</td>
                    </tr>
                    @endif
                    @if(($order->discount ?? 0) > 0)
                    <tr>
                        <td colspan="3" style="text-align:right;color:#27ae60">Réduction</td>
                        <td style="color:#27ae60">-{{ number_format($order->discount, 0, ',', ' ') }} F CFA</td>
                    </tr>
                    @endif
                    <tr class="total-row">
                        <td colspan="3" style="text-align:right;font-size:16px">Total</td>
                        <td style="font-size:16px">{{ number_format($order->total ?? 0, 0, ',', ' ') }} F CFA</td>
                    </tr>
                </tbody>
            </table>
            </div>
        </div>

        @if($order->notes)
        <div class="detail-card">
            <h3><i class="fas fa-sticky-note"></i> Notes</h3>
            <p style="font-size:13px;color:var(--texte2);line-height:1.8">{{ $order->notes }}</p>
        </div>
        @endif
    </div>
</div>
@endsection
