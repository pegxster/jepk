@extends('layouts.app')
@section('title','Ma Wishlist — JEKP Store')
@push('styles')
<style>
.page-hero{background:linear-gradient(135deg,var(--creme2),var(--peche));padding:52px 50px;text-align:center;border-bottom:1px solid var(--peche)}
.breadcrumb{display:flex;gap:8px;align-items:center;font-size:11px;color:var(--texte2);justify-content:center;margin-top:14px}
.breadcrumb a{color:var(--texte2);text-decoration:none}.breadcrumb a:hover{color:var(--rose-v)}
.breadcrumb span{color:var(--rose-p)}
.wish-layout{max-width:1200px;margin:0 auto;padding:60px 50px}
.wish-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:24px;margin-top:32px}
.wish-card{background:var(--blanc);border-radius:var(--rayon);overflow:hidden;box-shadow:var(--ombre-sm);position:relative;transition:var(--trans)}
.wish-card:hover{transform:translateY(-4px);box-shadow:var(--ombre)}
.wish-img{position:relative;overflow:hidden;aspect-ratio:3/4}
.wish-img img{width:100%;height:100%;object-fit:cover;transition:transform .6s}
.wish-card:hover .wish-img img{transform:scale(1.05)}
.wish-del{position:absolute;top:10px;right:10px;width:32px;height:32px;background:var(--blanc);border:none;border-radius:50%;cursor:pointer;display:flex;align-items:center;justify-content:center;font-size:13px;color:var(--rose-v);box-shadow:var(--ombre-sm);transition:var(--trans)}
.wish-del:hover{background:var(--rose-v);color:var(--blanc)}
.wish-body{padding:16px}
.wish-cat{font-size:10px;color:var(--rose-v);letter-spacing:2px;text-transform:uppercase;margin-bottom:4px;display:block}
.wish-nom{font-family:var(--f-titre);font-size:17px;font-weight:300;color:var(--texte);margin-bottom:8px;display:block}
.wish-prix{font-size:15px;font-weight:400;color:var(--brun-d);margin-bottom:14px;display:block}
.wish-vide{text-align:center;padding:80px 0}
.wish-vide i{font-size:60px;color:var(--peche2);margin-bottom:20px;display:block}
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
        @php $dp=[['nom'=>'Laine Mérinos Soyeux','cat'=>'Fils Rares','prix'=>'22,90 €','img'=>'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=500'],['nom'=>'Kit Pull Couture N°1','cat'=>'Kits Signature','prix'=>'68,00 €','img'=>'https://images.unsplash.com/photo-1584917865442-de89be371e2b?w=500'],['nom'=>'Alpaga des Andes','cat'=>'Fils Rares','prix'=>'28,50 €','img'=>'https://images.unsplash.com/photo-1574359411659-15573a27fd0c?w=500'],['nom'=>'Aiguilles Bambou','cat'=>'Accessoires','prix'=>'18,50 €','img'=>'https://images.unsplash.com/photo-1616400619175-5beda3a17896?w=500']]; @endphp
        @if(isset($wishlist) && count($wishlist))
            <a href="{{ route('cart.addAll') }}" class="btn btn-rose">Tout ajouter au panier</a>
        @endif
    </div>

    @if((isset($wishlist) && count($wishlist)) || count($dp))
        <div class="wish-grid">
            @foreach(isset($wishlist) && count($wishlist) ? $wishlist : $dp as $p)
            <div class="wish-card">
                <div class="wish-img">
                    <img src="{{ $p['img'] ?? $p->image }}" alt="{{ $p['nom'] ?? $p->name }}">
                    <form action="{{ route('wishlist.remove') }}" method="POST">
                        @csrf <input type="hidden" name="product_id" value="{{ $p['id'] ?? 0 }}">
                        <button type="submit" class="wish-del"><i class="fas fa-times"></i></button>
                    </form>
                </div>
                <div class="wish-body">
                    <span class="wish-cat">{{ $p['cat'] ?? ($p->category->name ?? '') }}</span>
                    <span class="wish-nom">{{ $p['nom'] ?? $p->name }}</span>
                    <span class="wish-prix">{{ $p['prix'] ?? number_format($p->price,2,',',' ').' €' }}</span>
                    <a href="#" class="btn btn-rose" style="width:100%;justify-content:center;font-size:10px">Ajouter au panier</a>
                </div>
            </div>
            @endforeach
        </div>
    @else
        <div class="wish-vide">
            <i class="far fa-heart"></i>
            <h3 style="font-family:var(--f-titre);font-size:24px;font-weight:300;margin-bottom:10px">Votre wishlist est vide</h3>
            <p style="font-size:14px;color:var(--texte2);margin-bottom:24px">Explorez notre boutique et sauvegardez vos coups de cœur.</p>
            <a href="{{ route('shop.index') }}" class="btn btn-rose">Découvrir la boutique</a>
        </div>
    @endif
</div>
@endsection