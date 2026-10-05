<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    public function create(): View
    {
        return view('auth.register');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name'                     => ['required', 'string', 'max:150'],
            'email'                    => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users'],
            'password'                 => ['required', 'confirmed', Rules\Password::defaults()],
            'terms'                    => ['required', 'accepted'],
        ], [
            'name.required'             => 'El nombre completo es obligatorio.',
            'email.required'            => 'El correo electrónico es obligatorio.',
            'email.unique'              => 'Este correo ya está registrado.',
            'password.confirmed'        => 'Las contraseñas no coinciden.',
            'terms.required'            => 'Debes aceptar los términos y condiciones.',
        ]);

        $user = User::create([
            'name'       => $request->name,
            'email'      => $request->email,
            'newsletter' => $request->boolean('newsletter'),
            'password'   => Hash::make($request->password),
        ]);

        event(new Registered($user));
        Auth::login($user);

        return redirect()->route('dashboard');
    }
}