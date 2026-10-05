@extends('layouts.auth')

@section('title', 'Registro - ForenseBox')

@section('content')
<div class="auth-container">
    <div class="auth-card" style="max-width: 480px;">

        <div class="auth-header">
            <a href="{{ route('inicio') }}" style="display:inline-block;margin-bottom:.25rem;">
                <img src="{{ asset('images/logo.png') }}"
                    alt="ForenseBox"
                    style="height:96px;width:auto;object-fit:contain;"
                    onerror="this.style.display='none';this.nextElementSibling.style.display='flex';">
                <div class="auth-logo" style="display:none;">FB</div>
            </a>
            <h1 class="auth-title">Crea tu cuenta</h1>
            <p class="auth-subtitle">Únete a la plataforma de ciberseguridad y forensia digital</p>
        </div>

        <form method="POST" action="{{ route('register') }}" id="registerForm">
            @csrf

            {{-- Nombre completo --}}
            <div class="form-group">
                <label class="form-label" for="name">
                    Nombre completo <span class="required">*</span>
                </label>
                <div class="input-icon-wrapper">
                    <i class="fas fa-user input-icon"></i>
                    <input type="text"
                        class="form-input @error('name') error @enderror"
                        id="name" name="name"
                        placeholder="Ej: Laura Martínez"
                        value="{{ old('name') }}"
                        required autofocus>
                </div>
                @error('name')
                    <div class="form-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                @enderror
            </div>

            {{-- Correo electrónico --}}
            <div class="form-group">
                <label class="form-label" for="email">
                    Correo electrónico <span class="required">*</span>
                </label>
                <div class="input-icon-wrapper">
                    <i class="fas fa-envelope input-icon"></i>
                    <input type="email"
                        class="form-input @error('email') error @enderror"
                        id="email" name="email"
                        placeholder="tu@correo.com"
                        value="{{ old('email') }}"
                        required>
                </div>
                @error('email')
                    <div class="form-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                @enderror
            </div>

            {{-- Contraseña --}}
            <div class="form-group">
                <label class="form-label" for="password">
                    Contraseña <span class="required">*</span>
                </label>
                <div class="input-icon-wrapper">
                    <i class="fas fa-lock input-icon"></i>
                    <input type="password"
                        class="form-input @error('password') error @enderror"
                        id="password" name="password"
                        placeholder="Mínimo 8 caracteres"
                        required oninput="checkPasswordStrength()">
                    <button type="button" class="password-toggle" onclick="togglePassword('password')">
                        <i class="fas fa-eye" id="password-icon"></i>
                    </button>
                </div>
                @error('password')
                    <div class="form-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                @enderror
                <div class="password-strength" id="passwordStrength">
                    <div class="strength-bar">
                        <div class="strength-fill" id="strengthFill"></div>
                    </div>
                    <span class="strength-text" id="strengthText"></span>
                </div>
            </div>

            {{-- Confirmar contraseña --}}
            <div class="form-group">
                <label class="form-label" for="password_confirmation">
                    Confirmar contraseña <span class="required">*</span>
                </label>
                <div class="input-icon-wrapper">
                    <i class="fas fa-lock input-icon"></i>
                    <input type="password"
                        class="form-input"
                        id="password_confirmation"
                        name="password_confirmation"
                        placeholder="Repite tu contraseña"
                        required>
                    <button type="button" class="password-toggle" onclick="togglePassword('password_confirmation')">
                        <i class="fas fa-eye" id="password_confirmation-icon"></i>
                    </button>
                </div>
            </div>

            {{-- Términos y condiciones --}}
            <div class="form-group">
                <label class="flex items-center gap-2">
                    <input type="checkbox" id="terms" name="terms" class="form-checkbox">
                    <span>
                        Acepto los
                        <a href="#" class="form-link" target="_blank">términos y condiciones</a>
                        y la
                        <a href="#" class="form-link" target="_blank">política de privacidad</a>
                    </span>
                </label>
                @error('terms')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            {{-- Newsletter --}}
            <div class="flex items-start gap-2">
                <input
                    type="checkbox"
                    id="newsletter"
                    name="newsletter"
                    value="1"
                    class="form-checkbox mt-1"
                    {{ old('newsletter', true) ? 'checked' : '' }}
                >
                <label for="newsletter" class="text-sm cursor-pointer" style="color: var(--muted);">
                    Deseo recibir información sobre nuevos cursos y actualizaciones
                </label>
            </div>

            <button type="submit" class="btn btn-primary form-submit">
                <i class="fas fa-user-plus"></i> Crear Cuenta
            </button>
        </form>

        <div class="auth-footer">
            ¿Ya tienes una cuenta?
            <a href="{{ route('login') }}" class="form-link">Inicia sesión aquí</a>
        </div>
    </div>
</div>
@endsection
