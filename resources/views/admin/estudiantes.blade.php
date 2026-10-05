@extends('admin.layout')
@section('title','Estudiantes')
@section('page-title','Estudiantes')

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
    .est-init { width: 36px; height: 36px; border-radius: 50%; background: linear-gradient(135deg, var(--uv), #6a58e0); color: #fff; font-weight: 700; font-size: .88rem; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
    .badge { display: inline-flex; align-items: center; gap: .25rem; font-family: var(--font-mono); font-size: .68rem; font-weight: 500; padding: .2rem .65rem; border-radius: 999px; }
    .badge-student { background: var(--uv-soft); color: #c9bfff; }
    .badge-admin   { background: var(--tag-soft); color: var(--tag); }
    .paginator { padding: 1rem 1.25rem; display: flex; justify-content: center; }
    .empty-table { text-align: center; padding: 3rem 2rem; color: var(--muted); }
    .empty-table i { font-size: 2.5rem; display: block; margin-bottom: .75rem; color: var(--uv); }
    @media (max-width: 768px) { .hide-sm { display: none; } }
</style>

<div class="adm-toolbar">
    <div style="font-size:.9rem;color:var(--muted);">
        <strong style="color:var(--paper);">{{ $estudiantes->total() }}</strong> estudiantes registrados
    </div>
</div>

<div class="adm-table-wrap">
    @if($estudiantes->isEmpty())
        <div class="empty-table">
            <i class="fas fa-users"></i>
            <p>No hay estudiantes registrados aún.</p>
        </div>
    @else
        <table>
            <thead>
                <tr>
                    <th>Estudiante</th>
                    <th class="hide-sm">Rol</th>
                    <th class="hide-sm">Cursos</th>
                    <th class="hide-sm">Registrado</th>
                </tr>
            </thead>
            <tbody>
                @foreach($estudiantes as $est)
                    <tr>
                        <td>
                            <div style="display:flex;align-items:center;gap:.75rem;">
                                <div class="est-init">{{ strtoupper(substr($est->name,0,1)) }}</div>
                                <div>
                                    <div style="font-weight:600;color:var(--paper);">{{ $est->name }}</div>
                                    <div style="font-size:.75rem;color:var(--muted);">{{ $est->email }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="hide-sm">
                            <span class="badge {{ $est->role === 'admin' ? 'badge-admin' : 'badge-student' }}">
                                {{ $est->role === 'admin' ? 'Admin' : 'Estudiante' }}
                            </span>
                        </td>
                        <td class="hide-sm">
                            <strong>{{ $est->cursos_count }}</strong>
                        </td>
                        <td class="hide-sm">{{ $est->created_at->format('d/m/Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @if($estudiantes->hasPages())
            <div class="paginator">{{ $estudiantes->links() }}</div>
        @endif
    @endif
</div>
@endsection
