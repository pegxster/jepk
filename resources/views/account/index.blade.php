@extends('layouts.app')
@section('title','Mon Compte — JEKP Store')
@push('styles')
<style>
/* ── Hero ── */
.page-hero{
    background:linear-gradient(135deg,var(--creme2) 0%,var(--blanc) 50%,var(--peche) 100%);
    padding:60px 50px;text-align:center;border-bottom:1px solid var(--peche);
    position:relative;overflow:hidden;
}
.page-hero::before{content:'';position:absolute;right:-100px;top:-100px;
    width:320px;height:320px;border-radius:50%;
    background:linear-gradient(135deg,var(--peche),var(--rose-p));opacity:.1;pointer-events:none}
.breadcrumb{display:flex;gap:8px;align-items:center;font-size:11px;color:var(--texte2);justify-content:center;margin-top:14px}
.breadcrumb a{color:var(--texte2);text-decoration:none;transition:color .3s}.breadcrumb a:hover{color:var(--rose-v)}
.breadcrumb span{color:var(--rose-p)}

/* ── Layout ── */
.account-layout{max-width:1200px;margin:0 auto;padding:60px 50px;
    display:grid;grid-template-columns:260px 1fr;gap:36px;align-items:start}

/* ── Sidebar ── */
.account-sidebar{background:var(--blanc);border-radius:18px;padding:28px;
    box-shadow:var(--ombre-sm);position:sticky;top:100px;border:1px solid var(--peche)}
.acc-avatar{text-align:center;margin-bottom:22px;padding-bottom:20px;border-bottom:1px solid var(--peche)}
.acc-initiale{width:72px;height:72px;border-radius:50%;
    background:linear-gradient(135deg,var(--peche),var(--rose-p));
    display:flex;align-items:center;justify-content:center;margin:0 auto 12px;
    font-family:var(--f-titre);font-size:28px;font-weight:300;color:var(--blanc);
    box-shadow:0 4px 16px rgba(201,112,128,.3)}
.acc-nom{font-family:var(--f-titre);font-size:18px;font-weight:300;color:var(--texte);margin-bottom:2px}
.acc-email{font-size:11px;color:var(--texte2)}
.acc-nav{list-style:none}
.acc-nav li{margin-bottom:3px}
.acc-nav a{display:flex;align-items:center;gap:10px;padding:10px 14px;border-radius:10px;
    text-decoration:none;color:var(--texte2);font-size:13px;transition:var(--trans)}
.acc-nav a:hover,.acc-nav a.on{background:var(--peche);color:var(--rose-v)}
.acc-nav a.on{font-weight:500}
.acc-nav i{width:16px;text-align:center;font-size:13px;flex-shrink:0}

/* ── Stats ── */
.acc-stats{display:grid;grid-template-columns:repeat(3,1fr);gap:14px;margin-bottom:28px}
.acc-stat{border-radius:14px;padding:22px 16px;text-align:center;
    border:1px solid var(--peche);position:relative;overflow:hidden;transition:var(--trans)}
.acc-stat:hover{transform:translateY(-3px);box-shadow:var(--ombre-sm)}
.acc-stat:nth-child(1){background:linear-gradient(135deg,#fff5f7,var(--creme2))}
.acc-stat:nth-child(2){background:linear-gradient(135deg,#f5f0ff,var(--creme2))}
.acc-stat:nth-child(3){background:linear-gradient(135deg,#fff8f0,var(--creme2))}
.acc-stat-icone{font-size:20px;margin-bottom:10px;display:block}
.acc-stat:nth-child(1) .acc-stat-icone{color:var(--rose-v)}
.acc-stat:nth-child(2) .acc-stat-icone{color:var(--lavande2)}
.acc-stat:nth-child(3) .acc-stat-icone{color:#e8a030}
.acc-stat-n{font-family:var(--f-titre);font-size:32px;font-weight:300;color:var(--texte);
    font-style:italic;display:block;line-height:1;margin-bottom:6px}
.acc-stat-l{font-size:11px;color:var(--texte2);letter-spacing:0.5px;display:block}

/* ── Bloc commandes ── */
.acc-bloc{background:var(--blanc);border-radius:14px;padding:26px;
    box-shadow:var(--ombre-sm);border:1px solid var(--peche)}
.acc-bloc-header{display:flex;justify-content:space-between;align-items:center;
    margin-bottom:18px;padding-bottom:14px;border-bottom:1px solid var(--peche)}
.acc-bloc-titre{font-family:var(--f-titre);font-size:19px;font-weight:300;color:var(--texte)}
.cmd-table{width:100%;border-collapse:collapse}
.cmd-table th{text-align:left;font-size:10px;letter-spacing:2px;text-transform:uppercase;
    color:var(--texte2);padding:8px 12px;border-bottom:1px solid var(--peche)}
.cmd-table td{padding:14px 12px;border-bottom:1px solid var(--creme2);font-size:13px;color:var(--texte)}
.cmd-table tr:hover td{background:var(--creme2);border-radius:8px}
.cmd-table tr:last-child td{border-bottom:none}
.statut{padding:4px 12px;border-radius:50px;font-size:10px;font-weight:500;letter-spacing:0.5px;display:inline-block}
.s-livre{background:#f0faf5;color:#2d6a4f}
.s-transit{background:var(--peche);color:var(--rose-f)}
.s-attente{background:var(--lavande);color:#6a4a9f}
.s-annule{background:#fff0f0;color:#c0392b}
.acc-titre{font-family:var(--f-titre);font-size:26px;font-weight:300;color:var(--texte);margin-bottom:4px}
.acc-sous{font-size:13px;color:var(--texte2);margin-bottom:24px}
.cmd-link{color:var(--rose-v);text-decoration:none;font-size:12px;transition:color .3s;
    display:inline-flex;align-items:center;gap:4px}
.cmd-link:hover{color:var(--rose-f)}

/* ── CTA sur mesure ── */
.acc-cta{border-radius:14px;padding:26px;margin-top:20px;
    background:linear-gradient(135deg,var(--peche) 0%,var(--lavande) 100%);
    display:flex;align-items:center;justify-content:space-between;gap:20px;flex-wrap:wrap}
.acc-cta-txt h3{font-family:var(--f-titre);font-size:20px;font-weight:300;color:var(--texte);margin-bottom:4px}
.acc-cta-txt p{font-size:13px;color:var(--texte2)}

@media(max-width:900px){.account-layout{grid-template-columns:1fr;padding:24px 16px}.account-sidebar{position:static}.acc-stats{grid-template-columns:1fr 1fr}.page-hero{padding:36px 20px}.cmd-table{font-size:12px}.cmd-table th,.cmd-table td{padding:10px 8px}}
@media(max-width:500px){.acc-stats{grid-template-columns:1fr}.acc-cta{flex-direction:column;text-align:center}}
</style>
@endpush
@section('content')
<div class="page-hero">
    <span class="s-label">Espace Personnel</span>
    <h1 class="s-titre">Mon <em>Compte</em></h1>
    <div class="breadcrumb"><a href="{{ route('home') }}">Accueil</a> <i class="fas fa-chevron-right" style="font-size:9px"></i> <span>Mon Compte</span></div>
</div>

<div class="account-layout">
    <aside class="account-sidebar">
        <div class="acc-avatar">
            @if(auth()->user()->avatar)
                <img src="{{ auth()->user()->avatar_url }}" style="width:72px;height:72px;border-radius:50%;object-fit:cover;border:3px solid var(--peche2);margin:0 auto 12px;display:block" alt="">
            @else
                <div class="acc-initiale">{{ strtoupper(substr(auth()->user()->prenom ?? auth()->user()->name ?? 'C', 0, 1)) }}</div>
            @endif
            <div class="acc-nom">{{ auth()->user()->full_name }}</div>
            <div class="acc-email">{{ auth()->user()->email }}</div>
        </div>
        <ul class="acc-nav">
            <li><a href="{{ route('account.index') }}" class="on"><i class="fas fa-home"></i> Tableau de bord</a></li>
            <li><a href="{{ route('account.orders') }}"><i class="fas fa-box"></i> Mes commandes</a></li>
            <li><a href="{{ route('wishlist.index') }}"><i class="far fa-heart"></i> Ma wishlist</a></li>
            <li><a href="{{ route('account.addresses') }}"><i class="fas fa-map-marker-alt"></i> Mes adresses</a></li>
            <li><a href="{{ route('account.profile') }}"><i class="far fa-user"></i> Mon profil</a></li>
            <li><a href="{{ route('account.notifications') }}"><i class="fas fa-bell"></i> Notifications</a></li>
            <li>
                <form action="{{ route('auth.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="acc-nav-btn deconnecter" style="width:100%;background:none;border:none;cursor:pointer;display:flex;align-items:center;gap:10px;padding:10px 14px;border-radius:9px;color:var(--rose-v);font-size:13px;font-family:var(--f-corps);margin-top:16px;padding-top:14px;border-top:1px solid var(--peche)">
                        <i class="fas fa-sign-out-alt" style="width:16px;text-align:center"></i> Déconnexion
                    </button>
                </form>
            </li>
        </ul>
    </aside>

    <div class="account-content">
        @if(session('success'))
            <div style="background:#f0faf5;border:1px solid #a8d5be;color:#2d6a4f;padding:14px 18px;border-radius:10px;margin-bottom:20px;font-size:13px">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif
        <h2 class="acc-titre">Bonjour, <em>{{ auth()->user()->prenom_display }}</em> !</h2>
        <p class="acc-sous">Bienvenue dans votre espace personnel JEKP Store.</p>

        <div class="acc-stats">
            <div class="acc-stat">
                <span class="acc-stat-icone"><i class="fas fa-box"></i></span>
                <span class="acc-stat-n">{{ $ordersCount ?? '12' }}</span>
                <span class="acc-stat-l">Commandes</span>
            </div>
            <div class="acc-stat">
                <span class="acc-stat-icone"><i class="far fa-heart"></i></span>
                <span class="acc-stat-n">{{ $wishlistCount ?? '8' }}</span>
                <span class="acc-stat-l">Favoris</span>
            </div>
            <div class="acc-stat">
                <span class="acc-stat-icone"><i class="fas fa-star"></i></span>
                <span class="acc-stat-n">{{ auth()->user()->loyalty_points ?? 0 }}</span>
                <span class="acc-stat-l">Points fidélité</span>
            </div>
        </div>

        <div class="acc-bloc">
            <div class="acc-bloc-header">
                <span class="acc-bloc-titre">Dernières commandes</span>
                <a href="{{ route('account.orders') }}" class="cmd-link">Tout voir <i class="fas fa-chevron-right" style="font-size:9px"></i></a>
            </div>
            <table class="cmd-table">
                <thead>
                    <tr><th>Commande</th><th>Date</th><th>Montant</th><th>Statut</th><th></th></tr>
                </thead>
                <tbody>
                    @forelse($recentOrders as $order)
                    @php
                        $statusMap = [
                            'pending'    => ['label' => 'En attente',   'class' => 's-attente'],
                            'confirmed'  => ['label' => 'Confirmée',    'class' => 's-attente'],
                            'processing' => ['label' => 'En cours',     'class' => 's-attente'],
                            'shipped'    => ['label' => 'En transit',   'class' => 's-transit'],
                            'delivered'  => ['label' => 'Livré',        'class' => 's-livre'],
                            'cancelled'  => ['label' => 'Annulée',      'class' => 's-annule'],
                        ];
                        $s = $statusMap[$order->status ?? 'pending'] ?? ['label' => 'En attente', 'class' => 's-attente'];
                    @endphp
                    <tr>
                        <td>#{{ $order->order_number ?? strtoupper(substr((string)$order->_id, -6)) }}</td>
                        <td>{{ $order->created_at?->format('d M. Y') ?? '—' }}</td>
                        <td>{{ number_format($order->total ?? 0, 0, ',', ' ') }} F CFA</td>
                        <td><span class="statut {{ $s['class'] }}">{{ $s['label'] }}</span></td>
                        <td><a href="{{ route('account.order', $order->_id) }}" class="cmd-link">Détail →</a></td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" style="text-align:center;padding:30px;color:var(--texte2)">
                            <i class="fas fa-box-open" style="font-size:22px;display:block;margin-bottom:8px;opacity:.4"></i>
                            Vous n'avez pas encore passé de commande.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="acc-cta">
            <div class="acc-cta-txt">
                <h3>Une idée de création ?</h3>
                <p>Demandez une création sur mesure, rien que pour vous.</p>
            </div>
            <a href="{{ route('home') }}#sur-mesure" class="btn btn-rose">
                <i class="fas fa-magic"></i> Demander sur mesure
            </a>
        </div>
    </div>
</div>
@endsection