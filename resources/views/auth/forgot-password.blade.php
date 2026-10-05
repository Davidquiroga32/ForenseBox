<x-guest-layout>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Chivo:wght@400;600;800&family=JetBrains+Mono:wght@400;500;600&display=swap');

    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    :root {
        --lab-deep: #0A121B; --lab: #0E1A24; --panel: #15252F; --panel-2: #1B2E3A;
        --line: #27404E; --line-soft: #1E333F; --paper: #E8EEF0; --muted: #9FB0B8;
        --tag: #F2B33D; --uv: #8E7BFF; --resolved: #3FBF9B; --alert: #F0606A;
    }

    .ca-page {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background: var(--lab);
        padding: 20px 16px;
        font-family: 'Chivo', sans-serif;
    }
    .ca-page::before {
        content: '';
        position: fixed; inset: 0;
        background-image:
            linear-gradient(rgba(142,123,255,.04) 1px, transparent 1px),
            linear-gradient(90deg, rgba(142,123,255,.04) 1px, transparent 1px);
        background-size: 48px 48px;
        mask-image: radial-gradient(ellipse 70% 70% at 50% 50%, black 30%, transparent 100%);
        pointer-events: none;
    }

    .ca-card {
        width: 100%;
        max-width: 400px;
        background: var(--panel);
        border: 1px solid var(--line);
        border-radius: 18px;
        overflow: hidden;
        box-shadow: 0 20px 60px rgba(0, 0, 0, .5);
        position: relative;
        z-index: 1;
    }

    .ca-header {
        background: linear-gradient(135deg, #0A121B 0%, #15253a 100%);
        padding: 24px 32px 20px;
        text-align: center;
        border-bottom: 2px solid var(--tag);
    }

    .ca-logo {
        height: 80px;
        width: auto;
        object-fit: contain;
        margin-bottom: 10px;
        display: block;
        margin-left: auto;
        margin-right: auto;
    }

    .ca-brand { font-family: 'Chivo', sans-serif; font-size: 18px; font-weight: 800; color: var(--paper); }
    .ca-tagline { font-family: 'JetBrains Mono', monospace; font-size: 10px; color: var(--muted); text-transform: uppercase; letter-spacing: 2px; margin-top: 3px; }

    .ca-body { padding: 28px 32px 24px; }

    .ca-icon {
        width: 54px; height: 54px;
        background: var(--uv-soft);
        border: 2px solid var(--uv-border);
        border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        margin: 0 auto 16px;
        font-size: 22px;
    }

    .ca-title { font-family: 'Chivo', sans-serif; font-size: 20px; font-weight: 800; color: var(--paper); text-align: center; margin-bottom: 6px; }
    .ca-desc { font-size: 13px; color: var(--muted); text-align: center; line-height: 1.6; margin-bottom: 22px; }

    .ca-status {
        background: var(--resolved-soft);
        border: 1px solid rgba(63,191,155,.35);
        border-radius: 8px;
        padding: 10px 14px;
        font-size: 13px;
        color: var(--resolved);
        margin-bottom: 18px;
        text-align: center;
    }

    .ca-label { display: block; font-size: 12px; font-weight: 600; color: var(--paper); margin-bottom: 5px; }
    .ca-input-wrap { position: relative; }
    .ca-input-icon { position: absolute; left: 12px; top: 50%; transform: translateY(-50%); font-size: 14px; pointer-events: none; }

    .ca-input {
        width: 100%;
        padding: 11px 12px 11px 38px;
        border: 1.5px solid var(--line);
        border-radius: 9px;
        font-size: 14px;
        color: var(--paper);
        background: var(--lab);
        transition: all 0.2s ease;
        outline: none;
        font-family: 'Chivo', sans-serif;
    }
    .ca-input:focus { border-color: var(--uv); background: var(--lab-deep); box-shadow: 0 0 0 3px rgba(142,123,255,.14); }
    .ca-input::placeholder { color: var(--muted); }
    .ca-error { font-size: 11px; color: var(--alert); margin-top: 4px; }

    .ca-btn {
        width: 100%;
        padding: 12px;
        background: var(--tag);
        color: #1A1203;
        border: none;
        border-radius: 9px;
        font-family: 'Chivo', sans-serif;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s ease;
        margin-top: 20px;
        letter-spacing: 0.2px;
        box-shadow: 0 6px 20px rgba(242,179,61,.25);
    }
    .ca-btn:hover { background: #ffc75c; box-shadow: 0 10px 28px rgba(242,179,61,.35); transform: translateY(-1px); }

    .ca-back { display: block; text-align: center; margin-top: 16px; font-size: 13px; color: var(--uv); text-decoration: none; font-weight: 600; transition: color 0.2s; }
    .ca-back:hover { color: var(--tag); }

    .ca-footer { background: var(--lab-deep); border-top: 1px solid var(--line-soft); padding: 12px 32px; text-align: center; font-size: 11px; color: var(--muted); }
</style>

<div class="ca-page">
    <div class="ca-card">

        <div class="ca-header">
            <img src="{{ asset('images/logo.png') }}" alt="ForenseBox" class="ca-logo"
                 onerror="this.style.display='none'">
            <div class="ca-brand">ForenseBox</div>
            <div class="ca-tagline">Digital Forensics</div>
        </div>

        <div class="ca-body">
            <div class="ca-icon">🔐</div>
            <h1 class="ca-title">Recuperar contraseña</h1>
            <p class="ca-desc">Ingresa tu correo y te enviaremos un enlace para restablecerla.</p>

            @if (session('status'))
                <div class="ca-status">
                    ✅ Te hemos enviado el enlace de recuperación. Revisa tu correo.
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <div>
                    <label for="email" class="ca-label">Correo electrónico</label>
                    <div class="ca-input-wrap">
                        <span class="ca-input-icon">✉️</span>
                        <input id="email" type="email" name="email" value="{{ old('email') }}"
                               required autofocus placeholder="ejemplo@correo.com" class="ca-input" />
                    </div>
                    @error('email')
                        <p class="ca-error">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="ca-btn">
                    📨 &nbsp; Enviar enlace de recuperación
                </button>
            </form>

            <a href="{{ route('login') }}" class="ca-back">← Volver al inicio de sesión</a>
        </div>

        <div class="ca-footer">© {{ date('Y') }} ForenseBox · Colombia</div>
    </div>
</div>
</x-guest-layout>
