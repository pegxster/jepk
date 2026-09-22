@extends('layouts.app')
@section('title', 'Collections — JEPK Store')

@push('styles')
<style>
/* ── Hero ── */
.page-hero{
    background:linear-gradient(135deg,var(--creme2) 0%,var(--blanc) 50%,var(--peche) 100%);
    padding:80px 50px 60px;text-align:center;border-bottom:1px solid var(--peche);
    position:relative;overflow:hidden;
}
.page-hero::before{content:'';position:absolute;right:-100px;top:-100px;
    width:360px;height:360px;border-radius:50%;
    background:linear-gradient(135deg,var(--lavande),var(--lavande2));opacity:.15;pointer-events:none}
.breadcrumb{display:flex;gap:8px;align-items:center;font-size:11px;color:var(--texte2);justify-content:center;margin-top:14px}
.breadcrumb a{color:var(--texte2);text-decoration:none}.breadcrumb a:hover{color:var(--rose-v)}
.breadcrumb span{color:var(--rose-p)}

/* ── Nav rapide ── */
.cats-nav{display:flex;gap:8px;justify-content:center;flex-wrap:wrap;margin-top:24px}
.cats-nav a{
    font-size:10px;letter-spacing:2px;text-transform:uppercase;padding:8px 18px;
    border-radius:50px;border:1.5px solid var(--peche2);color:var(--texte2);
    text-decoration:none;transition:all .3s;background:var(--blanc);
}
.cats-nav a:hover,.cats-nav a.on{background:var(--rose-v);color:#fff;border-color:var(--rose-v)}

/* ── Layout ── */
.coll-layout{max-width:1360px;margin:0 auto;padding:70px 50px}

/* ── En-tête bloc ── */
.coll-bloc{margin-bottom:80px}
.coll-bloc-header{display:flex;align-items:center;justify-content:space-between;margin-bottom:32px}
.coll-bloc-title{font-family:var(--f-titre);font-size:34px;font-weight:300;color:var(--texte)}
.coll-bloc-title em{font-style:italic;color:var(--rose-v)}
.coll-script{font-family:var(--f-script);font-size:20px;color:var(--rose-v);display:block;line-height:1;margin-bottom:4px}
.coll-voir{font-size:10px;letter-spacing:2px;text-transform:uppercase;color:var(--rose-v);text-decoration:none;display:flex;align-items:center;gap:8px;transition:var(--trans)}
.coll-voir:hover{gap:14px}
.coll-voir i{font-size:11px}
.coll-sep{width:50px;height:1.5px;background:linear-gradient(90deg,var(--rose-v),var(--lavande2));margin:10px 0 0}

/* ── Grilles ── */
.sous-grid{display:grid;gap:16px}
.sous-grid.col6{grid-template-columns:repeat(6,1fr)}
.sous-grid.col4{grid-template-columns:repeat(4,1fr)}
.sous-grid.col3{grid-template-columns:repeat(3,1fr)}
.sous-grid.col2{grid-template-columns:2fr 1fr}
.sous-grid.mix{grid-template-columns:1.6fr 1fr 1fr}
.sous-grid.mix4{grid-template-columns:1.4fr 1fr 1fr 1fr}

/* ── Carte catégorie ── */
.sous-card{border-radius:14px;overflow:hidden;position:relative;text-decoration:none;display:block;background:var(--creme2);
    box-shadow:0 2px 12px rgba(90,48,64,.07);border:1px solid rgba(201,104,128,.08);transition:var(--trans)}
.sous-card:hover{box-shadow:0 10px 36px rgba(90,48,64,.14);transform:translateY(-4px)}
.sous-card img{width:100%;height:100%;object-fit:cover;display:block;transition:transform .6s}
.sous-card:hover img{transform:scale(1.05)}
.sous-card .sc-overlay{position:absolute;inset:0;background:linear-gradient(to top,rgba(61,18,32,.75) 0%,rgba(61,18,32,.15) 55%,transparent);display:flex;flex-direction:column;justify-content:flex-end;padding:20px}
.sous-card .sc-nom{font-family:var(--f-titre);font-size:18px;font-weight:300;color:var(--blanc);line-height:1.2}
.sous-card .sc-nb{font-size:10px;letter-spacing:1.5px;text-transform:uppercase;color:rgba(255,255,255,.55);margin-top:4px}
.sous-card .sc-arrow{position:absolute;top:14px;right:14px;width:32px;height:32px;background:rgba(255,255,255,.15);border-radius:50%;display:flex;align-items:center;justify-content:center;color:var(--blanc);font-size:11px;opacity:0;transition:var(--trans)}
.sous-card:hover .sc-arrow{opacity:1}

/* hauteurs */
.h-tall{height:400px}
.h-med {height:260px}
.h-sm  {height:175px}
.h-sq  {height:220px}

/* ── Bandeau ── */
.coll-band{
    background:linear-gradient(135deg,var(--brun-d),var(--brun-2),var(--rose-v));
    padding:60px 50px;text-align:center;border-radius:18px;margin-bottom:80px;
    position:relative;overflow:hidden;
}
.coll-band::before{content:'✦';position:absolute;font-size:300px;color:rgba(255,255,255,.04);
    top:50%;left:50%;transform:translate(-50%,-50%);pointer-events:none;font-family:serif}
.coll-band p{font-family:var(--f-script);font-size:36px;color:var(--peche);margin-bottom:12px}
.coll-band span{font-size:12px;color:rgba(255,255,255,.45);letter-spacing:3px;text-transform:uppercase}

/* Responsive */
@media(max-width:1100px){
    .sous-grid.col6{grid-template-columns:repeat(3,1fr)}
    .sous-grid.col4{grid-template-columns:repeat(2,1fr)}
    .sous-grid.mix4{grid-template-columns:1fr 1fr}
    .sous-grid.mix{grid-template-columns:1fr 1fr}
    .coll-layout{padding:40px 24px}
    .coll-band{padding:40px 24px}
    .coll-bloc-title{font-size:28px}
}
@media(max-width:700px){
    .sous-grid.col6,.sous-grid.col4,.sous-grid.col3,.sous-grid.mix,.sous-grid.col2,.sous-grid.mix4{grid-template-columns:1fr 1fr}
    .page-hero{padding:50px 20px 40px}
    .coll-layout{padding:30px 14px}
    .h-tall{height:220px}
    .h-med{height:175px}
    .h-sm{height:140px}
    .h-sq{height:160px}
    .coll-bloc-header{flex-direction:column;align-items:flex-start;gap:8px}
    .coll-bloc{margin-bottom:50px}
    .coll-band{padding:30px 18px;border-radius:12px;margin-bottom:50px}
    .coll-band p{font-size:22px}
    .cats-nav{gap:6px}
    .cats-nav a{font-size:9px;padding:6px 14px}
    .sous-card .sc-nom{font-size:15px}
}
</style>
@endpush

@section('content')

{{-- Hero --}}
<div class="page-hero">
    <span class="s-label">Explorez</span>
    <h1 class="s-titre">Nos <em>Collections</em></h1>
    <p style="font-size:14px;color:var(--texte2);margin-top:12px;max-width:520px;margin-left:auto;margin-right:auto;line-height:1.8">17 catégories de créations artisanales au crochet — robes, sacs, chapeaux, accessoires et bien plus, faits main en Côte d'Ivoire.</p>
    <div class="breadcrumb">
        <a href="{{ route('home') }}">Accueil</a>
        <i class="fas fa-chevron-right" style="font-size:9px"></i>
        <span>Collections</span>
    </div>
    <div class="cats-nav">
        <a href="#vetements" class="on">Vêtements</a>
        <a href="#sacs">Sacs</a>
        <a href="#chapeaux-acc">Chapeaux & Accessoires</a>
        <a href="#deco">Déco & Cadeaux</a>
    </div>
</div>

<div class="coll-layout">

    {{-- ══════ VÊTEMENTS ══════ --}}
    <div class="coll-bloc" id="vetements">
        <div class="coll-bloc-header">
            <div>
                <span class="coll-script">Collection</span>
                <h2 class="coll-bloc-title"><em>Vêtements</em> au crochet</h2>
                <div class="coll-sep"></div>
            </div>
            <a href="{{ route('shop.index') }}" class="coll-voir">Voir tout le catalogue <i class="fas fa-arrow-right"></i></a>
        </div>

        {{-- Robes (grande) + Tops + Boléros --}}
        <div class="sous-grid mix" style="margin-bottom:16px">
            <a href="{{ route('categories.show', 'robes') }}" class="sous-card h-tall">
                <img src="{{ asset('assets/images/catalogue/image2.jpg') }}" alt="Robes au crochet" loading="lazy">
                <div class="sc-overlay">
                    <span class="sc-nom">Robes au crochet</span>
                    <span class="sc-nb">Légères · élégantes · S au XL</span>
                </div>
                <div class="sc-arrow"><i class="fas fa-arrow-right"></i></div>
            </a>
            <div style="display:flex;flex-direction:column;gap:16px">
                <a href="{{ route('categories.show', 'tops') }}" class="sous-card h-med">
                    <img src="{{ asset('assets/images/catalogue/image8.jpg') }}" alt="Tops" loading="lazy">
                    <div class="sc-overlay">
                        <span class="sc-nom">Tops</span>
                        <span class="sc-nb">Mode décontractée</span>
                    </div>
                    <div class="sc-arrow"><i class="fas fa-arrow-right"></i></div>
                </a>
                <a href="{{ route('categories.show', 'boleros') }}" class="sous-card h-sm">
                    <img src="{{ asset('assets/images/catalogue/image12.jpg') }}" alt="Boléros" loading="lazy">
                    <div class="sc-overlay">
                        <span class="sc-nom">Boléros</span>
                        <span class="sc-nb">Superposition chic</span>
                    </div>
                    <div class="sc-arrow"><i class="fas fa-arrow-right"></i></div>
                </a>
            </div>
            <div style="display:flex;flex-direction:column;gap:16px">
                <a href="{{ route('categories.show', 'tenues-plage') }}" class="sous-card h-sm">
                    <img src="{{ asset('assets/images/catalogue/image19.jpg') }}" alt="Tenues Plage" loading="lazy">
                    <div class="sc-overlay">
                        <span class="sc-nom">Tenues Plage</span>
                        <span class="sc-nb">Été & vacances</span>
                    </div>
                    <div class="sc-arrow"><i class="fas fa-arrow-right"></i></div>
                </a>
                <a href="{{ route('categories.show', 'ensemble-hommes') }}" class="sous-card h-sm">
                    <img src="{{ asset('assets/images/catalogue/image32.jpg') }}" alt="Ensemble Hommes" loading="lazy">
                    <div class="sc-overlay">
                        <span class="sc-nom">Ensemble Hommes</span>
                        <span class="sc-nb">Mode masculine</span>
                    </div>
                    <div class="sc-arrow"><i class="fas fa-arrow-right"></i></div>
                </a>
                <a href="{{ route('categories.show', 'tenues-couple') }}" class="sous-card h-sm">
                    <img src="{{ asset('assets/images/catalogue/image37.jpg') }}" alt="Tenues Couple" loading="lazy">
                    <div class="sc-overlay">
                        <span class="sc-nom">Tenues Couple</span>
                        <span class="sc-nb">Ensembles assortis</span>
                    </div>
                    <div class="sc-arrow"><i class="fas fa-arrow-right"></i></div>
                </a>
            </div>
        </div>
    </div>

    {{-- ══════ SACS ══════ --}}
    <div class="coll-bloc" id="sacs">
        <div class="coll-bloc-header">
            <div>
                <span class="coll-script">Collection</span>
                <h2 class="coll-bloc-title"><em>Sacs</em> & Pochettes</h2>
                <div class="coll-sep"></div>
            </div>
            <a href="{{ route('categories.show', 'sacs-a-main') }}" class="coll-voir">Voir les sacs <i class="fas fa-arrow-right"></i></a>
        </div>
        <div class="sous-grid mix4">
            <a href="{{ route('categories.show', 'sacs-a-main') }}" class="sous-card h-tall">
                <img src="{{ asset('assets/images/catalogue/image47.jpg') }}" alt="Sacs à Main" loading="lazy">
                <div class="sc-overlay">
                    <span class="sc-nom">Sacs à Main</span>
                    <span class="sc-nb">Pochettes & tote bags</span>
                </div>
                <div class="sc-arrow"><i class="fas fa-arrow-right"></i></div>
            </a>
            <a href="{{ route('categories.show', 'sacs-trafoil') }}" class="sous-card h-tall">
                <img src="{{ asset('assets/images/catalogue/image53.jpg') }}" alt="Sacs Trafoil" loading="lazy">
                <div class="sc-overlay">
                    <span class="sc-nom">Sacs Trafoil</span>
                    <span class="sc-nb">Design original</span>
                </div>
                <div class="sc-arrow"><i class="fas fa-arrow-right"></i></div>
            </a>
            <a href="{{ route('categories.show', 'sacs-customises') }}" class="sous-card h-tall">
                <img src="{{ asset('assets/images/catalogue/image56.jpg') }}" alt="Sacs Customisés" loading="lazy">
                <div class="sc-overlay">
                    <span class="sc-nom">Sacs Customisés</span>
                    <span class="sc-nb">Personnalisation complète</span>
                </div>
                <div class="sc-arrow"><i class="fas fa-arrow-right"></i></div>
            </a>
            <a href="{{ route('categories.show', 'sacs-dordinateur') }}" class="sous-card h-tall">
                <img src="{{ asset('assets/images/catalogue/image63.jpg') }}" alt="Sacs Ordinateur" loading="lazy">
                <div class="sc-overlay">
                    <span class="sc-nom">Sacs d'Ordinateur</span>
                    <span class="sc-nb">Style & fonctionnel</span>
                </div>
                <div class="sc-arrow"><i class="fas fa-arrow-right"></i></div>
            </a>
        </div>
    </div>

    {{-- ══════ BANDEAU ══════ --}}
    <div class="coll-band">
        <p>Chaque création est unique</p>
        <span>Toutes nos pièces sont faites à la main avec amour ✦ Sur mesure disponible</span>
        <div style="margin-top:24px;display:flex;gap:14px;justify-content:center;flex-wrap:wrap">
            <a href="{{ route('home') }}#sur-mesure" class="btn btn-outline">
                <i class="fas fa-magic"></i> Commander sur mesure
            </a>
            <a href="{{ route('shop.index') }}" class="btn btn-peche">
                <i class="fas fa-th-large"></i> Voir tout le catalogue
            </a>
        </div>
    </div>

    {{-- ══════ CHAPEAUX & ACCESSOIRES ══════ --}}
    <div class="coll-bloc" id="chapeaux-acc">
        <div class="coll-bloc-header">
            <div>
                <span class="coll-script">Collection</span>
                <h2 class="coll-bloc-title"><em>Chapeaux</em> & Accessoires</h2>
                <div class="coll-sep"></div>
            </div>
            <a href="{{ route('categories.show', 'chapeaux') }}" class="coll-voir">Voir les chapeaux <i class="fas fa-arrow-right"></i></a>
        </div>
        <div class="sous-grid col4">
            <a href="{{ route('categories.show', 'chapeaux') }}" class="sous-card h-med">
                <img src="{{ asset('assets/images/catalogue/image40.jpg') }}" alt="Chapeaux" loading="lazy">
                <div class="sc-overlay">
                    <span class="sc-nom">Chapeaux</span>
                    <span class="sc-nb">Toutes saisons</span>
                </div>
                <div class="sc-arrow"><i class="fas fa-arrow-right"></i></div>
            </a>
            <a href="{{ route('categories.show', 'chouchous') }}" class="sous-card h-med">
                <img src="{{ asset('assets/images/catalogue/image78.jpg') }}" alt="Chouchous" loading="lazy">
                <div class="sc-overlay">
                    <span class="sc-nom">Chouchous</span>
                    <span class="sc-nb">Élastiques cheveux</span>
                </div>
                <div class="sc-arrow"><i class="fas fa-arrow-right"></i></div>
            </a>
            <a href="{{ route('categories.show', 'barrettes') }}" class="sous-card h-med">
                <img src="{{ asset('assets/images/catalogue/image88.jpg') }}" alt="Barrettes" loading="lazy">
                <div class="sc-overlay">
                    <span class="sc-nom">Barrettes</span>
                    <span class="sc-nb">Accessoires cheveux</span>
                </div>
                <div class="sc-arrow"><i class="fas fa-arrow-right"></i></div>
            </a>
            <a href="{{ route('categories.show', 'porte-cles') }}" class="sous-card h-med">
                <img src="{{ asset('assets/images/catalogue/image83.jpg') }}" alt="Porte-Clés" loading="lazy">
                <div class="sc-overlay">
                    <span class="sc-nom">Porte-Clés</span>
                    <span class="sc-nb">Bijoux de sac</span>
                </div>
                <div class="sc-arrow"><i class="fas fa-arrow-right"></i></div>
            </a>
        </div>
    </div>

    {{-- ══════ ENFANTS & DÉCO ══════ --}}
    <div class="coll-bloc" id="deco">
        <div class="coll-bloc-header">
            <div>
                <span class="coll-script">Collection</span>
                <h2 class="coll-bloc-title"><em>Enfants</em> & Décoration</h2>
                <div class="coll-sep"></div>
            </div>
            <a href="{{ route('categories.show', 'bouquets-de-fleurs') }}" class="coll-voir">Voir la déco <i class="fas fa-arrow-right"></i></a>
        </div>
        <div class="sous-grid col3">
            <a href="{{ route('categories.show', 'enfants') }}" class="sous-card h-med">
                <img src="{{ asset('assets/images/catalogue/image50.jpg') }}" alt="Enfants" loading="lazy">
                <div class="sc-overlay">
                    <span class="sc-nom">Enfants</span>
                    <span class="sc-nb">Vêtements & accessoires bébé</span>
                </div>
                <div class="sc-arrow"><i class="fas fa-arrow-right"></i></div>
            </a>
            <a href="{{ route('categories.show', 'bouquets-de-fleurs') }}" class="sous-card h-med">
                <img src="{{ asset('assets/images/catalogue/image70.jpg') }}" alt="Bouquets de Fleurs" loading="lazy">
                <div class="sc-overlay">
                    <span class="sc-nom">Bouquets de Fleurs</span>
                    <span class="sc-nb">Fleurs & objets d'art</span>
                </div>
                <div class="sc-arrow"><i class="fas fa-arrow-right"></i></div>
            </a>
            <a href="{{ route('categories.show', 'miroirs-crochetes') }}" class="sous-card h-med">
                <img src="{{ asset('assets/images/catalogue/image73.jpg') }}" alt="Miroirs Crochetés" loading="lazy">
                <div class="sc-overlay">
                    <span class="sc-nom">Miroirs Crochetés</span>
                    <span class="sc-nb">Décoration murale</span>
                </div>
                <div class="sc-arrow"><i class="fas fa-arrow-right"></i></div>
            </a>
        </div>
    </div>

    {{-- Toutes les catégories / CTA final --}}
    <div style="text-align:center;padding:40px 0 0">
        <span class="s-label" style="display:block;margin-bottom:12px">17 catégories · 80 créations</span>
        <a href="{{ route('shop.index') }}" class="btn btn-rose" style="margin-right:12px">
            <i class="fas fa-th-large"></i> Voir tout le catalogue
        </a>
        <a href="{{ route('home') }}#sur-mesure" class="btn btn-outline-rose">
            <i class="fas fa-magic"></i> Commander sur mesure
        </a>
    </div>

</div>

@endsection
