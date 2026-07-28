<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Administration') — JEPK</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/images/jepklogo.png') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600;700&family=Nunito:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        :root {
            --rose:    #C96880;
            --rose-dk: #A85068;
            --peach:   #E8896A;
            --lav:     #9B8EC4;
            --cream:   #FFF8F0;
            --dark:    #5A3040;   /* prune rosé — identique au footer du site */
            --dark2:   #3D2030;   /* prune foncé */
            --sidebar: 280px;
            --topbar:  64px;
        }
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Nunito', sans-serif;
            background: #FBF5F0;  /* crème doux — même tonalité que le site */
            color: #3D2B1F;
            display: flex;
            min-height: 100vh;
        }

        /* ── SIDEBAR ─────────────────────────────── */
        .sidebar {
            width: var(--sidebar);
            background: linear-gradient(175deg, var(--dark) 0%, var(--dark2) 100%);
            min-height: 100vh;
            position: fixed;
            left: 0; top: 0; bottom: 0;
            display: flex;
            flex-direction: column;
            z-index: 100;
            transition: transform .3s ease;
            box-shadow: 4px 0 24px rgba(45,27,61,.25);
        }
        .sidebar-brand {
            padding: 28px 24px;
            border-bottom: 1px solid rgba(255,255,255,.08);
            background: linear-gradient(135deg, rgba(232,160,168,.12), rgba(212,84,122,.08));
        }
        .sidebar-brand .brand-logo {
            height: 110px;
            width: auto;
            object-fit: contain;
            border-radius: 16px;
            mix-blend-mode: screen;
            filter: drop-shadow(0 0 10px rgba(212,24,90,0.8));
            display: block;
            margin-bottom: 10px;
        }
        .sidebar-brand .admin-badge {
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 2.5px;
            text-transform: uppercase;
            color: var(--peach);
            display: block;
        }

        .sidebar-nav {
            flex: 1;
            overflow-y: auto;
            padding: 18px 0;
        }
        .nav-section {
            padding: 12px 24px 6px;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: rgba(232,160,168,.5);
        }
        .nav-item {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 13px 24px;
            color: rgba(255,255,255,.6);
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: all .2s;
            border-left: 3px solid transparent;
            position: relative;
        }
        .nav-item:hover {
            color: #fff;
            background: rgba(255,255,255,.07);
        }
        .nav-item.active {
            color: #fff;
            background: linear-gradient(90deg, rgba(212,84,122,.2), rgba(155,142,196,.1));
            border-left-color: var(--rose);
        }
        .nav-item .icon {
            width: 20px;
            text-align: center;
            font-size: 16px;
            flex-shrink: 0;
        }
        .nav-badge {
            margin-left: auto;
            background: var(--rose);
            color: #fff;
            font-size: 11px;
            font-weight: 700;
            padding: 3px 8px;
            border-radius: 20px;
            min-width: 22px;
            text-align: center;
        }

        .sidebar-footer {
            border-top: 1px solid rgba(255,255,255,.08);
            padding: 18px 24px;
        }
        .sidebar-user {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 14px;
        }
        .sidebar-user .avatar {
            width: 42px;
            height: 42px;
            background: var(--rose);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            color: #fff;
            font-weight: 600;
            flex-shrink: 0;
        }
        .sidebar-user .user-info .name {
            font-size: 14px;
            font-weight: 600;
            color: #fff;
        }
        .sidebar-user .user-info .role {
            font-size: 12px;
            color: var(--rose);
        }
        .btn-view-site {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 11px 16px;
            background: rgba(255,255,255,.07);
            border-radius: 10px;
            color: rgba(255,255,255,.7);
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: all .2s;
            margin-bottom: 10px;
        }
        .btn-view-site:hover { background: rgba(255,255,255,.12); color: #fff; }
        .btn-logout {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 11px 16px;
            background: rgba(212,84,122,.1);
            border-radius: 10px;
            color: var(--rose);
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: all .2s;
            border: none;
            width: 100%;
            cursor: pointer;
        }
        .btn-logout:hover { background: rgba(212,84,122,.2); }

        /* ── MAIN ────────────────────────────────── */
        .main-wrap {
            margin-left: var(--sidebar);
            flex: 1;
            display: flex;
            flex-direction: column;
            min-width: 0;
        }

        /* ── TOPBAR ──────────────────────────────── */
        .topbar {
            height: var(--topbar);
            background: #fff;
            border-bottom: 1px solid #EDE5DC;
            display: flex;
            align-items: center;
            padding: 0 28px;
            position: sticky;
            top: 0;
            z-index: 50;
            gap: 16px;
        }
        .topbar-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: 22px;
            font-weight: 600;
            color: var(--dark);
            flex: 1;
        }
        .topbar-actions { display: flex; align-items: center; gap: 12px; }
        .topbar-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 18px;
            background: linear-gradient(135deg, var(--rose), var(--rose-dk));
            color: #fff;
            border-radius: 8px;
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
            transition: all .2s;
            border: none;
            cursor: pointer;
        }
        .topbar-btn:hover { transform: translateY(-1px); box-shadow: 0 4px 12px rgba(212,84,122,.3); color:#fff; }
        .topbar-btn.outline {
            background: transparent;
            border: 1.5px solid var(--rose);
            color: var(--rose);
        }
        .topbar-btn.outline:hover { background: var(--rose); color: #fff; }

        /* ── CONTENT ─────────────────────────────── */
        .content {
            padding: 28px;
            flex: 1;
        }

        /* ── ALERTS ──────────────────────────────── */
        .alert {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px 18px;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 20px;
        }
        .alert-success { background: #E8F8F0; color: #1A7A4A; border: 1px solid #A8E0C0; }
        .alert-error   { background: #FDECEC; color: #C0392B; border: 1px solid #F0B0B0; }
        .alert-warning { background: #FEF6E4; color: #9A6A00; border: 1px solid #F0D090; }

        /* ── CARDS ───────────────────────────────── */
        .card {
            background: #fff;
            border-radius: 14px;
            box-shadow: 0 1px 4px rgba(61,43,31,.06), 0 4px 16px rgba(61,43,31,.04);
            overflow: hidden;
        }
        .card-header {
            padding: 18px 24px;
            border-bottom: 1px solid #F0E8E0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
        }
        .card-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: 18px;
            font-weight: 600;
            color: var(--dark);
        }
        .card-body { padding: 24px; }

        /* ── STAT CARDS ──────────────────────────── */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 18px;
            margin-bottom: 28px;
        }
        .stat-card {
            background: #fff;
            border-radius: 14px;
            padding: 22px 24px;
            box-shadow: 0 1px 4px rgba(61,43,31,.06);
            display: flex;
            align-items: center;
            gap: 18px;
        }
        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            flex-shrink: 0;
        }
        .stat-icon.rose    { background: rgba(212,84,122,.12); color: var(--rose); }
        .stat-icon.peach   { background: rgba(232,137,106,.12); color: var(--peach); }
        .stat-icon.lav     { background: rgba(155,142,196,.12); color: var(--lav); }
        .stat-icon.green   { background: rgba(39,174,96,.12); color: #27AE60; }
        .stat-icon.orange  { background: rgba(243,156,18,.12); color: #F39C12; }
        .stat-value {
            font-family: 'Cormorant Garamond', serif;
            font-size: 28px;
            font-weight: 700;
            color: var(--dark);
            line-height: 1;
        }
        .stat-label {
            font-size: 12px;
            color: #9A8070;
            margin-top: 4px;
            font-weight: 500;
        }

        /* ── TABLE ───────────────────────────────── */
        .table-wrap { overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; font-size: 14px; }
        thead th {
            background: #FAF5F0;
            padding: 12px 16px;
            text-align: left;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: .8px;
            text-transform: uppercase;
            color: #9A8070;
            border-bottom: 1px solid #EDE5DC;
            white-space: nowrap;
        }
        tbody tr {
            border-bottom: 1px solid #F5EFE8;
            transition: background .15s;
        }
        tbody tr:hover { background: #FBF7F4; }
        tbody tr:last-child { border-bottom: none; }
        td { padding: 13px 16px; vertical-align: middle; }

        /* ── BADGES ──────────────────────────────── */
        .badge {
            display: inline-flex;
            align-items: center;
            padding: 3px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
            white-space: nowrap;
        }
        .badge-active   { background: #E8F8F0; color: #1A7A4A; }
        .badge-inactive { background: #F5F0EA; color: #9A8070; }
        .badge-featured { background: rgba(212,84,122,.1); color: var(--rose); }
        .badge-pub      { background: #E8F8F0; color: #1A7A4A; }
        .badge-draft    { background: #F5F0EA; color: #9A8070; }

        /* ── FORM ────────────────────────────────── */
        .form-grid { display: grid; gap: 20px; }
        .form-grid-2 { grid-template-columns: 1fr 1fr; }
        .form-grid-3 { grid-template-columns: 1fr 1fr 1fr; }
        @media (max-width: 768px) { .form-grid-2, .form-grid-3 { grid-template-columns: 1fr; } }

        .form-group { display: flex; flex-direction: column; gap: 6px; }
        .form-label {
            font-size: 12px;
            font-weight: 700;
            letter-spacing: .5px;
            text-transform: uppercase;
            color: #7A6050;
        }
        .form-control {
            padding: 10px 14px;
            border: 1.5px solid #E0D5CC;
            border-radius: 9px;
            font-family: 'Nunito', sans-serif;
            font-size: 14px;
            color: var(--dark);
            background: #fff;
            transition: border-color .2s;
            outline: none;
            width: 100%;
        }
        .form-control:focus { border-color: var(--rose); }
        textarea.form-control { resize: vertical; min-height: 100px; }
        .form-hint { font-size: 12px; color: #9A8070; }

        /* Toggle switch */
        .toggle-group { display: flex; align-items: center; gap: 10px; }
        .toggle { position: relative; display: inline-block; width: 44px; height: 24px; }
        .toggle input { opacity: 0; width: 0; height: 0; }
        .toggle-slider {
            position: absolute; inset: 0;
            background: #D0C8C0;
            border-radius: 12px;
            cursor: pointer;
            transition: .2s;
        }
        .toggle-slider::before {
            content: '';
            position: absolute;
            width: 18px; height: 18px;
            left: 3px; top: 3px;
            background: #fff;
            border-radius: 50%;
            transition: .2s;
        }
        .toggle input:checked + .toggle-slider { background: var(--rose); }
        .toggle input:checked + .toggle-slider::before { transform: translateX(20px); }
        .toggle-label { font-size: 13px; font-weight: 600; color: var(--dark); }

        /* Image upload */
        .upload-zone {
            border: 2px dashed #D0C8C0;
            border-radius: 12px;
            padding: 30px 20px;
            text-align: center;
            cursor: pointer;
            transition: all .2s;
            background: #FAF5F0;
        }
        .upload-zone:hover, .upload-zone.drag-over {
            border-color: var(--rose);
            background: rgba(212,84,122,.04);
        }
        .upload-zone .icon { font-size: 32px; color: #C0B0A8; margin-bottom: 10px; }
        .upload-zone p { font-size: 13px; color: #9A8070; }
        .upload-zone strong { color: var(--rose); }
        .upload-zone input[type=file] { display: none; }

        .image-preview-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
            gap: 10px;
            margin-top: 14px;
        }
        .image-preview-item {
            position: relative;
            aspect-ratio: 1;
            border-radius: 8px;
            overflow: hidden;
            background: #F0E8E0;
        }
        .image-preview-item img { width: 100%; height: 100%; object-fit: cover; }
        .image-preview-item .remove-img {
            position: absolute;
            top: 4px; right: 4px;
            background: rgba(0,0,0,.5);
            color: #fff;
            border: none;
            border-radius: 50%;
            width: 22px; height: 22px;
            cursor: pointer;
            font-size: 11px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background .2s;
        }
        .image-preview-item .remove-img:hover { background: var(--rose); }

        /* Actions */
        .btn-act {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 32px; height: 32px;
            border-radius: 7px;
            border: none;
            cursor: pointer;
            text-decoration: none;
            font-size: 13px;
            transition: all .2s;
        }
        .btn-act.edit  { background: rgba(155,142,196,.15); color: var(--lav); }
        .btn-act.del   { background: rgba(212,84,122,.12); color: var(--rose); }
        .btn-act.view  { background: rgba(74,144,217,.12); color: #4A90D9; }
        .btn-act:hover { transform: scale(1.1); }

        /* Product thumbnail */
        .prod-thumb {
            width: 44px; height: 44px;
            border-radius: 8px;
            object-fit: cover;
            background: #F0E8E0;
        }

        /* Pagination */
        .pagination { display: flex; gap: 6px; align-items: center; margin-top: 20px; }
        .pagination a, .pagination span {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 36px; height: 36px;
            padding: 0 10px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            transition: all .2s;
        }
        .pagination a { background: #fff; color: var(--dark); border: 1.5px solid #E0D5CC; }
        .pagination a:hover { border-color: var(--rose); color: var(--rose); }
        .pagination span.active { background: var(--rose); color: #fff; border: 1.5px solid var(--rose); }
        .pagination span.disabled { color: #C0B0A8; }

        /* Search bar */
        .search-bar {
            display: flex;
            gap: 10px;
            align-items: center;
            flex-wrap: wrap;
        }
        .search-input-wrap {
            position: relative;
            flex: 1;
            min-width: 200px;
        }
        .search-input-wrap i {
            position: absolute;
            left: 12px; top: 50%;
            transform: translateY(-50%);
            color: #B0A098;
            font-size: 13px;
        }
        .search-input-wrap input {
            padding-left: 36px;
        }

        /* Status dot */
        .status-dot {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 13px;
            font-weight: 500;
        }
        .status-dot::before {
            content: '';
            width: 8px; height: 8px;
            border-radius: 50%;
            background: currentColor;
            flex-shrink: 0;
        }

        /* Responsive */
        .mobile-menu-btn {
            display: none;
            background: none;
            border: none;
            font-size: 20px;
            color: var(--dark);
            cursor: pointer;
            padding: 4px;
        }
        @media (max-width: 900px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.open { transform: translateX(0); }
            .main-wrap { margin-left: 0; }
            .mobile-menu-btn { display: block; }
            .form-grid-2, .form-grid-3 { grid-template-columns: 1fr; }
        }

        /* Overlay */
        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,.4);
            z-index: 99;
        }
        .sidebar-overlay.show { display: block; }
    </style>
    @stack('styles')
</head>
<body>

<div class="sidebar-overlay" id="sidebarOverlay" onclick="toggleSidebar()"></div>

<!-- ── SIDEBAR ───────────────────────────────────────── -->
<aside class="sidebar" id="sidebar">
    <div class="sidebar-brand">
        <img src="{{ asset('assets/images/jepklogo.png') }}" alt="JEPK" class="brand-logo">
        <span class="admin-badge">Administration</span>
    </div>

    <nav class="sidebar-nav">
        <span class="nav-section">Principal</span>
        <a href="{{ route('admin.dashboard') }}" class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="fa-solid fa-chart-line icon"></i> Tableau de bord
        </a>

        <span class="nav-section">Catalogue</span>
        <a href="{{ route('admin.produits.index') }}" class="nav-item {{ request()->routeIs('admin.produits.*') ? 'active' : '' }}">
            <i class="fa-solid fa-box-open icon"></i> Produits
        </a>
        <a href="{{ route('admin.categories.index') }}" class="nav-item {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
            <i class="fa-solid fa-tags icon"></i> Catégories
        </a>

        <span class="nav-section">Ventes</span>
        <a href="{{ route('admin.orders.index') }}" class="nav-item {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
            <i class="fa-solid fa-shopping-bag icon"></i> Commandes
        </a>
        <a href="{{ route('admin.custom-orders.index') }}" class="nav-item {{ request()->routeIs('admin.custom-orders.*') ? 'active' : '' }}">
            <i class="fa-solid fa-wand-magic-sparkles icon"></i> Demandes sur mesure
            @php $nbNouvelles = \App\Models\CustomOrder::where('status', 'nouveau')->count(); @endphp
            @if($nbNouvelles > 0)
                <span style="margin-left:auto;background:#E8896A;color:#fff;font-size:11px;font-weight:700;padding:2px 8px;border-radius:20px">{{ $nbNouvelles }}</span>
            @endif
        </a>

        <span class="nav-section">Contenu</span>
        <a href="{{ route('admin.carrousel.index') }}" class="nav-item {{ request()->routeIs('admin.carrousel.*') ? 'active' : '' }}">
            <i class="fa-solid fa-sliders icon"></i> Carrousel
        </a>
        <a href="{{ route('admin.blog.index') }}" class="nav-item {{ request()->routeIs('admin.blog.*') ? 'active' : '' }}">
            <i class="fa-solid fa-newspaper icon"></i> Blog
        </a>
        <a href="{{ route('admin.media.index') }}" class="nav-item {{ request()->routeIs('admin.media.*') ? 'active' : '' }}">
            <i class="fa-solid fa-images icon"></i> Médiathèque
        </a>

        <span class="nav-section">Utilisateurs</span>
        <a href="{{ route('admin.users.index') }}" class="nav-item {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
            <i class="fa-solid fa-users icon"></i> Clients
        </a>
        <a href="{{ route('admin.team.index') }}" class="nav-item {{ request()->routeIs('admin.team.*') ? 'active' : '' }}">
            <i class="fa-solid fa-user-shield icon"></i> Équipe admin
        </a>
    </nav>

    <div class="sidebar-footer">
        <div class="sidebar-user">
            <div class="avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
            <div class="user-info">
                <div class="name">{{ auth()->user()->name }}</div>
                <div class="role">Administrateur</div>
            </div>
        </div>
        <a href="{{ route('home') }}" target="_blank" class="btn-view-site">
            <i class="fa-solid fa-arrow-up-right-from-square"></i> Voir le site
        </a>
        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button type="submit" class="btn-logout">
                <i class="fa-solid fa-right-from-bracket"></i> Déconnexion
            </button>
        </form>
    </div>
</aside>

<!-- ── MAIN ──────────────────────────────────────────── -->
<div class="main-wrap">
    <header class="topbar">
        <button class="mobile-menu-btn" onclick="toggleSidebar()">
            <i class="fa-solid fa-bars"></i>
        </button>
        <h1 class="topbar-title">@yield('title', 'Tableau de bord')</h1>
        <div class="topbar-actions">
            @yield('topbar-actions')
        </div>
    </header>

    <main class="content">
        @if(session('success'))
            <div class="alert alert-success">
                <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-error">
                <i class="fa-solid fa-circle-xmark"></i> {{ session('error') }}
            </div>
        @endif
        @if($errors->any())
            <div class="alert alert-error">
                <i class="fa-solid fa-triangle-exclamation"></i>
                <div>
                    @foreach($errors->all() as $err)
                        <div>{{ $err }}</div>
                    @endforeach
                </div>
            </div>
        @endif

        @yield('content')
    </main>
</div>

<script>
function toggleSidebar() {
    document.getElementById('sidebar').classList.toggle('open');
    document.getElementById('sidebarOverlay').classList.toggle('show');
}
</script>
@stack('scripts')
</body>
</html>
