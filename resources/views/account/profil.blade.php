@extends('layouts.app')
@section('title','Mon Profil — JEKP Store')
@push('styles')
<style>
.page-hero{background:linear-gradient(135deg,var(--creme2),var(--peche));padding:52px 50px;text-align:center;border-bottom:1px solid var(--peche)}
.account-layout{max-width:1100px;margin:0 auto;padding:60px 50px;display:grid;grid-template-columns:240px 1fr;gap:40px;align-items:start}
.account-sidebar{background:var(--blanc);border-radius:16px;padding:28px;box-shadow:var(--ombre-sm);position:sticky;top:100px}
.acc-nav{list-style:none}
.acc-nav li{margin-bottom:4px}
.acc-nav a{display:flex;align-items:center;gap:10px;padding:10px 14px;border-radius:9px;text-decoration:none;color:var(--texte2);font-size:13px;transition:var(--trans)}
.acc-nav a:hover,.acc-nav a.on{background:var(--peche);color:var(--rose-v)}
.acc-nav i{width:16px;text-align:center;font-size:13px}
.profil-card{background:var(--blanc);border-radius:14px;padding:30px;box-shadow:var(--ombre-sm);margin-bottom:22px}
.profil-titre{font-family:var(--f-titre);font-size:20px;font-weight:300;color:var(--texte);margin-bottom:20px;padding-bottom:14px;border-bottom:1px solid var(--peche);display:flex;align-items:center;gap:10px}
.profil-titre i{color:var(--rose-v)}
.profil-avatar-zone{display:flex;align-items:center;gap:24px;margin-bottom:28px;padding:18px;background:var(--creme2);border-radius:12px}
.profil-avatar{width:80px;height:80px;border-radius:50%;object-fit:cover;border:3px solid var(--peche2)}
.avatar-actions .btn{font-size:10px;padding:9px 18px;margin-bottom:8px;display:block;text-align:center}
.f-row{display:grid;grid-template-columns:1fr 1fr;gap:12px}
.f-g{margin-bottom:14px}
.f-g label{font-size:10px;letter-spacing:2px;text-transform:uppercase;color:var(--texte2);display:block;margin-bottom:6px;font-weight:500}
.f-g input,.f-g select{width:100%;padding:12px 15px;border:1.5px solid var(--peche);border-radius:10px;font-family:var(--f-corps);font-size:13.5px;color:var(--texte);outline:none;background:var(--creme2);transition:border-color .3s}
.f-g input:focus,.f-g select:focus{border-color:var(--rose-v);background:var(--blanc)}
@media(max-width:900px){.account-layout{grid-template-columns:1fr;padding:30px 24px}.account-sidebar{position:static}.f-row{grid-template-columns:1fr}}
</style>
@endpush
@section('content')
<div class="page-hero">
    <span class="s-label">Espace Personnel</span>
    <h1 class="s-titre">Mon <em>Profil</em></h1>
</div>
<div class="account-layout">
    <aside class="account-sidebar">
        <ul class="acc-nav">
            <li><a href="{{ route('account.index') }}"><i class="fas fa-home"></i> Tableau de bord</a></li>
            <li><a href="{{ route('account.orders') }}"><i class="fas fa-box"></i> Mes commandes</a></li>
            <li><a href="{{ route('wishlist.index') }}"><i class="far fa-heart"></i> Ma wishlist</a></li>
            <li><a href="{{ route('account.addresses') }}"><i class="fas fa-map-marker-alt"></i> Mes adresses</a></li>
            <li><a href="{{ route('account.profile') }}" class="on"><i class="far fa-user"></i> Mon profil</a></li>
        </ul>
    </aside>
    <div>
        <form action="{{ route('account.profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="profil-card">
                <h3 class="profil-titre"><i class="fas fa-camera"></i> Photo de profil</h3>
                <div class="profil-avatar-zone">
                    <img src="{{ auth()->user()->avatar ?? 'https://i.pravatar.cc/140?img=47' }}" class="profil-avatar" alt="Avatar">
                    <div class="avatar-actions">
                        <label class="btn btn-peche" style="cursor:pointer"><i class="fas fa-upload"></i> Changer la photo<input type="file" name="avatar" accept="image/*" style="display:none"></label>
                        <button type="button" class="btn btn-outline-rose" style="font-size:10px;padding:9px 18px">Supprimer</button>
                    </div>
                </div>
            </div>
            <div class="profil-card">
                <h3 class="profil-titre"><i class="fas fa-user"></i> Informations personnelles</h3>
                <div class="f-row">
                    <div class="f-g"><label>Prénom</label><input type="text" name="prenom" value="{{ auth()->user()->prenom ?? '' }}" placeholder="Marie"></div>
                    <div class="f-g"><label>Nom</label><input type="text" name="nom" value="{{ auth()->user()->nom ?? '' }}" placeholder="Dupont"></div>
                </div>
                <div class="f-g"><label>Email</label><input type="email" name="email" value="{{ auth()->user()->email ?? '' }}"></div>
                <div class="f-g"><label>Téléphone</label><input type="tel" name="telephone" value="{{ auth()->user()->telephone ?? '' }}" placeholder="+33 6 00 00 00 00"></div>
                <div class="f-g"><label>Date de naissance</label><input type="date" name="birthday" value="{{ auth()->user()->birthday ?? '' }}"></div>
                <button type="submit" class="btn btn-rose"><i class="fas fa-save"></i> Sauvegarder</button>
            </div>
            <div class="profil-card">
                <h3 class="profil-titre"><i class="fas fa-lock"></i> Changer le mot de passe</h3>
                <div class="f-g"><label>Mot de passe actuel</label><input type="password" name="current_password" placeholder="••••••••"></div>
                <div class="f-row">
                    <div class="f-g"><label>Nouveau mot de passe</label><input type="password" name="new_password" placeholder="8 caractères min."></div>
                    <div class="f-g"><label>Confirmer</label><input type="password" name="new_password_confirmation" placeholder="Confirmer…"></div>
                </div>
                <button type="submit" class="btn btn-outline-rose"><i class="fas fa-key"></i> Modifier le mot de passe</button>
            </div>
        </form>
    </div>
</div>
@endsection