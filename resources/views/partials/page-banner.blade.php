{{--
    Partial reutilizable: Banner de cabecera de página
    Uso: @include('partials.page-banner', ['titulo' => '...', 'descripcion' => '...'])
--}}
<section class="section" style="background: linear-gradient(135deg, var(--lab-deep), #14253a); padding: 3rem 1.5rem; border-bottom: 1px solid var(--line-soft);">
    <div class="container text-center">
        <h1 style="color: var(--paper); font-size: 2.5rem; margin-bottom: 1rem; font-weight: 800;">{{ $titulo }}</h1>
        @isset($descripcion)
            <p style="color: var(--muted); font-size: 1.1rem; max-width: 600px; margin: 0 auto;">
                {{ $descripcion }}
            </p>
        @endisset
    </div>
</section>
