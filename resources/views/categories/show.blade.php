@extends('layouts.app')
@section('title', $catName . ' — Collections JEKP')

@push('styles')
<style>
/* ── Hero catégorie ── */
.cat-hero{position:relative;height:320px;overflow:hidden}
.cat-hero img{width:100%;height:100%;object-fit:cover;filter:brightness(.55)}
.cat-hero::after{content:'';position:absolute;inset:0;background:linear-gradient(160deg,rgba(90,48,64,.45),rgba(155,142,196,.3))}
.cat-hero-txt{position:absolute;inset:0;z-index:2;display:flex;flex-direction:column;align-items:center;justify-content:center;text-align:center;padding:20px}
.cat-hero-script{font-family:var(--f-script);font-size:28px;color:var(--peche);display:block;margin-bottom:6px}
.cat-hero-titre{font-family:var(--f-titre);font-size:54px;font-weight:300;color:#fff;letter-spacing:3px;text-transform:uppercase;margin-bottom:10px;word-break:break-word}
.cat-hero-desc{font-size:12px;letter-spacing:3px;text-transform:uppercase;color:rgba(255,255,255,.7)}
.breadcrumb{display:flex;gap:8px;align-items:center;font-size:11px;color:rgba(255,255,255,.6);margin-top:14px}
.breadcrumb a{color:rgba(255,255,255,.7);text-decoration:none}.breadcrumb a:hover{color:#fff}
.breadcrumb span{color:var(--peche)}

/* ── Layout ── */
.cat-layout{max-width:1300px;margin:0 auto;padding:50px 50px}

/* ── Barre haut ── */
.cat-top{display:flex;justify-content:space-between;align-items:center;margin-bottom:32px;flex-wrap:wrap;gap:12px;background:var(--blanc);padding:14px 20px;border-radius:12px;border:1px solid var(--peche);box-shadow:var(--ombre-sm)}
.cat-count{font-size:13px;color:var(--texte2)}
.cat-count strong{color:var(--rose-v);font-weight:600}
.cat-sort{padding:8px 14px;border:1.5px solid var(--peche);border-radius:8px;background:transparent;font-family:var(--f-corps);font-size:13px;color:var(--texte);outline:none;cursor:pointer}
.cat-sort:focus{border-color:var(--rose-v)}

/* ── Grille produits ── */
.cat-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:24px}
.p-carte{position:relative}
.p-img{position:relative;overflow:hidden;aspect-ratio:3/4;border-radius:var(--rayon);margin-bottom:14px;background:var(--beige)}
.p-img img{width:100%;height:100%;object-fit:cover;transition:transform .65s;display:block}
.p-carte:hover .p-img img{transform:scale(1.06)}
.p-badge{position:absolute;top:11px;left:11px;font-size:9px;letter-spacing:2px;text-transform:uppercase;padding:5px 12px;border-radius:50px;font-weight:600}
.b-n{background:var(--rose-v);color:#fff}
.b-p{background:var(--lavande2);color:#fff}
.p-act{position:absolute;top:11px;right:11px;display:flex;flex-direction:column;gap:7px;opacity:0;transform:translateX(10px);transition:var(--trans)}
.p-carte:hover .p-act{opacity:1;transform:translateX(0)}
.p-btn{width:36px;height:36px;background:var(--blanc);border:none;border-radius:50%;cursor:pointer;display:flex;align-items:center;justify-content:center;font-size:13px;color:var(--texte);box-shadow:var(--ombre-sm);transition:var(--trans);flex-shrink:0}
.p-btn:hover{background:var(--rose-v);color:#fff}
.p-cart-slide{position:absolute;bottom:0;left:0;right:0;background:linear-gradient(0deg,rgba(90,48,64,.92),transparent);padding:28px 12px 12px;transform:translateY(100%);transition:transform .35s;border-radius:0 0 var(--rayon) var(--rayon)}
.p-carte:hover .p-cart-slide{transform:translateY(0)}
.p-cart-slide .btn{width:100%;justify-content:center;font-size:10px}
.p-cat{font-size:10px;color:var(--rose-v);letter-spacing:1.5px;text-transform:uppercase;margin-bottom:3px;display:block}
.p-nom{font-family:var(--f-titre);font-size:18px;font-weight:300;color:var(--texte);text-decoration:none;display:block;margin-bottom:6px;transition:color .3s}
.p-nom:hover{color:var(--rose-v)}
.p-prix-l{display:flex;align-items:center;gap:8px}
.p-prix{font-size:15px;font-weight:400;color:var(--brun-d)}
.p-prix-b{font-size:12px;color:var(--texte2);text-decoration:line-through}

/* État vide */
.cat-empty{text-align:center;padding:80px 20px;color:var(--texte2)}
.cat-empty i{font-size:52px;opacity:.25;display:block;margin-bottom:18px;color:var(--rose-p)}

.cat-cta{padding:50px;text-align:center;margin-top:20px}
.cat-cta-titre{font-family:var(--f-script);font-size:32px;color:var(--brun-d);display:block;margin-bottom:8px}
.cat-cta p{font-size:14px;color:var(--brun-2);margin-bottom:20px}

@media(max-width:900px){
    .cat-layout{padding:30px 16px}
    .cat-grid{grid-template-columns:repeat(2,1fr);gap:16px}
    .cat-hero{height:220px}
    .cat-hero-script{font-size:22px}
    .cat-hero-titre{font-size:32px}
    .cat-top{padding:12px 14px}
    .p-nom{font-size:16px}
    /* Actions & ajout panier accessibles au tactile (pas de hover sur mobile) */
    .p-act{opacity:1;transform:translateX(0)}
    .p-cart-slide{transform:translateY(0);padding:14px 10px 10px}
    .cat-cta{padding:36px 20px}
    .cat-empty{padding:50px 20px}
}
@media(max-width:500px){
    .cat-grid{gap:10px}
    .cat-hero{height:190px}
    .cat-hero-txt{padding:14px}
    .cat-hero-script{font-size:16px}
    .cat-hero-titre{font-size:22px;letter-spacing:1.5px}
    .cat-hero-desc{font-size:9px;letter-spacing:1.5px}
    .breadcrumb{font-size:10px;gap:6px}
    .cat-top{flex-direction:column;align-items:flex-start;gap:10px;padding:12px 14px}
    .cat-sort{width:100%}
    .cat-top form{width:100%;flex-direction:column;align-items:flex-start;gap:6px}
    .p-nom{font-size:13px}
    .p-cat{font-size:9px}
    .p-prix{font-size:12px}
    .p-badge{font-size:8px;padding:4px 10px}
    .cat-cta{padding:30px 16px}
    .cat-cta-titre{font-size:22px}
}
</style>
@endpush

@section('content')

{{-- Hero --}}
<div class="cat-hero">
    <img src="{{ $catImg }}" alt="{{ $catName }}" loading="lazy">
    <div class="cat-hero-txt">
        <span class="cat-hero-script">Collection</span>
        <h1 class="cat-hero-titre">{{ $catName }}</h1>
        <div class="cat-hero-desc">{{ $catDesc }}</div>
        <div class="breadcrumb">
            <a href="{{ route('home') }}">Accueil</a>
            <i class="fas fa-chevron-right" style="font-size:8px"></i>
            <a href="{{ route('categories.index') }}">Collections</a>
            <i class="fas fa-chevron-right" style="font-size:8px"></i>
            <span>{{ $catName }}</span>
        </div>
    </div>
</div>

<div class="cat-layout">

    {{-- Barre tri --}}
    <div class="cat-top">
        <div class="cat-count">
            <strong>{{ $products->total() }}</strong> article{{ $products->total() > 1 ? 's' : '' }} trouvé{{ $products->total() > 1 ? 's' : '' }}
        </div>
        <form method="GET" style="display:flex;align-items:center;gap:8px">
            <label style="font-size:12px;color:var(--texte2)">Trier par :</label>
            <select name="tri" class="cat-sort" onchange="this.form.submit()">
                <option value="nouveaute" {{ request('tri') === 'nouveaute' || !request('tri') ? 'selected' : '' }}>Nouveautés</option>
                <option value="prix_asc"  {{ request('tri') === 'prix_asc'  ? 'selected' : '' }}>Prix croissant</option>
                <option value="prix_desc" {{ request('tri') === 'prix_desc' ? 'selected' : '' }}>Prix décroissant</option>
            </select>
        </form>
    </div>

    {{-- Grille produits --}}
    @if($products->count())
    <div class="cat-grid">
        @foreach($products as $p)
        <div class="p-carte">
            <div class="p-img">
                @if(!empty($p->images))
                    <img src="{{ product_image_url($p->images[0] ?? null) }}" alt="{{ $p->name }}" loading="lazy">
                @else
                    <div style="width:100%;height:100%;background:var(--creme2);display:flex;align-items:center;justify-content:center">
                        <i class="fas fa-image" style="font-size:40px;color:var(--peche2);opacity:.4"></i>
                    </div>
                @endif

                @if($p->is_featured) <span class="p-badge b-n">Coup de cœur</span>
                @elseif($p->sale_price && $p->sale_price < $p->price) <span class="p-badge b-p">Promo</span>
                @endif

                <div class="p-act">
                    <button class="p-btn" title="Wishlist"><i class="far fa-heart"></i></button>
                    <a href="{{ route('shop.show', $p->slug) }}" class="p-btn" title="Voir le produit"><i class="far fa-eye"></i></a>
                </div>

                {{-- Ajout rapide au panier --}}
                <div class="p-cart-slide">
                    <form action="{{ route('cart.add') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $p->_id }}">
                        <input type="hidden" name="quantity" value="1">
                        <button type="submit" class="btn btn-blanc" style="font-size:11px">
                            <i class="fas fa-shopping-bag"></i> Ajouter au panier
                        </button>
                    </form>
                </div>
            </div>

            @if($p->category_name)<span class="p-cat">{{ $p->category_name }}</span>@endif
            <a href="{{ route('shop.show', $p->slug) }}" class="p-nom">{{ $p->name }}</a>
            <div class="p-prix-l">
                <span class="p-prix">{{ number_format($p->sale_price ?? $p->price, 0, ',', ' ') }} CFA</span>
                @if($p->sale_price && $p->sale_price < $p->price)
                    <span class="p-prix-b">{{ number_format($p->price, 0, ',', ' ') }} CFA</span>
                @endif
            </div>
        </div>
        @endforeach
    </div>

    {{-- Pagination --}}
    @if($products->hasPages())
        {{ $products->links('partials.pagination') }}
    @endif

    @else
    {{-- État vide --}}
    <div class="cat-empty">
        <i class="fas fa-box-open"></i>
        <h3 style="font-family:var(--f-titre);font-size:26px;font-weight:300;margin-bottom:10px">Aucun article pour l'instant</h3>
        <p style="font-size:14px;margin-bottom:24px">Cette collection arrive bientôt — revenez nous voir !</p>
        <a href="{{ route('shop.index') }}" class="btn btn-rose"><i class="fas fa-store"></i> Voir toute la boutique</a>
    </div>
    @endif

</div>

{{-- Bandeau sur mesure --}}
<div class="cat-cta" style="background:linear-gradient(135deg,var(--peche),var(--lavande))">
    <span class="cat-cta-titre">Vous ne trouvez pas ce que vous cherchez ?</span>
    <p>Demandez une création sur mesure, rien que pour vous.</p>
    <a href="{{ route('home') }}#sur-mesure" class="btn btn-rose"><i class="fas fa-magic"></i> Commander sur mesure</a>
</div>

@endsection
