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
        if ($user->rol == 'Asistente') {
            return redirect('/home/reportes');
        } else {
            return redirect('/home/general');
        }
        //return redirect('/home/general');
    }
    public function logout(){
        Auth::logout();
        return redirect('/login');
    }
}
