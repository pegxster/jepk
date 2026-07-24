@extends('layouts.app')
@section('title', 'Boutique — JEKP Store')
@push('styles')
<style>
/* ── Hero ── */
.shop-hero{
    background:linear-gradient(135deg,var(--creme2) 0%,var(--blanc) 50%,var(--peche) 100%);
    padding:80px 50px 60px;text-align:center;border-bottom:1px solid var(--peche);
    position:relative;overflow:hidden;
}
.shop-hero::before{
    content:'';position:absolute;right:-120px;top:-120px;
    width:420px;height:420px;border-radius:50%;
    background:linear-gradient(135deg,var(--peche),var(--rose-p));opacity:.1;pointer-events:none;
}
.shop-hero::after{
    content:'';position:absolute;left:-80px;bottom:-80px;
    width:260px;height:260px;border-radius:50%;
    background:var(--lavande);opacity:.18;pointer-events:none;
}
.shop-hero .s-label{font-size:24px}
.shop-hero .s-titre{margin:6px 0 16px}
.hero-tags{display:flex;gap:8px;justify-content:center;flex-wrap:wrap;margin-bottom:18px;position:relative;z-index:1}
.hero-tag{font-size:10px;letter-spacing:1.5px;text-transform:uppercase;color:var(--texte2);
    background:var(--blanc);padding:6px 16px;border-radius:50px;border:1px solid var(--peche);
    box-shadow:var(--ombre-sm)}
.breadcrumb{display:flex;gap:8px;align-items:center;font-size:11px;color:var(--texte2);
    letter-spacing:1px;justify-content:center;margin-top:0;position:relative;z-index:1}
.breadcrumb a{color:var(--texte2);text-decoration:none;transition:color .3s}.breadcrumb a:hover{color:var(--rose-v)}
.breadcrumb span{color:var(--rose-p)}

/* ── Layout ── */
.shop-layout{max-width:1360px;margin:0 auto;padding:50px 50px;
    display:grid;grid-template-columns:260px 1fr;gap:40px;align-items:start}

/* ── Sidebar ── */
.sidebar{background:var(--blanc);border-radius:16px;padding:28px;
    box-shadow:var(--ombre-sm);border:1px solid var(--peche);position:sticky;top:100px}
.sidebar-header{display:flex;align-items:center;justify-content:space-between;
    margin-bottom:22px;padding-bottom:16px;border-bottom:1.5px solid var(--peche)}
.sidebar-header h3{font-family:var(--f-titre);font-size:19px;font-weight:300;color:var(--texte)}
.sidebar-reset{font-size:10px;letter-spacing:1px;text-transform:uppercase;color:var(--rose-v);
    text-decoration:none;font-family:var(--f-corps);transition:color .3s;cursor:pointer}
.sidebar-reset:hover{color:var(--rose-f)}
.sidebar-section{margin-bottom:26px;padding-bottom:22px;border-bottom:1px solid var(--peche)}
.sidebar-section:last-child{border-bottom:none;margin-bottom:0;padding-bottom:0}
.sidebar-label{font-size:10px;letter-spacing:2px;text-transform:uppercase;color:var(--texte2);
    font-weight:500;margin-bottom:12px;display:block}
.cat-liste{list-style:none}
.cat-liste li{margin-bottom:3px}
.cat-liste a{display:flex;justify-content:space-between;align-items:center;text-decoration:none;
    color:var(--texte2);font-size:13px;padding:8px 12px;border-radius:8px;transition:var(--trans);cursor:pointer}
.cat-liste a:hover,.cat-liste a.on{background:var(--peche);color:var(--rose-v);font-weight:500}
.cat-liste span{font-size:11px;background:var(--creme2);padding:2px 8px;border-radius:50px;color:var(--texte2)}
.prix-range{width:100%;accent-color:var(--rose-v);cursor:pointer}
.prix-vals{display:flex;justify-content:space-between;font-size:12px;color:var(--texte2);margin-top:8px}
.coul-liste{display:flex;flex-wrap:wrap;gap:8px;margin-top:4px}
.coul-item{width:30px;height:30px;border-radius:50%;cursor:pointer;border:2.5px solid transparent;
    transition:var(--trans);position:relative}
.coul-item:hover,.coul-item.on{border-color:var(--rose-v);transform:scale(1.15);
    box-shadow:0 2px 10px rgba(201,112,128,.35)}

/* ── Barre haut produits ── */
.shop-top{display:flex;justify-content:space-between;align-items:center;margin-bottom:24px;
    flex-wrap:wrap;gap:12px;background:var(--blanc);border-radius:12px;
    padding:14px 20px;border:1px solid var(--peche);box-shadow:var(--ombre-sm)}
.shop-count{font-size:13px;color:var(--texte2)}
.shop-count strong{color:var(--rose-v);font-weight:500}
.shop-sort{padding:8px 14px;border:1.5px solid var(--peche);border-radius:8px;background:var(--blanc);
    font-family:var(--f-corps);font-size:13px;color:var(--texte);outline:none;cursor:pointer;transition:border-color .3s}
.shop-sort:focus{border-color:var(--rose-v)}

/* ── Grille produits ── */
.shop-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:24px}
.p-carte{position:relative;background:var(--blanc);border-radius:var(--rayon);overflow:hidden;
    box-shadow:var(--ombre-sm);transition:var(--trans)}
.p-carte:hover{transform:translateY(-6px);box-shadow:var(--ombre)}
.p-img{position:relative;overflow:hidden;aspect-ratio:3/4;background:var(--beige)}
.p-img img{width:100%;height:100%;object-fit:cover;transition:transform .65s ease;display:block}
.p-carte:hover .p-img img{transform:scale(1.07)}
.p-badge{position:absolute;top:11px;left:11px;font-size:9px;letter-spacing:2px;text-transform:uppercase;
    padding:5px 13px;border-radius:50px;font-weight:500;z-index:2}
.b-n{background:var(--rose-v);color:var(--blanc)}.b-p{background:var(--lavande2);color:var(--blanc)}
.p-act{position:absolute;top:11px;right:11px;display:flex;flex-direction:column;gap:7px;
    opacity:0;transform:translateX(12px);transition:var(--trans);z-index:2}
.p-carte:hover .p-act{opacity:1;transform:translateX(0)}
.p-btn{width:38px;height:38px;background:var(--blanc);border:none;border-radius:50%;cursor:pointer;
    display:flex;align-items:center;justify-content:center;font-size:13px;color:var(--texte);
    box-shadow:0 2px 12px rgba(90,48,64,.12);transition:var(--trans)}
.p-btn:hover,.p-btn.active{background:var(--rose-v);color:var(--blanc);box-shadow:0 4px 16px rgba(201,112,128,.4)}
.p-cart{position:absolute;bottom:0;left:0;right:0;
    background:linear-gradient(0deg,rgba(90,48,64,.88),transparent);
    padding:32px 14px 14px;transform:translateY(100%);transition:transform .38s ease;
    border-radius:0 0 var(--rayon) var(--rayon);z-index:2}
.p-carte:hover .p-cart{transform:translateY(0)}
.p-cart .btn{width:100%;justify-content:center;font-size:10px}
.p-info{padding:16px}
.p-cat{font-size:10px;color:var(--rose-v);letter-spacing:2px;text-transform:uppercase;margin-bottom:4px;display:block}
.p-nom{font-family:var(--f-titre);font-size:18px;font-weight:400;color:var(--texte);
    text-decoration:none;display:block;margin-bottom:6px;transition:color .3s;line-height:1.3}
.p-nom:hover{color:var(--rose-v)}
.p-stars{color:var(--rose-p);font-size:11px;letter-spacing:1px;margin-bottom:7px;display:block}
.p-prix-l{display:flex;align-items:center;gap:9px}
.p-prix{font-size:16px;font-weight:600;color:var(--brun-d)}
.p-prix-b{font-size:12px;color:var(--texte2);text-decoration:line-through}

/* ── Modal Vue Rapide (Quick View) ── */
.qv-modal-overlay{
    position:fixed;inset:0;background:rgba(61,32,48,.6);backdrop-filter:blur(6px);
    z-index:999;display:none;align-items:center;justify-content:center;padding:24px;
}
.qv-modal-card{
    background:var(--blanc);border-radius:20px;max-width:850px;width:100%;
    overflow:hidden;box-shadow:0 12px 50px rgba(0,0,0,.25);position:relative;
    display:grid;grid-template-columns:1fr 1fr;animation:qvSlide .35s ease;
}
@keyframes qvSlide{from{opacity:0;transform:scale(.94)}to{opacity:1;transform:scale(1)}}
.qv-close{
    position:absolute;top:14px;right:14px;width:34px;height:34px;
    background:var(--creme2);border:none;border-radius:50%;cursor:pointer;
    display:flex;align-items:center;justify-content:center;font-size:14px;color:var(--texte);
    transition:var(--trans);z-index:10;
}
.qv-close:hover{background:var(--rose-v);color:var(--blanc)}
.qv-img{width:100%;height:100%;min-height:380px;object-fit:cover;display:block}
.qv-body{padding:36px 30px;display:flex;flex-direction:column;justify-content:center}
.qv-cat{font-size:10px;color:var(--rose-v);letter-spacing:2px;text-transform:uppercase;margin-bottom:6px}
.qv-titre{font-family:var(--f-titre);font-size:26px;font-weight:300;color:var(--texte);margin-bottom:12px;line-height:1.2}
.qv-prix{font-size:22px;font-weight:600;color:var(--brun-d);margin-bottom:14px;display:flex;align-items:center;gap:10px}
.qv-prix-b{font-size:14px;color:var(--texte2);text-decoration:line-through;font-weight:300}
.qv-desc{font-size:13px;color:var(--texte2);line-height:1.8;margin-bottom:20px}
.qv-stock{font-size:11px;color:#2d6a4f;margin-bottom:20px;display:flex;align-items:center;gap:6px}
.qv-stock-dot{width:7px;height:7px;background:#2d6a4f;border-radius:50%}

/* ── Toast notification ── */
.toast-notif{
    position:fixed;bottom:30px;right:30px;background:var(--brun-d);color:var(--blanc);
    padding:14px 24px;border-radius:50px;box-shadow:0 8px 30px rgba(0,0,0,.25);
    font-size:13px;display:flex;align-items:center;gap:10px;z-index:9999;
    opacity:0;transform:translateY(20px);transition:all .4s ease;pointer-events:none;
}
.toast-notif.show{opacity:1;transform:translateY(0)}

/* ── Pagination ── */
.pagination{display:flex;gap:7px;justify-content:center;margin-top:50px}
.page-btn{width:40px;height:40px;border:1.5px solid var(--peche);background:var(--blanc);
    border-radius:10px;display:flex;align-items:center;justify-content:center;
    font-family:var(--f-corps);font-size:13px;color:var(--texte2);cursor:pointer;
    transition:var(--trans);text-decoration:none;box-shadow:var(--ombre-sm)}
.page-btn.on,.page-btn:hover{background:var(--rose-v);border-color:var(--rose-v);color:var(--blanc);
    box-shadow:0 4px 14px rgba(201,112,128,.35)}

@media(max-width:900px){
    .shop-layout{grid-template-columns:1fr;padding:30px 24px}
    .sidebar{display:none}
    .shop-grid{grid-template-columns:1fr 1fr}
    .qv-modal-card{grid-template-columns:1fr}
    .qv-img{height:250px;min-height:auto}
}
@media(max-width:500px){.shop-grid{grid-template-columns:1fr}}
</style>
@endpush

@section('content')
{{-- HERO --}}
<div class="shop-hero">
    <span class="s-label">JEKP Store</span>
    <h1 class="s-titre">Notre <em>Boutique</em></h1>
    <div class="hero-tags">
        <span class="hero-tag"><i class="fas fa-leaf" style="margin-right:5px;color:var(--rose-v)"></i> 100% Artisanal</span>
        <span class="hero-tag"><i class="fas fa-truck" style="margin-right:5px;color:var(--rose-v)"></i> Livraison offerte dès 70 000 F CFA</span>
        <span class="hero-tag"><i class="fas fa-undo" style="margin-right:5px;color:var(--rose-v)"></i> Retours 14 jours</span>
    </div>
    <div class="breadcrumb">
        <a href="{{ route('home') }}">Accueil</a>
        <i class="fas fa-chevron-right" style="font-size:9px"></i>
        <span>Boutique</span>
    </div>
</div>

<div class="shop-layout">
    {{-- SIDEBAR FILTRES --}}
    <aside class="sidebar">
        <div class="sidebar-header">
            <h3>Filtres</h3>
            <a href="{{ route('shop.index') }}" class="sidebar-reset">Réinitialiser</a>
        </div>

        <form action="{{ route('shop.index') }}" method="GET" id="shopFilterForm">
            @if(request('q'))
                <input type="hidden" name="q" value="{{ request('q') }}">
            @endif
            <input type="hidden" name="categorie" id="filterCategory" value="{{ request('categorie', 'tous') }}">
            <input type="hidden" name="tri" id="filterSort" value="{{ request('tri', 'default') }}">

            {{-- Catégories --}}
            <div class="sidebar-section">
                <span class="sidebar-label">Catégories</span>
                <ul class="cat-liste">
                    <li>
                        <a href="javascript:void(0)"
                           class="{{ request('categorie', 'tous') === 'tous' ? 'on' : '' }}"
                           onclick="setCategoryFilter('tous')">
                            Tout voir <span>{{ count($displayProducts) }}</span>
                        </a>
                    </li>
                    @php
                    $listCats = [
                        ['nom' => 'Fils Rares',     'slug' => 'fils-rares'],
                        ['nom' => 'Kits Signature', 'slug' => 'kits-signature'],
                        ['nom' => 'Accessoires',     'slug' => 'accessoires'],
                        ['nom' => 'Maison',          'slug' => 'maison'],
                        ['nom' => 'Adulte',          'slug' => 'adulte'],
                        ['nom' => 'Enfant',          'slug' => 'enfant'],
                    ];
                    @endphp
                    @foreach(isset($categories) && count($categories) ? $categories : $listCats as $c)
                    @php
                        $cNom  = is_array($c) ? $c['nom']  : $c->name;
                        $cSlug = is_array($c) ? $c['slug'] : ($c->slug ?? Str::slug($cNom));
                        $isSel = request('categorie') === $cSlug || request('categorie') === $cNom;
                    @endphp
                    <li>
                        <a href="javascript:void(0)"
                           class="{{ $isSel ? 'on' : '' }}"
                           onclick="setCategoryFilter('{{ $cSlug }}')">
                            {{ $cNom }}
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>

            {{-- Filtre Prix --}}
            <div class="sidebar-section">
                <span class="sidebar-label">Prix maximum</span>
                <input type="range" name="prix_max" class="prix-range" id="priceRange"
                       min="10000" max="150000" step="5000"
                       value="{{ request('prix_max', 150000) }}"
                       oninput="updatePriceLabel(this.value)"
                       onchange="document.getElementById('shopFilterForm').submit()">
                <div class="prix-vals">
                    <span>0 F CFA</span>
                    <span id="priceLabel">{{ number_format(request('prix_max', 150000), 0, ',', ' ') }} F CFA</span>
                </div>
            </div>

            {{-- Couleurs --}}
            <div class="sidebar-section">
                <span class="sidebar-label">Couleurs</span>
                <div class="coul-liste">
                    <div class="coul-item" style="background:#e8d5c8" title="Nude" onclick="toggleColorFilter(this)"></div>
                    <div class="coul-item on" style="background:#c97080" title="Rose" onclick="toggleColorFilter(this)"></div>
                    <div class="coul-item" style="background:#b8a4d4" title="Lavande" onclick="toggleColorFilter(this)"></div>
                    <div class="coul-item" style="background:#8b5e3c" title="Camel" onclick="toggleColorFilter(this)"></div>
                    <div class="coul-item" style="background:#f5f5f5;border:1px solid #ddd" title="Blanc" onclick="toggleColorFilter(this)"></div>
                    <div class="coul-item" style="background:#3d2030" title="Brun" onclick="toggleColorFilter(this)"></div>
                </div>
            </div>

            {{-- Matières --}}
            <div class="sidebar-section">
                <span class="sidebar-label">Matières</span>
                <ul class="cat-liste">
                    <li><a href="javascript:void(0)" onclick="setCategoryFilter('merinos')">Laine Mérinos</a></li>
                    <li><a href="javascript:void(0)" onclick="setCategoryFilter('alpaga')">Alpaga</a></li>
                    <li><a href="javascript:void(0)" onclick="setCategoryFilter('mohair')">Mohair & Soie</a></li>
                    <li><a href="javascript:void(0)" onclick="setCategoryFilter('coton')">Coton Bio</a></li>
                </ul>
            </div>
        </form>
    </aside>

    {{-- COLONNE PRODUITS --}}
    <div>
        {{-- Barre supérieure --}}
        <div class="shop-top">
            <span class="shop-count">
                <strong>{{ count($displayProducts) }}</strong> {{ count($displayProducts) > 1 ? 'produits trouvés' : 'produit trouvé' }}
                @if(request('categorie') && request('categorie') !== 'tous')
                    dans <span style="color:var(--rose-v);font-weight:500">« {{ ucfirst(str_replace('-', ' ', request('categorie'))) }} »</span>
                @endif
            </span>
            <select class="shop-sort" id="shopSortSelect" onchange="applySort(this.value)">
                <option value="default" {{ request('tri') === 'default' ? 'selected' : '' }}>Popularité</option>
                <option value="prix_asc" {{ request('tri') === 'prix_asc' ? 'selected' : '' }}>Prix croissant</option>
                <option value="prix_desc" {{ request('tri') === 'prix_desc' ? 'selected' : '' }}>Prix décroissant</option>
                <option value="nouveaute" {{ request('tri') === 'nouveaute' ? 'selected' : '' }}>Nouveautés</option>
            </select>
        </div>

        {{-- GRILLE DES PRODUITS --}}
        <div class="shop-grid">
            @forelse($displayProducts as $p)
            @php
                $pObj   = is_array($p) ? (object)$p : $p;
                $pId    = $pObj->_id ?? $pObj->id ?? 'p'.rand(10,99);
                $pNom   = $pObj->name ?? $pObj->nom ?? 'Création JEKP';
                $pSlug  = $pObj->slug ?? Str::slug($pNom);
                $pCat   = $pObj->category_name ?? $pObj->cat ?? ($pObj->category->name ?? 'Artisanal');
                $pPrice = $pObj->sale_price ?? $pObj->price ?? $pObj->prix ?? 15000;
                $pOldP  = isset($pObj->sale_price) && $pObj->sale_price ? $pObj->price : ($pObj->anc ?? null);
                $pBadge = $pObj->badge ?? null;
                $pImg   = product_image_url($pObj->images[0] ?? $pObj->image ?? $pObj->img ?? null);
                $pDesc  = $pObj->description ?? 'Une création artisanale unique faite à la main avec amour dans nos ateliers JEKP.';
            @endphp

            <div class="p-carte">
                <div class="p-img">
                    <a href="{{ route('shop.show', $pSlug) }}">
                        <img src="{{ $pImg }}" alt="{{ $pNom }}" loading="lazy">
                    </a>

                    @if($pBadge === 'n')
                        <span class="p-badge b-n">Nouveau</span>
                    @elseif($pBadge === 'p')
                        <span class="p-badge b-p">Promo</span>
                    @endif

                    {{-- Actions rapides --}}
                    <div class="p-act">
                        <button type="button" class="p-btn" title="Ajouter aux favoris" onclick="toggleWishlist(this, '{{ $pNom }}')">
                            <i class="far fa-heart"></i>
                        </button>
                        <button type="button" class="p-btn" title="Vue rapide"
                                onclick='openQuickView("{{ addslashes($pNom) }}", "{{ $pCat }}", "{{ number_format($pPrice, 0, ",", " ") }} F CFA", "{{ $pOldP ? number_format((float)$pOldP, 0, ",", " ") . " F CFA" : "" }}", "{{ $pImg }}", "{{ addslashes($pDesc) }}", "{{ $pId }}")'>
                            <i class="far fa-eye"></i>
                        </button>
                    </div>

                    {{-- Bouton d'ajout au panier sur hover --}}
                    <div class="p-cart">
                        <form action="{{ route('cart.add') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $pId }}">
                            <input type="hidden" name="quantity" value="1">
                            <button type="submit" class="btn btn-blanc" style="width:100%">
                                <i class="fas fa-shopping-bag"></i> Ajouter au panier
                            </button>
                        </form>
                    </div>
                </div>

                <div class="p-info">
                    <span class="p-cat">{{ $pCat }}</span>
                    <a href="{{ route('shop.show', $pSlug) }}" class="p-nom">{{ $pNom }}</a>
                    <span class="p-stars">★★★★★</span>
                    <div class="p-prix-l">
                        <span class="p-prix">{{ number_format($pPrice, 0, ',', ' ') }} F CFA</span>
                        @if($pOldP)
                            <span class="p-prix-b">{{ is_numeric($pOldP) ? number_format((float)$pOldP, 0, ',', ' ') : $pOldP }} F CFA</span>
                        @endif
                    </div>
                </div>
            </div>
            @empty
            <div style="grid-column:1/-1;text-align:center;padding:60px 20px;background:var(--blanc);border-radius:16px;border:1px dashed var(--peche2)">
                <i class="fas fa-search" style="font-size:40px;color:var(--rose-v);margin-bottom:14px;opacity:.6"></i>
                <h3 style="font-family:var(--f-titre);font-size:24px;font-weight:300;color:var(--texte);margin-bottom:8px">Aucun produit trouvé</h3>
                <p style="font-size:13px;color:var(--texte2);margin-bottom:20px">Essayez de modifier vos filtres ou de réinitialiser la recherche.</p>
                <a href="{{ route('shop.index') }}" class="btn btn-rose">Voir tous les produits</a>
            </div>
            @endforelse
        </div>

        {{-- PAGINATION --}}
        @if(method_exists($products, 'links') && $products->hasPages())
            <div style="margin-top:40px">
                {{ $products->links() }}
            </div>
        @else
            <div class="pagination">
                <a href="#" class="page-btn"><i class="fas fa-chevron-left" style="font-size:11px"></i></a>
                <a href="#" class="page-btn on">1</a>
                <a href="#" class="page-btn">2</a>
                <a href="#" class="page-btn"><i class="fas fa-chevron-right" style="font-size:11px"></i></a>
            </div>
        @endif
    </div>
</div>

{{-- ══ MODAL VUE RAPIDE (QUICK VIEW) ══ --}}
<div class="qv-modal-overlay" id="qvModal" role="dialog" aria-modal="true">
    <div class="qv-modal-card">
        <button type="button" class="qv-close" onclick="closeQuickView()"><i class="fas fa-times"></i></button>
        <img src="" alt="" class="qv-img" id="qvImg">
        <div class="qv-body">
            <span class="qv-cat" id="qvCat">Catégorie</span>
            <h2 class="qv-titre" id="qvTitre">Nom du produit</h2>
            <div class="qv-prix">
                <span id="qvPrix">0 F CFA</span>
                <span class="qv-prix-b" id="qvOldPrix"></span>
            </div>
            <p class="qv-desc" id="qvDesc">Description du produit...</p>
            <div class="qv-stock">
                <span class="qv-stock-dot"></span> En stock · Expédié sous 24h
            </div>

            <form action="{{ route('cart.add') }}" method="POST">
                @csrf
                <input type="hidden" name="product_id" id="qvProductId" value="">
                <div style="display:flex;gap:12px;align-items:center;margin-top:10px">
                    <input type="number" name="quantity" value="1" min="1" max="99"
                           style="width:70px;padding:12px;border:1.5px solid var(--peche);border-radius:9px;text-align:center;font-family:var(--f-corps);font-size:14px">
                    <button type="submit" class="btn btn-rose" style="flex:1;justify-content:center">
                        <i class="fas fa-shopping-bag"></i> Ajouter au panier
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- ══ TOAST NOTIFICATION ══ --}}
<div class="toast-notif" id="shopToast">
    <i class="fas fa-check-circle" style="color:var(--peche2);font-size:16px"></i>
    <span id="toastMsg">Action effectuée</span>
</div>

@endsection

@push('scripts')
<script>
// ── Filtrage par catégorie ──
function setCategoryFilter(slug) {
    document.getElementById('filterCategory').value = slug;
    document.getElementById('shopFilterForm').submit();
}

// ── Filtrage par tri ──
function applySort(val) {
    document.getElementById('filterSort').value = val;
    document.getElementById('shopFilterForm').submit();
}

// ── Mise à jour de l'étiquette prix ──
function updatePriceLabel(val) {
    document.getElementById('priceLabel').innerText = parseInt(val).toLocaleString('fr-FR') + ' F CFA';
}

// ── Sélection des couleurs ──
function toggleColorFilter(el) {
    document.querySelectorAll('.coul-item').forEach(c => c.classList.remove('on'));
    el.classList.add('on');
    showToast('Filtre couleur : ' + el.getAttribute('title'));
}

// ── Modal Vue Rapide (Quick View) ──
function openQuickView(nom, cat, prix, oldPrix, img, desc, id) {
    document.getElementById('qvTitre').innerText = nom;
    document.getElementById('qvCat').innerText = cat;
    document.getElementById('qvPrix').innerText = prix;
    document.getElementById('qvOldPrix').innerText = oldPrix || '';
    document.getElementById('qvImg').src = img;
    document.getElementById('qvDesc').innerText = desc;
    document.getElementById('qvProductId').value = id;

    const modal = document.getElementById('qvModal');
    modal.style.display = 'flex';
    document.body.style.overflow = 'hidden';
}

function closeQuickView() {
    const modal = document.getElementById('qvModal');
    modal.style.display = 'none';
    document.body.style.overflow = '';
}

document.getElementById('qvModal').addEventListener('click', function(e) {
    if (e.target === this) closeQuickView();
});

// ── Favoris (Wishlist) ──
function toggleWishlist(btn, nom) {
    btn.classList.toggle('active');
    const isFav = btn.classList.contains('active');
    const icon = btn.querySelector('i');
    if (isFav) {
        icon.className = 'fas fa-heart';
        btn.style.color = 'var(--rose-v)';
        showToast('« ' + nom + ' » ajouté à vos favoris ♡');
    } else {
        icon.className = 'far fa-heart';
        btn.style.color = '';
        showToast('Retiré de vos favoris');
    }
}

// ── Toast Notification ──
function showToast(msg) {
    const toast = document.getElementById('shopToast');
    document.getElementById('toastMsg').innerText = msg;
    toast.classList.add('show');
    setTimeout(() => toast.classList.remove('show'), 3000);
}
</script>
@endpush