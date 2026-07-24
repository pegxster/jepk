@extends('layouts.app')
@section('title','Mes Adresses — JEKP Store')
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
.addr-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(280px,1fr));gap:20px;margin-top:20px}
.addr-card{background:var(--blanc);border-radius:14px;padding:24px;border:1.5px solid var(--peche);position:relative;transition:var(--trans)}
.addr-card:hover{border-color:var(--rose-p);box-shadow:var(--ombre-sm)}
.addr-card.default{border-color:var(--rose-v);background:linear-gradient(135deg,#fff5f7,var(--blanc))}
.addr-label{font-size:10px;letter-spacing:2px;text-transform:uppercase;color:var(--rose-v);margin-bottom:8px;display:flex;align-items:center;justify-content:space-between}
.addr-label .defaut{background:var(--rose-v);color:var(--blanc);padding:2px 8px;border-radius:50px;font-size:9px;letter-spacing:1px}
.addr-name{font-family:var(--f-titre);font-size:17px;font-weight:300;color:var(--texte);margin-bottom:6px}
.addr-text{font-size:13px;color:var(--texte2);line-height:1.7;margin-bottom:12px}
.addr-actions{display:flex;gap:8px;flex-wrap:wrap}
.addr-actions button,.addr-actions a{font-size:11px;padding:6px 12px;border-radius:50px;border:1px solid var(--peche);background:var(--blanc);color:var(--texte2);cursor:pointer;transition:var(--trans);text-decoration:none;font-family:var(--f-corps)}
.addr-actions button:hover,.addr-actions a:hover{border-color:var(--rose-v);color:var(--rose-v)}
.addr-actions .del{border-color:#f5baba;color:#c0392b}.addr-actions .del:hover{background:#fff0f0}
.add-card{background:var(--creme2);border:2px dashed var(--peche2);border-radius:14px;padding:24px;display:flex;flex-direction:column;align-items:center;justify-content:center;cursor:pointer;transition:var(--trans);min-height:200px}
.add-card:hover{border-color:var(--rose-v);background:var(--creme)}
.add-card i{font-size:28px;color:var(--peche2);margin-bottom:10px}
.add-card span{font-size:13px;color:var(--texte2)}
.form-card{background:var(--blanc);border-radius:16px;padding:30px;box-shadow:var(--ombre-sm);border:1px solid var(--peche);margin-top:24px}
.form-card h3{font-family:var(--f-titre);font-size:20px;font-weight:300;color:var(--texte);margin-bottom:20px;padding-bottom:12px;border-bottom:1px solid var(--peche);display:flex;align-items:center;gap:8px}
.form-card h3 i{color:var(--rose-v)}
.f-row{display:grid;grid-template-columns:1fr 1fr;gap:12px}
.f-g{margin-bottom:14px}
.f-g label{font-size:10px;letter-spacing:2px;text-transform:uppercase;color:var(--texte2);display:block;margin-bottom:6px;font-weight:500}
.f-g input,.f-g select{width:100%;padding:12px 15px;border:1.5px solid var(--peche);border-radius:10px;font-family:var(--f-corps);font-size:13.5px;color:var(--texte);outline:none;background:var(--creme2);transition:border-color .3s}
.f-g input:focus,.f-g select:focus{border-color:var(--rose-v);background:var(--blanc)}
.f-g .f-error{color:#e74c3c;font-size:11px;margin-top:4px}
@media(max-width:900px){.account-layout{grid-template-columns:1fr;padding:30px 24px}.account-sidebar{position:static}.f-row{grid-template-columns:1fr}}
</style>
@endpush
@section('content')
<div class="page-hero">
    <span class="s-label">Espace Personnel</span>
    <h1 class="s-titre">Mes <em>Adresses</em></h1>
    <div class="breadcrumb"><a href="{{ route('home') }}">Accueil</a> <i class="fas fa-chevron-right" style="font-size:9px"></i> <a href="{{ route('account.index') }}">Mon Compte</a> <i class="fas fa-chevron-right" style="font-size:9px"></i> <span>Adresses</span></div>
</div>
<div class="account-layout">
    <aside class="account-sidebar">
        <ul class="acc-nav">
            <li><a href="{{ route('account.index') }}"><i class="fas fa-home"></i> Tableau de bord</a></li>
            <li><a href="{{ route('account.orders') }}"><i class="fas fa-box"></i> Mes commandes</a></li>
            <li><a href="{{ route('wishlist.index') }}"><i class="far fa-heart"></i> Ma wishlist</a></li>
            <li><a href="{{ route('account.addresses') }}" class="on"><i class="fas fa-map-marker-alt"></i> Mes adresses</a></li>
            <li><a href="{{ route('account.profile') }}"><i class="far fa-user"></i> Mon profil</a></li>
        </ul>
    </aside>
    <div>
        <h2 class="acc-titre">Vos <em>adresses</em></h2>
        <p class="acc-sous">Gérez vos adresses de livraison et de facturation.</p>

        <div class="addr-grid">
            @forelse($addresses as $addr)
            <div class="addr-card {{ ($addr['is_default'] ?? false) ? 'default' : '' }}">
                <div class="addr-label">
                    {{ $addr['label'] ?? 'Adresse' }}
                    @if($addr['is_default'] ?? false)<span class="defaut">Par défaut</span>@endif
                </div>
                <div class="addr-name">{{ $addr['name'] ?? '' }}</div>
                <div class="addr-text">
                    {{ $addr['address'] ?? '' }}<br>
                    {{ $addr['postal_code'] ?? '' }} {{ $addr['city'] ?? '' }}<br>
                    {{ $addr['country'] ?? '' }}
                    @if(!empty($addr['phone']))<br>Tél : {{ $addr['phone'] }}@endif
                </div>
                <div class="addr-actions">
                    @unless($addr['is_default'] ?? false)
                    <form action="{{ route('account.addresses.default', $addr['id']) }}" method="POST" style="display:inline">
                        @csrf <button type="submit">Définir par défaut</button>
                    </form>
                    @endunless
                    <form action="{{ route('account.addresses.destroy', $addr['id']) }}" method="POST" onsubmit="return confirm('Supprimer cette adresse ?')" style="display:inline">
                        @csrf @method('DELETE') <button type="submit" class="del"><i class="fas fa-trash"></i> Supprimer</button>
                    </form>
                </div>
            </div>
            @empty
            @endforelse

            <div class="add-card" onclick="document.getElementById('addForm').scrollIntoView({behavior:'smooth'})">
                <i class="fas fa-plus"></i>
                <span>Ajouter une adresse</span>
            </div>
        </div>

        <div class="form-card" id="addForm">
            <h3><i class="fas fa-plus-circle"></i> Ajouter une adresse</h3>
            <form action="{{ route('account.addresses.store') }}" method="POST">
                @csrf
                <div class="f-row">
                    <div class="f-g">
                        <label>Label *</label>
                        <input type="text" name="label" value="{{ old('label', 'Domicile') }}" placeholder="Domicile, Bureau..." required>
                        @error('label')<div class="f-error">{{ $message }}</div>@enderror
                    </div>
                    <div class="f-g">
                        <label>Nom complet *</label>
                        <input type="text" name="name" value="{{ old('name', auth()->user()->full_name) }}" required>
                        @error('name')<div class="f-error">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="f-g">
                    <label>Adresse *</label>
                    <input type="text" name="address" value="{{ old('address') }}" placeholder="Rue, numéro, quartier..." required>
                    @error('address')<div class="f-error">{{ $message }}</div>@enderror
                </div>
                <div class="f-row">
                    <div class="f-g">
                        <label>Ville *</label>
                        <input type="text" name="city" value="{{ old('city') }}" placeholder="Abidjan" required>
                        @error('city')<div class="f-error">{{ $message }}</div>@enderror
                    </div>
                    <div class="f-g">
                        <label>Code postal</label>
                        <input type="text" name="postal_code" value="{{ old('postal_code') }}" placeholder="01 BP...">
                    </div>
                </div>
                <div class="f-row">
                    <div class="f-g">
                        <label>Pays *</label>
                        <input type="text" name="country" value="{{ old('country', 'Côte d\'Ivoire') }}" required>
                        @error('country')<div class="f-error">{{ $message }}</div>@enderror
                    </div>
                    <div class="f-g">
                        <label>Téléphone</label>
                        <input type="tel" name="phone" value="{{ old('phone') }}" placeholder="+225 01 02 03 04 05">
                    </div>
                </div>
                <button type="submit" class="btn btn-rose"><i class="fas fa-save"></i> Enregistrer l'adresse</button>
            </form>
        </div>
    </div>
</div>
@endsection
