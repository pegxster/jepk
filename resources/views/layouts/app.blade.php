<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="x-auth" content="{{ auth()->check() ? '1' : '0' }}">
    <title>@yield('title', 'JEKP Store — Créations Artisanales')</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/images/jepklogo.png') }}">
    <link rel="shortcut icon" href="{{ asset('assets/images/jepklogo.png') }}">
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
            /* ── Palette Tendre · inspirée du logo Jepk rose doux ── */
            --blanc:   #ffffff;
            --creme:   #fff8fb;   /* blanc rosé ultra doux */
            --creme2:  #fef0f5;   /* crème rosée */
            --peche:   #fde8f2;   /* rose blush très clair */
            --peche2:  #f9cce0;   /* rose blush accent */
            --rose-p:  #f4b0cc;   /* rose poudré */
            --rose-v:  #C96880;   /* rose tendre — accent principal */
            --rose-f:  #A85068;   /* rose foncé hover */
            --lavande: #eedcf8;   /* lavande très douce */
            --lavande2:#cdb0ec;   /* lavande accent */
            --nude:    #f5e0ea;   /* nude rosé */
            --beige:   #faecf2;   /* beige rosé */
            --brun-d:  #5a3040;   /* prune foncé footer */
            --brun-2:  #7a4860;   /* prune moyen */
            --texte:   #3c1e2c;   /* texte foncé */
            --texte2:  #8c6070;   /* texte secondaire */
            --gris:    #fcf0f6;   /* gris rosé */

            --f-titre: 'Cormorant Garamond', Georgia, serif;
            --f-script: 'Alex Brush', cursive;
            --f-corps: 'Nunito', sans-serif;

            --ombre:    0 8px 40px rgba(201, 104, 128, 0.11);
            --ombre-sm: 0 2px 16px rgba(201, 104, 128, 0.07);
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

        img {
            image-rendering: -webkit-optimize-contrast;
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
            box-shadow: 0 4px 20px rgba(201, 104, 128, 0.32)
        }

        .btn-rose:hover {
            background: var(--rose-f);
            transform: translateY(-2px);
            box-shadow: 0 8px 28px rgba(201, 104, 128, 0.42)
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
            padding: 14px 20px;
            font-size: 13px;
            margin: 14px 50px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        @media(max-width:900px) {
            .flash {
                margin: 10px 16px;
                font-size: 12px;
                padding: 12px 16px;
            }
        }

        .flash-ok {
            background: #fdf5f7;
            color: var(--rose-f);
            border-left: 4px solid var(--rose-p);
            box-shadow: 0 2px 12px rgba(201, 104, 128, .08);
        }

        .flash-err {
            background: #fff5f5;
            color: #9b3535;
            border-left: 4px solid #f0a0a0;
            box-shadow: 0 2px 12px rgba(155, 53, 53, .08);
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
            background: rgba(255, 248, 251, 0.98);
            border-bottom: 1px solid var(--peche2);
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
            height: 128px;
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
            color: var(--rose-v);
            font-size: 10px;
            letter-spacing: 2.5px;
            text-transform: uppercase;
            font-weight: 600;
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
            color: var(--rose-f)
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
            align-items: center;
        }

        .logo-img {
            height: 140px;
            width: auto;
            object-fit: contain;
            border-radius: 18px;
        }

        /* Icônes */
        .h-icons {
            display: flex;
            align-items: center;
            gap: 18px
        }

        .h-icons a {
            color: var(--rose-v);
            text-decoration: none;
            font-size: 17px;
            transition: color 0.3s;
            position: relative
        }

        .h-icons a:hover {
            color: var(--rose-f)
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
    padding: 8px;
    border-radius: 10px;
    transition: background .3s;
}
.hamburger:hover {
    background: var(--peche);
}

.hamburger span {
    width: 22px;
    height: 2px;
    background: var(--texte);
    display: block;
    transition: 0.3s;
    border-radius: 2px;
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
            z-index: 950;
            background: var(--creme);
            flex-direction: column;
            padding: 100px 40px 40px;
            gap: 4px;
            overflow-y: auto;
            -webkit-overflow-scrolling: touch;
        }

        .m-menu.oui {
            display: flex;
            animation: menuSlideIn .3s ease;
        }
        @keyframes menuSlideIn {
            from { opacity: 0; transform: translateY(-12px); }
            to { opacity: 1; transform: translateY(0); }
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

        .m-menu a:hover,
        .m-menu a:active {
            color: var(--rose-v)
        }

.m-close {
    position: absolute;
    top: 28px;
    right: 36px;
    background: var(--blanc);
    border: 2px solid var(--peche2);
    font-size: 22px;
    color: var(--texte);
    cursor: pointer;
    width: 48px;
    height: 48px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 960;
    box-shadow: 0 2px 12px rgba(90,48,64,.12);
    transition: var(--trans);
}
.m-close:hover {
    background: var(--rose-v);
    color: var(--blanc);
    border-color: var(--rose-v);
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
            box-shadow: 0 4px 20px rgba(201, 104, 128, 0.4);
            transition: var(--trans);
        }

        .wa-float:hover {
            background: var(--rose-f);
            transform: scale(1.08);
            box-shadow: 0 6px 28px rgba(201, 104, 128, 0.55)
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

        .f-logo-img {
            height: 120px;
            width: auto;
            object-fit: contain;
            display: block;
            margin-bottom: 14px;
            border-radius: 16px;
            filter: drop-shadow(0 0 14px rgba(201, 104, 128, 0.55)) brightness(1.05);
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
                gap: 24px
            }

            footer {
                padding: 40px 16px 18px
            }

            .f-bas {
                flex-direction: column;
                gap: 8px;
                text-align: center
            }

            .f-logo-img {
                height: 80px;
            }

            .f-brand-name {
                font-size: 18px;
                letter-spacing: 4px;
            }
        }

        /* ── RESPONSIVE GLOBAL ── */
        @media(max-width:900px) {

            .nav-g,
            .nav-d .nav-a {
                display: none
            }

            .hamburger {
                display: flex
            }

            .h-inner {
                grid-template-columns: auto 1fr;
                padding: 0 20px;
                height: 100px;
            }

            .logo {
                grid-column: 1;
            }

            .logo-img {
                height: 110px;
            }

            .nav-d {
                width: 100%;
            }

            .h-icons {
                flex: 1;
                width: 100%;
                justify-content: space-between;
                gap: 6px;
            }

            .h-icons a {
                font-size: 24px;
                flex: 1 1 0;
                min-width: 0;
                max-width: 50px;
                height: 50px;
                display: flex;
                align-items: center;
                justify-content: center;
                background: var(--creme2);
                border-radius: 14px;
                border: 1px solid var(--peche);
            }

            .h-icons a:hover {
                background: var(--rose-v);
                color: var(--blanc);
            }

            .hamburger {
                flex: 1 1 0;
                min-width: 0;
                max-width: 50px;
                height: 50px;
                align-items: center;
                justify-content: center;
                background: var(--creme2);
                border-radius: 14px;
                border: 1px solid var(--peche);
            }

            .hamburger span {
                width: 24px;
            }

            .badge-panier {
                width: 20px;
                height: 20px;
                font-size: 10px;
                top: -6px;
                right: -6px;
            }

            .ann-bar {
                font-size: 9.5px;
                letter-spacing: 1.5px;
                padding: 9px 10px;
                white-space: nowrap;
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
                scrollbar-width: none;
            }

            .ann-bar::-webkit-scrollbar {
                display: none;
            }

            .s-bar {
                padding: 12px 20px;
            }

            .wa-float {
                bottom: 20px;
                right: 16px;
                width: 48px;
                height: 48px;
                font-size: 20px;
            }

            .wa-tip {
                display: none;
            }

            footer {
                padding: 40px 16px 18px;
            }

            .f-brand p {
                max-width: 100%;
            }

            .f-socials a {
                width: 38px;
                height: 38px;
                font-size: 16px;
            }
        }
        /* ── MOBILE : Grande nav avec items larges ── */
        @media(max-width:900px) {
            .m-menu {
                padding: 90px 20px 30px;
                gap: 10px;
                justify-content: flex-start;
            }

            .m-menu a {
                display: flex;
                align-items: center;
                justify-content: flex-start;
                width: 100%;
                font-size: 20px;
                padding: 20px 24px;
                border-radius: 16px;
                border-bottom: none;
                background: var(--creme2);
                border: 1.5px solid var(--peche);
                text-align: left;
                transition: all 0.3s;
                letter-spacing: 1px;
            }

            .m-menu a i {
                font-size: 20px;
                width: 28px;
                text-align: center;
                margin-right: 14px;
                flex-shrink: 0;
            }

            .m-menu a:hover {
                background: var(--rose-v);
                color: var(--blanc);
                border-color: var(--rose-v);
                transform: scale(1.02);
                box-shadow: 0 4px 18px rgba(201, 104, 128, 0.3);
            }

            .m-close {
                top: 22px;
                right: 20px;
                font-size: 20px;
                width: 44px;
                height: 44px;
            }
        }

        /* ================================================================
   MODAL AUTH INVITÉ
   ================================================================ */
        .auth-mo-overlay {
            position: fixed;
            inset: 0;
            z-index: 9999;
            background: rgba(58, 28, 42, 0.55);
            backdrop-filter: blur(8px);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            animation: moFadeIn .25s ease;
        }

        @keyframes moFadeIn {
            from {
                opacity: 0
            }

            to {
                opacity: 1
            }
        }

        .auth-mo-card {
            background: var(--blanc);
            border-radius: 24px;
            padding: 48px 44px 40px;
            width: 100%;
            max-width: 420px;
            box-shadow: 0 32px 80px rgba(90, 48, 64, 0.28);
            position: relative;
            border: 1px solid var(--peche);
            animation: moSlideUp .3s cubic-bezier(0.34,1.56,0.64,1);
        }

        @keyframes moSlideUp {
            from {
                opacity: 0;
                transform: translateY(30px) scale(.97)
            }

            to {
                opacity: 1;
                transform: translateY(0) scale(1)
            }
        }

        .auth-mo-close {
            position: absolute;
            top: 16px;
            right: 16px;
            background: var(--creme2);
            border: none;
            font-size: 14px;
            color: var(--texte2);
            cursor: pointer;
            width: 34px;
            height: 34px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: var(--trans);
        }

        .auth-mo-close:hover {
            background: var(--peche);
            color: var(--rose-v)
        }

        .auth-mo-btns {
            display: flex;
            flex-direction: column;
            gap: 12px;
            margin-top: 28px
        }

        .auth-mo-btns .btn {
            justify-content: center;
            width: 100%
        }

        /* ================================================================
   FOOTER — PAIEMENTS
   ================================================================ */
        .f-pay {
            max-width: 1360px;
            margin: 30px auto 0;
            padding: 24px 0 26px;
            border-top: 1px solid rgba(255, 255, 255, 0.07);
            display: flex;
            align-items: center;
            gap: 20px;
            flex-wrap: wrap;
        }

        .f-pay-label {
            font-size: 9px;
            letter-spacing: 2.5px;
            text-transform: uppercase;
            color: rgba(255, 255, 255, 0.3);
            white-space: nowrap;
        }

        .f-pay-badges {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            align-items: center;
        }

        .pay-badge {
            display: flex;
            align-items: center;
            gap: 7px;
            padding: 7px 14px;
            border-radius: 10px;
            font-family: var(--f-corps);
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.3px;
            line-height: 1;
        }

        .pay-badge svg {
            flex-shrink: 0
        }

        @media(max-width:700px) {
            .f-pay {
                flex-direction: column;
                align-items: flex-start;
                gap: 12px
            }
        }

        /* ================================================================
   PAGINATION — partagée entre boutique / catégories / commandes
   ================================================================ */
        .pagination {
            display: flex;
            flex-wrap: wrap;
            gap: 7px;
            justify-content: center;
            align-items: center;
            margin-top: 40px;
        }

        .page-btn {
            min-width: 40px;
            height: 40px;
            padding: 0 12px;
            border: 1.5px solid var(--peche);
            background: var(--blanc);
            border-radius: 10px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-family: var(--f-corps);
            font-size: 13px;
            color: var(--texte2);
            cursor: pointer;
            transition: var(--trans);
            text-decoration: none;
            box-shadow: var(--ombre-sm);
        }

        .page-btn.on,
        .page-btn:hover {
            background: var(--rose-v);
            border-color: var(--rose-v);
            color: var(--blanc);
            box-shadow: 0 4px 14px rgba(201, 112, 128, .35);
        }

        .page-btn.dis {
            opacity: .4;
            cursor: default;
            box-shadow: none;
        }

        .page-btn.dis:hover {
            background: var(--blanc);
            border-color: var(--peche);
            color: var(--texte2);
        }

        @media(max-width:500px) {
            .page-btn {
                min-width: 34px;
                height: 34px;
                font-size: 12px;
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
    <div class="ann-bar">✦ Fait main, avec amour, en Côte d'Ivoire &nbsp;·&nbsp; Livraison offerte dès 70 000 F CFA &nbsp;·&nbsp; Sur-mesure disponible ✦</div>

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
                    <a href="#" id="guest-user-icon" title="Se connecter ou créer un compte"><i class="far fa-user"></i></a>
                    @endauth
                    <a href="{{ route('cart.index') }}" id="cart-icon-link" style="position:relative">
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
        <a href="{{ route('home') }}"><i class="fas fa-home" style="margin-right:10px"></i> Accueil</a>
        <a href="{{ route('shop.index') }}"><i class="fas fa-shopping-bag" style="margin-right:10px"></i> Boutique</a>
        <a href="{{ route('categories.index') }}"><i class="fas fa-th-large" style="margin-right:10px"></i> Collections</a>
        <a href="{{ route('pages.atelier') }}"><i class="fas fa-palette" style="margin-right:10px"></i> L'Atelier</a>
        <a href="{{ route('pages.blog') }}"><i class="fas fa-feather-alt" style="margin-right:10px"></i> Blog</a>
        <a href="#sur-mesure"><i class="fas fa-cut" style="margin-right:10px"></i> Sur Mesure</a>
        @auth
        <a href="{{ route('account.index') }}"><i class="fas fa-user-circle" style="margin-right:10px"></i> Mon Compte</a>
        @else
        <a href="{{ route('auth.login') }}"><i class="fas fa-sign-in-alt" style="margin-right:10px"></i> Connexion</a>
        <a href="{{ route('auth.register') }}"><i class="fas fa-user-plus" style="margin-right:10px"></i> Créer un compte</a>
        @endauth
    </div>

    <main>
        @if(session('success'))
            <div class="flash flash-ok"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="flash flash-err"><i class="fas fa-exclamation-circle"></i> {{ session('error') }}</div>
        @endif
        @if(session('info'))
            <div class="flash flash-ok"><i class="fas fa-info-circle"></i> {{ session('info') }}</div>
        @endif
        @yield('content')
    </main>

    <footer>
        <div class="f-grid">
            <div class="f-brand">
                <img src="{{ asset('assets/images/jepklogo.png') }}" alt="JEKP Store" class="f-logo-img">
                <div class="f-sep"></div>
                <p>Maison de création artisanale dédiée au crochet d'exception. Des fils rares, des créations exclusives, pensées pour les femmes qui aiment créer.</p>
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
                    <li><a href="{{ route('pages.faq') }}">FAQ</a></li>
                    <li><a href="#">Contact</a></li>
                    <li><a href="https://wa.me/0153928572">WhatsApp</a></li>
                </ul>
            </div>
            <div>
                <h4>À propos</h4>
                <ul>
                    <li><a href="{{ route('pages.blog') }}">Blog</a></li>
                    <li><a href="{{ route('pages.atelier') }}">L'Atelier</a></li>
                    <li><a href="{{ route('pages.terms') }}">CGV</a></li>
                </ul>
            </div>
        </div>
        <div class="f-bas">
            <span>© {{ date('Y') }} JEKP Store — Tous droits réservés</span>
            <span class="acc">♡ Fait avec amour</span>
        </div>
    </footer>

    {{-- Modal connexion invité --}}
    <div id="auth-modal" class="auth-mo-overlay" style="display:none" role="dialog" aria-modal="true" aria-label="Connexion requise">
        <div class="auth-mo-card">
            <button class="auth-mo-close" id="auth-modal-close" aria-label="Fermer"><i class="fas fa-times"></i></button>
            <div style="text-align:center">
                <img src="{{ asset('assets/images/jepklogo.png') }}" alt="JEKP" style="height:72px;object-fit:contain;margin-bottom:16px;border-radius:12px;mix-blend-mode:multiply">
                <h3 style="font-family:var(--f-titre);font-size:26px;font-weight:300;color:var(--texte);margin-bottom:8px">Espace réservé aux membres</h3>
                <p style="font-size:13px;color:var(--texte2);line-height:1.75;max-width:320px;margin:0 auto">Connectez-vous ou créez un compte gratuit pour ajouter des articles à votre panier et passer commande.</p>
            </div>
            <div class="auth-mo-btns">
                <a href="{{ route('auth.login') }}" class="btn btn-rose">
                    <i class="fas fa-sign-in-alt"></i> Se connecter
                </a>
                <a href="{{ route('auth.register') }}" class="btn btn-outline-rose">
                    <i class="fas fa-user-plus"></i> Créer un compte gratuit
                </a>
            </div>
            <p style="text-align:center;font-size:11px;color:var(--texte2);margin-top:18px;letter-spacing:0.5px">
                <i class="fas fa-lock" style="font-size:9px;margin-right:4px"></i>
                Inscription gratuite · Paiement Wave (+225) & À la livraison
            </p>
        </div>
    </div>

    @if(session('needs_auth'))<span id="x-open-auth-modal" hidden></span>@endif

    <script>
        window.addEventListener('scroll', function() {
            document.getElementById('header').style.boxShadow = window.scrollY > 40
                ? '0 4px 30px rgba(90,48,64,0.12)'
                : '0 1px 20px rgba(90,48,64,0.06)';
        });
        document.getElementById('s-toggle').addEventListener('click', function(e) {
            e.preventDefault();
            document.getElementById('s-bar').classList.toggle('oui');
        });
        document.getElementById('hamburger').addEventListener('click', function() {
            document.getElementById('m-menu').classList.add('oui');
        });
        document.getElementById('m-close').addEventListener('click', function() {
            document.getElementById('m-menu').classList.remove('oui');
        });

        // ── Modal auth ──
        // L'état auth vient d'une <meta> côté HTML, pas d'une directive Blade dans le JS
        var authMeta = document.querySelector('meta[name="x-auth"]');
        window.JEPK_AUTH = authMeta ? authMeta.getAttribute('content') === '1' : false;

        function showAuthModal() {
            document.getElementById('auth-modal').style.display = 'flex';
            document.body.style.overflow = 'hidden';
        }
        function hideAuthModal() {
            document.getElementById('auth-modal').style.display = 'none';
            document.body.style.overflow = '';
        }

        document.getElementById('auth-modal-close').addEventListener('click', hideAuthModal);
        document.getElementById('auth-modal').addEventListener('click', function(e) {
            if (e.target === this) hideAuthModal();
        });
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') hideAuthModal();
        });

        if (!window.JEPK_AUTH) {
            // Icônes panier et utilisateur → modal pour les invités
            ['cart-icon-link', 'guest-user-icon'].forEach(function(id) {
                var el = document.getElementById(id);
                if (el) el.addEventListener('click', function(e) {
                    e.preventDefault();
                    showAuthModal();
                });
            });

            // Intercepter les formulaires "ajouter au panier"
            document.addEventListener('submit', function(e) {
                if (e.target.querySelector('input[name="product_id"]')) {
                    e.preventDefault();
                    showAuthModal();
                }
            }, true);
        }

        // Ouvrir la modal si la session l'indique (redirect depuis CartController)
        if (document.getElementById('x-open-auth-modal')) {
            showAuthModal();
        }
    </script>
    @stack('scripts')
</body>

</html>