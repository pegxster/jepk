@extends('layouts.app')
@section('title','Boutique — JEKP Store')
@push('styles')
<style>
.shop-hero{background:linear-gradient(135deg,var(--creme2),var(--peche),var(--lavande));padding:60px 50px;text-align:center;border-bottom:1px solid var(--peche)}
.shop-hero .s-label{font-size:24px}
.shop-hero .s-titre{margin:6px 0 14px}
.breadcrumb{display:flex;gap:8px;align-items:center;font-size:11px;color:var(--texte2);letter-spacing:1px;justify-content:center;margin-top:18px}
.breadcrumb a{color:var(--texte2);text-decoration:none;transition:color .3s}.breadcrumb a:hover{color:var(--rose-v)}
.breadcrumb span{color:var(--rose-p)}

.shop-layout{max-width:1360px;margin:0 auto;padding:50px 50px;display:grid;grid-template-columns:240px 1fr;gap:50px;align-items:start}

/* Sidebar filtres */
.sidebar h3{font-family:var(--f-titre);font-size:18px;font-weight:300;color:var(--texte);margin-bottom:6px}
.sidebar-section{margin-bottom:32px;padding-bottom:28px;border-bottom:1px solid var(--peche)}
.sidebar-section:last-child{border-bottom:none}
.sidebar-label{font-size:10px;letter-spacing:2px;text-transform:uppercase;color:var(--texte2);font-weight:500;margin-bottom:14px;display:block}
.cat-liste{list-style:none}
.cat-liste li{margin-bottom:7px}
.cat-liste a{
    display:flex;justify-content:space-between;align-items:center;
    text-decoration:none;color:var(--texte2);font-size:13px;
    padding:7px 12px;border-radius:8px;transition:var(--trans);
}
.cat-liste a:hover,.cat-liste a.on{background:var(--peche);color:var(--rose-v)}
.cat-liste span{font-size:11px;background:var(--creme2);padding:2px 8px;border-radius:50px;color:var(--texte2)}
.prix-range{width:100%;accent-color:var(--rose-v)}
.prix-vals{display:flex;justify-content:space-between;font-size:12px;color:var(--texte2);margin-top:8px}
.coul-liste{display:flex;flex-wrap:wrap;gap:8px;margin-top:4px}
.coul-item{width:28px;height:28px;border-radius:50%;cursor:pointer;border:2px solid transparent;transition:var(--trans)}
.coul-item.on{border-color:var(--rose-v);transform:scale(1.1)}

/* Produits zone */
.shop-top{display:flex;justify-content:space-between;align-items:center;margin-bottom:28px;flex-wrap:wrap;gap:12px}
.shop-count{font-size:13px;color:var(--texte2)}
.shop-sort{padding:9px 14px;border:1.5px solid var(--peche);border-radius:8px;background:transparent;font-family:var(--f-corps);font-size:13px;color:var(--texte);outline:none;cursor:pointer}
.shop-sort:focus{border-color:var(--rose-v)}
.shop-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:24px}
/* Réutilise styles produits home */
.p-carte{position:relative}
.p-img{position:relative;overflow:hidden;aspect-ratio:3/4;border-radius:var(--rayon);margin-bottom:14px;background:var(--beige)}
.p-img img{width:100%;height:100%;object-fit:cover;transition:transform .7s;display:block}
.p-carte:hover .p-img img{transform:scale(1.06)}
.p-badge{position:absolute;top:11px;left:11px;font-size:9px;letter-spacing:2px;text-transform:uppercase;padding:5px 12px;border-radius:50px;font-weight:500}
.b-n{background:var(--rose-v);color:var(--blanc)}.b-p{background:var(--lavande2);color:var(--blanc)}
.p-act{position:absolute;top:11px;right:11px;display:flex;flex-direction:column;gap:7px;opacity:0;transform:translateX(10px);transition:var(--trans)}
.p-carte:hover .p-act{opacity:1;transform:translateX(0)}
.p-btn{width:36px;height:36px;background:var(--blanc);border:none;border-radius:50%;cursor:pointer;display:flex;align-items:center;justify-content:center;font-size:13px;color:var(--texte);box-shadow:var(--ombre-sm);transition:var(--trans)}
.p-btn:hover{background:var(--rose-v);color:var(--blanc)}
.p-cart{position:absolute;bottom:0;left:0;right:0;background:linear-gradient(0deg,rgba(90,48,64,.9),transparent);padding:28px 14px 14px;transform:translateY(100%);transition:transform .4s;border-radius:0 0 var(--rayon) var(--rayon)}
.p-carte:hover .p-cart{transform:translateY(0)}
.p-cart .btn{width:100%;justify-content:center;font-size:10px}
.p-cat{font-size:10px;color:var(--rose-v);letter-spacing:2px;text-transform:uppercase;margin-bottom:3px;display:block}
.p-nom{font-family:var(--f-titre);font-size:18px;font-weight:300;color:var(--texte);text-decoration:none;display:block;margin-bottom:6px;transition:color .3s}
.p-nom:hover{color:var(--rose-v)}
.p-prix-l{display:flex;align-items:center;gap:9px}
.p-prix{font-size:16px;font-weight:400;color:var(--brun-d)}
.p-prix-b{font-size:12px;color:var(--texte2);text-decoration:line-through}

/* Pagination */
.pagination{display:flex;gap:8px;justify-content:center;margin-top:50px}
.page-btn{width:38px;height:38px;border:1.5px solid var(--peche);background:transparent;border-radius:8px;display:flex;align-items:center;justify-content:center;font-family:var(--f-corps);font-size:13px;color:var(--texte2);cursor:pointer;transition:var(--trans);text-decoration:none}
.page-btn.on,.page-btn:hover{background:var(--rose-v);border-color:var(--rose-v);color:var(--blanc)}

@media(max-width:900px){.shop-layout{grid-template-columns:1fr;padding:30px 24px}.sidebar{display:none}.shop-grid{grid-template-columns:1fr 1fr}}
@media(max-width:500px){.shop-grid{grid-template-columns:1fr}}
</style>
@endpush

@section('content')
<div class="shop-hero">
    <span class="s-label">JEKP Store</span>
    <h1 class="s-titre">Notre <em>Boutique</em></h1>
    <div class="breadcrumb"><a href="{{ route('home') }}">Accueil</a> <i class="fas fa-chevron-right" style="font-size:9px"></i> <span>Boutique</span></div>
</div>

<div class="shop-layout">
    {{-- SIDEBAR --}}
    <aside class="sidebar">
        <div class="sidebar-section">
            <span class="sidebar-label">Catégories</span>
            <ul class="cat-liste">
                <li><a href="#" class="on">Tout voir <span>320</span></a></li>
                <li><a href="#">Fils & Laines <span>48</span></a></li>
                <li><a href="#">Kits Signature <span>24</span></a></li>
                <li><a href="#">Aiguilles <span>36</span></a></li>
                <li><a href="#">Accessoires <span>60</span></a></li>
                <li><a href="#">Nouveautés <span>18</span></a></li>
            </ul>
        </div>
        <div class="sidebar-section">
            <span class="sidebar-label">Prix</span>
            <input type="range" class="prix-range" min="0" max="200" value="200">
            <div class="prix-vals"><span>0 €</span><span>200 €</span></div>
        </div>
        <div class="sidebar-section">
            <span class="sidebar-label">Couleurs</span>
            <div class="coul-liste">
                <div class="coul-item" style="background:#e8d5c8" title="Nude"></div>
                <div class="coul-item on" style="background:#c97080" title="Rose"></div>
                <div class="coul-item" style="background:#b8a4d4" title="Lavande"></div>
                <div class="coul-item" style="background:#8b5e3c" title="Camel"></div>
                <div class="coul-item" style="background:#f5f5f5;border:1px solid #ddd" title="Blanc"></div>
                <div class="coul-item" style="background:#3d2030" title="Brun"></div>
                <div class="coul-item" style="background:#7ab5a0" title="Sauge"></div>
                <div class="coul-item" style="background:#f0d080" title="Miel"></div>
            </div>
        </div>
        <div class="sidebar-section">
            <span class="sidebar-label">Matière</span>
            <ul class="cat-liste">
                <li><a href="#">Mérinos</a></li>
                <li><a href="#">Alpaga</a></li>
                <li><a href="#">Mohair & Soie</a></li>
                <li><a href="#">Coton</a></li>
                <li><a href="#">Mixte</a></li>
            </ul>
        </div>
        <div class="sidebar-section">
            <span class="sidebar-label">Niveau</span>
            <ul class="cat-liste">
                <li><a href="#">Débutante</a></li>
                <li><a href="#">Intermédiaire</a></li>
                <li><a href="#">Experte</a></li>
            </ul>
        </div>
    </aside>

    {{-- PRODUITS --}}
    <div>
        <div class="shop-top">
            <span class="shop-count">320 produits trouvés</span>
            <div style="display:flex;gap:10px;align-items:center">
                <select class="shop-sort">
                    <option>Popularité</option>
                    <option>Prix croissant</option>
                    <option>Prix décroissant</option>
                    <option>Nouveautés</option>
                </select>
            </div>
        </div>
        <div class="shop-grid">
            @php $dp=[['nom'=>'Laine Mérinos Soyeux','cat'=>'Fils Rares','prix'=>'22,90','anc'=>null,'badge'=>'n','img'=>'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=500'],['nom'=>'Kit Pull Couture N°1','cat'=>'Kits Signature','prix'=>'68,00','anc'=>'85,00','badge'=>'p','img'=>'https://images.unsplash.com/photo-1584917865442-de89be371e2b?w=500'],['nom'=>'Aiguilles Bambou Premium','cat'=>'Accessoires','prix'=>'18,50','anc'=>null,'badge'=>null,'img'=>'https://images.unsplash.com/photo-1574359411659-15573a27fd0c?w=500'],['nom'=>'Alpaga des Andes Naturel','cat'=>'Fils Rares','prix'=>'28,50','anc'=>null,'badge'=>'n','img'=>'https://images.unsplash.com/photo-1616400619175-5beda3a17896?w=500'],['nom'=>'Kit Écharpe Hiver Doux','cat'=>'Kits Signature','prix'=>'42,00','anc'=>null,'badge'=>null,'img'=>'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=500'],['nom'=>'Mohair & Soie Précieux','cat'=>'Fils Rares','prix'=>'32,00','anc'=>'40,00','badge'=>'p','img'=>'https://images.unsplash.com/photo-1584917865442-de89be371e2b?w=500'],['nom'=>'Trousse Range-Aiguilles','cat'=>'Accessoires','prix'=>'24,00','anc'=>null,'badge'=>'n','img'=>'https://images.unsplash.com/photo-1574359411659-15573a27fd0c?w=500'],['nom'=>'Kit Bonnet Débutant','cat'=>'Kits Signature','prix'=>'29,00','anc'=>null,'badge'=>null,'img'=>'https://images.unsplash.com/photo-1616400619175-5beda3a17896?w=500'],['nom'=>'Laine Cachemire Nude','cat'=>'Fils Rares','prix'=>'45,00','anc'=>null,'badge'=>'n','img'=>'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=500']]; @endphp
            @foreach(isset($products) && count($products) ? $products : $dp as $i=>$p)
            <div class="p-carte">
                <div class="p-img">
                    <img src="{{ $p['img'] ?? $p->image }}" alt="{{ $p['nom'] ?? $p->name }}">
                    @if(($p['badge']??null)==='n')<span class="p-badge b-n">Nouveau</span>
                    @elseif(($p['badge']??null)==='p')<span class="p-badge b-p">Promo</span>@endif
                    <div class="p-act">
                        <button class="p-btn"><i class="far fa-heart"></i></button>
                        <button class="p-btn"><i class="far fa-eye"></i></button>
                    </div>
                    <div class="p-cart"><a href="#" class="btn btn-blanc">Ajouter au panier</a></div>
                </div>
                <span class="p-cat">{{ $p['cat'] ?? ($p->category->name ?? '') }}</span>
                <a href="#" class="p-nom">{{ $p['nom'] ?? $p->name }}</a>
                <div class="p-prix-l">
                    <span class="p-prix">{{ $p['prix'] ?? number_format($p->price,2,',',' ') }} €</span>
                    @if($p['anc'] ?? false)<span class="p-prix-b">{{ $p['anc'] }} €</span>@endif
                </div>
            </div>
            @endforeach
        </div>
        <div class="pagination">
            <a href="#" class="page-btn"><i class="fas fa-chevron-left" style="font-size:11px"></i></a>
            <a href="#" class="page-btn on">1</a>
            <a href="#" class="page-btn">2</a>
            <a href="#" class="page-btn">3</a>
            <span class="page-btn" style="border:none;cursor:default">…</span>
            <a href="#" class="page-btn">12</a>
            <a href="#" class="page-btn"><i class="fas fa-chevron-right" style="font-size:11px"></i></a>
        </div>
    </div>
</div>
@endsection