@extends('admin.layout')
@section('title','Estudiantes - ' . $curso->titulo)
@section('page-title','Estudiantes: ' . Str::limit($curso->titulo, 35))

@section('content')
<style>
    .adm-back { display: inline-flex; align-items: center; gap: .4rem; font-size: .84rem; color: var(--uv); font-weight: 600; text-decoration: none; margin-bottom: 1.1rem; }
    .adm-back:hover { color: #b3a8ff; }
    .adm-table-wrap { background: var(--panel); border: 1px solid var(--line); border-radius: 12px; overflow: hidden; }
    table { width: 100%; border-collapse: collapse; }
    thead { background: var(--lab-deep); }
    th { padding: .75rem 1rem; text-align: left; font-family: var(--font-mono); font-size: .66rem; font-weight: 500; text-transform: uppercase; letter-spacing: .08em; color: var(--muted); border-bottom: 1px solid var(--line-soft); }
    td { padding: .875rem 1rem; font-size: .86rem; color: var(--paper); border-bottom: 1px solid var(--line-soft); vertical-align: middle; }
    tr:last-child td { border-bottom: none; }
    tr:hover td { background: var(--panel-2); }

    .est-avatar { width: 36px; height: 36px; border-radius: 50%; background: linear-gradient(135deg, var(--uv), #6a58e0); color: #fff; font-weight: 700; font-size: .88rem; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
    .prog-mini-wrap { height: 8px; background: var(--lab-deep); border-radius: 999px; overflow: hidden; width: 100px; }
    .prog-mini-fill { height: 100%; border-radius: 999px; background: linear-gradient(90deg, var(--uv), #6a58e0); }
    .prog-mini-fill.done { background: linear-gradient(90deg, var(--resolved), #2e9f83); }
    .badge { display: inline-flex; align-items: center; gap: .25rem; font-family: var(--font-mono); font-size: .66rem; font-weight: 500; padding: .2rem .65rem; border-radius: 999px; }
    .badge-done { background: var(--resolved-soft); color: var(--resolved); }
    .badge-prog { background: var(--uv-soft); color: var(--uv); }

    .empty-table { text-align: center; padding: 3rem 2rem; color: var(--muted); }
    .empty-table i { font-size: 2.5rem; display: block; margin-bottom: .75rem; color: var(--uv); }

    .stats-bar { display: flex; gap: 1rem; flex-wrap: wrap; margin-bottom: 1.25rem; }
    .sbar { background: var(--panel); border: 1px solid var(--line); border-radius: 10px; padding: .875rem 1.25rem; display: flex; align-items: center; gap: .65rem; }
    .sbar-num { font-family: var(--font-mono); font-size: 1.3rem; font-weight: 700; color: var(--paper); }
    .sbar-label { font-size: .78rem; color: var(--muted); }
</style>

<a href="{{ route('admin.cursos.show', $curso) }}" class="adm-back">
    <i class="fas fa-arrow-left"></i> Volver al curso
</a>

<div class="stats-bar">
    <div class="sbar">
        <div><div class="sbar-num">{{ $estudiantes->count() }}</div><div class="sbar-label">Total inscritos</div></div>
    </div>
    <div class="sbar">
        <div><div class="sbar-num">{{ $estudiantes->where('pivot.completado', true)->count() }}</div><div class="sbar-label">Completaron</div></div>
    </div>
    <div class="sbar">
        <div>
            <div class="sbar-num">
                {{ $estudiantes->count() > 0 ? round($estudiantes->avg('pivot.progreso')) : 0 }}%
            </div>
            <div class="sbar-label">Progreso promedio</div>
        </div>
    </div>
</div>

<div class="adm-table-wrap">
    @if($estudiantes->isEmpty())
        <div class="empty-table">
            <i class="fas fa-users"></i>
            <p>Ningún estudiante inscrito aún.</p>
        </div>
    @else
        <table>
            <thead>
                <tr>
                    <th>Estudiante</th>
                    <th>Inscrito</th>
                    <th>Progreso</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                @foreach($estudiantes as $est)
                    <tr>
                        <td>
                            <div style="display:flex;align-items:center;gap:.75rem;">
                                <div class="est-avatar">{{ strtoupper(substr($est->name,0,1)) }}</div>
                                <div>
                                    <div style="font-weight:600;color:var(--paper);">{{ $est->name }}</div>
                                    <div style="font-size:.75rem;color:var(--muted);">{{ $est->email }}</div>
                                </div>
                            </div>
                        </td>
                        <td>{{ \Carbon\Carbon::parse($est->pivot->fecha_inscripcion)->format('d/m/Y') }}</td>
                        <td>
                            <div style="display:flex;align-items:center;gap:.5rem;">
                                <div class="prog-mini-wrap">
                                    <div class="prog-mini-fill {{ $est->pivot->completado ? 'done' : '' }}"
                                        style="width:{{ $est->pivot->progreso }}%"></div>
                                </div>
                                <span style="font-size:.78rem;font-weight:600;color:var(--muted);">{{ $est->pivot->progreso }}%</span>
                            </div>
                        </td>
                        <td>
                            @if($est->pivot->completado)
                                <span class="badge badge-done"><i class="fas fa-check-circle"></i> Completado</span>
                            @else
                                <span class="badge badge-prog"><i class="fas fa-spinner"></i> En progreso</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
