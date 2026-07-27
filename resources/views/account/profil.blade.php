@extends('layouts.app')
@section('title','Mon Profil — JEKP Store')
@push('styles')
<style>
.page-hero{
    background:linear-gradient(135deg,var(--creme2) 0%,var(--blanc) 50%,var(--peche) 100%);
    padding:60px 50px;text-align:center;border-bottom:1px solid var(--peche);
    position:relative;overflow:hidden;
}
.page-hero::before{content:'';position:absolute;right:-100px;top:-100px;
    width:320px;height:320px;border-radius:50%;
    background:linear-gradient(135deg,var(--peche),var(--rose-p));opacity:.1;pointer-events:none}
.account-layout{max-width:1100px;margin:0 auto;padding:60px 50px;
    display:grid;grid-template-columns:260px 1fr;gap:36px;align-items:start}
.account-sidebar{background:var(--blanc);border-radius:18px;padding:28px;
    box-shadow:var(--ombre-sm);position:sticky;top:100px;border:1px solid var(--peche)}
.acc-nav{list-style:none}
.acc-nav li{margin-bottom:4px}
.acc-nav a{display:flex;align-items:center;gap:10px;padding:10px 14px;border-radius:9px;text-decoration:none;color:var(--texte2);font-size:13px;transition:var(--trans)}
.acc-nav a:hover,.acc-nav a.on{background:var(--peche);color:var(--rose-v)}
.acc-nav i{width:16px;text-align:center;font-size:13px}
.profil-card{background:var(--blanc);border-radius:16px;padding:30px;
    box-shadow:var(--ombre-sm);margin-bottom:22px;border:1px solid var(--peche)}
.profil-titre{font-family:var(--f-titre);font-size:20px;font-weight:300;color:var(--texte);margin-bottom:20px;padding-bottom:14px;border-bottom:1px solid var(--peche);display:flex;align-items:center;gap:10px}
.profil-titre i{color:var(--rose-v)}
.profil-avatar-zone{display:flex;align-items:center;gap:24px;margin-bottom:28px;padding:18px;background:var(--creme2);border-radius:12px}
.profil-avatar{width:80px;height:80px;border-radius:50%;object-fit:cover;border:3px solid var(--peche2)}
.avatar-initiale{width:80px;height:80px;border-radius:50%;background:linear-gradient(135deg,var(--peche),var(--rose-p));display:flex;align-items:center;justify-content:center;font-family:var(--f-titre);font-size:32px;font-weight:300;color:var(--blanc);flex-shrink:0}
.avatar-actions .btn{font-size:10px;padding:9px 18px;margin-bottom:8px;display:block;text-align:center;cursor:pointer}
.f-row{display:grid;grid-template-columns:1fr 1fr;gap:12px}
.f-g{margin-bottom:14px}
.f-g label{font-size:10px;letter-spacing:2px;text-transform:uppercase;color:var(--texte2);display:block;margin-bottom:6px;font-weight:500}
.f-g input,.f-g select{width:100%;padding:12px 15px;border:1.5px solid var(--peche);border-radius:10px;font-family:var(--f-corps);font-size:13.5px;color:var(--texte);outline:none;background:var(--creme2);transition:border-color .3s}
.f-g input:focus,.f-g select:focus{border-color:var(--rose-v);background:var(--blanc)}
.f-g .f-error{color:#e74c3c;font-size:11px;margin-top:4px}
.alert-ok{background:#f0faf5;border:1px solid #a8d5be;color:#2d6a4f;padding:14px 18px;border-radius:10px;margin-bottom:20px;font-size:13px}
.alert-err{background:#fff0f0;border:1px solid #f5baba;color:#c0392b;padding:14px 18px;border-radius:10px;margin-bottom:20px;font-size:13px}
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
    .f-row{grid-template-columns:1fr}
    .profil-card{padding:20px 16px}
    .profil-avatar-zone{flex-direction:column;text-align:center}
}
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
        {{-- Alerts --}}
        @if(session('success'))
            <div class="alert-ok"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
        @endif
        @if($errors->any())
            <div class="alert-err"><i class="fas fa-exclamation-triangle"></i>
                @foreach($errors->all() as $e) {{ $e }}<br> @endforeach
            </div>
        @endif

        {{-- Formulaire 1 : Profil + Avatar --}}
        <form action="{{ route('account.profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')

            <div class="profil-card">
                <h3 class="profil-titre"><i class="fas fa-camera"></i> Photo de profil</h3>
                <div class="profil-avatar-zone">
                    @if(auth()->user()->avatar)
                        <img id="avatarPreview" src="{{ auth()->user()->avatar_url }}" class="profil-avatar" alt="Avatar">
                    @else
                        <div class="avatar-initiale" id="avatarInitiale">
                            {{ strtoupper(substr(auth()->user()->prenom ?? auth()->user()->name ?? 'C', 0, 1)) }}
                        </div>
                        <img id="avatarPreview" src="" class="profil-avatar" style="display:none" alt="Avatar">
                    @endif
                    <div class="avatar-actions">
                        <label class="btn btn-peche avatar-actions">
                            <i class="fas fa-upload"></i> Changer la photo
                            <input type="file" name="avatar" accept="image/*" style="display:none" onchange="previewAvatar(this)">
                        </label>
                    </div>
                </div>
            </div>

            <div class="profil-card">
                <h3 class="profil-titre"><i class="fas fa-user"></i> Informations personnelles</h3>
                <div class="f-row">
                    <div class="f-g">
                        <label>Prénom *</label>
                        <input type="text" name="prenom" value="{{ old('prenom', auth()->user()->prenom) }}" placeholder="Marie" required>
                        @error('prenom')<div class="f-error">{{ $message }}</div>@enderror
                    </div>
                    <div class="f-g">
                        <label>Nom *</label>
                        <input type="text" name="nom" value="{{ old('nom', auth()->user()->nom) }}" placeholder="Dupont" required>
                        @error('nom')<div class="f-error">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="f-g">
                    <label>Email *</label>
                    <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}" required>
                    @error('email')<div class="f-error">{{ $message }}</div>@enderror
                </div>
                <div class="f-row">
                    <div class="f-g">
                        <label>Téléphone</label>
                        <input type="tel" name="telephone" value="{{ old('telephone', auth()->user()->telephone) }}" placeholder="+33 6 00 00 00 00">
                    </div>
                    <div class="f-g">
                        <label>Date de naissance</label>
                        <input type="date" name="birthday" value="{{ old('birthday', auth()->user()->birthday) }}">
                    </div>
                </div>
                <button type="submit" class="btn btn-rose"><i class="fas fa-save"></i> Sauvegarder le profil</button>
            </div>
        </form>

        {{-- Formulaire 2 : Mot de passe --}}
        <form action="{{ route('account.password.update') }}" method="POST">
            @csrf @method('PUT')
            <div class="profil-card">
                <h3 class="profil-titre"><i class="fas fa-lock"></i> Changer le mot de passe</h3>
                <div class="f-g">
                    <label>Mot de passe actuel *</label>
                    <input type="password" name="current_password" placeholder="••••••••">
                    @error('current_password')<div class="f-error">{{ $message }}</div>@enderror
                </div>
                <div class="f-row">
                    <div class="f-g">
                        <label>Nouveau mot de passe *</label>
                        <input type="password" name="new_password" placeholder="8 caractères min.">
                        @error('new_password')<div class="f-error">{{ $message }}</div>@enderror
                    </div>
                    <div class="f-g">
                        <label>Confirmer *</label>
                        <input type="password" name="new_password_confirmation" placeholder="Confirmer…">
                    </div>
                </div>
                <button type="submit" class="btn btn-outline-rose"><i class="fas fa-key"></i> Modifier le mot de passe</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
function previewAvatar(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            const preview = document.getElementById('avatarPreview');
            const initiale = document.getElementById('avatarInitiale');
            preview.src = e.target.result;
            preview.style.display = 'block';
            if (initiale) initiale.style.display = 'none';
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endpush
