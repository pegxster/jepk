@extends('layouts.app')
@section('title','Mon Panier — JEKP Store')
@push('styles')
<style>
.page-hero{background:linear-gradient(135deg,var(--creme2),var(--peche));padding:52px 50px;text-align:center;border-bottom:1px solid var(--peche)}
.breadcrumb{display:flex;gap:8px;align-items:center;font-size:11px;color:var(--texte2);justify-content:center;margin-top:14px}
.breadcrumb a{color:var(--texte2);text-decoration:none;transition:color .3s}.breadcrumb a:hover{color:var(--rose-v)}
.breadcrumb span{color:var(--rose-p)}
.cart-layout{max-width:1200px;margin:0 auto;padding:60px 50px;display:grid;grid-template-columns:1fr 360px;gap:40px;align-items:start}
/* Lignes panier */

.cart-header{display:grid;grid-template-columns:2.5fr 1fr 1fr 1fr 40px;gap:16px;align-items:center;padding:0 0 14px;border-bottom:1px solid var(--peche);font-size:10px;letter-spacing:2px;text-transform:uppercase;color:var(--texte2)}
.cart-item{display:grid;grid-template-columns:2.5fr 1fr 1fr 1fr 40px;gap:16px;align-items:center;padding:20px 0;border-bottom:1px solid var(--peche);transition:background .3s}
.cart-item:hover{background:var(--creme2);margin:0 -12px;padding:20px 12px;border-radius:10px}
.ci-prod{display:flex;gap:14px;align-items:center}
.ci-img{width:70px;height:90px;object-fit:cover;border-radius:8px;flex-shrink:0}
.ci-nom{font-family:var(--f-titre);font-size:17px;font-weight:300;color:var(--texte);margin-bottom:3px}
.ci-var{font-size:11px;color:var(--texte2)}
.ci-prix{font-size:15px;font-weight:400;color:var(--brun-d)}
.ci-qte{display:flex;align-items:center;gap:8px}
.ci-qte button{width:30px;height:30px;border:1.5px solid var(--peche);background:transparent;border-radius:8px;cursor:pointer;font-size:15px;color:var(--texte2);transition:var(--trans);display:flex;align-items:center;justify-content:center}
.ci-qte button:hover{border-color:var(--rose-v);color:var(--rose-v)}
.ci-qte span{font-size:14px;font-weight:500;color:var(--texte);min-width:20px;text-align:center}
.ci-total{font-size:16px;font-weight:500;color:var(--rose-v)}
.ci-del{background:none;border:none;color:var(--peche2);cursor:pointer;font-size:15px;transition:color .3s}
.ci-del:hover{color:var(--rose-f)}
.cart-vide{text-align:center;padding:80px 0}
.cart-vide i{font-size:60px;color:var(--peche2);margin-bottom:20px;display:block}
.cart-vide h3{font-family:var(--f-titre);font-size:24px;font-weight:300;color:var(--texte);margin-bottom:10px}
.cart-vide p{font-size:14px;color:var(--texte2);margin-bottom:28px}
/* Récap */
.cart-recap{background:var(--blanc);border-radius:16px;padding:32px 28px;box-shadow:var(--ombre);position:sticky;top:100px}
.recap-titre{font-family:var(--f-titre);font-size:20px;font-weight:300;color:var(--texte);margin-bottom:22px;padding-bottom:14px;border-bottom:1px solid var(--peche)}
.recap-ligne{display:flex;justify-content:space-between;font-size:13px;color:var(--texte2);margin-bottom:10px}
.recap-ligne.total{font-size:16px;font-weight:500;color:var(--texte);margin-top:14px;padding-top:14px;border-top:1px solid var(--peche)}
.recap-ligne.total span:last-child{color:var(--rose-v)}
.recap-promo{display:flex;gap:8px;margin:18px 0}
.recap-promo input{flex:1;padding:11px 14px;border:1.5px solid var(--peche);border-radius:10px;font-family:var(--f-corps);font-size:13px;outline:none;background:var(--creme2);transition:border-color .3s}
.recap-promo input:focus{border-color:var(--rose-v)}
.recap-promo .btn{padding:11px 18px;font-size:10px}
.recap-info{display:flex;align-items:center;gap:8px;font-size:12px;color:var(--texte2);padding:12px;background:var(--creme2);border-radius:8px;margin:12px 0}
.recap-info i{color:var(--rose-v)}
.payer-btn{width:100%;justify-content:center;margin-top:14px;border-radius:50px}
.cart-actions{display:flex;justify-content:space-between;align-items:center;margin-top:28px;padding-top:20px;border-top:1px solid var(--peche)}
@media(max-width:900px){.cart-layout{grid-template-columns:1fr;padding:40px 24px}.cart-header{display:none}.cart-item{grid-template-columns:1fr;position:relative;padding:16px 0 16px 90px}.ci-prod{position:absolute;left:0;top:16px}.ci-img{width:70px;height:80px}}
</style>
@endpush
@section('content')
<div class="page-hero">
    <span class="s-label">Mon Panier</span>
    <h1 class="s-titre">Vos <em>articles</em></h1>
    <div class="breadcrumb"><a href="{{ route('home') }}">Accueil</a> <i class="fas fa-chevron-right" style="font-size:9px"></i> <span>Panier</span></div>
</div>

<div class="cart-layout">
    <div class="cart-items">
        @if(empty(session('cart')))
            <div class="cart-vide">
                <i class="fas fa-shopping-bag"></i>
                <h3>Votre panier est vide</h3>
                <p>Découvrez nos créations artisanales et trouvez ce qui vous inspire.</p>
                <a href="{{ route('shop.index') }}" class="btn btn-rose">Découvrir la boutique</a>
            </div>
        @else
            <div class="cart-header">
                <span>Produit</span><span>Prix</span><span>Quantité</span><span>Total</span><span></span>
            </div>
            @php $total=0; @endphp
            @foreach(session('cart') as $id => $item)
            @php $sous=$item['prix']*$item['qte'];$total+=$sous; @endphp
            <div class="cart-item">
                <div class="ci-prod">
                    <img src="{{ $item['img'] ?? 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=200' }}" class="ci-img" alt="{{ $item['nom'] }}">
                    <div>
                        <div class="ci-nom">{{ $item['nom'] }}</div>
                        <div class="ci-var">{{ $item['variante'] ?? '' }}</div>
                    </div>
                </div>
                <span class="ci-prix">{{ number_format($item['prix'],2,',',' ') }} €</span>
                <div class="ci-qte">
                    <form action="{{ route('cart.update') }}" method="POST" style="display:inline">@csrf<input type="hidden" name="product_id" value="{{ $id }}"><input type="hidden" name="qte" value="{{ $item['qte']-1 }}"><button type="submit">−</button></form>
                    <span>{{ $item['qte'] }}</span>
                    <form action="{{ route('cart.update') }}" method="POST" style="display:inline">@csrf<input type="hidden" name="product_id" value="{{ $id }}"><input type="hidden" name="qte" value="{{ $item['qte']+1 }}"><button type="submit">+</button></form>
                </div>
                <span class="ci-total">{{ number_format($sous,2,',',' ') }} €</span>
                <form action="{{ route('cart.remove') }}" method="POST">@csrf<input type="hidden" name="product_id" value="{{ $id }}"><button type="submit" class="ci-del"><i class="fas fa-trash-alt"></i></button></form>
            </div>
            @endforeach
            <div class="cart-actions">
                <a href="{{ route('shop.index') }}" class="btn btn-outline-rose"><i class="fas fa-arrow-left"></i> Continuer les achats</a>
                <form action="{{ route('cart.clear') }}" method="POST">@csrf<button type="submit" class="btn btn-outline-rose">Vider le panier</button></form>
            </div>
        @endif
    </div>

    {{-- Récapitulatif --}}
    <div class="cart-recap">
        <h3 class="recap-titre">Récapitulatif</h3>
        @php $total = $total ?? 0; $livraison = $total >= 60 ? 0 : 5.90; @endphp
        <div class="recap-ligne"><span>Sous-total</span><span>{{ number_format($total,2,',',' ') }} €</span></div>
        <div class="recap-ligne"><span>Livraison</span><span>{{ $livraison == 0 ? 'Offerte ✓' : number_format($livraison,2,',',' ').' €' }}</span></div>
        <div class="recap-ligne total"><span>Total</span><span>{{ number_format($total+$livraison,2,',',' ') }} €</span></div>
        <div class="recap-promo">
            <input type="text" placeholder="Code promo">
            <a href="#" class="btn btn-peche">OK</a>
        </div>
        <div class="recap-info"><i class="fas fa-shield-alt"></i> Paiement 100% sécurisé</div>
        <div class="recap-info"><i class="fas fa-undo"></i> Retours gratuits sous 14 jours</div>
        @if($total > 0)
            <a href="{{ route('checkout.index') }}" class="btn btn-rose payer-btn"><i class="fas fa-lock"></i> Passer commande</a>
        @else
            <a href="{{ route('shop.index') }}" class="btn btn-rose payer-btn">Voir la boutique</a>
        @endif
        <div style="display:flex;gap:8px;justify-content:center;margin-top:16px">
            <i class="fab fa-cc-visa" style="font-size:24px;color:var(--texte2)"></i>
            <i class="fab fa-cc-mastercard" style="font-size:24px;color:var(--texte2)"></i>
            <i class="fab fa-cc-paypal" style="font-size:24px;color:var(--texte2)"></i>
        </div>
    </div>
</div>
@endsection