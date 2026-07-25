@extends('layouts.app')
@section('title','Notifications — JEKP Store')
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
.notif-vide{text-align:center;padding:60px 20px;background:var(--blanc);border-radius:14px;border:1px solid var(--peche)}
.notif-vide i{font-size:48px;color:var(--peche2);margin-bottom:16px;display:block}
.notif-vide h3{font-family:var(--f-titre);font-size:22px;font-weight:300;color:var(--texte);margin-bottom:8px}
.notif-vide p{font-size:13px;color:var(--texte2);max-width:360px;margin:0 auto}
@media(max-width:900px){.page-hero{padding:36px 20px}.account-layout{grid-template-columns:1fr;padding:30px 16px}.account-sidebar{position:static}}
@media(max-width:600px){.page-hero h1{font-size:28px}.acc-titre{font-size:22px}.notif-vide{padding:40px 16px}}
</style>
@endpush
@section('content')
<div class="page-hero">
    <span class="s-label">Espace Personnel</span>
    <h1 class="s-titre">Mes <em>Notifications</em></h1>
    <div class="breadcrumb"><a href="{{ route('home') }}">Accueil</a> <i class="fas fa-chevron-right" style="font-size:9px"></i> <a href="{{ route('account.index') }}">Mon Compte</a> <i class="fas fa-chevron-right" style="font-size:9px"></i> <span>Notifications</span></div>
</div>
<div class="account-layout">
    <aside class="account-sidebar">
        <ul class="acc-nav">
            <li><a href="{{ route('account.index') }}"><i class="fas fa-home"></i> Tableau de bord</a></li>
            <li><a href="{{ route('account.orders') }}"><i class="fas fa-box"></i> Mes commandes</a></li>
            <li><a href="{{ route('wishlist.index') }}"><i class="far fa-heart"></i> Ma wishlist</a></li>
            <li><a href="{{ route('account.addresses') }}"><i class="fas fa-map-marker-alt"></i> Mes adresses</a></li>
            <li><a href="{{ route('account.profile') }}"><i class="far fa-user"></i> Mon profil</a></li>
            <li><a href="{{ route('account.notifications') }}" class="on"><i class="fas fa-bell"></i> Notifications</a></li>
        </ul>
    </aside>
    <div>
        <h2 class="acc-titre">Vos <em>notifications</em></h2>
        <p class="acc-sous">Restez informé de vos commandes et de nos nouveautés.</p>

        <div class="notif-vide">
            <i class="far fa-bell"></i>
            <h3>Aucune notification</h3>
            <p>Vous serez notifié lors de la mise à jour de vos commandes et des dernières nouveautés de la boutique.</p>
        </div>
    </div>
</div>
@endsection
