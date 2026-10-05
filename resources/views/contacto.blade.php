@extends('layouts.app')
@section('title', 'Contáctanos - ForenseBox')

@section('content')

<style>
:root {
    --lab-deep:  #0A121B;
    --lab:       #0E1A24;
    --panel:     #15252F;
    --panel-2:   #1B2E3A;
    --line:      #27404E;
    --line-soft: #1E333F;
    --paper:     #E8EEF0;
    --muted:     #9FB0B8;
    --tag:       #F2B33D;
    --uv:        #8E7BFF;
    --resolved:  #3FBF9B;
    --alert:     #F0606A;
    --font-sans: 'Chivo', sans-serif;
    --font-mono: 'JetBrains Mono', monospace;
}

/* ══ HERO ══ */
.contacto-hero {
    position: relative;
    background: var(--lab-deep);
    padding: 5rem 1.5rem 4rem;
    overflow: hidden;
    margin-top: 68px;
    text-align: center;
}
.contacto-hero-bg { position: absolute; inset: 0; background: linear-gradient(135deg, #0A121B 0%, #101f2d 60%, #14283a 100%); }
.contacto-hero-dots {
    position: absolute; inset: 0;
    background-image:
        linear-gradient(rgba(142,123,255,.06) 1px, transparent 1px),
        linear-gradient(90deg, rgba(142,123,255,.06) 1px, transparent 1px);
    background-size: 40px 40px;
    mask-image: radial-gradient(ellipse 80% 80% at 50% 50%, black 40%, transparent 100%);
}
.contacto-hero-glow {
    position: absolute; width: 500px; height: 500px; border-radius: 50%;
    background: radial-gradient(rgba(142,123,255,.2), transparent 70%);
    top: -150px; right: -100px; pointer-events: none;
}
.contacto-hero-inner { position: relative; z-index: 2; max-width: 640px; margin: 0 auto; }
.contacto-hero-eyebrow {
    display: inline-flex; align-items: center; gap: .45rem;
    background: rgba(142,123,255,.12); border: 1px solid rgba(142,123,255,.35);
    color: #c9bfff; font-family: var(--font-mono);
    font-size: .7rem; font-weight: 500; text-transform: uppercase; letter-spacing: .14em;
    padding: .35rem 1rem; border-radius: 999px; margin-bottom: 1.25rem;
}
.contacto-hero h1 {
    font-family: var(--font-sans);
    font-size: clamp(2rem, 4vw, 3rem); font-weight: 800; color: var(--paper);
    margin: 0 0 1rem; line-height: 1.1; letter-spacing: -.02em;
}
.contacto-hero h1 span {
    background: linear-gradient(90deg, #F2B33D, #ffd98a);
    -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
}
.contacto-hero p { font-family: var(--font-sans); font-size: 1.05rem; color: var(--muted); line-height: 1.7; margin: 0; }

/* ══ BODY ══ */
.contacto-body { background: var(--lab); padding: 0 1.5rem 5rem; position: relative; }
.contacto-grid { max-width: 1100px; margin: 0 auto; display: grid; grid-template-columns: 400px 1fr; gap: 2rem; padding-top: 3rem; }

/* ══ COLUMNA IZQUIERDA ══ */
.info-card {
    background: linear-gradient(135deg, var(--lab-deep), #15253a);
    border: 1px solid var(--line);
    border-radius: 20px; padding: 2.25rem;
    color: var(--paper); position: relative; overflow: hidden;
    margin-bottom: 1.25rem;
}
.info-card::before {
    content: '';
    position: absolute; inset: 0;
    background-image: radial-gradient(rgba(142,123,255,.06) 1px, transparent 1px);
    background-size: 24px 24px;
}
.info-card-inner { position: relative; z-index: 1; }
.info-card h3 { font-family: var(--font-sans); font-size: 1.2rem; font-weight: 800; color: var(--paper); margin: 0 0 .5rem; }
.info-card > .info-card-inner > p { font-family: var(--font-sans); font-size: .88rem; color: var(--muted); margin: 0 0 2rem; line-height: 1.6; }

.contact-item { display: flex; align-items: flex-start; gap: 1rem; margin-bottom: 1.5rem; }
.contact-item:last-child { margin-bottom: 0; }
.contact-ico {
    width: 42px; height: 42px; border-radius: 12px;
    background: var(--uv-soft); border: 1px solid var(--uv-border);
    display: flex; align-items: center; justify-content: center;
    font-size: .95rem; color: #c9bfff; flex-shrink: 0;
}
.contact-item-label { font-family: var(--font-mono); font-size: .66rem; font-weight: 500; color: var(--muted); text-transform: uppercase; letter-spacing: .12em; margin-bottom: .25rem; }
.contact-item-value { font-family: var(--font-sans); font-size: .88rem; color: var(--paper); line-height: 1.5; }

.social-row { display: flex; gap: .6rem; margin-top: 2rem; padding-top: 1.5rem; border-top: 1px solid var(--line-soft); }
.social-btn {
    width: 38px; height: 38px; border-radius: 10px;
    background: var(--panel); border: 1px solid var(--line);
    display: flex; align-items: center; justify-content: center;
    color: var(--muted); font-size: .88rem;
    text-decoration: none; transition: all .18s;
}
.social-btn:hover { background: var(--uv); color: #fff; border-color: var(--uv); transform: translateY(-2px); }

/* Tarjeta horario */
.horario-card { background: var(--panel); border: 1px solid var(--line); border-radius: 16px; padding: 1.5rem; }
.horario-title {
    font-family: var(--font-mono); font-size: .68rem; font-weight: 500; color: var(--muted);
    text-transform: uppercase; letter-spacing: .12em;
    margin-bottom: 1rem; display: flex; align-items: center; gap: .4rem;
}
.horario-title i { color: var(--tag); }
.horario-row { display: flex; justify-content: space-between; align-items: center; padding: .5rem 0; border-bottom: 1px solid var(--line-soft); font-family: var(--font-sans); font-size: .85rem; }
.horario-row:last-child { border-bottom: none; }
.horario-dia { color: var(--paper); font-weight: 600; }
.horario-hora { color: var(--muted); }
.horario-badge {
    display: inline-flex; align-items: center; gap: .3rem;
    font-family: var(--font-mono); font-size: .66rem; font-weight: 500; color: var(--resolved);
    background: var(--resolved-soft); padding: .15rem .55rem; border-radius: 999px;
}
.horario-badge::before { content: ''; width: 6px; height: 6px; border-radius: 50%; background: var(--resolved); animation: pulse 2s infinite; }
@keyframes pulse { 0%,100% { opacity: 1; } 50% { opacity: .4; } }

/* ══ COLUMNA DERECHA — FORMULARIO ══ */
.form-card { background: var(--panel); border: 1px solid var(--line); border-radius: 20px; padding: 2.5rem; box-shadow: 0 8px 40px rgba(0,0,0,.4); }
.form-card-title { font-family: var(--font-sans); font-size: 1.5rem; font-weight: 800; color: var(--paper); margin: 0 0 .4rem; }
.form-card-subtitle { font-family: var(--font-sans); font-size: .9rem; color: var(--muted); margin: 0 0 2rem; line-height: 1.6; }

.form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }
.form-group { margin-bottom: 1.25rem; }
.form-label { display: block; font-family: var(--font-sans); font-size: .8rem; font-weight: 600; color: var(--paper); margin-bottom: .45rem; }
.form-label .req { color: var(--alert); margin-left: .2rem; }
.form-input {
    width: 100%; padding: .75rem 1rem;
    border: 1.5px solid var(--line); border-radius: 10px;
    font-family: var(--font-sans); font-size: .9rem; color: var(--paper);
    background: var(--lab); outline: none;
    transition: border-color .18s, box-shadow .18s, background .18s;
}
.form-input:focus { border-color: var(--uv); box-shadow: 0 0 0 3px rgba(142,123,255,.12); background: var(--lab-deep); }
.form-input::placeholder { color: var(--muted); }
textarea.form-input { resize: vertical; min-height: 130px; }

select.form-input {
    appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%239FB0B8' stroke-width='2'%3E%3Cpath d='M6 9l6 6 6-6'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 1rem center;
    cursor: pointer;
}
select.form-input option { background: var(--panel); color: var(--paper); }

.alert-success {
    display: flex; align-items: flex-start; gap: .75rem;
    background: var(--resolved-soft); border: 1px solid rgba(63,191,155,.35);
    border-radius: 10px; padding: 1rem 1.25rem;
    margin-bottom: 1.5rem;
    font-family: var(--font-sans); font-size: .88rem; color: var(--resolved);
}
.alert-error {
    display: flex; align-items: flex-start; gap: .75rem;
    background: var(--alert-soft); border: 1px solid rgba(240,96,106,.35);
    border-radius: 10px; padding: 1rem 1.25rem;
    margin-bottom: 1.5rem;
    font-family: var(--font-sans); font-size: .88rem; color: var(--alert);
}

.btn-submit {
    display: inline-flex; align-items: center; justify-content: center; gap: .5rem;
    width: 100%; padding: 1rem;
    background: var(--tag); color: #1A1203;
    border: none; border-radius: 12px;
    font-family: var(--font-sans); font-size: 1rem; font-weight: 600;
    cursor: pointer; transition: all .2s;
    box-shadow: 0 6px 22px rgba(242,179,61,.28);
    margin-top: .5rem;
}
.btn-submit:hover { transform: translateY(-2px); box-shadow: 0 10px 32px rgba(242,179,61,.4); }
.btn-submit:disabled { opacity: .7; cursor: not-allowed; transform: none; }
.btn-submit.loading::after {
    content: '';
    width: 16px; height: 16px; border-radius: 50%;
    border: 2px solid rgba(26,18,3,.3); border-top-color: #1A1203;
    animation: spin .7s linear infinite; margin-left: .5rem;
}
@keyframes spin { to { transform: rotate(360deg); } }

.privacy-note { display: flex; align-items: center; gap: .4rem; font-family: var(--font-sans); font-size: .75rem; color: var(--muted); margin-top: .75rem; justify-content: center; text-align: center; }
.privacy-note i { color: var(--uv); }

/* Responsive */
@media (max-width: 900px) {
    .contacto-grid { grid-template-columns: 1fr; }
    .form-row { grid-template-columns: 1fr; }
}
@media (max-width: 580px) {
    .form-card { padding: 1.5rem; }
}
</style>

{{-- ══ HERO ══ --}}
<section class="contacto-hero">
    <div class="contacto-hero-bg"></div>
    <div class="contacto-hero-dots"></div>
    <div class="contacto-hero-glow"></div>
    <div class="contacto-hero-inner">
        <div class="contacto-hero-eyebrow">
            <i class="fas fa-headset"></i> Atención al usuario
        </div>
        <h1>¿Cómo podemos <span>ayudarte?</span></h1>
        <p>Estamos aquí para acompañarte. Escríbenos y te responderemos en menos de 24 horas.</p>
    </div>
</section>

{{-- ══ BODY ══ --}}
<div class="contacto-body">
    <div class="contacto-grid">

        {{-- ── Columna izquierda ── --}}
        <div class="contact-info-col">

            <div class="info-card">
                <div class="info-card-inner">
                    <h3>Información de contacto</h3>
                    <p>Múltiples canales para comunicarnos contigo de la manera más cómoda.</p>

                    <div class="contact-item">
                        <div class="contact-ico"><i class="fas fa-envelope"></i></div>
                        <div class="contact-item-text">
                            <div class="contact-item-label">Email</div>
                            <div class="contact-item-value">
                                info@forensebox.com<br>soporte@forensebox.com
                            </div>
                        </div>
                    </div>

                    <div class="contact-item">
                        <div class="contact-ico"><i class="fab fa-whatsapp"></i></div>
                        <div class="contact-item-text">
                            <div class="contact-item-label">WhatsApp</div>
                            <div class="contact-item-value">+57 xxx xxx xxxx</div>
                        </div>
                    </div>

                    <div class="contact-item">
                        <div class="contact-ico"><i class="fas fa-phone"></i></div>
                        <div class="contact-item-text">
                            <div class="contact-item-label">Teléfono</div>
                            <div class="contact-item-value">+57 (x) xxx xxxx</div>
                        </div>
                    </div>

                    <div class="contact-item">
                        <div class="contact-ico"><i class="fas fa-map-marker-alt"></i></div>
                        <div class="contact-item-text">
                            <div class="contact-item-label">Oficina Principal</div>
                            <div class="contact-item-value">Calle 123 #45-67<br>Bogotá, Colombia</div>
                        </div>
                    </div>

                    <div class="social-row">
                        <a href="#" class="social-btn" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="social-btn" title="Instagram"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="social-btn" title="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#" class="social-btn" title="GitHub"><i class="fab fa-github"></i></a>
                        <a href="#" class="social-btn" title="WhatsApp"><i class="fab fa-whatsapp"></i></a>
                    </div>
                </div>
            </div>

            <div class="horario-card">
                <div class="horario-title">
                    <i class="fas fa-clock"></i> Horario de Atención
                    <span class="horario-badge" style="margin-left:auto;">Abierto</span>
                </div>
                <div class="horario-row">
                    <span class="horario-dia">Lunes – Viernes</span>
                    <span class="horario-hora">8:00 AM – 6:00 PM</span>
                </div>
                <div class="horario-row">
                    <span class="horario-dia">Sábados</span>
                    <span class="horario-hora">9:00 AM – 1:00 PM</span>
                </div>
                <div class="horario-row">
                    <span class="horario-dia">Domingos</span>
                    <span class="horario-hora" style="color:var(--alert);">Cerrado</span>
                </div>
            </div>

        </div>

        {{-- ── Formulario ── --}}
        <div>
            <div class="form-card">
                <h2 class="form-card-title">Envíanos un mensaje</h2>
                <p class="form-card-subtitle">Completa el formulario y uno de nuestros asesores se pondrá en contacto contigo.</p>

                @if(session('success'))
                    <div class="alert-success">
                        <i class="fas fa-check-circle" style="font-size:1.1rem;margin-top:.1rem;flex-shrink:0;"></i>
                        <div>{{ session('success') }}</div>
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert-error">
                        <i class="fas fa-exclamation-circle" style="font-size:1.1rem;margin-top:.1rem;flex-shrink:0;"></i>
                        <div>
                            <strong>Por favor corrige los siguientes errores:</strong>
                            @foreach($errors->all() as $error)
                                <p style="margin:.25rem 0 0;">{{ $error }}</p>
                            @endforeach
                        </div>
                    </div>
                @endif

                <form id="contactForm" onsubmit="handleContactForm(event)">
                    @csrf

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label" for="name">Nombre completo <span class="req">*</span></label>
                            <input type="text" class="form-input" id="name" name="name"
                                placeholder="Tu nombre completo" value="{{ old('name') }}" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="email">Correo electrónico <span class="req">*</span></label>
                            <input type="email" class="form-input" id="email" name="email"
                                placeholder="tu@email.com" value="{{ old('email') }}" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label" for="phone">Teléfono / WhatsApp</label>
                            <input type="tel" class="form-input" id="phone" name="phone"
                                placeholder="+57 300 123 4567" value="{{ old('phone') }}">
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="subject">Asunto <span class="req">*</span></label>
                            <select class="form-input" id="subject" name="subject" required>
                                <option value="">Selecciona un asunto</option>
                                <option value="informacion" {{ old('subject') == 'informacion' ? 'selected' : '' }}>Información sobre cursos</option>
                                <option value="asesoria"    {{ old('subject') == 'asesoria'    ? 'selected' : '' }}>Solicitar asesoría</option>
                                <option value="soporte"     {{ old('subject') == 'soporte'     ? 'selected' : '' }}>Soporte técnico</option>
                                <option value="alianzas"    {{ old('subject') == 'alianzas'    ? 'selected' : '' }}>Alianzas y convenios</option>
                                <option value="otro"        {{ old('subject') == 'otro'        ? 'selected' : '' }}>Otro</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="organization">Organización / Entidad</label>
                        <input type="text" class="form-input" id="organization" name="organization"
                            placeholder="Universidad, empresa, equipo, etc. (opcional)" value="{{ old('organization') }}">
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="message">Mensaje <span class="req">*</span></label>
                        <textarea class="form-input" id="message" name="message"
                            placeholder="Cuéntanos en qué podemos ayudarte..." required>{{ old('message') }}</textarea>
                    </div>

                    <button type="submit" class="btn-submit" id="submitBtn">
                        <i class="fas fa-paper-plane"></i> Enviar Mensaje
                    </button>

                    <div class="privacy-note">
                        <i class="fas fa-lock"></i>
                        Tu información está segura. No compartimos tus datos con terceros.
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>

@push('scripts')
<script>
function handleContactForm(event) {
    event.preventDefault();
    const form = event.target;
    const btn = document.getElementById('submitBtn');

    if (!form.name.value || !form.email.value || !form.subject.value || !form.message.value) {
        showToast('Por favor completa todos los campos requeridos.', 'error');
        return;
    }

    btn.classList.add('loading');
    btn.disabled = true;
    btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Enviando...';

    setTimeout(() => {
        showToast('¡Mensaje enviado! Te contactaremos pronto.', 'success');
        form.reset();
        btn.classList.remove('loading');
        btn.disabled = false;
        btn.innerHTML = '<i class="fas fa-paper-plane"></i> Enviar Mensaje';
    }, 1600);
}

function showToast(msg, type) {
    const existing = document.getElementById('toast-msg');
    if (existing) existing.remove();

    const toast = document.createElement('div');
    toast.id = 'toast-msg';
    toast.style.cssText = `
        position:fixed; bottom:2rem; right:2rem; z-index:9999;
        display:flex; align-items:center; gap:.75rem;
        padding:1rem 1.5rem; border-radius:12px;
        font-family:'Chivo',sans-serif; font-size:.9rem; font-weight:600;
        box-shadow:0 8px 32px rgba(0,0,0,.5);
        animation: slideInToast .3s ease;
        ${type === 'success'
            ? 'background:var(--resolved-soft); border:1px solid rgba(63,191,155,.4); color:#3FBF9B;'
            : 'background:var(--alert-soft); border:1px solid rgba(240,96,106,.4); color:#F0606A;'}
    `;
    toast.innerHTML = `<i class="fas ${type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle'}"></i> ${msg}`;
    document.body.appendChild(toast);

    const style = document.createElement('style');
    style.textContent = `@keyframes slideInToast { from { opacity:0; transform:translateY(12px); } to { opacity:1; transform:translateY(0); } }`;
    document.head.appendChild(style);

    setTimeout(() => toast.remove(), 4000);
}
</script>
@endpush

@endsection
