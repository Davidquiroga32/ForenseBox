@extends('layouts.app')

@section('title', 'ForenseBox — Aprendizaje en Ciberseguridad y Forensia Digital')
@section('description', 'Plataforma de formación en ciberseguridad, forensia digital y análisis de evidencia digital.')

@section('content')

<style>
:root {
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

/* ══════════════════════════════════
    HERO SLIDER
══════════════════════════════════ */
.hero-section {
    position: relative;
    height: 92vh;
    min-height: 680px;
    max-height: 920px;
    overflow: hidden;
    font-family: var(--font-sans);
    background: var(--lab-deep);
}

.slide {
    position: absolute; inset: 0;
    background-color: var(--lab-deep);
    opacity: 0;
    transition: opacity 1s ease;
    display: flex; align-items: center;
    overflow: hidden;
}
.slide.active { opacity: 1; z-index: 1; }

/* Imagen de fondo con zoom sutil (Ken Burns) */
.slide-img {
    position: absolute; inset: 0;
    background-size: cover;
    background-position: center;
    transform: scale(1);
    transition: transform 8s ease;
}
.slide.active .slide-img { transform: scale(1.07); }

/* Fondo tipo grid de laboratorio */
.slide-grid {
    position: absolute; inset: 0;
    background-image:
        linear-gradient(rgba(142,123,255,.04) 1px, transparent 1px),
        linear-gradient(90deg, rgba(142,123,255,.04) 1px, transparent 1px);
    background-size: 56px 56px;
    opacity: .3;
    mask-image: radial-gradient(ellipse 90% 90% at 50% 40%, black 40%, transparent 100%);
}
.slide-glow {
    position: absolute; width: 620px; height: 620px; border-radius: 50%;
    background: radial-gradient(rgba(142,123,255,.1), transparent 70%);
    top: -180px; right: -120px; pointer-events: none;
}
.slide-glow.amber {
    background: radial-gradient(rgba(242,179,61,.07), transparent 70%);
    bottom: -220px; left: -140px; top: auto; right: auto;
}
.slide-overlay {
    position: absolute; inset: 0;
    background:
        linear-gradient(90deg, rgba(10,18,27,.85) 0%, rgba(10,18,27,.58) 40%, rgba(10,18,27,.25) 70%, rgba(10,18,27,.08) 100%),
        linear-gradient(0deg, rgba(10,18,27,.55) 0%, rgba(10,18,27,.08) 40%, rgba(10,18,27,.05) 100%);
}

.slide-inner {
    position: relative; z-index: 2;
    max-width: 1200px; margin: 0 auto;
    padding: 0 2rem;
    width: 100%;
    padding-bottom: 140px;
}

.slide-tag {
    display: inline-flex; align-items: center; gap: .5rem;
    background: rgba(142,123,255,.12);
    border: 1px solid rgba(142,123,255,.35);
    color: #c9bfff;
    font-family: var(--font-mono);
    font-size: .72rem; font-weight: 500;
    padding: .4rem 1rem; border-radius: 999px;
    text-transform: uppercase; letter-spacing: .14em;
    margin-bottom: 1.25rem;
    opacity: 0; transform: translateY(15px);
    transition: all .6s .1s ease;
}
.slide-tag .dot { width: 7px; height: 7px; border-radius: 50%; background: var(--resolved); }

.slide-title {
    font-size: clamp(2rem, 4.5vw, 3.5rem);
    font-weight: 800; color: var(--paper);
    line-height: 1.08; letter-spacing: -.02em;
    margin: 0 0 1.25rem;
    max-width: 640px;
    opacity: 0; transform: translateY(20px);
    transition: all .65s .2s ease;
}
.slide-title span {
    background: linear-gradient(90deg, #F2B33D, #ffd98a);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.slide-desc {
    font-family: var(--font-sans);
    font-size: 1.1rem; color: var(--muted);
    line-height: 1.7; max-width: 520px;
    margin-bottom: 2rem;
    opacity: 0; transform: translateY(15px);
    transition: all .65s .32s ease;
}

.slide-btns {
    display: flex; gap: .875rem; flex-wrap: wrap;
    opacity: 0; transform: translateY(15px);
    transition: all .65s .44s ease;
}

.slide.active .slide-tag,
.slide.active .slide-title,
.slide.active .slide-desc,
.slide.active .slide-btns {
    opacity: 1; transform: translateY(0);
}

.hero-btn-primary {
    display: inline-flex; align-items: center; gap: .5rem;
    padding: .9rem 1.85rem;
    background: var(--tag); color: #1A1203;
    border: none; border-radius: 10px;
    font-family: var(--font-sans); font-size: .95rem; font-weight: 600;
    text-decoration: none; cursor: pointer;
    box-shadow: 0 6px 24px rgba(242,179,61,.3);
    transition: transform .2s, box-shadow .2s;
}
.hero-btn-primary:hover { transform: translateY(-3px); box-shadow: 0 10px 34px rgba(242,179,61,.45); color: #1A1203; }

.hero-btn-ghost {
    display: inline-flex; align-items: center; gap: .5rem;
    padding: .9rem 1.85rem;
    background: rgba(142,123,255,.08);
    border: 1.5px solid rgba(142,123,255,.4);
    color: #c9bfff; border-radius: 10px;
    font-family: var(--font-sans); font-size: .95rem; font-weight: 600;
    text-decoration: none; transition: all .2s;
}
.hero-btn-ghost:hover { background: rgba(142,123,255,.16); border-color: var(--uv); color: #fff; transform: translateY(-2px); }

/* Stats flotantes */
.hero-stats {
    position: absolute; bottom: 1.5rem; left: 50%;
    transform: translateX(-50%);
    z-index: 5;
    display: flex; gap: 1px;
    background: rgba(21,37,47,.7);
    backdrop-filter: blur(16px);
    border: 1px solid var(--line);
    border-radius: 16px;
    overflow: hidden;
    max-width: 680px; width: 90%;
}
.hero-stat {
    flex: 1; padding: 1rem 1.25rem;
    text-align: center;
    border-right: 1px solid var(--line-soft);
}
.hero-stat:last-child { border-right: none; }
.hero-stat-num {
    font-family: var(--font-mono);
    font-size: 1.4rem; font-weight: 700; color: var(--paper);
    line-height: 1;
}
.hero-stat-num span { color: var(--tag); }
.hero-stat-label {
    font-family: var(--font-sans);
    font-size: .72rem; color: var(--muted);
    margin-top: .25rem;
    text-transform: uppercase; letter-spacing: .05em;
}

/* Controles slider */
.slider-nav {
    position: absolute; bottom: 6.5rem; right: 2rem;
    z-index: 5; display: flex; gap: .5rem;
}
.slider-dot {
    width: 8px; height: 8px; border-radius: 50%;
    background: rgba(255,255,255,.2); border: none; cursor: pointer;
    transition: all .3s; padding: 0;
}
.slider-dot.active { width: 28px; border-radius: 4px; background: var(--tag); }

/* ══════════════════════════════════
   SECCIÓN STATS / NÚMEROS
══════════════════════════════════ */
.stats-bar { background: var(--lab); padding: 2.5rem 1.5rem; border-bottom: 1px solid var(--line-soft); }
.stats-bar-inner {
    max-width: 1100px; margin: 0 auto;
    display: grid; grid-template-columns: repeat(4, 1fr);
    gap: 1px; background: var(--line);
    border: 1px solid var(--line); border-radius: 16px;
    overflow: hidden;
}
.stat-item { background: var(--panel); padding: 1.75rem 1.5rem; text-align: center; transition: background .2s; }
.stat-item:hover { background: var(--panel-2); }
.stat-number { font-family: var(--font-mono); font-size: 2rem; font-weight: 700; color: var(--paper); line-height: 1; }
.stat-number em { font-style: normal; color: var(--tag); }
.stat-label { font-family: var(--font-sans); font-size: .82rem; color: var(--muted); margin-top: .4rem; }

/* ══════════════════════════════════
   SECCIONES GENERALES
══════════════════════════════════ */
.ca-section { padding: 5rem 1.5rem; font-family: var(--font-sans); }
.ca-section.alt { background: var(--lab-deep); border-top: 1px solid var(--line-soft); border-bottom: 1px solid var(--line-soft); }
.ca-container { max-width: 1100px; margin: 0 auto; }

.sec-eyebrow {
    display: inline-flex; align-items: center; gap: .4rem;
    font-family: var(--font-mono);
    font-size: .68rem; font-weight: 500;
    color: var(--tag);
    text-transform: uppercase; letter-spacing: .16em;
    background: var(--tag-soft);
    border: 1px solid var(--tag-border);
    padding: .35rem .875rem; border-radius: 999px;
    margin-bottom: 1rem;
}
.sec-title {
    font-family: var(--font-sans);
    font-size: clamp(1.75rem, 3vw, 2.5rem);
    font-weight: 800; color: var(--paper);
    margin: 0 0 1rem; line-height: 1.2;
    letter-spacing: -.02em;
}
.sec-title span { color: var(--tag); }
.sec-desc { font-size: 1rem; color: var(--muted); line-height: 1.75; max-width: 600px; }

/* ══════════════════════════════════
   QUIÉNES SOMOS
══════════════════════════════════ */
.about-layout { display: grid; grid-template-columns: 1fr 1fr; gap: 4rem; align-items: center; }
.about-visual { position: relative; }
.about-img-wrap {
    border-radius: 20px; overflow: hidden;
    box-shadow: 0 20px 60px rgba(0,0,0,.45);
    aspect-ratio: 4/3;
    background: var(--panel);
    border: 1px solid var(--line);
    display: flex; align-items: center; justify-content: center;
    font-size: 5rem; color: rgba(142,123,255,.35);
    position: relative;
}
.about-img-wrap::before {
    content: '';
    position: absolute; inset: 0;
    background-image:
        linear-gradient(rgba(142,123,255,.08) 1px, transparent 1px),
        linear-gradient(90deg, rgba(142,123,255,.08) 1px, transparent 1px);
    background-size: 32px 32px;
}
.about-img-wrap i { position: relative; z-index: 1; }
.about-badge {
    position: absolute; bottom: -1.5rem; right: -1.5rem;
    background: var(--panel-2); border: 1px solid var(--line);
    color: var(--paper); border-radius: 16px; padding: 1.25rem 1.5rem;
    box-shadow: 0 8px 32px rgba(0,0,0,.45);
    text-align: center;
}
.about-badge-num { font-family: var(--font-mono); font-size: 1.9rem; font-weight: 700; color: var(--tag); line-height: 1; }
.about-badge-txt { font-size: .72rem; color: var(--muted); margin-top: .25rem; }

.about-cards { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-top: 2rem; }
.about-card-mini {
    background: var(--panel);
    border: 1px solid var(--line);
    border-radius: 14px; padding: 1.25rem;
    border-left: 3px solid var(--uv);
    transition: transform .2s, box-shadow .2s;
}
.about-card-mini:hover { transform: translateY(-3px); box-shadow: 0 8px 24px rgba(0,0,0,.35); }
.about-card-mini h4 {
    font-family: var(--font-sans);
    font-size: .9rem; font-weight: 800; color: var(--paper);
    margin: 0 0 .4rem; display: flex; align-items: center; gap: .4rem;
}
.about-card-mini h4 i { color: var(--uv); font-size: .85rem; }
.about-card-mini p { font-size: .83rem; color: var(--muted); margin: 0; line-height: 1.55; }

/* ══════════════════════════════════
   VALORES
══════════════════════════════════ */
.valores-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 1.25rem; margin-top: 3rem; }
.valor-card {
    background: var(--panel);
    border: 1px solid var(--line);
    border-radius: 18px; padding: 2rem 1.5rem;
    text-align: center;
    transition: all .25s;
    position: relative; overflow: hidden;
}
.valor-card::before {
    content: '';
    position: absolute; top: 0; left: 0; right: 0;
    height: 3px;
    background: linear-gradient(90deg, var(--uv), var(--tag));
    transform: scaleX(0); transform-origin: left;
    transition: transform .3s;
}
.valor-card:hover::before { transform: scaleX(1); }
.valor-card:hover { transform: translateY(-5px); box-shadow: 0 12px 40px rgba(0,0,0,.4); border-color: var(--uv); }
.valor-ico {
    width: 64px; height: 64px; margin: 0 auto 1.25rem;
    border-radius: 18px;
    background: linear-gradient(135deg, var(--uv), #6a58e0);
    display: flex; align-items: center; justify-content: center;
    font-size: 1.5rem; color: #fff;
    box-shadow: 0 6px 20px rgba(142,123,255,.3);
}
.valor-card h3 { font-family: var(--font-sans); font-size: 1rem; font-weight: 800; color: var(--paper); margin: 0 0 .6rem; }
.valor-card p { font-size: .83rem; color: var(--muted); margin: 0; line-height: 1.6; }

/* ══════════════════════════════════
   SERVICIOS / ÁREAS
══════════════════════════════════ */
.servicios-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.5rem; margin-top: 3rem; }
.servicio-card {
    border-radius: 20px; overflow: hidden;
    background: var(--panel); border: 1px solid var(--line);
    transition: all .25s;
    display: flex; flex-direction: column;
}
.servicio-card:hover { transform: translateY(-6px); box-shadow: 0 16px 48px rgba(0,0,0,.45); border-color: var(--uv); }
.servicio-img {
    height: 170px;
    display: flex; align-items: center; justify-content: center;
    font-size: 3rem; color: #c9bfff;
    position: relative; overflow: hidden;
    background: var(--lab-deep);
}
.servicio-img::before {
    content: '';
    position: absolute; inset: 0;
    background-image:
        linear-gradient(rgba(142,123,255,.1) 1px, transparent 1px),
        linear-gradient(90deg, rgba(142,123,255,.1) 1px, transparent 1px);
    background-size: 28px 28px;
}
.servicio-img i { position: relative; z-index: 1; }
.servicio-body { padding: 1.75rem; flex: 1; display: flex; flex-direction: column; }
.servicio-badge {
    display: inline-flex; align-items: center; gap: .3rem;
    font-family: var(--font-mono);
    font-size: .66rem; font-weight: 500; color: var(--uv);
    background: var(--uv-soft); padding: .25rem .6rem;
    border-radius: 999px; margin-bottom: .875rem;
    text-transform: uppercase; letter-spacing: .1em;
}
.servicio-body h3 { font-family: var(--font-sans); font-size: 1.15rem; font-weight: 800; color: var(--paper); margin: 0 0 .75rem; line-height: 1.2; }
.servicio-body p { font-size: .88rem; color: var(--muted); line-height: 1.7; margin: 0 0 1.5rem; flex: 1; }
.servicio-btn {
    display: inline-flex; align-items: center; justify-content: center; gap: .5rem;
    padding: .75rem 1.25rem;
    background: var(--tag); color: #1A1203;
    border: none; border-radius: 10px;
    font-family: var(--font-sans); font-size: .88rem; font-weight: 600;
    text-decoration: none; transition: all .2s;
    box-shadow: 0 3px 12px rgba(242,179,61,.2);
}
.servicio-btn:hover { opacity: .92; transform: translateY(-1px); color: #1A1203; }

/* ══════════════════════════════════
   CURSOS DESTACADOS
══════════════════════════════════ */
.cursos-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.25rem; margin-top: 2.5rem; }
.curso-mini-card {
    background: var(--panel); border: 1px solid var(--line);
    border-radius: 16px; overflow: hidden;
    transition: all .22s; text-decoration: none;
    display: flex; flex-direction: column;
}
.curso-mini-card:hover { transform: translateY(-4px); box-shadow: 0 10px 36px rgba(0,0,0,.4); border-color: var(--uv); }
.curso-thumb {
    height: 130px;
    display: flex; align-items: center; justify-content: center;
    font-size: 2.25rem; color: rgba(232,238,240,.7);
    position: relative;
    background: var(--lab-deep);
}
.curso-thumb::before {
    content: '';
    position: absolute; inset: 0;
    background-image:
        linear-gradient(rgba(142,123,255,.08) 1px, transparent 1px),
        linear-gradient(90deg, rgba(142,123,255,.08) 1px, transparent 1px);
    background-size: 26px 26px;
}
.curso-thumb img { position: absolute; inset: 0; width: 100%; height: 100%; object-fit: cover; }
.curso-thumb-ico { position: relative; z-index: 1; }
.curso-mini-body { padding: 1.25rem; flex: 1; display: flex; flex-direction: column; }
.curso-cat-badge {
    display: inline-block;
    font-family: var(--font-mono);
    font-size: .64rem; font-weight: 500; color: var(--uv);
    background: var(--uv-soft); padding: .2rem .55rem;
    border-radius: 999px; margin-bottom: .6rem;
    text-transform: uppercase;
}
.curso-mini-body h4 { font-family: var(--font-sans); font-size: .95rem; font-weight: 800; color: var(--paper); margin: 0 0 .4rem; line-height: 1.3; }
.curso-mini-meta {
    font-size: .78rem; color: var(--muted); margin-top: auto; padding-top: .75rem;
    display: flex; justify-content: space-between; align-items: center;
    border-top: 1px solid var(--line-soft);
}
.curso-free { color: var(--resolved); font-weight: 700; }

/* ══════════════════════════════════
   CTA FINAL
══════════════════════════════════ */
.cta-section {
    position: relative; overflow: hidden;
    background: linear-gradient(135deg, var(--lab-deep) 0%, #14253a 100%);
    padding: 5rem 1.5rem; text-align: center;
    font-family: var(--font-sans);
    border-top: 1px solid var(--line-soft);
}
.cta-section::before {
    content: '';
    position: absolute; inset: 0;
    background-image: radial-gradient(rgba(142,123,255,.08) 1.5px, transparent 1.5px);
    background-size: 32px 32px;
}
.cta-inner { position: relative; z-index: 2; max-width: 680px; margin: 0 auto; }
.cta-eyebrow {
    display: inline-block;
    font-family: var(--font-mono);
    font-size: .7rem; font-weight: 500; letter-spacing: .18em;
    text-transform: uppercase; color: var(--tag);
    background: var(--tag-soft); border: 1px solid var(--tag-border);
    padding: .35rem 1rem; border-radius: 999px; margin-bottom: 1.25rem;
}
.cta-title { font-size: clamp(1.75rem, 3.5vw, 2.75rem); font-weight: 800; color: var(--paper); line-height: 1.15; margin: 0 0 1rem; letter-spacing: -.02em; }
.cta-desc { font-size: 1.05rem; color: var(--muted); line-height: 1.7; margin-bottom: 2.5rem; }
.cta-btns { display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap; }
.cta-btn-main {
    display: inline-flex; align-items: center; gap: .5rem;
    padding: 1rem 2.25rem;
    background: var(--tag); color: #1A1203;
    border: none; border-radius: 12px;
    font-family: var(--font-sans); font-size: 1rem; font-weight: 600;
    text-decoration: none; cursor: pointer;
    box-shadow: 0 6px 22px rgba(242,179,61,.3);
    transition: all .2s;
}
.cta-btn-main:hover { transform: translateY(-3px); box-shadow: 0 10px 32px rgba(242,179,61,.4); color: #1A1203; }
.cta-btn-ghost {
    display: inline-flex; align-items: center; gap: .5rem;
    padding: 1rem 2.25rem;
    background: rgba(142,123,255,.08);
    border: 1.5px solid rgba(142,123,255,.4);
    color: #c9bfff; border-radius: 12px;
    font-family: var(--font-sans); font-size: 1rem; font-weight: 600;
    text-decoration: none; transition: all .2s;
}
.cta-btn-ghost:hover { background: rgba(142,123,255,.16); color: #fff; transform: translateY(-2px); }

/* Responsive */
@media (max-width: 960px) {
    .about-layout { grid-template-columns: 1fr; }
    .about-visual { display: none; }
    .valores-grid { grid-template-columns: repeat(2,1fr); }
    .servicios-grid { grid-template-columns: 1fr; }
    .cursos-grid { grid-template-columns: repeat(2,1fr); }
    .stats-bar-inner { grid-template-columns: repeat(2,1fr); }
    .hero-stats { display: none; }
}
@media (max-width: 600px) {
    .valores-grid { grid-template-columns: 1fr; }
    .cursos-grid { grid-template-columns: 1fr; }
    .stats-bar-inner { grid-template-columns: 1fr 1fr; }
    .about-cards { grid-template-columns: 1fr; }
    .slide-title { font-size: 1.75rem; }
}
</style>

{{-- ══════════════ HERO SLIDER ══════════════ --}}
<section class="hero-section" id="heroSlider">

    {{-- Slide 1 --}}
    <div class="slide active">
        <div class="slide-img" style="background-image: url('https://images.unsplash.com/photo-1522202176988-66273c2fd55f?w=1600&q=80');"></div>
        <div class="slide-grid"></div>
        <div class="slide-glow"></div>
        <div class="slide-glow amber"></div>
        <div class="slide-overlay"></div>
        <div class="slide-inner">
            <div class="slide-tag"><span class="dot"></span> Forensia Digital · Ciberseguridad</div>
            <h1 class="slide-title">Aprende a Investigar la <span>Evidencia Digital</span></h1>
            <p class="slide-desc">Cursos prácticos en análisis forense, respuesta a incidentes y seguridad ofensiva. Convierte los datos en evidencia y la evidencia en conocimiento.</p>
            <div class="slide-btns">
                <a href="{{ route('cursos.index') }}" class="hero-btn-primary"><i class="fas fa-flask"></i> Explorar Cursos</a>
                <a href="#acerca" class="hero-btn-ghost"><i class="fas fa-info-circle"></i> Conocer Más</a>
            </div>
        </div>
    </div>

    {{-- Slide 2 --}}
    <div class="slide">
        <div class="slide-img" style="background-image: url('https://images.unsplash.com/photo-1524178232363-1fb2b075b655?w=1600&q=80');"></div>
        <div class="slide-grid"></div>
        <div class="slide-glow"></div>
        <div class="slide-glow amber"></div>
        <div class="slide-overlay"></div>
        <div class="slide-inner">
            <div class="slide-tag"><span class="dot"></span> Laboratorio Práctico</div>
            <h1 class="slide-title">Entrena con <span>Casos Reales</span> y Escenarios</h1>
            <p class="slide-desc">Simulaciones, retos CTF y laboratorios guiados para dominar herramientas de análisis, memoria, red y disco.</p>
            <div class="slide-btns">
                <a href="{{ route('cursos.index') }}" class="hero-btn-primary"><i class="fas fa-terminal"></i> Ver Programas</a>
                <a href="{{ route('contacto') }}" class="hero-btn-ghost"><i class="fas fa-headset"></i> Hablar con Nosotros</a>
            </div>
        </div>
    </div>

    {{-- Slide 3 --}}
    <div class="slide">
        <div class="slide-img" style="background-image: url('https://images.unsplash.com/photo-1531482615713-2afd69097998?w=1600&q=80');"></div>
        <div class="slide-grid"></div>
        <div class="slide-glow"></div>
        <div class="slide-glow amber"></div>
        <div class="slide-overlay"></div>
        <div class="slide-inner">
            <div class="slide-tag"><span class="dot"></span> Certificación Verificable</div>
            <h1 class="slide-title">Formación que se <span>Valida y Certifica</span></h1>
            <p class="slide-desc">Aprende a tu ritmo, completa evaluaciones y obtén certificados con código de verificación pública.</p>
            <div class="slide-btns">
                <a href="{{ route('register') }}" class="hero-btn-primary"><i class="fas fa-user-plus"></i> Comenzar Gratis</a>
                <a href="#valores" class="hero-btn-ghost"><i class="fas fa-eye"></i> Nuestro Enfoque</a>
            </div>
        </div>
    </div>

    {{-- Controles --}}
    <div class="slider-nav">
        <button class="slider-dot active" data-slide="0"></button>
        <button class="slider-dot" data-slide="1"></button>
        <button class="slider-dot" data-slide="2"></button>
    </div>

    {{-- Stats flotantes --}}
    <div class="hero-stats">
        <div class="hero-stat">
            <div class="hero-stat-num">+<span>350</span></div>
            <div class="hero-stat-label">Estudiantes</div>
        </div>
        <div class="hero-stat">
            <div class="hero-stat-num"><span>12</span></div>
            <div class="hero-stat-label">Cursos</div>
        </div>
        <div class="hero-stat">
            <div class="hero-stat-num"><span>40</span>+</div>
            <div class="hero-stat-label">Laboratorios</div>
        </div>
        <div class="hero-stat">
            <div class="hero-stat-num"><span>98</span>%</div>
            <div class="hero-stat-label">Satisfacción</div>
        </div>
    </div>
</section>

{{-- ══════════════ STATS BAR ══════════════ --}}
<div class="stats-bar">
    <div class="stats-bar-inner">
        <div class="stat-item">
            <div class="stat-number">+<em>350</em></div>
            <div class="stat-label">Profesionales formados</div>
        </div>
        <div class="stat-item">
            <div class="stat-number"><em>15</em>+</div>
            <div class="stat-label">Programas especializados</div>
        </div>
        <div class="stat-item">
            <div class="stat-number"><em>40</em>+</div>
            <div class="stat-label">Laboratorios prácticos</div>
        </div>
        <div class="stat-item">
            <div class="stat-number"><em>98</em>%</div>
            <div class="stat-label">Índice de satisfacción</div>
        </div>
    </div>
</div>

{{-- ══════════════ QUIÉNES SOMOS ══════════════ --}}
<section class="ca-section" id="acerca">
    <div class="ca-container">
        <div class="about-layout">
            <div class="about-visual">
                <div class="about-img-wrap">
                    <i class="fas fa-fingerprint"></i>
                </div>
                <div class="about-badge">
                    <div class="about-badge-num">+5</div>
                    <div class="about-badge-txt">Áreas de especialización</div>
                </div>
            </div>
            <div>
                <div class="sec-eyebrow"><i class="fas fa-info-circle"></i> Quiénes Somos</div>
                <h2 class="sec-title">Somos <span>ForenseBox</span></h2>
                <p class="sec-desc">
                    Una plataforma de formación en ciberseguridad y forensia digital, diseñada para
                    quienes quieren aprender a investigar, proteger y analizar evidencia en el mundo digital.
                </p>
                <div class="about-cards">
                    <div class="about-card-mini">
                        <h4><i class="fas fa-bullseye"></i> Nuestra Misión</h4>
                        <p>Formar profesionales capaces de identificar, preservar y analizar evidencia digital con rigor técnico y ético.</p>
                    </div>
                    <div class="about-card-mini" id="vision">
                        <h4><i class="fas fa-eye"></i> Nuestra Visión</h4>
                        <p>Ser referentes en educación en ciberseguridad y forensia digital en la región, generando talento confiable y capacitado.</p>
                    </div>
                    <div class="about-card-mini">
                        <h4><i class="fas fa-handshake"></i> Nuestra Propuesta</h4>
                        <p>Un modelo práctico: laboratorios, casos y herramientas reales, combinados con acompañamiento de expertos.</p>
                    </div>
                    <div class="about-card-mini">
                        <h4><i class="fas fa-microscope"></i> Nuestro Método</h4>
                        <p>Aprender haciendo. Cada curso combina teoría con práctica guiada en entornos controlados.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ══════════════ VALORES ══════════════ --}}
<section class="ca-section alt" id="valores">
    <div class="ca-container">
        <div style="text-align:center; margin-bottom: .5rem;">
            <div class="sec-eyebrow"><i class="fas fa-heart"></i> Nuestros Principios</div>
        </div>
        <h2 class="sec-title" style="text-align:center;">Valores que nos <span>Guían</span></h2>
        <div class="valores-grid">
            <div class="valor-card">
                <div class="valor-ico"><i class="fas fa-shield-halved"></i></div>
                <h3>Integridad</h3>
                <p>Manejamos el conocimiento con ética, cadena de custodia y responsabilidad profesional.</p>
            </div>
            <div class="valor-card">
                <div class="valor-ico"><i class="fas fa-star"></i></div>
                <h3>Rigor Técnico</h3>
                <p>Metodología forense, precisión en el detalle y validación constante de resultados.</p>
            </div>
            <div class="valor-card">
                <div class="valor-ico"><i class="fas fa-user-secret"></i></div>
                <h3>Transparencia</h3>
                <p>Actuamos con honestidad y trazabilidad en todos nuestros procesos y contenidos.</p>
            </div>
            <div class="valor-card">
                <div class="valor-ico"><i class="fas fa-seedling"></i></div>
                <h3>Actualización</h3>
                <p>Contenido al día con las amenazas, herramientas y estándares del sector.</p>
            </div>
        </div>
    </div>
</section>

{{-- ══════════════ ÁREAS / SERVICIOS ══════════════ --}}
<section class="ca-section" id="servicios">
    <div class="ca-container">
        <div style="text-align:center; margin-bottom: .5rem;">
            <div class="sec-eyebrow"><i class="fas fa-cogs"></i> Áreas de Estudio</div>
        </div>
        <h2 class="sec-title" style="text-align:center;">Nuestras <span>Especialidades</span></h2>
        <p class="sec-desc" style="text-align:center; margin: 0 auto 0;">Rutas de aprendizaje alineadas con la práctica profesional</p>
        <div class="servicios-grid">
            <div class="servicio-card">
                <div class="servicio-img"><i class="fas fa-fingerprint"></i></div>
                <div class="servicio-body">
                    <div class="servicio-badge"><i class="fas fa-search"></i> Forensia</div>
                    <h3>Análisis Forense Digital</h3>
                    <p>Adquisición y análisis de evidencia en disco, memoria y red. Cadena de custodia y reportes periciales.</p>
                    <a href="{{ route('cursos.index') }}" class="servicio-btn"><i class="fas fa-arrow-right"></i> Ver Cursos</a>
                </div>
            </div>
            <div class="servicio-card">
                <div class="servicio-img"><i class="fas fa-shield-halved"></i></div>
                <div class="servicio-body">
                    <div class="servicio-badge"><i class="fas fa-lock"></i> Seguridad</div>
                    <h3>Ciberseguridad Ofensiva</h3>
                    <p>Ethical hacking, pruebas de penetración, explotación controlada y hardening de sistemas.</p>
                    <a href="{{ route('cursos.index') }}" class="servicio-btn"><i class="fas fa-arrow-right"></i> Ver Cursos</a>
                </div>
            </div>
            <div class="servicio-card">
                <div class="servicio-img"><i class="fas fa-bug"></i></div>
                <div class="servicio-body">
                    <div class="servicio-badge"><i class="fas fa-terminal"></i> IR & Malware</div>
                    <h3>Respuesta a Incidentes</h3>
                    <p>Detección, contención y análisis de malware. Gestión de incidentes y recuperación segura.</p>
                    <a href="{{ route('normatividad') }}" class="servicio-btn"><i class="fas fa-arrow-right"></i> Conocer Más</a>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ══════════════ CURSOS DESTACADOS ══════════════ --}}
@php
    $cursosDestacados = \App\Models\Curso::where('activo', true)
        ->orderByDesc('destacado')->orderBy('orden')->take(3)->get();
@endphp
@if($cursosDestacados->count())
<section class="ca-section alt">
    <div class="ca-container">
        <div style="display:flex; align-items:flex-end; justify-content:space-between; flex-wrap:wrap; gap:1rem; margin-bottom:2.5rem;">
            <div>
                <div class="sec-eyebrow"><i class="fas fa-fire"></i> Cursos Populares</div>
                <h2 class="sec-title" style="margin-bottom:0;">Aprende con Nuestros <span>Mejores Cursos</span></h2>
            </div>
            <a href="{{ route('cursos.index') }}" style="display:inline-flex;align-items:center;gap:.4rem;color:var(--uv);font-family:var(--font-sans);font-weight:600;font-size:.9rem;text-decoration:none;">
                Ver todos <i class="fas fa-arrow-right"></i>
            </a>
        </div>
        <div class="cursos-grid">
            @foreach($cursosDestacados as $c)
                @php $rc = explode(',', $c->color_gradiente ?? '#0E1A24,#27404E'); @endphp
                <a href="{{ route('cursos.show', $c->slug) }}" class="curso-mini-card">
                    <div class="curso-thumb" style="background:linear-gradient(135deg,{{ $rc[0] }},{{ $rc[1] ?? '#27404E' }});">
                        @if($c->imagen)
                            <img src="{{ $c->imagen }}" alt="{{ $c->titulo }}">
                        @endif
                        <div class="curso-thumb-ico"><i class="fas {{ $c->icono_fa ?? 'fa-fingerprint' }}"></i></div>
                    </div>
                    <div class="curso-mini-body">
                        <span class="curso-cat-badge">{{ $c->categoriaLabel() }}</span>
                        <h4>{{ $c->titulo }}</h4>
                        <p style="font-size:.82rem;color:var(--muted);margin:.25rem 0 0;line-height:1.5;">{{ Str::limit($c->descripcion_corta, 80) }}</p>
                        <div class="curso-mini-meta">
                            <span style="font-size:.78rem;color:var(--muted);"><i class="fas fa-clock" style="margin-right:.25rem;"></i>{{ $c->duracion_horas }}h</span>
                            <span class="curso-free">{{ $c->precioFormateado() }}</span>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ══════════════ CTA FINAL ══════════════ --}}
<section class="cta-section">
    <div class="cta-inner">
        <div class="cta-eyebrow">Únete hoy</div>
        <h2 class="cta-title">¿Listo para Investigar el Mundo Digital?</h2>
        <p class="cta-desc">Únete a una comunidad de estudiantes y profesionales que ya están dominando la ciberseguridad y la forensia digital.</p>
        <div class="cta-btns">
            @guest
                <a href="{{ route('register') }}" class="cta-btn-main">
                    <i class="fas fa-user-plus"></i> Crear Cuenta Gratuita
                </a>
            @endguest
            <a href="{{ route('cursos.index') }}" class="cta-btn-ghost">
                <i class="fas fa-book-open"></i> Explorar Cursos
            </a>
        </div>
    </div>
</section>

@push('scripts')
<script>
(function() {
    const slides = document.querySelectorAll('#heroSlider .slide');
    const dots   = document.querySelectorAll('.slider-dot');
    let current  = 0;
    let timer;

    function goTo(n) {
        slides[current].classList.remove('active');
        dots[current].classList.remove('active');
        current = (n + slides.length) % slides.length;
        slides[current].classList.add('active');
        dots[current].classList.add('active');
    }

    function next() { goTo(current + 1); }

    function startAuto() {
        clearInterval(timer);
        timer = setInterval(next, 5500);
    }

    dots.forEach((d, i) => {
        d.addEventListener('click', () => { goTo(i); startAuto(); });
    });

    startAuto();
})();

// Animación scroll reveal
const observer = new IntersectionObserver((entries) => {
    entries.forEach(e => {
        if (e.isIntersecting) {
            e.target.style.opacity = '1';
            e.target.style.transform = 'translateY(0)';
        }
    });
}, { threshold: 0.1 });

document.querySelectorAll('.valor-card, .servicio-card, .about-card-mini, .curso-mini-card').forEach(el => {
    el.style.opacity = '0';
    el.style.transform = 'translateY(24px)';
    el.style.transition = 'opacity .55s ease, transform .55s ease';
    observer.observe(el);
});
</script>
@endpush
@endsection
