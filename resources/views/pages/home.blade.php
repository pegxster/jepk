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
.cats-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:24px}
.cat-c{position:relative;overflow:hidden;border-radius:var(--rayon);text-decoration:none;display:block;transition:var(--trans);height:400px}
.cat-c:hover{transform:translateY(-5px);box-shadow:0 20px 60px rgba(90,48,64,.22)}
.cat-c img{width:100%;height:100%;object-fit:cover;transition:transform .8s;display:block;filter:brightness(.68)}
.cat-c:hover img{transform:scale(1.06);filter:brightness(.55)}
.cat-overlay{position:absolute;inset:0;background:linear-gradient(to top,rgba(61,18,32,.82) 0%,rgba(61,18,32,.2) 45%,transparent 70%);border-radius:var(--rayon);display:flex;flex-direction:column;justify-content:flex-end;padding:34px;transition:background .4s}
.cat-c:hover .cat-overlay{background:linear-gradient(to top,rgba(61,18,32,.9) 0%,rgba(61,18,32,.3) 50%,transparent 70%)}
.cat-label-s{font-size:10px;letter-spacing:3px;text-transform:uppercase;color:var(--rose-p);margin-bottom:8px;font-weight:500;display:block}
.cat-nom{font-family:var(--f-titre);font-size:34px;font-weight:300;color:var(--blanc);display:block;margin-bottom:8px;line-height:1.1}
.cat-nb{font-size:13px;color:rgba(255,255,255,.6);line-height:1.6;margin-bottom:20px;display:block}
.cat-btn-s{display:inline-flex;align-items:center;gap:10px;font-size:11px;letter-spacing:2px;text-transform:uppercase;color:#fff;border:1.5px solid rgba(255,255,255,.35);padding:10px 22px;border-radius:50px;transition:all .3s;width:fit-content}
.cat-c:hover .cat-btn-s{background:var(--rose-v);border-color:var(--rose-v)}
.cat-btn-s i{font-size:10px;transition:transform .3s}
.cat-c:hover .cat-btn-s i{transform:translateX(4px)}

/* ══════════ COUPS DE CŒUR — statique ══════════ */
.prods{padding:90px 50px;max-width:1360px;margin:0 auto}
.prods-ent{display:flex;justify-content:center;align-items:flex-end;margin-bottom:48px;text-align:center}
.prods-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:24px}
.p-carte{position:relative}
.p-img{position:relative;overflow:hidden;aspect-ratio:3/4;border-radius:var(--rayon);margin-bottom:14px;background:var(--beige)}
.p-img img{width:100%;height:100%;object-fit:cover;transition:transform .7s;display:block}
.p-carte:hover .p-img img{transform:scale(1.04)}
.p-badge{position:absolute;top:11px;left:11px;font-size:9px;letter-spacing:2px;text-transform:uppercase;padding:5px 12px;border-radius:50px;font-weight:500}
.b-n{background:var(--rose-v);color:var(--blanc)}
.b-p{background:var(--lavande2);color:var(--blanc)}
.p-cat{font-size:10px;color:var(--rose-v);letter-spacing:2px;text-transform:uppercase;margin-bottom:3px;display:block}
.p-nom{font-family:var(--f-titre);font-size:18px;font-weight:300;color:var(--texte);display:block;margin-bottom:6px}
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
/* ── Upload photo ── */
.f-upload-zone{
    border:2px dashed var(--peche2);border-radius:12px;padding:22px 16px;
    text-align:center;cursor:pointer;transition:border-color .3s,background .3s;
    background:var(--creme2);position:relative;
}
.f-upload-zone:hover,.f-upload-zone.dragover{border-color:var(--rose-v);background:#fdf0f3}
.f-upload-zone input[type=file]{position:absolute;inset:0;opacity:0;cursor:pointer;width:100%;height:100%}
.f-upload-icon{font-size:26px;color:var(--rose-v);margin-bottom:8px;display:block}
.f-upload-label{font-size:12px;color:var(--texte2);line-height:1.7}
.f-upload-label strong{color:var(--rose-v)}
.f-upload-label small{display:block;font-size:10px;color:var(--texte2);margin-top:3px;letter-spacing:.5px}
.f-upload-preview{
    display:none;margin-top:14px;position:relative;
    border-radius:10px;overflow:hidden;box-shadow:0 4px 16px rgba(0,0,0,.12);
}
.f-upload-preview img{width:100%;height:160px;object-fit:cover;display:block}
.f-upload-preview-del{
    position:absolute;top:8px;right:8px;width:28px;height:28px;
    background:rgba(61,32,48,.75);color:#fff;border:none;border-radius:50%;
    cursor:pointer;font-size:13px;display:flex;align-items:center;justify-content:center;
    transition:background .3s;
}
.f-upload-preview-del:hover{background:var(--rose-v)}

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
    .carousel{min-height:500px}
    .car-titre{font-size:clamp(28px,6vw,50px)}
    .car-script{font-size:clamp(24px,4vw,40px)}
    .car-btns{flex-direction:column;align-items:center}
    .car-fl{width:38px;height:38px;font-size:11px}
    .car-fl.prev{left:12px}.car-fl.next{right:12px}
    .av-item{padding:16px 20px}
    .av-icone{width:36px;height:36px;font-size:15px}
    .av-titre{font-size:11px}
    .av-sous{font-size:10px}
    .cat-c{height:320px}
    .cat-nom{font-size:28px}
    .mesure{padding:60px 20px}
    .form-card{padding:28px 22px}
    .blog-grid{grid-template-columns:1fr}
}
@media(max-width:600px){
    .prods-grid{grid-template-columns:1fr 1fr;gap:14px}
    .cats-grid{grid-template-columns:1fr}
    .cat-c{height:260px}
    .avantages{grid-template-columns:1fr}
    .av-item{border-right:none;border-bottom:1px solid var(--peche)}
    .nwsl-form{flex-direction:column;border-radius:12px}
    .nwsl-form input{border-right:1.5px solid var(--peche);border-bottom:none;border-radius:12px 12px 0 0}
    .nwsl-form .btn{border-radius:0 0 12px 12px}
    .blog-grid,.inspi-grid{grid-template-columns:1fr}
    .f-row{grid-template-columns:1fr}
    .carousel{min-height:420px}
    .stats-in{grid-template-columns:1fr 1fr}
    .stat-n{font-size:clamp(28px,4vw,40px)}
    .prods{padding:60px 16px}
    .cats{padding:60px 16px}
    .nwsl{padding:60px 16px}
    .blog-mini{padding:60px 16px}
    .inspi{padding:0 16px 60px}
}
</style>
@endpush

@section('content')

{{-- ══════ CAROUSEL ══════ --}}
@php
$staticSlides = [
    [
        'image'    => asset('assets/images/slider lt.png'),
        'badge'    => 'Nouvelle Collection',
        'script'   => "L'art du fil précieux",
        'title'    => "Création\nArtisanale",
        'phrase'   => 'Des laines d\'exception, sélectionnées avec passion pour des créations qui vous ressemblent.',
        'btn1_text'=> 'Découvrir la boutique',
        'btn1_url' => route('shop.index'),
        'btn2_text'=> "Voir l'atelier",
        'btn2_url' => route('pages.atelier'),
    ],
    [
        'image'    => asset('assets/images/slider 2.jpg'),
        'badge'    => 'Kits Signature',
        'script'   => 'Créer avec amour',
        'title'    => "Kits\nExclusifs",
        'phrase'   => 'Tout ce dont vous avez besoin pour réaliser des pièces uniques, du premier point au dernier.',
        'btn1_text'=> 'Voir les kits',
        'btn1_url' => route('shop.index'),
        'btn2_text'=> null,
        'btn2_url' => null,
    ],
    [
        'image'    => asset('assets/images/slider 1.avif'),
        'badge'    => 'Exclusif JEPK',
        'script'   => 'Votre vision, notre savoir-faire',
        'title'    => "Création\nSur Mesure",
        'phrase'   => 'Confiez-nous votre idée, nous la transformons en une création unique et personnalisée.',
        'btn1_text'=> 'Commander sur mesure',
        'btn1_url' => '#sur-mesure',
        'btn2_text'=> null,
        'btn2_url' => null,
    ],
];

$carouselSlides = isset($slides) && count($slides)
    ? $slides->map(fn($s) => [
        'image'    => product_image_url($s->image),
        'badge'    => $s->badge,
        'script'   => $s->script,
        'title'    => $s->title,
        'phrase'   => $s->phrase,
        'btn1_text'=> $s->btn1_text,
        'btn1_url' => $s->btn1_url,
        'btn2_text'=> $s->btn2_text,
        'btn2_url' => $s->btn2_url,
    ])->toArray()
    : $staticSlides;
@endphp

<section class="carousel">
    <div class="car-piste" id="car-piste">
        @foreach($carouselSlides as $i => $s)
        <div class="car-slide {{ $i === 0 ? 'on' : '' }}">
            <img src="{{ $s['image'] }}" alt="{{ $s['badge'] ?? 'Slide' }}" loading="lazy">
            <div class="car-txt">
                @if($s['badge'])<div class="car-deco">{{ $s['badge'] }}</div>@endif
                @if($s['script'])<span class="car-script">{{ $s['script'] }}</span>@endif
                <h1 class="car-titre">{!! nl2br(e($s['title'])) !!}</h1>
                @if($s['phrase'])<p class="car-phrase">{{ $s['phrase'] }}</p>@endif
                <div class="car-btns">
                    @if($s['btn1_text'])
                        <a href="{{ $s['btn1_url'] ?? '#' }}" class="btn btn-rose">{{ $s['btn1_text'] }}</a>
                    @endif
                    @if($s['btn2_text'])
                        <a href="{{ $s['btn2_url'] ?? '#' }}" class="btn btn-outline">{{ $s['btn2_text'] }}</a>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <button class="car-fl prev" id="prev"><i class="fas fa-chevron-left"></i></button>
    <button class="car-fl next" id="next"><i class="fas fa-chevron-right"></i></button>
    <div class="car-dots" id="car-dots">
        @foreach($carouselSlides as $i => $s)
            <button class="car-dot {{ $i === 0 ? 'on' : '' }}" data-i="{{ $i }}"></button>
        @endforeach
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
        <div><div class="av-titre">Livraison offerte</div><div class="av-sous">Dès 70 000 F CFA d'achat, partout</div></div>
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
            <img src="{{ asset('assets/images/jepk4.jpg') }}" alt="Atelier" class="qi-grande" loading="lazy">
            <img src="{{ asset('assets/images/jepk17.jpg') }}" alt="Détail" class="qi-petite" loading="lazy">
            <div class="qi-coeur"><i class="fas fa-heart"></i></div>
        </div>
        <div class="qui-txt">
            <span class="s-label rev">Notre histoire</span>
            <h2 class="s-titre rev d1">Qui sommes-<em>nous</em> ?</h2>
            <p class="qui-p rev d2">JEKP Store est né d'une passion profonde pour l'art du crochet et la création textile. Nous sommes une maison artisanale qui sélectionne avec soin des fils d'exception et crée des pièces pensées pour tous les niveaux.</p>
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
                    'sous' => 'Coussins, plaids, nappes, tapis et décorations faites à la main pour votre intérieur.',
                    'slug' => 'maison',
                    'img'  => 'assets/images/jepk42.jpg',
                ],
                [
                    'nom'  => 'Adulte',
                    'sous' => 'Pulls, gilets, écharpes et bonnets — des pièces uniques au crochet pour vous.',
                    'slug' => 'adulte',
                    'img'  => 'assets/images/jepk5.jpg',
                ],
                [
                    'nom'  => 'Enfant',
                    'sous' => 'Layettes, doudous, peluches et vêtements doux pour les bébés et les enfants.',
                    'slug' => 'enfant',
                    'img'  => 'assets/images/jepk10.jpg',
                ],
                [
                    'nom'  => 'Accessoires',
                    'sous' => 'Sacs, pochettes, bijoux et idées cadeaux — l\'art du crochet au quotidien.',
                    'slug' => 'accessoires',
                    'img'  => 'assets/images/jepk25.jpg',
                ],
            ];
            @endphp

            @foreach(isset($categories) && count($categories) ? $categories : $dc as $i => $c)
            @php
                $nom  = is_array($c) ? $c['nom']  : $c->name;
                $sous = is_array($c) ? $c['sous']  : ($c->description ?? '');
                $slug = is_array($c) ? $c['slug']  : $c->slug;
                $img  = is_array($c) ? asset($c['img']) : product_image_url($c->image);
            @endphp
            <a href="{{ route('categories.show', $slug) }}" class="cat-c rev d{{ $i+1 }}">
                <img src="{{ $img }}" alt="{{ $nom }}" loading="lazy">
                <div class="cat-overlay">
                    <span class="cat-label-s">Collection</span>
                    <span class="cat-nom">{{ $nom }}</span>
                    <span class="cat-nb">{{ $sous }}</span>
                    <span class="cat-btn-s">Découvrir <i class="fas fa-arrow-right"></i></span>
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



{{-- ══════ INSPIRATION GRILLE ══════ --}}
<section class="inspi">
    <div class="ent-c rev" style="text-align:center;margin-bottom:42px">
        <span class="s-label">Inspirations</span>
        <h2 class="s-titre">Notre <em>Univers</em></h2>
    </div>
    <div class="inspi-grid">
        <div class="inspi-card rev"><img src="{{ asset('assets/images/jepk32.jpg') }}" alt="" loading="lazy"><span class="inspi-tag">Collection Automne</span></div>
        <div class="inspi-card rev d1"><img src="{{ asset('assets/images/jepk40.jpg') }}" alt="" loading="lazy"><span class="inspi-tag">Kits & Tutoriels</span></div>
        <div class="inspi-card rev d2"><img src="{{ asset('assets/images/jepk28.jpg') }}" alt="" loading="lazy"><span class="inspi-tag">Accessoires</span></div>
        <div class="inspi-card rev"><img src="{{ asset('assets/images/jepk37.jpg') }}" alt="" loading="lazy"><span class="inspi-tag">Collection Automne</span></div>
        <div class="inspi-card rev d1"><img src="{{ asset('assets/images/jepk27.jpg') }}" alt="" loading="lazy"><span class="inspi-tag">Kits & Tutoriels</span></div>
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
            <form action="{{ route('home') }}" method="POST" enctype="multipart/form-data">
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
                {{-- ── Champ photo d'inspiration ── --}}
                <div class="f-g">
                    <label><i class="fas fa-camera" style="margin-right:5px;color:var(--rose-v)"></i>Photo d'inspiration (optionnel)</label>
                    <div class="f-upload-zone" id="uploadZone">
                        <input type="file" name="photo_inspiration" id="photoInput"
                               accept="image/jpeg,image/png,image/webp,image/gif"
                               aria-label="Ajouter une photo d'inspiration">
                        <span class="f-upload-icon"><i class="fas fa-cloud-upload-alt"></i></span>
                        <div class="f-upload-label">
                            <strong>Cliquez ou glissez votre photo ici</strong>
                            <small>JPG, PNG, WEBP · Max 5 Mo</small>
                        </div>
                    </div>
                    <div class="f-upload-preview" id="uploadPreview">
                        <img src="" alt="Aperçu" id="previewImg">
                        <button type="button" class="f-upload-preview-del" id="deletePhoto" title="Supprimer la photo">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="f-row">
                    <div class="f-g">
                        <label>Budget approximatif</label>
                        <select name="budget">
                            <option value="">Choisir…</option>
                            <option>Moins de 30 000 F CFA</option>
                            <option>30 000 – 60 000 F CFA</option>
                            <option>60 000 – 120 000 F CFA</option>
                            <option>Plus de 120 000 F CFA</option>
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
            @foreach([['★★★★★','La qualité des fils est absolument exceptionnelle. Les créations au crochet sont d\'une douceur incomparable et les coloris sont magnifiques. Je suis cliente à vie !','Marie L.','Paris · Crocheteuse','47'],['★★★★★','J\'ai commandé une création sur mesure pour ma mère. Le résultat a dépassé toutes mes espérances ! L\'équipe est à l\'écoute et très professionnelle.','Nathalie B.','Lyon · Créatrice','32'],['★★★★★','Service client au top, livraison ultra rapide et les produits sont encore plus beaux en vrai. JEKP c\'est une boutique à part entière. Je recommande !','Sophie M.','Bordeaux · Artiste','56']] as $i=>$t)
            <div class="t-carte rev d{{ $i+1 }}">
                <div class="t-etoiles">{{ $t[0] }}</div>
                <p class="t-txt">{{ $t[1] }}</p>
                <div class="t-aut">
                    <div class="t-av"><img src="{{ asset('assets/images/jepk30.jpg') }}" alt="{{ $t[2] }}" loading="lazy"></div>
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
        @foreach([['Tutoriels','Comment réussir sa première création au crochet : guide complet pour débutantes','Découvrez toutes les étapes, les astuces et les erreurs à éviter pour réaliser votre première création au crochet.','assets/images/jepk39.jpg'],
            ['Tendances','Les couleurs de la saison : tons doux et naturels à la une','Pantone a parlé : cette saison mise sur les tons pêche, lavande et crème. Voici comment les intégrer à vos créations.','assets/images/jepk29.jpg'],
            ['Matières','Mérinos, alpaga, mohair : comment choisir son fil ?','Un guide complet pour comprendre les différentes fibres naturelles et choisir celle qui convient à votre projet.','assets/images/jepk44.jpg']] as $i=>$b)
        <a href="{{ route('pages.blog') }}" class="bl-carte rev d{{ $i }}">
            <div class="bl-img"><img src="{{ asset($b[3]) }}" alt="{{ $b[1] }}" loading="lazy"></div>
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

// ── Upload photo inspiration ──
(function(){
    const zone=document.getElementById('uploadZone');
    const input=document.getElementById('photoInput');
    const preview=document.getElementById('uploadPreview');
    const previewImg=document.getElementById('previewImg');
    const delBtn=document.getElementById('deletePhoto');
    if(!zone||!input)return;

    function showPreview(file){
        if(!file||!file.type.startsWith('image/'))return;
        if(file.size>5*1024*1024){
            alert('La photo ne doit pas dépasser 5 Mo.');
            input.value='';return;
        }
        const reader=new FileReader();
        reader.onload=e=>{
            previewImg.src=e.target.result;
            preview.style.display='block';
            zone.style.display='none';
        };
        reader.readAsDataURL(file);
    }

    input.addEventListener('change',()=>{ if(input.files[0]) showPreview(input.files[0]); });

    // Drag & drop
    ['dragenter','dragover'].forEach(ev=>zone.addEventListener(ev,e=>{e.preventDefault();zone.classList.add('dragover');}));
    ['dragleave','drop'].forEach(ev=>zone.addEventListener(ev,e=>{e.preventDefault();zone.classList.remove('dragover');}));
    zone.addEventListener('drop',e=>{
        const f=e.dataTransfer.files[0];
        if(f){ const dt=new DataTransfer();dt.items.add(f);input.files=dt.files;showPreview(f); }
    });

    // Supprimer la photo
    delBtn&&delBtn.addEventListener('click',()=>{
        input.value='';
        previewImg.src='';
        preview.style.display='none';
        zone.style.display='block';
    });
})();
</script>
@endpush