@extends('layouts.app')
@section('title','Créer un compte — JEKP Store')
@push('styles')
<style>
.auth-page{min-height:calc(100vh - 78px);display:flex;align-items:center;justify-content:center;
    padding:60px 24px;
    background:linear-gradient(135deg,var(--creme2) 0%,var(--blanc) 40%,var(--peche) 70%,var(--lavande) 100%);
    position:relative;overflow:hidden}
.auth-page::before{content:'';position:absolute;right:-150px;bottom:-150px;
    width:500px;height:500px;border-radius:50%;
    background:linear-gradient(135deg,var(--rose-p),var(--lavande2));opacity:.1;pointer-events:none}
.auth-page::after{content:'';position:absolute;left:-100px;top:-100px;
    width:350px;height:350px;border-radius:50%;background:var(--peche);opacity:.2;pointer-events:none}
.auth-card{background:var(--blanc);border-radius:22px;padding:48px 44px;width:100%;max-width:500px;
    box-shadow:0 20px 60px rgba(90,48,64,.14);position:relative;overflow:hidden;z-index:1;
    border:1px solid var(--peche)}
.auth-card::before{content:'';position:absolute;top:0;left:0;width:100%;height:5px;
    background:linear-gradient(90deg,var(--peche),var(--rose-v),var(--lavande2))}
.auth-logo{text-align:center;margin-bottom:28px}
.auth-logo .s-label{font-size:30px}
.auth-logo span{font-family:var(--f-titre);font-size:16px;color:var(--texte2);letter-spacing:3px;text-transform:uppercase;display:block;margin-top:2px}
.auth-titre{font-family:var(--f-titre);font-size:26px;font-weight:300;color:var(--texte);text-align:center;margin-bottom:6px}
.auth-sous{font-size:13px;color:var(--texte2);text-align:center;margin-bottom:26px;line-height:1.7}
.f-row{display:grid;grid-template-columns:1fr 1fr;gap:12px}
.f-g{margin-bottom:14px}
.f-g label{font-size:10px;letter-spacing:2px;text-transform:uppercase;color:var(--texte2);display:block;margin-bottom:6px;font-weight:500}
.f-g input,.f-g select{width:100%;padding:12px 15px;border:1.5px solid var(--peche);border-radius:10px;font-family:var(--f-corps);font-size:13.5px;color:var(--texte);outline:none;background:var(--creme2);transition:border-color .3s}
.f-g input:focus,.f-g select:focus{border-color:var(--rose-v);background:var(--blanc)}
.auth-submit{width:100%;justify-content:center;border-radius:50px;margin-top:8px}
.cgu{font-size:12px;color:var(--texte2);margin:14px 0;display:flex;gap:8px;align-items:flex-start;line-height:1.6}
.cgu input{accent-color:var(--rose-v);margin-top:2px;flex-shrink:0}
.cgu a{color:var(--rose-v);text-decoration:none}
.auth-lien{text-align:center;font-size:13px;color:var(--texte2);margin-top:14px}
.auth-lien a{color:var(--rose-v);text-decoration:none;font-weight:500}
.force-mdp{margin-top:6px}
.force-bar{height:3px;border-radius:2px;background:var(--peche);transition:all .4s;margin-bottom:4px}
.force-txt{font-size:11px;color:var(--texte2)}
@media(max-width:500px){.auth-card{padding:36px 24px;border-radius:16px}.auth-logo .s-label{font-size:26px}.auth-titre{font-size:22px}.f-row{grid-template-columns:1fr}}
</style>
@endpush
@section('content')
<div class="auth-page">
    <div class="auth-card">
        <div class="auth-logo">
            <img src="{{ asset('assets/images/jepklogo.png') }}" alt="JEPK" style="height:80px;object-fit:contain;border-radius:12px;mix-blend-mode:multiply">
        </div>
        <h2 class="auth-titre">Bienvenue !</h2>
        <p class="auth-sous">Créez votre compte et rejoignez notre communauté de créatrices.</p>

        @if($errors->any())
            @foreach($errors->all() as $e)<div class="flash flash-err">{{ $e }}</div>@endforeach
        @endif

        <form action="{{ route('auth.register.post') }}" method="POST">
            @csrf
            <div class="f-row">
                <div class="f-g">
                    <label>Prénom</label>
                    <input type="text" name="prenom" value="{{ old('prenom') }}" placeholder="Marie" required>
                </div>
                <div class="f-g">
                    <label>Nom</label>
                    <input type="text" name="nom" value="{{ old('nom') }}" placeholder="Dupont" required>
                </div>
            </div>
            <div class="f-g">
                <label>Adresse email</label>
                <input type="email" name="email" value="{{ old('email') }}" placeholder="votre@email.com" required>
            </div>
            <div class="f-g">
                <label>Téléphone</label>
                <input type="tel" name="telephone" value="{{ old('telephone') }}" placeholder="+33 6 00 00 00 00">
            </div>
            <div class="f-g">
                <label>Mot de passe</label>
                <input type="password" name="password" id="mdp" placeholder="8 caractères minimum" required>
                <div class="force-mdp">
                    <div class="force-bar" id="force-bar" style="width:0"></div>
                    <span class="force-txt" id="force-txt"></span>
                </div>
            </div>
            <div class="f-g">
                <label>Confirmer le mot de passe</label>
                <input type="password" name="password_confirmation" placeholder="Confirmer…" required>
            </div>
            <label class="cgu">
                <input type="checkbox" name="cgu" required>
                J'accepte les <a href="{{ route('pages.terms') }}">Conditions Générales de Vente</a> et la <a href="{{ route('pages.privacy') }}">Politique de confidentialité</a>.
            </label>
            <label class="cgu">
                <input type="checkbox" name="newsletter">
                Je souhaite recevoir la newsletter JEKP (conseils, nouveautés, offres exclusives).
            </label>
            <button type="submit" class="btn btn-rose auth-submit">
                <i class="fas fa-user-plus"></i> Créer mon compte
            </button>
        </form>
        <p class="auth-lien">Déjà un compte ? <a href="{{ route('auth.login') }}">Se connecter</a></p>
    </div>
</div>
@endsection
@push('scripts')
<script>
document.getElementById('mdp').addEventListener('input',function(){
    const v=this.value,bar=document.getElementById('force-bar'),txt=document.getElementById('force-txt');
    let f=0;
    if(v.length>=8)f++;if(/[A-Z]/.test(v))f++;if(/[0-9]/.test(v))f++;if(/[^a-zA-Z0-9]/.test(v))f++;
    const cols=['#e8a0a8','#c97080','#7ab5a0','#4a8a70'],labs=['Faible','Moyen','Fort','Très fort'];
    bar.style.width=(f*25)+'%';bar.style.background=cols[f-1]||'var(--peche)';
    txt.textContent=f?labs[f-1]:'';txt.style.color=cols[f-1]||'var(--texte2)';
});
</script>
@endpush