@extends('layouts.dashboard')
@section('title','Quiz: ' . $quiz->leccion->titulo)
@section('page-title','Quiz')

@section('content')
@php
    $aprobatorio = $quiz->puntaje_aprobatorio;
    $maxIntentos = $quiz->intentos_permitidos;
    $usados      = $intentos->count();
@endphp
<style>
    .quiz-wrap { max-width: 700px; margin: 0 auto; }
    .quiz-header { background: linear-gradient(135deg, #14103a, #1c1750); border: 1px solid var(--line); border-radius: 14px; padding: 2rem; color: var(--paper); margin-bottom: 1.5rem; position: relative; overflow: hidden; }
    .quiz-header::before { content:''; position:absolute; inset:0; background-image: radial-gradient(rgba(142,123,255,.08) 1px, transparent 1px); background-size: 24px 24px; }
    .quiz-header > * { position: relative; z-index: 1; }
    .quiz-header h1 { font-family: var(--font-sans); font-size: 1.4rem; font-weight: 800; margin-bottom: .5rem; }
    .quiz-config { display: grid; grid-template-columns: repeat(3,1fr); gap: 1rem; margin-top: 1.25rem; }
    .qconf { background: var(--uv-soft); border: 1px solid var(--uv-border); border-radius: 10px; padding: .875rem; text-align: center; }
    .qconf-num { font-family: var(--font-mono); font-size: 1.4rem; font-weight: 700; color: var(--paper); }
    .qconf-label { font-family: var(--font-mono); font-size: .66rem; color: var(--muted); margin-top: .2rem; text-transform: uppercase; }
    .db-card { background: var(--panel); border: 1px solid var(--line); border-radius: 12px; padding: 1.5rem; margin-bottom: 1.25rem; }
    .intento-row { display:flex; align-items:center; justify-content:space-between; padding: .65rem 0; border-bottom: 1px solid var(--line-soft); font-size: .86rem; gap:.75rem; flex-wrap:wrap; }
    .intento-row:last-child { border-bottom: none; }
    .badge { display:inline-flex; align-items:center; gap:.25rem; font-family: var(--font-mono); font-size:.68rem; font-weight:500; padding:.2rem .65rem; border-radius:999px; }
    .badge-ok  { background:var(--resolved-soft); color:var(--resolved); }
    .badge-err { background:var(--alert-soft); color:var(--alert); }
    .btn-start { display:block; width:100%; padding:1rem; background:var(--tag); color:#1A1203; border:none; border-radius:10px; font-size:1rem; font-weight:600; cursor:pointer; text-align:center; transition:opacity .2s; box-shadow: 0 4px 16px rgba(242,179,61,.25); }
    .btn-start:hover { opacity:.9; }
    .progreso-bar { height:10px; background:var(--lab); border-radius:999px; overflow:hidden; margin-top:.5rem; }
    .progreso-fill { height:100%; border-radius:999px; }
</style>
<div class="quiz-wrap">
    {{-- Botón volver al curso --}}
    @if($quiz->leccion && $quiz->leccion->modulo && $quiz->leccion->modulo->curso)
        <a href="{{ route('curso.player.leccion', [$quiz->leccion->modulo->curso->slug, $quiz->leccion->id]) }}"
            style="display:inline-flex;align-items:center;gap:.4rem;font-family:var(--font-sans);font-size:.84rem;font-weight:600;color:var(--uv);text-decoration:none;margin-bottom:1rem;padding:.5rem .9rem;background:var(--uv-soft);border-radius:9px;border:1.5px solid var(--uv-border);transition:all .18s;">
            <i class="fas fa-arrow-left"></i> Volver al curso
        </a>
    @endif
    <div class="quiz-header">
        <div style="font-family:var(--font-mono);font-size:.7rem;color:var(--muted);margin-bottom:.3rem;">
            <i class="fas fa-layer-group"></i> {{ $quiz->leccion->modulo->curso->titulo ?? '' }} › {{ $quiz->leccion->modulo->titulo ?? '' }}
        </div>
        <h1>{{ $quiz->titulo ?? $quiz->leccion->titulo }}</h1>
        @if($quiz->descripcion)<p style="color:var(--muted);font-size:.9rem;line-height:1.6;margin-top:.5rem;">{{ $quiz->descripcion }}</p>@endif
        <div class="quiz-config">
            <div class="qconf"><div class="qconf-num">{{ $quiz->preguntas->count() }}</div><div class="qconf-label">Preguntas</div></div>
            <div class="qconf"><div class="qconf-num">{{ $aprobatorio }}%</div><div class="qconf-label">Para aprobar</div></div>
            <div class="qconf"><div class="qconf-num">{{ $quiz->tiempo_limite ? $quiz->tiempo_limite.'min' : '∞' }}</div><div class="qconf-label">Tiempo límite</div></div>
        </div>
    </div>
    @if($mejor)
    <div class="db-card">
        <h3 style="font-family:var(--font-sans);font-size:.95rem;font-weight:800;color:var(--paper);margin-bottom:1rem;"><i class="fas fa-trophy" style="color:var(--tag);"></i> Tu mejor resultado</h3>
        <div style="display:flex;align-items:center;gap:1rem;">
            <div style="text-align:center;">
                <div style="font-family:var(--font-mono);font-size:2rem;font-weight:700;color:{{ $mejor->aprobado ? 'var(--resolved)' : 'var(--alert)' }};">{{ $mejor->porcentaje }}%</div>
                <span class="badge {{ $mejor->aprobado ? 'badge-ok' : 'badge-err' }}">{{ $mejor->aprobado ? 'Aprobado' : 'No aprobado' }}</span>
            </div>
            <div style="flex:1;"><div class="progreso-bar"><div class="progreso-fill" style="width:{{ $mejor->porcentaje }}%;background:{{ $mejor->aprobado ? 'var(--resolved)' : 'var(--alert)' }};"></div></div><div style="font-size:.78rem;color:var(--muted);margin-top:.4rem;">{{ $mejor->puntaje }} / {{ $mejor->puntaje_total }} puntos</div></div>
        </div>
    </div>
    @endif
    @if($intentos->count())
    <div class="db-card">
        <h3 style="font-family:var(--font-sans);font-size:.95rem;font-weight:800;color:var(--paper);margin-bottom:1rem;">Historial de intentos ({{ $usados }}/{{ $maxIntentos === -1 ? '∞' : $maxIntentos }})</h3>
        @foreach($intentos as $int)
        <div class="intento-row">
            <span style="color:var(--muted);">Intento #{{ $loop->iteration }}</span>
            <span>{{ $int->porcentaje }}% · {{ $int->puntaje }}/{{ $int->puntaje_total }} pts</span>
            <span class="badge {{ $int->aprobado ? 'badge-ok' : 'badge-err' }}">{{ $int->aprobado ? 'Aprobado' : 'No aprobado' }}</span>
            <a href="{{ route('quiz.resultado',$int) }}" style="font-size:.8rem;color:var(--uv);font-weight:600;">Ver <i class="fas fa-arrow-right"></i></a>
        </div>
        @endforeach
    </div>
    @endif
    <div class="db-card">
        @if($puedeIntentar)
        <p style="font-size:.88rem;color:var(--muted);margin-bottom:1.1rem;"><i class="fas fa-info-circle" style="color:var(--uv);"></i> Una vez iniciado, las preguntas aparecerán en orden{{ $quiz->aleatorio ? ' aleatorio' : '' }}.@if($quiz->tiempo_limite) Tendrás <strong>{{ $quiz->tiempo_limite }} minutos</strong>.@endif</p>
        <form method="POST" action="{{ route('quiz.iniciar',$quiz) }}">@csrf<button type="submit" class="btn-start"><i class="fas fa-play"></i> {{ $intentos->count() ? 'Intentar de nuevo' : 'Comenzar Quiz' }}</button></form>
        @else
        <div style="text-align:center;padding:1rem;color:var(--muted);"><i class="fas fa-lock" style="font-size:2rem;display:block;margin-bottom:.75rem;"></i><p>Has agotado los <strong>{{ $maxIntentos }}</strong> intentos permitidos.</p>@if($mejor && $mejor->aprobado)<span class="badge badge-ok" style="font-size:.85rem;padding:.4rem 1rem;">Quiz aprobado</span>@endif</div>
        @endif
    </div>
</div>
@endsection
