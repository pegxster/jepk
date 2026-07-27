@extends('layouts.app')
@section('title', $product->name . ' — JEKP Store')

@push('styles')
<style>
.page-hero{background:linear-gradient(135deg,var(--creme2),var(--blanc) 60%,var(--peche));padding:28px 50px;border-bottom:1px solid var(--peche)}
.breadcrumb{display:flex;gap:8px;align-items:center;font-size:11px;color:var(--texte2)}
.breadcrumb a{color:var(--texte2);text-decoration:none}.breadcrumb a:hover{color:var(--rose-v)}
.breadcrumb span{color:var(--rose-p)}

/* ── Layout ── */
.produit-layout{max-width:1200px;margin:0 auto;padding:60px 50px;display:grid;grid-template-columns:1fr 1fr;gap:60px;align-items:start}

/* ── Galerie ── */
.galerie{position:sticky;top:100px}
.galerie-main{aspect-ratio:3/4;border-radius:16px;overflow:hidden;background:var(--creme2);margin-bottom:12px;position:relative}
.galerie-main img{width:100%;height:100%;object-fit:cover;transition:transform .5s}
.galerie-main:hover img{transform:scale(1.04)}
.galerie-badge{position:absolute;top:14px;left:14px;font-size:9px;letter-spacing:2px;text-transform:uppercase;padding:6px 14px;border-radius:50px;font-weight:600}
.b-new{background:var(--rose-v);color:#fff}
.b-promo{background:var(--lavande2);color:#fff}
.galerie-thumbs{display:flex;gap:8px;overflow-x:auto;-webkit-overflow-scrolling:touch;padding-bottom:2px}
.galerie-thumb{width:72px;height:72px;border-radius:10px;overflow:hidden;cursor:pointer;border:2px solid transparent;transition:all .3s;flex-shrink:0}
.galerie-thumb.on,.galerie-thumb:hover{border-color:var(--rose-v)}
.galerie-thumb img{width:100%;height:100%;object-fit:cover}

/* ── Info produit ── */
.prod-info .p-cat{font-size:10px;letter-spacing:2px;text-transform:uppercase;color:var(--rose-v);margin-bottom:8px;display:block}
.prod-info h1{font-family:var(--f-titre);font-size:36px;font-weight:300;color:var(--texte);line-height:1.2;margin-bottom:14px}
.prod-info .p-desc{font-size:14px;color:var(--texte2);line-height:1.9;margin-bottom:24px}

/* Prix */
.prod-prix{display:flex;align-items:baseline;gap:12px;margin-bottom:28px}
.prix-actuel{font-family:var(--f-titre);font-size:34px;font-weight:300;color:var(--brun-d)}
.prix-ancien{font-size:18px;color:var(--texte2);text-decoration:line-through}
.prix-promo{font-size:13px;background:var(--lavande);color:var(--lavande2);padding:4px 12px;border-radius:50px;font-weight:600}

/* Stock */
.stock-badge{display:inline-flex;align-items:center;gap:7px;font-size:12px;padding:7px 14px;border-radius:50px;margin-bottom:22px}
.stock-ok{background:#f0faf5;color:#2d6a4f}
.stock-low{background:#fff8e0;color:#a06020}
.stock-out{background:#fff0f0;color:#c0392b}
.stock-dot{width:8px;height:8px;border-radius:50%}
.dot-ok{background:#2d6a4f}.dot-low{background:#e0a020}.dot-out{background:#c0392b}

/* Options */
.opt-label{font-size:10px;letter-spacing:2px;text-transform:uppercase;color:var(--texte2);font-weight:500;display:block;margin-bottom:10px}

/* Quantité + bouton */
.add-row{display:flex;gap:12px;align-items:center;margin-top:28px}
.qty-ctrl{display:flex;align-items:center;border:1.5px solid var(--peche);border-radius:50px;overflow:hidden}
.qty-btn{width:38px;height:44px;background:none;border:none;cursor:pointer;font-size:16px;color:var(--texte2);transition:background .2s;font-family:var(--f-corps)}
.qty-btn:hover{background:var(--peche)}
.qty-input{width:48px;text-align:center;border:none;outline:none;font-family:var(--f-corps);font-size:15px;color:var(--texte);background:transparent}
.btn-cart{flex:1;justify-content:center;border-radius:50px;padding:14px 24px;font-size:13px}
.btn-wish{width:46px;height:46px;border-radius:50%;background:var(--blanc);border:1.5px solid var(--peche);display:flex;align-items:center;justify-content:center;color:var(--texte2);cursor:pointer;transition:all .3s;flex-shrink:0}
.btn-wish:hover{background:var(--rose-v);border-color:var(--rose-v);color:#fff}

/* Infos sup */
.prod-meta{margin-top:32px;padding-top:24px;border-top:1px solid var(--peche);display:flex;flex-direction:column;gap:10px}
.meta-row{display:flex;align-items:flex-start;gap:10px;font-size:13px;color:var(--texte2)}
.meta-row i{color:var(--rose-v);width:16px;margin-top:2px;flex-shrink:0}
.meta-row strong{color:var(--texte);margin-right:4px}

/* Accordéon */
.accord{border-top:1px solid var(--peche);margin-top:32px}
.accord-item{border-bottom:1px solid var(--peche)}
.accord-btn{width:100%;background:none;border:none;padding:16px 0;display:flex;justify-content:space-between;align-items:center;cursor:pointer;font-family:var(--f-corps);font-size:14px;font-weight:500;color:var(--texte);text-align:left}
.accord-btn i{color:var(--rose-v);transition:transform .3s;font-size:12px}
.accord-btn.open i{transform:rotate(180deg)}
.accord-body{max-height:0;overflow:hidden;transition:max-height .4s ease;font-size:13.5px;color:var(--texte2);line-height:1.9}
.accord-body.open{max-height:500px;padding-bottom:16px}

/* Produits similaires */
.similaires{max-width:1200px;margin:0 auto;padding:0 50px 80px}
.similaires h2{font-family:var(--f-titre);font-size:28px;font-weight:300;margin-bottom:28px;color:var(--texte)}
.similaires-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:20px}
.p-carte{position:relative}
.p-img{position:relative;overflow:hidden;aspect-ratio:3/4;border-radius:var(--rayon);margin-bottom:12px;background:var(--beige)}
.p-img img{width:100%;height:100%;object-fit:cover;transition:transform .65s}
.p-carte:hover .p-img img{transform:scale(1.06)}
.p-nom{font-family:var(--f-titre);font-size:16px;font-weight:300;color:var(--texte);text-decoration:none;display:block;margin-bottom:4px}
.p-nom:hover{color:var(--rose-v)}
.p-cat{font-size:10px;color:var(--rose-v);letter-spacing:1.5px;text-transform:uppercase;margin-bottom:3px;display:block}
.p-prix{font-size:15px;color:var(--brun-d);font-weight:400}

@media(max-width:900px){
    .produit-layout{grid-template-columns:1fr;padding:24px 16px;gap:32px}
    .galerie{position:static}
    .similaires{padding:0 16px 50px}
    .similaires-grid{grid-template-columns:repeat(2,1fr)}
    .page-hero{padding:16px 16px}
    .breadcrumb{flex-wrap:wrap;row-gap:4px}
    .prod-info h1{font-size:28px}
    .prix-actuel{font-size:26px}
    .prod-prix{flex-wrap:wrap;row-gap:6px}
    .prod-info{padding:0}
    .similaires h2{font-size:22px}
}
@media(max-width:500px){
    .produit-layout{padding:16px 12px}
    .galerie-main{border-radius:12px}
    .galerie-thumbs{gap:6px}
    .galerie-thumb{width:56px;height:56px}
    .prix-actuel{font-size:22px}
    .prix-ancien{font-size:14px}
    .add-row{flex-wrap:wrap}
    .qty-ctrl{order:1}
    .btn-wish{order:2;margin-left:auto}
    .btn-cart{order:3;width:100%}
    .similaires-grid{grid-template-columns:1fr 1fr;gap:12px}
    .p-nom{font-size:13px}
    .p-prix{font-size:12px}
}
</style>
@endpush

@section('content')

<div class="page-hero">
    <div class="breadcrumb">
        <a href="{{ route('home') }}">Accueil</a>
        <i class="fas fa-chevron-right" style="font-size:9px"></i>
        <a href="{{ route('shop.index') }}">Boutique</a>
        @if($product->category_name)
        <i class="fas fa-chevron-right" style="font-size:9px"></i>
        <a href="{{ route('categories.index') }}">{{ $product->category_name }}</a>
        @endif
        <i class="fas fa-chevron-right" style="font-size:9px"></i>
        <span>{{ $product->name }}</span>
    </div>
</div>

<div class="produit-layout">

    {{-- Galerie images --}}
    <div class="galerie">
        <div class="galerie-main">
            @if($product->is_featured)
                <span class="galerie-badge b-new">Coup de cœur</span>
            @elseif($product->sale_price && $product->sale_price < $product->price)
                <span class="galerie-badge b-promo">Promo</span>
            @endif
            @if(!empty($product->images))
                <img id="mainImg" src="{{ product_image_url($product->images[0] ?? null) }}" alt="{{ $product->name }}" loading="lazy">
            @else
                <div style="width:100%;height:100%;background:var(--creme2);display:flex;align-items:center;justify-content:center">
                    <i class="fas fa-image" style="font-size:60px;color:var(--peche2);opacity:.5"></i>
                </div>
            @endif
        </div>
        @if(count($product->images ?? []) > 1)
        <div class="galerie-thumbs">
            @foreach($product->images as $i => $img)
            <div class="galerie-thumb {{ $i === 0 ? 'on' : '' }}" onclick="switchImg(this, '{{ product_image_url($img) }}')">
                <img src="{{ product_image_url($img) }}" alt="" loading="lazy">
            </div>
            @endforeach
        </div>
        @endif
    </div>

    {{-- Info produit --}}
    <div class="prod-info">
        @if($product->category_name)
            <span class="p-cat">{{ $product->category_name }}</span>
        @endif
        <h1>{{ $product->name }}</h1>

        {{-- Prix --}}
        <div class="prod-prix">
            <span class="prix-actuel">{{ number_format($product->sale_price ?? $product->price, 0, ',', ' ') }} CFA</span>
            @if($product->sale_price && $product->sale_price < $product->price)
                <span class="prix-ancien">{{ number_format($product->price, 0, ',', ' ') }} CFA</span>
                @php $pct = round((1 - $product->sale_price / $product->price) * 100) @endphp
                <span class="prix-promo">-{{ $pct }}%</span>
            @endif
        </div>

        {{-- Stock --}}
        @if(($product->stock ?? 0) <= 0)
            <div class="stock-badge stock-out"><span class="stock-dot dot-out"></span> Rupture de stock</div>
        @elseif($product->stock <= 5)
            <div class="stock-badge stock-low"><span class="stock-dot dot-low"></span> Plus que {{ $product->stock }} en stock</div>
        @else
            <div class="stock-badge stock-ok"><span class="stock-dot dot-ok"></span> En stock</div>
        @endif

        {{-- Description --}}
        @if($product->description)
        <p class="p-desc">{{ $product->description }}</p>
        @endif

        {{-- Couleurs --}}
        @if(!empty($product->colors))
        <div style="margin-bottom:18px">
            <span class="opt-label">Coloris disponibles</span>
            <div style="display:flex;flex-wrap:wrap;gap:8px">
                @foreach($product->colors as $color)
                <span style="font-size:12px;padding:6px 14px;border-radius:50px;border:1.5px solid var(--peche);color:var(--texte2);cursor:pointer;transition:all .3s" onclick="this.style.borderColor='var(--rose-v)';this.style.color='var(--rose-v)'">{{ $color }}</span>
                @endforeach
            </div>
        </div>
        @endif

        {{-- Matières --}}
        @if(!empty($product->materials))
        <div style="margin-bottom:18px">
            <span class="opt-label">Matières</span>
            <div style="display:flex;flex-wrap:wrap;gap:8px">
                @foreach($product->materials as $mat)
                <span style="font-size:11px;padding:5px 12px;border-radius:50px;background:var(--creme2);color:var(--texte2);border:1px solid var(--peche)">{{ $mat }}</span>
                @endforeach
            </div>
        </div>
        @endif

        {{-- Ajout au panier --}}
        @if(($product->stock ?? 0) > 0)
        <form action="{{ route('cart.add') }}" method="POST">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->_id }}">
            <div class="add-row">
                <div class="qty-ctrl">
                    <button type="button" class="qty-btn" onclick="changeQty(-1)">−</button>
                    <input type="number" name="quantity" id="qtyInput" class="qty-input" value="1" min="1" max="{{ $product->stock ?? 99 }}">
                    <button type="button" class="qty-btn" onclick="changeQty(1)">+</button>
                </div>
                <button type="submit" class="btn btn-rose btn-cart">
                    <i class="fas fa-shopping-bag"></i> Ajouter au panier
                </button>
                <button type="button" class="btn-wish" title="Ajouter à ma wishlist">
                    <i class="far fa-heart"></i>
                </button>
            </div>
        </form>
        @else
        <button class="btn btn-outline-rose btn-cart" disabled style="opacity:.5;cursor:not-allowed;margin-top:28px">
            <i class="fas fa-ban"></i> Produit indisponible
        </button>
        @endif

        @if(session('success'))
        <div style="background:#f0faf5;border:1px solid #a8d5be;color:#2d6a4f;padding:12px 16px;border-radius:10px;margin-top:14px;font-size:13px">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
        @endif

        {{-- Méta infos --}}
        <div class="prod-meta">
            <div class="meta-row"><i class="fas fa-truck"></i><span><strong>Livraison</strong> offerte dès 70 000 F CFA d'achat</span></div>
            <div class="meta-row"><i class="fas fa-undo"></i><span><strong>Retours</strong> sous 14 jours</span></div>
            <div class="meta-row"><i class="fas fa-shield-alt"></i><span><strong>Paiement</strong> 100% sécurisé</span></div>
            @if(!empty($product->tags))
            <div class="meta-row"><i class="fas fa-tag"></i><span><strong>Tags :</strong> {{ implode(', ', $product->tags) }}</span></div>
            @endif
        </div>

        {{-- Accordéon --}}
        @if($product->description)
        <div class="accord">
            <div class="accord-item">
                <button class="accord-btn" onclick="toggleAccord(this)">
                    Description complète <i class="fas fa-chevron-down"></i>
                </button>
                <div class="accord-body">{{ $product->description }}</div>
            </div>
            <div class="accord-item">
                <button class="accord-btn" onclick="toggleAccord(this)">
                    Entretien & Conseils <i class="fas fa-chevron-down"></i>
                </button>
                <div class="accord-body">Lavage à la main recommandé à 30°C. Ne pas essorer ni mettre en machine. Sécher à plat. Ne pas repasser directement sur le motif. Conserver dans un endroit sec à l'abri de la lumière.</div>
            </div>
            <div class="accord-item">
                <button class="accord-btn" onclick="toggleAccord(this)">
                    Livraison & Retours <i class="fas fa-chevron-down"></i>
                </button>
                <div class="accord-body">Livraison offerte dès 60 000 CFA d'achat. Expédition sous 2–3 jours ouvrés. Retours acceptés sous 14 jours après réception — article en état d'origine. Contactez-nous via WhatsApp pour tout échange.</div>
            </div>
        </div>
        @endif
    </div>
</div>

{{-- Produits similaires --}}
@if($related->count())
<div class="similaires">
    <h2>Vous aimerez aussi</h2>
    <div class="similaires-grid">
        @foreach($related as $p)
        <div class="p-carte">
            <div class="p-img">
                @if(!empty($p->images))
                    <img src="{{ product_image_url($p->images[0] ?? $p->image ?? null) }}" alt="{{ $p->name }}" loading="lazy">
                @else
                    <div style="width:100%;height:100%;background:var(--creme2);display:flex;align-items:center;justify-content:center"><i class="fas fa-image" style="color:var(--peche2);font-size:30px;opacity:.4"></i></div>
                @endif
            </div>
            @if($p->category_name)<span class="p-cat">{{ $p->category_name }}</span>@endif
            <a href="{{ route('shop.show', $p->slug) }}" class="p-nom">{{ $p->name }}</a>
            <span class="p-prix">{{ number_format($p->sale_price ?? $p->price, 0, ',', ' ') }} CFA</span>
        </div>
        @endforeach
    </div>
</div>
@endif

@endsection

@push('scripts')
<script>
function switchImg(thumb, src) {
    document.getElementById('mainImg').src = src;
    document.querySelectorAll('.galerie-thumb').forEach(t => t.classList.remove('on'));
    thumb.classList.add('on');
}
function changeQty(delta) {
    const input = document.getElementById('qtyInput');
    const min = parseInt(input.min) || 1;
    const max = parseInt(input.max) || 999;
    input.value = Math.max(min, Math.min(max, parseInt(input.value || 1) + delta));
}
function toggleAccord(btn) {
    const body = btn.nextElementSibling;
    const isOpen = btn.classList.contains('open');
    document.querySelectorAll('.accord-btn.open').forEach(b => {
        b.classList.remove('open');
        b.nextElementSibling.classList.remove('open');
    });
    if (!isOpen) { btn.classList.add('open'); body.classList.add('open'); }
}
</script>
@endpush
