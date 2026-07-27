@extends('layouts.app')
@section('title','Connexion — JEKP Store')
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
    width:350px;height:350px;border-radius:50%;
    background:var(--peche);opacity:.2;pointer-events:none}
.auth-card{background:var(--blanc);border-radius:22px;padding:52px 48px;width:100%;max-width:440px;
    box-shadow:0 20px 60px rgba(90,48,64,.14);position:relative;overflow:hidden;z-index:1;
    border:1px solid var(--peche)}
.auth-card::before{content:'';position:absolute;top:0;left:0;width:100%;height:5px;
    background:linear-gradient(90deg,var(--peche),var(--rose-v),var(--lavande2))}
.auth-logo{text-align:center;margin-bottom:32px}
.auth-logo .s-label{font-size:32px;margin-bottom:0}
.auth-logo span{font-family:var(--f-titre);font-size:18px;color:var(--texte2);letter-spacing:3px;text-transform:uppercase;display:block;margin-top:4px}
.auth-titre{font-family:var(--f-titre);font-size:26px;font-weight:300;color:var(--texte);text-align:center;margin-bottom:6px}
.auth-sous{font-size:13px;color:var(--texte2);text-align:center;margin-bottom:30px;line-height:1.7}
.f-g{margin-bottom:16px}
.f-g label{font-size:10px;letter-spacing:2px;text-transform:uppercase;color:var(--texte2);display:block;margin-bottom:6px;font-weight:500}
.f-g input{width:100%;padding:13px 16px;border:1.5px solid var(--peche);border-radius:11px;
    font-family:var(--f-corps);font-size:14px;color:var(--texte);outline:none;
    background:var(--creme2);transition:all .3s}
.f-g input:focus{border-color:var(--rose-v);background:var(--blanc);
    box-shadow:0 0 0 4px rgba(201,112,128,.08)}
.f-g .input-icon{position:relative}
.f-g .input-icon i{position:absolute;right:14px;top:50%;transform:translateY(-50%);color:var(--texte2);font-size:14px;cursor:pointer}
.auth-opts{display:flex;justify-content:space-between;align-items:center;margin:14px 0 22px;font-size:12px}
.auth-opts label{display:flex;align-items:center;gap:7px;color:var(--texte2);cursor:pointer}
.auth-opts input[type=checkbox]{accent-color:var(--rose-v)}
.auth-opts a{color:var(--rose-v);text-decoration:none;transition:color .3s}.auth-opts a:hover{color:var(--rose-f)}
.auth-submit{width:100%;justify-content:center;border-radius:50px;font-size:11px}
.auth-sep{display:flex;align-items:center;gap:14px;margin:22px 0;color:var(--texte2);font-size:11px;letter-spacing:1px}
.auth-sep::before,.auth-sep::after{content:'';flex:1;height:1px;background:var(--peche)}
.auth-social{display:flex;gap:10px;margin-bottom:22px}
.social-btn{flex:1;display:flex;align-items:center;justify-content:center;gap:8px;padding:11px;border:1.5px solid var(--peche);border-radius:10px;text-decoration:none;color:var(--texte2);font-size:12px;font-family:var(--f-corps);transition:var(--trans)}
.social-btn:hover{border-color:var(--rose-v);color:var(--rose-v)}
.auth-lien{text-align:center;font-size:13px;color:var(--texte2);margin-top:6px}
.auth-lien a{color:var(--rose-v);text-decoration:none;font-weight:500}.auth-lien a:hover{color:var(--rose-f)}
@media(max-width:500px){.auth-page{padding:32px 16px}.auth-card{padding:36px 24px;border-radius:16px}.auth-logo .s-label{font-size:26px}.auth-titre{font-size:22px}.auth-opts{flex-direction:column;gap:8px;text-align:center}.f-g input{font-size:16px}.auth-social{gap:8px}.social-btn{font-size:11.5px;padding:11px 6px}}
</style>
@endpush

@section('content')
<div class="auth-page">
    <div class="auth-card">
        <div class="auth-logo">
            <img src="{{ asset('assets/images/jepklogo.png') }}" alt="JEPK" style="height:80px;object-fit:contain;border-radius:12px;mix-blend-mode:multiply">
        </div>
        <h2 class="auth-titre">Bon retour !</h2>
        <p class="auth-sous">Connectez-vous pour accéder à votre espace personnel.</p>

        @if($errors->any())
            @foreach($errors->all() as $e)
                <div class="flash flash-err">{{ $e }}</div>
            @endforeach
        @endif

        <form action="{{ route('auth.login.post') }}" method="POST">
            @csrf
            <div class="f-g">
                <label>Adresse email</label>
                <div class="input-icon">
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="votre@email.com" required>
                    <i class="far fa-envelope"></i>
                </div>
            </div>
            <div class="f-g">
                <label>Mot de passe</label>
                <div class="input-icon">
                    <input type="password" name="password" id="mdp" placeholder="••••••••" required>
                    <i class="far fa-eye" id="toggle-mdp" style="cursor:pointer"></i>
                </div>
            </div>
            <div class="auth-opts">
                <label><input type="checkbox" name="remember"> Se souvenir de moi</label>
                <a href="{{ route('auth.forgot') }}">Mot de passe oublié ?</a>
            </div>
            <button type="submit" class="btn btn-rose auth-submit">
                <i class="fas fa-sign-in-alt"></i> Me connecter
            </button>
        </form>

        <div class="auth-sep">ou continuer avec</div>
        <div class="auth-social">
            <a href="#" class="social-btn"><i class="fab fa-google" style="color:#ea4335"></i> Google</a>
            <a href="#" class="social-btn"><i class="fab fa-facebook" style="color:#1877f2"></i> Facebook</a>
        </div>
        <p class="auth-lien">Pas encore de compte ? <a href="{{ route('auth.register') }}">Créer un compte</a></p>
    </div>
</div>
@endsection
@push('scripts')
<script>
document.getElementById('toggle-mdp').addEventListener('click',function(){
    const i=document.getElementById('mdp');
    i.type=i.type==='password'?'text':'password';
    this.classList.toggle('fa-eye');this.classList.toggle('fa-eye-slash');
});
</script>
@endpush