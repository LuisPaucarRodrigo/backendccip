<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role; // Importar la clase Role

class RegisterController extends Controller
{
    public function show(){
        $roles = Role::all();
        return view('auth.register',compact('roles'));
    }
    
    public function register(Request $request){
        // Verificar si hay un usuario autenticado actualmente
        if (!Auth::check()) {
            // No hay usuario autenticado, procede con el registro y autentica al nuevo usuario
            $user = new User;
            $user->name = $request->name;
            $user->lastname = $request->lastname;
            $user->dni = $request->dni;
            $user->email = $request->email;
            $user->rol = $request->role;
            $user->password = $request->password;
            $user->save();

            // Asignar el rol correspondiente al usuario
            if ($request->has('role')) {
                $role = Role::where('name', $request->input('role'))->first();

                if ($role) {
                    $user->assignRole($role);
                }
            }

            Auth::login($user);
        }

        // Redirigir al usuario a la página adecuada
        return redirect('/administradores');
    }
    
    public function prueba(){
        dd('controlador OK');
    }
}
