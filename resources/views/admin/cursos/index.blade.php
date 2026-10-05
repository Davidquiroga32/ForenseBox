@extends('admin.layout')
@section('title','Cursos')
@section('page-title','Gestión de Cursos')

@section('content')
<style>
    .adm-toolbar { display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 1rem; margin-bottom: 1.25rem; }
    .adm-table-wrap { background: var(--panel); border: 1px solid var(--line); border-radius: 12px; overflow: hidden; }
    table { width: 100%; border-collapse: collapse; }
    thead { background: var(--lab-deep); }
    th { padding: .75rem 1rem; text-align: left; font-family: var(--font-mono); font-size: .66rem; font-weight: 500; text-transform: uppercase; letter-spacing: .08em; color: var(--muted); border-bottom: 1px solid var(--line-soft); }
    td { padding: .875rem 1rem; font-size: .86rem; color: var(--paper); border-bottom: 1px solid var(--line-soft); vertical-align: middle; }
    tr:last-child td { border-bottom: none; }
    tr:hover td { background: var(--panel-2); }

    .curso-thumb { width: 44px; height: 44px; border-radius: 9px; display: flex; align-items: center; justify-content: center; color: #fff; font-size: 1.1rem; flex-shrink: 0; background: linear-gradient(135deg, var(--uv), #6a58e0); }
    .curso-name { font-weight: 600; color: var(--paper); }
    .curso-cat  { font-size: .75rem; color: var(--muted); margin-top: .1rem; }

    .badge { display: inline-flex; align-items: center; gap: .25rem; font-family: var(--font-mono); font-size: .66rem; font-weight: 500; padding: .2rem .65rem; border-radius: 999px; }
    .badge-free   { background: var(--resolved-soft); color: var(--resolved); }
    .badge-paid   { background: var(--tag-soft); color: var(--tag); }
    .badge-active { background: var(--resolved-soft); color: var(--resolved); }
    .badge-inactive{ background: var(--alert-soft); color: var(--alert); }

    .adm-actions { display: flex; align-items: center; gap: .4rem; }
    .act-btn {
        width: 32px; height: 32px; border-radius: 7px;
        display: flex; align-items: center; justify-content: center;
        font-size: .82rem; text-decoration: none; border: none; cursor: pointer; transition: all .15s;
    }
    .act-view  { background: var(--uv-soft); color: var(--uv); }
    .act-edit  { background: var(--tag-soft); color: var(--tag); }
    .act-del   { background: var(--alert-soft); color: var(--alert); }
    .act-tog   { background: var(--lab-deep); color: var(--muted); }
    .act-btn:hover { filter: brightness(1.2); }

    .btn-nuevo {
        display: inline-flex; align-items: center; gap: .5rem;
        padding: .6rem 1.1rem; background: var(--tag); color: #1A1203;
        border-radius: 8px; font-size: .86rem; font-weight: 600;
        text-decoration: none; transition: background .16s;
        box-shadow: 0 3px 12px rgba(242,179,61,.2);
    }
    .btn-nuevo:hover { background: #ffc75c; color: #1A1203; }

    .empty-table { text-align: center; padding: 3rem 2rem; color: var(--muted); }
    .empty-table i { font-size: 2.5rem; display: block; margin-bottom: .75rem; color: var(--uv); }

    @media (max-width: 768px) {
        .hide-sm { display: none; }
        td, th { padding: .6rem .75rem; }
    }
</style>

<div class="adm-toolbar">
    <div style="font-size:.9rem;color:var(--muted);">
        <strong style="color:var(--paper);">{{ $totalCursos }}</strong> cursos en total ·
        <strong style="color:var(--resolved);">{{ $cursosActivos }}</strong> activos ·
        <strong style="color:var(--uv);">{{ $totalEstudiantes }}</strong> estudiantes
    </div>
    <a href="{{ route('admin.cursos.create') }}" class="btn-nuevo">
        <i class="fas fa-plus"></i> Nuevo Curso
    </a>
</div>

<div class="adm-table-wrap">
    @if($cursos->isEmpty())
        <div class="empty-table">
            <i class="fas fa-graduation-cap"></i>
            <p>No hay cursos todavía.</p>
            <a href="{{ route('admin.cursos.create') }}" class="btn-nuevo">
                <i class="fas fa-plus"></i> Crear primer curso
            </a>
        </div>
    @else
        <table>
            <thead>
                <tr>
                    <th>Curso</th>
                    <th class="hide-sm">Categoría</th>
                    <th>Tipo</th>
                    <th class="hide-sm">Estudiantes</th>
                    <th class="hide-sm">Lecciones</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cursos as $curso)
                    <tr>
                        <td>
                            <div style="display:flex;align-items:center;gap:.75rem;">
                                <div class="curso-thumb"
                                    style="background: linear-gradient(135deg, {{ $curso->color_gradiente ?? '#15253a,#0A121B' }});">
                                    <i class="fas {{ $curso->icono_fa ?? 'fa-graduation-cap' }}"></i>
                                </div>
                                <div>
                                    <div class="curso-name">{{ Str::limit($curso->titulo, 40) }}</div>
                                    <div class="curso-cat">{{ $curso->duracion_horas }}h · {{ $curso->lecciones_count }} lecciones</div>
                                </div>
                            </div>
                        </td>
                        <td class="hide-sm">{{ $curso->categoriaLabel() }}</td>
                        <td>
                            <span class="badge {{ $curso->tipo === 'free' ? 'badge-free' : 'badge-paid' }}">
                                {{ $curso->tipo === 'free' ? 'Gratis' : '$'.number_format($curso->precio,0,',','.') }}
                            </span>
                        </td>
                        <td class="hide-sm">{{ $curso->estudiantes_count }}</td>
                        <td class="hide-sm">{{ $curso->lecciones_count }}</td>
                        <td>
                            <span class="badge {{ $curso->activo ? 'badge-active' : 'badge-inactive' }}">
                                {{ $curso->activo ? 'Activo' : 'Inactivo' }}
                            </span>
                        </td>
                        <td>
                            <div class="adm-actions">
                                <a href="{{ route('admin.cursos.show', $curso) }}" class="act-btn act-view" title="Ver detalle">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.cursos.edit', $curso) }}" class="act-btn act-edit" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="{{ route('admin.cursos.estudiantes', $curso) }}" class="act-btn act-tog" title="Estudiantes">
                                    <i class="fas fa-users"></i>
                                </a>
                                <form method="POST" action="{{ route('admin.cursos.toggle', $curso) }}" style="display:inline;">
                                    @csrf @method('PATCH')
                                    <button type="submit" class="act-btn act-tog" title="{{ $curso->activo ? 'Desactivar' : 'Activar' }}">
                                        <i class="fas {{ $curso->activo ? 'fa-eye-slash' : 'fa-eye' }}"></i>
                                    </button>
                                </form>
                                <form method="POST" action="{{ route('admin.cursos.destroy', $curso) }}"
                                    onsubmit="return confirm('¿Eliminar el curso «{{ $curso->titulo }}»? Esta acción no se puede deshacer.')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="act-btn act-del" title="Eliminar">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection