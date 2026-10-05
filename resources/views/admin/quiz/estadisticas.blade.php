@extends('admin.layout')
@section('title','Estadísticas Quiz')
@section('page-title','Estadísticas del Quiz')

@section('content')
<style>
    .stat-grid{display:grid;grid-template-columns:repeat(5,1fr);gap:1rem;margin-bottom:1.5rem;}
    .stat-box{background:var(--panel);border:1px solid var(--line);border-radius:10px;padding:1.1rem;text-align:center;}
    .stat-num{font-family:var(--font-mono);font-size:1.6rem;font-weight:700;color:var(--paper);}
    .stat-label{font-size:.75rem;color:var(--muted);margin-top:.2rem;}
    .adm-table-wrap{background:var(--panel);border:1px solid var(--line);border-radius:12px;overflow:hidden;}
    table{width:100%;border-collapse:collapse;}
    thead{background:var(--lab-deep);}
    th{padding:.7rem 1rem;text-align:left;font-family:var(--font-mono);font-size:.66rem;font-weight:500;text-transform:uppercase;letter-spacing:.08em;color:var(--muted);border-bottom:1px solid var(--line-soft);}
    td{padding:.8rem 1rem;font-size:.85rem;color:var(--paper);border-bottom:1px solid var(--line-soft);}
    tr:last-child td{border-bottom:none;}
    tr:hover td{background:var(--panel-2);}
    .badge{display:inline-flex;align-items:center;gap:.25rem;font-family:var(--font-mono);font-size:.66rem;font-weight:500;padding:.2rem .65rem;border-radius:999px;}
    .badge-ok{background:var(--resolved-soft);color:var(--resolved);}
    .badge-err{background:var(--alert-soft);color:var(--alert);}
    .adm-back{display:inline-flex;align-items:center;gap:.4rem;font-size:.84rem;color:var(--uv);font-weight:600;text-decoration:none;margin-bottom:1.1rem;}
    .adm-back:hover{color:#b3a8ff;}
    @media(max-width:768px){.stat-grid{grid-template-columns:1fr 1fr;}}
</style>

<a href="{{ route('admin.quiz.edit',$quiz->leccion_id) }}" class="adm-back"><i class="fas fa-arrow-left"></i> Volver al editor</a>

<div class="stat-grid">
    <div class="stat-box"><div class="stat-num">{{ $stats['total_intentos'] }}</div><div class="stat-label">Total Intentos</div></div>
    <div class="stat-box"><div class="stat-num">{{ $stats['usuarios_unicos'] }}</div><div class="stat-label">Usuarios Únicos</div></div>
    <div class="stat-box"><div class="stat-num" style="color:var(--resolved);">{{ $stats['aprobados'] }}</div><div class="stat-label">Aprobaron</div></div>
    <div class="stat-box"><div class="stat-num">{{ $stats['promedio'] }}%</div><div class="stat-label">Promedio</div></div>
    <div class="stat-box"><div class="stat-num">{{ $stats['mejor_puntaje'] }}%</div><div class="stat-label">Mejor Puntaje</div></div>
</div>

<div class="adm-table-wrap">
    @if($intentos->isEmpty())
        <div style="text-align:center;padding:2.5rem;color:var(--muted);"><i class="fas fa-chart-bar" style="font-size:2.5rem;display:block;margin-bottom:.75rem;color:var(--uv);"></i><p>No hay intentos aún.</p></div>
    @else
    <table>
        <thead><tr><th>Estudiante</th><th>Puntaje</th><th>%</th><th>Estado</th><th>Fecha</th><th>Tiempo</th></tr></thead>
        <tbody>
            @foreach($intentos as $int)
            <tr>
                <td>
                    <div style="font-weight:600;color:var(--paper);">{{ $int->user->name }}</div>
                    <div style="font-size:.75rem;color:var(--muted);">{{ $int->user->email }}</div>
                </td>
                <td>{{ $int->puntaje }}/{{ $int->puntaje_total }}</td>
                <td><strong>{{ $int->porcentaje }}%</strong></td>
                <td><span class="badge {{ $int->aprobado?'badge-ok':'badge-err' }}">{{ $int->aprobado?'Aprobado':'No aprobado' }}</span></td>
                <td>{{ $int->finalizado_at?->format('d/m/Y H:i') ?? '—' }}</td>
                <td>{{ $int->tiempo_usado ? gmdate('i:s',$int->tiempo_usado) : '—' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>
@endsection
