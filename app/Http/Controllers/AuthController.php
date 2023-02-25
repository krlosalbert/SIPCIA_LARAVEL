<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'UserIdCard' => 'required',
            'UserPassword' => 'required',
        ]);
/*         if (Auth::check()) {
            return redirect()->back()->withErrors([
                'UserIdCard' => 'El usuario está autenticado',
            ]);
        } else {
            return redirect()->back()->withErrors([
                'UserIdCard' => 'El usuario no está autenticado',
            ]);
        } */
        

         if (Auth::validate($credentials)) {
            // Inicio de sesión exitoso
            return redirect()->intended('home');
        } else {
            // Error de inicio de sesión
            if (User::where('UserIdCard', $request->user)->exists()) {
                // El usuario es correcto pero la contraseña es incorrecta
                return redirect()->back()->withErrors([
                    'UserPassword' => 'La contraseña proporcionada no es correcta',
                ]);
            } else {
                // El Usuario es incorrecto
                return redirect()->back()->withErrors([
                    'UserIdCard' => 'El usuario proporcionado no existe',
                ]);
            }
            throw ValidationException:: withMessages([
                'UserIdCard' => __('auth.failed')
            ]);  
        }
    }
}
