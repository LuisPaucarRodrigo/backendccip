<?php

namespace App\Http\Controllers;

use App\Exports\UsuarioCCIPExport;
use App\Http\Requests\forgotRequest;
use App\Models\Cgep;
use App\Models\Combustible;
use App\Models\Notification;
use App\Models\Operaciones;
use App\Models\Peaje;
use App\Models\Recarga;
use App\Models\User;
use App\Models\UsuarioCCIP;
use Brick\Math\Exception\NegativeNumberException;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Permission\Models\Role;

class UsuariosCCIPController extends Controller
{   
    public function updateuseradmin(Request $request){
        $updateadmin = user::find($request->input('id'));
        $updateadmin->name = $request->input('name');
        $updateadmin->lastname = $request->input('lastname');
        $updateadmin->dni = $request->input('dni');
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
        $usuarios = UsuarioCCIP::all();
        return view('CCIP.usuarios')->with('usuarios',$usuarios);
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

    public function liquidar()
    {
        return Excel::download(new UsuarioCCIPExport(), 'SaldoNegativo.xlsx');
    }

    public function notification(Request $request)
    {
        $notify = new Notification();
        $notify->Titulo = $request->input('notificationTitle');
        $notify->Mensaje = $request->input('notificationText');
        $notify->save();
        return redirect('/home');
    }
}
