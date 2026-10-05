{{-- resources/views/admin/cursos/form.blade.php --}}
{{-- Partial compartido por create y edit --}}

<style>
    .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 1.1rem; }
    .form-full  { grid-column: 1 / -1; }
    .adm-form-card { background: var(--panel); border: 1px solid var(--line); border-radius: 12px; padding: 1.5rem; margin-bottom: 1.25rem; }
    .adm-form-section { font-family: var(--font-mono); font-size: .7rem; font-weight: 500; color: var(--tag); text-transform: uppercase; letter-spacing: .12em; margin-bottom: 1rem; padding-bottom: .5rem; border-bottom: 1px solid var(--line-soft); display: flex; align-items: center; gap: .4rem; }

    .fg { margin-bottom: .1rem; }
    .fg label { display: block; font-size: .83rem; font-weight: 600; color: var(--paper); margin-bottom: .35rem; }
    .fg label .req { color: var(--alert); }
    .fi {
        width: 100%; padding: .65rem .9rem;
        border: 1.5px solid var(--line); border-radius: 8px;
        font-size: .88rem; color: var(--paper); background: var(--lab);
        transition: border-color .16s, box-shadow .16s; outline: none; font-family: inherit;
    }
    .fi:focus { border-color: var(--uv); box-shadow: 0 0 0 3px rgba(142,123,255,.14); }
    .fi.error { border-color: var(--alert); }
    textarea.fi { resize: vertical; min-height: 90px; }
    select.fi option { background: var(--panel); color: var(--paper); }
    .fe { font-size: .78rem; color: var(--alert); margin-top: .3rem; display: flex; align-items: center; gap: .3rem; }

    .toggle-row { display: flex; align-items: center; gap: .75rem; }
    .toggle-switch { position: relative; width: 44px; height: 24px; flex-shrink: 0; }
    .toggle-switch input { opacity: 0; width: 0; height: 0; }
    .toggle-slider {
        position: absolute; inset: 0; background: var(--line); border-radius: 999px; cursor: pointer; transition: background .2s;
    }
    .toggle-slider::before { content: ''; position: absolute; width: 18px; height: 18px; left: 3px; top: 3px; background: var(--muted); border-radius: 50%; transition: transform .2s; }
    .toggle-switch input:checked + .toggle-slider { background: var(--uv); }
    .toggle-switch input:checked + .toggle-slider::before { transform: translateX(20px); background: #fff; }

    .icon-preview { display: flex; align-items: center; gap: .75rem; margin-top: .5rem; }
    .icon-preview-box { width: 48px; height: 48px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 1.4rem; color: #fff; background: linear-gradient(135deg, var(--uv), #6a58e0); }

    .btn-save {
        display: inline-flex; align-items: center; gap: .5rem;
        padding: .7rem 1.5rem; background: var(--tag); color: #1A1203;
        border: none; border-radius: 8px; font-size: .9rem; font-weight: 600;
        cursor: pointer; transition: background .16s;
        box-shadow: 0 3px 12px rgba(242,179,61,.2);
    }
    .btn-save:hover { background: #ffc75c; }
    .btn-cancel {
        display: inline-flex; align-items: center; gap: .5rem;
        padding: .7rem 1.25rem; background: var(--panel); color: var(--muted);
        border: 1.5px solid var(--line); border-radius: 8px; font-size: .9rem; font-weight: 600;
        text-decoration: none; transition: background .16s;
    }
    .btn-cancel:hover { background: var(--panel-2); color: var(--paper); }

    @media (max-width: 700px) { .form-grid { grid-template-columns: 1fr; } }
</style>

<div class="adm-form-card">
    <div class="adm-form-section"><i class="fas fa-info-circle"></i> Información Básica</div>
    <div class="form-grid">
        <div class="fg form-full">
            <label for="titulo">Título del curso <span class="req">*</span></label>
            <input type="text" id="titulo" name="titulo" class="fi @error('titulo') error @enderror"
                value="{{ old('titulo', $curso->titulo ?? '') }}" required>
            @error('titulo')<div class="fe"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>@enderror
        </div>

        <div class="fg form-full">
            <label for="descripcion_corta">Descripción corta (máx. 500 caracteres)</label>
            <input type="text" id="descripcion_corta" name="descripcion_corta" class="fi @error('descripcion_corta') error @enderror"
                value="{{ old('descripcion_corta', $curso->descripcion_corta ?? '') }}"
                placeholder="Breve resumen que se muestra en las tarjetas del catálogo">
            @error('descripcion_corta')<div class="fe"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>@enderror
        </div>

        <div class="fg form-full">
            <label for="descripcion">Descripción completa</label>
            <textarea id="descripcion" name="descripcion" class="fi @error('descripcion') error @enderror"
                    rows="4">{{ old('descripcion', $curso->descripcion ?? '') }}</textarea>
            @error('descripcion')<div class="fe"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>@enderror
        </div>

        <div class="fg">
            <label for="categoria">Categoría <span class="req">*</span></label>
            <select id="categoria" name="categoria" class="fi" required>
                @foreach(['forensia_digital'=>'Forensia Digital','ciberseguridad'=>'Ciberseguridad','seguridad_ofensiva'=>'Seguridad Ofensiva','analisis_malware'=>'Análisis de Malware','respuesta_incidentes'=>'Respuesta a Incidentes','osint'=>'OSINT','legal'=>'Legal y Cumplimiento','otro'=>'Otro'] as $val => $label)
                    <option value="{{ $val }}" {{ old('categoria', $curso->categoria ?? '') == $val ? 'selected' : '' }}>{{ $label }}</option>
                @endforeach
            </select>
        </div>

        <div class="fg">
            <label for="duracion_horas">Duración (horas)</label>
            <input type="number" id="duracion_horas" name="duracion_horas" class="fi" min="0"
                value="{{ old('duracion_horas', $curso->duracion_horas ?? 0) }}">
        </div>
    </div>
</div>

<div class="adm-form-card">
    <div class="adm-form-section"><i class="fas fa-dollar-sign"></i> Precio y Tipo</div>
    <div class="form-grid">
        <div class="fg">
            <label>Tipo de curso <span class="req">*</span></label>
            <div style="display:flex;gap:.75rem;margin-top:.35rem;">
                <label style="flex:1;display:flex;align-items:center;gap:.5rem;padding:.65rem 1rem;border:1.5px solid var(--line);border-radius:8px;cursor:pointer;" id="tipo-free-label">
                    <input type="radio" name="tipo" value="free" id="tipo-free"
                        {{ old('tipo', $curso->tipo ?? 'free') == 'free' ? 'checked' : '' }}
                        onchange="togglePrecio(false)" style="display:none;">
                    <i class="fas fa-gift" style="color:var(--resolved);"></i>
                    <span style="font-weight:600;font-size:.88rem;">Gratuito</span>
                </label>
                <label style="flex:1;display:flex;align-items:center;gap:.5rem;padding:.65rem 1rem;border:1.5px solid var(--line);border-radius:8px;cursor:pointer;" id="tipo-paid-label">
                    <input type="radio" name="tipo" value="paid" id="tipo-paid"
                        {{ old('tipo', $curso->tipo ?? '') == 'paid' ? 'checked' : '' }}
                        onchange="togglePrecio(true)" style="display:none;">
                    <i class="fas fa-tag" style="color:var(--tag);"></i>
                    <span style="font-weight:600;font-size:.88rem;">De Pago</span>
                </label>
            </div>
        </div>

        <div class="fg" id="precio-field" style="display:{{ old('tipo', $curso->tipo ?? 'free') == 'paid' ? 'block' : 'none' }};">
            <label for="precio">Precio (COP)</label>
            <input type="number" id="precio" name="precio" class="fi" min="0" step="1000"
                value="{{ old('precio', $curso->precio ?? 0) }}"
                placeholder="Ej: 120000">
        </div>
    </div>
</div>

<div class="adm-form-card">
    <div class="adm-form-section"><i class="fas fa-image"></i> Imagen del Curso</div>
    <div class="fg">
        <label>Imagen de portada</label>
        <input type="file" id="imagen" name="imagen" class="fi" accept="image/*" onchange="previewImagen(this)">
        <small style="color:var(--muted);font-size:.78rem;">JPG, PNG o WEBP. Máximo 3 MB.</small>
        @error('imagen')<div class="fe"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>@enderror
    </div>

    {{-- Previsualización --}}
    <div id="imagen-preview" style="margin-top:1.25rem;text-align:center;">
        @if(isset($curso) && $curso->imagen)
            <img src="{{ $curso->imagen }}" alt="Portada actual"
                style="max-width:100%;max-height:240px;border-radius:12px;object-fit:cover;border:1px solid var(--line);">
            <div style="font-size:.78rem;color:var(--muted);margin-top:.5rem;">Imagen actual</div>
        @else
            <div style="padding:2.5rem 1rem;border:1.5px dashed var(--line);border-radius:12px;color:var(--muted);font-size:.85rem;">
                <i class="fas fa-image" style="font-size:2.25rem;display:block;margin-bottom:.6rem;opacity:.4;"></i>
                <span>Sin imagen seleccionada</span>
            </div>
        @endif
    </div>
</div>

<div class="adm-form-card">
    <div class="adm-form-section"><i class="fas fa-cog"></i> Configuración</div>
    <div style="display:flex;flex-wrap:wrap;gap:1.5rem;">
        <div class="toggle-row">
            <label class="toggle-switch">
                <input type="checkbox" name="activo" value="1"
                    {{ old('activo', $curso->activo ?? true) ? 'checked' : '' }}>
                <span class="toggle-slider"></span>
            </label>
            <div>
                <div style="font-weight:600;font-size:.88rem;color:var(--paper);">Curso Activo</div>
                <div style="font-size:.75rem;color:var(--muted);">Visible para los estudiantes</div>
            </div>
        </div>
        <div class="toggle-row">
            <label class="toggle-switch">
                <input type="checkbox" name="destacado" value="1"
                    {{ old('destacado', $curso->destacado ?? false) ? 'checked' : '' }}>
                <span class="toggle-slider"></span>
            </label>
            <div>
                <div style="font-weight:600;font-size:.88rem;color:var(--paper);">Destacado</div>
                <div style="font-size:.75rem;color:var(--muted);">Se muestra primero en el catálogo</div>
            </div>
        </div>
    </div>
</div>

<div style="display:flex;align-items:center;gap:.75rem;">
    <button type="submit" class="btn-save">
        <i class="fas fa-save"></i> {{ isset($curso) && $curso->exists ? 'Guardar Cambios' : 'Crear Curso' }}
    </button>
    <a href="{{ route('admin.cursos.index') }}" class="btn-cancel">
        <i class="fas fa-times"></i> Cancelar
    </a>
</div>

<script>
function togglePrecio(show) {
    document.getElementById('precio-field').style.display = show ? 'block' : 'none';
    const freeLabel = document.getElementById('tipo-free-label');
    const paidLabel = document.getElementById('tipo-paid-label');
    freeLabel.style.borderColor = show ? 'var(--line)' : 'var(--uv)';
    freeLabel.style.background  = show ? 'var(--lab)' : 'var(--uv-soft)';
    paidLabel.style.borderColor = show ? 'var(--uv)' : 'var(--line)';
    paidLabel.style.background  = show ? 'var(--uv-soft)' : 'var(--lab)';
}

function previewImagen(input) {
    const preview = document.getElementById('imagen-preview');
    if (!input.files || !input.files[0]) return;
    const reader = new FileReader();
    reader.onload = function(e) {
        preview.innerHTML =
            '<img src="' + e.target.result + '" alt="Vista previa" ' +
            'style="max-width:100%;max-height:240px;border-radius:12px;object-fit:cover;border:1px solid var(--line);">' +
            '<div style="font-size:.78rem;color:var(--resolved);margin-top:.5rem;">' +
            '<i class="fas fa-check-circle"></i> Imagen seleccionada</div>';
    };
    reader.readAsDataURL(input.files[0]);
}

document.addEventListener('DOMContentLoaded', () => {
    const isPaid = document.getElementById('tipo-paid')?.checked;
    togglePrecio(isPaid);
});
</script>