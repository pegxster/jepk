@extends('layouts.app')
@section('title','À Propos — JEKP Store')
@push('styles')
<style>
.page-hero{background:linear-gradient(135deg,var(--creme2) 0%,var(--blanc) 50%,var(--peche) 100%);padding:80px 50px;text-align:center;border-bottom:1px solid var(--peche);position:relative;overflow:hidden}
.page-hero::before{content:'';position:absolute;right:-100px;top:-100px;width:320px;height:320px;border-radius:50%;background:linear-gradient(135deg,var(--peche),var(--rose-p));opacity:.1;pointer-events:none}
.breadcrumb{display:flex;gap:8px;align-items:center;font-size:11px;color:var(--texte2);justify-content:center;margin-top:14px}
.breadcrumb a{color:var(--texte2);text-decoration:none;transition:color .3s}.breadcrumb a:hover{color:var(--rose-v)}
.breadcrumb span{color:var(--rose-p)}
.about-wrap{max-width:900px;margin:0 auto;padding:60px 50px}
.about-intro{text-align:center;margin-bottom:50px}
.about-intro h2{font-family:var(--f-titre);font-size:clamp(26px,3vw,38px);font-weight:300;color:var(--texte);line-height:1.3;margin-bottom:16px}
.about-intro h2 em{color:var(--rose-v);font-style:italic}
.about-intro p{font-size:15px;color:var(--texte2);line-height:2;max-width:650px;margin:0 auto}
.values-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:24px;margin:50px 0}
.value-card{background:var(--blanc);border-radius:16px;padding:30px;text-align:center;border:1px solid var(--peche);transition:var(--trans)}
.value-card:hover{transform:translateY(-4px);box-shadow:var(--ombre)}
.value-card .icon{width:60px;height:60px;border-radius:50%;background:linear-gradient(135deg,var(--peche),var(--rose-p));display:flex;align-items:center;justify-content:center;margin:0 auto 16px;font-size:22px;color:var(--blanc)}
.value-card h3{font-family:var(--f-titre);font-size:18px;font-weight:300;color:var(--texte);margin-bottom:8px}
.value-card p{font-size:13px;color:var(--texte2);line-height:1.8}
.story-block{background:var(--blanc);border-radius:16px;padding:40px;box-shadow:var(--ombre-sm);border:1px solid var(--peche);margin-bottom:30px}
.story-block h2{font-family:var(--f-titre);font-size:26px;font-weight:300;color:var(--texte);margin-bottom:16px}
.story-block h2 em{color:var(--rose-v);font-style:italic}
.story-block p{font-size:14px;color:var(--texte2);line-height:2;margin-bottom:14px}
.cta-block{text-align:center;padding:50px;border-radius:16px;background:linear-gradient(135deg,var(--peche) 0%,var(--lavande) 100%);margin-top:30px}
.cta-block h2{font-family:var(--f-titre);font-size:28px;font-weight:300;color:var(--texte);margin-bottom:10px}
.cta-block p{font-size:14px;color:var(--texte2);margin-bottom:24px}
@media(max-width:900px){.about-wrap{padding:40px 20px}.values-grid{grid-template-columns:1fr}.page-hero{padding:50px 20px}.story-block{padding:24px 20px}.cta-block{padding:36px 20px}}
@media(max-width:500px){
    .page-hero{padding:36px 16px}
    .about-wrap{padding:28px 14px}
    .about-intro{margin-bottom:32px}
    .about-intro p{font-size:14px;line-height:1.9}
    .story-block{padding:20px 16px;margin-bottom:20px}
    .story-block h2{font-size:22px}
    .values-grid{gap:16px;margin:32px 0}
    .value-card{padding:22px 16px}
    .cta-block{padding:28px 16px}
    .cta-block h2{font-size:22px}
}
</style>
@endpush
@section('content')
<div class="page-hero">
    <span class="s-label">Notre Histoire</span>
    <h1 class="s-titre">À <em>Propos</em></h1>
    <div class="breadcrumb"><a href="{{ route('home') }}">Accueil</a> <i class="fas fa-chevron-right" style="font-size:9px"></i> <span>À propos</span></div>
</div>
<div class="about-wrap">
    <div class="about-intro">
        <h2>L'art du crochet, <em>fait main</em> avec amour</h2>
        <p>JEKP Store est née d'une passion pour le crochet et d'un amour profond pour les créations artisanales. Chaque fil, chaque point raconte une histoire unique.</p>
    </div>

    <div class="story-block">
        <h2>Notre <em>Histoire</em></h2>
        <p>Fondée en Côte d'Ivoire, JEKP Store est une maison de création artisanale dédiée au crochet d'exception. Notre atelier réunit des artisans talentueux qui transforment des fils rares en créations uniques.</p>
        <p>Chaque pièce est confectionnée à la main, avec patience et amour, pour offrir des articles de qualité qui traversent les tendances et les saisons.</p>
        <p>Nous croyons que le handmade a un pouvoir unique : celui de porter en soi l'émotion de celui qui a créé l'objet.</p>
    </div>

    <div class="values-grid">
        <div class="value-card">
            <div class="icon"><i class="fas fa-heart"></i></div>
            <h3>Fait Main</h3>
            <p>Chaque création est confectionnée à la main dans notre atelier, avec des techniques traditionnelles transmises de génération en génération.</p>
        </div>
        <div class="value-card">
            <div class="icon"><i class="fas fa-gem"></i></div>
            <h3>Fils Rares</h3>
            <p>Nous sélectionnons les meilleures laines et fils du monde entier pour vous garantir une qualité exceptionnelle.</p>
        </div>
        <div class="value-card">
            <div class="icon"><i class="fas fa-leaf"></i></div>
            <h3>Éco-responsable</h3>
            <p>Nos créations privilégient des matériaux naturels et durables, pour une mode responsable et consciente.</p>
        </div>
    </div>

    <div class="cta-block">
        <h2>Envie de créer avec nous ?</h2>
        <p>Parcourez notre boutique ou demandez une création sur mesure, rien que pour vous.</p>
        <a href="{{ route('shop.index') }}" class="btn btn-rose"><i class="fas fa-shopping-bag"></i> Découvrir la boutique</a>
    </div>
</div>
@endsection
