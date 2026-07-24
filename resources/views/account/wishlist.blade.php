@extends('layouts.app')
@section('title','Ma Wishlist — JEKP Store')
@push('styles')
<style>
.page-hero{
    background:linear-gradient(135deg,var(--creme2) 0%,var(--blanc) 50%,var(--peche) 100%);
    padding:60px 50px;text-align:center;border-bottom:1px solid var(--peche);
    position:relative;overflow:hidden;
}
.page-hero::before{content:'';position:absolute;right:-100px;top:-100px;
    width:320px;height:320px;border-radius:50%;
    background:linear-gradient(135deg,var(--peche),var(--rose-p));opacity:.1;pointer-events:none}
.breadcrumb{display:flex;gap:8px;align-items:center;font-size:11px;color:var(--texte2);justify-content:center;margin-top:14px}
.breadcrumb a{color:var(--texte2);text-decoration:none;transition:color .3s}.breadcrumb a:hover{color:var(--rose-v)}
.breadcrumb span{color:var(--rose-p)}
.wish-layout{max-width:1200px;margin:0 auto;padding:60px 50px}
.wish-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:22px;margin-top:32px}
.wish-card{background:var(--blanc);border-radius:14px;overflow:hidden;
    box-shadow:var(--ombre-sm);position:relative;transition:var(--trans);
    border:1px solid var(--peche)}
.wish-card:hover{transform:translateY(-5px);box-shadow:var(--ombre);border-color:var(--rose-p)}
.wish-img{position:relative;overflow:hidden;aspect-ratio:3/4}
.wish-img img{width:100%;height:100%;object-fit:cover;transition:transform .65s ease}
.wish-card:hover .wish-img img{transform:scale(1.06)}
.wish-del{position:absolute;top:11px;right:11px;width:36px;height:36px;background:var(--blanc);
    border:none;border-radius:50%;cursor:pointer;display:flex;align-items:center;justify-content:center;
    font-size:14px;color:var(--rose-v);box-shadow:0 2px 10px rgba(90,48,64,.12);transition:var(--trans)}
.wish-del:hover{background:var(--rose-v);color:var(--blanc)}
.wish-body{padding:18px}
.wish-cat{font-size:10px;color:var(--rose-v);letter-spacing:2px;text-transform:uppercase;margin-bottom:5px;display:block}
.wish-nom{font-family:var(--f-titre);font-size:17px;font-weight:300;color:var(--texte);margin-bottom:5px;display:block;transition:color .3s}
.wish-card:hover .wish-nom{color:var(--rose-v)}
.wish-prix{font-size:16px;font-weight:400;color:var(--brun-d);margin-bottom:14px;display:block}
.wish-vide{text-align:center;padding:80px 0}
.wish-vide i{font-size:56px;color:var(--peche2);margin-bottom:18px;display:block}
.wish-vide h3{font-family:var(--f-titre);font-size:24px;font-weight:300;color:var(--texte);margin-bottom:10px}
.wish-vide p{font-size:14px;color:var(--texte2);margin-bottom:28px}
@media(max-width:1000px){.wish-grid{grid-template-columns:repeat(3,1fr)}}
@media(max-width:900px){.wish-layout{padding:40px 24px}.wish-grid{grid-template-columns:1fr 1fr}}
@media(max-width:500px){.wish-grid{grid-template-columns:1fr}}
</style>
@endpush
@section('content')
<div class="page-hero">
    <span class="s-label">Mes Favoris</span>
    <h1 class="s-titre">Ma <em>Wishlist</em></h1>
    <div class="breadcrumb"><a href="{{ route('home') }}">Accueil</a> <i class="fas fa-chevron-right" style="font-size:9px"></i> <a href="{{ route('account.index') }}">Mon Compte</a> <i class="fas fa-chevron-right" style="font-size:9px"></i> <span>Wishlist</span></div>
</div>

<div class="wish-layout">
    <div style="display:flex;justify-content:space-between;align-items:center">
        <div>
            <span class="s-label">Mes Favoris</span>
            <h2 class="s-titre">Articles <em>sauvegardés</em></h2>
        </div>
        @if(isset($products) && count($products))
            <a href="{{ route('cart.addAll') }}" class="btn btn-rose"><i class="fas fa-shopping-bag"></i> Tout ajouter au panier</a>
        @endif
    </div>

    @if(isset($products) && count($products))
        <div class="wish-grid">
            @foreach($products as $product)
            <div class="wish-card">
                <div class="wish-img">
                    @if($product->images && count($product->images))
                        <img src="{{ product_image_url($product->images[0] ?? null) }}" alt="{{ $product->name }}">
                    @else
                        <img src="https://images.unsplash.com/photo-1584917865442-de89be371e2b?w=500" alt="{{ $product->name }}">
                    @endif
                    <form action="{{ route('wishlist.remove', $product->_id) }}" method="POST">
                        @csrf
                        <button type="submit" class="wish-del"><i class="fas fa-times"></i></button>
                    </form>
                </div>
                <div class="wish-body">
                    <span class="wish-cat">{{ $product->category_name ?? '' }}</span>
                    <a href="{{ route('shop.show', $product->slug) }}" class="wish-nom">{{ $product->name }}</a>
                    <span class="wish-prix">{{ number_format($product->price, 0, ',', ' ') }} F CFA</span>
                    <form action="{{ route('cart.add') }}" method="POST" style="width:100%">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->_id }}">
                        <button type="submit" class="btn btn-rose" style="width:100%;justify-content:center;font-size:10px">
                            <i class="fas fa-shopping-bag"></i> Ajouter au panier
                        </button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
    @else
        <div class="wish-vide">
            <i class="far fa-heart"></i>
            <h3>Votre wishlist est vide</h3>
            <p>Explorez notre boutique et sauvegardez vos coups de coeur.</p>
            <a href="{{ route('shop.index') }}" class="btn btn-rose">Decouvrir la boutique</a>
        </div>
    @endif
</div>
@endsection
