<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Mi Panel') — ForenseBox</title>
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

        .db-wrap { display: flex; min-height: 100vh; }

        /* ── Sidebar ── */
        .db-sidebar {
            width: 255px; flex-shrink: 0;
            background: linear-gradient(180deg, #0A121B 0%, #0E1A24 55%, #12202c 100%);
            border-right: 1px solid var(--line-soft);
            display: flex; flex-direction: column;
            position: fixed; top: 0; left: 0; height: 100vh;
            z-index: 200; transition: transform .28s ease;
        }
        .db-logo {
            display: flex; align-items: center; gap: .7rem;
            padding: 1.1rem 1.4rem;
            border-bottom: 1px solid var(--line-soft);
            text-decoration: none;
        }
        .db-logo img { height: 44px; width: auto; object-fit: contain; }
        .db-logo-icon {
            width: 36px; height: 36px; background: var(--tag); border-radius: 9px;
            display: flex; align-items: center; justify-content: center;
            color: #1A1203; font-weight: 800; font-size: .85rem; flex-shrink: 0;
        }
        .db-logo-name { font-family: var(--font-sans); font-weight: 800; font-size: .95rem; color: var(--paper); }
        .db-logo-name b { color: var(--tag); }

        .db-side-user {
            display: flex; align-items: center; gap: .7rem;
            padding: 1rem 1.4rem;
            border-bottom: 1px solid var(--line-soft);
        }
        .db-side-avatar { width: 42px; height: 42px; border-radius: 50%; object-fit: cover; border: 2px solid var(--uv); flex-shrink: 0; }
        .db-side-initials {
            width: 42px; height: 42px; border-radius: 50%;
            background: linear-gradient(135deg, var(--uv), #6a58e0); color: #fff;
            font-weight: 800; font-size: 1rem;
            display: flex; align-items: center; justify-content: center; flex-shrink: 0;
        }
        .db-side-name { font-weight: 600; font-size: .85rem; color: var(--paper); display: block; }
        .db-side-cond {
            display: inline-block; margin-top: .2rem;
            font-family: var(--font-mono); font-size: .64rem; font-weight: 500;
            background: var(--uv-soft); color: #c9bfff;
            padding: .1rem .5rem; border-radius: 999px;
        }
        .db-nav { flex: 1; padding: .6rem 0; overflow-y: auto; }
        .db-nav-sep {
            padding: .55rem 1.4rem .2rem;
            font-family: var(--font-mono); font-size: .6rem; font-weight: 500;
            text-transform: uppercase; letter-spacing: .14em;
            color: var(--muted);
        }
        .db-nav-link {
            display: flex; align-items: center; gap: .7rem;
            padding: .65rem 1.4rem;
            color: var(--muted); font-size: .86rem; font-weight: 600;
            text-decoration: none; border-left: 3px solid transparent; transition: all .16s;
        }
        .db-nav-link i { width: 17px; text-align: center; font-size: .92rem; }
        .db-nav-link:hover { background: rgba(142,123,255,.08); color: var(--paper); border-left-color: var(--uv); }
        .db-nav-link.active { background: rgba(142,123,255,.12); color: #c9bfff; border-left-color: var(--uv); }

        .db-side-foot { padding: .9rem 1.4rem; border-top: 1px solid var(--line-soft); }
        .db-logout {
            width: 100%; display: flex; align-items: center; gap: .7rem;
            padding: .6rem .85rem; background: none; border: none;
            border-radius: 8px; color: var(--muted);
            font-size: .86rem; font-weight: 600; cursor: pointer; text-align: left; transition: all .16s;
        }
        .db-logout:hover { background: var(--alert-soft); color: var(--alert); }

        /* ── Main ── */
        .db-main { margin-left: 255px; flex: 1; display: flex; flex-direction: column; min-height: 100vh; }
        .db-topbar {
            background: var(--panel); padding: .85rem 1.75rem;
            display: flex; align-items: center; justify-content: space-between;
            border-bottom: 1px solid var(--line-soft);
            position: sticky; top: 0; z-index: 100;
        }
        .db-topbar-left { display: flex; align-items: center; gap: .9rem; }
        .db-topbar-title { font-family: var(--font-sans); font-size: 1.1rem; font-weight: 800; color: var(--paper); margin: 0; }
        .db-hamburger { display: none; background: none; border: none; font-size: 1.3rem; color: var(--uv); cursor: pointer; }
        .db-topbar-right { display: flex; align-items: center; gap: .5rem; font-size: .86rem; color: var(--muted); }
        .db-topbar-right i { color: var(--tag); font-size: 1rem; }

        .db-flash { padding: 1.25rem 1.75rem 0; }
        .db-alert { padding: .75rem 1rem; border-radius: 9px; display: flex; align-items: center; gap: .6rem; font-size: .86rem; font-weight: 600; margin-bottom: .6rem; }
        .db-alert.ok  { background: var(--resolved-soft); border-left: 4px solid var(--resolved); color: var(--resolved); }
        .db-alert.err { background: var(--alert-soft);  border-left: 4px solid var(--alert); color: var(--alert); }

        .db-content { padding: 1.6rem 1.75rem 3rem; }

        .db-overlay { display: none; position: fixed; inset: 0; background: rgba(0,0,0,.6); z-index: 199; }

        @media (max-width: 1024px) {
            .db-sidebar { transform: translateX(-100%); }
            .db-sidebar.open { transform: translateX(0); }
            .db-overlay.open { display: block; }
            .db-main { margin-left: 0; }
            .db-hamburger { display: block; }
            .db-topbar, .db-content { padding-left: 1.1rem; padding-right: 1.1rem; }
        }
    </style>
</head>
<body>
<div class="db-overlay" id="dbOverlay" onclick="dbToggle()"></div>
<div class="db-wrap">

    <aside class="db-sidebar" id="dbSidebar">
        <a href="{{ route('inicio') }}" class="db-logo">
            <img src="{{ asset('images/logo.png') }}" alt="ForenseBox"
                style="object-fit:contain;"
                onerror="this.style.display='none';this.nextElementSibling.style.display='flex';">
            <div class="db-logo-icon" style="display:none;">FB</div>
            <span class="db-logo-name">Forense<b>Box</b></span>
        </a>

        <div class="db-side-user">
            @if(Auth::user()->avatar)
                <img src="{{ Auth::user()->avatar }}" alt="avatar" class="db-side-avatar">
            @else
                <div class="db-side-initials">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
            @endif
            <div>
                <span class="db-side-name">{{ Auth::user()->name }}</span>
                <span class="db-side-cond">{{ Auth::user()->role === 'admin' ? 'Administrador' : 'Estudiante' }}</span>
            </div>
        </div>

        <nav class="db-nav">
            <div class="db-nav-sep">Principal</div>
            <a href="{{ route('dashboard') }}"              class="db-nav-link {{ Request::routeIs('dashboard') ? 'active' : '' }}"><i class="fas fa-th-large"></i> Inicio</a>
            <a href="{{ route('dashboard.cursos') }}"       class="db-nav-link {{ Request::routeIs('dashboard.cursos') ? 'active' : '' }}"><i class="fas fa-book-open"></i> Mis Cursos</a>
            <a href="{{ route('dashboard.certificados') }}" class="db-nav-link {{ Request::routeIs('dashboard.certificados') ? 'active' : '' }}"><i class="fas fa-certificate"></i> Certificados</a>
            <div class="db-nav-sep">Mi Cuenta</div>
            <a href="{{ route('dashboard.perfil') }}"       class="db-nav-link {{ Request::routeIs('dashboard.perfil') ? 'active' : '' }}"><i class="fas fa-user-circle"></i> Mi Perfil</a>
            <div class="db-nav-sep">Plataforma</div>
            <a href="{{ route('cursos.index') }}"           class="db-nav-link"><i class="fas fa-graduation-cap"></i> Catálogo de Cursos</a>
            @if(Auth::user()->isAdmin())
                <a href="{{ route('admin.dashboard') }}"    class="db-nav-link"><i class="fas fa-shield-alt"></i> Panel Admin</a>
            @endif
            <a href="{{ route('inicio') }}"                 class="db-nav-link"><i class="fas fa-home"></i> Volver al Inicio</a>
        </nav>

        <div class="db-side-foot">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="db-logout"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</button>
            </form>
        </div>
    </aside>

    <div class="db-main">
        <div class="db-topbar">
            <div class="db-topbar-left">
                <button class="db-hamburger" onclick="dbToggle()"><i class="fas fa-bars"></i></button>
                <h1 class="db-topbar-title">@yield('page-title', 'Dashboard')</h1>
            </div>
            <div class="db-topbar-right">
                <i class="fas fa-user-circle"></i>
                <span>{{ Auth::user()->name }}</span>
            </div>
        </div>

        <div class="db-flash">
            @if(session('success'))
                <div class="db-alert ok"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="db-alert err"><i class="fas fa-exclamation-circle"></i> {{ session('error') }}</div>
            @endif
        </div>

        <div class="db-content">
            @yield('content')
        </div>
    </div>
</div>
<script>function dbToggle(){document.getElementById('dbSidebar').classList.toggle('open');document.getElementById('dbOverlay').classList.toggle('open');}</script>
@yield('extra-js')
</body>
</html>
