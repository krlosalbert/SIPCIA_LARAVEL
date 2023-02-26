<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;

class AdminRegistrationController extends Controller
{

     /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required'],
            'addres' => ['required', 'string', 'max:255'],
            'role' => ['required', 'integer'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'name.required' => 'El campo nombre es obligatorio',
            'lastname.required' => 'El campo apellido es obligatorio',
            'email.required' => 'El campo correo electrónico es obligatorio',
            'email.email' => 'Ingrese una dirección de correo electrónico válida',
            'email.unique' => 'Esta dirección de correo electrónico ya está en uso',
            'phone.required' => 'El campo teléfono es obligatorio',
            'addres.required' => 'El campo dirección es obligatorio',
            'role.required' => 'El campo rol es obligatorio',
            'password.required' => 'El campo contraseña es obligatorio',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres',
            'password.confirmed' => 'La confirmación de la contraseña no coincide',
        ]);
    
    }
    
    // Mostrar el formulario de registro de usuarios para administradores
    public function showRegistrationForm()
    {
        // Verificar si el usuario autenticado tiene un rol de administrador
        if (auth()->user()->is_admin) {
            return view('auth.register');
        } else {
            // Redireccionar a la página de inicio de sesión si el usuario no es un administrador
            return redirect('/login');
        }
    }

    // Procesar la solicitud de registro de usuarios
    public function register(Request $request)
    {
        // Validar los datos del formulario de registro
        $this->validator($request->all())->validate();
    
        // Crear un nuevo usuario
        $user = $this->create($request->all());
    
        // Establecer el rol del usuario
        $user->role = $request->input('administrador', false);
        $user->save();
    
        // Iniciar sesión automáticamente al usuario después del registro
        //auth()->login($user);
    
        // Redireccionar al usuario a la página de inicio después del registro
        return redirect('ViewUsers');
    }

        /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'lastname' => $data['lastname'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'addres' => $data['addres'],
            'role' => $data['role'],
            'password' => Hash::make($data['password']),
        ]);
    }
    
}

