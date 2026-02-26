@extends('layouts.app')
@section('title','Mon Compte — JEKP Store')
@push('styles')
<style>
.page-hero{background:linear-gradient(135deg,var(--creme2),var(--peche));padding:52px 50px;text-align:center;border-bottom:1px solid var(--peche)}
.breadcrumb{display:flex;gap:8px;align-items:center;font-size:11px;color:var(--texte2);justify-content:center;margin-top:14px}
.breadcrumb a{color:var(--texte2);text-decoration:none;transition:color .3s}.breadcrumb a:hover{color:var(--rose-v)}
.breadcrumb span{color:var(--rose-p)}
.account-layout{max-width:1200px;margin:0 auto;padding:60px 50px;display:grid;grid-template-columns:240px 1fr;gap:40px;align-items:start}
/* Sidebar compte */
.account-sidebar{background:var(--blanc);border-radius:16px;padding:28px;box-shadow:var(--ombre-sm);position:sticky;top:100px}
.acc-avatar{text-align:center;margin-bottom:24px;padding-bottom:22px;border-bottom:1px solid var(--peche)}
.acc-photo{width:70px;height:70px;border-radius:50%;object-fit:cover;border:3px solid var(--peche2);margin:0 auto 12px;display:block}
.acc-nom{font-family:var(--f-titre);font-size:18px;font-weight:300;color:var(--texte);margin-bottom:2px}
.acc-email{font-size:12px;color:var(--texte2)}
.acc-nav{list-style:none}
.acc-nav li{margin-bottom:4px}
.acc-nav a{display:flex;align-items:center;gap:10px;padding:10px 14px;border-radius:9px;text-decoration:none;color:var(--texte2);font-size:13px;transition:var(--trans)}
.acc-nav a:hover,.acc-nav a.on{background:var(--peche);color:var(--rose-v)}
.acc-nav a.on{font-weight:500}
.acc-nav i{width:16px;text-align:center;font-size:13px}
.acc-nav .deconnecter{color:var(--rose-v);margin-top:16px;padding-top:14px;border-top:1px solid var(--peche)}
/* Contenu compte */
.acc-titre{font-family:var(--f-titre);font-size:28px;font-weight:300;color:var(--texte);margin-bottom:6px}
.acc-sous{font-size:13px;color:var(--texte2);margin-bottom:32px}
/* Cartes stats */
.acc-stats{display:grid;grid-template-columns:repeat(3,1fr);gap:16px;margin-bottom:36px}
.acc-stat{background:var(--blanc);border-radius:14px;padding:22px;box-shadow:var(--ombre-sm);text-align:center;border:1px solid var(--peche)}
.acc-stat-n{font-family:var(--f-titre);font-size:34px;font-weight:300;color:var(--rose-v);font-style:italic;display:block;line-height:1}
.acc-stat-l{font-size:11px;color:var(--texte2);letter-spacing:1px;margin-top:6px;display:block}
/* Commandes */
.commandes-titre{font-size:14px;font-weight:500;color:var(--texte);margin-bottom:16px}
.cmd-table{width:100%;border-collapse:collapse}
.cmd-table th{text-align:left;font-size:10px;letter-spacing:2px;text-transform:uppercase;color:var(--texte2);padding:10px 14px;border-bottom:1.5px solid var(--peche)}
.cmd-table td{padding:16px 14px;border-bottom:1px solid var(--creme2);font-size:13px;color:var(--texte)}
.cmd-table tr:hover td{background:var(--creme2)}
.cmd-table tr:last-child td{border-bottom:none}
.statut{padding:4px 12px;border-radius:50px;font-size:10px;font-weight:500;letter-spacing:1px}
.s-livre{background:#f0faf5;color:#3a7d5a}
.s-transit{background:var(--peche);color:var(--rose-f)}
.s-attente{background:var(--lavande);color:var(--lavande2)}
.cmd-link{color:var(--rose-v);text-decoration:none;font-size:12px;transition:color .3s}
.cmd-link:hover{color:var(--rose-f)}
@media(max-width:900px){.account-layout{grid-template-columns:1fr;padding:30px 24px}.account-sidebar{position:static}.acc-stats{grid-template-columns:1fr 1fr}}
@media(max-width:500px){.acc-stats{grid-template-columns:1fr}}
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
            <img src="https://i.pravatar.cc/140?img=47" class="acc-photo" alt="Mon profil">
            <div class="acc-nom">{{ auth()->user()->name ?? 'Marie Dupont' }}</div>
            <div class="acc-email">{{ auth()->user()->email ?? 'marie@email.com' }}</div>
        </div>
        <ul class="acc-nav">
            <li><a href="{{ route('account.index') }}" class="on"><i class="fas fa-home"></i> Tableau de bord</a></li>
            <li><a href="{{ route('account.orders') }}"><i class="fas fa-box"></i> Mes commandes</a></li>
            <li><a href="{{ route('wishlist.index') }}"><i class="far fa-heart"></i> Ma wishlist</a></li>
            <li><a href="{{ route('account.addresses') }}"><i class="fas fa-map-marker-alt"></i> Mes adresses</a></li>
            <li><a href="{{ route('account.profile') }}"><i class="far fa-user"></i> Mon profil</a></li>
            <li><a href="#"><i class="fas fa-bell"></i> Notifications</a></li>
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
        <h2 class="acc-titre">Bonjour, <em>{{ auth()->user()->prenom ?? 'Marie' }}</em> !</h2>
        <p class="acc-sous">Bienvenue dans votre espace personnel JEKP Store.</p>

        <div class="acc-stats">
            <div class="acc-stat">
                <span class="acc-stat-n">{{ $ordersCount ?? '12' }}</span>
                <span class="acc-stat-l">Commandes</span>
            </div>
            <div class="acc-stat">
                <span class="acc-stat-n">{{ $wishlistCount ?? '8' }}</span>
                <span class="acc-stat-l">Articles favoris</span>
            </div>
            <div class="acc-stat">
                <span class="acc-stat-n">{{ $pointsFidelite ?? '240' }}</span>
                <span class="acc-stat-l">Points fidélité</span>
            </div>
        </div>

        <div style="background:var(--blanc);border-radius:14px;padding:26px;box-shadow:var(--ombre-sm)">
            <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:16px">
                <div class="commandes-titre">Mes dernières commandes</div>
                <a href="{{ route('account.orders') }}" class="cmd-link">Voir tout →</a>
            </div>
            <table class="cmd-table">
                <thead>
                    <tr><th>Commande</th><th>Date</th><th>Montant</th><th>Statut</th><th></th></tr>
                </thead>
                <tbody>
                    <tr><td>#JEKP-2401</td><td>18 Fév. 2024</td><td>68,00 €</td><td><span class="statut s-livre">Livré</span></td><td><a href="#" class="cmd-link">Détail →</a></td></tr>
                    <tr><td>#JEKP-2398</td><td>05 Fév. 2024</td><td>45,50 €</td><td><span class="statut s-transit">En transit</span></td><td><a href="#" class="cmd-link">Suivre →</a></td></tr>
                    <tr><td>#JEKP-2385</td><td>20 Jan. 2024</td><td>112,00 €</td><td><span class="statut s-livre">Livré</span></td><td><a href="#" class="cmd-link">Détail →</a></td></tr>
                    <tr><td>#JEKP-2370</td><td>08 Jan. 2024</td><td>29,90 €</td><td><span class="statut s-attente">En cours</span></td><td><a href="#" class="cmd-link">Détail →</a></td></tr>
                </tbody>
            </table>
        </div>

        <div style="background:linear-gradient(135deg,var(--peche),var(--lavande));border-radius:14px;padding:26px;margin-top:20px">
            <div style="font-family:var(--f-titre);font-size:20px;font-weight:300;color:var(--texte);margin-bottom:6px">Une idée de création ?</div>
            <p style="font-size:13px;color:var(--texte2);margin-bottom:18px">Demandez une création sur mesure et nous la réalisons rien que pour vous.</p>
            <a href="{{ route('home') }}#sur-mesure" class="btn btn-rose">Demander sur mesure</a>
        </div>
    </div>
</div>
@endsection