<style>
/* ── HEADER ── */
.header {
    position: fixed; top: 0; left: 0; right: 0; z-index: 1000;
    background: rgba(10, 18, 27, .92);
    backdrop-filter: blur(14px);
    -webkit-backdrop-filter: blur(14px);
    border-bottom: 1px solid var(--line-soft);
    box-shadow: 0 2px 24px rgba(0, 0, 0, .35);
    transition: all .25s;
}

.nav-container {
    max-width: 1200px; margin: 0 auto;
    padding: 0 1.5rem;
    height: 70px;
    display: flex; align-items: center; justify-content: space-between;
    gap: 1rem;
}

/* ── LOGO ── */
.logo {
    display: flex; align-items: center; gap: .6rem;
    text-decoration: none; flex-shrink: 0;
}
.logo-img {
    height: 40px; width: auto;
    object-fit: contain; display: block;
}
.logo-text { display: flex; flex-direction: column; line-height: 1.05; }
.logo-text-top {
    font-family: var(--font-sans);
    font-size: 1.12rem; font-weight: 800; color: var(--paper);
    letter-spacing: -.01em;
}
.logo-text-top b { color: var(--tag); font-weight: 800; }
.logo-text-bottom {
    font-family: var(--font-mono);
    font-size: .62rem; font-weight: 500; color: var(--muted);
    letter-spacing: .22em; text-transform: uppercase;
}

/* ── MENÚ DESKTOP ── */
.nav-menu {
    display: flex; align-items: center; gap: .2rem;
    list-style: none; margin: 0; padding: 0;
    flex: 1; justify-content: center;
}
.nav-menu li a {
    display: inline-flex; align-items: center;
    padding: .45rem .85rem; border-radius: 8px;
    font-family: var(--font-sans);
    font-size: .9rem; font-weight: 600; color: var(--muted);
    text-decoration: none; transition: all .18s; position: relative;
}
.nav-menu li a::after {
    content: ''; position: absolute; bottom: 4px;
    left: 50%; right: 50%; height: 2px; border-radius: 999px;
    background: var(--uv); transition: all .22s;
}
.nav-menu li a:hover { color: var(--paper); background: rgba(142,123,255,.08); }
.nav-menu li a.active { color: var(--uv); }
.nav-menu li a.active::after { left: .85rem; right: .85rem; }

/* ── ACCIONES DESKTOP ── */
.nav-actions { display: flex; align-items: center; gap: .6rem; flex-shrink: 0; }

.btn-nav-ghost {
    display: inline-flex; align-items: center; gap: .4rem;
    padding: .48rem 1rem; border-radius: 8px;
    border: 1.5px solid var(--line); background: transparent;
    color: var(--paper); font-size: .87rem; font-weight: 600;
    text-decoration: none; transition: all .18s;
    font-family: var(--font-sans);
}
.btn-nav-ghost:hover { border-color: var(--uv); color: var(--uv); background: rgba(142,123,255,.08); }

.btn-nav-primary {
    display: inline-flex; align-items: center; gap: .4rem;
    padding: .48rem 1.15rem; border-radius: 8px;
    background: var(--tag); color: #1A1203; font-size: .87rem; font-weight: 700;
    text-decoration: none; transition: all .18s;
    box-shadow: 0 2px 14px rgba(242,179,61,.25);
    font-family: var(--font-sans);
}
.btn-nav-primary:hover { transform: translateY(-1px); box-shadow: 0 6px 22px rgba(242,179,61,.4); color: #1A1203; }

/* ── USER DROPDOWN ── */
.user-dropdown { position: relative; }
.user-dropdown-btn {
    display: flex; align-items: center; gap: .5rem;
    background: var(--panel); border: 1.5px solid var(--line);
    border-radius: 10px; padding: .42rem .9rem;
    color: var(--paper); font-size: .88rem; font-weight: 600;
    cursor: pointer; transition: all .18s;
    font-family: var(--font-sans);
}
.user-dropdown-btn:hover { background: var(--panel-2); border-color: var(--uv); }
.user-avatar {
    width: 28px; height: 28px; border-radius: 50%;
    background: linear-gradient(135deg, var(--uv), #6a58e0);
    display: flex; align-items: center; justify-content: center;
    font-weight: 800; font-size: .76rem; color: #fff;
}
.user-menu {
    display: none; position: absolute; top: calc(100% + 8px); right: 0;
    background: var(--panel); border-radius: 14px;
    box-shadow: 0 12px 40px rgba(0,0,0,.5), 0 2px 8px rgba(0,0,0,.4);
    min-width: 220px; z-index: 999;
    overflow: hidden; border: 1px solid var(--line);
}
.user-menu.open { display: block; animation: menuFadeIn .18s ease; }
@keyframes menuFadeIn {
    from { opacity:0; transform:translateY(-6px); }
    to   { opacity:1; transform:translateY(0); }
}
.user-menu-header {
    padding: .85rem 1.1rem; border-bottom: 1px solid var(--line-soft);
    background: var(--panel-2);
}
.user-menu-name { font-weight: 800; font-size: .9rem; color: var(--paper); }
.user-menu-email { font-size: .73rem; color: var(--muted); margin-top: .1rem; }
.user-menu a, .user-menu button {
    display: flex; align-items: center; gap: .6rem;
    width: 100%; padding: .68rem 1.1rem;
    font-family: var(--font-sans);
    font-size: .86rem; font-weight: 600; color: var(--muted);
    text-decoration: none; background: none; border: none;
    cursor: pointer; text-align: left; transition: background .15s, color .15s;
}
.user-menu a:hover, .user-menu button:hover { background: var(--panel-2); color: var(--paper); }
.user-menu a i, .user-menu button i { width: 18px; color: var(--uv); text-align: center; font-size: .82rem; }
.user-menu .logout-btn { color: var(--alert); border-top: 1px solid var(--line-soft); }
.user-menu .logout-btn i { color: var(--alert); }

/* ── BOTÓN HAMBURGER ── */
.mobile-menu-toggle {
    display: none;
    background: none;
    border: 1.5px solid var(--line);
    border-radius: 8px;
    width: 42px; height: 42px;
    align-items: center; justify-content: center;
    color: var(--paper); cursor: pointer;
    transition: all .18s; flex-shrink: 0;
    font-size: 1.1rem;
}
.mobile-menu-toggle:hover { background: var(--panel-2); border-color: var(--uv); color: var(--uv); }

/* ── PANEL LATERAL MÓVIL ── */
.mobile-nav-overlay {
    display: none; position: fixed; inset: 0; z-index: 1098;
    background: rgba(0,0,0,.6);
}
.mobile-nav-overlay.open { display: block; }

.mobile-nav-panel {
    position: fixed; top: 0; right: -100%; z-index: 1099;
    width: min(300px, 85vw); height: 100vh;
    background: var(--lab);
    box-shadow: -6px 0 40px rgba(0,0,0,.5);
    transition: right .28s cubic-bezier(.4,0,.2,1);
    display: flex; flex-direction: column; overflow-y: auto;
    border-left: 1px solid var(--line);
}
.mobile-nav-panel.open { right: 0; }

.mnp-header {
    display: flex; align-items: center; justify-content: space-between;
    padding: 1rem 1.1rem; flex-shrink: 0;
    background: var(--lab-deep);
    border-bottom: 1px solid var(--line-soft);
}
.mnp-logo { display: flex; align-items: center; gap: .55rem; text-decoration: none; }
.mnp-logo img { height: 34px; width: auto; }
.mnp-logo-text { display: flex; flex-direction: column; line-height: 1.05; }
.mnp-logo-text span:first-child { font-family: var(--font-sans); font-size: .9rem; font-weight: 800; color: var(--paper); }
.mnp-logo-text span:last-child { font-family: var(--font-mono); font-size: .58rem; font-weight: 500; color: var(--muted); text-transform: uppercase; letter-spacing: .18em; }
.mnp-close {
    background: var(--panel); border: 1px solid var(--line);
    border-radius: 8px; width: 34px; height: 34px;
    display: flex; align-items: center; justify-content: center;
    color: var(--paper); cursor: pointer; font-size: .95rem; transition: background .18s;
}
.mnp-close:hover { background: var(--panel-2); }

.mnp-section-label {
    padding: .85rem 1.1rem .3rem;
    font-family: var(--font-mono);
    font-size: .62rem; font-weight: 500; color: var(--muted);
    text-transform: uppercase; letter-spacing: .18em;
}
.mnp-links { list-style: none; padding: 0 .5rem; margin: 0; }
.mnp-links li a {
    display: flex; align-items: center; gap: .7rem;
    padding: .8rem .75rem; border-radius: 8px;
    font-family: var(--font-sans);
    font-size: .93rem; font-weight: 600; color: var(--muted);
    text-decoration: none; transition: all .15s;
}
.mnp-links li a:hover, .mnp-links li a.active { background: rgba(142,123,255,.1); color: var(--uv); }
.mnp-links li a i { width: 20px; text-align: center; color: var(--uv); opacity: .8; font-size: .85rem; }
.mnp-divider { height: 1px; background: var(--line-soft); margin: .4rem 1.1rem; }
.mnp-user-info {
    margin: .5rem; padding: .8rem 1rem;
    background: var(--panel-2);
    border-radius: 10px; border: 1px solid var(--line);
}
.mnp-user-name { font-family: var(--font-sans); font-weight: 800; font-size: .88rem; color: var(--paper); }
.mnp-user-email { font-size: .71rem; color: var(--muted); margin-top: .1rem; }

.mnp-auth-btns { display: flex; flex-direction: column; gap: .5rem; padding: .75rem .5rem 1rem; }
.mnp-auth-btns .btn-nav-ghost,
.mnp-auth-btns .btn-nav-primary { width: 100%; justify-content: center; padding: .7rem; font-size: .92rem; border-radius: 8px; }

/* ── RESPONSIVE ── */
@media (max-width: 860px) {
    .nav-menu               { display: none !important; }
    .nav-actions .btn-nav-ghost   { display: none !important; }
    .nav-actions .btn-nav-primary { display: none !important; }
    .nav-actions .user-dropdown   { display: none !important; }
    .mobile-menu-toggle     { display: flex !important; }
}
@media (max-width: 480px) {
    .nav-container { padding: 0 .9rem; height: 66px; }
    .logo-img      { height: 36px; }
}

/* Compensar header fijo */
.hero-section              { margin-top: 70px; }
body > main > section:first-child,
body > main > div:first-child { padding-top: 70px; }
</style>

<header class="header" id="header">
    <nav class="nav-container">

        {{-- LOGO --}}
        <a href="{{ route('inicio') }}" class="logo">
            <img src="{{ asset('images/logo.png') }}" alt="ForenseBox" class="logo-img"
                 onerror="this.style.display='none'">
            <div class="logo-text">
                <span class="logo-text-top">Forense<b>Box</b></span>
                <span class="logo-text-bottom">Digital Forensics</span>
            </div>
        </a>

        {{-- MENÚ DESKTOP --}}
        <ul class="nav-menu">
            <li><a href="{{ route('inicio') }}"       class="{{ Request::routeIs('inicio')      ? 'active' : '' }}">Inicio</a></li>
            <li><a href="{{ route('cursos.index') }}" class="{{ Request::routeIs('cursos.*')     ? 'active' : '' }}">Cursos</a></li>
            <li><a href="{{ route('contacto') }}"     class="{{ Request::routeIs('contacto')     ? 'active' : '' }}">Contáctanos</a></li>
            <li><a href="{{ route('normatividad') }}" class="{{ Request::routeIs('normatividad') ? 'active' : '' }}">Normatividad</a></li>
        </ul>

        {{-- ACCIONES DESKTOP --}}
        <div class="nav-actions">
            @auth
                <div class="user-dropdown">
                    <button class="user-dropdown-btn" onclick="toggleUserMenu()" id="userDropBtn">
                        <div class="user-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
                        {{ explode(' ', Auth::user()->name)[0] }}
                        <i class="fas fa-chevron-down" style="font-size:.68rem;opacity:.7;"></i>
                    </button>
                    <div id="userMenu" class="user-menu">
                        <div class="user-menu-header">
                            <div class="user-menu-name">{{ Auth::user()->name }}</div>
                            <div class="user-menu-email">{{ Auth::user()->email }}</div>
                        </div>
                        <a href="{{ route('dashboard') }}"><i class="fas fa-th-large"></i> Mi Panel</a>
                        <a href="{{ route('dashboard.perfil') }}"><i class="fas fa-user-circle"></i> Mi Perfil</a>
                        <a href="{{ route('dashboard.cursos') }}"><i class="fas fa-book-open"></i> Mis Cursos</a>
                        @if(Auth::user()->isAdmin())
                            <a href="{{ route('admin.dashboard') }}"><i class="fas fa-shield-alt"></i> Panel Admin</a>
                        @endif
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="logout-btn">
                                <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
                            </button>
                        </form>
                    </div>
                </div>
            @else
                <a href="{{ route('login') }}"    class="btn-nav-ghost"><i class="fas fa-sign-in-alt"></i> Iniciar Sesión</a>
                <a href="{{ route('register') }}" class="btn-nav-primary"><i class="fas fa-user-plus"></i> Registrarse</a>
            @endauth
        </div>

        {{-- BOTÓN HAMBURGER --}}
        <button class="mobile-menu-toggle" id="mobileMenuToggle" aria-label="Abrir menú">
            <i class="fas fa-bars"></i>
        </button>

    </nav>
</header>

{{-- OVERLAY --}}
<div class="mobile-nav-overlay" id="mobileOverlay" onclick="closeMobileMenu()"></div>

{{-- PANEL LATERAL --}}
<div class="mobile-nav-panel" id="mobileNavPanel">

    <div class="mnp-header">
        <a href="{{ route('inicio') }}" class="mnp-logo" onclick="closeMobileMenu()">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" onerror="this.style.display='none'">
            <div class="mnp-logo-text">
                <span>ForenseBox</span>
                <span>Digital Forensics</span>
            </div>
        </a>
        <button class="mnp-close" onclick="closeMobileMenu()" aria-label="Cerrar">
            <i class="fas fa-times"></i>
        </button>
    </div>

    <div class="mnp-section-label">Navegación</div>
    <ul class="mnp-links">
        <li><a href="{{ route('inicio') }}"       class="{{ Request::routeIs('inicio')      ? 'active' : '' }}" onclick="closeMobileMenu()"><i class="fas fa-home"></i> Inicio</a></li>
        <li><a href="{{ route('cursos.index') }}" class="{{ Request::routeIs('cursos.*')     ? 'active' : '' }}" onclick="closeMobileMenu()"><i class="fas fa-graduation-cap"></i> Cursos</a></li>
        <li><a href="{{ route('contacto') }}"     class="{{ Request::routeIs('contacto')     ? 'active' : '' }}" onclick="closeMobileMenu()"><i class="fas fa-envelope"></i> Contáctanos</a></li>
        <li><a href="{{ route('normatividad') }}" class="{{ Request::routeIs('normatividad') ? 'active' : '' }}" onclick="closeMobileMenu()"><i class="fas fa-file-alt"></i> Normatividad</a></li>
    </ul>

    <div class="mnp-divider"></div>

    @auth
        <div class="mnp-section-label">Mi Cuenta</div>
        <div style="padding:0 .5rem .5rem">
            <div class="mnp-user-info">
                <div class="mnp-user-name">{{ Auth::user()->name }}</div>
                <div class="mnp-user-email">{{ Auth::user()->email }}</div>
            </div>
        </div>
        <ul class="mnp-links">
            <li><a href="{{ route('dashboard') }}"              onclick="closeMobileMenu()"><i class="fas fa-th-large"></i> Mi Panel</a></li>
            <li><a href="{{ route('dashboard.perfil') }}"       onclick="closeMobileMenu()"><i class="fas fa-user-circle"></i> Mi Perfil</a></li>
            <li><a href="{{ route('dashboard.cursos') }}"       onclick="closeMobileMenu()"><i class="fas fa-book-open"></i> Mis Cursos</a></li>
            <li><a href="{{ route('dashboard.certificados') }}" onclick="closeMobileMenu()"><i class="fas fa-certificate"></i> Certificados</a></li>
            @if(Auth::user()->isAdmin())
            <li><a href="{{ route('admin.dashboard') }}"        onclick="closeMobileMenu()"><i class="fas fa-shield-alt"></i> Panel Admin</a></li>
            @endif
        </ul>
        <div class="mnp-divider"></div>
        <div style="padding:.5rem">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" style="width:100%;display:flex;align-items:center;justify-content:center;gap:.5rem;padding:.75rem;background:none;border:1.5px solid var(--alert);border-radius:8px;color:var(--alert);font-family:var(--font-sans);font-size:.9rem;font-weight:600;cursor:pointer;">
                    <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
                </button>
            </form>
        </div>
    @else
        <div class="mnp-auth-btns">
            <a href="{{ route('login') }}"    class="btn-nav-ghost"   onclick="closeMobileMenu()"><i class="fas fa-sign-in-alt"></i> Iniciar Sesión</a>
            <a href="{{ route('register') }}" class="btn-nav-primary" onclick="closeMobileMenu()"><i class="fas fa-user-plus"></i> Registrarse</a>
        </div>
    @endauth

</div>

<script>
function toggleUserMenu() {
    document.getElementById('userMenu').classList.toggle('open');
}
document.addEventListener('click', function(e) {
    if (!e.target.closest('.user-dropdown')) {
        const m = document.getElementById('userMenu');
        if (m) m.classList.remove('open');
    }
});

function openMobileMenu() {
    document.getElementById('mobileNavPanel').classList.add('open');
    document.getElementById('mobileOverlay').classList.add('open');
    document.body.style.overflow = 'hidden';
    const icon = document.querySelector('#mobileMenuToggle i');
    if (icon) { icon.classList.replace('fa-bars', 'fa-times'); }
}
function closeMobileMenu() {
    document.getElementById('mobileNavPanel').classList.remove('open');
    document.getElementById('mobileOverlay').classList.remove('open');
    document.body.style.overflow = '';
    const icon = document.querySelector('#mobileMenuToggle i');
    if (icon) { icon.classList.replace('fa-times', 'fa-bars'); }
}
document.getElementById('mobileMenuToggle').addEventListener('click', function() {
    document.getElementById('mobileNavPanel').classList.contains('open')
        ? closeMobileMenu() : openMobileMenu();
});
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') closeMobileMenu();
});
</script>
