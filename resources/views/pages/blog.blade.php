@extends('layouts.app')
@section('title','Blog — JEKP Store')

@push('styles')
<style>
.page-hero{background:linear-gradient(135deg,var(--creme2),var(--peche),var(--lavande));padding:70px 50px;text-align:center;border-bottom:1px solid var(--peche)}
.breadcrumb{display:flex;gap:8px;align-items:center;font-size:11px;color:var(--texte2);justify-content:center;margin-top:14px}
.breadcrumb a{color:var(--texte2);text-decoration:none}.breadcrumb a:hover{color:var(--rose-v)}
.breadcrumb span{color:var(--rose-p)}
.blog-layout{max-width:1200px;margin:0 auto;padding:64px 50px}
.blog-cats{display:flex;gap:8px;flex-wrap:wrap;margin-bottom:48px;justify-content:center}
.blog-cat-btn{padding:8px 20px;font-size:10px;letter-spacing:2px;text-transform:uppercase;background:transparent;border:1.5px solid var(--peche2);color:var(--texte2);cursor:pointer;border-radius:50px;transition:var(--trans);font-family:var(--f-corps);text-decoration:none}
.blog-cat-btn.on,.blog-cat-btn:hover{background:var(--rose-v);color:var(--blanc);border-color:var(--rose-v)}
.blog-grid-principale{display:grid;grid-template-columns:1.5fr 1fr;gap:24px;margin-bottom:24px}
.blog-card{border-radius:var(--rayon);overflow:hidden;background:var(--blanc);box-shadow:var(--ombre-sm);transition:var(--trans);text-decoration:none;display:block}
.blog-card:hover{transform:translateY(-5px);box-shadow:var(--ombre)}
.blog-img{overflow:hidden}
.blog-img img{width:100%;height:100%;object-fit:cover;transition:transform .7s;display:block}
.blog-card:hover .blog-img img{transform:scale(1.05)}
.blog-principale .blog-img{height:300px}
.blog-card.secondaire .blog-img{height:200px}
.blog-body{padding:22px}
.blog-cat-tag{font-size:9px;letter-spacing:2px;text-transform:uppercase;color:var(--rose-v);margin-bottom:8px;display:block}
.blog-titre{font-family:var(--f-titre);font-size:22px;font-weight:300;color:var(--texte);margin-bottom:10px;line-height:1.4}
.blog-card.secondaire .blog-titre{font-size:17px}
.blog-extrait{font-size:13px;color:var(--texte2);line-height:1.8;margin-bottom:16px}
.blog-meta{display:flex;justify-content:space-between;align-items:center;font-size:11px;color:var(--texte2)}
.blog-meta span{display:flex;align-items:center;gap:5px}
.blog-grid-3{display:grid;grid-template-columns:repeat(3,1fr);gap:22px}
@media(max-width:900px){.blog-layout{padding:40px 24px}.blog-grid-principale{grid-template-columns:1fr}.blog-grid-3{grid-template-columns:1fr 1fr}}
@media(max-width:500px){.blog-grid-3{grid-template-columns:1fr}}
</style>
@endpush

@section('content')

<div class="page-hero">
    <span class="s-label">Le blog JEKP</span>
    <h1 class="s-titre">Inspirations & <em>Conseils</em></h1>
    <p style="font-size:14px;color:var(--texte2);margin-top:12px;max-width:460px;margin-left:auto;margin-right:auto;line-height:1.8">Tutoriels, tendances, matières et idées de créations pour vous inspirer au quotidien.</p>
    <div class="breadcrumb">
        <a href="{{ route('home') }}">Accueil</a>
        <i class="fas fa-chevron-right" style="font-size:9px"></i>
        <span>Blog</span>
    </div>
</div>

<div class="blog-layout">

    <div class="blog-cats">
        <a href="#" class="blog-cat-btn on">Tout</a>
        <a href="#" class="blog-cat-btn">Tutoriels</a>
        <a href="#" class="blog-cat-btn">Tendances</a>
        <a href="#" class="blog-cat-btn">Matières</a>
        <a href="#" class="blog-cat-btn">Sur mesure</a>
        <a href="#" class="blog-cat-btn">Inspiration</a>
    </div>

    <div class="blog-grid-principale">

        <a href="#" class="blog-card blog-principale">
            <div class="blog-img">
                <img src="https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=800&q=80" alt="Article principal">
            </div>
            <div class="blog-body">
                <span class="blog-cat-tag">Tutoriels</span>
                <h2 class="blog-titre">Comment réussir son premier pull : guide complet pour débutantes</h2>
                <p class="blog-extrait">Découvrez toutes les étapes, les astuces et les erreurs à éviter pour tricoter votre premier pull avec succès.</p>
                <div class="blog-meta">
                    <span><i class="far fa-calendar"></i> 18 Fév. 2024</span>
                    <span><i class="far fa-clock"></i> 8 min de lecture</span>
                </div>
            </div>
        </a>

        <div>
            <a href="#" class="blog-card secondaire" style="margin-bottom:22px">
                <div class="blog-img">
                    <img src="https://images.unsplash.com/photo-1584917865442-de89be371e2b?w=600&q=80" alt="Article 2">
                </div>
                <div class="blog-body">
                    <span class="blog-cat-tag">Tendances</span>
                    <h3 class="blog-titre">Les couleurs de la saison : tons doux et naturels à la une</h3>
                    <div class="blog-meta">
                        <span><i class="far fa-calendar"></i> 12 Fév. 2024</span>
                    </div>
                </div>
            </a>

            <a href="#" class="blog-card secondaire">
                <div class="blog-img">
                    <img src="https://images.unsplash.com/photo-1574359411659-15573a27fd0c?w=600&q=80" alt="Article 3">
                </div>
                <div class="blog-body">
                    <span class="blog-cat-tag">Matières</span>
                    <h3 class="blog-titre">Mérinos, alpaga, mohair : comment choisir son fil ?</h3>
                    <div class="blog-meta">
                        <span><i class="far fa-calendar"></i> 5 Fév. 2024</span>
                    </div>
                </div>
            </a>
        </div>

    </div>

    <h3 style="font-family:var(--f-titre);font-size:26px;font-weight:300;color:var(--texte);margin:44px 0 28px">Derniers <em>articles</em></h3>

    <div class="blog-grid-3">

        <a href="#" class="blog-card">
            <div class="blog-img" style="height:180px">
                <img src="https://images.unsplash.com/photo-1616400619175-5beda3a17896?w=500&q=80" alt="Article 4">
            </div>
            <div class="blog-body">
                <span class="blog-cat-tag">Inspiration</span>
                <h3 class="blog-titre" style="font-size:16px">5 idées de cadeaux faits main pour Noël</h3>
                <div class="blog-meta">
                    <span><i class="far fa-calendar"></i> 15 Jan. 2024</span>
                    <span><i class="far fa-clock"></i> 5 min</span>
                </div>
            </div>
        </a>

        <a href="#" class="blog-card">
            <div class="blog-img" style="height:180px">
                <img src="https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=500&q=80" alt="Article 5">
            </div>
            <div class="blog-body">
                <span class="blog-cat-tag">Sur mesure</span>
                <h3 class="blog-titre" style="font-size:16px">Ma première commande sur mesure : témoignage</h3>
                <div class="blog-meta">
                    <span><i class="far fa-calendar"></i> 8 Jan. 2024</span>
                    <span><i class="far fa-clock"></i> 4 min</span>
                </div>
            </div>
        </a>

        <a href="#" class="blog-card">
            <div class="blog-img" style="height:180px">
                <img src="https://images.unsplash.com/photo-1584917865442-de89be371e2b?w=500&q=80" alt="Article 6">
            </div>
            <div class="blog-body">
                <span class="blog-cat-tag">Tutoriels</span>
                <h3 class="blog-titre" style="font-size:16px">Point mousse vs jersey : lequel choisir pour débuter ?</h3>
                <div class="blog-meta">
                    <span><i class="far fa-calendar"></i> 2 Jan. 2024</span>
                    <span><i class="far fa-clock"></i> 6 min</span>
                </div>
            </div>
        </a>

    </div>

</div>

@endsection