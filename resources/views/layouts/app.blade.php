<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'JEKP Store — Créations Artisanales')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,300;1,400&family=Nunito:wght@200;300;400;500&family=Alex+Brush&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        /* ================================================================
   JEKP STORE — Design Féminin Ultra-Doux 2024
   Palette : Rose poudré · Lavande · Pêche · Blanc cassé · Vieux rose
   ================================================================ */
        :root {
            /* Couleurs principales — douces et féminines */
            --blanc: #ffffff;
            --creme: #fdf8f6;
            --creme2: #f9f0eb;
            --peche: #f7d9cc;
            --peche2: #eebbaa;
            --rose-p: #e8a0a8;
            /* rose poudré */
            --rose-v: #c97080;
            /* vieux rose (accent principal) */
            --rose-f: #b05060;
            /* rose foncé (hover) */
            --lavande: #d8cce8;
            /* lavande douce */
            --lavande2: #b8a4d4;
            /* lavande accent */
            --nude: #e8d5c8;
            --beige: #f0e4da;
            --brun-d: #5a3040;
            /* brun violacé foncé */
            --brun-2: #7a5060;
            --texte: #3d2030;
            --texte2: #8a6070;
            --gris: #f7f2ef;

            --f-titre: 'Cormorant Garamond', Georgia, serif;
            --f-script: 'Alex Brush', cursive;
            --f-corps: 'Nunito', sans-serif;

            --ombre: 0 8px 40px rgba(90, 48, 64, 0.10);
            --ombre-sm: 0 2px 16px rgba(90, 48, 64, 0.07);
            --trans: all 0.38s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            --rayon: 12px;
        }

        *,
        *::before,
        *::after {
            margin: 0;
            padding: 0;
            box-sizing: border-box
        }

        html {
            scroll-behavior: smooth
        }

        body {
            font-family: var(--f-corps);
            background: var(--creme);
            color: var(--texte);
            font-weight: 300;
            overflow-x: hidden;
            line-height: 1.6;
        }

        ::selection {
            background: var(--peche);
            color: var(--brun-d)
        }

        ::-webkit-scrollbar {
            width: 4px
        }

        ::-webkit-scrollbar-track {
            background: var(--creme2)
        }

        ::-webkit-scrollbar-thumb {
            background: var(--rose-p);
            border-radius: 4px
        }

        /* ── BOUTONS ── */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 13px 32px;
            font-family: var(--f-corps);
            font-size: 10px;
            letter-spacing: 2.5px;
            text-transform: uppercase;
            font-weight: 500;
            text-decoration: none;
            cursor: pointer;
            border: none;
            transition: var(--trans);
            border-radius: 50px;
        }

        .btn-rose {
            background: var(--rose-v);
            color: var(--blanc);
            box-shadow: 0 4px 20px rgba(201, 112, 128, 0.35)
        }

        .btn-rose:hover {
            background: var(--rose-f);
            transform: translateY(-2px);
            box-shadow: 0 8px 28px rgba(201, 112, 128, 0.45)
        }

        .btn-peche {
            background: var(--peche);
            color: var(--brun-d);
            box-shadow: var(--ombre-sm)
        }

        .btn-peche:hover {
            background: var(--peche2);
            transform: translateY(-2px)
        }

        .btn-blanc {
            background: var(--blanc);
            color: var(--rose-v);
            box-shadow: var(--ombre)
        }

        .btn-blanc:hover {
            background: var(--creme2);
            transform: translateY(-2px)
        }

        .btn-outline {
            background: transparent;
            color: var(--blanc);
            border: 1.5px solid rgba(255, 255, 255, 0.55)
        }

        .btn-outline:hover {
            background: rgba(255, 255, 255, 0.12);
            border-color: var(--blanc)
        }

        .btn-outline-rose {
            background: transparent;
            color: var(--rose-v);
            border: 1.5px solid var(--rose-v)
        }

        .btn-outline-rose:hover {
            background: var(--rose-v);
            color: var(--blanc)
        }

        .btn-lavande {
            background: var(--lavande);
            color: var(--brun-d);
            box-shadow: var(--ombre-sm)
        }

        .btn-lavande:hover {
            background: var(--lavande2);
            color: var(--blanc)
        }

        /* ── TITRES ── */
        .s-label {
            font-family: var(--f-script);
            font-size: 28px;
            color: var(--rose-v);
            display: block;
            margin-bottom: 6px;
            line-height: 1
        }

        .s-titre {
            font-family: var(--f-titre);
            font-size: clamp(28px, 3.8vw, 50px);
            font-weight: 300;
            color: var(--texte);
            line-height: 1.15
        }

        .s-titre em {
            font-style: italic;
            color: var(--rose-v)
        }

        .s-sous {
            font-size: 14px;
            color: var(--texte2);
            line-height: 1.95;
            font-weight: 300
        }

        /* ── FLASH ── */
        .flash {
            padding: 14px 30px;
            font-size: 13px;
            margin: 12px 50px
        }

        .flash-ok {
            background: #fdf5f7;
            color: var(--rose-f);
            border-left: 3px solid var(--rose-p)
        }

        .flash-err {
            background: #fff5f5;
            color: #9b3535;
            border-left: 3px solid #f0a0a0
        }

        /* ================================================================
   BARRE ANNONCE
   ================================================================ */
        .ann-bar {
            background: linear-gradient(90deg, var(--brun-d), var(--brun-2), var(--rose-v), var(--brun-2), var(--brun-d));
            background-size: 300%;
            animation: annGrad 10s linear infinite;
            color: rgba(255, 255, 255, 0.88);
            text-align: center;
            padding: 10px;
            font-size: 10px;
            letter-spacing: 3px;
            text-transform: uppercase;
        }

        @keyframes annGrad {
            0% {
                background-position: 0%
            }

            100% {
                background-position: 300%
            }
        }

        /* ================================================================
   HEADER
   ================================================================ */
        header {
            position: sticky;
            top: 0;
            z-index: 900;
            background: rgba(253, 248, 246, 0.97);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--peche);
            box-shadow: 0 1px 20px rgba(90, 48, 64, 0.06);
            transition: var(--trans);
        }

        .h-inner {
            max-width: 1360px;
            margin: 0 auto;
            padding: 0 50px;
            display: grid;
            grid-template-columns: 1fr auto 1fr;
            align-items: center;
            height: 78px;
        }

        .nav-g,
        .nav-d {
            display: flex;
            align-items: center;
            gap: 30px
        }

        .nav-d {
            justify-content: flex-end
        }

        .nav-a {
            text-decoration: none;
            color: var(--texte2);
            font-size: 10px;
            letter-spacing: 2px;
            text-transform: uppercase;
            font-weight: 500;
            position: relative;
            padding-bottom: 3px;
            transition: color 0.3s;
        }

        .nav-a::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 0;
            height: 1.5px;
            background: var(--rose-v);
            transition: width 0.35s;
            border-radius: 2px;
        }

        .nav-a:hover {
            color: var(--rose-v)
        }

        .nav-a:hover::after {
            width: 100%
        }

        /* LOGO */
        .logo {
            text-align: center;
            text-decoration: none;
            display: flex;
            flex-direction: column;
            align-items: center
        
        }

        .logo-img {
            height: 70px;
            width: auto;
            object-fit: contain;
            
            
        }


  
        /* Icônes */
        .h-icons {
            display: flex;
            align-items: center;
            gap: 18px
        }

        .h-icons a {
            color: var(--texte2);
            text-decoration: none;
            font-size: 16px;
            transition: color 0.3s;
            position: relative
        }

        .h-icons a:hover {
            color: var(--rose-v)
        }

        .badge-panier {
            position: absolute;
            top: -8px;
            right: -9px;
            background: var(--rose-v);
            color: var(--blanc);
            font-size: 8px;
            font-weight: 700;
            width: 17px;
            height: 17px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .hamburger {
            display: none;
            background: none;
            border: none;
            cursor: pointer;
            flex-direction: column;
            gap: 5px;
            padding: 3px
        }

        .hamburger span {
            width: 22px;
            height: 1.5px;
            background: var(--texte);
            display: block;
            transition: 0.3s
        }

        /* Barre recherche */
        .s-bar {
            border-top: 1px solid var(--peche);
            background: var(--creme2);
            padding: 14px 50px;
            display: none;
            justify-content: center
        }

        .s-bar.oui {
            display: flex
        }

        .s-bar input {
            width: 100%;
            max-width: 520px;
            border: none;
            background: transparent;
            border-bottom: 1.5px solid var(--peche2);
            padding: 8px 0;
            font-family: var(--f-corps);
            font-size: 14px;
            color: var(--texte);
            outline: none;
            transition: border-color 0.3s;
        }

        .s-bar input:focus {
            border-bottom-color: var(--rose-v)
        }

        .s-bar input::placeholder {
            color: var(--nude)
        }

        /* Menu mobile */
        .m-menu {
            display: none;
            position: fixed;
            inset: 0;
            z-index: 800;
            background: var(--creme);
            flex-direction: column;
            padding: 100px 40px 40px;
            gap: 4px
        }

        .m-menu.oui {
            display: flex
        }

        .m-menu a {
            font-family: var(--f-titre);
            font-size: 36px;
            color: var(--texte);
            text-decoration: none;
            font-weight: 300;
            padding: 12px 0;
            border-bottom: 1px solid var(--peche);
            transition: color 0.3s
        }

        .m-menu a:hover {
            color: var(--rose-v)
        }

        .m-close {
            position: absolute;
            top: 28px;
            right: 36px;
            background: none;
            border: none;
            font-size: 22px;
            color: var(--texte2);
            cursor: pointer
        }

        /* ================================================================
   WHATSAPP — Discret, dans les tons du site
   ================================================================ */
        .wa-float {
            position: fixed;
            bottom: 28px;
            right: 28px;
            z-index: 999;
            width: 52px;
            height: 52px;
            background: var(--rose-v);
            /* dans les tons du site */
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            color: var(--blanc);
            text-decoration: none;
            box-shadow: 0 4px 20px rgba(201, 112, 128, 0.4);
            transition: var(--trans);
        }

        .wa-float:hover {
            background: var(--rose-f);
            transform: scale(1.08);
            box-shadow: 0 6px 28px rgba(201, 112, 128, 0.55)
        }

        .wa-tip {
            position: absolute;
            right: 60px;
            background: var(--brun-d);
            color: var(--blanc);
            padding: 8px 14px;
            border-radius: 20px 20px 4px 20px;
            font-size: 12px;
            white-space: nowrap;
            font-family: var(--f-corps);
            font-weight: 300;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.3s;
            box-shadow: var(--ombre-sm);
        }

        .wa-tip::after {
            content: '';
            position: absolute;
            right: -6px;
            bottom: 9px;
            border: 6px solid transparent;
            border-left-color: var(--brun-d)
        }

        .wa-float:hover .wa-tip {
            opacity: 1
        }

        /* petit point pulsé subtil */
        .wa-dot {
            position: absolute;
            top: 2px;
            right: 2px;
            width: 10px;
            height: 10px;
            background: var(--peche2);
            border-radius: 50%;
            border: 2px solid var(--blanc);
            animation: waDot 2s ease infinite
        }

        @keyframes waDot {

            0%,
            100% {
                opacity: 1;
                transform: scale(1)
            }

            50% {
                opacity: .6;
                transform: scale(0.85)
            }
        }

        /* ================================================================
   FOOTER
   ================================================================ */
        footer {
            background: var(--brun-d);
            color: rgba(255, 255, 255, 0.45);
            padding: 70px 50px 26px
        }

        .f-grid {
            max-width: 1360px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr;
            gap: 56px;
            padding-bottom: 46px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.07)
        }

        .f-brand-name {
            font-family: var(--f-titre);
            font-size: 22px;
            font-weight: 400;
            color: var(--blanc);
            letter-spacing: 6px;
            text-transform: uppercase
        }

        .f-brand-script {
            font-family: var(--f-script);
            font-size: 17px;
            color: var(--rose-p);
            display: block;
            margin-top: 2px
        }

        .f-sep {
            width: 32px;
            height: 1.5px;
            background: var(--rose-p);
            margin: 16px 0
        }

        .f-brand p {
            font-size: 13px;
            line-height: 2;
            color: rgba(255, 255, 255, 0.3);
            max-width: 250px
        }

        .f-socials {
            display: flex;
            gap: 13px;
            margin-top: 20px
        }

        .f-socials a {
            color: rgba(255, 255, 255, 0.3);
            font-size: 15px;
            text-decoration: none;
            transition: color 0.3s;
            width: 34px;
            height: 34px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center
        }

        .f-socials a:hover {
            color: var(--rose-p);
            border-color: var(--rose-p)
        }

        footer h4 {
            font-size: 9px;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: var(--blanc);
            margin-bottom: 20px;
            font-weight: 500
        }

        footer ul {
            list-style: none
        }

        footer ul li {
            margin-bottom: 9px
        }

        footer ul a {
            color: rgba(255, 255, 255, 0.3);
            text-decoration: none;
            font-size: 13px;
            transition: color 0.3s
        }

        footer ul a:hover {
            color: var(--rose-p)
        }

        .f-bas {
            max-width: 1360px;
            margin: 24px auto 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 11px;
            color: rgba(255, 255, 255, 0.18)
        }

        .f-bas .acc {
            color: var(--rose-p);
            font-size: 13px
        }

        /* Responsive */
        @media(max-width:1000px) {
            .f-grid {
                grid-template-columns: 1fr 1fr;
                gap: 36px
            }
        }

        @media(max-width:600px) {
            .f-grid {
                grid-template-columns: 1fr;
                gap: 30px
            }

            footer {
                padding: 50px 24px 22px
            }

            .f-bas {
                flex-direction: column;
                gap: 8px;
                text-align: center
            }
        }

        @media(max-width:900px) {

            .nav-g,
            .nav-d .nav-a {
                display: none
            }

            .hamburger {
                display: flex
            }

            .h-inner {
                padding: 0 20px
            }
        }
    </style>
    @stack('styles')
</head>

<body>

    {{-- WhatsApp flottant --}}
    <a href="https://wa.me/0153928572" target="0153928572" class="wa-float" title="Nous écrire">
        <i class="fab fa-whatsapp"></i>
        <span class="wa-dot"></span>
        <span class="wa-tip">Nous écrire sur WhatsApp</span>
    </a>

    {{-- Barre annonce --}}
    <div class="ann-bar">✦ Livraison offerte dès 70000fr &nbsp;·&nbsp; Créations artisanales &nbsp;·&nbsp; Sur mesure disponible &nbsp;·&nbsp; Retours 14 jours ✦</div>

    {{-- Header --}}
    <header id="header">
        <div class="h-inner">
            <nav class="nav-g">
                <a href="{{ route('shop.index') }}" class="nav-a">Boutique</a>
                <a href="{{ route('categories.index') }}" class="nav-a">Collections</a>
                <a href="{{ route('pages.atelier') }}" class="nav-a">L'Atelier</a>
            </nav>

            <a href="{{ route('home') }}" class="logo">
                <img src="{{ asset('assets/images/jepklogo.png') }}" alt="JEKP" class="logo-img">
            </a>

            <div class="nav-d">
                <a href="{{ route('pages.blog') }}" class="nav-a">Blog</a>
                <div class="h-icons">
                    <a href="#" id="s-toggle"><i class="fas fa-search"></i></a>
                    @auth
                    <a href="{{ route('account.index') }}"><i class="far fa-user"></i></a>
                    <a href="{{ route('wishlist.index') }}"><i class="far fa-heart"></i></a>
                    @else
                    <a href="{{ route('auth.login') }}"><i class="far fa-user"></i></a>
                    @endauth
                    <a href="{{ route('cart.index') }}" style="position:relative">
                        <i class="fas fa-shopping-bag"></i>
                        @if(session('cart') && count(session('cart'))>0)
                        <span class="badge-panier">{{ count(session('cart')) }}</span>
                        @endif
                    </a>
                    <button class="hamburger" id="hamburger"><span></span><span></span><span></span></button>
                </div>
            </div>
        </div>
        <div class="s-bar" id="s-bar">
            <form action="{{ route('shop.search') }}" method="GET" style="width:100%;display:flex;justify-content:center">
                <input type="text" name="q" placeholder="Rechercher un fil, un kit, une création…" value="{{ request('q') }}">
            </form>
        </div>
    </header>

    {{-- Menu mobile --}}
    <div class="m-menu" id="m-menu">
        <button class="m-close" id="m-close"><i class="fas fa-times"></i></button>
        <a href="{{ route('shop.index') }}">Boutique</a>
        <a href="{{ route('categories.index') }}">Collections</a>
        <a href="{{ route('pages.atelier') }}">L'Atelier</a>
        <a href="{{ route('pages.blog') }}">Blog</a>
        @auth
        <a href="{{ route('account.index') }}">Mon Compte</a>
        @else
        <a href="{{ route('auth.login') }}">Connexion</a>
        <a href="{{ route('auth.register') }}">Créer un compte</a>
        @endauth
        <a href="#sur-mesure">Sur Mesure</a>
    </div>

    <main>
        @if(session('success'))<div class="flash flash-ok">{{ session('success') }}</div>@endif
        @if(session('error'))<div class="flash flash-err">{{ session('error') }}</div>@endif
        @yield('content')
    </main>

    <footer>
        <div class="f-grid">
            <div class="f-brand">
                <span class="f-brand-name">JEKP</span>
                <span class="f-brand-script">Store</span>
                <div class="f-sep"></div>
                <p>Maison de création artisanale dédiée au tricot d'exception. Des fils rares, des kits exclusifs, pensés pour les femmes qui aiment créer.</p>
                <div class="f-socials">
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-pinterest"></i></a>
                    <a href="#"><i class="fab fa-facebook"></i></a>
                    <a href="#"><i class="fab fa-tiktok"></i></a>
                    <a href="https://wa.me/0153928572"><i class="fab fa-whatsapp"></i></a>
                </div>
            </div>
            <div>
                <h4>Collections</h4>
                <ul>
                    <li><a href="#">Fils & Laines</a></li>
                    <li><a href="#">Kits Signature</a></li>
                    <li><a href="#">Aiguilles</a></li>
                    <li><a href="#">Accessoires</a></li>
                    <li><a href="#">Nouveautés</a></li>
                </ul>
            </div>
            <div>
                <h4>Service Client</h4>
                <ul>
                    <li><a href="#">Livraison</a></li>
                    <li><a href="#">Retours</a></li>
                    <li><a href="#">FAQ</a></li>
                    <li><a href="#">Contact</a></li>
                    <li><a href="https://wa.me/0153928572">WhatsApp</a></li>
                </ul>
            </div>
            <div>
                <h4>À propos</h4>
                <ul>
                    <li><a href="#">Notre histoire</a></li>
                    <li><a href="{{ route('pages.blog') }}">Blog</a></li>
                    <li><a href="{{ route('pages.atelier') }}">L'Atelier</a></li>
                    <li><a href="{{ route('pages.terms') }}">CGV</a></li>
                    <li><a href="{{ route('pages.privacy') }}">Confidentialité</a></li>
                </ul>
            </div>
        </div>
        <div class="f-bas">
            <span>© {{ date('Y') }} JEKP Store — Tous droits réservés</span>
            <span class="acc">♡ Fait avec amour</span>
        </div>
    </footer>

    <script>
        window.addEventListener('scroll', () => document.getElementById('header').style.boxShadow = window.scrollY > 40 ? '0 4px 30px rgba(90,48,64,0.12)' : '0 1px 20px rgba(90,48,64,0.06)');
        document.getElementById('s-toggle').addEventListener('click', e => {
            e.preventDefault();
            document.getElementById('s-bar').classList.toggle('oui')
        });
        document.getElementById('hamburger').addEventListener('click', () => document.getElementById('m-menu').classList.add('oui'));
        document.getElementById('m-close').addEventListener('click', () => document.getElementById('m-menu').classList.remove('oui'));
    </script>
    @stack('scripts')
</body>

</html>