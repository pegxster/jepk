@extends('layouts.app')
@section('title', 'Catalogue — JEPK Store')
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
.shop-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:20px}
.p-carte{position:relative;background:var(--blanc);border-radius:var(--rayon);overflow:hidden;
    border:1px solid rgba(201,104,128,.1);
    box-shadow:0 2px 12px rgba(90,48,64,.07);transition:var(--trans)}
.p-carte:hover{transform:translateY(-5px);box-shadow:0 12px 40px rgba(90,48,64,.14);border-color:rgba(201,104,128,.2)}
.p-img{position:relative;overflow:hidden;aspect-ratio:3/4;background:var(--beige)}
.p-img img{width:100%;height:100%;object-fit:cover;transition:transform .6s ease;display:block}
.p-carte:hover .p-img img{transform:scale(1.04)}
.p-badge{position:absolute;top:11px;left:11px;font-size:9px;letter-spacing:2px;text-transform:uppercase;
    padding:5px 13px;border-radius:50px;font-weight:600;z-index:2}
.b-n{background:var(--rose-v);color:var(--blanc)}.b-p{background:var(--lavande2);color:var(--blanc)}
.p-act{position:absolute;top:11px;right:11px;display:flex;flex-direction:column;gap:7px;
    opacity:0;transform:translateX(10px);transition:var(--trans);z-index:2}
.p-carte:hover .p-act{opacity:1;transform:translateX(0)}
.p-btn{width:36px;height:36px;background:var(--blanc);border:none;border-radius:50%;cursor:pointer;
    display:flex;align-items:center;justify-content:center;font-size:12px;color:var(--texte);
    box-shadow:0 2px 10px rgba(90,48,64,.14);transition:var(--trans)}
.p-btn:hover,.p-btn.active{background:var(--rose-v);color:var(--blanc)}
.p-cart{position:absolute;bottom:0;left:0;right:0;
    background:linear-gradient(0deg,rgba(61,18,32,.9) 0%,rgba(90,48,64,.5) 60%,transparent);
    padding:40px 12px 12px;transform:translateY(100%);transition:transform .35s ease;
    border-radius:0 0 var(--rayon) var(--rayon);z-index:2}
.p-carte:hover .p-cart{transform:translateY(0)}
.p-cart .btn,.p-cart button,.p-cart form{width:100%;justify-content:center;font-size:10px}
.p-cart button{border-radius:50px;padding:11px 16px;font-size:10px;letter-spacing:2px;text-transform:uppercase}
.p-info{padding:14px 16px 16px}
.p-cat{font-size:9px;color:var(--rose-v);letter-spacing:2.5px;text-transform:uppercase;margin-bottom:5px;display:block;font-weight:500}
.p-nom{font-family:var(--f-titre);font-size:17px;font-weight:400;color:var(--texte);
    text-decoration:none;display:block;margin-bottom:8px;transition:color .3s;line-height:1.25}
.p-nom:hover{color:var(--rose-v)}
.p-prix-l{display:flex;align-items:center;gap:8px}
.p-prix{font-size:15px;font-weight:600;color:var(--brun-d)}
.p-prix-b{font-size:11px;color:var(--texte2);text-decoration:line-through}

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
    .shop-layout{grid-template-columns:1fr;padding:24px 16px}
    .sidebar{display:none}
    .shop-grid{grid-template-columns:1fr 1fr;gap:16px}
    .qv-modal-card{grid-template-columns:1fr}
    .qv-img{height:250px;min-height:auto}
    .shop-hero{padding:50px 20px 40px}
    .shop-hero .s-label{font-size:20px}
    .shop-top{padding:12px 14px}
    .shop-count{font-size:12px}
    .p-info{padding:12px}
    .p-nom{font-size:15px}
    .p-prix{font-size:14px}
    /* Sur tactile il n'y a pas de :hover — rendre visibles favoris/vue rapide/ajout au panier */
    .p-act{opacity:1;transform:none}
    .p-cart{transform:translateY(0);position:static;background:none;padding:10px 0 0}
}
@media(max-width:500px){
    .shop-grid{grid-template-columns:1fr 1fr;gap:10px}
    .p-img{aspect-ratio:3/4}
    .p-info{padding:10px 8px}
    .p-nom{font-size:13px}
    .p-cat{font-size:9px}
    .p-prix{font-size:12px}
    .p-stars{font-size:10px}
    .p-badge{font-size:8px;padding:4px 10px}
    .hero-tags{gap:4px}
    .hero-tag{font-size:8px;padding:4px 10px}
}
</style>
@endpush

@section('content')
{{-- HERO --}}
<div class="shop-hero">
    <span class="s-label">JEPK Store</span>
    <h1 class="s-titre">Notre <em>Catalogue</em></h1>
    <div class="hero-tags">
        <span class="hero-tag"><i class="fas fa-hand-sparkles" style="margin-right:5px;color:var(--rose-v)"></i> 100% Fait main au crochet</span>
        <span class="hero-tag"><i class="fas fa-ruler-combined" style="margin-right:5px;color:var(--rose-v)"></i> Tailles &amp; couleurs adaptables</span>
        <span class="hero-tag"><i class="fas fa-shield-alt" style="margin-right:5px;color:var(--rose-v)"></i> Commande en ligne sécurisée</span>
    </div>
    <div class="breadcrumb">
        <a href="{{ route('home') }}">Accueil</a>
        <i class="fas fa-chevron-right" style="font-size:9px"></i>
        <span>Catalogue</span>
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
                            Tout voir
                        </a>
                    </li>
                    @php
                    /* Liste fixe des 17 catégories du catalogue JEPK */
                    $catFixe = [
                        'Robes','Tops','Boléros','Tenues Plage','Ensemble Hommes','Tenues Couple',
                        'Chapeaux',"Sacs à Main",'Enfants','Sacs Trafoil','Sacs Customisés',
                        "Sacs d'Ordinateur",'Bouquets de Fleurs','Miroirs Crochetés',
                        'Chouchous','Porte-Clés','Barrettes',
                    ];
                    /* On fusionne avec les noms de la DB si disponibles, sinon on garde la liste fixe */
                    $catAffichees = $categories->count() > 0
                        ? $categories->pluck('name')->toArray()
                        : $catFixe;
                    @endphp
                    @foreach($catAffichees as $cNom)
                    @php $isSel = request('categorie') === $cNom; @endphp
                    <li>
                        <a href="javascript:void(0)"
                           class="{{ $isSel ? 'on' : '' }}"
                           onclick="setCategoryFilter('{{ addslashes($cNom) }}')">
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
                       min="500" max="60000" step="500"
                       value="{{ request('prix_max', 60000) }}"
                       oninput="updatePriceLabel(this.value)"
                       onchange="document.getElementById('shopFilterForm').submit()">
                <div class="prix-vals">
                    <span>0 F CFA</span>
                    <span id="priceLabel">{{ number_format(request('prix_max', 60000), 0, ',', ' ') }} F CFA</span>
                </div>
            </div>

            {{-- Gamme de prix rapide --}}
            <div class="sidebar-section">
                <span class="sidebar-label">Gamme de prix</span>
                <ul class="cat-liste">
                    <li><a href="javascript:void(0)" onclick="setMaxPrice(5000)"
                           class="{{ request('prix_max') == 5000 ? 'on' : '' }}">
                        Moins de 5 000 F
                    </a></li>
                    <li><a href="javascript:void(0)" onclick="setMaxPrice(15000)"
                           class="{{ request('prix_max') == 15000 ? 'on' : '' }}">
                        Jusqu'à 15 000 F
                    </a></li>
                    <li><a href="javascript:void(0)" onclick="setMaxPrice(30000)"
                           class="{{ request('prix_max') == 30000 ? 'on' : '' }}">
                        Jusqu'à 30 000 F
                    </a></li>
                    <li><a href="javascript:void(0)" onclick="setMaxPrice(60000)"
                           class="{{ !request('prix_max') || request('prix_max') == 60000 ? 'on' : '' }}">
                        Tout afficher
                    </a></li>
                </ul>
            </div>

            {{-- Info personnalisation --}}
            <div class="sidebar-section" style="border-bottom:none;padding-bottom:0">
                <span class="sidebar-label">Couleurs & Tailles</span>
                <div style="background:linear-gradient(135deg,var(--peche),var(--creme2));border-radius:12px;padding:14px 16px">
                    <div style="font-size:12px;color:var(--texte);line-height:1.7;margin-bottom:10px">
                        <i class="fas fa-palette" style="color:var(--rose-v);margin-right:6px"></i>
                        <strong>Toutes couleurs</strong> disponibles sur commande<br>
                        <i class="fas fa-ruler" style="color:var(--rose-v);margin-right:6px"></i>
                        <strong>Toutes tailles</strong> — S, M, L, XL sur mesure
                    </div>
                    <a href="https://wa.me/2250153928572?text={{ urlencode('Bonjour JEPK 👋 Je voudrais personnaliser une commande, pouvez-vous m\'aider ?') }}"
                       target="_blank" rel="noopener"
                       style="display:flex;align-items:center;gap:7px;background:#25D366;color:#fff;font-size:11px;font-weight:700;padding:9px 14px;border-radius:9px;text-decoration:none;justify-content:center;letter-spacing:.5px">
                        <i class="fab fa-whatsapp" style="font-size:14px"></i> Personnaliser via WhatsApp
                    </a>
                </div>
            </div>

            {{-- Matière --}}
            <div class="sidebar-section">
                <span class="sidebar-label">Matière</span>
                <div style="display:flex;align-items:center;gap:9px;padding:10px 12px;background:var(--peche);border-radius:10px">
                    <i class="fas fa-hand-sparkles" style="color:var(--rose-v);font-size:13px;flex-shrink:0"></i>
                    <span style="font-size:12.5px;color:var(--texte2);line-height:1.5">Laine au crochet — 100% fait main en Côte d'Ivoire</span>
                </div>
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
                $pNom   = $pObj->name ?? $pObj->nom ?? 'Création JEPK';
                $pSlug  = $pObj->slug ?? Str::slug($pNom);
                $pCat   = $pObj->category_name ?? $pObj->cat ?? ($pObj->category->name ?? 'Artisanal');
                $pPrice = $pObj->sale_price ?? $pObj->price ?? $pObj->prix ?? 15000;
                $pOldP  = isset($pObj->sale_price) && $pObj->sale_price ? $pObj->price : ($pObj->anc ?? null);
                $pBadge = $pObj->badge ?? null;
                $pImg   = product_image_url($pObj->images[0] ?? $pObj->image ?? $pObj->img ?? null);
                $pDesc  = $pObj->description ?? 'Une création artisanale unique faite à la main avec amour en Côte d\'Ivoire.';
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
                                onclick='openQuickView("{{ addslashes($pNom) }}", "{{ $pCat }}", "{{ number_format($pPrice, 0, ",", " ") }} F CFA", "{{ $pOldP ? number_format((float)$pOldP, 0, ",", " ") . " F CFA" : "" }}", "{{ $pImg }}", "{{ addslashes($pDesc) }}", "{{ $pId }}", "{{ route("shop.show", $pSlug) }}")'>
                            <i class="far fa-eye"></i>
                        </button>
                    </div>

                    {{-- Bouton Ajouter au panier --}}
                    @php $isDbProduct = !is_array($p) && isset($pObj->_id); @endphp
                    <div class="p-cart">
                        @if($isDbProduct)
                        <form action="{{ route('cart.add') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $pId }}">
                            <input type="hidden" name="quantity" value="1">
                            <button type="submit" class="btn btn-blanc" style="width:100%;justify-content:center">
                                <i class="fas fa-shopping-bag"></i> Commander
                            </button>
                        </form>
                        @else
                        <a href="{{ route('shop.show', $pSlug) }}" class="btn btn-blanc" style="width:100%;justify-content:center">
                            <i class="fas fa-eye"></i> Voir le produit
                        </a>
                        @endif
                    </div>
                </div>

                <div class="p-info">
                    <span class="p-cat">{{ $pCat }}</span>
                    <a href="{{ route('shop.show', $pSlug) }}" class="p-nom">{{ $pNom }}</a>
                    <div class="p-prix-l" style="margin-top:6px">
                        <span class="p-prix">{{ number_format($pPrice, 0, ',', ' ') }} F CFA</span>
                        @if($pOldP)
                            <span class="p-prix-b">{{ is_numeric($pOldP) ? number_format((float)$pOldP, 0, ',', ' ') : $pOldP }} F CFA</span>
                        @endif
                    </div>
                    <span style="font-size:10px;color:var(--texte2);letter-spacing:.5px;margin-top:4px;display:block">
                        <i class="fas fa-hand-sparkles" style="color:var(--rose-v);margin-right:4px;font-size:9px"></i>Fait main · Sur commande
                    </span>
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
            {{ $products->links('partials.pagination') }}
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
            <div class="qv-stock" style="color:var(--texte2);background:var(--peche);border-radius:50px;padding:6px 14px;display:inline-flex;align-items:center;gap:6px;font-size:11px;margin:10px 0">
                <i class="fas fa-hand-sparkles" style="color:var(--rose-v)"></i> Fait main à la commande
            </div>

            <div style="display:flex;flex-direction:column;gap:10px;margin-top:14px">
                <a id="qvViewBtn" href="#" class="btn btn-rose" style="justify-content:center">
                    <i class="fas fa-shopping-bag" style="font-size:16px"></i> Commander
                </a>
            </div>
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

// ── Gamme de prix rapide ──
function setMaxPrice(val) {
    const range = document.getElementById('priceRange');
    if (range) range.value = val;
    updatePriceLabel(val);
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
function openQuickView(nom, cat, prix, oldPrix, img, desc, id, url) {
    document.getElementById('qvTitre').innerText = nom;
    document.getElementById('qvCat').innerText = cat;
    document.getElementById('qvPrix').innerText = prix;
    document.getElementById('qvOldPrix').innerText = oldPrix || '';
    document.getElementById('qvImg').src = img;
    document.getElementById('qvDesc').innerText = desc;

    document.getElementById('qvViewBtn').href = url || '#';

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