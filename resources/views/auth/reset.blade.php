@extends('layouts.app')
@section('title','Réinitialiser le mot de passe — JEKP Store')
@push('styles')
<style>
.auth-wrap{max-width:480px;margin:0 auto;padding:60px 24px 80px}
.auth-card{background:var(--blanc);border-radius:20px;padding:40px;box-shadow:var(--ombre);border:1px solid var(--peche);text-align:center}
.auth-card img{height:72px;object-fit:contain;margin:0 auto 20px;border-radius:12px;mix-blend-mode:multiply;display:block}
.auth-card h1{font-family:var(--f-titre);font-size:26px;font-weight:300;color:var(--texte);margin-bottom:8px}
.auth-card p{font-size:13px;color:var(--texte2);margin-bottom:28px;line-height:1.7}
.f-g{margin-bottom:16px;text-align:left}
.f-g label{font-size:10px;letter-spacing:2px;text-transform:uppercase;color:var(--texte2);display:block;margin-bottom:6px;font-weight:500}
.f-g input{width:100%;padding:13px 16px;border:1.5px solid var(--peche);border-radius:10px;font-family:var(--f-corps);font-size:14px;color:var(--texte);outline:none;background:var(--creme2);transition:border-color .3s}
.f-g input:focus{border-color:var(--rose-v);background:var(--blanc)}
.f-error{color:#e74c3c;font-size:11px;margin-top:4px}
.alert-ok{background:#f0faf5;border:1px solid #a8d5be;color:#2d6a4f;padding:12px 16px;border-radius:10px;margin-bottom:16px;font-size:13px;text-align:left}
.alert-err{background:#fff0f0;border:1px solid #f5baba;color:#c0392b;padding:12px 16px;border-radius:10px;margin-bottom:16px;font-size:13px;text-align:left}
.auth-link{font-size:13px;color:var(--texte2);margin-top:20px}
.auth-link a{color:var(--rose-v);text-decoration:none;font-weight:500}
.auth-link a:hover{text-decoration:underline}
</style>
@endpush
@section('content')
<div class="auth-wrap">
    <div class="auth-card">
        <img src="{{ asset('assets/images/jepklogo.png') }}" alt="JEKP">
        <h1>Nouveau mot de passe</h1>
        <p>Choisissez un nouveau mot de passe pour votre compte.</p>

        @if(session('error'))
            <div class="alert-err"><i class="fas fa-exclamation-circle"></i> {{ session('error') }}</div>
        @endif

        @if($errors->any())
            <div class="alert-err"><i class="fas fa-exclamation-triangle"></i>
                @foreach($errors->all() as $e) {{ $e }} @endforeach
            </div>
        @endif

        <form action="{{ route('auth.reset.post') }}" method="POST">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <input type="hidden" name="email" value="{{ $email }}">
            <div class="f-g">
                <label>Email</label>
                <input type="email" value="{{ $email }}" disabled style="opacity:.6">
            </div>
            <div class="f-g">
                <label>Nouveau mot de passe *</label>
                <input type="password" name="password" placeholder="8 caractères minimum" required>
                @error('password')<div class="f-error">{{ $message }}</div>@enderror
            </div>
            <div class="f-g">
                <label>Confirmer le mot de passe *</label>
                <input type="password" name="password_confirmation" placeholder="Répétez le mot de passe" required>
            </div>
            <button type="submit" class="btn btn-rose" style="width:100%;justify-content:center;margin-top:8px">
                <i class="fas fa-key"></i> Réinitialiser le mot de passe
            </button>
        </form>
        <div class="auth-link">
            <a href="{{ route('auth.login') }}"><i class="fas fa-arrow-left"></i> Retour à la connexion</a>
        </div>
    </div>
</div>
@endsection
