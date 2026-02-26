@extends('layouts.app')
@section('title', "L'Atelier — JEKP Store")

@push('styles')
<style>
/* ══ HERO UNIFORME ══ */
.page-hero{background:linear-gradient(135deg,var(--creme2),var(--peche),var(--lavande));padding:70px 50px;text-align:center;border-bottom:1px solid var(--peche)}
.breadcrumb{display:flex;gap:8px;align-items:center;font-size:11px;color:var(--texte2);justify-content:center;margin-top:14px}
.breadcrumb a{color:var(--texte2);text-decoration:none}.breadcrumb a:hover{color:var(--rose-v)}
.breadcrumb span{color:var(--rose-p)}

/* ══ INTRO ══ */
.at-intro{max-width:1200px;margin:0 auto;padding:90px 50px;display:grid;grid-template-columns:1fr 1fr;gap:80px;align-items:center}
.at-intro-img{position:relative}
.at-intro-img img{width:100%;height:520px;object-fit:cover;border-radius:var(--rayon)}
.at-intro-img::before{content:'';position:absolute;top:-16px;left:-16px;right:16px;bottom:16px;border:1.5px solid var(--peche2);border-radius:var(--rayon);z-index:-1}
.at-intro-badge{position:absolute;bottom:24px;left:24px;background:var(--blanc);padding:16px 22px;border-radius:var(--rayon);box-shadow:var(--ombre)}
.at-intro-badge span{font-family:var(--f-script);font-size:22px;color:var(--rose-v);display:block}
.at-intro-badge small{font-size:10px;letter-spacing:2px;text-transform:uppercase;color:var(--texte2)}
.at-sep{width:40px;height:1.5px;background:linear-gradient(90deg,var(--rose-v),var(--lavande2));margin:24px 0}
.at-intro-txt p{font-size:14px;color:var(--texte2);line-height:2;margin-bottom:16px}

/* ══ VALEURS ══ */
.at-valeurs{background:linear-gradient(135deg,var(--creme2),var(--peche) 50%,var(--lavande));padding:80px 50px}
.at-valeurs-in{max-width:1200px;margin:0 auto}
.at-valeurs-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:28px;margin-top:52px}
.at-val-card{background:var(--blanc);border-radius:var(--rayon);padding:36px 28px;text-align:center;box-shadow:var(--ombre-sm);transition:var(--trans)}
.at-val-card:hover{transform:translateY(-6px);box-shadow:var(--ombre)}
.at-val-icon{width:60px;height:60px;background:linear-gradient(135deg,var(--peche),var(--lavande));border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 20px;font-size:22px;color:var(--rose-v)}
.at-val-card h3{font-family:var(--f-titre);font-size:20px;font-weight:300;color:var(--texte);margin-bottom:10px}
.at-val-card p{font-size:13px;color:var(--texte2);line-height:1.8}

/* ══ PROCESSUS ══ */
.at-process{max-width:1200px;margin:0 auto;padding:90px 50px}
.at-process-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:24px;margin-top:52px}
.at-step{display:grid;grid-template-columns:auto 1fr;gap:28px;align-items:start;background:var(--blanc);border-radius:var(--rayon);padding:32px;box-shadow:var(--ombre-sm);transition:var(--trans)}
.at-step:hover{transform:translateY(-4px);box-shadow:var(--ombre)}
.at-step-num{width:56px;height:56px;background:linear-gradient(135deg,var(--rose-v),var(--lavande2));border-radius:50%;display:flex;align-items:center;justify-content:center;font-family:var(--f-titre);font-size:22px;color:var(--blanc);flex-shrink:0}
.at-step h3{font-family:var(--f-titre);font-size:21px;font-weight:300;color:var(--texte);margin-bottom:10px}
.at-step p{font-size:13px;color:var(--texte2);line-height:1.85}
.at-step-img{width:100%;height:160px;object-fit:cover;border-radius:8px;margin-top:16px;grid-column:1/-1}

/* ══ GALERIE ══ */
.at-galerie{background:var(--creme2);padding:80px 50px}
.at-galerie-in{max-width:1300px;margin:0 auto}
.at-galerie-grid{display:grid;grid-template-columns:repeat(3,1fr);grid-template-rows:auto auto;gap:16px;margin-top:48px}
.at-gal-item{border-radius:var(--rayon);overflow:hidden;position:relative;cursor:pointer}
.at-gal-item img{width:100%;height:100%;object-fit:cover;display:block;transition:transform .7s}
.at-gal-item:hover img{transform:scale(1.06)}
.at-gal-item:nth-child(1){grid-column:span 2;height:340px}
.at-gal-item:nth-child(2){height:340px}
.at-gal-item:nth-child(3){height:240px}
.at-gal-item:nth-child(4){height:240px}
.at-gal-item:nth-child(5){height:240px}
.at-gal-overlay{position:absolute;inset:0;background:rgba(61,32,48,0);transition:var(--trans);display:flex;align-items:center;justify-content:center}
.at-gal-item:hover .at-gal-overlay{background:rgba(61,32,48,.25)}
.at-gal-overlay i{color:var(--blanc);font-size:24px;opacity:0;transition:var(--trans)}
.at-gal-item:hover .at-gal-overlay i{opacity:1}

/* ══ MATIÈRES ══ */
.at-matieres{max-width:1200px;margin:0 auto;padding:90px 50px}
.at-mat-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:20px;margin-top:48px}
.at-mat-card{border-radius:var(--rayon);overflow:hidden;position:relative;height:280px;text-decoration:none;display:block}
.at-mat-card img{width:100%;height:100%;object-fit:cover;transition:transform .6s}
.at-mat-card:hover img{transform:scale(1.07)}
.at-mat-card .mat-overlay{position:absolute;inset:0;background:linear-gradient(to top,rgba(61,32,48,.7),transparent 50%);display:flex;flex-direction:column;justify-content:flex-end;padding:22px}
.at-mat-card h3{font-family:var(--f-titre);font-size:20px;font-weight:300;color:var(--blanc)}
.at-mat-card p{font-size:11px;color:rgba(255,255,255,.6);letter-spacing:1px;margin-top:4px}
.mat-tag{position:absolute;top:14px;right:14px;background:rgba(255,255,255,.15);backdrop-filter:blur(8px);padding:5px 12px;border-radius:50px;font-size:9px;letter-spacing:2px;text-transform:uppercase;color:rgba(255,255,255,.8)}

/* ══ CTA FINAL ══ */
.at-cta{background:var(--brun-d);padding:100px 50px;text-align:center;position:relative;overflow:hidden}
.at-cta::before{content:'✦';position:absolute;font-size:300px;color:rgba(255,255,255,.02);top:50%;left:50%;transform:translate(-50%,-50%);font-family:var(--f-titre)}
.at-cta-in{position:relative;z-index:2}
.at-cta h2{font-family:var(--f-titre);font-size:48px;font-weight:300;color:var(--blanc);margin-bottom:16px}
.at-cta h2 em{color:var(--peche);font-style:italic}
.at-cta p{font-size:14px;color:rgba(255,255,255,.45);max-width:480px;margin:0 auto 36px;line-height:1.9}
.at-cta-btns{display:flex;gap:16px;justify-content:center;flex-wrap:wrap}

/* ══ RESPONSIVE ══ */
@media(max-width:1000px){
    .at-intro{grid-template-columns:1fr;gap:40px;padding:60px 30px}
    .at-valeurs-grid{grid-template-columns:repeat(2,1fr)}
    .at-process-grid{grid-template-columns:1fr}
    .at-mat-grid{grid-template-columns:repeat(2,1fr)}
    .at-galerie-grid{grid-template-columns:1fr 1fr}
    .at-gal-item:nth-child(1){grid-column:span 2}
}
@media(max-width:600px){
    .page-hero{padding:50px 24px}
    .at-intro{padding:50px 24px}
    .at-valeurs{padding:60px 24px}
    .at-valeurs-grid{grid-template-columns:1fr}
    .at-process{padding:60px 24px}
    .at-galerie{padding:60px 24px}
    .at-galerie-grid{grid-template-columns:1fr}
    .at-gal-item:nth-child(1){grid-column:span 1}
    .at-matieres{padding:60px 24px}
    .at-mat-grid{grid-template-columns:1fr}
    .at-cta{padding:70px 24px}
    .at-cta h2{font-size:32px}
}
</style>
@endpush

@section('content')

{{-- ══ HERO UNIFORME ══ --}}
<div class="page-hero">
    <span class="s-label">Bienvenue dans notre univers</span>
    <h1 class="s-titre">L'<em>Atelier</em> JEKP</h1>
    <p style="font-size:14px;color:var(--texte2);margin-top:12px;max-width:500px;margin-left:auto;margin-right:auto;line-height:1.8">Découvrez les coulisses de nos créations artisanales — les mains qui tricotent, les fils qui parlent, l'amour dans chaque maille.</p>
    <div class="breadcrumb">
        <a href="{{ route('home') }}">Accueil</a>
        <i class="fas fa-chevron-right" style="font-size:9px"></i>
        <span>L'Atelier</span>
    </div>
</div>

{{-- ══ INTRO / HISTOIRE ══ --}}
<div class="at-intro" id="histoire">
    <div class="at-intro-img rev">
        <img src="https://images.unsplash.com/photo-1584917865442-de89be371e2b?w=800&q=80" alt="L'Atelier JEKP">
        <div class="at-intro-badge">
            <span>Fait à la main</span>
            <small>Avec amour ✦ Depuis toujours</small>
        </div>
    </div>
    <div class="at-intro-txt rev">
        <span class="s-label">Notre histoire</span>
        <h2 class="s-titre">Chaque maille<br>raconte une <em>histoire</em></h2>
        <div class="at-sep"></div>
        <p>L'Atelier JEKP est né d'une passion simple et profonde : celle de créer avec ses mains. Ce qui a commencé comme un loisir s'est transformé en une maison de création artisanale dédiée à toutes les femmes qui aiment le beau, le doux et l'authentique.</p>
        <p>Chaque pièce est pensée, tricotée et finalisée à la main. Pas de production en masse, pas de compromis sur la qualité. Seulement des fils soigneusement sélectionnés, des points maîtrisés et un amour sincère du travail bien fait.</p>
        <p>Que ce soit pour votre maison, pour vous, pour vos enfants ou pour offrir — chaque création JEKP est unique et porte en elle un peu de notre âme.</p>
        <a href="{{ route('shop.index') }}" class="btn btn-rose" style="margin-top:10px">
            <i class="fas fa-shopping-bag"></i> Découvrir la boutique
        </a>
    </div>
</div>

{{-- ══ VALEURS ══ --}}
<div class="at-valeurs">
    <div class="at-valeurs-in">
        <div style="text-align:center">
            <span class="s-label">Ce qui nous définit</span>
            <h2 class="s-titre">Nos <em>Valeurs</em></h2>
        </div>
        <div class="at-valeurs-grid">
            <div class="at-val-card rev">
                <div class="at-val-icon"><i class="fas fa-hands"></i></div>
                <h3>100% Artisanal</h3>
                <p>Chaque pièce est entièrement tricotée à la main, avec patience et précision. Aucune machine ne remplacera jamais la chaleur du fait-main.</p>
            </div>
            <div class="at-val-card rev">
                <div class="at-val-icon"><i class="fas fa-leaf"></i></div>
                <h3>Matières Nobles</h3>
                <p>Nous sélectionnons uniquement des fils de qualité supérieure — laine mérinos, alpaga, mohair, coton bio — pour des créations durables et douces.</p>
            </div>
            <div class="at-val-card rev">
                <div class="at-val-icon"><i class="fas fa-magic"></i></div>
                <h3>Sur Mesure</h3>
                <p>Chaque cliente est unique. Nous créons des pièces personnalisées selon vos envies, vos couleurs et vos mensurations.</p>
            </div>
            <div class="at-val-card rev">
                <div class="at-val-icon"><i class="fas fa-heart"></i></div>
                <h3>Fait avec Amour</h3>
                <p>Plus qu'un métier, c'est une vocation. Chaque maille porte en elle une intention, une attention et une passion sincère pour le beau.</p>
            </div>
        </div>
    </div>
</div>

{{-- ══ PROCESSUS DE CRÉATION ══ --}}
<div class="at-process">
    <div style="text-align:center">
        <span class="s-label">De l'idée à la création</span>
        <h2 class="s-titre">Comment naît une <em>pièce</em> JEKP</h2>
    </div>
    <div class="at-process-grid">
        <div class="at-step rev">
            <div class="at-step-num">01</div>
            <div>
                <h3>Le choix du fil</h3>
                <p>Tout commence par la sélection minutieuse des matières. Nous choisissons chaque fil pour sa douceur, sa tenue et sa beauté — des fibres naturelles et nobles qui durent dans le temps.</p>
            </div>
            <img src="https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=700&q=80" alt="Choix du fil" class="at-step-img">
        </div>
        <div class="at-step rev">
            <div class="at-step-num">02</div>
            <div>
                <h3>La création du patron</h3>
                <p>Chaque modèle est dessiné et adapté à la main. Nous travaillons les points, les formes et les proportions jusqu'à obtenir un résultat parfait, élégant et flatteur.</p>
            </div>
            <img src="https://images.unsplash.com/photo-1574359411659-15573a27fd0c?w=700&q=80" alt="Patron" class="at-step-img">
        </div>
        <div class="at-step rev">
            <div class="at-step-num">03</div>
            <div>
                <h3>Le tricotage</h3>
                <p>Maille après maille, la pièce prend vie entre nos mains. C'est la partie la plus méditative et la plus précieuse — là où l'amour du métier s'exprime pleinement.</p>
            </div>
            <img src="https://images.unsplash.com/photo-1584917865442-de89be371e2b?w=700&q=80" alt="Tricotage" class="at-step-img">
        </div>
        <div class="at-step rev">
            <div class="at-step-num">04</div>
            <div>
                <h3>Les finitions & l'envoi</h3>
                <p>Chaque pièce est soigneusement vérifiée, bloquée et emballée dans un packaging délicat. Votre commande part avec une petite carte personnalisée — parce que les détails font tout.</p>
            </div>
            <img src="https://images.unsplash.com/photo-1616400619175-5beda3a17896?w=700&q=80" alt="Finitions" class="at-step-img">
        </div>
    </div>
</div>

{{-- ══ GALERIE COULISSES ══ --}}
<div class="at-galerie">
    <div class="at-galerie-in">
        <div style="text-align:center">
            <span class="s-label">Dans les coulisses</span>
            <h2 class="s-titre">L'atelier en <em>images</em></h2>
            <p class="s-sous" style="max-width:500px;margin:16px auto 0">Un aperçu de notre espace de création, là où la magie opère chaque jour.</p>
        </div>
        <div class="at-galerie-grid">
            <div class="at-gal-item">
                <img src="https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=900&q=80" alt="Atelier 1">
                <div class="at-gal-overlay"><i class="fas fa-expand"></i></div>
            </div>
            <div class="at-gal-item">
                <img src="https://images.unsplash.com/photo-1574359411659-15573a27fd0c?w=600&q=80" alt="Atelier 2">
                <div class="at-gal-overlay"><i class="fas fa-expand"></i></div>
            </div>
            <div class="at-gal-item">
                <img src="https://images.unsplash.com/photo-1584917865442-de89be371e2b?w=600&q=80" alt="Atelier 3">
                <div class="at-gal-overlay"><i class="fas fa-expand"></i></div>
            </div>
            <div class="at-gal-item">
                <img src="https://images.unsplash.com/photo-1616400619175-5beda3a17896?w=600&q=80" alt="Atelier 4">
                <div class="at-gal-overlay"><i class="fas fa-expand"></i></div>
            </div>
            <div class="at-gal-item">
                <img src="https://images.unsplash.com/photo-1520903920243-00d872a2d1c9?w=600&q=80" alt="Atelier 5">
                <div class="at-gal-overlay"><i class="fas fa-expand"></i></div>
            </div>
        </div>
    </div>
</div>

{{-- ══ NOS MATIÈRES ══ --}}
<div class="at-matieres">
    <div style="text-align:center">
        <span class="s-label">La matière avant tout</span>
        <h2 class="s-titre">Nos fils <em>préférés</em></h2>
        <p class="s-sous" style="max-width:500px;margin:16px auto 0">Nous travaillons exclusivement avec des fibres naturelles, douces et durables.</p>
    </div>
    <div class="at-mat-grid">
        <a href="{{ route('shop.index') }}" class="at-mat-card rev">
            <img src="https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=500&q=80" alt="Mérinos">
            <div class="mat-overlay">
                <h3>Laine Mérinos</h3>
                <p>Ultra-douce · Thermorégulatrice</p>
            </div>
            <span class="mat-tag">Premium</span>
        </a>
        <a href="{{ route('shop.index') }}" class="at-mat-card rev">
            <img src="https://images.unsplash.com/photo-1574359411659-15573a27fd0c?w=500&q=80" alt="Alpaga">
            <div class="mat-overlay">
                <h3>Alpaga</h3>
                <p>Luxueux · Léger · Soyeux</p>
            </div>
            <span class="mat-tag">Luxe</span>
        </a>
        <a href="{{ route('shop.index') }}" class="at-mat-card rev">
            <img src="https://images.unsplash.com/photo-1584917865442-de89be371e2b?w=500&q=80" alt="Mohair">
            <div class="mat-overlay">
                <h3>Mohair</h3>
                <p>Délicat · Duveteux · Chic</p>
            </div>
            <span class="mat-tag">Douceur</span>
        </a>
        <a href="{{ route('shop.index') }}" class="at-mat-card rev">
            <img src="https://images.unsplash.com/photo-1616400619175-5beda3a17896?w=500&q=80" alt="Coton Bio">
            <div class="mat-overlay">
                <h3>Coton Bio</h3>
                <p>Naturel · Respirant · Éco</p>
            </div>
            <span class="mat-tag">Éco</span>
        </a>
    </div>
</div>

{{-- ══ CTA FINAL ══ --}}
<div class="at-cta">
    <div class="at-cta-in">
        <span class="s-label" style="color:var(--rose-p)">Prête à créer ?</span>
        <h2>Votre pièce unique<br><em>vous attend</em></h2>
        <p>Explorez notre boutique ou commandez une création sur mesure, rien que pour vous.</p>
        <div class="at-cta-btns">
            <a href="{{ route('shop.index') }}" class="btn btn-peche">
                <i class="fas fa-shopping-bag"></i> Voir la boutique
            </a>
            <a href="{{ route('home') }}#sur-mesure" class="btn btn-outline">
                <i class="fas fa-magic"></i> Commander sur mesure
            </a>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
const revEls = document.querySelectorAll('.rev');
const obs = new IntersectionObserver((entries) => {
    entries.forEach((e, i) => {
        if (e.isIntersecting) {
            setTimeout(() => {
                e.target.style.opacity = '1';
                e.target.style.transform = 'translateY(0)';
            }, i * 80);
            obs.unobserve(e.target);
        }
    });
}, { threshold: 0.1 });
revEls.forEach(el => {
    el.style.opacity = '0';
    el.style.transform = 'translateY(28px)';
    el.style.transition = 'opacity .7s ease, transform .7s ease';
    obs.observe(el);
});
</script>
@endpush