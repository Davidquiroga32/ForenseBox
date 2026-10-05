@extends('layouts.dashboard')

@section('title', 'Mis Certificados')
@section('page-title', 'Mis Certificados')

@section('content')
<style>
.certs-header { margin-bottom: 1.5rem; }
.certs-header p { color: var(--muted); font-size: .9rem; margin: 0; }

.certs-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 1.25rem;
}

.cert-card {
    background: var(--panel); border-radius: 16px;
    border: 1px solid var(--line); overflow: hidden;
    transition: transform .22s, box-shadow .22s;
    display: flex; flex-direction: column;
}
.cert-card:hover { transform: translateY(-5px); box-shadow: 0 12px 36px rgba(0,0,0,.45); border-color: var(--tag); }

.cert-card-header {
    background: linear-gradient(135deg, #0A121B 0%, #15253a 100%);
    padding: 1.75rem 1.5rem 2rem;
    text-align: center; position: relative; overflow: hidden;
}
.cert-card-header::before {
    content: '';
    position: absolute; inset: 0;
    background-image: radial-gradient(rgba(242,179,61,.08) 1px, transparent 1px);
    background-size: 20px 20px;
}
.cert-card-header::after {
    content: '';
    position: absolute; bottom: -1px; left: 0; right: 0;
    height: 20px; background: var(--panel);
    border-radius: 50% 50% 0 0 / 100% 100% 0 0;
}
.cert-award-icon {
    position: relative; z-index: 1;
    width: 56px; height: 56px; border-radius: 50%;
    background: var(--tag-soft); border: 2px solid var(--tag-border);
    display: flex; align-items: center; justify-content: center;
    font-size: 1.5rem; color: var(--tag);
    margin: 0 auto .875rem;
}
.cert-card-label {
    position: relative; z-index: 1;
    font-family: var(--font-mono); font-size: .64rem; font-weight: 500;
    color: var(--muted); text-transform: uppercase; letter-spacing: .14em;
}

.cert-card-body { padding: 1.25rem 1.5rem 1.5rem; flex: 1; display: flex; flex-direction: column; }

.cert-curso-name {
    font-family: var(--font-sans); font-size: 1rem; font-weight: 800;
    color: var(--paper); margin-bottom: .4rem; line-height: 1.3; text-align: center;
}
.cert-fecha {
    font-size: .78rem; color: var(--muted);
    text-align: center; margin-bottom: 1.25rem;
    display: flex; align-items: center; justify-content: center; gap: .3rem;
}

.cert-code-wrap {
    background: var(--lab); border: 1px solid var(--line);
    border-radius: 9px; padding: .6rem .875rem;
    display: flex; align-items: center; justify-content: space-between;
    margin-bottom: 1rem;
}
.cert-code-label { font-family: var(--font-mono); font-size: .64rem; color: var(--muted); text-transform: uppercase; letter-spacing: .08em; }
.cert-code-value { font-family: var(--font-mono); font-size: .78rem; font-weight: 600; color: var(--tag); letter-spacing: 1px; }

.cert-actions { display: flex; gap: .6rem; margin-top: auto; }
.btn-descargar {
    flex: 1; display: flex; align-items: center; justify-content: center; gap: .4rem;
    padding: .65rem; background: var(--tag); color: #1A1203;
    border-radius: 10px; font-family: var(--font-sans);
    font-size: .84rem; font-weight: 600; text-decoration: none;
    box-shadow: 0 3px 12px rgba(242,179,61,.2); transition: all .2s;
}
.btn-descargar:hover { transform: translateY(-1px); box-shadow: 0 5px 18px rgba(242,179,61,.35); color: #1A1203; }

.btn-verificar {
    display: flex; align-items: center; justify-content: center; gap: .4rem;
    padding: .65rem .875rem; background: var(--lab);
    color: var(--uv); border: 1.5px solid var(--line); border-radius: 10px;
    font-family: var(--font-sans); font-size: .84rem; font-weight: 600;
    text-decoration: none; transition: all .18s;
}
.btn-verificar:hover { border-color: var(--uv); background: var(--uv-soft); }

.empty-state {
    background: var(--panel); border: 1px solid var(--line);
    border-radius: 16px; text-align: center; padding: 4rem 2rem;
}
.empty-icon {
    width: 88px; height: 88px; border-radius: 50%;
    background: var(--tag-soft); display: flex; align-items: center; justify-content: center;
    margin: 0 auto 1.25rem; font-size: 2.2rem; color: var(--tag);
}
.empty-state h3 { font-family: var(--font-sans); font-size: 1.15rem; font-weight: 800; color: var(--paper); margin-bottom: .5rem; }
.empty-state p { font-size: .9rem; color: var(--muted); max-width: 380px; margin: 0 auto 1.5rem; line-height: 1.6; }
.btn-primary {
    display: inline-flex; align-items: center; gap: .4rem;
    padding: .875rem 2rem; background: var(--tag); color: #1A1203;
    border-radius: 12px; font-family: var(--font-sans);
    font-size: 1rem; font-weight: 600; text-decoration: none;
    box-shadow: 0 4px 16px rgba(242,179,61,.25); transition: all .2s;
}
.btn-primary:hover { transform: translateY(-2px); box-shadow: 0 6px 24px rgba(242,179,61,.4); color: #1A1203; }

@media (max-width: 560px) { .certs-grid { grid-template-columns: 1fr; } }
</style>

<div class="certs-header">
    <p>Aquí aparecen los certificados de los cursos que hayas completado al 100%.</p>
</div>

@if($certificados->isEmpty())
    <div class="empty-state">
        <div class="empty-icon"><i class="fas fa-certificate"></i></div>
        <h3>Aún no tienes certificados</h3>
        <p>Completa un curso al 100% para recibir tu certificado de participación con QR de verificación.</p>
        <a href="{{ route('dashboard.cursos') }}" class="btn-primary">
            <i class="fas fa-book-open"></i> Ver mis cursos
        </a>
    </div>
@else
    <div class="certs-grid">
        @foreach($certificados as $curso)
            @php
                $certModel = \App\Models\Certificado::where('user_id', auth()->id())
                    ->where('curso_id', $curso->id)->first();
            @endphp
            <div class="cert-card">
                <div class="cert-card-header">
                    <div class="cert-award-icon"><i class="fas fa-award"></i></div>
                    <div class="cert-card-label">Certificado de Participación</div>
                </div>
                <div class="cert-card-body">
                    <div class="cert-curso-name">{{ $curso->titulo }}</div>
                    <div class="cert-fecha">
                        <i class="fas fa-calendar-check" style="color:var(--tag);"></i>
                        Completado el {{ $curso->pivot->updated_at?->format('d/m/Y') ?? 'N/A' }}
                    </div>

                    @if($certModel)
                        <div class="cert-code-wrap">
                            <span class="cert-code-label">Código</span>
                            <span class="cert-code-value">{{ $certModel->codigo }}</span>
                        </div>
                    @endif

                    <div class="cert-actions">
                        <a href="{{ route('certificado.descargar', $curso) }}" class="btn-descargar">
                            <i class="fas fa-download"></i> Descargar PDF
                        </a>
                        @if($certModel)
                            <a href="{{ route('certificado.verificar', $certModel->codigo) }}"
                                target="_blank" class="btn-verificar" title="Ver página de verificación">
                                <i class="fas fa-qrcode"></i>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif
@endsection
