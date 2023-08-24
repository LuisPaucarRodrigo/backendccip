<?php

namespace App\Http\Controllers;

use App\Models\Cgep;
use App\Models\Combustible;
use App\Models\Operaciones;
use App\Models\Otros;
use App\Models\Peaje;
use App\Models\Traslado;
use App\Models\UsuarioCCIP;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Notification;
use App\Models\Tarea;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Psy\Readline\Hoa\Console;

class ApiController extends Controller
{
    public function validar($id,$token){
        $tokenv = UsuarioCCIP::all('id','remember_token')->where('id',"=",$id)->first;
        if ($tokenv->remember_token->remember_token == $token){
            return true;
        }
        return false;
    }
    public function gasto($usuario_id,$monto_total){
        $usuario = UsuarioCCIP::all('id','saldo','egresos')->where('id',"=",$usuario_id)->first();
        $usuario->egresos = $usuario->egresos + $monto_total;
        $usuario->saldo = $usuario->saldo - $monto_total;
        $usuario->save();
    }
    public function operacion($usuario_id,$ruc,$tipo_doc,$control_gastos,$cuadrilla,$nro_doc,$fecha_documento,$tipo,$monto,$fecha){
        $operacion = new Operaciones();
        $operacion->usuario_id = $usuario_id;
        $operacion->ruc = $ruc;
        $operacion->tipo_documento = $tipo_doc;
        $operacion->control_gastos = $control_gastos;
        $operacion->cuadrilla = $cuadrilla;
        $operacion->nro_documento = $nro_doc;
        $operacion->fecha_documento = $fecha_documento;
        $operacion->concepto = $tipo;
        $operacion->gasto = $monto;
        $operacion->fecha_insercion = $fecha;
        $operacion->save();
    }
    public function login(Request $request){
        $usuario =UsuarioCCIP::all()->where('dni',$request->dni)->first();
        if($usuario && Hash::check($request->password, $usuario->password) && $usuario->estado == 'Activo'){
            return response()->json([
                'id'=>$usuario->id,
                'email'=>$usuario->email,
                'name'=>$usuario->name,
                'lastname'=>$usuario->lastname,
                'dni'=>$usuario->dni,
                'token'=>$usuario->remember_token
                ]);
        }
        else{
            return response()->json([
                'token'=>0
                ]);
        }
    }
    public function traslado(Request $request){
        $v = $this->validar($request->usuario_id,$request->token);
        if ($v){
            $existingTraslado = Traslado::where('Nro_Oper', $request->Nro_Oper)
            ->where('fecha_insercion', $request->fecha_insercion)
            ->first();

            if ($existingTraslado) {
                // Registro duplicado, retornar respuesta indicando que no se pudo agregar
                return response()->json([
                    'response' => 2,
                    'message' => 'Registro ya Existente.'
                ]);
            }else {
                $traslado = new Traslado();
                $traslado->sitio_atendido = $request->sitio_atendido;
                $traslado->comentarios = $request->comentarios;
                $traslado->Oper_Inc_Crq = $request->Oper_Inc_Crq;
                $traslado->Nro_Oper = $request->Nro_Oper;
                $traslado->fecha_insercion = $request->fecha_insercion;
                $traslado->control_gastos = $request->control_gastos;
                $traslado->cuadrilla = $request->cuadrilla;
                $traslado->usuario_id = $request->usuario_id;
                $traslado->save();
                return response()->json([
                    'response'=>1
                ]);
            }
        }
        return response()->json([
            'response'=>0
        ]);
    }
    
    //combustible1
    public function combustible(Request $request){
        $v = $this->validar($request->usuario_id,$request->token);
        if ($v){
            $existingCombustible = Combustible::where('nro_factura', $request->nro_factura)
            ->where('ruc', $request->ruc)
            ->first();

            if ($existingCombustible) {
                // Registro duplicado, retornar respuesta indicando que no se pudo agregar
                return response()->json([
                    'response' => 2,
                    'message' => 'Registro ya Existente.'
                ]);
            }else {
                $date = Carbon::now()->format('Y-m-d');
                $combustible = new Combustible();
                $combustible->ruc = $request->ruc;
                $combustible->nro_factura = $request->nro_factura;
                $combustible->fecha_factura = $request->fecha_factura;
                $combustible->monto_total = $request->monto_total;
                $combustible->kilometraje = $request->kilometraje;
    
                $image = str_replace('data:image/png;base64,', '', $request->foto_km);
                $image = str_replace(' ', '+', $image);
                $imageContnt = base64_decode($image);
                $path = 'cmbkm'.$date.time().'.png';
                $ruta = "192.168.1.80:8000/imagenes/".$path;
                File::put(public_path('imagenes/').$path,$imageContnt);
                $combustible->foto_km = $ruta;
    
                $image2 = str_replace('data:image/png;base64,', '', $request->foto_factura);
                $image2 = str_replace(' ', '+', $image2);
                $imageContnt2 = base64_decode($image2);
                $path = 'cmbfc'.$date.time().'.png';
                $ruta2 = "192.168.1.80:8000/imagenes/".$path;
                File::put(public_path('imagenes/').$path,$imageContnt2);
                $combustible->foto_factura = $ruta2;
                $combustible->control_gastos = $request->control_gastos;
                $combustible->cuadrilla = $request->cuadrilla;
                $combustible->fecha_insercion = $request->fecha_insercion;
                $combustible->usuario_id = $request->usuario_id;
                $combustible->save();
                $this->operacion($request->usuario_id,$request->ruc,"Factura",$request->control_gastos,$request->cuadrilla,$request->nro_factura,
                $request->fecha_factura,"Combustible",$request->monto_total,$request->fecha_insercion);
                $this->gasto($request->usuario_id,$request->monto_total);
                return response()->json([
                    'response'=>1
                ]);
            }
        }
        return response()->json([
            'response'=>0
        ]);
    }

    public function peaje(Request $request){
        $v = $this->validar($request->usuario_id,$request->token);
        if ($v) {
            $existingPeaje = Peaje::where('nro_factura', $request->nro_factura)
            ->where('ruc', $request->ruc)
            ->first();

            if ($existingPeaje) {
                // Registro duplicado, retornar respuesta indicando que no se pudo agregar
                return response()->json([
                    'response' => 2,
                    'message' => 'Registro ya Existente.'
                ]);
            } else {
                $date = Carbon::now()->format('Y-m-d');
                $peaje = new Peaje();
                $peaje->ruc = $request->ruc;
                $peaje->nro_factura = $request->nro_factura;
                $peaje->fecha_factura = $request->fecha_factura;
                $image = str_replace('data:image/png;base64,', '', $request->foto_factura);
                $image = str_replace(' ', '+', $image);
                $imageContnt = base64_decode($image);
                $path = 'tr' . $date . time() . '.png';
                $ruta = "http://192.168.1.80:8000/imagenes/" . $path;
                File::put(public_path('imagenes/') . $path, $imageContnt);
                $peaje->foto_factura = $ruta;

                $peaje->lugar_llegada = $request->lugar_llegada;
                $peaje->fecha_insercion = $request->fecha_insercion;
                $peaje->monto_total = $request->monto_total;
                $peaje->usuario_id = $request->usuario_id;
                $peaje->control_gastos = $request->control_gastos;
                $peaje->cuadrilla = $request->cuadrilla;
                $peaje->save();
                $this->operacion($request->usuario_id,$request->ruc, "Factura",$request->control_gastos, $request->cuadrilla, $request->nro_factura,
                $request->fecha_factura,"Peaje", $request->monto_total, $request->fecha_insercion);
                $this->gasto($request->usuario_id, $request->monto_total);
                return response()->json([
                    'response' => 1
                ]);
            }
        }
        return response()->json([
            'response'=>0
        ]);

    }
    public function otros(Request $request){
        $v = $this->validar($request->usuario_id,$request->token);
        if ($v) {
            $existingOtros = Otros::where('tipo_documento', $request->tipo_documento)
            ->where('ruc', $request->ruc)
            ->first();
            if ($existingOtros){
                return response()->json([
                    'response' => 2,
                    'message' => 'Registro ya Existente.'
                ]);
            }else{
                $date = Carbon::now()->format('Y-m-d');
                $otros = new Otros();
                $otros->ruc = $request-> ruc;
                $otros->tipo_documento = $request->tipo_documento;
                $otros->numero_documento = $request->numero_documento;
                $otros->fecha_documento = $request->fecha_documento;
                $otros->autorizacion = $request->autorizacion;
                $otros->descripcion = $request->descripcion;
                $image = str_replace('data:image/png;base64,', '', $request->foto_otros);
                $image = str_replace(' ', '+', $image);
                $imageContnt = base64_decode($image);
                $path = 'ot' . $date . time() . '.png';
                $ruta = "http://192.168.1.80:8000/imagenes/" . $path;
                File::put(public_path('imagenes/') . $path, $imageContnt);
                $otros->foto_otros = $ruta;
    
                $otros->fecha_insercion = $request->fecha_insercion;
                $otros->monto_total = $request->monto_total;
                $otros->usuario_id = $request->usuario_id;
                $otros->control_gastos = $request->control_gastos;
                $otros->cuadrilla = $request->cuadrilla;
                $otros->save();
                $this->operacion($request->usuario_id,$request->ruc,$request->tipo_documento,$request->control_gastos, $request->cuadrilla, $request->numero_documento,
                $request->fecha_documento,"Otros", $request->monto_total, $request->fecha_insercion);
                $this->gasto($request->usuario_id, $request->monto_total);
                return response()->json([
                    'response' => 1
                ]);
            }
        }
        return response()->json([
            'response'=>0
        ]);
    }

    public function cgep(Request $request){
        $v = $this->validar($request->usuario_id,$request->token);
        if ($v){
            $existingCgep = Cgep::where('nro_factura', $request->nro_factura)
            ->where('ruc', $request->ruc)
            ->first();

            if ($existingCgep) {
                // Registro duplicado, retornar respuesta indicando que no se pudo agregar
                return response()->json([
                    'response' => 2,
                    'message' => 'Registro ya Existente.'
                ]);
            } else {
                $date = Carbon::now()->format('Y-m-d');
                $cgep = new Cgep();
                $cgep->ruc = $request->ruc;
                $cgep->nro_factura = $request->nro_factura;
                $cgep->fecha_factura = $request->fecha_factura;
                $cgep->monto_total = $request->monto_total;
                $cgep->estacion = $request->estacion;
    
                $image = str_replace('data:image/png;base64,', '', $request->foto_factura);
                $image = str_replace(' ', '+', $image);
                $imageContnt = base64_decode($image);
                $path = 'cmbgepfc'.$date.time().'.png';
                $ruta = "192.168.1.80:8000/imagenes/".$path;
                File::put(public_path('imagenes/').$path,$imageContnt);
                $cgep->foto_factura = $ruta;
    
                $image2 = str_replace('data:image/png;base64,', '', $request->foto_galonera);
                $image2 = str_replace(' ', '+', $image2);
                $imageContnt2 = base64_decode($image2);
                $path = 'cmbgepgl'.$date.time().'.png';
                $ruta2 = "192.168.1.80:8000/imagenes/".$path;
                File::put(public_path('imagenes/').$path,$imageContnt2);
                $cgep->foto_galonera = $ruta2;
    
                $cgep->cuadrilla = $request->cuadrilla;
                $cgep->control_gastos = $request->control_gastos;
                $cgep->fecha_insercion = $request->fecha_insercion;
                $cgep->usuario_id = $request->usuario_id;
                $cgep->save();
                $this->operacion($request->usuario_id,$request->ruc,"Factura",$request->control_gastos,$request->cuadrilla,$request->nro_factura,
                $request->fecha_factura,"CombustibleGep",$request->monto_total,$request->fecha_insercion);
                $this->gasto($request->usuario_id,$request->monto_total);
                return response()->json([
                    'response'=>1
                ]);
            }
        }
        return response()->json([
            'response'=>0
        ]);
    }

    public function saldo(Request $request){
        $v = $this->validar($request->id,$request->token);
        if ($v){
            $saldo = UsuarioCCIP::all('id','saldo')->where('id',$request->id)->first();
            $operaciones = Operaciones::with("UsuarioCCIP")->where('usuario_id',"=",$request->id)
                ->orderByDesc('fecha_insercion')->get()->take(20);
            return response()->json([
                'response'=>1,
                'saldo'=> $saldo->saldo,
                'operacion' => $operaciones
                ]
            );
        }
        return response()->json([
            'response'=>0
        ]);
    }

    public function notification(Request $request){
        $notify = Notification::first();
        return response()->json([
            'response'=>1,
            'titulo'=> $notify->Titulo,
            'mensaje' => $notify->Mensaje
            ]
        );
    }

    public function task(Request $request){
        $v = $this->validar($request->usuario_id,$request->token);
        if ($v){
            $now = Carbon::now();
            $task = Tarea::with("UsuarioCCIP")->where('usuario_id',"=",$request->usuario_id)
                ->whereDate('created_at', $now->toDateString())
                ->get()->take(20);
            return response()->json([
                'response'=>1,
                'listtask' => $task
                ]
            );
        }
        return response()->json([
            'response'=>0
        ]);
    }

    public function taskState(Request $request){
        $v = $this->validar($request->usuario_id,$request->token);
        if ($v){
            $task = Tarea::find($request->id);
            $task -> state = $request->stateTask;
            $task -> save();
            return response()->json([
                'response'=>1
                ]
            );
        }
        return response()->json([
            'response'=>0
        ]);
    }
}
