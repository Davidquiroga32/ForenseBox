<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<style>
    /* ══ FUENTES EMBEBIDAS DESDE EL SERVIDOR ══ */
    {!! $fontFaceCSS !!}
    * { -webkit-font-smoothing: antialiased; }

    @page {
        size: 297mm 210mm landscape;
        margin: 0;
    }

    * { margin: 0; padding: 0; box-sizing: border-box; }

    body {
        font-family: 'Poppins', Arial, Helvetica, sans-serif;
        background: #0A121B;
        width: 297mm;
        height: 210mm;
        overflow: hidden;
    }

    .cert {
        width: 297mm;
        height: 210mm;
        position: relative;
        background: linear-gradient(135deg, #0A121B 0%, #0E1A24 55%, #14202c 100%);
    }

    /* ── Fondo con patrón de rejilla de laboratorio ── */
    .cert-grid {
        position: absolute; inset: 0;
        background-image:
            linear-gradient(rgba(142,123,255,.05) 1px, transparent 1px),
            linear-gradient(90deg, rgba(142,123,255,.05) 1px, transparent 1px);
        background-size: 12mm 12mm;
        mask-image: radial-gradient(ellipse 80% 80% at 50% 50%, black 30%, transparent 100%);
    }

    .cert-glow {
        position: absolute;
        width: 160mm; height: 160mm; border-radius: 50%;
        background: radial-gradient(rgba(142,123,255,.10), transparent 70%);
        top: -60mm; right: -40mm;
    }
    .cert-glow.amber {
        background: radial-gradient(rgba(242,179,61,.08), transparent 70%);
        bottom: -60mm; left: -40mm; top: auto; right: auto;
    }

    /* ── Banda izquierda ── */
    .bg-left-band {
        position: absolute;
        top: 0; left: 0;
        width: 18mm; height: 100%;
        background: linear-gradient(180deg, #0A121B 0%, #14253a 50%, #0A121B 100%);
    }
    .bg-left-band::after {
        content: '';
        position: absolute;
        top: 0; right: 0;
        width: 3px; height: 100%;
        background: linear-gradient(180deg, #F2B33D 0%, #ffd98a 50%, #F2B33D 100%);
    }

    .band-text {
        position: absolute;
        top: 50%;
        left: 3mm;
        transform: translateY(-50%) rotate(-90deg);
        transform-origin: center center;
        font-family: 'Poppins', 'DejaVu Sans', Arial, sans-serif;
        font-size: 5.5pt;
        color: rgba(242,179,61,0.65);
        text-transform: uppercase;
        letter-spacing: 3px;
        white-space: nowrap;
        font-weight: 700;
    }

    .watermark {
        position: absolute;
        top: 50%; left: calc(18mm + 50%);
        transform: translate(-50%, -50%) rotate(-20deg);
        font-family: 'Poppins', 'DejaVu Sans', Arial, sans-serif;
        font-size: 50pt;
        font-weight: 700;
        color: rgba(142,123,255,0.05);
        text-transform: uppercase;
        letter-spacing: 6px;
        white-space: nowrap;
        pointer-events: none;
        z-index: 0;
    }

    .frame-outer {
        position: absolute;
        top: 5mm; left: 20mm; right: 5mm; bottom: 5mm;
        border: 2px solid rgba(242,179,61,0.7);
    }
    .frame-inner {
        position: absolute;
        top: 8mm; left: 23mm; right: 8mm; bottom: 8mm;
        border: 0.75px solid rgba(142,123,255,0.35);
    }

    .corner { position: absolute; width: 14mm; height: 14mm; }
    .corner::before { content: ''; position: absolute; width: 4px; height: 4px; background: #F2B33D; }
    .corner.tr { top:4mm; right:4mm;   border-top:2.5px solid #F2B33D; border-right:2.5px solid #F2B33D; }
    .corner.bl { bottom:4mm; left:20mm; border-bottom:2.5px solid #F2B33D; border-left:2.5px solid #F2B33D; }
    .corner.br { bottom:4mm; right:4mm; border-bottom:2.5px solid #F2B33D; border-right:2.5px solid #F2B33D; }
    .corner.tr::before { top:-2px; right:-2px; }
    .corner.bl::before { bottom:-2px; left:-2px; }
    .corner.br::before { bottom:-2px; right:-2px; }

    .corner-tl-top {
        position: absolute;
        top: 4mm; left: 20mm;
        width: 14mm; height: 14mm;
        border-top: 2.5px solid #F2B33D;
        border-left: 2.5px solid #F2B33D;
    }
    .corner-tl-top::before {
        content: '';
        position: absolute;
        top: -2px; left: -2px;
        width: 4px; height: 4px;
        background: #F2B33D;
    }

    /* ── Header ── */
    .header {
        position: absolute;
        top: 10mm; left: 21mm; right: 12mm;
        height: 26mm;
        background: linear-gradient(108deg, #0A121B 0%, #14253a 60%, #152b42 100%);
        border: 1px solid rgba(142,123,255,0.2);
        display: flex;
        align-items: center;
        padding: 0 8mm;
        gap: 6mm;
        overflow: hidden;
    }
    .header::after {
        content: '';
        position: absolute;
        left: 0; top: 0; bottom: 0;
        width: 4px;
        background: linear-gradient(180deg, transparent, #F2B33D 25%, #F2B33D 75%, transparent);
    }

    .header-logo {
        height: 18mm; width: auto;
        flex-shrink: 0;
        position: relative; z-index: 1;
    }
    .header-divider {
        width: 1px; height: 14mm;
        background: linear-gradient(180deg, transparent, rgba(242,179,61,0.6), transparent);
        flex-shrink: 0;
        position: relative; z-index: 1;
    }
    .header-text { flex: 1; position: relative; z-index: 1; }
    .header-eyebrow {
        font-family: 'Poppins', 'DejaVu Sans', Arial, sans-serif;
        font-size: 5.5pt;
        color: #F2B33D;
        text-transform: uppercase;
        letter-spacing: 3px;
        font-weight: 700;
        margin-bottom: 2mm;
    }
    .header-title {
        font-family: 'Poppins', 'DejaVu Sans', Arial, sans-serif;
        font-size: 22pt;
        font-weight: 700;
        color: #E8EEF0;
        letter-spacing: 3px;
        line-height: 1;
        margin-bottom: 2mm;
    }
    .header-subtitle {
        font-family: 'Poppins', 'DejaVu Sans', Arial, sans-serif;
        font-size: 6.5pt;
        color: #9FB0B8;
        text-transform: uppercase;
        letter-spacing: 2px;
        font-weight: 400;
    }
    .header-seal {
        flex-shrink: 0;
        width: 18mm; height: 18mm;
        border-radius: 50%;
        border: 1.5px solid rgba(242,179,61,0.4);
        background: rgba(242,179,61,0.08);
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative; z-index: 1;
        flex-direction: column;
        gap: 1px;
    }
    .header-seal-star {
        font-family: 'DejaVu Sans', Arial, sans-serif;
        font-size: 14pt;
        color: #F2B33D;
        line-height: 1;
    }
    .header-seal-text {
        font-family: 'Poppins', 'DejaVu Sans', Arial, sans-serif;
        font-size: 4pt;
        color: rgba(242,179,61,0.7);
        text-transform: uppercase;
        letter-spacing: 1px;
        font-weight: 700;
    }

    .deco-line { position: absolute; left: 24mm; right: 13mm; height: 1px; }
    .deco-line.top    { top: 39mm; background: linear-gradient(90deg, #F2B33D, rgba(242,179,61,0.2) 80%, transparent); }
    .deco-line.bottom { bottom: 28mm; background: linear-gradient(90deg, #F2B33D, rgba(242,179,61,0.2) 80%, transparent); }

    .content-area {
        position: absolute;
        top: 39mm; left: 21mm; right: 12mm;
        bottom: 28mm;
        display: flex;
        align-items: stretch;
        gap: 0;
    }

    .col-main {
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: center;
        padding: 4mm 6mm 4mm 4mm;
        border-right: 1px solid rgba(242,179,61,0.2);
    }

    .se-certifica {
        font-family: 'Poppins', 'DejaVu Sans', Arial, sans-serif;
        font-size: 6pt;
        color: #9FB0B8;
        text-transform: uppercase;
        letter-spacing: 4px;
        font-weight: 700;
        margin-bottom: 2mm;
    }

    .nombre {
        font-family: 'Poppins', 'DejaVu Sans', Arial, sans-serif;
        font-size: 26pt;
        font-weight: 700;
        color: #E8EEF0;
        line-height: 1.1;
        margin-bottom: 1mm;
    }

    .nombre-underline {
        width: 40mm; height: 2px;
        background: linear-gradient(90deg, #F2B33D, transparent);
        margin-bottom: 3mm;
    }

    .por-haber {
        font-family: 'Poppins', 'DejaVu Sans', Arial, sans-serif;
        font-size: 8.5pt;
        font-style: italic;
        color: #9FB0B8;
        margin-bottom: 3mm;
        line-height: 1.4;
    }

    .curso-wrap { display: flex; align-items: stretch; margin-bottom: 3mm; }
    .curso-bar  { width: 3px; background: linear-gradient(180deg, #F2B33D, #ffd98a); flex-shrink: 0; }
    .curso-content {
        background: linear-gradient(108deg, #14103a 0%, #1c1750 100%);
        border: 1px solid rgba(142,123,255,0.2);
        padding: 2mm 6mm; flex: 1;
    }
    .curso-label {
        font-family: 'Poppins', 'DejaVu Sans', Arial, sans-serif;
        font-size: 5pt;
        color: rgba(242,179,61,0.85);
        text-transform: uppercase;
        letter-spacing: 2px;
        font-weight: 700;
        margin-bottom: 1mm;
    }
    .curso-titulo {
        font-family: 'Poppins', 'DejaVu Sans', Arial, sans-serif;
        font-size: 13pt;
        font-weight: 700;
        color: #E8EEF0;
        letter-spacing: 0.3px;
        line-height: 1.2;
    }

    .curso-meta { display: flex; gap: 3mm; flex-wrap: wrap; }
    .meta-pill {
        display: flex; align-items: center; gap: 1.5mm;
        background: rgba(142,123,255,0.08);
        border: 0.75px solid rgba(142,123,255,0.25);
        border-radius: 100px;
        padding: 1mm 3mm;
    }
    .meta-pill-dot { width: 2.5mm; height: 2.5mm; border-radius: 50%; background: #F2B33D; flex-shrink: 0; }
    .meta-pill-text  { font-family: 'Poppins', 'DejaVu Sans', Arial, sans-serif; font-size: 6pt; color: #9FB0B8; font-weight: 600; }
    .meta-pill-value { font-family: 'Poppins', 'DejaVu Sans', Arial, sans-serif; font-size: 6pt; color: #E8EEF0; font-weight: 700; }

    .descripcion {
        font-family: 'Poppins', 'DejaVu Sans', Arial, sans-serif;
        font-size: 6pt;
        color: #9FB0B8;
        line-height: 1.7;
        margin-top: 3mm;
        padding-top: 3mm;
        border-top: 0.75px solid rgba(242,179,61,0.2);
    }

    .col-side {
        width: 52mm;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        padding: 4mm 4mm 4mm 6mm;
    }

    .firma-block { display: flex; flex-direction: column; align-items: center; }
    .firma-img   { height: 14mm; width: auto; max-width: 42mm; display: block; margin-bottom: 2mm; }
    .firma-placeholder { height: 14mm; }
    .firma-line-under { width: 40mm; height: 1px; background-color: #9FB0B8; margin-bottom: 2mm; }
    .firma-nombre {
        font-family: 'Poppins', 'DejaVu Sans', Arial, sans-serif;
        font-size: 8pt; font-weight: 700; color: #E8EEF0;
        margin-bottom: 1mm; text-align: center;
    }
    .firma-cargo {
        font-family: 'Poppins', 'DejaVu Sans', Arial, sans-serif;
        font-size: 5.5pt;
        color: #F2B33D;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        font-weight: 700;
        text-align: center;
    }

    .verify-block {
        background: rgba(142,123,255,0.06);
        border: 1px solid rgba(242,179,61,0.25);
        padding: 3mm;
        display: flex; flex-direction: column; align-items: center; gap: 2mm;
    }
    .verify-top   { display: flex; align-items: center; gap: 3mm; width: 100%; }
    .qr-wrap      { border: 1px solid rgba(242,179,61,0.5); padding: 1.5mm; background: #ffffff; flex-shrink: 0; }
    .qr-img       { width: 18mm; height: 18mm; display: block; }
    .verify-info  { flex: 1; }
    .verify-label {
        font-family: 'Poppins', 'DejaVu Sans', Arial, sans-serif;
        font-size: 5pt; color: #9FB0B8;
        text-transform: uppercase; letter-spacing: 1px; font-weight: 700; margin-bottom: 1.5mm;
    }
    .verify-fecha {
        font-family: 'Poppins', 'DejaVu Sans', Arial, sans-serif;
        font-size: 6.5pt; color: #E8EEF0; font-weight: 600; margin-bottom: 1.5mm; line-height: 1.4;
    }
    .verify-code {
        font-family: 'DejaVu Sans', 'Poppins', Arial, sans-serif;
        font-size: 6.5pt; color: #8E7BFF; font-weight: 700;
        letter-spacing: 1.5px; text-transform: uppercase;
        background: rgba(142,123,255,0.1); padding: 1mm 2mm; display: inline-block;
    }
    .verify-bottom {
        font-family: 'Poppins', 'DejaVu Sans', Arial, sans-serif;
        font-size: 5pt; color: #9FB0B8;
        text-align: center; text-transform: uppercase; letter-spacing: 1px;
    }
</style>
</head>
<body>
<div class="cert">

    <div class="cert-grid"></div>
    <div class="cert-glow"></div>
    <div class="cert-glow amber"></div>

    <div class="bg-left-band"></div>
    <div class="band-text">ForenseBox &middot; Ciberseguridad</div>

    <div class="watermark">ForenseBox</div>

    <div class="frame-outer"></div>
    <div class="frame-inner"></div>
    <div class="corner-tl-top"></div>
    <div class="corner tr"></div>
    <div class="corner bl"></div>
    <div class="corner br"></div>

    <div class="deco-line top"></div>
    <div class="deco-line bottom"></div>

    <!-- Header -->
    <div class="header">
        @if($logoBase64)
            <img src="{{ $logoBase64 }}" class="header-logo" alt="Logo">
        @endif
        <div class="header-divider"></div>
        <div class="header-text">
            <div class="header-eyebrow">ForenseBox &nbsp;&middot;&nbsp; Digital Forensics</div>
            <div class="header-title">Certificado</div>
            <div class="header-subtitle">de Participaci&oacute;n en Ciberseguridad y Forensia Digital</div>
        </div>
        <div class="header-seal">
            <div class="header-seal-star">&#9733;</div>
            <div class="header-seal-text">Oficial</div>
        </div>
    </div>

    <!-- Contenido principal en dos columnas -->
    <div class="content-area">

        <!-- Columna izquierda -->
        <div class="col-main">
            <div class="se-certifica">Se certifica que</div>

            <div class="nombre">{{ $user->name }}</div>
            <div class="nombre-underline"></div>

            <div class="por-haber">ha completado satisfactoriamente el programa de formaci&oacute;n</div>

            <div class="curso-wrap">
                <div class="curso-bar"></div>
                <div class="curso-content">
                    <div class="curso-label">Programa de formaci&oacute;n</div>
                    <div class="curso-titulo">{{ $curso->titulo }}</div>
                </div>
            </div>

            <div class="curso-meta">
                <div class="meta-pill">
                    <div class="meta-pill-dot"></div>
                    <span class="meta-pill-text">Duraci&oacute;n:</span>
                    <span class="meta-pill-value">{{ $curso->duracion_horas }} horas</span>
                </div>
                <div class="meta-pill">
                    <div class="meta-pill-dot"></div>
                    <span class="meta-pill-text">Categor&iacute;a:</span>
                    <span class="meta-pill-value">{{ $curso->categoriaLabel() }}</span>
                </div>
            </div>

            <div class="descripcion">
                {{ $curso->descripcion_corta ?? 'Programa de formaci&oacute;n especializado en ciberseguridad y forensia digital.' }}
            </div>
        </div>

        <!-- Columna derecha -->
        <div class="col-side">

            <!-- Firma -->
            <div class="firma-block">
                @if($firmaBase64)
                    <img src="{{ $firmaBase64 }}" class="firma-img" alt="Firma">
                @else
                    <div class="firma-placeholder"></div>
                @endif
                <div class="firma-line-under"></div>
                <div class="firma-nombre">Direcci&oacute;n Acad&eacute;mica</div>
                <div class="firma-cargo">ForenseBox &middot; Ciberseguridad</div>
            </div>

            <!-- Verificación -->
            <div class="verify-block">
                <div class="verify-top">
                    <div class="qr-wrap">
                        <img src="data:image/svg+xml;base64,{{ $qrBase64 }}" class="qr-img" alt="QR">
                    </div>
                    <div class="verify-info">
                        <div class="verify-label">Expedici&oacute;n</div>
                        <div class="verify-fecha">
                            {{ $certificado->fecha_emision->locale('es')->isoFormat('D [de] MMMM [de] YYYY') }}
                        </div>
                        <div class="verify-label" style="margin-top:1.5mm;">C&oacute;digo</div>
                        <div class="verify-code">{{ $certificado->codigo }}</div>
                    </div>
                </div>
                <div class="verify-bottom">Escanea para verificar autenticidad</div>
            </div>

        </div>
    </div>

</div>
</body>
</html>
