@extends('layouts.dashboard')

@section('title', 'Mis Cursos')
@section('page-title', 'Mis Cursos')

@section('content')
<style>
    .cursos-head { display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 1rem; margin-bottom: 1.5rem; }
    .cursos-head p { color: var(--muted); margin: 0; font-size: .9rem; }

    .cursos-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(290px, 1fr)); gap: 1.1rem; }

    .curso-card {
        background: var(--panel); border: 1px solid var(--line);
        border-radius: 12px; overflow: hidden;
        transition: transform .2s, box-shadow .2s;
    }
    .curso-card:hover { transform: translateY(-4px); box-shadow: 0 10px 24px rgba(0,0,0,.4); border-color: var(--uv); }

    .curso-card-img {
        height: 120px; display: flex; align-items: center;
        justify-content: center; font-size: 2.5rem; color: #fff;
        background: linear-gradient(135deg, #15253a, #0A121B);
        position: relative;
    }
    .curso-card-img::before {
        content: '';
        position: absolute; inset: 0;
        background-image:
            linear-gradient(rgba(142,123,255,.08) 1px, transparent 1px),
            linear-gradient(90deg, rgba(142,123,255,.08) 1px, transparent 1px);
        background-size: 26px 26px;
    }
    .curso-card-img i { position: relative; z-index: 1; }
    .curso-card-body { padding: 1.1rem 1.25rem; }
    .curso-cat { font-family: var(--font-mono); font-size: .68rem; font-weight: 500; text-transform: uppercase; letter-spacing: .08em; color: var(--uv); margin-bottom: .3rem; }
    .curso-title { font-family: var(--font-sans); font-weight: 800; font-size: .95rem; color: var(--paper); margin-bottom: .85rem; line-height: 1.3; }

    .badge-done { display: inline-flex; align-items: center; gap: .3rem; background: var(--resolved-soft); color: var(--resolved); font-size: .75rem; font-weight: 600; padding: .2rem .65rem; border-radius: 999px; margin-bottom: .85rem; }

    .prog-label { display: flex; justify-content: space-between; font-size: .75rem; color: var(--muted); margin-bottom: .3rem; }
    .prog-bar   { height: 7px; background: var(--lab); border-radius: 999px; overflow: hidden; margin-bottom: 1rem; }
    .prog-fill  { height: 100%; border-radius: 999px; background: linear-gradient(90deg, var(--uv), #6a58e0); }
    .prog-fill.done { background: linear-gradient(90deg, var(--resolved), #2e9f83); }

    .btn-curso {
        display: flex; align-items: center; justify-content: center; gap: .4rem;
        width: 100%; padding: .6rem; background: var(--tag); color: #1A1203;
        border-radius: 8px; font-size: .86rem; font-weight: 600;
        text-decoration: none; transition: background .16s;
        box-shadow: 0 3px 12px rgba(242,179,61,.2);
    }
    .btn-curso:hover { background: #ffc75c; color: #1A1203; }

    .db-empty { text-align: center; padding: 3.5rem 2rem; color: var(--muted); }
    .db-empty i { font-size: 3rem; display: block; margin-bottom: 1rem; color: var(--uv); }
    .db-empty h3 { color: var(--paper); margin-bottom: .5rem; font-size: 1.1rem; }
    .db-empty p { font-size: .9rem; max-width: 380px; margin: 0 auto 1.25rem; }

    @media (max-width: 560px) { .cursos-grid { grid-template-columns: 1fr; } }
</style>

<div class="cursos-head">
    <p>Todos los cursos en los que estás inscrito.</p>
    <a href="{{ route('cursos.index') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Inscribirse en más cursos
    </a>
</div>

@if($cursos->isEmpty())
    <div style="background:var(--panel);border:1px solid var(--line);border-radius:12px;">
        <div class="db-empty">
            <i class="fas fa-book-open"></i>
            <h3>No tienes cursos inscritos</h3>
            <p>Explora nuestro catálogo y comienza a dominar la ciberseguridad y la forensia digital.</p>
            <a href="{{ route('cursos.index') }}" class="btn btn-primary" style="font-size:1rem;padding:.875rem 2rem;">
                <i class="fas fa-search"></i> Explorar Catálogo
            </a>
        </div>
    </div>
@else
    <div class="cursos-grid">
        @foreach($cursos as $curso)
            @php $prog = $curso->pivot->progreso ?? 0; @endphp
            <div class="curso-card">
                <div class="curso-card-img">
                    <i class="fas {{ $curso->icono_fa ?? 'fa-fingerprint' }}"></i>
                </div>
                <div class="curso-card-body">
                    <div class="curso-cat">{{ $curso->categoriaLabel() }}</div>
                    <div class="curso-title">{{ $curso->titulo }}</div>
                    @if($prog >= 100)
                        <div class="badge-done"><i class="fas fa-check-circle"></i> Completado</div>
                    @endif
                    <div class="prog-label"><span>Progreso</span><span>{{ $prog }}%</span></div>
                    <div class="prog-bar">
                        <div class="prog-fill {{ $prog >= 100 ? 'done' : '' }}" style="width:{{ $prog }}%"></div>
                    </div>
                    <a href="{{ route('curso.player', $curso->slug) }}" class="btn-curso">
                        {{ $prog >= 100 ? 'Revisar Curso' : 'Continuar' }} <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        @endforeach
    </div>
@endif
@endsection
