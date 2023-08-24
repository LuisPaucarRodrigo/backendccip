<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role; // Importar la clase Role

class RegisterController extends Controller
{
    public function show(){
        return view('auth.register');
    }
    
    public function register(Request $request){
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->rol = $request->role;
        $user->password = ($request->password);
        $user->save();

        //Asignar el rol correspondiente al usuario
        if ($request->has('role')) {
            $role = Role::where('name', $request->input('role'))->first();

            if ($role) {
                $user->assignRole($role);
            }
        }

        return redirect('/administradores');
    }
    
    public function prueba(){
        dd('controlador OK');
    }
}
