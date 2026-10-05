@extends('layouts.dashboard')

@section('title', 'Mi Perfil')
@section('page-title', 'Mi Perfil')

@section('content')
<style>
    .perf-grid { display: grid; grid-template-columns: 300px 1fr; gap: 1.25rem; align-items: start; }
    .perf-card { background: var(--panel); border: 1px solid var(--line); border-radius: 12px; overflow: hidden; }

    /* Avatar card */
    .avatar-section { padding: 2rem 1.5rem; text-align: center; border-bottom: 1px solid var(--line-soft); }
    .avatar-wrap { position: relative; width: 96px; height: 96px; margin: 0 auto 1rem; }
    .avatar-img { width: 96px; height: 96px; border-radius: 50%; object-fit: cover; border: 3px solid var(--uv); }
    .avatar-init {
        width: 96px; height: 96px; border-radius: 50%;
        background: linear-gradient(135deg, var(--uv), #6a58e0);
        color: #fff; font-size: 2.4rem; font-weight: 800;
        display: flex; align-items: center; justify-content: center;
        border: 3px solid var(--uv);
    }
    .avatar-cam {
        position: absolute; bottom: 0; right: 0;
        width: 28px; height: 28px; background: var(--tag); color: #1A1203;
        border-radius: 50%; border: 2px solid var(--panel);
        display: flex; align-items: center; justify-content: center;
        font-size: .72rem; cursor: pointer; transition: background .16s;
    }
    .avatar-cam:hover { background: #ffc75c; }

    .perf-name   { font-family: var(--font-sans); font-weight: 800; font-size: 1rem; color: var(--paper); margin-bottom: .2rem; }
    .perf-email  { font-size: .82rem; color: var(--muted); }
    .perf-cond   {
        display: inline-block; margin-top: .5rem;
        background: var(--uv-soft); color: #c9bfff;
        font-family: var(--font-mono); font-size: .68rem; font-weight: 500;
        padding: .2rem .7rem; border-radius: 999px;
    }

    .perf-meta { padding: 1rem 1.25rem; }
    .perf-meta-row { display: flex; align-items: center; gap: .6rem; padding: .5rem 0; border-bottom: 1px solid var(--line-soft); font-size: .83rem; color: var(--muted); }
    .perf-meta-row:last-child { border-bottom: none; }
    .perf-meta-row i { color: var(--tag); width: 15px; text-align: center; }

    /* Form */
    .perf-section-title {
        font-family: var(--font-mono); font-size: .7rem; font-weight: 500;
        color: var(--tag); text-transform: uppercase; letter-spacing: .12em;
        margin-bottom: 1rem; padding-bottom: .5rem;
        border-bottom: 1px solid var(--line-soft);
        display: flex; align-items: center; gap: .4rem;
    }
    .perf-form-pad { padding: 1.5rem; }
    .fg { margin-bottom: 1rem; }
    .fg label { display: block; font-size: .83rem; font-weight: 600; color: var(--paper); margin-bottom: .35rem; }
    .fg label .req { color: var(--alert); }
    .fi-wrap { position: relative; }
    .fi-wrap i.ico { position: absolute; left: .85rem; top: 50%; transform: translateY(-50%); color: var(--muted); font-size: .9rem; pointer-events: none; }
    .fi {
        width: 100%; padding: .65rem .9rem .65rem 2.4rem;
        border: 1.5px solid var(--line); border-radius: 8px;
        font-size: .88rem; color: var(--paper);
        background: var(--lab); transition: border-color .16s, box-shadow .16s;
        outline: none; font-family: inherit;
    }
    .fi:focus { border-color: var(--uv); box-shadow: 0 0 0 3px rgba(142,123,255,.14); }
    .fi.error { border-color: var(--alert); }
    .fi-disabled { background: var(--lab-deep); cursor: not-allowed; color: var(--muted); }
    select.fi { padding-left: 2.4rem; }
    select.fi option { background: var(--panel); color: var(--paper); }
    .fe { font-size: .78rem; color: var(--alert); margin-top: .3rem; display: flex; align-items: center; gap: .3rem; }
    .form-save-row { display: flex; justify-content: flex-end; margin-top: .5rem; }

    @media (max-width: 900px) { .perf-grid { grid-template-columns: 1fr; } }
</style>

<div class="perf-grid">

    {{-- Col izquierda: avatar + datos resumidos + cambiar contraseña --}}
    <div style="display:flex;flex-direction:column;gap:1.25rem;">

        {{-- Avatar --}}
        <div class="perf-card">
            <div class="avatar-section">
                <form method="POST" action="{{ route('dashboard.perfil.update') }}"
                    enctype="multipart/form-data" id="avatarForm">
                    @csrf @method('PUT')
                    <input type="hidden" name="name" value="{{ $user->name }}">
                    <div class="avatar-wrap">
                        @if($user->avatar)
                            <img src="{{ $user->avatar }}" alt="avatar"
                                class="avatar-img" id="avatarImg">
                        @else
                            <div class="avatar-init" id="avatarInit">{{ strtoupper(substr($user->name,0,1)) }}</div>
                            <img src="" alt="avatar" class="avatar-img" id="avatarImg" style="display:none;">
                        @endif
                        <label class="avatar-cam" for="avatarFile" title="Cambiar foto">
                            <i class="fas fa-camera"></i>
                        </label>
                        <input type="file" id="avatarFile" name="avatar"
                            accept="image/*" style="display:none;" onchange="previewAvatar(this)">
                    </div>
                </form>
                <div class="perf-name">{{ $user->name }}</div>
                <div class="perf-email">{{ $user->email }}</div>
                <span class="perf-cond">{{ $user->role === 'admin' ? 'Administrador' : 'Estudiante' }}</span>
            </div>
            <div class="perf-meta">
                <div class="perf-meta-row"><i class="fas fa-envelope"></i> {{ $user->email }}</div>
                <div class="perf-meta-row">
                    <i class="fas fa-calendar"></i> Miembro desde {{ $user->created_at->format('d/m/Y') }}
                </div>
            </div>
        </div>

        {{-- Cambiar contraseña --}}
        <div class="perf-card">
            <div class="perf-form-pad">
                <div class="perf-section-title"><i class="fas fa-lock"></i> Cambiar Contraseña</div>
                <form method="POST" action="{{ route('dashboard.password.update') }}">
                    @csrf @method('PUT')
                    <div class="fg">
                        <label for="current_password">Contraseña actual <span class="req">*</span></label>
                        <div class="fi-wrap">
                            <i class="fas fa-lock ico"></i>
                            <input type="password" id="current_password" name="current_password"
                                   class="fi @error('current_password') error @enderror"
                                   placeholder="Tu contraseña actual">
                        </div>
                        @error('current_password')<div class="fe"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>@enderror
                    </div>
                    <div class="fg">
                        <label for="password">Nueva contraseña <span class="req">*</span></label>
                        <div class="fi-wrap">
                            <i class="fas fa-key ico"></i>
                            <input type="password" id="password" name="password"
                                   class="fi @error('password') error @enderror"
                                   placeholder="Mínimo 8 caracteres">
                        </div>
                        @error('password')<div class="fe"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>@enderror
                    </div>
                    <div class="fg">
                        <label for="password_confirmation">Confirmar nueva contraseña</label>
                        <div class="fi-wrap">
                            <i class="fas fa-key ico"></i>
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                   class="fi" placeholder="Repite la contraseña">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center;">
                        <i class="fas fa-save"></i> Actualizar Contraseña
                    </button>
                </form>
            </div>
        </div>

    </div>

    {{-- Col derecha: formulario datos personales --}}
    <div class="perf-card">
        <div class="perf-form-pad">
            <div class="perf-section-title"><i class="fas fa-user-edit"></i> Datos Personales</div>

            <form method="POST" action="{{ route('dashboard.perfil.update') }}" enctype="multipart/form-data">
                @csrf @method('PUT')

                <div class="fg">
                    <label for="name">Nombre completo <span class="req">*</span></label>
                    <div class="fi-wrap">
                        <i class="fas fa-user ico"></i>
                        <input type="text" id="name" name="name"
                               class="fi @error('name') error @enderror"
                               value="{{ old('name', $user->name) }}" required>
                    </div>
                    @error('name')<div class="fe"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>@enderror
                </div>

                <div class="fg">
                    <label>Correo electrónico</label>
                    <div class="fi-wrap">
                        <i class="fas fa-envelope ico"></i>
                        <input type="email" class="fi fi-disabled" value="{{ $user->email }}" disabled>
                    </div>
                    <small style="font-size:.75rem;color:var(--muted);">No puede modificarse.</small>
                </div>

                <div class="form-save-row">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Guardar Cambios
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection

@section('extra-js')
<script>
function previewAvatar(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            const img = document.getElementById('avatarImg');
            const init = document.getElementById('avatarInit');
            if (init) init.style.display = 'none';
            img.src = e.target.result;
            img.style.display = 'block';
        };
        reader.readAsDataURL(input.files[0]);
        document.getElementById('avatarForm').submit();
    }
}
</script>
@endsection
