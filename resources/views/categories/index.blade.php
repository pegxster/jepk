@extends('layouts.app')
@section('title', 'Collections — JEKP Store')

@push('styles')
<style>
/* ── Hero ── */
.page-hero{background:linear-gradient(135deg,var(--creme2),var(--peche),var(--lavande));padding:70px 50px;text-align:center;border-bottom:1px solid var(--peche)}
.breadcrumb{display:flex;gap:8px;align-items:center;font-size:11px;color:var(--texte2);justify-content:center;margin-top:14px}
.breadcrumb a{color:var(--texte2);text-decoration:none}.breadcrumb a:hover{color:var(--rose-v)}
.breadcrumb span{color:var(--rose-p)}

/* ── Layout ── */
.coll-layout{max-width:1300px;margin:0 auto;padding:70px 50px}

/* ── Grande carte catégorie ── */
.coll-bloc{margin-bottom:80px}
.coll-bloc-header{display:flex;align-items:center;justify-content:space-between;margin-bottom:32px}
.coll-bloc-title{font-family:var(--f-titre);font-size:34px;font-weight:300;color:var(--texte)}
.coll-bloc-title em{font-style:italic;color:var(--rose-v)}
.coll-bloc-title span{font-family:var(--f-script);font-size:22px;color:var(--rose-v);display:block;line-height:1}
.coll-voir{font-size:10px;letter-spacing:2px;text-transform:uppercase;color:var(--rose-v);text-decoration:none;display:flex;align-items:center;gap:8px;transition:var(--trans)}
.coll-voir:hover{gap:14px}
.coll-voir i{font-size:11px}
.coll-sep{width:50px;height:1.5px;background:linear-gradient(90deg,var(--rose-v),var(--lavande2));margin:10px 0 0}

/* ── Grille sous-catégories ── */
.sous-grid{display:grid;gap:18px}
.sous-grid.col4{grid-template-columns:repeat(4,1fr)}
.sous-grid.col3{grid-template-columns:repeat(3,1fr)}
.sous-grid.col2{grid-template-columns:2fr 1fr}
.sous-grid.mix{grid-template-columns:1.6fr 1fr 1fr}

.sous-card{border-radius:var(--rayon);overflow:hidden;position:relative;text-decoration:none;display:block;background:var(--creme2)}
.sous-card img{width:100%;height:100%;object-fit:cover;display:block;transition:transform .6s}
.sous-card:hover img{transform:scale(1.06)}
.sous-card .sc-overlay{position:absolute;inset:0;background:linear-gradient(to top,rgba(61,32,48,.65) 0%,transparent 55%);display:flex;flex-direction:column;justify-content:flex-end;padding:20px}
.sous-card .sc-nom{font-family:var(--f-titre);font-size:18px;font-weight:300;color:var(--blanc);line-height:1.2}
.sous-card .sc-nb{font-size:10px;letter-spacing:1.5px;text-transform:uppercase;color:rgba(255,255,255,.6);margin-top:4px}
.sous-card .sc-arrow{position:absolute;top:14px;right:14px;width:32px;height:32px;background:rgba(255,255,255,.15);border-radius:50%;display:flex;align-items:center;justify-content:center;color:var(--blanc);font-size:11px;opacity:0;transition:var(--trans)}
.sous-card:hover .sc-arrow{opacity:1}

/* hauteurs */
.h-tall{height:380px}
.h-med {height:260px}
.h-sm  {height:180px}

/* ── Bandeau séparateur ── */
.coll-band{background:linear-gradient(135deg,var(--brun-d),var(--brun-2));padding:50px;text-align:center;border-radius:var(--rayon);margin-bottom:80px}
.coll-band p{font-family:var(--f-script);font-size:32px;color:var(--rose-p);margin-bottom:16px}
.coll-band span{font-size:13px;color:rgba(255,255,255,.5);letter-spacing:2px;text-transform:uppercase}

/* Responsive */
@media(max-width:1000px){.sous-grid.col4{grid-template-columns:repeat(2,1fr)}.sous-grid.mix{grid-template-columns:1fr 1fr}.coll-layout{padding:40px 24px}}
@media(max-width:600px){.sous-grid.col4,.sous-grid.col3,.sous-grid.mix,.sous-grid.col2{grid-template-columns:1fr}.page-hero{padding:50px 24px}}
</style>
@endpush

@section('content')

{{-- Hero --}}
<div class="page-hero">
    <span class="s-label">Univers JEKP</span>
    <h1 class="s-titre">Nos <em>Collections</em></h1>
    <p style="font-size:14px;color:var(--texte2);margin-top:12px;max-width:500px;margin-left:auto;margin-right:auto;line-height:1.8">Des créations artisanales pour chaque moment de vie — la maison, la mode, l'enfance et tous vos accessoires préférés.</p>
    <div class="breadcrumb">
        <a href="{{ route('home') }}">Accueil</a>
        <i class="fas fa-chevron-right" style="font-size:9px"></i>
        <span>Collections</span>
    </div>
</div>

<div class="coll-layout">

    {{-- ══════ MAISON ══════ --}}
    <div class="coll-bloc">
        <div class="coll-bloc-header">
            <div>
                <span style="font-family:var(--f-script);font-size:20px;color:var(--rose-v)">Collection</span>
                <h2 class="coll-bloc-title"><em>Maison</em></h2>
                <div class="coll-sep"></div>
            </div>
            <a href="{{ route('categories.show', 'maison') }}" class="coll-voir">Tout voir <i class="fas fa-arrow-right"></i></a>
        </div>
        <div class="sous-grid mix">
            <a href="{{ route('categories.show', 'maison') }}" class="sous-card h-tall">
                <img src="{{ asset('assets/images/jepk39.jpg') }}" alt="Coussins">
                <div class="sc-overlay">
                    <span class="sc-nom">Coussins</span>
                    <span class="sc-nb">Décoration intérieure</span>
                </div>
                <div class="sc-arrow"><i class="fas fa-arrow-right"></i></div>
            </a>
            <div style="display:flex;flex-direction:column;gap:18px">
                <a href="{{ route('categories.show', 'maison') }}" class="sous-card h-med">
                    <img src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=500&q=80" alt="Nappes">
                    <div class="sc-overlay">
                        <span class="sc-nom">Nappes & Sets de table</span>
                        <span class="sc-nb">Art de la table</span>
                    </div>
                    <div class="sc-arrow"><i class="fas fa-arrow-right"></i></div>
                </a>
                <a href="{{ route('categories.show', 'maison') }}" class="sous-card" style="height:144px">
                    <img src="https://images.unsplash.com/photo-1506439773649-6e0eb8cfb237?w=500&q=80" alt="Plaids">
                    <div class="sc-overlay">
                        <span class="sc-nom">Plaids & Couvertures</span>
                        <span class="sc-nb">Confort & chaleur</span>
                    </div>
                    <div class="sc-arrow"><i class="fas fa-arrow-right"></i></div>
                </a>
            </div>
            <div style="display:flex;flex-direction:column;gap:18px">
                <a href="{{ route('categories.show', 'maison') }}" class="sous-card" style="height:144px">
                    <img src="https://images.unsplash.com/photo-1616486338812-3dadae4b4ace?w=500&q=80" alt="Déco">
                    <div class="sc-overlay">
                        <span class="sc-nom">Décorations</span>
                        <span class="sc-nb">Objets & ornements</span>
                    </div>
                    <div class="sc-arrow"><i class="fas fa-arrow-right"></i></div>
                </a>
                <a href="{{ route('categories.show', 'maison') }}" class="sous-card h-med">
                    <img src="https://images.unsplash.com/photo-1484101403633-562f891dc89a?w=500&q=80" alt="Tapis">
                    <div class="sc-overlay">
                        <span class="sc-nom">Tapis & Descentes de lit</span>
                        <span class="sc-nb">Sol & ambiance</span>
                    </div>
                    <div class="sc-arrow"><i class="fas fa-arrow-right"></i></div>
                </a>
            </div>
        </div>
    </div>

    {{-- ══════ ADULTE ══════ --}}
    <div class="coll-bloc">
        <div class="coll-bloc-header">
            <div>
                <span style="font-family:var(--f-script);font-size:20px;color:var(--rose-v)">Collection</span>
                <h2 class="coll-bloc-title"><em>Adulte</em></h2>
                <div class="coll-sep"></div>
            </div>
            <a href="{{ route('categories.show', 'adulte') }}" class="coll-voir">Tout voir <i class="fas fa-arrow-right"></i></a>
        </div>
        <div class="sous-grid col4">
            <a href="{{ route('categories.show', 'adulte') }}" class="sous-card h-med">
                <img src="https://images.unsplash.com/photo-1434389677669-e08b4cac3105?w=500&q=80" alt="Pulls">
                <div class="sc-overlay">
                    <span class="sc-nom">Pulls & Gilets</span>
                    <span class="sc-nb">Mode femme</span>
                </div>
                <div class="sc-arrow"><i class="fas fa-arrow-right"></i></div>
            </a>
            <a href="{{ route('categories.show', 'adulte') }}" class="sous-card h-med">
                <img src="https://images.unsplash.com/photo-1520903920243-00d872a2d1c9?w=500&q=80" alt="Écharpes">
                <div class="sc-overlay">
                    <span class="sc-nom">Écharpes & Châles</span>
                    <span class="sc-nb">Accessoires mode</span>
                </div>
                <div class="sc-arrow"><i class="fas fa-arrow-right"></i></div>
            </a>
            <a href="{{ route('categories.show', 'adulte') }}" class="sous-card h-med">
                <img src="https://images.unsplash.com/photo-1576566588028-4147f3842f27?w=500&q=80" alt="Bonnets">
                <div class="sc-overlay">
                    <span class="sc-nom">Bonnets & Bérets</span>
                    <span class="sc-nb">Tête & cheveux</span>
                </div>
                <div class="sc-arrow"><i class="fas fa-arrow-right"></i></div>
            </a>
            <a href="{{ route('categories.show', 'adulte') }}" class="sous-card h-med">
                <img src="https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=500&q=80" alt="Cardigans">
                <div class="sc-overlay">
                    <span class="sc-nom">Cardigans & Vestes</span>
                    <span class="sc-nb">Pièces signatures</span>
                </div>
                <div class="sc-arrow"><i class="fas fa-arrow-right"></i></div>
            </a>
        </div>
    </div>

    {{-- ══════ BANDEAU ══════ --}}
    <div class="coll-band">
        <p>Chaque création est unique</p>
        <span>Toutes nos pièces sont faites à la main avec amour ✦ Sur mesure disponible</span>
        <div style="margin-top:24px">
            <a href="{{ route('home') }}#sur-mesure" class="btn btn-outline">
                <i class="fas fa-magic"></i> Commander sur mesure
            </a>
        </div>
    </div>

    {{-- ══════ ENFANT ══════ --}}
    <div class="coll-bloc">
        <div class="coll-bloc-header">
            <div>
                <span style="font-family:var(--f-script);font-size:20px;color:var(--rose-v)">Collection</span>
                <h2 class="coll-bloc-title"><em>Enfant</em></h2>
                <div class="coll-sep"></div>
            </div>
            <a href="{{ route('categories.show', 'enfant') }}" class="coll-voir">Tout voir <i class="fas fa-arrow-right"></i></a>
        </div>
        <div class="sous-grid col2">
            <a href="{{ route('categories.show', 'enfant') }}" class="sous-card h-tall">
                <img src="https://images.unsplash.com/photo-1515488042361-ee00e0ddd4e4?w=700&q=80" alt="Layettes">
                <div class="sc-overlay">
                    <span class="sc-nom">Layettes & Naissance</span>
                    <span class="sc-nb">Pour les tout-petits</span>
                </div>
                <div class="sc-arrow"><i class="fas fa-arrow-right"></i></div>
            </a>
            <div style="display:flex;flex-direction:column;gap:18px">
                <a href="{{ route('categories.show', 'enfant') }}" class="sous-card h-med">
                    <img src="https://images.unsplash.com/photo-1558618047-3c8c5d20c2c3?w=500&q=80" alt="Doudous">
                    <div class="sc-overlay">
                        <span class="sc-nom">Doudous & Peluches</span>
                        <span class="sc-nb">Compagnons de jeux</span>
                    </div>
                    <div class="sc-arrow"><i class="fas fa-arrow-right"></i></div>
                </a>
                <a href="{{ route('categories.show', 'enfant') }}" class="sous-card h-med">
                    <img src="https://images.unsplash.com/photo-1471286174890-9c112ffca5b4?w=500&q=80" alt="Vêtements enfant">
                    <div class="sc-overlay">
                        <span class="sc-nom">Vêtements Enfant</span>
                        <span class="sc-nb">Pulls, bonnets, écharpes</span>
                    </div>
                    <div class="sc-arrow"><i class="fas fa-arrow-right"></i></div>
                </a>
            </div>
        </div>
    </div>

    {{-- ══════ ACCESSOIRES ══════ --}}
    <div class="coll-bloc">
        <div class="coll-bloc-header">
            <div>
                <span style="font-family:var(--f-script);font-size:20px;color:var(--rose-v)">Collection</span>
                <h2 class="coll-bloc-title"><em>Accessoires</em></h2>
                <div class="coll-sep"></div>
            </div>
            <a href="{{ route('categories.show', 'accessoires') }}" class="coll-voir">Tout voir <i class="fas fa-arrow-right"></i></a>
        </div>
        <div class="sous-grid col3">
            <a href="{{ route('categories.show', 'accessoires') }}" class="sous-card h-med">
                <img src="https://images.unsplash.com/photo-1553062407-98eeb64c6a62?w=500&q=80" alt="Sacs">
                <div class="sc-overlay">
                    <span class="sc-nom">Sacs & Pochettes</span>
                    <span class="sc-nb">Tote bags, clutchs…</span>
                </div>
                <div class="sc-arrow"><i class="fas fa-arrow-right"></i></div>
            </a>
            <a href="{{ route('categories.show', 'accessoires') }}" class="sous-card h-med">
                <img src="https://images.unsplash.com/photo-1599643478518-a784e5dc4c8f?w=500&q=80" alt="Bijoux">
                <div class="sc-overlay">
                    <span class="sc-nom">Bijoux & Parures</span>
                    <span class="sc-nb">Colliers, bracelets…</span>
                </div>
                <div class="sc-arrow"><i class="fas fa-arrow-right"></i></div>
            </a>
            <a href="{{ route('categories.show', 'accessoires') }}" class="sous-card h-med">
                <img src="https://images.unsplash.com/photo-1607344645866-009c320b63e0?w=500&q=80" alt="Cadeaux">
                <div class="sc-overlay">
                    <span class="sc-nom">Idées Cadeaux</span>
                    <span class="sc-nb">Coffrets & surprises</span>
                </div>
                <div class="sc-arrow"><i class="fas fa-arrow-right"></i></div>
            </a>
        </div>
    </div>

</div>

@endsection