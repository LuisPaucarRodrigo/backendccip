<?php

namespace App\Http\Controllers;

use App\Http\Requests\CCIPRequest;
use App\Http\Requests\forgotRequest;
use App\Models\Cgep;
use App\Models\Combustible;
use App\Models\Operaciones;
use App\Models\Peaje;
use App\Models\Recarga;
use App\Models\User;
use App\Models\UsuarioCCIP;
use App\Models\UsuarioCCIP as usuarios;
use Brick\Math\Exception\NegativeNumberException;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class UsuariosCCIPController extends Controller
{   
    public function updateuseradmin(Request $request){
        $updateadmin = user::find($request->input('id'));
        $updateadmin->name = $request->input('name');
        $updateadmin->email = $request->input('email');
        $updateadmin->rol = $request->input('rol');
        $updateadmin->save();
        return redirect('/administradores');
    }

    public function editaradmin($id){
        $useredit = user::find($id);
        $roles = Role::all();
        //dd($useredit);
        return view('AdminCcip.editadministradores',compact('useredit','roles'));
    }
    
    public function useradministradores(){
        $users = user::all();
        return view('AdminCcip.useradministradores',compact('users'));
    }

    public function index(){
        $usuarios = usuarios::all();
        return view('CCIP.usuarios')->with('usuarios',$usuarios);
    }

    public function create(CCIPRequest $request){
        $usuario = new UsuarioCCIP();
        $usuario->name = $request->get('name');
        $usuario->lastname = $request->get('lastname');
        $usuario->username = $request->get('username');
        $usuario->dni = $request->get('dni');
        $usuario->email = $request->get('email');
        $usuario->monto_total = $request->get('saldo');
        $usuario->saldo = $request->get('saldo');
        $usuario->password = ($request->password);
        $usuario->estado = $request->get('estado');
        $usuario->remember_token = Str::uuid();
        $usuario->save();
        return redirect('/home');
    }
    public function modify($id){
        $usuario = UsuarioCCIP::all('id','name','lastname','dni','username','email','estado')
            ->where('id',"=",$id)->first();
        return view('CCIP.editUser')->with('usuario',$usuario);
    }

    public function delete($id){
        $usuario = UsuarioCCIP::destroy($id);
        return redirect('/home');
    }

    public function update(Request $request, $id){
        $usuario = UsuarioCCIP::all()->where('id',"=",$id)->first();
        $usuario->name = $request->name;
        $usuario->lastname = $request->lastname;
        $usuario->username = $request->username;
        $usuario->dni = $request->dni;
        $usuario->email = $request->email;
        if ($usuario->estado != $request->estado){
            $usuario->estado = $request->estado;
            $usuario->remember_token = Str::uuid();
        }
        $usuario->save();
        return redirect('/home');
    }

    //password
    public function edit_password($id){
        return view('CCIP.forgotPassword')->with('id',$id);
    }
    public function update_password(forgotRequest $request, $id){
        $usuario = UsuarioCCIP::all()->where('id',"=",$id)->first();
        $usuario->password = ($request->password);
        $usuario->save();
        return redirect('/home/mostrarUsuario/'.$id);
    }
    public function recargar(Request $request){
        $usuarioId = $request->input('usuario_id');        
        $opcion = $request->input('opcion');
        $numeroOperacion = $request->input('operationCuadrilla');
        if($opcion == 'cuadrilla'){
            $existeNumberOperation = Recarga::where('numero_operacion', $numeroOperacion)->exists();

            if ($existeNumberOperation) {
                return redirect('/home')->with([
                    'error' => 'No se pudo realizar la recarga debido a un problema', // Cambia el mensaje de error si es necesario
                ]);
                
            }else{
                $monto = $request->input('recarga');
                $dateCuadrilla = $request->input('dateCuadrilla');
                $texto = $request->input('textCuadrilla');
                $cuadrilla = $request->input('selectCuadrilla');
                $recarga = new Recarga();
                $recarga->opcion = $opcion;
                $recarga->cuadrilla = $cuadrilla;
                $recarga->monto = $monto;
                $recarga->numero_operacion = $numeroOperacion;
                $recarga->fecha_recarga = $dateCuadrilla;
                $recarga->concepto = $texto;
                $recarga->usuario_id = $usuarioId;
                $recarga->save();

                $usuario = UsuarioCCIP::all('id','saldo','monto_total')->where('id',"=",$usuarioId)->first();
                $usuario->monto_total = $usuario->monto_total+$request->recarga;
                $usuario->saldo = $usuario->saldo+$request->recarga;
                $usuario->save();
                return redirect('/home')->with([
                    'success' => 'Recarga exitosa', // Cambia el mensaje según corresponda
                ]);
                
            }
        }elseif($opcion == 'otros'){

        }

        
    }
    public function liquidar(){
        $usuario = UsuarioCCIP::all();
        foreach($usuario as $user){
            $recarga = Recarga::where('usuario_id', $user->id)
            ->latest()
            ->first();
            //dd($recarga);
            if($user->saldo < 0){
                $recarga -> monto += $user->saldo;
                $user -> egresos = $user -> saldo * (-1);
                $user -> monto_total = 0;
                $user -> saldo = $user -> saldo;
                
            }elseif($user->saldo > 0){
                $recarga->monto -= $user->saldo;
                $user -> egresos = 0;
                $user -> monto_total = $user -> saldo;
                $user -> saldo = $user -> saldo;
                $newrecarga = new Recarga();
                $newrecarga->opcion = $recarga ->opcion;
                $newrecarga->cuadrilla = $recarga ->cuadrilla;
                $newrecarga->monto = $user -> saldo;
                $newrecarga->numero_operacion = $recarga ->numeroOperacion;
                $newrecarga->fecha_recarga = $recarga ->dateCuadrilla;
                $newrecarga->concepto = $recarga ->texto;
                $newrecarga->usuario_id = $recarga -> usuarioId;
                $newrecarga -> save();
            }
            $user -> save();
            $recarga->save();
        };
        return redirect('/home');
    }
}
