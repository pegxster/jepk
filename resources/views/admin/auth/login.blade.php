<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration — JEPK</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/images/jepklogo.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,300;1,400&family=Nunito:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --rose:    #C96880;
            --rose-dk: #A85068;
            --peach:   #f4b0cc;
            --lav:     #cdb0ec;
            --cream:   #fff8fb;
            --creme2:  #fef0f5;
            --dark:    #5a3040;
            --dark2:   #3c1e2c;
        }

        body {
            font-family: 'Nunito', sans-serif;
            min-height: 100vh;
            display: flex;
            background: var(--dark2);
        }

        /* ── Panneau gauche ── */
        .panel-left {
            flex: 1;
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 60px 48px;
            background: linear-gradient(160deg, var(--dark2) 0%, var(--dark) 40%, #7a4060 80%, var(--rose-dk) 100%);
        }
        .panel-left::before {
            content: '';
            position: absolute;
            inset: 0;
            background:
                radial-gradient(ellipse at 25% 55%, rgba(201,104,128,.25) 0%, transparent 55%),
                radial-gradient(ellipse at 75% 20%, rgba(205,176,236,.15) 0%, transparent 50%),
                radial-gradient(ellipse at 50% 90%, rgba(168,80,104,.2) 0%, transparent 50%);
            pointer-events: none;
        }

        /* Cercles décoratifs */
        .deco-circle {
            position: absolute;
            border-radius: 50%;
            pointer-events: none;
        }
        .deco-circle.c1 {
            width: 260px; height: 260px;
            bottom: 5%; left: -60px;
            border: 1px solid rgba(201,104,128,.2);
        }
        .deco-circle.c2 {
            width: 160px; height: 160px;
            top: 10%; right: -40px;
            border: 1px solid rgba(205,176,236,.15);
        }
        .deco-circle.c3 {
            width: 80px; height: 80px;
            top: 55%; left: 12%;
            background: rgba(201,104,128,.07);
        }

        /* ── LOGO ── */
        .brand-block {
            position: relative;
            z-index: 1;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0;
        }
        .brand-logo-img {
            height: 220px;
            width: auto;
            object-fit: contain;
            border-radius: 24px;
            mix-blend-mode: screen;
            filter: drop-shadow(0 0 24px rgba(201,104,128,.6)) drop-shadow(0 0 60px rgba(201,104,128,.3));
            display: block;
            transition: filter .4s;
        }
        .brand-logo-img:hover {
            filter: drop-shadow(0 0 32px rgba(201,104,128,.9)) drop-shadow(0 0 80px rgba(201,104,128,.4));
        }
        .brand-tagline {
            font-family: 'Cormorant Garamond', serif;
            font-size: 13px;
            font-weight: 300;
            letter-spacing: 6px;
            text-transform: uppercase;
            color: rgba(244,176,204,.7);
            display: block;
            margin-top: 16px;
            margin-bottom: 40px;
        }
        .brand-sep {
            width: 50px;
            height: 1px;
            background: linear-gradient(to right, transparent, rgba(201,104,128,.5), transparent);
            margin: 0 auto 40px;
        }

        /* Liste fonctionnalités */
        .feature-list {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 16px;
            text-align: left;
            max-width: 280px;
        }
        .feature-list li {
            display: flex;
            align-items: center;
            gap: 14px;
            color: rgba(255,255,255,.6);
            font-size: 13.5px;
            font-weight: 300;
        }
        .feature-list li .icon {
            width: 36px; height: 36px;
            background: rgba(201,104,128,.15);
            border-radius: 10px;
            border: 1px solid rgba(201,104,128,.2);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--peach);
            font-size: 14px;
            flex-shrink: 0;
        }

        /* ── Panneau droit (formulaire) ── */
        .panel-right {
            width: 480px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 48px 44px;
            background: var(--cream);
            position: relative;
        }
        .panel-right::before {
            content: '';
            position: absolute;
            top: 0; left: 0; width: 100%; height: 5px;
            background: linear-gradient(90deg, var(--dark), var(--rose), var(--lav));
        }

        .login-box {
            width: 100%;
            max-width: 380px;
        }

        /* En-tête formulaire */
        .login-header {
            text-align: center;
            margin-bottom: 36px;
        }
        .badge-admin {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(201,104,128,.1);
            color: var(--rose);
            border: 1px solid rgba(201,104,128,.25);
            padding: 5px 16px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            margin-bottom: 22px;
        }
        .login-header h1 {
            font-family: 'Cormorant Garamond', serif;
            font-size: 32px;
            font-weight: 600;
            color: var(--dark2);
            line-height: 1.25;
            margin-bottom: 8px;
        }
        .login-header p {
            font-size: 13.5px;
            color: #9a7080;
        }

        /* Alertes */
        .alert-error {
            background: #fdecec;
            border: 1px solid #f0b0b0;
            color: #c0392b;
            padding: 12px 16px;
            border-radius: 10px;
            font-size: 13px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        /* Formulaire */
        .form-group { margin-bottom: 18px; }
        .form-label {
            display: block;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: .8px;
            text-transform: uppercase;
            color: #7a5060;
            margin-bottom: 7px;
        }
        .input-wrap { position: relative; }
        .input-wrap .input-icon {
            position: absolute;
            left: 14px; top: 50%;
            transform: translateY(-50%);
            color: #c0a0b0;
            font-size: 14px;
            pointer-events: none;
        }
        .form-control {
            width: 100%;
            padding: 12px 14px 12px 42px;
            border: 1.5px solid #e8d0d8;
            border-radius: 10px;
            font-family: 'Nunito', sans-serif;
            font-size: 14px;
            color: var(--dark2);
            background: #fffafc;
            outline: none;
            transition: border-color .2s, box-shadow .2s;
        }
        .form-control:focus {
            border-color: var(--rose);
            box-shadow: 0 0 0 3px rgba(201,104,128,.12);
            background: #fff;
        }
        .form-control.is-invalid { border-color: #e74c3c; }

        .toggle-pw {
            position: absolute;
            right: 14px; top: 50%;
            transform: translateY(-50%);
            background: none; border: none;
            cursor: pointer;
            color: #c0a0b0;
            font-size: 14px; padding: 2px;
            transition: color .2s;
        }
        .toggle-pw:hover { color: var(--rose); }

        .remember-row {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 26px;
        }
        .remember-row input[type=checkbox] {
            width: 16px; height: 16px;
            accent-color: var(--rose);
        }
        .remember-row label {
            font-size: 13px;
            color: #9a7080;
            cursor: pointer;
        }

        .btn-login {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, var(--rose), var(--rose-dk));
            color: #fff;
            border: none;
            border-radius: 10px;
            font-family: 'Nunito', sans-serif;
            font-size: 15px;
            font-weight: 700;
            letter-spacing: .5px;
            cursor: pointer;
            transition: all .25s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            box-shadow: 0 4px 18px rgba(201,104,128,.3);
        }
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 28px rgba(201,104,128,.45);
        }
        .btn-login:active { transform: translateY(0); }

        .back-link {
            display: block;
            text-align: center;
            margin-top: 24px;
            font-size: 13px;
            color: #9a7080;
            text-decoration: none;
            transition: color .2s;
        }
        .back-link:hover { color: var(--rose); }
        .back-link i { margin-right: 4px; }

        /* Responsive */
        @media (max-width: 860px) {
            .panel-left { display: none; }
            .panel-right { width: 100%; }
            .panel-right::before { height: 4px; }
        }
    </style>
</head>
<body>

<!-- ── Panneau gauche décoratif ── -->
<div class="panel-left">
    <div class="deco-circle c1"></div>
    <div class="deco-circle c2"></div>
    <div class="deco-circle c3"></div>

    <div class="brand-block">
        <img
            src="{{ asset('assets/images/jepklogo.png') }}"
            alt="JEPK"
            class="brand-logo-img"
        >
        <span class="brand-tagline">Créations Artisanales au Crochet</span>
        <div class="brand-sep"></div>

        <ul class="feature-list">
            <li>
                <div class="icon"><i class="fa-solid fa-box-open"></i></div>
                Gérez vos produits et collections
            </li>
            <li>
                <div class="icon"><i class="fa-solid fa-tags"></i></div>
                Organisez vos catégories
            </li>
            <li>
                <div class="icon"><i class="fa-solid fa-shopping-bag"></i></div>
                Suivez vos commandes
            </li>
            <li>
                <div class="icon"><i class="fa-solid fa-images"></i></div>
                Gérez votre médiathèque
            </li>
        </ul>
    </div>
</div>

<!-- ── Formulaire de connexion ── -->
<div class="panel-right">
    <div class="login-box">
        <div class="login-header">
            <div class="badge-admin">
                <i class="fa-solid fa-shield-halved"></i> Espace Admin
            </div>
            <h1>Bonne journée,<br><em style="font-style:italic;color:var(--rose)">administratrice</em></h1>
            <p>Connectez-vous à votre tableau de bord</p>
        </div>

        @if(session('error'))
        <div class="alert-error">
            <i class="fa-solid fa-circle-xmark"></i> {{ session('error') }}
        </div>
        @endif

        @if($errors->any())
        <div class="alert-error">
            <i class="fa-solid fa-circle-xmark"></i> {{ $errors->first() }}
        </div>
        @endif

        <form method="POST" action="{{ route('admin.login.post') }}">
            @csrf
            <div class="form-group">
                <label class="form-label">Adresse email</label>
                <div class="input-wrap">
                    <i class="fa-solid fa-envelope input-icon"></i>
                    <input
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                        placeholder="admin@jepk.com"
                        required
                        autofocus
                    >
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Mot de passe</label>
                <div class="input-wrap">
                    <i class="fa-solid fa-lock input-icon"></i>
                    <input
                        type="password"
                        name="password"
                        id="passwordInput"
                        class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                        placeholder="••••••••"
                        required
                    >
                    <button type="button" class="toggle-pw" onclick="togglePassword()">
                        <i class="fa-solid fa-eye" id="pwIcon"></i>
                    </button>
                </div>
            </div>

            <div class="remember-row">
                <input type="checkbox" name="remember" id="remember">
                <label for="remember">Rester connectée</label>
            </div>

            <button type="submit" class="btn-login">
                <i class="fa-solid fa-arrow-right-to-bracket"></i>
                Accéder au dashboard
            </button>
        </form>

        <a href="{{ route('home') }}" class="back-link">
            <i class="fa-solid fa-arrow-left"></i> Retour au site
        </a>
    </div>
</div>

<script>
function togglePassword() {
    const input = document.getElementById('passwordInput');
    const icon  = document.getElementById('pwIcon');
    if (input.type === 'password') {
        input.type = 'text';
        icon.className = 'fa-solid fa-eye-slash';
    } else {
        input.type = 'password';
        icon.className = 'fa-solid fa-eye';
    }
}
</script>
</body>
</html>
