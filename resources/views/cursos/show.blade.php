@extends('layouts.app')
@section('title', $curso->titulo . ' - ForenseBox')

@section('content')
@php
    $colores = $curso->color_gradiente ?? '#15252F,#27404E';
    [$c1,$c2] = array_pad(explode(',',$colores),2,'#27404E');
    $icono = $curso->icono_fa ?? 'fa-fingerprint';
@endphp

<style>
:root {
    --c1: {{ $c1 }};
    --c2: {{ $c2 }};
    --lab-deep:  #0A121B;
    --lab:       #0E1A24;
    --panel:     #15252F;
    --panel-2:   #1B2E3A;
    --line:      #27404E;
    --line-soft: #1E333F;
    --paper:     #E8EEF0;
    --muted:     #9FB0B8;
    --tag:       #F2B33D;
    --uv:        #8E7BFF;
    --resolved:  #3FBF9B;
    --alert:     #F0606A;
    --font-sans: 'Chivo', sans-serif;
    --font-mono: 'JetBrains Mono', monospace;
}

* { box-sizing: border-box; }

/* ── HERO ─────────────────────────────── */
.hero {
    position: relative;
    background: var(--lab-deep);
    overflow: hidden;
    padding: 0;
    padding-top: 70px;
}

.hero-bg-gradient {
    position: absolute; inset: 0;
    background: linear-gradient(135deg, var(--c1) 0%, var(--c2) 50%, var(--lab-deep) 100%);
    opacity: .18;
}
.hero-bg-dots {
    position: absolute; inset: 0;
    background-image:
        linear-gradient(rgba(142,123,255,.05) 1px, transparent 1px),
        linear-gradient(90deg, rgba(142,123,255,.05) 1px, transparent 1px);
    background-size: 44px 44px;
    mask-image: radial-gradient(ellipse 70% 70% at 30% 50%, black 30%, transparent 100%);
}

.hero-inner {
    position: relative; z-index: 2;
    max-width: 1180px; margin: 0 auto;
    padding: 4rem 1.5rem 0;
    display: grid;
    grid-template-columns: 1fr 360px;
    gap: 3rem;
    align-items: start;
}

/* Breadcrumb */
.breadcrumb {
    display: flex; align-items: center; gap: .5rem;
    font-family: var(--font-mono);
    font-size: .74rem; color: var(--muted);
    margin-bottom: 1.5rem;
}
.breadcrumb a { color: var(--muted); text-decoration: none; transition: color .2s; }
.breadcrumb a:hover { color: var(--uv); }
.breadcrumb span { color: var(--line); }

.cat-badge {
    display: inline-flex; align-items: center; gap: .4rem;
    background: var(--uv-soft);
    border: 1px solid var(--uv-border);
    color: #c9bfff; font-family: var(--font-mono);
    font-size: .7rem; font-weight: 500;
    padding: .35rem 1rem; border-radius: 999px;
    text-transform: uppercase; letter-spacing: .12em;
    margin-bottom: 1.1rem;
}

.hero-title {
    font-family: var(--font-sans);
    font-size: clamp(1.75rem, 3.5vw, 2.6rem);
    font-weight: 800; color: var(--paper);
    line-height: 1.15; margin: 0 0 1rem;
    letter-spacing: -.02em;
}

.hero-desc {
    font-family: var(--font-sans);
    font-size: 1.05rem; color: var(--muted);
    line-height: 1.7; margin-bottom: 1.75rem;
    max-width: 560px;
}

.meta-pills { display: flex; flex-wrap: wrap; gap: .6rem; margin-bottom: 2rem; }
.meta-pill {
    display: flex; align-items: center; gap: .4rem;
    background: var(--panel);
    border: 1px solid var(--line);
    color: var(--paper);
    padding: .4rem .9rem; border-radius: 999px;
    font-size: .82rem; font-family: var(--font-sans);
    font-weight: 600;
}
.meta-pill i { font-size: .78rem; color: var(--tag); }

.hero-rating { display: flex; align-items: center; gap: .5rem; margin-bottom: 2.5rem; }
.stars { color: var(--tag); font-size: .85rem; letter-spacing: .05em; }
.rating-text { font-size: .82rem; color: var(--muted); font-family: var(--font-sans); }

/* ── CARD INSCRIPCIÓN ─────────────────── */
.inscripcion-card {
    background: var(--panel);
    border: 1px solid var(--line);
    border-radius: 20px;
    box-shadow: 0 24px 80px rgba(0,0,0,.5), 0 4px 20px rgba(0,0,0,.3);
    overflow: hidden;
    position: sticky; top: 88px;
    margin-bottom: -80px;
}

.card-thumb { width: 100%; height: 175px; object-fit: cover; display: block; }
.card-thumb-placeholder {
    width: 100%; height: 175px;
    display: flex; align-items: center; justify-content: center;
    background: linear-gradient(135deg, var(--c1), var(--c2));
    font-size: 3rem; color: #fff;
    position: relative;
}
.card-thumb-placeholder::before {
    content: '';
    position: absolute; inset: 0;
    background-image:
        linear-gradient(rgba(255,255,255,.06) 1px, transparent 1px),
        linear-gradient(90deg, rgba(255,255,255,.06) 1px, transparent 1px);
    background-size: 26px 26px;
}
.card-thumb-placeholder i { position: relative; z-index: 1; }

.card-body { padding: 1.5rem; }

.precio-tag {
    font-family: var(--font-mono);
    font-size: 2.1rem; font-weight: 700;
    color: var(--paper); line-height: 1;
    margin-bottom: 1.25rem;
}
.precio-tag.free { color: var(--resolved); }

.progress-wrap { margin-bottom: 1rem; }
.progress-label { display: flex; justify-content: space-between; font-size: .78rem; color: var(--muted); margin-bottom: .4rem; font-family: var(--font-sans); }
.progress-bar { height: 7px; background: var(--lab); border-radius: 999px; overflow: hidden; }
.progress-fill { height: 100%; background: linear-gradient(90deg, var(--resolved), #2e9f83); border-radius: 999px; transition: width .6s ease; }

.btn-primary {
    display: flex; align-items: center; justify-content: center; gap: .5rem;
    width: 100%; padding: 1rem;
    background: var(--tag); color: #1A1203;
    border: none; border-radius: 12px;
    font-family: var(--font-sans);
    font-size: .95rem; font-weight: 600;
    cursor: pointer; text-decoration: none;
    transition: transform .18s, box-shadow .18s, opacity .18s;
    box-shadow: 0 6px 22px rgba(242,179,61,.28);
    margin-bottom: .75rem;
}
.btn-primary:hover { transform: translateY(-2px); box-shadow: 0 10px 30px rgba(242,179,61,.4); color: #1A1203; opacity: .95; }
.btn-primary.enrolled { background: var(--resolved); color: #06231c; box-shadow: 0 4px 20px rgba(63,191,155,.3); }
.btn-primary.login { background: var(--uv); color: #fff; box-shadow: 0 4px 20px rgba(142,123,255,.3); }

.btn-secondary {
    display: flex; align-items: center; justify-content: center; gap: .5rem;
    width: 100%; padding: .75rem;
    background: transparent;
    color: var(--uv); border: 1.5px solid var(--uv); border-radius: 12px;
    font-family: var(--font-sans); font-size: .88rem; font-weight: 600;
    cursor: pointer; text-decoration: none;
    transition: all .18s;
}
.btn-secondary:hover { background: var(--uv-soft); color: #fff; }

.garantia-note { display: flex; align-items: center; justify-content: center; gap: .4rem; font-size: .76rem; color: var(--muted); font-family: var(--font-sans); margin-top: .6rem; text-align: center; }

.incluye-list { margin-top: 1.25rem; padding-top: 1.25rem; border-top: 1px solid var(--line-soft); }
.incluye-title { font-family: var(--font-mono); font-size: .7rem; font-weight: 500; color: var(--muted); text-transform: uppercase; letter-spacing: .12em; margin-bottom: .75rem; }
.incluye-item { display: flex; align-items: center; gap: .65rem; padding: .4rem 0; font-size: .84rem; color: var(--paper); font-family: var(--font-sans); border-bottom: 1px solid var(--line-soft); }
.incluye-item:last-child { border-bottom: none; }
.incluye-item i { width: 18px; color: var(--tag); text-align: center; font-size: .85rem; }

/* ── BODY ─────────────────────────────── */
.page-body {
    max-width: 1180px; margin: 0 auto;
    padding: 3rem 1.5rem 4rem;
    display: grid;
    grid-template-columns: 1fr 360px;
    gap: 3rem;
}

.aprende-section {
    background: var(--panel);
    border: 1px solid var(--line);
    border-radius: 16px;
    padding: 2rem;
    margin-bottom: 2rem;
}
.section-title { font-family: var(--font-sans); font-size: 1.2rem; font-weight: 800; color: var(--paper); margin: 0 0 1.25rem; display: flex; align-items: center; gap: .6rem; }
.section-title i { color: var(--tag); }
.aprende-grid { display: grid; grid-template-columns: 1fr 1fr; gap: .65rem; }
.aprende-item { display: flex; align-items: flex-start; gap: .65rem; font-size: .87rem; color: var(--paper); line-height: 1.5; font-family: var(--font-sans); }
.aprende-check {
    width: 20px; height: 20px; border-radius: 50%;
    background: var(--uv); color: #fff;
    display: flex; align-items: center; justify-content: center;
    font-size: .65rem; flex-shrink: 0; margin-top: .1rem;
}

/* ── TABS ─────────────────────────────── */
.tab-nav { display: flex; gap: 0; border-bottom: 2px solid var(--line); margin-bottom: 1.75rem; }
.tab-btn {
    padding: .75rem 1.35rem;
    font-family: var(--font-sans);
    font-size: .9rem; font-weight: 600; color: var(--muted);
    border: none; background: none; cursor: pointer;
    border-bottom: 2.5px solid transparent; margin-bottom: -2px;
    transition: all .18s;
}
.tab-btn.active { color: var(--uv); border-bottom-color: var(--uv); }
.tab-btn:hover:not(.active) { color: var(--paper); }

.modulos-header { font-family: var(--font-sans); font-size: .88rem; color: var(--muted); margin-bottom: 1rem; }
.modulos-header strong { color: var(--paper); }

.modulo-wrap { border: 1px solid var(--line); border-radius: 12px; margin-bottom: .75rem; overflow: hidden; transition: box-shadow .2s; background: var(--panel); }
.modulo-wrap:hover { box-shadow: 0 4px 16px rgba(0,0,0,.35); }

.modulo-hd {
    padding: 1rem 1.25rem;
    background: var(--panel);
    display: flex; align-items: center; justify-content: space-between;
    cursor: pointer; user-select: none;
    transition: background .16s;
}
.modulo-hd:hover { background: var(--panel-2); }

.modulo-hd-left { display: flex; align-items: center; gap: .75rem; flex: 1; }
.modulo-num {
    width: 28px; height: 28px; border-radius: 8px;
    background: var(--uv); color: #fff;
    display: flex; align-items: center; justify-content: center;
    font-size: .72rem; font-weight: 700; flex-shrink: 0;
    font-family: var(--font-mono);
}
.modulo-titulo { font-family: var(--font-sans); font-weight: 700; font-size: .92rem; color: var(--paper); }
.modulo-count { font-size: .75rem; color: var(--muted); font-family: var(--font-sans); }
.modulo-chevron { color: var(--muted); font-size: .82rem; transition: transform .25s cubic-bezier(.4,0,.2,1); flex-shrink: 0; }
.modulo-chevron.open { transform: rotate(180deg); }

.modulo-body { display: none; border-top: 1px solid var(--line-soft); }
.modulo-body.open { display: block; }

.leccion-row {
    display: flex; align-items: center; gap: .75rem;
    padding: .75rem 1.25rem;
    border-bottom: 1px solid var(--line-soft);
    transition: background .15s;
}
.leccion-row:last-child { border-bottom: none; }
.leccion-row:hover { background: var(--panel-2); }

.lec-ico {
    width: 32px; height: 32px; border-radius: 8px;
    display: flex; align-items: center; justify-content: center;
    font-size: .8rem; flex-shrink: 0;
}
.tipo-texto  { background: var(--uv-soft); color: var(--uv); }
.tipo-video  { background: var(--tag-soft); color: var(--tag); }
.tipo-pdf    { background: var(--alert-soft); color: var(--alert); }
.tipo-quiz   { background: var(--resolved-soft); color: var(--resolved); }
.tipo-tarea  { background: rgba(142,123,255,.1); color: #c9bfff; }

.lec-titulo { flex: 1; font-size: .87rem; color: var(--muted); font-family: var(--font-sans); }
.lec-dur { font-size: .75rem; color: var(--muted); font-family: var(--font-mono); white-space: nowrap; }
.lec-lock { color: var(--line); font-size: .82rem; }
.lec-free-badge { font-size: .68rem; font-weight: 600; color: var(--resolved); background: var(--resolved-soft); padding: .15rem .5rem; border-radius: 999px; font-family: var(--font-sans); }

/* ── SIDEBAR ──────────────────────────── */
.sidebar-card { background: var(--panel); border: 1px solid var(--line); border-radius: 16px; padding: 1.5rem; margin-bottom: 1rem; }
.sidebar-title { font-family: var(--font-mono); font-size: .7rem; font-weight: 500; color: var(--muted); margin-bottom: 1rem; text-transform: uppercase; letter-spacing: .12em; }

.relac-item { display: flex; gap: .875rem; padding: .75rem 0; border-bottom: 1px solid var(--line-soft); text-decoration: none; transition: transform .16s; }
.relac-item:last-child { border-bottom: none; }
.relac-item:hover { transform: translateX(4px); }
.relac-thumb {
    width: 58px; height: 48px; border-radius: 8px; flex-shrink: 0;
    display: flex; align-items: center; justify-content: center;
    color: #fff; font-size: 1.1rem;
}
.relac-info h4 { font-family: var(--font-sans); font-size: .85rem; font-weight: 700; color: var(--paper); margin: 0 0 .2rem; line-height: 1.3; }
.relac-info p { font-size: .75rem; color: var(--muted); margin: 0; font-family: var(--font-sans); }

/* ── RESPONSIVE ───────────────────────── */
@media (max-width: 960px) {
    .hero-inner { grid-template-columns: 1fr; padding-bottom: 2rem; }
    .inscripcion-card { position: static; margin-bottom: 0; }
    .page-body { grid-template-columns: 1fr; }
    .aprende-grid { grid-template-columns: 1fr; }
    .hero-title { font-size: 1.9rem; }
}

@keyframes fadeUp {
    from { opacity: 0; transform: translateY(24px); }
    to   { opacity: 1; transform: translateY(0); }
}
.hero-content > * { animation: fadeUp .55s cubic-bezier(.22,1,.36,1) both; }
.hero-content > *:nth-child(1) { animation-delay: .05s; }
.hero-content > *:nth-child(2) { animation-delay: .12s; }
.hero-content > *:nth-child(3) { animation-delay: .18s; }
.hero-content > *:nth-child(4) { animation-delay: .24s; }
.hero-content > *:nth-child(5) { animation-delay: .30s; }
.inscripcion-card { animation: fadeUp .55s .15s cubic-bezier(.22,1,.36,1) both; }
</style>

{{-- ═══════════════ HERO ═══════════════ --}}
<section class="hero">
    <div class="hero-bg-gradient"></div>
    <div class="hero-bg-dots"></div>

    <div class="hero-inner">
        {{-- Lado izquierdo --}}
        <div class="hero-content">
            <nav class="breadcrumb">
                <a href="{{ route('cursos.index') }}">Cursos</a>
                <span>›</span>
                <a href="{{ route('cursos.index') }}?categoria={{ $curso->categoria }}">{{ $curso->categoriaLabel() }}</a>
                <span>›</span>
                <span style="color:var(--paper);">{{ Str::limit($curso->titulo, 40) }}</span>
            </nav>

            <div class="cat-badge">
                <i class="fas fa-tag"></i> {{ $curso->categoriaLabel() }}
            </div>

            <h1 class="hero-title">{{ $curso->titulo }}</h1>

            <p class="hero-desc">{{ $curso->descripcion_corta ?? Str::limit($curso->descripcion, 200) }}</p>

            <div class="meta-pills">
                <div class="meta-pill"><i class="fas fa-clock"></i> {{ $curso->duracion_horas }} horas</div>
                <div class="meta-pill"><i class="fas fa-list-ul"></i> {{ $totalLecciones }} lecciones</div>
                <div class="meta-pill"><i class="fas fa-users"></i> {{ $curso->totalEstudiantes() }} estudiantes</div>
                @if($curso->modulos->count())
                    <div class="meta-pill"><i class="fas fa-layer-group"></i> {{ $curso->modulos->count() }} módulos</div>
                @endif
                <div class="meta-pill">
                    <i class="fas fa-signal"></i>
                    {{ $curso->tipo === 'free' ? 'Gratuito' : 'De pago' }}
                </div>
            </div>

            <div class="hero-rating">
                <span class="stars">★★★★★</span>
                <span class="rating-text">Actualizado recientemente · Certificado incluido</span>
            </div>
        </div>

        {{-- Card inscripción --}}
        <div>
            <div class="inscripcion-card">
                @if($curso->imagen)
                    <img src="{{ $curso->imagen }}" alt="{{ $curso->titulo }}" class="card-thumb">
                @else
                    <div class="card-thumb-placeholder">
                        <i class="fas {{ $icono }}"></i>
                    </div>
                @endif

                <div class="card-body">
                    <div class="precio-tag {{ $curso->tipo === 'free' ? 'free' : '' }}">
                        {{ $curso->precioFormateado() }}
                    </div>

                    @if($yaInscrito && $progreso > 0)
                        <div class="progress-wrap">
                            <div class="progress-label">
                                <span>Tu progreso</span>
                                <strong style="color:var(--resolved)">{{ $progreso }}%</strong>
                            </div>
                            <div class="progress-bar">
                                <div class="progress-fill" style="width:{{ $progreso }}%"></div>
                            </div>
                        </div>
                    @endif

                    @if($yaInscrito)
                        <a href="{{ route('dashboard.cursos') }}" class="btn-primary enrolled">
                            <i class="fas fa-play-circle"></i> Continuar Curso
                        </a>
                        <div class="garantia-note">
                            <i class="fas fa-check-circle" style="color:var(--resolved)"></i>
                            Ya estás inscrito en este curso
                        </div>
                    @elseif(auth()->check())
                        <form method="POST" action="{{ route('cursos.inscribir', $curso->slug) }}">
                            @csrf
                            <button type="submit" class="btn-primary">
                                <i class="fas fa-fingerprint"></i>
                                {{ $curso->tipo === 'free' ? 'Inscribirme Gratis' : 'Inscribirme Ahora' }}
                            </button>
                        </form>
                        <div class="garantia-note">
                            <i class="fas fa-shield-alt"></i> Acceso de por vida · Sin compromisos
                        </div>
                    @else
                        <a href="{{ route('login') }}?redirect={{ urlencode(request()->url()) }}" class="btn-primary login">
                            <i class="fas fa-sign-in-alt"></i> Iniciar Sesión para Inscribirme
                        </a>
                        <a href="{{ route('register') }}" class="btn-secondary" style="margin-top:.5rem;">
                            <i class="fas fa-user-plus"></i> Crear cuenta gratis
                        </a>
                        <div class="garantia-note">
                            <i class="fas fa-lock"></i> Registro gratuito · Sin tarjeta
                        </div>
                    @endif

                    <div class="incluye-list">
                        <div class="incluye-title">Este curso incluye</div>
                        <div class="incluye-item"><i class="fas fa-clock"></i> {{ $curso->duracion_horas }} horas de contenido</div>
                        <div class="incluye-item"><i class="fas fa-video"></i> {{ $totalLecciones }} lecciones en total</div>
                        <div class="incluye-item"><i class="fas fa-certificate"></i> Certificado de participación</div>
                        <div class="incluye-item"><i class="fas fa-infinity"></i> Acceso de por vida</div>
                        <div class="incluye-item"><i class="fas fa-mobile-alt"></i> Acceso en cualquier dispositivo</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ═══════════════ CUERPO ═══════════════ --}}
<div style="background:var(--lab); padding-top: 1rem;">
<div class="page-body">

    {{-- Columna principal --}}
    <div>

        {{-- Lo que aprenderás --}}
        <div class="aprende-section">
            <h2 class="section-title">
                <i class="fas fa-check-circle"></i> Lo que aprenderás
            </h2>
            <div class="aprende-grid">
                @php
                    $items = $curso->modulos->flatMap(fn($m) => $m->lecciones)->take(8)->map(fn($l) => $l->titulo);
                    if($items->isEmpty()) {
                        $items = collect([
                            'Fundamentos de ' . $curso->categoriaLabel(),
                            'Aplicación práctica de conceptos',
                            'Herramientas y metodologías actuales',
                            'Casos reales y ejercicios prácticos',
                        ]);
                    }
                @endphp
                @foreach($items as $item)
                    <div class="aprende-item">
                        <div class="aprende-check"><i class="fas fa-check" style="font-size:.6rem;"></i></div>
                        <span>{{ $item }}</span>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Tabs --}}
        <div class="tab-nav">
            <button class="tab-btn active" onclick="showTab('contenido',this)">
                <i class="fas fa-list-ul" style="margin-right:.35rem;font-size:.82rem;"></i>Contenido del Curso
            </button>
            @if($curso->descripcion)
                <button class="tab-btn" onclick="showTab('descripcion',this)">
                    <i class="fas fa-align-left" style="margin-right:.35rem;font-size:.82rem;"></i>Descripción
                </button>
            @endif
        </div>

        {{-- Tab: Contenido --}}
        <div id="tab-contenido">
            <p class="modulos-header">
                <strong>{{ $curso->modulos->count() }} módulos</strong> ·
                <strong>{{ $totalLecciones }} lecciones</strong> ·
                <strong>{{ $curso->duracion_horas }} horas</strong> en total
            </p>

            @foreach($curso->modulos as $modulo)
                <div class="modulo-wrap">
                    <div class="modulo-hd" onclick="toggleModulo(this)">
                        <div class="modulo-hd-left">
                            <div class="modulo-num">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</div>
                            <div>
                                <div class="modulo-titulo">{{ $modulo->titulo }}</div>
                                <div class="modulo-count">{{ $modulo->lecciones->count() }} lecciones</div>
                            </div>
                        </div>
                        <i class="fas fa-chevron-down modulo-chevron {{ $loop->first ? 'open' : '' }}"></i>
                    </div>
                    <div class="modulo-body {{ $loop->first ? 'open' : '' }}">
                        @foreach($modulo->lecciones as $leccion)
                            @php
                                $tipoClass = ['texto'=>'tipo-texto','video'=>'tipo-video','pdf'=>'tipo-pdf','quiz'=>'tipo-quiz','tarea'=>'tipo-tarea'][$leccion->tipo_contenido] ?? 'tipo-texto';
                                $tipoIco   = ['texto'=>'fa-file-alt','video'=>'fa-play-circle','pdf'=>'fa-file-pdf','quiz'=>'fa-question-circle','tarea'=>'fa-tasks'][$leccion->tipo_contenido] ?? 'fa-file-alt';
                            @endphp
                            <div class="leccion-row">
                                <div class="lec-ico {{ $tipoClass }}">
                                    <i class="fas {{ $tipoIco }}"></i>
                                </div>
                                <span class="lec-titulo">{{ $leccion->titulo }}</span>
                                @if($leccion->duracion_minutos)
                                    <span class="lec-dur">
                                        <i class="fas fa-clock" style="font-size:.7rem;margin-right:.2rem;"></i>
                                        {{ $leccion->duracion_minutos }}min
                                    </span>
                                @endif
                                @if($yaInscrito)
                                    <span class="lec-free-badge"><i class="fas fa-unlock" style="font-size:.6rem;"></i> Disponible</span>
                                @else
                                    <i class="fas fa-lock lec-lock"></i>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach

            @if($curso->modulos->isEmpty())
                <div style="text-align:center;padding:3rem;color:var(--muted);font-family:var(--font-sans);">
                    <i class="fas fa-layer-group" style="font-size:2rem;display:block;margin-bottom:.75rem;opacity:.3;"></i>
                    Contenido próximamente disponible.
                </div>
            @endif
        </div>

        {{-- Tab: Descripción --}}
        @if($curso->descripcion)
            <div id="tab-descripcion" style="display:none;">
                <div style="font-size:.95rem;color:var(--muted);line-height:1.85;font-family:var(--font-sans);">
                    {!! nl2br(e($curso->descripcion)) !!}
                </div>
            </div>
        @endif

    </div>

    {{-- Sidebar --}}
    <div>

        {{-- Cursos relacionados --}}
        @if($cursosRelacionados->count())
            <div class="sidebar-card">
                <div class="sidebar-title">También te puede interesar</div>
                @foreach($cursosRelacionados as $rel)
                    @php $rc = explode(',', $rel->color_gradiente ?? '#15252F,#27404E'); @endphp
                    <a href="{{ route('cursos.show', $rel->slug) }}" class="relac-item">
                        <div class="relac-thumb" style="background:linear-gradient(135deg,{{ $rc[0] }},{{ $rc[1] ?? '#27404E' }});">
                            <i class="fas {{ $rel->icono_fa ?? 'fa-fingerprint' }}"></i>
                        </div>
                        <div class="relac-info">
                            <h4>{{ Str::limit($rel->titulo, 45) }}</h4>
                            <p>{{ $rel->precioFormateado() }} · {{ $rel->duracion_horas }}h · {{ $rel->categoriaLabel() }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
        @endif

        {{-- Stats del curso --}}
        <div class="sidebar-card">
            <div class="sidebar-title">Detalles del curso</div>
            <div class="incluye-item"><i class="fas fa-tag"></i> {{ $curso->categoriaLabel() }}</div>
            <div class="incluye-item"><i class="fas fa-clock"></i> {{ $curso->duracion_horas }} horas de duración</div>
            <div class="incluye-item"><i class="fas fa-list"></i> {{ $totalLecciones }} lecciones</div>
            <div class="incluye-item"><i class="fas fa-layer-group"></i> {{ $curso->modulos->count() }} módulos</div>
            <div class="incluye-item"><i class="fas fa-users"></i> {{ $curso->totalEstudiantes() }} estudiantes inscritos</div>
            <div class="incluye-item"><i class="fas fa-certificate"></i> Certificado al completar</div>
            <div class="incluye-item">
                <i class="fas fa-signal"></i>
                Nivel: {{ $curso->tipo === 'free' ? 'Gratuito' : 'De pago' }}
            </div>
        </div>

        {{-- CTA si no inscrito --}}
        @if(!$yaInscrito)
            <div style="background:var(--panel);border:1px solid var(--line);border-radius:16px;padding:1.5rem;text-align:center;">
                <i class="fas {{ $icono }}" style="font-size:2rem;color:var(--tag);display:block;margin-bottom:.75rem;"></i>
                <p style="color:var(--paper);font-family:var(--font-sans);font-size:.9rem;margin:0 0 1rem;line-height:1.5;">
                    ¿Listo para empezar? Inscríbete ahora y accede a todo el contenido.
                </p>
                @if(auth()->check())
                    <form method="POST" action="{{ route('cursos.inscribir', $curso->slug) }}">
                        @csrf
                        <button type="submit" style="width:100%;padding:.8rem;background:var(--tag);color:#1A1203;border:none;border-radius:10px;font-family:var(--font-sans);font-size:.88rem;font-weight:600;cursor:pointer;transition:opacity .2s;">
                            <i class="fas fa-fingerprint"></i>
                            {{ $curso->tipo === 'free' ? 'Inscribirme Gratis' : 'Inscribirme' }}
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" style="display:block;width:100%;padding:.8rem;background:var(--uv);color:#fff;border-radius:10px;font-family:var(--font-sans);font-size:.88rem;font-weight:600;text-decoration:none;transition:opacity .2s;">
                        <i class="fas fa-sign-in-alt"></i> Iniciar Sesión
                    </a>
                @endif
            </div>
        @endif

    </div>
</div>
</div>

@push('scripts')
<script>
function showTab(id, btn) {
    document.querySelectorAll('[id^="tab-"]').forEach(el => el.style.display = 'none');
    document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
    document.getElementById('tab-' + id).style.display = 'block';
    btn.classList.add('active');
}

function toggleModulo(el) {
    const body = el.nextElementSibling;
    const icon = el.querySelector('.modulo-chevron');
    const isOpen = body.classList.contains('open');
    body.classList.toggle('open', !isOpen);
    icon.classList.toggle('open', !isOpen);
}

document.addEventListener('DOMContentLoaded', () => {
    const firstChevron = document.querySelector('.modulo-chevron');
    if (firstChevron) firstChevron.classList.add('open');
});
</script>
@endpush
@endsection
