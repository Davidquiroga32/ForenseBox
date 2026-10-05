<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificación de Certificado · ForenseBox</title>
    <link href="https://fonts.googleapis.com/css2?family=Chivo:wght@400;600;800&family=JetBrains+Mono:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --lab:      #0E1A24;
            --lab-deep: #0A121B;
            --panel:    #15252F;
            --line:     #27404E;
            --line-soft:#1E333F;
            --paper:    #E8EEF0;
            --muted:    #9FB0B8;
            --tag:      #F2B33D;
            --uv:       #8E7BFF;
            --resolved: #3FBF9B;
            --font-sans: 'Chivo', sans-serif;
            --font-mono: 'JetBrains Mono', monospace;
        }

        body {
            font-family: var(--font-sans);
            background: var(--lab);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            color: var(--paper);
        }

        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background:
                radial-gradient(ellipse 70% 50% at 15% 10%, rgba(142,123,255,0.08) 0%, transparent 70%),
                radial-gradient(ellipse 60% 40% at 85% 90%, rgba(242,179,61,0.05) 0%, transparent 70%);
            pointer-events: none;
            z-index: 0;
        }

        /* Header */
        .vf-header {
            position: relative;
            z-index: 10;
            background: var(--lab-deep);
            padding: 1rem 2rem;
            display: flex;
            align-items: center;
            gap: 1.25rem;
            border-bottom: 2px solid var(--tag);
            box-shadow: 0 4px 32px rgba(0,0,0,0.5);
        }
        .vf-header-logo { height: 46px; width: auto; }
        .vf-header-divider {
            width: 1px; height: 36px;
            background: linear-gradient(180deg, transparent, rgba(242,179,61,0.5), transparent);
        }
        .vf-header-text h1 {
            font-family: var(--font-sans);
            font-size: 1.05rem;
            font-weight: 800;
            color: var(--paper);
            letter-spacing: 0.02em;
        }
        .vf-header-text p {
            font-family: var(--font-mono);
            font-size: 0.66rem;
            color: var(--muted);
            letter-spacing: 0.1em;
            text-transform: uppercase;
            margin-top: 0.15rem;
        }
        .vf-header-badge {
            margin-left: auto;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            background: var(--tag-soft, rgba(242,179,61,0.12));
            border: 1px solid rgba(242,179,61,0.3);
            border-radius: 100px;
            padding: 0.35rem 0.85rem;
            font-family: var(--font-mono);
            font-size: 0.68rem;
            color: var(--tag);
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.08em;
        }

        /* Main */
        .vf-main {
            position: relative;
            z-index: 1;
            flex: 1;
            display: flex;
            align-items: flex-start;
            justify-content: center;
            padding: 3rem 1rem 2rem;
        }
        .vf-container {
            max-width: 700px;
            width: 100%;
        }

        /* Hero */
        .vf-hero {
            background: linear-gradient(135deg, #0b3a2e 0%, #1d7a5c 50%, #2e9f83 100%);
            border-radius: 20px 20px 0 0;
            padding: 2.5rem 2rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        .vf-hero::before {
            content: '';
            position: absolute;
            inset: 0;
            background-image: radial-gradient(rgba(255,255,255,0.07) 1px, transparent 1px);
            background-size: 20px 20px;
        }
        .vf-hero-icon {
            position: relative; z-index: 1;
            width: 80px; height: 80px;
            margin: 0 auto 1.25rem;
            background: rgba(255,255,255,0.15);
            border: 2px solid rgba(255,255,255,0.3);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 2.25rem; color: #fff;
            box-shadow: 0 0 0 8px rgba(255,255,255,0.07);
        }
        .vf-hero-title {
            position: relative; z-index: 1;
            font-family: var(--font-sans);
            font-size: 1.7rem;
            font-weight: 800;
            color: #fff;
            margin-bottom: 0.5rem;
        }
        .vf-hero-sub {
            position: relative; z-index: 1;
            font-size: 0.88rem;
            color: rgba(255,255,255,0.85);
            max-width: 420px;
            margin: 0 auto;
            line-height: 1.6;
        }

        /* Card */
        .vf-card {
            background: var(--panel);
            border: 1px solid var(--line);
            border-top: none;
            border-radius: 0 0 20px 20px;
            box-shadow: 0 12px 50px rgba(0,0,0,0.4);
        }
        .vf-card-inner { padding: 2rem 2rem 1.75rem; }

        /* Sello */
        .vf-sello {
            display: flex;
            align-items: center;
            gap: 1rem;
            background: var(--uv-soft, rgba(142,123,255,0.12));
            border: 1px solid rgba(142,123,255,0.35);
            border-left: 3px solid var(--uv);
            border-radius: 12px;
            padding: 1rem 1.25rem;
            margin-bottom: 1.75rem;
        }
        .vf-sello-icon {
            flex-shrink: 0;
            width: 44px; height: 44px;
            border-radius: 10px;
            background: linear-gradient(135deg, var(--uv), #6a58e0);
            color: #fff;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.1rem;
        }
        .vf-sello-text h4 {
            font-family: var(--font-sans);
            font-size: 0.88rem;
            font-weight: 800;
            color: var(--paper);
            margin-bottom: 0.2rem;
        }
        .vf-sello-text p {
            font-size: 0.78rem;
            color: var(--muted);
            line-height: 1.5;
        }

        /* Section label */
        .vf-section-label {
            font-family: var(--font-mono);
            font-size: 0.66rem;
            font-weight: 500;
            color: var(--muted);
            text-transform: uppercase;
            letter-spacing: 0.12em;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.4rem;
        }
        .vf-section-label::after {
            content: '';
            flex: 1;
            height: 1px;
            background: var(--line-soft);
        }

        /* Grid */
        .vf-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0.875rem;
            margin-bottom: 1.75rem;
        }
        .vf-info-item {
            background: var(--lab-deep);
            border: 1px solid var(--line);
            border-radius: 12px;
            padding: 1rem 1.1rem;
            position: relative;
            overflow: hidden;
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        .vf-info-item::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 2px;
            background: linear-gradient(90deg, var(--uv), transparent);
            opacity: 0;
            transition: opacity 0.2s;
        }
        .vf-info-item:hover { border-color: var(--uv); }
        .vf-info-item:hover::before { opacity: 1; }
        .vf-info-item.highlight {
            background: var(--uv-soft, rgba(142,123,255,0.12));
            border-color: rgba(142,123,255,0.35);
        }
        .vf-info-item.highlight::before { opacity: 1; }

        .vf-label {
            font-family: var(--font-mono);
            font-size: 0.64rem;
            font-weight: 500;
            color: var(--muted);
            text-transform: uppercase;
            letter-spacing: 0.1em;
            margin-bottom: 0.35rem;
            display: flex;
            align-items: center;
            gap: 0.3rem;
        }
        .vf-label i { font-size: 0.6rem; color: var(--tag); }
        .vf-value {
            font-family: var(--font-sans);
            font-size: 0.95rem;
            font-weight: 700;
            color: var(--paper);
            line-height: 1.3;
        }
        .vf-value.large { font-size: 1.1rem; }
        .vf-value.code {
            font-family: var(--font-mono);
            font-size: 0.88rem;
            color: var(--uv);
            letter-spacing: 2px;
            background: var(--uv-soft, rgba(142,123,255,0.12));
            display: inline-block;
            padding: 0.15rem 0.4rem;
            border-radius: 4px;
            border: 1px solid rgba(142,123,255,0.2);
        }

        .vf-divider { height: 1px; background: var(--line-soft); margin: 1.5rem 0; }

        /* Botones */
        .vf-actions { display: flex; gap: 0.75rem; flex-wrap: wrap; }
        .btn-primary {
            display: inline-flex; align-items: center; gap: 0.45rem;
            padding: 0.7rem 1.35rem;
            background: var(--tag); color: #1A1203;
            border-radius: 10px;
            font-family: var(--font-sans);
            font-size: 0.875rem;
            font-weight: 600;
            text-decoration: none;
            box-shadow: 0 4px 16px rgba(242,179,61,0.25);
            transition: all 0.2s;
        }
        .btn-primary:hover {
            background: #ffc75c; color: #1A1203;
            transform: translateY(-1px);
        }
        .btn-ghost {
            display: inline-flex; align-items: center; gap: 0.45rem;
            padding: 0.7rem 1.35rem;
            background: var(--panel); color: var(--paper);
            border: 1.5px solid var(--line);
            border-radius: 10px;
            font-family: var(--font-sans);
            font-size: 0.875rem;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.2s;
        }
        .btn-ghost:hover {
            border-color: var(--uv); color: var(--uv);
            background: var(--uv-soft, rgba(142,123,255,0.12));
            transform: translateY(-1px);
        }

        /* Footer */
        .vf-footer {
            background: var(--lab-deep);
            border-top: 1px solid var(--line-soft);
            padding: 1rem 2rem;
            text-align: center;
            font-size: 0.72rem;
            color: var(--muted);
            position: relative;
        }
        .vf-footer strong { color: var(--muted); }

        @media (max-width: 600px) {
            .vf-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>

<header class="vf-header">
    <img src="{{ asset('images/logo.png') }}" class="vf-header-logo" alt="ForenseBox"
         onerror="this.style.display='none'">
    <div class="vf-header-divider"></div>
    <div class="vf-header-text">
        <h1>ForenseBox</h1>
        <p>Sistema de Verificación de Certificados</p>
    </div>
    <div class="vf-header-badge">
        <i class="fas fa-shield-alt"></i>
        Verificación Oficial
    </div>
</header>

<main class="vf-main">
    <div class="vf-container">

        <div class="vf-hero">
            <div class="vf-hero-icon">
                <i class="fas fa-certificate"></i>
            </div>
            <div class="vf-hero-title">Certificado Auténtico y Válido</div>
            <div class="vf-hero-sub">
                Este certificado ha sido verificado exitosamente en los registros oficiales de ForenseBox
            </div>
        </div>

        <div class="vf-card">
            <div class="vf-card-inner">

                <div class="vf-sello">
                    <div class="vf-sello-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <div class="vf-sello-text">
                        <h4>Verificación Oficial · ForenseBox</h4>
                        <p>Este documento es emitido y respaldado por ForenseBox, plataforma de formación en ciberseguridad y forensia digital.</p>
                    </div>
                </div>

                <div class="vf-section-label">
                    <i class="fas fa-id-card"></i>
                    Información del Certificado
                </div>

                <div class="vf-grid">
                    <div class="vf-info-item highlight">
                        <div class="vf-label"><i class="fas fa-user"></i> Participante</div>
                        <div class="vf-value large">{{ $certificado->user->name }}</div>
                    </div>
                    <div class="vf-info-item">
                        <div class="vf-label"><i class="fas fa-book-open"></i> Curso Completado</div>
                        <div class="vf-value">{{ $certificado->curso->titulo }}</div>
                    </div>
                    <div class="vf-info-item">
                        <div class="vf-label"><i class="fas fa-calendar"></i> Fecha de Expedición</div>
                        <div class="vf-value">
                            {{ $certificado->fecha_emision->locale('es')->isoFormat('D [de] MMMM [de] YYYY') }}
                        </div>
                    </div>
                    <div class="vf-info-item">
                        <div class="vf-label"><i class="fas fa-clock"></i> Duración</div>
                        <div class="vf-value">{{ $certificado->curso->duracion_horas }} horas académicas</div>
                    </div>
                    <div class="vf-info-item">
                        <div class="vf-label"><i class="fas fa-tag"></i> Categoría</div>
                        <div class="vf-value">{{ $certificado->curso->categoriaLabel() }}</div>
                    </div>
                    <div class="vf-info-item">
                        <div class="vf-label"><i class="fas fa-fingerprint"></i> Código de Verificación</div>
                        <div class="vf-value code">{{ $certificado->codigo }}</div>
                    </div>
                </div>

                <div class="vf-divider"></div>

                <div class="vf-actions">
                    <a href="{{ route('inicio') }}" class="btn-primary">
                        <i class="fas fa-home"></i> Ir a ForenseBox
                    </a>
                    <a href="{{ route('cursos.index') }}" class="btn-ghost">
                        <i class="fas fa-book-open"></i> Ver Cursos
                    </a>
                </div>

            </div>
        </div>

    </div>
</main>

<footer class="vf-footer">
    © {{ date('Y') }} <strong>ForenseBox</strong> · Sistema de verificación de certificados · Colombia
</footer>

</body>
</html>
