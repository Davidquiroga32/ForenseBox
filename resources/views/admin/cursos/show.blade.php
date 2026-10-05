@extends('admin.layout')
@section('title', $curso->titulo)
@section('page-title', $curso->titulo)

@section('content')
<style>
    .show-grid { display: grid; grid-template-columns: 1fr 300px; gap: 1.25rem; align-items: start; }
    .adm-card  { background: var(--panel); border: 1px solid var(--line); border-radius: 12px; overflow: hidden; margin-bottom: 1.25rem; }
    .adm-card-head { padding: 1rem 1.25rem; border-bottom: 1px solid var(--line-soft); display: flex; align-items: center; justify-content: space-between; }
    .adm-card-title { font-family: var(--font-sans); font-size: .95rem; font-weight: 800; color: var(--paper); margin: 0; display: flex; align-items: center; gap: .45rem; }
    .adm-card-title i { color: var(--tag); }
    .adm-card-body  { padding: 1.25rem; }

    .curso-header-card {
        background: linear-gradient(135deg, #0A121B, #14253a);
        border: 1px solid var(--line);
        border-radius: 12px; padding: 1.5rem;
        color: var(--paper); margin-bottom: 1.25rem;
        display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 1rem;
    }
    .curso-header-icon { width: 60px; height: 60px; border-radius: 14px; background: var(--uv-soft); display: flex; align-items: center; justify-content: center; font-size: 1.75rem; color: var(--uv); flex-shrink: 0; }
    .curso-header-info { flex: 1; }
    .curso-header-title { font-family: var(--font-sans); font-size: 1.3rem; font-weight: 800; margin-bottom: .3rem; }
    .curso-header-meta  { font-size: .85rem; color: var(--muted); }
    .curso-header-actions { display: flex; gap: .6rem; }
    .btn-edit-curso {
        display: inline-flex; align-items: center; gap: .4rem;
        padding: .55rem 1rem; background: var(--tag); color: #1A1203;
        border: 1.5px solid var(--tag); border-radius: 8px;
        font-size: .84rem; font-weight: 600; text-decoration: none; transition: background .16s;
    }
    .btn-edit-curso:hover { background: #ffc75c; color: #1A1203; }

    .curso-stats-grid { display: grid; grid-template-columns: repeat(3,1fr); gap: .75rem; margin-bottom: 1.25rem; }
    .cstat { background: var(--panel); border: 1px solid var(--line); border-radius: 10px; padding: 1rem; text-align: center; }
    .cstat-num   { font-family: var(--font-mono); font-size: 1.5rem; font-weight: 700; color: var(--paper); }
    .cstat-label { font-size: .75rem; color: var(--muted); margin-top: .2rem; }

    .modulo-item { border: 1.5px solid var(--line); border-radius: 10px; margin-bottom: .875rem; overflow: hidden; }
    .modulo-head {
        padding: .875rem 1.1rem; background: var(--lab-deep);
        display: flex; align-items: center; justify-content: space-between;
        cursor: pointer;
    }
    .modulo-head-left { display: flex; align-items: center; gap: .65rem; }
    .modulo-num { width: 26px; height: 26px; background: var(--uv); color: #fff; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-family: var(--font-mono); font-size: .68rem; font-weight: 600; flex-shrink: 0; }
    .modulo-titulo { font-weight: 700; font-size: .9rem; color: var(--paper); }
    .modulo-actions { display: flex; gap: .35rem; }
    .mact { width: 28px; height: 28px; border-radius: 6px; display: flex; align-items: center; justify-content: center; font-size: .75rem; cursor: pointer; border: none; transition: all .15s; }
    .mact-edit  { background: var(--tag-soft); color: var(--tag); }
    .mact-del   { background: var(--alert-soft); color: var(--alert); }
    .mact-quiz  { background: var(--uv-soft); color: var(--uv); }

    .lecciones-list { padding: 0 .875rem .875rem; }
    .leccion-item {
        display: flex; align-items: center; gap: .75rem;
        padding: .65rem .875rem; margin-top: .5rem;
        background: var(--panel-2); border: 1px solid var(--line-soft); border-radius: 8px;
    }
    .lec-tipo-icon { width: 32px; height: 32px; border-radius: 7px; display: flex; align-items: center; justify-content: center; font-size: .82rem; flex-shrink: 0; }
    .tipo-texto  { background: var(--uv-soft); color: var(--uv); }
    .tipo-video  { background: var(--tag-soft); color: var(--tag); }
    .tipo-pdf    { background: var(--alert-soft); color: var(--alert); }
    .tipo-quiz   { background: var(--uv-soft); color: #c9bfff; }
    .tipo-tarea  { background: var(--resolved-soft); color: var(--resolved); }
    .lec-titulo  { flex: 1; font-size: .84rem; font-weight: 500; color: var(--paper); }
    .lec-dur     { font-size: .75rem; color: var(--muted); }
    .lec-actions { display: flex; gap: .3rem; }

    .nuevo-modulo-form {
        background: var(--lab-deep); border: 1.5px dashed var(--line);
        border-radius: 10px; padding: 1rem; margin-top: .75rem;
    }
    .fi-sm { padding: .55rem .8rem; border: 1.5px solid var(--line); border-radius: 7px; font-size: .85rem; font-family: inherit; width: 100%; outline: none; background: var(--lab); color: var(--paper); }
    .fi-sm:focus { border-color: var(--uv); }
    .btn-add-modulo {
        display: inline-flex; align-items: center; gap: .4rem;
        padding: .55rem 1rem; background: var(--tag); color: #1A1203;
        border: none; border-radius: 7px; font-size: .84rem; font-weight: 600; cursor: pointer;
    }
    .btn-add-leccion {
        display: inline-flex; align-items: center; gap: .35rem;
        padding: .4rem .75rem; background: transparent; color: var(--uv);
        border: 1.5px solid var(--uv); border-radius: 7px;
        font-size: .78rem; font-weight: 600; text-decoration: none; transition: all .15s;
    }
    .btn-add-leccion:hover { background: var(--uv-soft); color: #fff; }

    .info-row { display: flex; justify-content: space-between; align-items: center; padding: .65rem 0; border-bottom: 1px solid var(--line-soft); font-size: .85rem; }
    .info-row:last-child { border-bottom: none; }
    .info-label { color: var(--muted); font-weight: 500; }
    .info-value { color: var(--paper); font-weight: 600; }

    @media (max-width: 900px) { .show-grid { grid-template-columns: 1fr; } }
</style>

<div class="curso-header-card">
    <div style="display:flex;align-items:center;gap:1rem;flex-wrap:wrap;">
        <div class="curso-header-icon">
            <i class="fas {{ $curso->icono_fa ?? 'fa-graduation-cap' }}"></i>
        </div>
        <div class="curso-header-info">
            <div class="curso-header-title">{{ $curso->titulo }}</div>
            <div class="curso-header-meta">
                {{ $curso->categoriaLabel() }} · {{ $curso->duracion_horas }}h · {{ $curso->precioFormateado() }}
            </div>
        </div>
    </div>
    <div class="curso-header-actions">
        <a href="{{ route('admin.cursos.edit', $curso) }}" class="btn-edit-curso">
            <i class="fas fa-edit"></i> Editar
        </a>
        <a href="{{ route('admin.cursos.estudiantes', $curso) }}" class="btn-edit-curso">
            <i class="fas fa-users"></i> Estudiantes
        </a>
    </div>
</div>

<div class="curso-stats-grid">
    <div class="cstat">
        <div class="cstat-num">{{ $totalEstudiantes }}</div>
        <div class="cstat-label">Estudiantes Inscritos</div>
    </div>
    <div class="cstat">
        <div class="cstat-num">{{ $totalLecciones }}</div>
        <div class="cstat-label">Lecciones</div>
    </div>
    <div class="cstat">
        <div class="cstat-num">{{ $completados }}</div>
        <div class="cstat-label">Completaron el Curso</div>
    </div>
</div>

<div class="show-grid">

    <div>
        <div class="adm-card">
            <div class="adm-card-head">
                <h3 class="adm-card-title"><i class="fas fa-layer-group" style="color:var(--uv);"></i> Módulos y Lecciones</h3>
            </div>
            <div class="adm-card-body">

                @forelse($curso->modulos as $modulo)
                    <div class="modulo-item">
                        <div class="modulo-head">
                            <div class="modulo-head-left">
                                <div class="modulo-num">{{ $loop->iteration }}</div>
                                <div class="modulo-titulo">{{ $modulo->titulo }}</div>
                                <span style="font-size:.75rem;color:var(--muted);">{{ $modulo->lecciones->count() }} lecciones</span>
                            </div>
                            <div class="modulo-actions" onclick="event.stopPropagation()">
                                <a href="{{ route('admin.lecciones.create', $modulo) }}" class="mact" style="background:var(--uv-soft);color:var(--uv);text-decoration:none;" title="Agregar lección">
                                    <i class="fas fa-plus"></i>
                                </a>
                                <button onclick="toggleEditModulo({{ $modulo->id }})" class="mact mact-edit" title="Editar módulo">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <form method="POST" action="{{ route('admin.modulos.destroy', $modulo) }}"
                                      onsubmit="return confirm('¿Eliminar módulo «{{ $modulo->titulo }}» y todas sus lecciones?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="mact mact-del" title="Eliminar módulo">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>

                        <div id="edit-modulo-{{ $modulo->id }}" style="display:none;padding:.75rem;background:var(--lab-deep);border-top:1px solid var(--line);">
                            <form method="POST" action="{{ route('admin.modulos.update', $modulo) }}">
                                @csrf @method('PUT')
                                <div style="display:flex;gap:.6rem;align-items:center;">
                                    <input type="text" name="titulo" class="fi-sm" value="{{ $modulo->titulo }}" required>
                                    <button type="submit" class="btn-add-modulo" style="white-space:nowrap;">
                                        <i class="fas fa-save"></i> Guardar
                                    </button>
                                    <button type="button" onclick="toggleEditModulo({{ $modulo->id }})"
                                            style="padding:.55rem .75rem;background:var(--panel-2);border:none;border-radius:7px;cursor:pointer;font-size:.84rem;">
                                        Cancelar
                                    </button>
                                </div>
                            </form>
                        </div>

                        <div class="lecciones-list">
                            @forelse($modulo->lecciones as $leccion)
                                <div class="leccion-item">
                                    @php
                                        $tipoClass = ['texto'=>'tipo-texto','video'=>'tipo-video','pdf'=>'tipo-pdf','quiz'=>'tipo-quiz','tarea'=>'tipo-tarea'][$leccion->tipo_contenido] ?? 'tipo-texto';
                                        $tipoIcon  = ['texto'=>'fa-file-alt','video'=>'fa-play-circle','pdf'=>'fa-file-pdf','quiz'=>'fa-question-circle','tarea'=>'fa-tasks'][$leccion->tipo_contenido] ?? 'fa-file-alt';
                                    @endphp
                                    <div class="lec-tipo-icon {{ $tipoClass }}">
                                        <i class="fas {{ $tipoIcon }}"></i>
                                    </div>
                                    <div class="lec-titulo">{{ $leccion->titulo }}</div>
                                    @if($leccion->duracion_minutos)
                                        <div class="lec-dur">{{ $leccion->duracion_minutos }}min</div>
                                    @endif
                                    <div class="lec-actions">
                                        {{-- Botón editar: si es quiz va al editor de quiz, si no a editar lección --}}
                                        @if($leccion->tipo_contenido === 'quiz')
                                            <a href="{{ route('admin.quiz.edit', $leccion) }}"
                                               class="mact mact-quiz" style="text-decoration:none;" title="Editar Quiz">
                                                <i class="fas fa-question-circle"></i>
                                            </a>
                                        @else
                                            <a href="{{ route('admin.lecciones.edit', $leccion) }}"
                                               class="mact mact-edit" style="text-decoration:none;" title="Editar">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        @endif
                                        <form method="POST" action="{{ route('admin.lecciones.destroy', $leccion) }}"
                                              onsubmit="return confirm('¿Eliminar lección «{{ $leccion->titulo }}»?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="mact mact-del" title="Eliminar">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @empty
                                <div style="text-align:center;padding:.75rem;font-size:.82rem;color:var(--muted);">
                                    Sin lecciones.
                                    <a href="{{ route('admin.lecciones.create', $modulo) }}" style="color:var(--uv);font-weight:600;">Agregar una <i class="fas fa-plus"></i></a>
                                </div>
                            @endforelse

                            <div style="margin-top:.5rem;">
                                <a href="{{ route('admin.lecciones.create', $modulo) }}" class="btn-add-leccion">
                                    <i class="fas fa-plus"></i> Agregar lección
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div style="text-align:center;padding:1.5rem;color:var(--muted);font-size:.88rem;">
                        <i class="fas fa-layer-group" style="font-size:2rem;display:block;margin-bottom:.75rem;"></i>
                        Aún no hay módulos. Crea el primero abajo.
                    </div>
                @endforelse

                <div class="nuevo-modulo-form">
                    <form method="POST" action="{{ route('admin.modulos.store', $curso) }}">
                        @csrf
                        <label style="font-size:.82rem;font-weight:700;color:var(--paper);display:block;margin-bottom:.5rem;">
                            <i class="fas fa-plus-circle" style="color:var(--uv);"></i> Agregar nuevo módulo
                        </label>
                        <div style="display:flex;gap:.6rem;align-items:center;">
                            <input type="text" name="titulo" class="fi-sm" placeholder="Título del módulo" required>
                            <button type="submit" class="btn-add-modulo">
                                <i class="fas fa-plus"></i> Agregar
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <div>
        <div class="adm-card">
            <div class="adm-card-head">
                <h3 class="adm-card-title"><i class="fas fa-info-circle" style="color:var(--uv);"></i> Información</h3>
            </div>
            <div class="adm-card-body" style="padding:.75rem 1.25rem;">
                <div class="info-row">
                    <span class="info-label">Estado</span>
                    <span class="info-value" style="color:{{ $curso->activo ? 'var(--resolved)' : 'var(--alert)' }};">
                        {{ $curso->activo ? '● Activo' : '● Inactivo' }}
                    </span>
                </div>
                <div class="info-row">
                    <span class="info-label">Tipo</span>
                    <span class="info-value">{{ $curso->tipo === 'free' ? 'Gratuito' : 'De Pago' }}</span>
                </div>
                @if($curso->tipo === 'paid')
                    <div class="info-row">
                        <span class="info-label">Precio</span>
                        <span class="info-value">{{ $curso->precioFormateado() }}</span>
                    </div>
                @endif
                <div class="info-row">
                    <span class="info-label">Categoría</span>
                    <span class="info-value">{{ $curso->categoriaLabel() }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Duración</span>
                    <span class="info-value">{{ $curso->duracion_horas }} horas</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Módulos</span>
                    <span class="info-value">{{ $curso->modulos->count() }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Destacado</span>
                    <span class="info-value">{{ $curso->destacado ? 'Sí' : 'No' }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Creado</span>
                    <span class="info-value">{{ $curso->created_at->format('d/m/Y') }}</span>
                </div>
            </div>
        </div>

        @if($curso->descripcion)
            <div class="adm-card">
                <div class="adm-card-head">
                    <h3 class="adm-card-title"><i class="fas fa-align-left" style="color:var(--uv);"></i> Descripción</h3>
                </div>
                <div class="adm-card-body">
                    <p style="font-size:.86rem;color:var(--muted);line-height:1.6;margin:0;">{{ $curso->descripcion }}</p>
                </div>
            </div>
        @endif
    </div>

</div>

<script>
function toggleEditModulo(id) {
    const el = document.getElementById('edit-modulo-' + id);
    el.style.display = el.style.display === 'none' ? 'block' : 'none';
}
</script>
@endsection