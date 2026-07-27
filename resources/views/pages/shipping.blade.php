@extends('layouts.app')
@section('title','Livraison — JEKP Store')
@push('styles')
<style>
.page-hero{background:linear-gradient(135deg,var(--creme2) 0%,var(--blanc) 50%,var(--peche) 100%);padding:80px 50px;text-align:center;border-bottom:1px solid var(--peche);position:relative;overflow:hidden}
.page-hero::before{content:'';position:absolute;right:-100px;top:-100px;width:320px;height:320px;border-radius:50%;background:linear-gradient(135deg,var(--peche),var(--rose-p));opacity:.1;pointer-events:none}
.breadcrumb{display:flex;gap:8px;align-items:center;font-size:11px;color:var(--texte2);justify-content:center;margin-top:14px}
.breadcrumb a{color:var(--texte2);text-decoration:none;transition:color .3s}.breadcrumb a:hover{color:var(--rose-v)}
.breadcrumb span{color:var(--rose-p)}
.ship-wrap{max-width:900px;margin:0 auto;padding:60px 50px}
.ship-block{background:var(--blanc);border-radius:16px;padding:36px;box-shadow:var(--ombre-sm);border:1px solid var(--peche);margin-bottom:24px}
.ship-block h2{font-family:var(--f-titre);font-size:24px;font-weight:300;color:var(--texte);margin-bottom:16px;display:flex;align-items:center;gap:10px}
.ship-block h2 i{color:var(--rose-v)}
.ship-block p,.ship-block li{font-size:14px;color:var(--texte2);line-height:2}
.ship-block ul{list-style:none;margin-top:10px}
.ship-block li{padding:8px 0;border-bottom:1px solid var(--creme2);display:flex;align-items:center;gap:10px}
.ship-block li:last-child{border-bottom:none}
.ship-block li i{color:var(--rose-v);font-size:14px;width:20px;text-align:center}
.zones-grid{display:grid;grid-template-columns:1fr 1fr;gap:20px;margin-top:20px}
.zone-card{background:var(--creme2);border-radius:12px;padding:22px;text-align:center;border:1px solid var(--peche)}
.zone-card h3{font-family:var(--f-titre);font-size:18px;font-weight:300;color:var(--texte);margin-bottom:6px}
.zone-card .time{font-size:22px;font-weight:600;color:var(--rose-v);margin-bottom:4px;font-family:var(--f-titre)}
.zone-card p{font-size:12px;color:var(--texte2)}
@media(max-width:900px){.ship-wrap{padding:30px 16px}.zones-grid{grid-template-columns:1fr}.page-hero{padding:36px 20px}.ship-block{padding:24px}}
@media(max-width:500px){
    .page-hero{padding:28px 14px}
    .ship-wrap{padding:20px 12px}
    .ship-block{padding:18px 16px;margin-bottom:16px}
    .ship-block h2{font-size:19px;gap:8px}
    .ship-block p,.ship-block li{font-size:13px}
    .ship-block li{gap:8px;padding:7px 0}
    .zone-card{padding:16px}
    .zone-card .time{font-size:18px}
}
</style>
@endpush
@section('content')
<div class="page-hero">
    <span class="s-label">Nos Offres</span>
    <h1 class="s-titre">Livraison & <em>Retours</em></h1>
    <div class="breadcrumb"><a href="{{ route('home') }}">Accueil</a> <i class="fas fa-chevron-right" style="font-size:9px"></i> <span>Livraison</span></div>
</div>
<div class="ship-wrap">
    <div class="ship-block">
        <h2><i class="fas fa-truck"></i> Livraison</h2>
        <p>Nous livrons partout en Côte d'Ivoire et dans toute l'Afrique de l'Ouest. Chaque commande est soigneusement emballée avant expédition.</p>
        <div class="zones-grid">
            <div class="zone-card">
                <h3>Abidjan</h3>
                <div class="time">24 — 48h</div>
                <p>Livraison express en ville</p>
            </div>
            <div class="zone-card">
                <h3>Côte d'Ivoire</h3>
                <div class="time">3 — 5 jours</div>
                <p>Livraison dans toute la Côte d'Ivoire</p>
            </div>
            <div class="zone-card">
                <h3>Afrique de l'Ouest</h3>
                <div class="time">5 — 10 jours</div>
                <p>Sénégal, Mali, Burkina, Cameroun...</p>
            </div>
            <div class="zone-card">
                <h3>International</h3>
                <div class="time">10 — 21 jours</div>
                <p>Europe, Amérique du Nord</p>
            </div>
        </div>
    </div>

    <div class="ship-block">
        <h2><i class="fas fa-tag"></i> Tarifs de livraison</h2>
        <ul>
            <li><i class="fas fa-check-circle"></i> <strong>Abidjan :</strong> 1 500 F CFA — Livraison express</li>
            <li><i class="fas fa-check-circle"></i> <strong>Côte d'Ivoire :</strong> 3 000 F CFA — Livraison standard</li>
            <li><i class="fas fa-check-circle"></i> <strong>Afrique de l'Ouest :</strong> 7 000 F CFA — Livraison internationale</li>
            <li><i class="fas fa-gift"></i> <strong>Livraison offerte</strong> dès 70 000 F CFA d'achat en Côte d'Ivoire</li>
        </ul>
    </div>

    <div class="ship-block">
        <h2><i class="fas fa-undo"></i> Retours & Échanges</h2>
        <p>Vous disposez de 14 jours après réception pour retourner un article non utilisé et dans son emballage d'origine.</p>
        <ul>
            <li><i class="fas fa-check-circle"></i> Retour gratuit sous 14 jours</li>
            <li><i class="fas fa-check-circle"></i> Échange possible sur les produits non personnalisés</li>
            <li><i class="fas fa-check-circle"></i> Remboursement sous 5 jours ouvrés</li>
            <li><i class="fas fa-info-circle"></i> Les articles sur mesure ne sont pas éligibles au retour</li>
        </ul>
    </div>
</div>
@endsection
