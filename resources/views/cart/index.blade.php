@extends('layouts.app')
@section('title','Mon Panier — JEKP Store')
@push('styles')
<style>
/* ── Hero ── */
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

/* ── Layout ── */
.cart-layout{max-width:1200px;margin:0 auto;padding:60px 50px;
    display:grid;grid-template-columns:1fr 370px;gap:40px;align-items:start}

/* ── Livraison progress ── */
.livraison-progress{background:var(--blanc);border-radius:12px;padding:16px 20px;
    border:1px solid var(--peche);box-shadow:var(--ombre-sm);margin-bottom:24px}
.lp-txt{display:flex;justify-content:space-between;font-size:12px;color:var(--texte2);margin-bottom:8px}
.lp-txt strong{color:var(--rose-v)}
.lp-bar{height:6px;background:var(--peche);border-radius:4px;overflow:hidden}
.lp-fill{height:100%;border-radius:4px;background:linear-gradient(90deg,var(--rose-p),var(--rose-v));transition:width .5s ease}

/* ── Items panier ── */
.cart-items-bloc{background:var(--blanc);border-radius:16px;padding:28px;
    box-shadow:var(--ombre-sm);border:1px solid var(--peche)}
.cart-header{display:grid;grid-template-columns:2.5fr 1fr 1fr 1fr 40px;gap:16px;align-items:center;
    padding-bottom:14px;border-bottom:1.5px solid var(--peche);
    font-size:10px;letter-spacing:2px;text-transform:uppercase;color:var(--texte2)}
.cart-item{display:grid;grid-template-columns:2.5fr 1fr 1fr 1fr 40px;gap:16px;align-items:center;
    padding:18px 0;border-bottom:1px solid var(--peche);transition:var(--trans)}
.cart-item:hover{background:var(--creme2);margin:0 -10px;padding:18px 10px;border-radius:10px}
.cart-item:last-child{border-bottom:none}
.ci-prod{display:flex;gap:14px;align-items:center}
.ci-img{width:72px;height:92px;object-fit:cover;border-radius:10px;flex-shrink:0;
    box-shadow:var(--ombre-sm)}
.ci-nom{font-family:var(--f-titre);font-size:17px;font-weight:300;color:var(--texte);margin-bottom:4px}
.ci-var{font-size:11px;color:var(--texte2);background:var(--creme2);display:inline-block;
    padding:2px 8px;border-radius:50px}
.ci-prix{font-size:15px;font-weight:400;color:var(--brun-d)}
.ci-qte{display:flex;align-items:center;gap:0;border:1.5px solid var(--peche);border-radius:10px;overflow:hidden}
.ci-qte button{width:32px;height:32px;border:none;background:transparent;cursor:pointer;font-size:16px;
    color:var(--texte2);transition:var(--trans);display:flex;align-items:center;justify-content:center}
.ci-qte button:hover{background:var(--peche);color:var(--rose-v)}
.ci-qte span{font-size:13px;font-weight:500;color:var(--texte);min-width:28px;text-align:center;
    border-left:1px solid var(--peche);border-right:1px solid var(--peche);padding:0 4px;line-height:32px}
.ci-total{font-size:16px;font-weight:500;color:var(--rose-v)}
.ci-del{background:none;border:none;color:var(--peche2);cursor:pointer;font-size:15px;
    transition:color .3s;width:32px;height:32px;display:flex;align-items:center;justify-content:center;
    border-radius:8px}
.ci-del:hover{color:var(--rose-f);background:var(--creme2)}
.cart-actions{display:flex;justify-content:space-between;align-items:center;
    margin-top:20px;padding-top:18px;border-top:1px solid var(--peche)}

/* ── Panier vide ── */
.cart-vide{text-align:center;padding:70px 0}
.cart-vide i{font-size:56px;color:var(--peche2);margin-bottom:18px;display:block}
.cart-vide h3{font-family:var(--f-titre);font-size:26px;font-weight:300;color:var(--texte);margin-bottom:10px}
.cart-vide p{font-size:14px;color:var(--texte2);margin-bottom:28px;line-height:1.8}

/* ── Récapitulatif ── */
.cart-recap{background:var(--blanc);border-radius:16px;padding:32px 28px;
    box-shadow:0 8px 40px rgba(90,48,64,.12);position:sticky;top:100px;
    border:1px solid var(--peche)}
.recap-titre{font-family:var(--f-titre);font-size:21px;font-weight:300;color:var(--texte);
    margin-bottom:22px;padding-bottom:14px;border-bottom:1.5px solid var(--peche)}
.recap-ligne{display:flex;justify-content:space-between;font-size:13px;color:var(--texte2);margin-bottom:10px}
.recap-ligne span:last-child{font-weight:400;color:var(--texte)}
.recap-ligne.total{font-size:17px;font-weight:500;color:var(--texte);
    margin-top:16px;padding-top:16px;border-top:1.5px solid var(--peche)}
.recap-ligne.total span:last-child{color:var(--rose-v);font-family:var(--f-titre);font-size:20px}
.recap-promo{display:flex;gap:8px;margin:18px 0}
.recap-promo input{flex:1;padding:11px 14px;border:1.5px solid var(--peche);border-radius:10px;
    font-family:var(--f-corps);font-size:13px;outline:none;background:var(--creme2);transition:border-color .3s}
.recap-promo input:focus{border-color:var(--rose-v);background:var(--blanc)}
.recap-promo .btn{padding:11px 18px;font-size:10px;white-space:nowrap}
.recap-info{display:flex;align-items:center;gap:9px;font-size:12px;color:var(--texte2);
    padding:11px 14px;background:var(--creme2);border-radius:9px;margin:8px 0}
.recap-info i{color:var(--rose-v);font-size:14px;flex-shrink:0}
.payer-btn{width:100%;justify-content:center;margin-top:16px;border-radius:50px;
    padding:15px;font-size:11px;box-shadow:0 6px 24px rgba(201,112,128,.4)}

@media(max-width:900px){
    .cart-layout{grid-template-columns:1fr;padding:24px 16px}
    .cart-header{display:none}
    .cart-item{grid-template-columns:1fr;position:relative;padding:16px 0 16px 92px;min-height:100px}
    .ci-prod{position:absolute;left:0;top:16px;right:14px}
    .ci-prod>div:last-child{flex:1;min-width:0}
    .ci-nom{overflow-wrap:break-word}
    .ci-img{width:72px;height:82px}
    .ci-qte button{width:40px;height:40px}
    .ci-qte span{line-height:40px}
    .ci-del{width:40px;height:40px}
    .page-hero{padding:36px 20px}
    .page-hero::before{display:none}
    .breadcrumb{flex-wrap:wrap;row-gap:4px}
    .cart-items-bloc{padding:16px;border-radius:12px}
    .cart-recap{padding:20px 16px;border-radius:12px;position:static;box-shadow:var(--ombre-sm)}
    .recap-titre{font-size:18px}
    .payer-btn{padding:13px;font-size:11px}
    .cart-actions{flex-direction:column;gap:10px}
    .cart-actions .btn{width:100%;justify-content:center}
}
@media(max-width:500px){
    .cart-item{padding:14px 0 14px 80px;min-height:85px}
    .ci-prod{right:10px}
    .ci-img{width:62px;height:72px}
    .ci-nom{font-size:14px}
    .ci-prix,.ci-total{font-size:13px}
}
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
        @php $total = $total ?? 0; $seuil = 70000; $reste = max(0, $seuil - $total); $pct = min(100, round($total / $seuil * 100)); @endphp
        <div class="livraison-progress">
            @if($reste > 0)
                <div class="lp-txt"><span>Encore <strong>{{ number_format($reste,0,',',' ') }} fr</strong> pour la livraison offerte</span><span>{{ $pct }}%</span></div>
            @else
                <div class="lp-txt"><span><strong>🎉 Livraison offerte !</strong> Votre commande est éligible.</span><span>100%</span></div>
            @endif
            <div class="lp-bar"><div class="lp-fill" data-pct="{{ $pct }}"></div></div>
        </div>
        @if(empty(session('cart')))
            <div class="cart-vide">
                <i class="fas fa-shopping-bag"></i>
                <h3>Votre panier est vide</h3>
                <p>Découvrez nos créations artisanales et trouvez ce qui vous inspire.</p>
                <a href="{{ route('shop.index') }}" class="btn btn-rose">Découvrir la boutique</a>
            </div>
        @else
        <div class="cart-items-bloc">
            <div class="cart-header">
                <span>Produit</span><span>Prix</span><span>Quantité</span><span>Total</span><span></span>
            </div>
            @php $total=0; @endphp
            @foreach(session('cart') as $id => $item)
            @php $sous=$item['price']*$item['quantity'];$total+=$sous; @endphp
            <div class="cart-item">
                <div class="ci-prod">
                    @if(!empty($item['image']))
                        <img src="{{ $item['image'] }}" class="ci-img" alt="{{ $item['name'] }}">
                    @else
                        <div class="ci-img" style="background:var(--creme2);display:flex;align-items:center;justify-content:center"><i class="fas fa-image" style="color:var(--peche2);font-size:22px"></i></div>
                    @endif
                    <div>
                        <div class="ci-nom">{{ $item['name'] }}</div>
                        <div class="ci-var">Création artisanale</div>
                    </div>
                </div>
                <span class="ci-prix">{{ number_format($item['price'],0,',',' ') }} CFA</span>
                <div class="ci-qte">
                    <form action="{{ route('cart.update') }}" method="POST" style="display:inline">@csrf<input type="hidden" name="product_id" value="{{ $id }}"><input type="hidden" name="quantity" value="{{ $item['quantity']-1 }}"><button type="submit">−</button></form>
                    <span>{{ $item['quantity'] }}</span>
                    <form action="{{ route('cart.update') }}" method="POST" style="display:inline">@csrf<input type="hidden" name="product_id" value="{{ $id }}"><input type="hidden" name="quantity" value="{{ $item['quantity']+1 }}"><button type="submit">+</button></form>
                </div>
                <span class="ci-total">{{ number_format($sous,0,',',' ') }} CFA</span>
                <form action="{{ route('cart.remove') }}" method="POST">@csrf<input type="hidden" name="product_id" value="{{ $id }}"><button type="submit" class="ci-del"><i class="fas fa-trash-alt"></i></button></form>
            </div>
            @endforeach
            <div class="cart-actions">
                <a href="{{ route('shop.index') }}" class="btn btn-outline-rose"><i class="fas fa-arrow-left"></i> Continuer les achats</a>
                <form action="{{ route('cart.clear') }}" method="POST">@csrf<button type="submit" class="btn btn-outline-rose"><i class="fas fa-trash"></i> Vider le panier</button></form>
            </div>
        </div>
        @endif
    </div>

    {{-- Récapitulatif --}}
    <div class="cart-recap">
        <h3 class="recap-titre">Récapitulatif</h3>
        @php
            $total    = $total ?? 0;
            $seuil_liv = 70000;
            $livraison = $total >= $seuil_liv ? 0 : 2000;
        @endphp
        <div class="recap-ligne"><span>Sous-total</span><span>{{ number_format($total,0,',',' ') }} CFA</span></div>
        <div class="recap-ligne"><span>Livraison</span><span>{{ $livraison == 0 ? 'Offerte ✓' : number_format($livraison,0,',',' ').' CFA' }}</span></div>
        <div class="recap-ligne total"><span>Total</span><span>{{ number_format($total+$livraison,0,',',' ') }} CFA</span></div>

        <div class="recap-info" style="margin-top:14px"><i class="fas fa-shield-alt"></i> Transactions sécurisées</div>
        <div class="recap-info"><i class="fas fa-headset"></i> Support WhatsApp disponible</div>
        <div class="recap-info"><i class="fas fa-lock"></i> Le moyen de paiement se choisit à l'étape suivante</div>

        @if($total > 0)
            <a href="{{ route('checkout.index') }}" class="btn btn-rose payer-btn">
                <i class="fas fa-lock"></i> Passer commande
            </a>
        @else
            <a href="{{ route('shop.index') }}" class="btn btn-rose payer-btn">Voir la boutique</a>
        @endif
    </div>
</div>
@endsection
@push('scripts')
<script>
    // Barre de progression livraison
    document.querySelectorAll('.lp-fill').forEach(function(el) {
        el.style.width = (el.dataset.pct || 0) + '%';
    });
</script>
@endpush