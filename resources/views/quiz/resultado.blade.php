@extends('layouts.dashboard')
@section('title','Resultado del Quiz')
@section('page-title','Resultado')

@section('content')
@php
    $aprobado   = $intento->aprobado;
    $quiz       = $intento->quiz;
    $respuestas = $intento->respuestas->keyBy('pregunta_id');
    $correctas  = $respuestas->where('es_correcta', true)->count();
    $totalResp  = $respuestas->whereNotNull('es_correcta')->count();
    $porcentaje = number_format($intento->porcentaje, 1);
@endphp

<style>
:root {
    --green:    #3FBF9B;
    --green-d:  #2e9f83;
    --red:      #F0606A;
    --red-d:    #d9444e;
    --blue:     #8E7BFF;
    --blue-l:   #6a58e0;
    --orange:   #F2B33D;
    --text:     #E8EEF0;
    --muted:    #9FB0B8;
    --border:   #27404E;
    --bg:       #0E1A24;
    --line-soft:#1E333F;
    --font-sans: 'Chivo', sans-serif;
    --font-mono: 'JetBrains Mono', monospace;
}

.res-wrap { max-width: 780px; margin: 0 auto; }

/* ══ HERO ══ */
.res-hero {
    border-radius: 20px;
    padding: 2.5rem 2rem;
    margin-bottom: 1.5rem;
    position: relative;
    overflow: hidden;
    background: {{ $aprobado
        ? 'linear-gradient(135deg, #0b3a2e 0%, #1d7a5c 50%, #2e9f83 100%)'
        : 'linear-gradient(135deg, #4a1a1d 0%, #c0393f 50%, #d9444e 100%)' }};
    box-shadow: {{ $aprobado
        ? '0 16px 48px rgba(63,191,155,.25)'
        : '0 16px 48px rgba(240,96,106,.25)' }};
}
.res-hero::before {
    content: '';
    position: absolute; inset: 0;
    background-image: radial-gradient(rgba(255,255,255,.06) 1px, transparent 1px);
    background-size: 28px 28px;
}
.res-hero-glow {
    position: absolute;
    width: 400px; height: 400px; border-radius: 50%;
    background: radial-gradient(rgba(255,255,255,.08), transparent 70%);
    top: -150px; right: -100px; pointer-events: none;
}

.res-hero-inner {
    position: relative; z-index: 1;
    display: grid; grid-template-columns: 1fr auto;
    gap: 2rem; align-items: center;
}

.res-left {}
.res-emoji {
    font-size: 3rem; line-height: 1;
    margin-bottom: .75rem; display: block;
    animation: bounceIn .6s cubic-bezier(.22,1,.36,1);
}
@keyframes bounceIn {
    0%   { transform: scale(0); opacity: 0; }
    60%  { transform: scale(1.15); }
    100% { transform: scale(1); opacity: 1; }
}

.res-status {
    display: inline-flex; align-items: center; gap: .45rem;
    background: rgba(255,255,255,.18);
    border: 1px solid rgba(255,255,255,.3);
    color: #fff; font-family: var(--font-mono);
    font-size: .72rem; font-weight: 500;
    text-transform: uppercase; letter-spacing: .1em;
    padding: .3rem .875rem; border-radius: 999px;
    margin-bottom: .875rem;
}

.res-title {
    font-family: var(--font-sans);
    font-size: clamp(1.5rem, 3vw, 2.25rem);
    font-weight: 800; color: #fff; margin: 0 0 .5rem;
    line-height: 1.1; letter-spacing: -.02em;
}

.res-subtitle {
    font-family: var(--font-sans);
    font-size: .9rem; color: rgba(255,255,255,.85); margin: 0;
}

/* Círculo de porcentaje */
.res-circle-wrap { flex-shrink: 0; }
.res-circle { width: 120px; height: 120px; position: relative; }
.res-circle svg { transform: rotate(-90deg); }
.res-circle-bg  { fill: none; stroke: rgba(255,255,255,.15); stroke-width: 8; }
.res-circle-fill {
    fill: none; stroke: #fff; stroke-width: 8;
    stroke-linecap: round;
    stroke-dasharray: 314;
    stroke-dashoffset: {{ 314 - (314 * $intento->porcentaje / 100) }};
    transition: stroke-dashoffset 1.5s cubic-bezier(.22,1,.36,1);
}
.res-circle-text {
    position: absolute; inset: 0;
    display: flex; flex-direction: column;
    align-items: center; justify-content: center;
}
.res-pct-num {
    font-family: var(--font-mono);
    font-size: 1.6rem; font-weight: 700; color: #fff; line-height: 1;
}
.res-pct-sym {
    font-family: var(--font-mono);
    font-size: .7rem; font-weight: 500; color: rgba(255,255,255,.7);
}

/* Stats row */
.res-stats {
    display: grid; grid-template-columns: repeat(3,1fr);
    gap: .75rem; margin-top: 1.75rem; position: relative; z-index: 1;
}
.rstat {
    background: rgba(255,255,255,.12);
    border: 1px solid rgba(255,255,255,.2);
    border-radius: 12px; padding: 1rem;
    text-align: center;
}
.rstat-num {
    font-family: var(--font-mono);
    font-size: 1.35rem; font-weight: 700; color: #fff; line-height: 1;
}
.rstat-label {
    font-family: var(--font-mono);
    font-size: .64rem; color: rgba(255,255,255,.75);
    margin-top: .25rem; text-transform: uppercase; letter-spacing: .06em;
}

/* Barra de puntaje mínimo */
.min-bar-wrap { margin-top: 1.25rem; position: relative; z-index: 1; }
.min-bar-label {
    display: flex; justify-content: space-between;
    font-family: var(--font-sans);
    font-size: .75rem; color: rgba(255,255,255,.85);
    margin-bottom: .4rem;
}
.min-bar {
    height: 6px; background: rgba(255,255,255,.2);
    border-radius: 999px; overflow: visible; position: relative;
}
.min-bar-fill {
    height: 100%; border-radius: 999px;
    background: #fff; width: {{ min($intento->porcentaje, 100) }}%;
    transition: width 1.2s cubic-bezier(.22,1,.36,1);
}
.min-bar-marker {
    position: absolute; top: -4px;
    left: {{ $quiz->puntaje_aprobatorio }}%;
    width: 2px; height: 14px; background: rgba(255,255,255,.6);
    border-radius: 999px;
}

/* ══ ACCIONES ══ */
.res-actions {
    display: flex; gap: .875rem; flex-wrap: wrap;
    margin-bottom: 1.5rem;
}
.btn-reintentar {
    display: inline-flex; align-items: center; gap: .5rem;
    padding: .75rem 1.5rem;
    background: var(--blue); color: #fff;
    border-radius: 12px; border: none;
    font-family: var(--font-sans); font-size: .9rem; font-weight: 600;
    text-decoration: none; transition: all .2s;
    box-shadow: 0 4px 16px rgba(142,123,255,.3);
    cursor: pointer;
}
.btn-reintentar:hover { transform: translateY(-2px); box-shadow: 0 6px 24px rgba(142,123,255,.4); color: #fff; }

.btn-mis-cursos {
    display: inline-flex; align-items: center; gap: .5rem;
    padding: .75rem 1.5rem;
    background: var(--panel); color: var(--text);
    border: 1.5px solid var(--border); border-radius: 12px;
    font-family: var(--font-sans); font-size: .9rem; font-weight: 600;
    text-decoration: none; transition: all .2s;
}
.btn-mis-cursos:hover { border-color: var(--blue); color: var(--blue); background: var(--uv-soft); }

/* ══ REVISIÓN ══ */
.revision-card {
    background: var(--panel); border-radius: 16px;
    border: 1px solid var(--border); overflow: hidden;
    margin-bottom: 1.5rem;
}
.revision-head {
    padding: 1.1rem 1.5rem; border-bottom: 1px solid var(--border);
    background: var(--lab-deep);
    display: flex; align-items: center; justify-content: space-between;
}
.revision-title {
    font-family: var(--font-sans);
    font-size: .95rem; font-weight: 800; color: var(--text);
    margin: 0; display: flex; align-items: center; gap: .5rem;
}
.revision-title i { color: var(--blue); }
.revision-summary { display: flex; gap: .5rem; }
.rev-badge {
    display: inline-flex; align-items: center; gap: .3rem;
    font-family: var(--font-mono);
    font-size: .68rem; font-weight: 500; padding: .2rem .6rem;
    border-radius: 999px;
}
.rev-badge.ok  { background: var(--resolved-soft); color: var(--resolved); }
.rev-badge.err { background: var(--alert-soft); color: var(--alert); }

/* Pregunta item */
.preg-item {
    padding: 1.25rem 1.5rem;
    border-bottom: 1px solid var(--line-soft);
    transition: background .15s;
}
.preg-item:last-child { border-bottom: none; }
.preg-item:hover { background: var(--panel-2); }

.preg-item-head {
    display: flex; align-items: flex-start; gap: .875rem;
    margin-bottom: .875rem;
}
.preg-status-ico {
    width: 32px; height: 32px; border-radius: 9px; flex-shrink: 0;
    display: flex; align-items: center; justify-content: center;
    font-size: .82rem; margin-top: .1rem;
}
.ps-ok   { background: var(--resolved-soft); color: var(--resolved); }
.ps-err  { background: var(--alert-soft); color: var(--alert); }
.ps-pend { background: var(--lab-deep); color: var(--muted); }

.preg-item-info {}
.preg-num-label {
    font-family: var(--font-mono);
    font-size: .66rem; font-weight: 500; color: var(--muted);
    text-transform: uppercase; letter-spacing: .08em; margin-bottom: .2rem;
}
.preg-texto {
    font-family: var(--font-sans);
    font-size: .92rem; font-weight: 700; color: var(--text);
    line-height: 1.4;
}
.preg-pts {
    font-size: .75rem; color: var(--muted);
    margin-top: .2rem; font-family: var(--font-mono);
}

/* Opciones respuesta */
.opciones-list { display: flex; flex-direction: column; gap: .35rem; }
.opcion-resp {
    display: flex; align-items: center; gap: .65rem;
    padding: .6rem .875rem; border-radius: 10px;
    font-family: var(--font-sans); font-size: .86rem;
    border: 1.5px solid transparent;
}
.opcion-resp.correcta {
    background: var(--resolved-soft); border-color: rgba(63,191,155,.35); color: var(--resolved);
}
.opcion-resp.incorrecta-sel {
    background: var(--alert-soft); border-color: rgba(240,96,106,.35); color: var(--alert);
}
.opcion-resp.neutral {
    background: var(--lab); color: var(--muted); border-color: var(--line-soft);
}
.opcion-resp-ico {
    width: 22px; height: 22px; border-radius: 6px; flex-shrink: 0;
    display: flex; align-items: center; justify-content: center; font-size: .7rem;
}
.opcion-resp.correcta       .opcion-resp-ico { background: var(--resolved); color: #06231c; }
.opcion-resp.incorrecta-sel .opcion-resp-ico { background: var(--alert); color: #fff; }
.opcion-resp.neutral        .opcion-resp-ico { background: var(--lab-deep); color: var(--muted); }

.tu-resp-tag {
    margin-left: auto; font-size: .66rem; font-weight: 500;
    padding: .1rem .5rem; border-radius: 999px;
    background: var(--alert-soft); color: var(--alert);
    font-family: var(--font-mono);
}

/* Texto libre */
.texto-libre-box {
    background: var(--lab); border: 1px solid var(--border);
    border-radius: 10px; padding: 1rem;
    font-family: var(--font-sans); font-size: .86rem; color: var(--muted);
    line-height: 1.6;
}
.texto-libre-label {
    font-family: var(--font-mono);
    font-size: .66rem; font-weight: 500; color: var(--muted);
    text-transform: uppercase; letter-spacing: .08em;
    margin-bottom: .5rem;
}
.revision-manual {
    display: flex; align-items: center; gap: .4rem;
    font-size: .75rem; color: var(--tag);
    font-family: var(--font-sans); margin-top: .5rem;
    background: var(--tag-soft); border-radius: 7px; padding: .4rem .75rem;
    border: 1px solid var(--tag-border);
}

/* Explicación */
.explicacion-box {
    display: flex; gap: .65rem;
    background: var(--tag-soft); border: 1px solid var(--tag-border);
    border-radius: 10px; padding: .875rem 1rem;
    margin-top: .875rem;
}
.explicacion-ico {
    width: 28px; height: 28px; border-radius: 7px; flex-shrink: 0;
    background: var(--tag); color: #1A1203;
    display: flex; align-items: center; justify-content: center;
    font-size: .8rem;
}
.explicacion-text {
    font-family: var(--font-sans);
    font-size: .84rem; color: var(--paper); line-height: 1.6;
}
.explicacion-text strong {
    font-family: var(--font-mono); font-size: .68rem;
    text-transform: uppercase; letter-spacing: .06em;
    display: block; margin-bottom: .2rem; color: var(--tag);
}

@media (max-width: 640px) {
    .res-hero-inner { grid-template-columns: 1fr; }
    .res-circle-wrap { display: none; }
    .res-stats { grid-template-columns: repeat(3,1fr); }
}
</style>

<div class="res-wrap">

    {{-- ══ HERO ══ --}}
    <div class="res-hero">
        <div class="res-hero-glow"></div>
        <div class="res-hero-inner">
            <div class="res-left">
                <span class="res-emoji">{{ $aprobado ? '🎉' : '💪' }}</span>
                <div class="res-status">
                    <i class="fas {{ $aprobado ? 'fa-check-circle' : 'fa-times-circle' }}"></i>
                    {{ $aprobado ? 'Aprobado' : 'No aprobado' }}
                </div>
                <h2 class="res-title">
                    {{ $aprobado ? '¡Excelente trabajo!' : 'Sigue intentándolo' }}
                </h2>
                <p class="res-subtitle">
                    {{ $aprobado
                        ? 'Has superado el quiz con éxito. ¡Continúa con el siguiente contenido!'
                        : 'Necesitabas '.$quiz->puntaje_aprobatorio.'% para aprobar. ¡Puedes lograrlo!' }}
                </p>
            </div>

            <div class="res-circle-wrap">
                <div class="res-circle">
                    <svg width="120" height="120" viewBox="0 0 120 120">
                        <circle class="res-circle-bg" cx="60" cy="60" r="50"/>
                        <circle class="res-circle-fill" cx="60" cy="60" r="50"/>
                    </svg>
                    <div class="res-circle-text">
                        <span class="res-pct-num">{{ $porcentaje }}</span>
                        <span class="res-pct-sym">%</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Stats --}}
        <div class="res-stats">
            <div class="rstat">
                <div class="rstat-num">{{ $intento->puntaje }}<span style="font-size:.9rem;opacity:.7;">/{{ $intento->puntaje_total }}</span></div>
                <div class="rstat-label">Puntos</div>
            </div>
            <div class="rstat">
                <div class="rstat-num">{{ $correctas }}<span style="font-size:.9rem;opacity:.7;">/{{ $totalResp }}</span></div>
                <div class="rstat-label">Correctas</div>
            </div>
            <div class="rstat">
                <div class="rstat-num">{{ $intento->tiempo_usado ? gmdate('i:s', $intento->tiempo_usado) : '—' }}</div>
                <div class="rstat-label">Tiempo</div>
            </div>
        </div>

        {{-- Barra progreso vs mínimo --}}
        <div class="min-bar-wrap">
            <div class="min-bar-label">
                <span>0%</span>
                <span>Mínimo para aprobar: {{ $quiz->puntaje_aprobatorio }}%</span>
                <span>100%</span>
            </div>
            <div class="min-bar">
                <div class="min-bar-fill"></div>
                <div class="min-bar-marker" title="Puntaje mínimo"></div>
            </div>
        </div>
    </div>

    {{-- ══ ACCIONES ══ --}}
    <div class="res-actions">
        @if($quiz->puedeIntentar(auth()->id()))
            <form method="POST" action="{{ route('quiz.iniciar', $quiz) }}" style="display:inline;">
                @csrf
                <button type="submit" class="btn-reintentar">
                    <i class="fas fa-redo"></i> Intentar de nuevo
                </button>
            </form>
        @endif
        <a href="{{ route('quiz.show', $quiz) }}" class="btn-mis-cursos">
            <i class="fas fa-eye"></i> Ver quiz 
        </a>
        @if($quiz->leccion && $quiz->leccion->modulo && $quiz->leccion->modulo->curso)
            <a href="{{ route('curso.player.leccion', [$quiz->leccion->modulo->curso->slug, $quiz->leccion->id]) }}"
            class="btn-mis-cursos">
                <i class="fas fa-arrow-left"></i> Volver al curso
            </a>
        @endif
        <a href="{{ route('dashboard.cursos') }}" class="btn-mis-cursos">
            <i class="fas fa-book-open"></i> Mis cursos
        </a>
    </div>

    {{-- ══ REVISIÓN ══ --}}
    @if($quiz->mostrar_respuestas)
    <div class="revision-card">
        <div class="revision-head">
            <h3 class="revision-title">
                <i class="fas fa-clipboard-check"></i> Revisión de respuestas
            </h3>
            <div class="revision-summary">
                <span class="rev-badge ok">
                    <i class="fas fa-check"></i> {{ $correctas }} correctas
                </span>
                <span class="rev-badge err">
                    <i class="fas fa-times"></i> {{ $totalResp - $correctas }} incorrectas
                </span>
            </div>
        </div>

        @foreach($quiz->preguntas as $i => $pregunta)
            @php
                $resp = $respuestas->get($pregunta->id);
                $esCorrecta = $resp?->es_correcta;
                $opcionesSeleccionadas = $resp?->opciones->pluck('id')->toArray() ?? [];
                $statusClass = $esCorrecta === true ? 'ps-ok' : ($esCorrecta === false ? 'ps-err' : 'ps-pend');
                $statusIco   = $esCorrecta === true ? 'fa-check' : ($esCorrecta === false ? 'fa-times' : 'fa-question');
            @endphp
            <div class="preg-item">
                <div class="preg-item-head">
                    <div class="preg-status-ico {{ $statusClass }}">
                        <i class="fas {{ $statusIco }}"></i>
                    </div>
                    <div class="preg-item-info">
                        <div class="preg-num-label">Pregunta {{ $i + 1 }} · {{ $pregunta->tipoLabel() }}</div>
                        <div class="preg-texto">{{ $pregunta->pregunta }}</div>
                        <div class="preg-pts">
                            {{ $resp?->puntos_obtenidos ?? 0 }} / {{ $pregunta->puntos }} punto{{ $pregunta->puntos != 1 ? 's' : '' }}
                        </div>
                    </div>
                </div>

                @if($pregunta->tipo === 'texto_libre')
                    <div class="texto-libre-label">Tu respuesta</div>
                    <div class="texto-libre-box">
                        {{ $resp?->respuesta_texto ?? 'Sin respuesta' }}
                    </div>
                    <div class="revision-manual">
                        <i class="fas fa-info-circle"></i>
                        Respuesta de texto libre — requiere revisión manual del instructor.
                    </div>

                @else
                    <div class="opciones-list">
                        @foreach($pregunta->opciones as $opcion)
                            @php
                                $seleccionada = in_array($opcion->id, $opcionesSeleccionadas);
                                if ($opcion->es_correcta) {
                                    $cls = 'correcta';
                                    $ico = 'fa-check';
                                } elseif ($seleccionada) {
                                    $cls = 'incorrecta-sel';
                                    $ico = 'fa-times';
                                } else {
                                    $cls = 'neutral';
                                    $ico = 'fa-minus';
                                }
                            @endphp
                            <div class="opcion-resp {{ $cls }}">
                                <div class="opcion-resp-ico">
                                    <i class="fas {{ $ico }}"></i>
                                </div>
                                <span>{{ $opcion->texto }}</span>
                                @if($seleccionada && !$opcion->es_correcta)
                                    <span class="tu-resp-tag">Tu respuesta</span>
                                @elseif($opcion->es_correcta)
                                    <span style="margin-left:auto;font-size:.68rem;font-weight:700;padding:.1rem .5rem;border-radius:999px;background:#bbf7d0;color:#059669;font-family:'Outfit',sans-serif;">
                                        Correcta
                                    </span>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @endif

                @if($pregunta->explicacion)
                    <div class="explicacion-box">
                        <div class="explicacion-ico"><i class="fas fa-lightbulb"></i></div>
                        <div class="explicacion-text">
                            <strong>Explicación</strong>
                            {{ $pregunta->explicacion }}
                        </div>
                    </div>
                @endif
            </div>
        @endforeach
    </div>
    @endif

</div>
@endsection