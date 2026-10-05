<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Services\B2Service;
use App\Models\ProgresoLeccion;

class DashboardController extends Controller
{
    /** Panel principal */
    public function index()
    {
        $user = Auth::user();

        $cursosInscritos   = $user->cursos()->withPivot('progreso', 'completado')->get();
        $cursosCompletados = $cursosInscritos->where('pivot.completado', true)->count();
        $certificados      = $cursosCompletados;

        // Calcular horas de estudio reales
        $segundosTotales = ProgresoLeccion::where('user_id', $user->id)->sum('tiempo_visto');
        $horasEstudio    = round($segundosTotales / 3600, 1);

        return view('dashboard', compact(
            'user', 'cursosInscritos', 'cursosCompletados', 'certificados', 'horasEstudio'
        ));
    }

    /** Formulario de perfil */
    public function editarPerfil()
    {
        $user = Auth::user();

        return view('perfil', compact('user'));
    }

    /** Guardar cambios del perfil */
    public function actualizarPerfil(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name'   => 'required|string|max:150',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ], [
            'name.required'    => 'El nombre es obligatorio.',
            'avatar.image'     => 'El archivo debe ser una imagen.',
            'avatar.max'       => 'La imagen no debe superar 2MB.',
        ]);

        if ($request->hasFile('avatar')) {
            $b2 = app(B2Service::class);
            // Borrar avatar anterior de B2
            if ($user->avatar) {
                $b2->eliminar(B2Service::urlAPublicId($user->avatar));
            }
            $res          = $b2->subir($request->file('avatar'), 'avatars', 'image');
            $user->avatar = $res['url'];
        }

        $user->name = $request->name;
        $user->save();

        return redirect()->route('dashboard.perfil')
            ->with('success', '¡Perfil actualizado correctamente!');
    }

    /** Cambiar contraseña */
    public function cambiarPassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password'         => 'required|min:8|confirmed',
        ], [
            'current_password.required' => 'Ingresa tu contraseña actual.',
            'password.min'              => 'La nueva contraseña debe tener al menos 8 caracteres.',
            'password.confirmed'        => 'Las contraseñas no coinciden.',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'La contraseña actual no es correcta.']);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('dashboard.perfil')
            ->with('success', '¡Contraseña actualizada correctamente!');
    }

    /** Mis cursos */
    public function misCursos()
    {
        $user   = Auth::user();
        $cursos = $user->cursos()->withPivot('progreso', 'completado')->get();

        return view('mis-cursos', compact('user', 'cursos'));
    }

    /** Certificados */
    public function certificados()
    {
        $user         = Auth::user();
        $certificados = $user->cursos()->wherePivot('completado', true)->get();

        return view('certificados', compact('user', 'certificados'));
    }
}