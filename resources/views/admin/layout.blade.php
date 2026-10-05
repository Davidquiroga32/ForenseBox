<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') — ForenseBox</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Chivo:wght@400;600;800&family=JetBrains+Mono:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --lab-deep: #0A121B; --lab: #0E1A24; --panel: #15252F; --panel-2: #1B2E3A;
            --line: #27404E; --line-soft: #1E333F; --paper: #E8EEF0; --muted: #9FB0B8;
            --tag: #F2B33D; --uv: #8E7BFF; --resolved: #3FBF9B; --alert: #F0606A;
            --font-sans: 'Chivo', sans-serif; --font-mono: 'JetBrains Mono', monospace;
        }
        *, *::before, *::after { box-sizing: border-box; }
        body { margin: 0; background: var(--lab); font-family: var(--font-sans); color: var(--paper); }
        .adm-wrap { display: flex; min-height: 100vh; }

        /* ── Sidebar admin ── */
        .adm-sidebar {
            width: 255px; flex-shrink: 0;
            background: linear-gradient(180deg, #0A121B 0%, #0E1A24 55%, #12202c 100%);
            border-right: 1px solid var(--line-soft);
            display: flex; flex-direction: column;
            position: fixed; top: 0; left: 0; height: 100vh;
            z-index: 200; transition: transform .28s ease;
        }
        .adm-logo {
            display: flex; align-items: center; gap: .7rem;
            padding: 1.2rem 1.4rem;
            border-bottom: 1px solid var(--line-soft);
            text-decoration: none;
        }
        .adm-logo-icon {
            width: 36px; height: 36px;
            background: var(--tag); border-radius: 9px;
            display: flex; align-items: center; justify-content: center;
            color: #1A1203; font-weight: 800; font-size: .85rem; flex-shrink: 0;
        }
        .adm-logo-text { line-height: 1.2; }
        .adm-logo-name { font-family: var(--font-sans); font-weight: 800; font-size: .9rem; color: var(--paper); display: block; }
        .adm-logo-name b { color: var(--tag); }
        .adm-logo-sub  { font-family: var(--font-mono); font-size: .62rem; color: var(--muted); font-weight: 500; text-transform: uppercase; letter-spacing: .12em; }

        .adm-admin-badge {
            margin: .75rem 1.4rem;
            background: var(--tag-soft);
            border: 1px solid var(--tag-border);
            border-radius: 8px;
            padding: .5rem .875rem;
            display: flex; align-items: center; gap: .5rem;
        }
        .adm-admin-badge i { color: var(--tag); font-size: .85rem; }
        .adm-admin-badge span { font-size: .8rem; font-weight: 600; color: var(--paper); }

        .adm-nav { flex: 1; padding: .4rem 0; overflow-y: auto; }
        .adm-nav-sep {
            padding: .55rem 1.4rem .2rem;
            font-family: var(--font-mono); font-size: .6rem; font-weight: 500;
            text-transform: uppercase; letter-spacing: .14em;
            color: var(--muted);
        }
        .adm-nav-link {
            display: flex; align-items: center; gap: .7rem;
            padding: .65rem 1.4rem;
            color: var(--muted); font-size: .86rem; font-weight: 600;
            text-decoration: none; border-left: 3px solid transparent; transition: all .16s;
        }
        .adm-nav-link i { width: 17px; text-align: center; font-size: .92rem; }
        .adm-nav-link:hover  { background: rgba(142,123,255,.08); color: var(--paper); border-left-color: var(--uv); }
        .adm-nav-link.active { background: rgba(142,123,255,.12); color: #c9bfff; border-left-color: var(--uv); }

        .adm-side-foot { padding: .9rem 1.4rem; border-top: 1px solid var(--line-soft); }
        .adm-logout {
            width: 100%; display: flex; align-items: center; gap: .7rem;
            padding: .6rem .85rem; background: none; border: none;
            border-radius: 8px; color: var(--muted);
            font-size: .86rem; font-weight: 600; cursor: pointer; text-align: left; transition: all .16s;
        }
        .adm-logout:hover { background: var(--alert-soft); color: var(--alert); }

        /* ── Main ── */
        .adm-main { margin-left: 255px; flex: 1; display: flex; flex-direction: column; min-height: 100vh; }
        .adm-topbar {
            background: var(--panel); padding: .85rem 1.75rem;
            display: flex; align-items: center; justify-content: space-between;
            border-bottom: 1px solid var(--line-soft);
            position: sticky; top: 0; z-index: 100;
        }
        .adm-topbar-left { display: flex; align-items: center; gap: .9rem; }
        .adm-topbar-title { font-family: var(--font-sans); font-size: 1.1rem; font-weight: 800; color: var(--paper); margin: 0; }
        .adm-hamburger { display: none; background: none; border: none; font-size: 1.3rem; color: var(--uv); cursor: pointer; }
        .adm-topbar-right { display: flex; align-items: center; gap: .75rem; }
        .adm-topbar-badge {
            display: flex; align-items: center; gap: .4rem;
            background: var(--tag-soft); color: var(--tag);
            font-family: var(--font-mono); font-size: .68rem; font-weight: 500;
            padding: .3rem .75rem; border-radius: 999px;
        }
        .adm-topbar-user { font-size: .86rem; color: var(--muted); }

        .adm-flash { padding: 1.25rem 1.75rem 0; }
        .adm-alert { padding: .75rem 1rem; border-radius: 9px; display: flex; align-items: center; gap: .6rem; font-size: .86rem; font-weight: 600; margin-bottom: .6rem; }
        .adm-alert.ok  { background: var(--resolved-soft); border-left: 4px solid var(--resolved); color: var(--resolved); }
        .adm-alert.err { background: var(--alert-soft);  border-left: 4px solid var(--alert); color: var(--alert); }

        .adm-content { padding: 1.6rem 1.75rem 3rem; }

        .adm-overlay { display: none; position: fixed; inset: 0; background: rgba(0,0,0,.6); z-index: 199; }
        @media (max-width: 1024px) {
            .adm-sidebar { transform: translateX(-100%); }
            .adm-sidebar.open { transform: translateX(0); }
            .adm-overlay.open { display: block; }
            .adm-main { margin-left: 0; }
            .adm-hamburger { display: block; }
            .adm-topbar, .adm-content { padding-left: 1.1rem; padding-right: 1.1rem; }
        }
    </style>
</head>
<body>
<div class="adm-overlay" id="admOverlay" onclick="admToggle()"></div>
<div class="adm-wrap">

    <aside class="adm-sidebar" id="admSidebar">
        <a href="{{ route('admin.dashboard') }}" class="adm-logo">
            <div class="adm-logo-icon"><i class="fas fa-shield-alt"></i></div>
            <div class="adm-logo-text">
                <span class="adm-logo-name">Forense<b>Box</b></span>
                <span class="adm-logo-sub">Panel Administrativo</span>
            </div>
        </a>

        <div class="adm-admin-badge">
            <i class="fas fa-user-shield"></i>
            <span>{{ Auth::user()->name }}</span>
        </div>

        <nav class="adm-nav">
            <div class="adm-nav-sep">Panel</div>
            <a href="{{ route('admin.dashboard') }}"   class="adm-nav-link {{ Request::routeIs('admin.dashboard') ? 'active' : '' }}"><i class="fas fa-chart-bar"></i> Dashboard</a>

            <div class="adm-nav-sep">Contenido</div>
            <a href="{{ route('admin.cursos.index') }}" class="adm-nav-link {{ Request::routeIs('admin.cursos.*') ? 'active' : '' }}"><i class="fas fa-graduation-cap"></i> Cursos</a>
            <a href="{{ route('admin.cursos.create') }}" class="adm-nav-link"><i class="fas fa-plus-circle"></i> Nuevo Curso</a>

            <div class="adm-nav-sep">Usuarios</div>
            <a href="{{ route('admin.estudiantes') }}"  class="adm-nav-link {{ Request::routeIs('admin.estudiantes') ? 'active' : '' }}"><i class="fas fa-users"></i> Estudiantes</a>

            <div class="adm-nav-sep">Sistema</div>
            <a href="{{ route('inicio') }}"             class="adm-nav-link"><i class="fas fa-globe"></i> Ver Sitio Web</a>
            <a href="{{ route('dashboard') }}"          class="adm-nav-link"><i class="fas fa-user"></i> Mi Panel</a>
        </nav>

        <div class="adm-side-foot">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="adm-logout"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</button>
            </form>
        </div>
    </aside>

    <div class="adm-main">
        <div class="adm-topbar">
            <div class="adm-topbar-left">
                <button class="adm-hamburger" onclick="admToggle()"><i class="fas fa-bars"></i></button>
                <h1 class="adm-topbar-title">@yield('page-title', 'Dashboard')</h1>
            </div>
            <div class="adm-topbar-right">
                <div class="adm-topbar-badge"><i class="fas fa-shield-alt"></i> Admin</div>
                <span class="adm-topbar-user">{{ Auth::user()->name }}</span>
            </div>
        </div>

        <div class="adm-flash">
            @if(session('success'))
                <div class="adm-alert ok"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="adm-alert err"><i class="fas fa-exclamation-circle"></i> {{ session('error') }}</div>
            @endif
        </div>

        <div class="adm-content">
            @yield('content')
        </div>
    </div>
</div>
<script>function admToggle(){document.getElementById('admSidebar').classList.toggle('open');document.getElementById('admOverlay').classList.toggle('open');}</script>
@yield('extra-js')
</body>
</html>
