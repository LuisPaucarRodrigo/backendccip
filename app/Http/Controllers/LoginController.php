<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function show(){
        if (Auth::check()){
            return redirect('/home');
        }
        return view('auth.login');
    }
    public function login(LoginRequest $request){
        $credentials = $request ->getCredentials();
        if(!Auth::validate($credentials)){
            return redirect()->to('/login')->withErrors('auth.failed');
        }
        $user = Auth::getProvider()->retrieveByCredentials($credentials);
        Auth::login($user);
        //dd($user);
        return $this->authenticated($request, $user);
    }
    public function authenticated(Request $request, $user){
        if ($user->hasPermissionTo('admin.general')) {
            return redirect('/home/general'); // Redirigir si el usuario tiene el permiso 'admin.general'
        } elseif ($user->hasPermissionTo('admin.tareas')) {
            return redirect('/home/tareas'); // Redirigir si el usuario tiene el permiso 'asistente.general'
        } elseif ($user->hasPermissionTo('admin.listado')) {
            return redirect('/home/roleslist'); // Redirigir si el usuario tiene el permiso 'asistente.general'
        }elseif ($user->hasPermissionTo('admin.usuarios')) {
            return redirect('/home'); // Redirigir si el usuario tiene el permiso 'asistente.general'
        }elseif ($user->hasPermissionTo('admin.reportes')) {
            return redirect('/home/generate'); // Redirigir si el usuario tiene el permiso 'asistente.general'
        }elseif ($user->hasPermissionTo('admin.gastosfijos')) {
            return redirect('/gastosfijos/camioneta'); // Redirigir si el usuario tiene el permiso 'asistente.general'
        }elseif ($user->hasPermissionTo('admin.rrhh')) {
            return redirect('/rrhh/personal'); // Redirigir si el usuario tiene el permiso 'asistente.general'
        }else {
            return redirect('/home/plantainterna'); // Redirigir a una ruta predeterminada si no tiene los permisos anteriores
        }
    }
    public function logout(){
        Auth::logout();
        return redirect('/login');
    }
}
