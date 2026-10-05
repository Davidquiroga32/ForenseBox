@extends('layouts.app')
@section('title', 'Normatividad - ForenseBox')

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

/* ══ HERO ══ */
.norm-hero {
    position: relative;
    background: var(--lab-deep);
    padding: 5rem 1.5rem 4rem;
    overflow: hidden;
    margin-top: 68px;
    text-align: center;
}
.norm-hero-bg { position: absolute; inset: 0; background: linear-gradient(135deg, #0A121B 0%, #101f2d 55%, #14283a 100%); }
.norm-hero-dots {
    position: absolute; inset: 0;
    background-image:
        linear-gradient(rgba(142,123,255,.06) 1px, transparent 1px),
        linear-gradient(90deg, rgba(142,123,255,.06) 1px, transparent 1px);
    background-size: 40px 40px;
    mask-image: radial-gradient(ellipse 80% 80% at 50% 50%, black 40%, transparent 100%);
}
.norm-hero-glow {
    position: absolute; width: 500px; height: 500px; border-radius: 50%;
    background: radial-gradient(rgba(142,123,255,.2), transparent 70%);
    top: -150px; right: -80px; pointer-events: none;
}
.norm-hero-inner { position: relative; z-index: 2; max-width: 680px; margin: 0 auto; }
.norm-hero-eyebrow {
    display: inline-flex; align-items: center; gap: .45rem;
    background: rgba(142,123,255,.12); border: 1px solid rgba(142,123,255,.35);
    color: #c9bfff; font-family: var(--font-mono);
    font-size: .7rem; font-weight: 500; text-transform: uppercase; letter-spacing: .14em;
    padding: .35rem 1rem; border-radius: 999px; margin-bottom: 1.25rem;
}
.norm-hero h1 {
    font-family: var(--font-sans);
    font-size: clamp(2rem, 4vw, 3rem); font-weight: 800; color: var(--paper);
    margin: 0 0 1rem; line-height: 1.1; letter-spacing: -.02em;
}
.norm-hero h1 span {
    background: linear-gradient(90deg, #F2B33D, #ffd98a);
    -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
}
.norm-hero p { font-family: var(--font-sans); font-size: 1.05rem; color: var(--muted); line-height: 1.7; margin: 0; }

/* ══ BODY ══ */
.norm-body { background: var(--lab); padding: 3.5rem 1.5rem 5rem; }
.norm-container { max-width: 1100px; margin: 0 auto; }

.intro-strip {
    background: var(--panel); border: 1px solid var(--line);
    border-radius: 16px; padding: 2rem 2.5rem;
    display: flex; align-items: flex-start; gap: 1.5rem;
    margin-bottom: 3rem;
    box-shadow: 0 4px 20px rgba(0,0,0,.3);
}
.intro-strip-ico {
    width: 52px; height: 52px; border-radius: 14px; flex-shrink: 0;
    background: var(--uv); display: flex; align-items: center; justify-content: center;
    font-size: 1.3rem; color: #fff;
}
.intro-strip h2 { font-family: var(--font-sans); font-size: 1.2rem; font-weight: 800; color: var(--paper); margin: 0 0 .4rem; }
.intro-strip p { font-family: var(--font-sans); font-size: .9rem; color: var(--muted); margin: 0; line-height: 1.7; }

.sec-header { display: flex; align-items: center; gap: .75rem; margin-bottom: 1.5rem; }
.sec-header-line { flex: 1; height: 1px; background: var(--line-soft); }
.sec-tag {
    display: inline-flex; align-items: center; gap: .4rem;
    font-family: var(--font-mono); font-size: .66rem; font-weight: 500;
    color: var(--tag); text-transform: uppercase; letter-spacing: .14em;
    background: var(--tag-soft); padding: .3rem .875rem; border-radius: 999px;
}

/* ══ LEY PRINCIPAL ══ */
.ley-principal {
    background: linear-gradient(135deg, var(--lab-deep), #15253a);
    border: 1px solid var(--line);
    border-radius: 20px; overflow: hidden;
    display: grid; grid-template-columns: 280px 1fr;
    margin-bottom: 3rem;
    box-shadow: 0 12px 40px rgba(0,0,0,.45);
    position: relative;
}
.ley-principal::before {
    content: '';
    position: absolute; inset: 0;
    background-image: radial-gradient(rgba(142,123,255,.05) 1px, transparent 1px);
    background-size: 24px 24px;
}
.ley-visual {
    display: flex; align-items: center; justify-content: center;
    padding: 2.5rem;
    background: rgba(0,0,0,.15);
    position: relative; z-index: 1;
}
.ley-gavel-wrap {
    width: 100px; height: 100px; border-radius: 24px;
    background: var(--uv-soft); border: 1px solid var(--uv-border);
    display: flex; align-items: center; justify-content: center;
    font-size: 2.5rem; color: #c9bfff;
}
.ley-content { padding: 2.5rem; position: relative; z-index: 1; }
.ley-tag {
    display: inline-flex; align-items: center; gap: .35rem;
    background: var(--uv-soft); border: 1px solid var(--uv-border);
    color: #c9bfff; font-family: var(--font-mono);
    font-size: .66rem; font-weight: 500; text-transform: uppercase; letter-spacing: .12em;
    padding: .25rem .75rem; border-radius: 999px; margin-bottom: 1rem;
}
.ley-numero { font-family: var(--font-mono); font-size: 1.7rem; font-weight: 700; color: var(--paper); margin: 0 0 .75rem; letter-spacing: -.02em; }
.ley-desc { font-family: var(--font-sans); font-size: .9rem; color: var(--muted); line-height: 1.75; margin: 0 0 1.75rem; max-width: 520px; }
.ley-btn {
    display: inline-flex; align-items: center; gap: .5rem;
    padding: .75rem 1.5rem;
    background: var(--tag); color: #1A1203;
    border-radius: 10px; font-family: var(--font-sans);
    font-size: .88rem; font-weight: 600; text-decoration: none;
    transition: all .2s; box-shadow: 0 4px 16px rgba(242,179,61,.25);
}
.ley-btn:hover { transform: translateY(-2px); box-shadow: 0 8px 24px rgba(242,179,61,.4); color: #1A1203; }

/* ══ DECRETOS GRID ══ */
.decretos-grid { display: grid; grid-template-columns: repeat(3,1fr); gap: 1.25rem; margin-bottom: 3rem; }
.decreto-card {
    background: var(--panel); border: 1px solid var(--line);
    border-radius: 16px; overflow: hidden;
    transition: all .22s; display: flex; flex-direction: column;
}
.decreto-card:hover { transform: translateY(-5px); box-shadow: 0 12px 36px rgba(0,0,0,.4); border-color: var(--uv); }
.decreto-thumb {
    height: 110px; display: flex; align-items: center; justify-content: center;
    font-size: 2.25rem; color: #c9bfff;
    position: relative; background: var(--lab-deep);
}
.decreto-thumb::before {
    content: '';
    position: absolute; inset: 0;
    background-image:
        linear-gradient(rgba(142,123,255,.08) 1px, transparent 1px),
        linear-gradient(90deg, rgba(142,123,255,.08) 1px, transparent 1px);
    background-size: 24px 24px;
}
.decreto-thumb-ico { position: relative; z-index: 1; }
.decreto-body { padding: 1.25rem 1.35rem 1.5rem; flex: 1; display: flex; flex-direction: column; }
.decreto-tag {
    font-family: var(--font-mono); font-size: .64rem; font-weight: 500;
    color: var(--uv); text-transform: uppercase; letter-spacing: .1em;
    margin-bottom: .5rem; display: flex; align-items: center; gap: .25rem;
}
.decreto-tag::before { content: ''; width: 5px; height: 5px; border-radius: 50%; background: var(--uv); }
.decreto-num { font-family: var(--font-mono); font-size: .95rem; font-weight: 600; color: var(--paper); margin: 0 0 .5rem; }
.decreto-desc { font-family: var(--font-sans); font-size: .83rem; color: var(--muted); line-height: 1.6; flex: 1; margin: 0 0 1.25rem; }
.decreto-btn {
    display: flex; align-items: center; justify-content: center; gap: .4rem;
    padding: .6rem 1rem;
    border: 1.5px solid var(--line); border-radius: 9px; background: var(--lab);
    color: var(--uv); font-family: var(--font-sans);
    font-size: .82rem; font-weight: 600; text-decoration: none;
    transition: all .18s;
}
.decreto-btn:hover { background: var(--uv-soft); border-color: var(--uv); }

/* ══ OTRAS NORMAS ══ */
.otras-normas { background: var(--panel); border: 1px solid var(--line); border-radius: 16px; padding: 2rem 2.25rem; margin-bottom: 3rem; box-shadow: 0 4px 16px rgba(0,0,0,.3); }
.norma-item { display: flex; align-items: flex-start; gap: 1rem; padding: 1rem 0; border-bottom: 1px solid var(--line-soft); }
.norma-item:last-child { border-bottom: none; padding-bottom: 0; }
.norma-ico {
    width: 36px; height: 36px; border-radius: 9px; flex-shrink: 0;
    background: var(--uv-soft);
    display: flex; align-items: center; justify-content: center;
    color: var(--uv); font-size: .88rem;
    margin-top: .1rem;
}
.norma-titulo { font-family: var(--font-mono); font-size: .9rem; font-weight: 600; color: var(--paper); margin-bottom: .3rem; }
.norma-desc { font-family: var(--font-sans); font-size: .84rem; color: var(--muted); line-height: 1.6; margin: 0; }

/* ══ RECURSOS ══ */
.recursos-grid { display: grid; grid-template-columns: repeat(3,1fr); gap: 1.25rem; margin-bottom: 3rem; }
.recurso-card { background: var(--panel); border: 1px solid var(--line); border-radius: 16px; padding: 1.75rem 1.5rem; text-align: center; transition: all .22s; }
.recurso-card:hover { transform: translateY(-4px); box-shadow: 0 10px 32px rgba(0,0,0,.4); border-color: var(--uv); }
.recurso-ico {
    width: 64px; height: 64px; border-radius: 18px;
    background: var(--uv); display: flex; align-items: center; justify-content: center;
    font-size: 1.5rem; color: #fff;
    margin: 0 auto 1.25rem;
    box-shadow: 0 6px 20px rgba(142,123,255,.3);
}
.recurso-card h4 { font-family: var(--font-sans); font-size: .95rem; font-weight: 800; color: var(--paper); margin: 0 0 .4rem; }
.recurso-card p { font-family: var(--font-sans); font-size: .82rem; color: var(--muted); margin: 0 0 1.25rem; line-height: 1.5; }
.recurso-btn {
    display: flex; align-items: center; justify-content: center; gap: .4rem;
    width: 100%; padding: .65rem 1rem;
    border: 1.5px solid var(--line); border-radius: 9px; background: var(--lab);
    color: var(--uv); font-family: var(--font-sans);
    font-size: .82rem; font-weight: 600; text-decoration: none;
    transition: all .18s;
}
.recurso-btn:hover { background: var(--uv-soft); border-color: var(--uv); }

/* ══ CTA ══ */
.norm-cta {
    background: linear-gradient(135deg, var(--lab-deep), #14253a);
    border: 1px solid var(--line);
    border-radius: 20px; padding: 3rem 2.5rem;
    text-align: center; position: relative; overflow: hidden;
}
.norm-cta::before {
    content: '';
    position: absolute; inset: 0;
    background-image: radial-gradient(rgba(142,123,255,.06) 1px, transparent 1px);
    background-size: 24px 24px;
}
.norm-cta-inner { position: relative; z-index: 1; max-width: 520px; margin: 0 auto; }
.norm-cta h2 { font-family: var(--font-sans); font-size: 1.75rem; font-weight: 800; color: var(--paper); margin: 0 0 .75rem; letter-spacing: -.02em; }
.norm-cta p { font-family: var(--font-sans); font-size: .95rem; color: var(--muted); margin: 0 0 2rem; line-height: 1.7; }
.norm-cta-btn {
    display: inline-flex; align-items: center; gap: .5rem;
    padding: .9rem 2rem; background: var(--tag); color: #1A1203;
    border-radius: 12px; font-family: var(--font-sans);
    font-size: .95rem; font-weight: 600; text-decoration: none;
    transition: all .2s; box-shadow: 0 6px 22px rgba(242,179,61,.3);
}
.norm-cta-btn:hover { transform: translateY(-2px); box-shadow: 0 10px 32px rgba(242,179,61,.4); color: #1A1203; }

/* Responsive */
@media (max-width: 900px) {
    .ley-principal { grid-template-columns: 1fr; }
    .ley-visual { padding: 2rem; }
    .decretos-grid, .recursos-grid { grid-template-columns: repeat(2,1fr); }
}
@media (max-width: 580px) {
    .decretos-grid, .recursos-grid { grid-template-columns: 1fr; }
    .intro-strip { flex-direction: column; }
}
</style>

{{-- ══ HERO ══ --}}
<section class="norm-hero">
    <div class="norm-hero-bg"></div>
    <div class="norm-hero-dots"></div>
    <div class="norm-hero-glow"></div>
    <div class="norm-hero-inner">
        <div class="norm-hero-eyebrow">
            <i class="fas fa-gavel"></i> Marco Normativo
        </div>
        <h1>Normatividad en <span>Ciberseguridad</span></h1>
        <p>Conoce las leyes y regulaciones que rigen la protección de datos, los delitos informáticos y la evidencia digital en Colombia.</p>
    </div>
</section>

{{-- ══ BODY ══ --}}
<div class="norm-body">
    <div class="norm-container">

        {{-- Intro --}}
        <div class="intro-strip">
            <div class="intro-strip-ico"><i class="fas fa-balance-scale"></i></div>
            <div>
                <h2>Marco Legal de la Seguridad Digital</h2>
                <p>La ciberseguridad y la forensia digital en Colombia se rigen por un marco normativo específico que protege la información, sanciona los delitos informáticos y regula el tratamiento de la evidencia digital. Aquí encontrarás la normatividad vigente de manera organizada.</p>
            </div>
        </div>

        {{-- Ley principal --}}
        <div class="sec-header">
            <div class="sec-tag"><i class="fas fa-star"></i> Ley Principal</div>
            <div class="sec-header-line"></div>
        </div>

        <div class="ley-principal">
            <div class="ley-visual">
                <div class="ley-gavel-wrap"><i class="fas fa-shield-halved"></i></div>
            </div>
            <div class="ley-content">
                <div class="ley-tag"><i class="fas fa-certificate"></i> Delitos Informáticos</div>
                <h2 class="ley-numero">Ley 1273 de 2009</h2>
                <p class="ley-desc">
                    Por medio de la cual se modifica el Código Penal y se crea un nuevo bien jurídico tutelado denominado
                    "de la protección de la información y de los datos". Tipifica delitos como el acceso abusivo a un sistema
                    informático, la interceptación de datos, la suplantación de sitios web y el daño informático, base legal
                    para la persecución de la ciberdelincuencia.
                </p>
                <a href="https://www.funcionpublica.gov.co/eva/gestornormativo/norma.php?i=35192"
                    target="_blank" class="ley-btn">
                        <i class="fas fa-external-link-alt"></i> Ver Ley Oficial
                </a>
            </div>
        </div>

        {{-- Decretos / normas --}}
        <div class="sec-header">
            <div class="sec-tag"><i class="fas fa-file-alt"></i> Protección de Datos</div>
            <div class="sec-header-line"></div>
        </div>

        @php
            $decretos = [
                ['numero' => 'Ley 1581 de 2012',
                'descripcion' => 'Régimen general de protección de datos personales (Habeas Data) que regula el tratamiento de la información personal en Colombia.',
                'url' => 'https://www.funcionpublica.gov.co/eva/gestornormativo/norma.php?i=49981'],
                ['numero' => 'Ley 1266 de 2008',
                'descripcion' => 'Disposiciones generales del habeas data y regulación del manejo de la información contenida en bases de datos.',
                'url' => 'https://www.funcionpublica.gov.co/eva/gestornormativo/norma.php?i=34488'],
                ['numero' => 'Ley 1341 de 2009',
                'descripcion' => 'Marco general de las TIC y la sociedad de la información, con lineamientos para la seguridad de las redes y servicios.',
                'url' => 'https://www.funcionpublica.gov.co/eva/gestornormativo/norma.php?i=36913'],
            ];
        @endphp

        <div class="decretos-grid">
            @foreach($decretos as $d)
                <div class="decreto-card">
                    <div class="decreto-thumb">
                        <div class="decreto-thumb-ico"><i class="fas fa-file-alt"></i></div>
                    </div>
                    <div class="decreto-body">
                        <div class="decreto-tag">Regulación</div>
                        <h3 class="decreto-num">{{ $d['numero'] }}</h3>
                        <p class="decreto-desc">{{ $d['descripcion'] }}</p>
                        <a href="{{ $d['url'] }}" target="_blank" class="decreto-btn">
                            <i class="fas fa-external-link-alt"></i> Ver Documento Oficial
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Otras normas --}}
        <div class="sec-header">
            <div class="sec-tag"><i class="fas fa-list-ul"></i> Otras Normas Relevantes</div>
            <div class="sec-header-line"></div>
        </div>

        @php
            $otrasNormas = [
                ['titulo' => 'Ley 527 de 1999', 'icon' => 'fa-file-signature',
                'url' => 'https://www.funcionpublica.gov.co/eva/gestornormativo/norma.php?i=4276',
                'descripcion' => 'Define el comercio electrónico, los mensajes de datos y las firmas digitales, base para la validez probatoria de documentos electrónicos.'],
                ['titulo' => 'Ley 906 de 2004', 'icon' => 'fa-gavel',
                'url' => 'https://www.funcionpublica.gov.co/eva/gestornormativo/norma.php?i=14787',
                'descripcion' => 'Código de Procedimiento Penal. Regula el tratamiento de la evidencia digital, allanamientos y cadena de custodia.'],
                ['titulo' => 'Decreto 1377 de 2013', 'icon' => 'fa-database',
                'url' => 'https://www.funcionpublica.gov.co/eva/gestornormativo/norma.php?i=53646',
                'descripcion' => 'Reglamenta parcialmente la Ley 1581 de 2012 sobre protección de datos personales.'],
                ['titulo' => 'Ley 1712 de 2014', 'icon' => 'fa-eye',
                'url' => 'https://www.funcionpublica.gov.co/eva/gestornormativo/norma.php?i=56882',
                'descripcion' => 'Ley de transparencia y del derecho de acceso a la información pública nacional.'],
            ];
        @endphp

        <div class="otras-normas">
            @foreach($otrasNormas as $norma)
                <div class="norma-item">
                    <div class="norma-ico"><i class="fas {{ $norma['icon'] }}"></i></div>
                    <div style="flex:1;min-width:0;">
                        <div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:.5rem;margin-bottom:.3rem;">
                            <div class="norma-titulo">{{ $norma['titulo'] }}</div>
                            <a href="{{ $norma['url'] }}" target="_blank"
                                style="display:inline-flex;align-items:center;gap:.3rem;font-family:'Chivo',sans-serif;font-size:.72rem;font-weight:600;color:var(--uv);text-decoration:none;background:var(--uv-soft);padding:.2rem .6rem;border-radius:999px;white-space:nowrap; flex-shrink:0;">
                                <i class="fas fa-external-link-alt"></i> Ver oficial
                            </a>
                        </div>
                        <p class="norma-desc">{{ $norma['descripcion'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Recursos --}}
        <div class="sec-header">
            <div class="sec-tag"><i class="fas fa-folder-open"></i> Recursos y Estándares</div>
            <div class="sec-header-line"></div>
        </div>

        @php
            $recursos = [
                ['icon' => 'fa-file-contract', 'titulo' => 'ISO/IEC 27001',
                'url' => 'https://www.iso.org/standard/27001',
                'descripcion' => 'Estándar internacional para la gestión de la seguridad de la información (SGSI).'],
                ['icon' => 'fa-clipboard-list', 'titulo' => 'NIST CSF',
                'url' => 'https://www.nist.gov/cyberframework',
                'descripcion' => 'Marco de ciberseguridad del NIST para gestionar y reducir el riesgo.'],
                ['icon' => 'fa-book', 'titulo' => 'ISO/IEC 27037',
                'url' => 'https://www.iso.org/standard/44381.html',
                'descripcion' => 'Guía para la identificación, recolección y preservación de evidencia digital.'],
            ];
        @endphp

        <div class="recursos-grid">
            @foreach($recursos as $r)
                <div class="recurso-card">
                    <div class="recurso-ico"><i class="fas {{ $r['icon'] }}"></i></div>
                    <h4>{{ $r['titulo'] }}</h4>
                    <p>{{ $r['descripcion'] }}</p>
                    <a href="{{ $r['url'] }}" target="_blank" class="recurso-btn">
                        <i class="fas fa-external-link-alt"></i> Ver Recurso
                    </a>
                </div>
            @endforeach
        </div>

        {{-- CTA --}}
        <div class="norm-cta">
            <div class="norm-cta-inner">
                <h2>¿Necesitas Asesoría Normativa?</h2>
                <p>Nuestro equipo de expertos puede ayudarte con consultas específicas sobre cumplimiento, protección de datos y evidencia digital.</p>
                <a href="{{ route('contacto') }}" class="norm-cta-btn">
                    <i class="fas fa-headset"></i> Solicitar Asesoría
                </a>
            </div>
        </div>

    </div>
</div>

@endsection
