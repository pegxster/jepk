@extends('layouts.app')
@section('title', 'FAQ — Questions fréquentes · JEKP Store')

@push('styles')
<style>
/* ══ HERO ══ */
.page-hero{background:linear-gradient(135deg,var(--creme2),var(--peche),var(--lavande));padding:70px 50px;text-align:center;border-bottom:1px solid var(--peche)}
.breadcrumb{display:flex;gap:8px;align-items:center;font-size:11px;color:var(--texte2);justify-content:center;margin-top:14px}
.breadcrumb a{color:var(--texte2);text-decoration:none}.breadcrumb a:hover{color:var(--rose-v)}
.breadcrumb span{color:var(--rose-p)}

/* ══ LAYOUT FAQ ══ */
.faq-wrap{max-width:820px;margin:0 auto;padding:80px 40px}

/* ══ RECHERCHE ══ */
.faq-search{position:relative;margin-bottom:56px}
.faq-search input{
    width:100%;padding:16px 50px 16px 20px;
    border:2px solid var(--peche2);border-radius:50px;
    font-family:var(--f-corps);font-size:14px;color:var(--texte);
    outline:none;background:var(--blanc);transition:border-color .3s;
    box-shadow:0 4px 20px rgba(201,104,128,.08);
}
.faq-search input:focus{border-color:var(--rose-v)}
.faq-search i{position:absolute;right:20px;top:50%;transform:translateY(-50%);color:var(--rose-v);font-size:15px}

/* ══ CATÉGORIES TABS ══ */
.faq-tabs{display:flex;gap:10px;flex-wrap:wrap;margin-bottom:40px}
.faq-tab{padding:8px 20px;border-radius:50px;border:1.5px solid var(--peche2);
    font-size:11px;letter-spacing:1.5px;text-transform:uppercase;cursor:pointer;
    color:var(--texte2);background:var(--blanc);transition:var(--trans);font-family:var(--f-corps)}
.faq-tab:hover,.faq-tab.on{background:var(--rose-v);border-color:var(--rose-v);color:var(--blanc)}

/* ══ ACCORDÉON ══ */
.faq-groupe{margin-bottom:44px}
.faq-groupe-titre{font-family:var(--f-titre);font-size:22px;font-weight:300;color:var(--texte);
    margin-bottom:18px;padding-bottom:12px;border-bottom:1.5px solid var(--peche2);
    display:flex;align-items:center;gap:10px}
.faq-groupe-titre i{color:var(--rose-v);font-size:18px}
.faq-item{background:var(--blanc);border:1.5px solid var(--peche);border-radius:12px;
    margin-bottom:10px;overflow:hidden;transition:border-color .3s,box-shadow .3s}
.faq-item:hover{border-color:var(--peche2);box-shadow:var(--ombre-sm)}
.faq-item.open{border-color:var(--rose-v);box-shadow:0 4px 20px rgba(201,104,128,.12)}
.faq-q{
    width:100%;padding:18px 22px;background:none;border:none;cursor:pointer;
    display:flex;justify-content:space-between;align-items:center;gap:16px;
    font-family:var(--f-corps);font-size:14px;font-weight:400;color:var(--texte);
    text-align:left;transition:background .2s;
}
.faq-item.open .faq-q{background:var(--creme2)}
.faq-q i{color:var(--rose-v);font-size:12px;transition:transform .3s;flex-shrink:0}
.faq-item.open .faq-q i{transform:rotate(45deg)}
.faq-a{
    max-height:0;overflow:hidden;transition:max-height .4s ease,padding .3s;
    font-size:13.5px;color:var(--texte2);line-height:1.85;
}
.faq-item.open .faq-a{max-height:400px;padding:0 22px 20px}

/* ══ BLOC CONTACT ══ */
.faq-contact{background:linear-gradient(135deg,var(--brun-d),var(--brun-2));
    border-radius:18px;padding:50px 40px;text-align:center;margin-top:60px;position:relative;overflow:hidden}
.faq-contact::before{content:'?';position:absolute;font-size:260px;font-family:var(--f-titre);
    color:rgba(255,255,255,.03);right:-40px;top:-40px;line-height:1}
.faq-contact h3{font-family:var(--f-titre);font-size:32px;font-weight:300;color:var(--blanc);margin-bottom:10px}
.faq-contact p{font-size:13.5px;color:rgba(255,255,255,.55);margin-bottom:28px;line-height:1.8}
.faq-contact .btns{display:flex;gap:14px;justify-content:center;flex-wrap:wrap}

/* ══ RESPONSIVE ══ */
@media(max-width:700px){
    .faq-wrap{padding:30px 16px}
    .page-hero{padding:36px 20px}
    .faq-contact{padding:36px 20px}
    .faq-contact h3{font-size:24px}
    .faq-tab{font-size:10px;padding:6px 14px}
}
</style>
@endpush

@section('content')

{{-- ══ HERO ══ --}}
<div class="page-hero">
    <span class="s-label">Aide & support</span>
    <h1 class="s-titre">Questions <em>Fréquentes</em></h1>
    <p style="font-size:14px;color:var(--texte2);margin-top:12px;max-width:480px;margin-left:auto;margin-right:auto;line-height:1.8">
        Trouvez rapidement les réponses à vos questions sur nos produits, commandes et livraisons.
    </p>
    <div class="breadcrumb">
        <a href="{{ route('home') }}">Accueil</a>
        <i class="fas fa-chevron-right" style="font-size:9px"></i>
        <span>FAQ</span>
    </div>
</div>

{{-- ══ CONTENU ══ --}}
<div class="faq-wrap">

    {{-- Barre de recherche --}}
    <div class="faq-search">
        <input type="text" id="faqSearch" placeholder="Rechercher une question…" autocomplete="off">
        <i class="fas fa-search"></i>
    </div>

    {{-- Filtres par catégorie --}}
    <div class="faq-tabs">
        <button class="faq-tab on" data-cat="tout">Tout voir</button>
        <button class="faq-tab" data-cat="commandes">Commandes</button>
        <button class="faq-tab" data-cat="livraison">Livraison</button>
        <button class="faq-tab" data-cat="paiement">Paiement</button>
        <button class="faq-tab" data-cat="mesure">Sur mesure</button>
        <button class="faq-tab" data-cat="retours">Retours</button>
        <button class="faq-tab" data-cat="produits">Produits</button>
    </div>

    {{-- ── COMMANDES ── --}}
    <div class="faq-groupe" data-cat="commandes">
        <div class="faq-groupe-titre"><i class="fas fa-shopping-bag"></i> Commandes</div>

        <div class="faq-item">
            <button class="faq-q">Comment passer une commande ?<i class="fas fa-plus"></i></button>
            <div class="faq-a">Parcourez notre boutique, ajoutez les articles souhaités à votre panier, puis cliquez sur « Commander ». Vous devrez créer un compte ou vous connecter pour finaliser votre achat. Le processus est simple et sécurisé.</div>
        </div>

        <div class="faq-item">
            <button class="faq-q">Puis-je modifier ou annuler ma commande ?<i class="fas fa-plus"></i></button>
            <div class="faq-a">Vous pouvez modifier ou annuler votre commande dans les 2 heures suivant la passation. Passé ce délai, la commande entre en production et ne peut plus être modifiée. Contactez-nous au plus vite via WhatsApp si vous avez besoin d'aide.</div>
        </div>

        <div class="faq-item">
            <button class="faq-q">Comment suivre l'état de ma commande ?<i class="fas fa-plus"></i></button>
            <div class="faq-a">Connectez-vous à votre espace client et rendez-vous dans « Mes commandes ». Vous verrez en temps réel le statut de chaque commande : En préparation, Expédiée, Livrée. Un email de confirmation vous est envoyé à chaque étape.</div>
        </div>

        <div class="faq-item">
            <button class="faq-q">Recevrai-je une confirmation après ma commande ?<i class="fas fa-plus"></i></button>
            <div class="faq-a">Oui, un email de confirmation est envoyé automatiquement à l'adresse que vous avez renseignée. Si vous ne le recevez pas sous 10 minutes, vérifiez vos spams ou contactez-nous.</div>
        </div>
    </div>

    {{-- ── LIVRAISON ── --}}
    <div class="faq-groupe" data-cat="livraison">
        <div class="faq-groupe-titre"><i class="fas fa-truck"></i> Livraison</div>

        <div class="faq-item">
            <button class="faq-q">Quels sont les délais de livraison ?<i class="fas fa-plus"></i></button>
            <div class="faq-a">Pour les articles en stock : livraison sous 3 à 7 jours ouvrables. Pour les créations sur mesure : le délai varie selon le projet (généralement 2 à 5 semaines). Vous êtes informée à chaque étape par WhatsApp.</div>
        </div>

        <div class="faq-item">
            <button class="faq-q">La livraison est-elle offerte ?<i class="fas fa-plus"></i></button>
            <div class="faq-a">La livraison est offerte pour toute commande dépassant 70 000 F CFA. En dessous de ce montant, des frais de livraison s'appliquent en fonction de votre localisation. Le montant exact vous est indiqué au moment de la commande.</div>
        </div>

        <div class="faq-item">
            <button class="faq-q">Livrez-vous partout ?<i class="fas fa-plus"></i></button>
            <div class="faq-a">Nous livrons dans toute la zone UEMOA et pays limitrophes. Pour toute livraison internationale, contactez-nous directement via WhatsApp pour obtenir un devis personnalisé.</div>
        </div>

        <div class="faq-item">
            <button class="faq-q">Comment est emballée ma commande ?<i class="fas fa-plus"></i></button>
            <div class="faq-a">Chaque commande est soigneusement emballée dans un packaging délicat avec une carte personnalisée. Les créations fragiles sont protégées avec du papier de soie. L'emballage fait partie de l'expérience JEKP.</div>
        </div>
    </div>

    {{-- ── PAIEMENT ── --}}
    <div class="faq-groupe" data-cat="paiement">
        <div class="faq-groupe-titre"><i class="fas fa-credit-card"></i> Paiement</div>

        <div class="faq-item">
            <button class="faq-q">Quels moyens de paiement acceptez-vous ?<i class="fas fa-plus"></i></button>
            <div class="faq-a">Nous acceptons : Wave, Orange Money, MTN Mobile Money, carte bancaire (Visa, Mastercard). Tous les paiements sont sécurisés. Vous pouvez aussi payer par virement bancaire — contactez-nous pour les coordonnées.</div>
        </div>

        <div class="faq-item">
            <button class="faq-q">Le paiement est-il sécurisé ?<i class="fas fa-plus"></i></button>
            <div class="faq-a">Oui, 100%. Toutes nos transactions sont chiffrées et sécurisées. Nous ne stockons jamais vos données bancaires. Les paiements mobile money sont traités directement par les opérateurs officiels.</div>
        </div>

        <div class="faq-item">
            <button class="faq-q">Puis-je payer en plusieurs fois ?<i class="fas fa-plus"></i></button>
            <div class="faq-a">Pour les créations sur mesure dépassant 50 000 F CFA, nous proposons un paiement en 2 fois : 50% à la commande, 50% à la livraison. Contactez-nous pour en discuter selon votre projet.</div>
        </div>
    </div>

    {{-- ── SUR MESURE ── --}}
    <div class="faq-groupe" data-cat="mesure">
        <div class="faq-groupe-titre"><i class="fas fa-magic"></i> Création Sur Mesure</div>

        <div class="faq-item">
            <button class="faq-q">Comment fonctionne la création sur mesure ?<i class="fas fa-plus"></i></button>
            <div class="faq-a">Remplissez le formulaire sur mesure sur notre page d'accueil (type de création, taille, coloris, description, photo d'inspiration). Nous vous recontactons sous 24h pour discuter de votre projet, établir un devis et fixer un délai de réalisation.</div>
        </div>

        <div class="faq-item">
            <button class="faq-q">Puis-je fournir mes propres photos d'inspiration ?<i class="fas fa-plus"></i></button>
            <div class="faq-a">Absolument ! Vous pouvez joindre des photos d'inspiration directement via notre formulaire sur mesure. Plus votre description est précise, mieux nous pourrons réaliser la pièce de vos rêves.</div>
        </div>

        <div class="faq-item">
            <button class="faq-q">Quel est le délai pour une création sur mesure ?<i class="fas fa-plus"></i></button>
            <div class="faq-a">Le délai varie selon la complexité de la pièce : de 2 semaines pour un accessoire simple à 6-8 semaines pour un vêtement élaboré. Nous vous communiquons un délai précis après étude de votre projet.</div>
        </div>

        <div class="faq-item">
            <button class="faq-q">Puis-je demander des modifications en cours de création ?<i class="fas fa-plus"></i></button>
            <div class="faq-a">Oui ! Nous partageons des photos d'avancement régulières via WhatsApp. Vous pouvez demander de légères modifications (coloris, proportion) en cours de route. Les changements majeurs peuvent entraîner un délai supplémentaire.</div>
        </div>
    </div>

    {{-- ── RETOURS ── --}}
    <div class="faq-groupe" data-cat="retours">
        <div class="faq-groupe-titre"><i class="fas fa-undo"></i> Retours & Échanges</div>

        <div class="faq-item">
            <button class="faq-q">Quelle est votre politique de retour ?<i class="fas fa-plus"></i></button>
            <div class="faq-a">Vous disposez de 14 jours après réception pour retourner un article dans son état d'origine (non porté, non lavé, emballage intact). Les créations sur mesure ne sont pas remboursables sauf défaut de fabrication.</div>
        </div>

        <div class="faq-item">
            <button class="faq-q">Comment effectuer un retour ?<i class="fas fa-plus"></i></button>
            <div class="faq-a">Contactez-nous via WhatsApp ou par email en indiquant votre numéro de commande et la raison du retour. Nous vous enverrons les instructions détaillées pour le renvoi de l'article.</div>
        </div>

        <div class="faq-item">
            <button class="faq-q">Quand serai-je remboursée ?<i class="fas fa-plus"></i></button>
            <div class="faq-a">Le remboursement est effectué dans les 5 à 10 jours ouvrables après réception et vérification de l'article retourné, via le même moyen de paiement utilisé lors de la commande.</div>
        </div>
    </div>

    {{-- ── PRODUITS ── --}}
    <div class="faq-groupe" data-cat="produits">
        <div class="faq-groupe-titre"><i class="fas fa-yarn"></i> Produits & Matières</div>

        <div class="faq-item">
            <button class="faq-q">Vos produits sont-ils 100% artisanaux ?<i class="fas fa-plus"></i></button>
            <div class="faq-a">Oui, chaque pièce est entièrement crochetée à la main dans notre atelier. Nous n'utilisons aucune machine de production. C'est notre engagement fondamental envers la qualité et l'authenticité artisanale.</div>
        </div>

        <div class="faq-item">
            <button class="faq-q">Comment entretenir mes créations JEKP ?<i class="fas fa-plus"></i></button>
            <div class="faq-a">Lavage à la main à l'eau froide ou en machine en programme délicat (30°C max). Utilisez un savon doux pour laines. Séchage à plat à l'air libre, loin de la chaleur directe. Évitez l'essorage énergique.</div>
        </div>

        <div class="faq-item">
            <button class="faq-q">Les coloris en photo sont-ils fidèles à la réalité ?<i class="fas fa-plus"></i></button>
            <div class="faq-a">Nous faisons tout pour que les photos soient les plus fidèles possible. Cependant, les couleurs peuvent légèrement varier selon votre écran. En cas de doute, n'hésitez pas à nous demander des photos supplémentaires avant commande.</div>
        </div>

        <div class="faq-item">
            <button class="faq-q">Proposez-vous des tailles personnalisées ?<i class="fas fa-plus"></i></button>
            <div class="faq-a">Oui ! Via notre service sur mesure, nous nous adaptons à toutes les morphologies. Envoyez-nous vos mensurations (tour de poitrine, taille, hanches) et nous réalisons une pièce parfaitement ajustée pour vous.</div>
        </div>
    </div>

    {{-- ── BLOC CONTACT ── --}}
    <div class="faq-contact">
        <h3>Vous n'avez pas trouvé votre <em style="color:var(--peche);font-style:italic">réponse ?</em></h3>
        <p>Notre équipe est disponible pour répondre à toutes vos questions.<br>Réponse garantie sous 24h.</p>
        <div class="btns">
            <a href="https://wa.me/0153928572" class="btn btn-peche" target="_blank">
                <i class="fab fa-whatsapp"></i> Écrire sur WhatsApp
            </a>
            <a href="mailto:contact@jekpstore.com" class="btn btn-outline">
                <i class="fas fa-envelope"></i> Envoyer un email
            </a>
        </div>
    </div>

</div>

@endsection

@push('scripts')
<script>
// ── Accordéon ──
document.querySelectorAll('.faq-q').forEach(btn => {
    btn.addEventListener('click', () => {
        const item = btn.closest('.faq-item');
        const isOpen = item.classList.contains('open');
        // Fermer tous
        document.querySelectorAll('.faq-item.open').forEach(i => i.classList.remove('open'));
        if (!isOpen) item.classList.add('open');
    });
});

// ── Filtres par catégorie ──
document.querySelectorAll('.faq-tab').forEach(tab => {
    tab.addEventListener('click', () => {
        document.querySelectorAll('.faq-tab').forEach(t => t.classList.remove('on'));
        tab.classList.add('on');
        const cat = tab.dataset.cat;
        document.querySelectorAll('.faq-groupe').forEach(g => {
            g.style.display = (cat === 'tout' || g.dataset.cat === cat) ? 'block' : 'none';
        });
        // Fermer tous les accordéons
        document.querySelectorAll('.faq-item.open').forEach(i => i.classList.remove('open'));
    });
});

// ── Recherche en temps réel ──
document.getElementById('faqSearch').addEventListener('input', function() {
    const q = this.value.toLowerCase().trim();
    document.querySelectorAll('.faq-tab').forEach(t => t.classList.remove('on'));
    document.querySelector('[data-cat="tout"]').classList.add('on');
    document.querySelectorAll('.faq-groupe').forEach(g => g.style.display = 'block');

    if (!q) {
        document.querySelectorAll('.faq-item').forEach(i => i.style.display = 'block');
        return;
    }
    document.querySelectorAll('.faq-item').forEach(item => {
        const texte = item.textContent.toLowerCase();
        item.style.display = texte.includes(q) ? 'block' : 'none';
        if (texte.includes(q)) item.classList.add('open');
        else item.classList.remove('open');
    });
    // Masquer groupes vides
    document.querySelectorAll('.faq-groupe').forEach(g => {
        const visible = [...g.querySelectorAll('.faq-item')].some(i => i.style.display !== 'none');
        g.style.display = visible ? 'block' : 'none';
    });
});
</script>
@endpush
