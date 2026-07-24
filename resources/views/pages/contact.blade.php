@extends('layouts.app')
@section('title','Contact — JEKP Store')
@push('styles')
<style>
.page-hero{background:linear-gradient(135deg,var(--creme2) 0%,var(--blanc) 50%,var(--peche) 100%);padding:80px 50px;text-align:center;border-bottom:1px solid var(--peche);position:relative;overflow:hidden}
.page-hero::before{content:'';position:absolute;right:-100px;top:-100px;width:320px;height:320px;border-radius:50%;background:linear-gradient(135deg,var(--peche),var(--rose-p));opacity:.1;pointer-events:none}
.breadcrumb{display:flex;gap:8px;align-items:center;font-size:11px;color:var(--texte2);justify-content:center;margin-top:14px}
.breadcrumb a{color:var(--texte2);text-decoration:none;transition:color .3s}.breadcrumb a:hover{color:var(--rose-v)}
.breadcrumb span{color:var(--rose-p)}
.contact-wrap{max-width:1000px;margin:0 auto;padding:60px 50px;display:grid;grid-template-columns:1fr 1fr;gap:40px;align-items:start}
.contact-info h2{font-family:var(--f-titre);font-size:28px;font-weight:300;color:var(--texte);margin-bottom:8px}
.contact-info p{font-size:14px;color:var(--texte2);line-height:1.9;margin-bottom:28px}
.info-item{display:flex;align-items:flex-start;gap:14px;margin-bottom:22px}
.info-item .icon{width:44px;height:44px;border-radius:12px;background:var(--peche);display:flex;align-items:center;justify-content:center;color:var(--rose-v);font-size:16px;flex-shrink:0}
.info-item h4{font-family:var(--f-titre);font-size:16px;font-weight:300;color:var(--texte);margin-bottom:2px}
.info-item p{font-size:13px;color:var(--texte2);margin:0}
.contact-form-card{background:var(--blanc);border-radius:18px;padding:36px;box-shadow:var(--ombre);border:1px solid var(--peche)}
.contact-form-card h3{font-family:var(--f-titre);font-size:22px;font-weight:300;color:var(--texte);margin-bottom:20px}
.f-g{margin-bottom:16px}
.f-g label{font-size:10px;letter-spacing:2px;text-transform:uppercase;color:var(--texte2);display:block;margin-bottom:6px;font-weight:500}
.f-g input,.f-g select,.f-g textarea{width:100%;padding:12px 15px;border:1.5px solid var(--peche);border-radius:10px;font-family:var(--f-corps);font-size:13.5px;color:var(--texte);outline:none;background:var(--creme2);transition:border-color .3s}
.f-g input:focus,.f-g select:focus,.f-g textarea:focus{border-color:var(--rose-v);background:var(--blanc)}
.f-g textarea{resize:vertical;min-height:120px}
.f-error{color:#e74c3c;font-size:11px;margin-top:4px}
@media(max-width:800px){.contact-wrap{grid-template-columns:1fr;padding:40px 24px}}
</style>
@endpush
@section('content')
<div class="page-hero">
    <span class="s-label">Parlons-en</span>
    <h1 class="s-titre">Nous <em>Contacter</em></h1>
    <div class="breadcrumb"><a href="{{ route('home') }}">Accueil</a> <i class="fas fa-chevron-right" style="font-size:9px"></i> <span>Contact</span></div>
</div>
<div class="contact-wrap">
    <div class="contact-info">
        <h2>Une question ? Un projet sur mesure ?</h2>
        <p>Nous sommes à votre écoute. Que ce soit pour une commande, un renseignement ou une création personnalisée, n'hésitez pas à nous écrire.</p>
        <div class="info-item">
            <div class="icon"><i class="fas fa-phone"></i></div>
            <div><h4>Téléphone</h4><p>+225 01 53 92 85 72</p></div>
        </div>
        <div class="info-item">
            <div class="icon"><i class="fab fa-whatsapp"></i></div>
            <div><h4>WhatsApp</h4><p>+225 01 53 92 85 72 — Réponse rapide</p></div>
        </div>
        <div class="info-item">
            <div class="icon"><i class="fas fa-envelope"></i></div>
            <div><h4>Email</h4><p>contact@jepkstore.com</p></div>
        </div>
        <div class="info-item">
            <div class="icon"><i class="fas fa-map-marker-alt"></i></div>
            <div><h4>Atelier</h4><p>Abidjan, Côte d'Ivoire</p></div>
        </div>
        <div class="info-item">
            <div class="icon"><i class="fas fa-clock"></i></div>
            <div><h4>Horaires</h4><p>Lun — Sam : 8h00 — 18h00</p></div>
        </div>
    </div>
    <div class="contact-form-card">
        <h3>Envoyez-nous un message</h3>
        <form action="#" method="POST">
            @csrf
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px">
                <div class="f-g">
                    <label>Prénom *</label>
                    <input type="text" name="prenom" value="{{ auth()->user()->prenom ?? '' }}" placeholder="Votre prénom" required>
                </div>
                <div class="f-g">
                    <label>Nom *</label>
                    <input type="text" name="nom" value="{{ auth()->user()->nom ?? '' }}" placeholder="Votre nom" required>
                </div>
            </div>
            <div class="f-g">
                <label>Email *</label>
                <input type="email" name="email" value="{{ auth()->user()->email ?? '' }}" placeholder="votre@email.com" required>
            </div>
            <div class="f-g">
                <label>Sujet</label>
                <select name="sujet">
                    <option value="">Choisir un sujet...</option>
                    <option>Question sur un produit</option>
                    <option>Commande en cours</option>
                    <option>Création sur mesure</option>
                    <option>Collaboration / Partenariat</option>
                    <option>Autre</option>
                </select>
            </div>
            <div class="f-g">
                <label>Message *</label>
                <textarea name="message" placeholder="Décrivez votre demande..." required></textarea>
            </div>
            <button type="submit" class="btn btn-rose" style="width:100%;justify-content:center">
                <i class="fas fa-paper-plane"></i> Envoyer le message
            </button>
        </form>
    </div>
</div>
@endsection
