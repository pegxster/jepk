@extends('layouts.app')
@section('title','JEKP Store — Créations Artisanales')
@push('styles')
<style>
/* ============================================================
   HOME PAGE — Palette ultra-féminine
   ============================================================ */

/* ── Animations scroll ── */
.rev{opacity:0;transform:translateY(24px);transition:opacity .7s ease,transform .7s ease}
.rev.on{opacity:1;transform:translateY(0)}
.d1{transition-delay:.1s}.d2{transition-delay:.2s}.d3{transition-delay:.3s}.d4{transition-delay:.4s}

/* ══════════ CAROUSEL ══════════ */
.carousel{position:relative;width:100%;height:100vh;min-height:620px;overflow:hidden}
.car-piste{display:flex;height:100%;transition:transform 1s cubic-bezier(.77,0,.175,1)}
.car-slide{min-width:100%;height:100%;position:relative;overflow:hidden}
.car-slide img{width:100%;height:100%;object-fit:cover;filter:brightness(.58);transform:scale(1.06);transition:transform 10s ease}
.car-slide.on img{transform:scale(1)}
.car-slide::before{
    content:'';position:absolute;inset:0;z-index:1;
    background:linear-gradient(160deg,rgba(90,48,64,.5) 0%,rgba(201,112,128,.2) 50%,rgba(90,48,64,.45) 100%);
}
/* Texte centré */
.car-txt{
    position:absolute;inset:0;z-index:2;
    display:flex;flex-direction:column;align-items:center;justify-content:center;
    text-align:center;padding:0 24px;
    opacity:0;transform:translateY(30px);
    transition:opacity .9s .5s,transform .9s .5s;
}
.car-slide.on .car-txt{opacity:1;transform:translateY(0)}
.car-deco{
    display:flex;align-items:center;gap:16px;
    color:var(--peche);font-size:9px;letter-spacing:4px;text-transform:uppercase;
    margin-bottom:20px;
}
.car-deco::before,.car-deco::after{content:'';width:50px;height:1px;background:rgba(247,217,204,.5)}
.car-script{
    font-family:var(--f-script);font-size:clamp(34px,5.5vw,72px);
    color:var(--peche);display:block;margin-bottom:6px;
    text-shadow:0 4px 24px rgba(0,0,0,.25);line-height:1;
}
.car-titre{
    font-family:var(--f-titre);font-size:clamp(40px,6.5vw,88px);
    font-weight:300;color:var(--blanc);line-height:1;letter-spacing:3px;
    text-shadow:0 4px 36px rgba(0,0,0,.3);margin-bottom:18px;text-transform:uppercase;
}
.car-phrase{
    font-size:clamp(13px,1.4vw,15px);color:rgba(255,255,255,.75);
    font-weight:300;letter-spacing:1.5px;max-width:460px;line-height:1.9;margin-bottom:36px;
}
.car-btns{display:flex;gap:14px;flex-wrap:wrap;justify-content:center}

/* Contrôles */
.car-fl{
    position:absolute;top:50%;transform:translateY(-50%);z-index:10;
    width:46px;height:46px;background:rgba(255,255,255,.12);
    border:1px solid rgba(255,255,255,.3);color:var(--blanc);
    border-radius:50%;display:flex;align-items:center;justify-content:center;
    cursor:pointer;font-size:13px;backdrop-filter:blur(6px);transition:var(--trans);
}
.car-fl:hover{background:var(--rose-v);border-color:var(--rose-v)}
.car-fl.prev{left:24px}.car-fl.next{right:24px}
.car-dots{position:absolute;bottom:28px;left:50%;transform:translateX(-50%);display:flex;gap:9px;z-index:10}
.car-dot{width:8px;height:8px;background:rgba(255,255,255,.3);border:none;border-radius:50%;cursor:pointer;transition:all .4s;padding:0}
.car-dot.on{background:var(--blanc);width:30px;border-radius:4px}
.car-scroll{
    position:absolute;bottom:28px;right:36px;z-index:10;
    display:flex;flex-direction:column;align-items:center;gap:7px;
    color:rgba(255,255,255,.35);font-size:8px;letter-spacing:3px;text-transform:uppercase;
}
.car-line{width:1px;height:40px;background:linear-gradient(to bottom,transparent,rgba(255,255,255,.4));animation:cLine 2s ease infinite}
@keyframes cLine{0%{opacity:0;transform:scaleY(0) translateY(-6px)}50%{opacity:1}100%{opacity:0;transform:scaleY(1) translateY(6px)}}

/* ══════════ MARQUEE ══════════ */
.marquee{
    background:linear-gradient(90deg,var(--rose-v),var(--lavande2),var(--rose-p),var(--lavande2),var(--rose-v));
    background-size:300%;animation:mGrad 12s linear infinite;
    padding:11px 0;overflow:hidden;
}
@keyframes mGrad{0%{background-position:0%}100%{background-position:300%}}
.m-piste{display:flex;white-space:nowrap;animation:mAnim 30s linear infinite}
.m-item{
    font-size:9px;letter-spacing:4px;text-transform:uppercase;
    color:rgba(255,255,255,.85);padding:0 40px;font-weight:400;
    display:flex;align-items:center;gap:12px;
}
.m-pt{width:4px;height:4px;background:rgba(255,255,255,.4);border-radius:50%}
@keyframes mAnim{from{transform:translateX(0)}to{transform:translateX(-50%)}}

/* ══════════ AVANTAGES (nouveauté) ══════════ */
.avantages{
    display:grid;grid-template-columns:repeat(4,1fr);
    gap:0;border-top:1px solid var(--peche);border-bottom:1px solid var(--peche);
    background:var(--blanc);
}
.av-item{
    display:flex;align-items:center;gap:14px;padding:22px 30px;
    border-right:1px solid var(--peche);transition:background .3s;
}
.av-item:last-child{border-right:none}
.av-item:hover{background:var(--creme2)}
.av-icone{
    width:42px;height:42px;border-radius:50%;
    background:linear-gradient(135deg,var(--peche),var(--rose-p));
    display:flex;align-items:center;justify-content:center;
    font-size:17px;color:var(--blanc);flex-shrink:0;
}
.av-titre{font-size:12px;font-weight:500;color:var(--texte);margin-bottom:2px}
.av-sous{font-size:11px;color:var(--texte2);line-height:1.5}

/* ══════════ QUI SOMMES-NOUS ══════════ */
.qui{padding:100px 50px;max-width:1360px;margin:0 auto}
.qui-grid{display:grid;grid-template-columns:1fr 1fr;gap:80px;align-items:center}
.qui-imgs{position:relative}
.qi-grande{width:76%;aspect-ratio:4/5;object-fit:cover;display:block;box-shadow:var(--ombre)}
.qi-petite{position:absolute;bottom:-36px;right:0;width:50%;aspect-ratio:1;object-fit:cover;border:7px solid var(--creme);box-shadow:var(--ombre)}
.qi-deco{position:absolute;top:-16px;left:-16px;width:80px;height:80px;border:2px solid var(--rose-p);opacity:.4;z-index:-1}
.qi-coeur{
    position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);
    width:60px;height:60px;background:var(--blanc);border-radius:50%;
    display:flex;align-items:center;justify-content:center;
    font-size:20px;color:var(--rose-v);box-shadow:var(--ombre);
    border:1px solid var(--peche);z-index:2;
}
.qui-txt .s-label{margin-bottom:4px}
.qui-txt .s-titre{margin-bottom:18px}
.qui-p{font-size:14.5px;color:var(--texte2);line-height:2;margin-bottom:14px}
.qui-vals{display:grid;grid-template-columns:1fr 1fr;gap:16px;margin:28px 0 32px}
.val-item{display:flex;gap:11px;align-items:flex-start}
.val-i{width:38px;height:38px;border-radius:50%;background:linear-gradient(135deg,var(--peche),var(--rose-p));display:flex;align-items:center;justify-content:center;font-size:14px;color:var(--blanc);flex-shrink:0}
.val-nom{font-size:12.5px;font-weight:500;color:var(--texte);margin-bottom:2px}
.val-desc{font-size:11.5px;color:var(--texte2);line-height:1.65}

/* ══════════ CATÉGORIES ══════════ */
.cats{background:var(--gris);padding:90px 50px}
.cats-in{max-width:1360px;margin:0 auto}
.ent-c{text-align:center;margin-bottom:54px}
.ent-c .s-sous{max-width:480px;margin:12px auto 0}
.cats-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:18px}
.cat-c{position:relative;overflow:hidden;border-radius:var(--rayon);text-decoration:none;display:block;transition:var(--trans)}
.cat-c:hover{transform:translateY(-6px);box-shadow:var(--ombre)}
.cat-c img{width:100%;aspect-ratio:3/4;object-fit:cover;transition:transform .8s;display:block;filter:brightness(.75)}
.cat-c:hover img{transform:scale(1.07);filter:brightness(.6)}
.cat-overlay{position:absolute;inset:0;background:linear-gradient(0deg,rgba(90,48,64,.85) 0%,rgba(90,48,64,.1) 55%);border-radius:var(--rayon);display:flex;flex-direction:column;justify-content:flex-end;padding:22px}
.cat-nom{font-family:var(--f-titre);font-size:21px;font-weight:300;color:var(--blanc);display:block;margin-bottom:4px}
.cat-nb{font-size:9px;letter-spacing:2px;color:var(--peche);text-transform:uppercase}
.cat-arrow{
    position:absolute;top:50%;left:50%;transform:translate(-50%,-60%) scale(0);
    width:44px;height:44px;background:rgba(255,255,255,.15);
    border:1.5px solid rgba(255,255,255,.5);border-radius:50%;
    display:flex;align-items:center;justify-content:center;
    color:var(--blanc);font-size:15px;backdrop-filter:blur(4px);
    transition:transform .4s;
}
.cat-c:hover .cat-arrow{transform:translate(-50%,-50%) scale(1)}

/* ══════════ PRODUITS ══════════ */
.prods{padding:90px 50px;max-width:1360px;margin:0 auto}
.prods-ent{display:flex;justify-content:space-between;align-items:flex-end;margin-bottom:40px}
.filtres{display:flex;gap:6px;flex-wrap:wrap;margin-bottom:40px}
.f-b{padding:8px 20px;font-size:10px;letter-spacing:2px;text-transform:uppercase;background:transparent;border:1.5px solid var(--peche2);color:var(--texte2);cursor:pointer;border-radius:50px;transition:var(--trans);font-family:var(--f-corps)}
.f-b.on,.f-b:hover{background:var(--rose-v);color:var(--blanc);border-color:var(--rose-v)}
.prods-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:24px}
.p-carte{position:relative}
.p-img{position:relative;overflow:hidden;aspect-ratio:3/4;border-radius:var(--rayon);margin-bottom:14px;background:var(--beige)}
.p-img img{width:100%;height:100%;object-fit:cover;transition:transform .7s;display:block}
.p-carte:hover .p-img img{transform:scale(1.06)}
.p-badge{position:absolute;top:11px;left:11px;font-size:9px;letter-spacing:2px;text-transform:uppercase;padding:5px 12px;border-radius:50px;font-weight:500}
.b-n{background:var(--rose-v);color:var(--blanc)}
.b-p{background:var(--lavande2);color:var(--blanc)}
.p-act{position:absolute;top:11px;right:11px;display:flex;flex-direction:column;gap:7px;opacity:0;transform:translateX(10px);transition:var(--trans)}
.p-carte:hover .p-act{opacity:1;transform:translateX(0)}
.p-btn{width:36px;height:36px;background:var(--blanc);border:none;border-radius:50%;cursor:pointer;display:flex;align-items:center;justify-content:center;font-size:13px;color:var(--texte);box-shadow:var(--ombre-sm);transition:var(--trans)}
.p-btn:hover{background:var(--rose-v);color:var(--blanc)}
.p-cart{
    position:absolute;bottom:0;left:0;right:0;
    background:linear-gradient(0deg,rgba(90,48,64,.9),transparent);
    padding:28px 14px 14px;transform:translateY(100%);transition:transform .4s;
    border-radius:0 0 var(--rayon) var(--rayon);
}
.p-carte:hover .p-cart{transform:translateY(0)}
.p-cart .btn{width:100%;justify-content:center;font-size:10px}
.p-cat{font-size:10px;color:var(--rose-v);letter-spacing:2px;text-transform:uppercase;margin-bottom:3px;display:block}
.p-nom{font-family:var(--f-titre);font-size:18px;font-weight:300;color:var(--texte);text-decoration:none;display:block;margin-bottom:6px;transition:color .3s}
.p-nom:hover{color:var(--rose-v)}
.p-prix-l{display:flex;align-items:center;gap:9px}
.p-prix{font-size:16px;font-weight:400;color:var(--brun-d)}
.p-prix-b{font-size:12px;color:var(--texte2);text-decoration:line-through}

/* ══════════ SECTION NOUVEAUTÉ : INSPIRATION ══════════ */
.inspi{padding:0 50px 90px;max-width:1360px;margin:0 auto}
.inspi-grid{display:grid;grid-template-columns:1fr 1fr 1fr;grid-template-rows:auto auto;gap:16px}
.inspi-card{position:relative;overflow:hidden;border-radius:var(--rayon);display:block;text-decoration:none}
.inspi-card img{width:100%;height:100%;object-fit:cover;display:block;transition:transform .7s;filter:brightness(.7)}
.inspi-card:hover img{transform:scale(1.05);filter:brightness(.55)}
.inspi-card:nth-child(1){grid-row:1/3;aspect-ratio:unset;min-height:480px}
.inspi-card:nth-child(2),.inspi-card:nth-child(3){aspect-ratio:16/9}
.inspi-tag{
    position:absolute;bottom:18px;left:18px;
    background:rgba(255,255,255,.15);backdrop-filter:blur(8px);
    border:1px solid rgba(255,255,255,.3);
    color:var(--blanc);padding:8px 16px;border-radius:50px;
    font-size:10px;letter-spacing:2px;text-transform:uppercase;font-family:var(--f-corps);
    transition:background .3s;
}
.inspi-card:hover .inspi-tag{background:var(--rose-v);border-color:var(--rose-v)}

/* ══════════ SUR MESURE ══════════ */
.mesure{
    padding:90px 50px;
    background:linear-gradient(135deg,var(--beige) 0%,var(--peche) 50%,var(--lavande) 100%);
    position:relative;overflow:hidden;
}
.mesure::before{
    content:'✦';position:absolute;font-size:500px;color:rgba(255,255,255,.18);
    top:50%;left:50%;transform:translate(-50%,-50%);pointer-events:none;font-family:serif;
}
.mesure-in{max-width:1360px;margin:0 auto;display:grid;grid-template-columns:1fr 1fr;gap:80px;align-items:center;position:relative;z-index:1}
.mesure-txt .s-sous{text-align:left;max-width:none;margin:14px 0 26px}
.mesure-liste{list-style:none;display:flex;flex-direction:column;gap:11px;margin-bottom:30px}
.mesure-liste li{display:flex;align-items:center;gap:11px;font-size:13.5px;color:var(--brun-2)}
.mesure-liste li i{color:var(--rose-v);width:15px}

/* Formulaire */
.form-card{
    background:var(--blanc);border-radius:18px;padding:42px 38px;
    box-shadow:var(--ombre);position:relative;overflow:hidden;
}
.form-card::before{content:'';position:absolute;top:0;left:0;width:100%;height:4px;background:linear-gradient(90deg,var(--peche),var(--rose-v),var(--lavande2))}
.fc-titre{font-family:var(--f-titre);font-size:24px;font-weight:300;color:var(--texte);margin-bottom:4px}
.fc-sous{font-size:13px;color:var(--texte2);margin-bottom:24px;line-height:1.7}
.f-row{display:grid;grid-template-columns:1fr 1fr;gap:12px}
.f-g{margin-bottom:14px}
.f-g label{font-size:10px;letter-spacing:1.5px;text-transform:uppercase;color:var(--texte2);display:block;margin-bottom:6px;font-weight:500}
.f-g input,.f-g select,.f-g textarea{
    width:100%;padding:12px 15px;border:1.5px solid var(--peche);border-radius:9px;
    font-family:var(--f-corps);font-size:13.5px;color:var(--texte);outline:none;
    background:var(--creme2);transition:border-color .3s;resize:none;
}
.f-g input:focus,.f-g select:focus,.f-g textarea:focus{border-color:var(--rose-v);background:var(--blanc)}
.f-sub{width:100%;justify-content:center;margin-top:6px;border-radius:50px}

/* ══════════ STATS ══════════ */
.stats{background:var(--brun-d);padding:64px 50px}
.stats-in{max-width:1360px;margin:0 auto;display:grid;grid-template-columns:repeat(4,1fr)}
.stat-it{text-align:center;padding:18px;border-right:1px solid rgba(255,255,255,.07)}
.stat-it:last-child{border-right:none}
.stat-n{font-family:var(--f-titre);font-size:clamp(36px,4vw,56px);font-weight:300;color:var(--peche2);font-style:italic;display:block;line-height:1;margin-bottom:9px}
.stat-l{font-size:9px;letter-spacing:3px;text-transform:uppercase;color:rgba(255,255,255,.3)}

/* ══════════ TÉMOIGNAGES ══════════ */
.temos{padding:90px 50px;background:var(--gris)}
.temos-in{max-width:1360px;margin:0 auto}
.temos-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;margin-top:52px}
.t-carte{background:var(--blanc);border-radius:var(--rayon);padding:32px 28px;box-shadow:var(--ombre-sm);position:relative;overflow:hidden;transition:var(--trans)}
.t-carte::after{content:'';position:absolute;bottom:0;left:0;width:0;height:3px;background:linear-gradient(90deg,var(--peche),var(--rose-v),var(--lavande2));transition:width .5s}
.t-carte:hover::after{width:100%}
.t-carte:hover{transform:translateY(-5px);box-shadow:var(--ombre)}
.t-etoiles{color:var(--rose-p);font-size:13px;margin-bottom:12px;letter-spacing:2px}
.t-txt{font-size:14px;line-height:1.9;color:var(--texte2);margin-bottom:20px;font-style:italic}
.t-aut{display:flex;align-items:center;gap:11px}
.t-av{width:42px;height:42px;border-radius:50%;overflow:hidden;border:2px solid var(--peche2)}
.t-av img{width:100%;height:100%;object-fit:cover}
.t-nom{font-size:12px;font-weight:500;color:var(--texte)}
.t-lieu{font-size:11px;color:var(--texte2);margin-top:1px}

/* ══════════ BLOG MINIATURE ══════════ */
.blog-mini{padding:90px 50px;max-width:1360px;margin:0 auto}
.blog-grid{display:grid;grid-template-columns:1.7fr 1fr 1fr;gap:22px;margin-top:54px}
.bl-carte{border-radius:var(--rayon);overflow:hidden;background:var(--blanc);box-shadow:var(--ombre-sm);transition:var(--trans);text-decoration:none;display:block}
.bl-carte:hover{transform:translateY(-5px);box-shadow:var(--ombre)}
.bl-img{overflow:hidden;aspect-ratio:16/9}
.bl-carte:first-child .bl-img{aspect-ratio:4/3}
.bl-img img{width:100%;height:100%;object-fit:cover;transition:transform .7s;display:block}
.bl-carte:hover .bl-img img{transform:scale(1.05)}
.bl-body{padding:20px}
.bl-cat{font-size:9px;letter-spacing:2px;text-transform:uppercase;color:var(--rose-v);margin-bottom:7px;display:block}
.bl-titre{font-family:var(--f-titre);font-size:18px;font-weight:300;color:var(--texte);margin-bottom:8px;line-height:1.4}
.bl-carte:first-child .bl-titre{font-size:22px}
.bl-extrait{font-size:12.5px;color:var(--texte2);line-height:1.8}

/* ══════════ NEWSLETTER ══════════ */
.nwsl{padding:88px 50px;text-align:center;position:relative;overflow:hidden}
.nwsl::before{content:'♡';position:absolute;font-size:440px;color:var(--peche);opacity:.35;top:50%;left:50%;transform:translate(-50%,-50%);pointer-events:none;font-family:serif}
.nwsl-in{max-width:520px;margin:0 auto;position:relative;z-index:1}
.nwsl-in .s-sous{margin:12px auto 32px}
.nwsl-form{display:flex;border-radius:50px;overflow:hidden;box-shadow:0 6px 28px rgba(201,112,128,.2)}
.nwsl-form input{flex:1;padding:15px 22px;border:1.5px solid var(--peche);border-right:none;border-radius:50px 0 0 50px;background:var(--blanc);font-family:var(--f-corps);font-size:13.5px;color:var(--texte);outline:none;transition:border-color .3s}
.nwsl-form input:focus{border-color:var(--rose-v)}
.nwsl-form .btn{border-radius:0 50px 50px 0;white-space:nowrap}

/* ══════════ RESPONSIVE ══════════ */
@media(max-width:1100px){
    .prods-grid{grid-template-columns:repeat(3,1fr)}
    .cats-grid{grid-template-columns:repeat(2,1fr)}
    .avantages{grid-template-columns:repeat(2,1fr)}
    .blog-grid{grid-template-columns:1fr 1fr}
    .inspi-grid{grid-template-columns:1fr 1fr}
    .inspi-card:nth-child(1){grid-row:auto}
}
@media(max-width:900px){
    .qui-grid{grid-template-columns:1fr}
    .qui-imgs{display:none}
    .mesure-in{grid-template-columns:1fr}
    .stats-in{grid-template-columns:repeat(2,1fr)}
    .temos-grid{grid-template-columns:1fr}
    .qui,.cats,.prods,.mesure,.temos,.blog-mini,.nwsl,.inspi{padding-left:24px;padding-right:24px}
    .stats{padding-left:24px;padding-right:24px}
    .prods-ent{flex-direction:column;align-items:flex-start;gap:16px}
}
@media(max-width:600px){
    .prods-grid{grid-template-columns:1fr 1fr;gap:14px}
    .cats-grid{grid-template-columns:1fr 1fr}
    .avantages{grid-template-columns:1fr}
    .av-item{border-right:none;border-bottom:1px solid var(--peche)}
    .nwsl-form{flex-direction:column;border-radius:12px}
    .nwsl-form input{border-right:1.5px solid var(--peche);border-bottom:none;border-radius:12px 12px 0 0}
    .nwsl-form .btn{border-radius:0 0 12px 12px}
    .blog-grid,.inspi-grid{grid-template-columns:1fr}
    .f-row{grid-template-columns:1fr}
}
</style>
@endpush

@section('content')

{{-- ══════ CAROUSEL ══════ --}}
<section class="carousel">
    <div class="car-piste" id="car-piste">

        <div class="car-slide on">
            <img src="{{ asset('assets/images/slider lt.png') }}" alt="Collection">
            <div class="car-txt">
                <div class="car-deco">Nouvelle Collection</div>
                <span class="car-script">L'art du fil précieux</span>
                <h1 class="car-titre">Création<br>Artisanale</h1>
                <p class="car-phrase">Des laines d'exception, sélectionnées avec passion pour des créations qui vous ressemblent.</p>
                <div class="car-btns">
                    <a href="{{ route('shop.index') }}" class="btn btn-rose">Découvrir la boutique</a>
                    <a href="{{ route('pages.atelier') }}" class="btn btn-outline">Voir l'atelier</a>
                </div>
            </div>
        </div>

        <div class="car-slide">
            <img src="{{ asset('assets/images/slider 2.jpg') }}" alt="Kits">
            <div class="car-txt">
                <div class="car-deco">Kits Signature</div>
                <span class="car-script">Créer avec amour</span>
                <h1 class="car-titre">Kits<br>Exclusifs</h1>
                <p class="car-phrase">Tout ce dont vous avez besoin pour réaliser des pièces uniques, du premier point au dernier.</p>
                <div class="car-btns">
                    <a href="{{ route('shop.index') }}" class="btn btn-rose">Voir les kits</a>
                </div>
            </div>
        </div>

        <div class="car-slide">
            <img src="{{ asset('assets/images/slider 1.avif') }}" alt="Sur mesure">
            <div class="car-txt">
                <div class="car-deco">Exclusif JEKP</div>
                <span class="car-script">Votre vision, notre savoir-faire</span>
                <h1 class="car-titre">Création<br>Sur Mesure</h1>
                <p class="car-phrase">Confiez-nous votre idée, nous la transformons en une création unique et personnalisée.</p>
                <div class="car-btns">
                    <a href="#sur-mesure" class="btn btn-rose">Commander sur mesure</a>
                </div>
            </div>
        </div>
    </div>
    <button class="car-fl prev" id="prev"><i class="fas fa-chevron-left"></i></button>
    <button class="car-fl next" id="next"><i class="fas fa-chevron-right"></i></button>
    <div class="car-dots">
        <button class="car-dot on" data-i="0"></button>
        <button class="car-dot" data-i="1"></button>
        <button class="car-dot" data-i="2"></button>
    </div>
    <div class="car-scroll"><div class="car-line"></div><span>Scroll</span></div>
</section>

{{-- MARQUEE --}}
<div class="marquee">
    <div class="m-piste">
        @foreach(range(1,2) as $_)
        <span class="m-item">Laines Mérinos <span class="m-pt"></span></span>
        <span class="m-item">Créations Artisanales <span class="m-pt"></span></span>
        <span class="m-item">Kits Signature <span class="m-pt"></span></span>
        <span class="m-item">Sur Mesure <span class="m-pt"></span></span>
        <span class="m-item">Livraison Express <span class="m-pt"></span></span>
        <span class="m-item">Fils d'Exception <span class="m-pt"></span></span>
        <span class="m-item">Fait avec Amour <span class="m-pt"></span></span>
        <span class="m-item">100% Artisanal <span class="m-pt"></span></span>
        @endforeach
    </div>
</div>

{{-- AVANTAGES --}}
<div class="avantages">
    <div class="av-item rev">
        <div class="av-icone"><i class="fas fa-truck"></i></div>
        <div><div class="av-titre">Livraison offerte</div><div class="av-sous">Dès 60€ d'achat, partout</div></div>
    </div>
    <div class="av-item rev d1">
        <div class="av-icone"><i class="fas fa-undo"></i></div>
        <div><div class="av-titre">Retours 14 jours</div><div class="av-sous">Satisfaite ou remboursée</div></div>
    </div>
    <div class="av-item rev d2">
        <div class="av-icone"><i class="fas fa-lock"></i></div>
        <div><div class="av-titre">Paiement sécurisé</div><div class="av-sous">Vos données protégées</div></div>
    </div>
    <div class="av-item rev d3">
        <div class="av-icone"><i class="fas fa-headset"></i></div>
        <div><div class="av-titre">Support WhatsApp</div><div class="av-sous">Réponse sous 24h</div></div>
    </div>
</div>

{{-- ══════ QUI SOMMES-NOUS ══════ --}}
<section class="qui">
    <div class="qui-grid">
        <div class="qui-imgs rev">
            <div class="qi-deco"></div>
            <img src="{{ asset('assets/images/jepk4.jpg') }}" alt="Atelier" class="qi-grande">
            <img src="{{ asset('assets/images/jepk17.jpg') }}" alt="Détail" class="qi-petite">
            <div class="qi-coeur"><i class="fas fa-heart"></i></div>
        </div>
        <div class="qui-txt">
            <span class="s-label rev">Notre histoire</span>
            <h2 class="s-titre rev d1">Qui sommes-<em>nous</em> ?</h2>
            <p class="qui-p rev d2">JEKP Store est né d'une passion profonde pour l'art du tricot et la création textile. Nous sommes une maison artisanale qui sélectionne avec soin des fils d'exception et crée des kits pensés pour toutes les niveaux.</p>
            <p class="qui-p rev d2">Notre mission : vous offrir le meilleur de la création artisanale, avec des matières nobles et des designs qui traversent les tendances.</p>
            <div class="qui-vals rev d3">
                <div class="val-item"><div class="val-i"><i class="fas fa-heart"></i></div><div><div class="val-nom">Fait avec passion</div><div class="val-desc">Chaque création porte notre amour du métier</div></div></div>
                <div class="val-item"><div class="val-i"><i class="fas fa-leaf"></i></div><div><div class="val-nom">Matières naturelles</div><div class="val-desc">Fils naturels et éco-responsables</div></div></div>
                <div class="val-item"><div class="val-i"><i class="fas fa-star"></i></div><div><div class="val-nom">Qualité premium</div><div class="val-desc">Des produits durables et beaux</div></div></div>
                <div class="val-item"><div class="val-i"><i class="fas fa-hands"></i></div><div><div class="val-nom">Sur mesure</div><div class="val-desc">Créations selon vos envies</div></div></div>
            </div>
            <a href="#" class="btn btn-outline-rose rev d4">En savoir plus</a>
        </div>
    </div>
</section>

{{-- ══════ CATÉGORIES ══════ --}}
<section class="cats">
    <div class="cats-in">
        <div class="ent-c rev">
            <span class="s-label">Explorez</span>
            <h2 class="s-titre">Nos <em>Collections</em></h2>
            <p class="s-sous">Créations artisanales pour la maison, la mode adulte, l'univers enfant et tous vos accessoires du quotidien.</p>
        </div>
        <div class="cats-grid">
            @php
            $dc = [
                [
                    'nom'  => 'Maison',
                    'desc' => 'Coussins · Nappes · Plaids · Déco',
                    'nb'   => 'Coussins, Nappes, Plaids…',
                    'slug' => 'maison',
                    'img'  => 'assets/images/jepk42.jpg',
                ],
                [
                    'nom'  => 'Adulte',
                    'desc' => 'Pulls · Écharpes · Bonnets · Mode',
                    'nb'   => 'Pulls, Écharpes, Bonnets…',
                    'slug' => 'adulte',
                    'img'  => 'assets/images/jepk3.jpg',
                ],
                [
                    'nom'  => 'Enfant',
                    'desc' => 'Layettes · Doudous · Vêtements',
                    'nb'   => 'Layettes, Doudous, Jouets…',
                    'slug' => 'enfant',
                    'img'  => 'assets/images/jepk10.jpg',
                ],
                [
                    'nom'  => 'Accessoires',
                    'desc' => 'Sacs · Pochettes · Bijoux · Cadeaux',
                    'nb'   => 'Sacs, Pochettes, Bijoux…',
                    'slug' => 'accessoires',
                    'img'  => 'assets/images/jepk25.jpg',
                ],
            ];
            @endphp

            @foreach(isset($categories) && count($categories) ? $categories : $dc as $i => $c)
            @php
                $nom  = $c['nom']  ?? $c->name;
                $desc = $c['desc'] ?? ($c->description ?? '');
                $slug = $c['slug'] ?? $c->slug;
                $img  = $c['img']  ?? $c->image;
            @endphp
            <a href="{{ route('categories.show', $slug) }}" class="cat-c rev d{{ $i+1 }}">
                <img src="{{ asset($img) }}" alt="{{ $nom }}">
                <div class="cat-overlay">
                    <div class="cat-arrow"><i class="fas fa-arrow-right"></i></div>
                    <span class="cat-nom">{{ $nom }}</span>
                    <span class="cat-nb">{{ $desc }}</span>
                </div>
            </a>
            @endforeach

        </div>

        {{-- Bouton voir toutes les collections --}}
        <div style="text-align:center;margin-top:40px">
            <a href="{{ route('categories.index') }}" class="btn btn-outline-rose">
                <i class="fas fa-th-large"></i> Voir toutes les collections
            </a>
        </div>

    </div>
</section>

{{-- ══════ PRODUITS VEDETTES ══════ --}}
<section class="prods">
    <div class="prods-ent rev">
        <div>
            <span class="s-label">Sélection</span>
            <h2 class="s-titre">Nos <em>Coups de Cœur</em></h2>
        </div>
        <a href="{{ route('shop.index') }}" class="btn btn-outline-rose">Voir tout →</a>
    </div>
    <div class="filtres">
        <button class="f-b on">Tout</button>
        <button class="f-b">Nouveautés</button>
        <button class="f-b">Fils & Laines</button>
        <button class="f-b">Kits</button>
        <button class="f-b">Promotions</button>
    </div>
    <div class="prods-grid">
        @php
        $dp=[['nom'=>'Belle robe laine verte','cat'=>'Fils Rares','prix'=>'37500','anc'=>null,'badge'=>'n','img'=>'assets/images/jepk5.jpg'],
        ['nom'=>'Chemise pour homme élegant','cat'=>'Kits Signature','prix'=>'17300','anc'=>'25500','badge'=>'p','img'=>'assets/images/jepk4.jpg'],
        ['nom'=>'Aiguilles Bambou Premium','cat'=>'Accessoires','prix'=>'18,50','anc'=>null,'badge'=>null,'img'=>'assets/images/jepk25.jpg'],
        ['nom'=>'Alpaga des Andes','cat'=>'Fils Rares','prix'=>'28,50','anc'=>null,'badge'=>'n','img'=>'assets/images/jepk12.jpg'],
        ['nom'=>'Kit Écharpe Hiver','cat'=>'Kits Signature','prix'=>'42,00','anc'=>null,'badge'=>null,'img'=>'assets/images/jepk2.jpg'],
        ['nom'=>'Mohair & Soie','cat'=>'Fils Rares','prix'=>'32,00','anc'=>'40,00','badge'=>'p','img'=>'assets/images/jepk1.jpg'],
        ['nom'=>'Trousse Range-Aiguilles','cat'=>'Accessoires','prix'=>'24,00','anc'=>null,'badge'=>'n','img'=>'assets/images/jepk3.jpg'],
        ['nom'=>'Kit Bonnet Débutant','cat'=>'Kits Signature','prix'=>'29,00','anc'=>null,'badge'=>null,'img'=>'assets/images/jepk6.jpg']];
        @endphp
        @foreach(isset($featured) && count($featured) ? $featured : $dp as $i=>$p)
        <div class="p-carte rev d{{ ($i%4)+1 }}">
            <div class="p-img">
                <img src="{{ asset($p['img'] ?? $p->image) }}" alt="{{ $p['nom'] ?? $p->name }}">
                @if(($p['badge'] ?? null)==='n') <span class="p-badge b-n">Nouveau</span>
                @elseif(($p['badge'] ?? null)==='p') <span class="p-badge b-p">Promo</span>@endif
                <div class="p-act">
                    <button class="p-btn"><i class="far fa-heart"></i></button>
                    <button class="p-btn"><i class="far fa-eye"></i></button>
                </div>
                <div class="p-cart"><a href="{{ route('shop.index') }}" class="btn btn-blanc">Ajouter au panier</a></div>
            </div>
            <span class="p-cat">{{ $p['cat'] ?? ($p->category->name ?? '') }}</span>
            <a href="{{ route('shop.index') }}" class="p-nom">{{ $p['nom'] ?? $p->name }}</a>
            <div class="p-prix-l">
                <span class="p-prix">{{ $p['prix'] ?? number_format($p->price,2,',',' ') }} CFA</span>
                @if($p['anc'] ?? false)<span class="p-prix-b">{{ $p['anc'] }} CFA</span>@endif
            </div>
        </div>
        @endforeach
    </div>
</section>

{{-- ══════ INSPIRATION GRILLE ══════ --}}
<section class="inspi">
    <div class="ent-c rev" style="text-align:center;margin-bottom:42px">
        <span class="s-label">Inspirations</span>
        <h2 class="s-titre">Notre <em>Univers</em></h2>
    </div>
    <div class="inspi-grid">
        <a href="#" class="inspi-card rev"><img src="{{ asset('assets/images/jepk32.jpg') }}" alt=""><span class="inspi-tag">Collection Automne</span></a>
        <a href="#" class="inspi-card rev d1"><img src="{{ asset('assets/images/jepk40.jpg') }}" alt=""><span class="inspi-tag">Kits & Tutoriels</span></a>
        <a href="#" class="inspi-card rev d2"><img src="{{ asset('assets/images/jepk28.jpg') }}" alt=""><span class="inspi-tag">Accessoires</span></a>
        <a href="#" class="inspi-card rev"><img src="{{ asset('assets/images/jepk37.jpg') }}" alt=""><span class="inspi-tag">Collection Automne</span></a>
        <a href="#" class="inspi-card rev d1"><img src="{{ asset('assets/images/jepk27.jpg') }}" alt=""><span class="inspi-tag">Kits & Tutoriels</span></a>
    </div>
</section>

{{-- ══════ SUR MESURE ══════ --}}
<section class="mesure" id="sur-mesure">
    <div class="mesure-in">
        <div class="mesure-txt rev">
            <span class="s-label">Exclusif JEKP</span>
            <h2 class="s-titre">Création<br><em>Sur Mesure</em></h2>
            <p class="s-sous">Vous avez une idée en tête ? Décrivez-nous votre projet et nous l'transformons en une création unique, pensée rien que pour vous.</p>
            <ul class="mesure-liste">
                <li><i class="fas fa-check-circle"></i> Consultation personnalisée incluse</li>
                <li><i class="fas fa-check-circle"></i> Choix libre des matières et coloris</li>
                <li><i class="fas fa-check-circle"></i> Délai estimé communiqué à l'avance</li>
                <li><i class="fas fa-check-circle"></i> Suivi par WhatsApp à chaque étape</li>
                <li><i class="fas fa-check-circle"></i> Satisfaction garantie ou remboursée</li>
            </ul>
            <a href="https://wa.me/0153928572" target="0153928572" class="btn btn-rose">
                <i class="fab fa-whatsapp"></i> Discuter sur WhatsApp
            </a>
        </div>
        <div class="form-card rev d2">
            <h3 class="fc-titre">Décrivez votre projet</h3>
            <p class="fc-sous">Remplissez ce formulaire — nous vous recontactons sous 24h.</p>
            <form action="{{ route('home') }}" method="POST">
                @csrf
                <input type="hidden" name="type" value="sur_mesure">
                <div class="f-row">
                    <div class="f-g">
                        <label>Type de création</label>
                        <select name="type_creation">
                            <option value="">Choisir…</option>
                            <option>Pull / Gilet</option>
                            <option>Écharpe / Châle</option>
                            <option>Bonnet / Chapeau</option>
                            <option>Chaussettes</option>
                            <option>Accessoires bébé</option>
                            <option>Autre</option>
                        </select>
                    </div>
                    <div class="f-g">
                        <label>Votre taille</label>
                        <select name="taille">
                            <option value="">Choisir…</option>
                            <option>XS</option><option>S</option><option>M</option>
                            <option>L</option><option>XL</option><option>Sur mesures</option>
                        </select>
                    </div>
                </div>
                <div class="f-g">
                    <label>Coloris souhaités</label>
                    <input type="text" name="coloris" placeholder="Ex : tons naturels, bordeaux, lavande…">
                </div>
                <div class="f-g">
                    <label>Décrivez votre projet</label>
                    <textarea name="description" rows="4" placeholder="Votre idée, votre style, vos inspirations… Soyez aussi précise que vous le souhaitez !"></textarea>
                </div>
                <div class="f-row">
                    <div class="f-g">
                        <label>Budget approximatif</label>
                        <select name="budget">
                            <option value="">Choisir…</option>
                            <option>Moins de 50€</option>
                            <option>50€ – 100€</option>
                            <option>100€ – 200€</option>
                            <option>Plus de 200€</option>
                            <option>À définir ensemble</option>
                        </select>
                    </div>
                    <div class="f-g">
                        <label>Délai souhaité</label>
                        <select name="delai">
                            <option value="">Choisir…</option>
                            <option>Moins de 2 semaines</option>
                            <option>2 à 4 semaines</option>
                            <option>Plus d'un mois</option>
                            <option>Pas de contrainte</option>
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-rose f-sub">
                    <i class="fas fa-paper-plane"></i> Envoyer ma demande
                </button>
            </form>
        </div>
    </div>
</section>

{{-- STATS --}}
<div class="stats">
    <div class="stats-in">
        <div class="stat-it rev"><span class="stat-n">5 200+</span><span class="stat-l">Clientes satisfaites</span></div>
        <div class="stat-it rev d1"><span class="stat-n">320+</span><span class="stat-l">Références exclusives</span></div>
        <div class="stat-it rev d2"><span class="stat-n">98%</span><span class="stat-l">Avis positifs</span></div>
        <div class="stat-it rev d3"><span class="stat-n">24h</span><span class="stat-l">Délai de réponse</span></div>
    </div>
</div>

{{-- ══════ TÉMOIGNAGES ══════ --}}
<section class="temos">
    <div class="temos-in">
        <div class="ent-c rev">
            <span class="s-label">Elles nous font confiance</span>
            <h2 class="s-titre">Ce qu'elles <em>disent de nous</em></h2>
        </div>
        <div class="temos-grid">
            @foreach([['★★★★★','La qualité des laines est absolument exceptionnelle. Le mérinos extra-fin est d\'une douceur incomparable et les coloris sont magnifiques. Je suis cliente à vie !','Marie L.','Paris · Tricoteuse','47'],['★★★★★','J\'ai commandé une création sur mesure pour ma mère. Le résultat a dépassé toutes mes espérances ! L\'équipe est à l\'écoute et très professionnelle.','Nathalie B.','Lyon · Créatrice','32'],['★★★★★','Service client au top, livraison ultra rapide et les produits sont encore plus beaux en vrai. JEKP c\'est une boutique à part entière. Je recommande !','Sophie M.','Bordeaux · Artiste','56']] as $i=>$t)
            <div class="t-carte rev d{{ $i+1 }}">
                <div class="t-etoiles">{{ $t[0] }}</div>
                <p class="t-txt">{{ $t[1] }}</p>
                <div class="t-aut">
                    <div class="t-av"><img src="https://i.pravatar.cc/100?img={{ $t[4] }}" alt="{{ $t[2] }}"></div>
                    <div><div class="t-nom">{{ $t[2] }}</div><div class="t-lieu">{{ $t[3] }}</div></div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ══════ BLOG ══════ --}}
<section class="blog-mini">
    <div class="ent-c rev" style="text-align:left;margin-bottom:0">
        <span class="s-label">Le blog</span>
        <h2 class="s-titre">Inspirations & <em>Conseils</em></h2>
    </div>
    <div class="blog-grid" style="margin-top:44px">
        @foreach([['Tutoriels','Comment réussir son premier pull : guide complet pour débutantes','Découvrez toutes les étapes, les astuces et les erreurs à éviter pour tricoter votre premier pull avec succès.','assets/images/jepk39.jpg'],
            ['Tendances','Les couleurs de la saison : tons doux et naturels à la une','Pantone a parlé : cette saison mise sur les tons pêche, lavande et crème. Voici comment les intégrer à vos créations.','assets/images/jepk29.jpg'],
            ['Matières','Mérinos, alpaga, mohair : comment choisir son fil ?','Un guide complet pour comprendre les différentes fibres naturelles et choisir celle qui convient à votre projet.','assets/images/jepk44.jpg']] as $i=>$b)
        <a href="{{ route('pages.blog') }}" class="bl-carte rev d{{ $i }}">
            <div class="bl-img"><img src="{{ $b[3] }}" alt="{{ $b[1] }}"></div>
            <div class="bl-body">
                <span class="bl-cat">{{ $b[0] }}</span>
                <div class="bl-titre">{{ $b[1] }}</div>
                @if($i===0)<p class="bl-extrait">{{ $b[2] }}</p>@endif
            </div>
        </a>
        @endforeach
    </div>
</section>

{{-- ══════ NEWSLETTER ══════ --}}
<section class="nwsl">
    <div class="nwsl-in rev">
        <span class="s-label">Restez connectée</span>
        <h2 class="s-titre">La newsletter des <em>créatrices</em></h2>
        <p class="s-sous">Avant-premières, tutoriels exclusifs, offres réservées. Rejoignez plus de 5 000 passionnées.</p>
        <form class="nwsl-form" action="{{ route('newsletter.subscribe') }}" method="POST">
            @csrf
            <input type="email" name="email" placeholder="Votre adresse email" required>
            <button type="submit" class="btn btn-rose">S'inscrire ✦</button>
        </form>
    </div>
</section>

@endsection
@push('scripts')
<script>
// Carousel
const piste=document.getElementById('car-piste'),slides=[...document.querySelectorAll('.car-slide')],dots=[...document.querySelectorAll('.car-dot')];
let cur=0,timer;
function aller(n){slides[cur].classList.remove('on');dots[cur].classList.remove('on');cur=(n+slides.length)%slides.length;slides[cur].classList.add('on');dots[cur].classList.add('on');piste.style.transform=`translateX(-${cur*100}%)`}
function auto(){timer=setInterval(()=>aller(cur+1),6000)}
document.getElementById('next').onclick=()=>{clearInterval(timer);aller(cur+1);auto()};
document.getElementById('prev').onclick=()=>{clearInterval(timer);aller(cur-1);auto()};
dots.forEach(d=>d.addEventListener('click',()=>{clearInterval(timer);aller(+d.dataset.i);auto()}));
let sx=0;
piste.addEventListener('touchstart',e=>sx=e.touches[0].clientX,{passive:true});
piste.addEventListener('touchend',e=>{const dx=e.changedTouches[0].clientX-sx;if(Math.abs(dx)>50){clearInterval(timer);aller(cur+(dx<0?1:-1));auto()}});
auto();
// Filtres
document.querySelectorAll('.f-b').forEach(b=>b.addEventListener('click',()=>{document.querySelectorAll('.f-b').forEach(x=>x.classList.remove('on'));b.classList.add('on')}));
// Scroll reveal
const obs=new IntersectionObserver(es=>es.forEach(e=>{if(e.isIntersecting){e.target.classList.add('on');obs.unobserve(e.target)}}),{threshold:.1});
document.querySelectorAll('.rev').forEach(el=>obs.observe(el));
</script>
@endpush