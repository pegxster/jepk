@extends('layouts.app')
@section('title','Mot de passe oublié — JEKP Store')
@push('styles')
<style>
.auth-page{min-height:calc(100vh - 78px);display:flex;align-items:center;justify-content:center;
    padding:60px 24px;
    background:linear-gradient(135deg,var(--creme2) 0%,var(--blanc) 40%,var(--peche) 70%,var(--lavande) 100%);
    position:relative;overflow:hidden}
.auth-page::before{content:'';position:absolute;right:-150px;bottom:-150px;
    width:500px;height:500px;border-radius:50%;
    background:linear-gradient(135deg,var(--rose-p),var(--lavande2));opacity:.1;pointer-events:none}
.auth-card{background:var(--blanc);border-radius:22px;padding:52px 44px;width:100%;max-width:420px;
    box-shadow:0 20px 60px rgba(90,48,64,.14);position:relative;overflow:hidden;z-index:1;
    border:1px solid var(--peche)}
.auth-card::before{content:'';position:absolute;top:0;left:0;width:100%;height:5px;
    background:linear-gradient(90deg,var(--peche),var(--rose-v),var(--lavande2))}
.auth-logo{text-align:center;margin-bottom:28px}
.auth-logo .s-label{font-size:30px}
.auth-titre{font-family:var(--f-titre);font-size:24px;font-weight:300;color:var(--texte);text-align:center;margin-bottom:8px}
.auth-sous{font-size:13px;color:var(--texte2);text-align:center;margin-bottom:26px;line-height:1.7}
.f-g{margin-bottom:16px}
.f-g label{font-size:10px;letter-spacing:2px;text-transform:uppercase;color:var(--texte2);display:block;margin-bottom:7px;font-weight:500}
.f-g input{width:100%;padding:13px 16px;border:1.5px solid var(--peche);border-radius:10px;font-family:var(--f-corps);font-size:14px;color:var(--texte);outline:none;background:var(--creme2);transition:border-color .3s}
.f-g input:focus{border-color:var(--rose-v);background:var(--blanc)}
.auth-submit{width:100%;justify-content:center;border-radius:50px;margin-top:4px}
.auth-lien{text-align:center;font-size:13px;color:var(--texte2);margin-top:18px}
.auth-lien a{color:var(--rose-v);text-decoration:none;font-weight:500}
@media(max-width:500px){.auth-page{padding:32px 16px}.auth-card{padding:36px 24px;border-radius:16px}.auth-logo .s-label{font-size:26px}.auth-titre{font-size:20px}.auth-sous{font-size:12.5px}.f-g input{font-size:16px}}
</style>
@endpush
@section('content')
<div class="auth-page">
    <div class="auth-card">
        <div class="auth-logo"><img src="{{ asset('assets/images/jepklogo.png') }}" alt="JEPK" style="height:80px;object-fit:contain;border-radius:12px;mix-blend-mode:multiply"></div>
        <h2 class="auth-titre">Mot de passe oublié</h2>
        <p class="auth-sous">Entrez votre email et nous vous enverrons un lien pour réinitialiser votre mot de passe.</p>
        @if(session('status'))<div class="flash flash-ok">{{ session('status') }}</div>@endif
        <form action="{{ route('auth.forgot.post') }}" method="POST">
            @csrf
            <div class="f-g">
                <label>Adresse email</label>
                <input type="email" name="email" placeholder="votre@email.com" required>
            </div>
            <button type="submit" class="btn btn-rose auth-submit"><i class="fas fa-paper-plane"></i> Envoyer le lien</button>
        </form>
        <p class="auth-lien"><a href="{{ route('auth.login') }}">← Retour à la connexion</a></p>
    </div>
</div>
@endsection