@extends('admin.layout')
@section('title','Dashboard Admin')
@section('page-title','Dashboard')

@section('content')
<style>
    .adm-stats { display: grid; grid-template-columns: repeat(4,1fr); gap: 1rem; margin-bottom: 1.5rem; }
    .adm-stat {
        background: var(--panel); border: 1px solid var(--line);
        border-radius: 12px; padding: 1.25rem;
        display: flex; align-items: center; gap: .9rem;
        transition: transform .2s, box-shadow .2s;
    }
    .adm-stat:hover { transform: translateY(-3px); box-shadow: 0 8px 20px rgba(0,0,0,.35); }
    .adm-stat-icon { width: 50px; height: 50px; border-radius: 11px; display: flex; align-items: center; justify-content: center; font-size: 1.3rem; flex-shrink: 0; }
    .ic-red    { background: var(--alert-soft);  color: var(--alert); }
    .ic-blue   { background: var(--uv-soft);     color: var(--uv); }
    .ic-green  { background: var(--resolved-soft); color: var(--resolved); }
    .ic-gold   { background: var(--tag-soft);    color: var(--tag); }
    .adm-stat-num   { font-family: var(--font-mono); font-size: 1.6rem; font-weight: 700; color: var(--paper); line-height: 1; margin-bottom: .15rem; }
    .adm-stat-label { font-size: .8rem; color: var(--muted); font-weight: 600; }

    .adm-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 1.25rem; }
    .adm-card { background: var(--panel); border: 1px solid var(--line); border-radius: 12px; overflow: hidden; }
    .adm-card-head { padding: 1rem 1.25rem; border-bottom: 1px solid var(--line-soft); display: flex; align-items: center; justify-content: space-between; }
    .adm-card-title { font-family: var(--font-sans); font-size: .95rem; font-weight: 800; color: var(--paper); margin: 0; display: flex; align-items: center; gap: .45rem; }
    .adm-card-title i { color: var(--tag); }
    .adm-card-body  { padding: 1.1rem; }

    .adm-row { display: flex; align-items: center; gap: .9rem; padding: .75rem 0; border-bottom: 1px solid var(--line-soft); }
    .adm-row:last-child { border-bottom: none; padding-bottom: 0; }
    .adm-row-icon { width: 40px; height: 40px; border-radius: 9px; display: flex; align-items: center; justify-content: center; font-size: 1.1rem; color: #fff; flex-shrink: 0; background: linear-gradient(135deg, var(--uv), #6a58e0); }
    .adm-row-info { flex: 1; min-width: 0; }
    .adm-row-name  { font-weight: 600; font-size: .86rem; color: var(--paper); white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
    .adm-row-sub   { font-size: .75rem; color: var(--muted); margin-top: .1rem; }
    .adm-row-badge { font-family: var(--font-mono); font-size: .68rem; font-weight: 500; padding: .2rem .6rem; border-radius: 999px; white-space: nowrap; }
    .badge-free { background: var(--resolved-soft); color: var(--resolved); }
    .badge-paid { background: var(--tag-soft); color: var(--tag); }
    .badge-on   { background: var(--resolved-soft); color: var(--resolved); }

    .adm-link { font-size: .82rem; color: var(--uv); font-weight: 600; text-decoration: none; }
    .adm-link:hover { color: #b3a8ff; }

    @media (max-width: 900px) { .adm-stats { grid-template-columns: 1fr 1fr; } .adm-grid { grid-template-columns: 1fr; } }
</style>

<div class="adm-stats">
    <div class="adm-stat">
        <div class="adm-stat-icon ic-blue"><i class="fas fa-graduation-cap"></i></div>
        <div><div class="adm-stat-num">{{ $totalCursos }}</div><div class="adm-stat-label">Total Cursos</div></div>
    </div>
    <div class="adm-stat">
        <div class="adm-stat-icon ic-green"><i class="fas fa-check-circle"></i></div>
        <div><div class="adm-stat-num">{{ $cursosActivos }}</div><div class="adm-stat-label">Cursos Activos</div></div>
    </div>
    <div class="adm-stat">
        <div class="adm-stat-icon ic-red"><i class="fas fa-users"></i></div>
        <div><div class="adm-stat-num">{{ $totalEstudiantes }}</div><div class="adm-stat-label">Estudiantes</div></div>
    </div>
    <div class="adm-stat">
        <div class="adm-stat-icon ic-gold"><i class="fas fa-book-open"></i></div>
        <div><div class="adm-stat-num">{{ $totalInscripciones }}</div><div class="adm-stat-label">Inscripciones</div></div>
    </div>
</div>

<div class="adm-grid">
    {{-- Cursos recientes --}}
    <div class="adm-card">
        <div class="adm-card-head">
            <h3 class="adm-card-title"><i class="fas fa-graduation-cap"></i> Cursos Recientes</h3>
            <a href="{{ route('admin.cursos.index') }}" class="adm-link">Ver todos <i class="fas fa-arrow-right"></i></a>
        </div>
        <div class="adm-card-body">
            @forelse($cursosRecientes as $curso)
                <div class="adm-row">
                    <div class="adm-row-icon">
                        <i class="fas {{ $curso->icono_fa ?? 'fa-fingerprint' }}"></i>
                    </div>
                    <div class="adm-row-info">
                        <div class="adm-row-name">{{ $curso->titulo }}</div>
                        <div class="adm-row-sub">{{ $curso->estudiantes_count }} estudiantes · {{ $curso->categoriaLabel() }}</div>
                    </div>
                    <div>
                        <span class="adm-row-badge {{ $curso->tipo === 'free' ? 'badge-free' : 'badge-paid' }}">
                            {{ $curso->tipo === 'free' ? 'Gratis' : 'Pago' }}
                        </span>
                    </div>
                </div>
            @empty
                <p style="color:var(--muted);font-size:.88rem;text-align:center;padding:1rem 0;">No hay cursos aún.</p>
            @endforelse
        </div>
    </div>

    {{-- Estudiantes recientes --}}
    <div class="adm-card">
        <div class="adm-card-head">
            <h3 class="adm-card-title"><i class="fas fa-users"></i> Estudiantes Recientes</h3>
            <a href="{{ route('admin.estudiantes') }}" class="adm-link">Ver todos <i class="fas fa-arrow-right"></i></a>
        </div>
        <div class="adm-card-body">
            @forelse($estudiantesRecientes as $est)
                <div class="adm-row">
                    <div class="adm-row-icon" style="background: linear-gradient(135deg, var(--tag), #d89a22);">
                        <span style="font-weight:700;font-size:.9rem;color:#1A1203;">{{ strtoupper(substr($est->name,0,1)) }}</span>
                    </div>
                    <div class="adm-row-info">
                        <div class="adm-row-name">{{ $est->name }}</div>
                        <div class="adm-row-sub">{{ $est->email }}</div>
                    </div>
                    <span class="adm-row-badge badge-on">Estudiante</span>
                </div>
            @empty
                <p style="color:var(--muted);font-size:.88rem;text-align:center;padding:1rem 0;">No hay estudiantes aún.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
