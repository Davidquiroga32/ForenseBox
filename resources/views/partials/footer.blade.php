<style>
.footer {
    background: var(--lab-deep);
    border-top: 1px solid var(--line-soft);
    padding: 4rem 1.5rem 1.5rem;
    font-family: var(--font-sans);
}
.footer-content {
    max-width: 1200px; margin: 0 auto;
    display: grid;
    grid-template-columns: 1.6fr 1fr 1fr 1.2fr;
    gap: 2.5rem;
    margin-bottom: 2.5rem;
}
.footer-section h4 {
    color: var(--paper);
    font-size: .9rem;
    font-weight: 800;
    letter-spacing: .02em;
    margin: 0 0 1rem;
}
.footer-section .fb-brand {
    font-size: 1.15rem; font-weight: 800; color: var(--paper);
    margin: 0 0 .6rem;
}
.footer-section .fb-brand b { color: var(--tag); }
.footer-section p {
    color: var(--muted);
    font-size: .9rem;
    line-height: 1.7;
    margin: 0;
}
.footer-links { list-style: none; margin: 0; padding: 0; }
.footer-links li { margin-bottom: .6rem; }
.footer-links a {
    color: var(--muted); text-decoration: none; font-size: .88rem;
    transition: color .16s;
}
.footer-links a:hover { color: var(--uv); }

.social-links { display: flex; gap: .6rem; margin-top: 1.25rem; }
.social-link {
    width: 38px; height: 38px;
    background: var(--panel);
    border: 1px solid var(--line);
    border-radius: 9px;
    display: flex; align-items: center; justify-content: center;
    color: var(--muted);
    transition: all .18s;
}
.social-link:hover { background: var(--uv); color: #fff; border-color: var(--uv); transform: translateY(-2px); }

.footer-section .contact-line {
    display: flex; align-items: flex-start; gap: .6rem;
    color: var(--muted); font-size: .88rem; margin-bottom: .65rem;
}
.footer-section .contact-line i { color: var(--tag); margin-top: .2rem; }

.footer-bottom {
    max-width: 1200px; margin: 0 auto;
    padding-top: 1.5rem;
    border-top: 1px solid var(--line-soft);
    display: flex; align-items: center; justify-content: space-between;
    gap: 1rem; flex-wrap: wrap;
    color: var(--muted); font-size: .82rem;
}
.footer-bottom p { margin: 0; color: var(--muted); }
.footer-bottom .fb-mono { color: var(--muted); }

@media (max-width: 900px) {
    .footer-content { grid-template-columns: 1fr 1fr; }
}
@media (max-width: 560px) {
    .footer-content { grid-template-columns: 1fr; }
}
</style>

<footer class="footer">
    <div class="footer-content">

        {{-- Columna 1: Descripción y redes --}}
        <div class="footer-section">
            <div class="fb-brand">Forense<b>Box</b></div>
            <p>
                Plataforma de aprendizaje en ciberseguridad, forensia digital y análisis de
                evidencia para formar a la próxima generación de profesionales.
            </p>
            <div class="social-links">
                <a href="#" class="social-link" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="social-link" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                <a href="#" class="social-link" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                <a href="#" class="social-link" aria-label="GitHub"><i class="fab fa-github"></i></a>
            </div>
        </div>

        {{-- Columna 2: Enlaces rápidos --}}
        <div class="footer-section">
            <h4>Enlaces Rápidos</h4>
            <ul class="footer-links">
                <li><a href="{{ route('inicio') }}">Inicio</a></li>
                <li><a href="{{ route('cursos.index') }}">Cursos</a></li>
                <li><a href="{{ route('contacto') }}">Contáctanos</a></li>
                <li><a href="{{ route('normatividad') }}">Normatividad</a></li>
            </ul>
        </div>

        {{-- Columna 3: Recursos --}}
        <div class="footer-section">
            <h4>Recursos</h4>
            <ul class="footer-links">
                <li><a href="#">Preguntas Frecuentes</a></li>
                <li><a href="#">Términos y Condiciones</a></li>
                <li><a href="#">Política de Privacidad</a></li>
                <li><a href="#">Centro de Ayuda</a></li>
            </ul>
        </div>

        {{-- Columna 4: Contacto --}}
        <div class="footer-section">
            <h4>Contacto</h4>
            <div class="contact-line"><i class="fas fa-envelope"></i> info@forensebox.com</div>
            <div class="contact-line"><i class="fas fa-phone"></i> +57 (1) 234 5678</div>
            <div class="contact-line"><i class="fas fa-map-marker-alt"></i> Bogotá, Colombia</div>
        </div>

    </div>

    <div class="footer-bottom">
        <p>&copy; {{ date('Y') }} ForenseBox. Todos los derechos reservados.</p>
        <span class="fb-mono mono">SEC:LAB · v1.0</span>
    </div>
</footer>
