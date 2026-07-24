@extends('layouts.app')
@section('title','Politique de Confidentialité — JEKP Store')
@push('styles')
<style>
.page-hero{background:linear-gradient(135deg,var(--creme2) 0%,var(--blanc) 50%,var(--peche) 100%);padding:80px 50px;text-align:center;border-bottom:1px solid var(--peche);position:relative;overflow:hidden}
.page-hero::before{content:'';position:absolute;right:-100px;top:-100px;width:320px;height:320px;border-radius:50%;background:linear-gradient(135deg,var(--peche),var(--rose-p));opacity:.1;pointer-events:none}
.breadcrumb{display:flex;gap:8px;align-items:center;font-size:11px;color:var(--texte2);justify-content:center;margin-top:14px}
.breadcrumb a{color:var(--texte2);text-decoration:none;transition:color .3s}.breadcrumb a:hover{color:var(--rose-v)}
.breadcrumb span{color:var(--rose-p)}
.legal-wrap{max-width:800px;margin:0 auto;padding:60px 50px}
.legal-block{background:var(--blanc);border-radius:16px;padding:36px;box-shadow:var(--ombre-sm);border:1px solid var(--peche);margin-bottom:24px}
.legal-block h2{font-family:var(--f-titre);font-size:22px;font-weight:300;color:var(--texte);margin-bottom:12px;padding-bottom:10px;border-bottom:1px solid var(--peche)}
.legal-block p,.legal-block li{font-size:13px;color:var(--texte2);line-height:2}
.legal-block ul{list-style:none;margin:8px 0}
.legal-block li{padding:4px 0;padding-left:18px;position:relative}
.legal-block li::before{content:'·';position:absolute;left:0;color:var(--rose-v);font-weight:bold}
@media(max-width:700px){.legal-wrap{padding:40px 24px}}
</style>
@endpush
@section('content')
<div class="page-hero">
    <span class="s-label">Vos Données</span>
    <h1 class="s-titre">Politique de <em>Confidentialité</em></h1>
    <div class="breadcrumb"><a href="{{ route('home') }}">Accueil</a> <i class="fas fa-chevron-right" style="font-size:9px"></i> <span>Confidentialité</span></div>
</div>
<div class="legal-wrap">
    <div class="legal-block">
        <h2>1. Collecte des données</h2>
        <p>Nous collectons les données personnelles suivantes lors de votre inscription et de vos commandes :</p>
        <ul>
            <li>Nom et prénom</li>
            <li>Adresse email</li>
            <li>Numéro de téléphone</li>
            <li>Adresse de livraison</li>
            <li>Historique de commandes</li>
        </ul>
    </div>
    <div class="legal-block">
        <h2>2. Utilisation des données</h2>
        <p>Vos données personnelles sont utilisées exclusivement pour :</p>
        <ul>
            <li>Le traitement et la livraison de vos commandes</li>
            <li>La gestion de votre compte client</li>
            <li>L'envoi de notifications liées à vos commandes</li>
            <li>L'amélioration de nos services</li>
        </ul>
    </div>
    <div class="legal-block">
        <h2>3. Protection des données</h2>
        <p>Nous mettons en œuvre toutes les mesures techniques et organisationnelles nécessaires pour protéger vos données contre tout accès non autorisé, modification, divulgation ou destruction.</p>
    </div>
    <div class="legal-block">
        <h2>4. Partage des données</h2>
        <p>Vos données personnelles ne sont jamais vendues à des tiers. Elles peuvent être partagées uniquement avec nos partenaires de livraison dans le strict cadre de l'exécution de vos commandes.</p>
    </div>
    <div class="legal-block">
        <h2>5. Cookies</h2>
        <p>Notre site utilise des cookies essentiels au bon fonctionnement du site et à la gestion de votre panier. Vous pouvez configurer votre navigateur pour refuser les cookies.</p>
    </div>
    <div class="legal-block">
        <h2>6. Vos droits</h2>
        <p>Conformément à la réglementation en vigueur, vous disposez d'un droit d'accès, de rectification et de suppression de vos données personnelles. Pour exercer ces droits, contactez-nous à <strong>contact@jepkstore.com</strong>.</p>
    </div>
</div>
@endsection
