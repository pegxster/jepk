@extends('layouts.app')
@section('title','CGV — JEKP Store')
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
.legal-block h3{font-family:var(--f-titre);font-size:17px;font-weight:300;color:var(--texte);margin:16px 0 8px}
.legal-block p,.legal-block li{font-size:13px;color:var(--texte2);line-height:2}
.legal-block ul{list-style:none;margin:8px 0}
.legal-block li{padding:4px 0;padding-left:18px;position:relative}
.legal-block li::before{content:'·';position:absolute;left:0;color:var(--rose-v);font-weight:bold}
@media(max-width:700px){.legal-wrap{padding:40px 24px}}
</style>
@endpush
@section('content')
<div class="page-hero">
    <span class="s-label">Informations Légales</span>
    <h1 class="s-titre">Conditions Générales de <em>Vente</em></h1>
    <div class="breadcrumb"><a href="{{ route('home') }}">Accueil</a> <i class="fas fa-chevron-right" style="font-size:9px"></i> <span>CGV</span></div>
</div>
<div class="legal-wrap">
    <div class="legal-block">
        <h2>Article 1 — Objet</h2>
        <p>Les présentes conditions générales de vente régissent les relations contractuelles entre JEKP Store, maison de création artisanale, et tout client effectuant un achat via le site jepkstore.com.</p>
    </div>
    <div class="legal-block">
        <h2>Article 2 — Produits</h2>
        <p>Tous les produits proposés à la vente sont des créations artisanales fabriquées à la main. Les photographies et descriptions sont les plus fidèles possibles. Les légères variations de couleur ou de forme sont inhérentes au caractère artisanal des produits.</p>
    </div>
    <div class="legal-block">
        <h2>Article 3 — Prix</h2>
        <p>Les prix sont indiqués en Francs CFA (F CFA) toutes taxes comprises. JEKP Store se réserve le droit de modifier ses prix à tout moment, being entendu que le prix applicable est celui en vigueur au moment de la validation de la commande.</p>
    </div>
    <div class="legal-block">
        <h2>Article 4 — Commande</h2>
        <p>La commande est validée après confirmation du paiement. Un email de confirmation est envoyé au client récapitulant les détails de sa commande.</p>
    </div>
    <div class="legal-block">
        <h2>Article 5 — Paiement</h2>
        <p>Le paiement peut être effectué via :</p>
        <ul>
            <li>Wave mobile money</li>
            <li>Paiement à la livraison (Abidjan uniquement)</li>
        </ul>
    </div>
    <div class="legal-block">
        <h2>Article 6 — Livraison</h2>
        <p>Les délais de livraison sont donnés à titre indicatif. JEKP Store ne saurait être tenu responsable des retards de livraison imputables au service de livraison.</p>
    </div>
    <div class="legal-block">
        <h2>Article 7 — Droit de rétractation</h2>
        <p>Le client dispose d'un délai de 14 jours pour exercer son droit de rétractation, à compter de la réception du produit. Les produits personnalisés ou sur mesure ne sont pas éligibles au droit de rétractation.</p>
    </div>
    <div class="legal-block">
        <h2>Article 8 — Contact</h2>
        <p>Pour toute question relative aux présentes CGV, vous pouvez nous contacter à <strong>contact@jepkstore.com</strong> ou par WhatsApp au <strong>+225 01 53 92 85 72</strong>.</p>
    </div>
</div>
@endsection
