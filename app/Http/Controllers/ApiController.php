<?php

namespace App\Http\Controllers;

use App\Models\Cardoc;
use App\Models\Cgep;
use App\Models\Combustible;
use App\Models\Controltool;
use App\Models\Equipmentcar;
use App\Models\Equipmenttoll;
use App\Models\Kittoll;
use App\Models\Operaciones;
use App\Models\Otros;
use App\Models\Peaje;
use App\Models\Traslado;
use App\Models\UsuarioCCIP;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Notification;
use App\Models\Statecar;
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
        $notify = Notification::latest()->first();
        if ($notify) {
            return response()->json([
                'response' => 1,
                'titulo' => $notify->Titulo,
                'mensaje' => $notify->Mensaje
            ]);
        } else {
            return response()->json([
                'response' => 0,
            ]);
        }
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

    public function checkStateCarEquipment(Request $request){
        $v = $this->validar($request->usuario_id,$request->token);
        if ($v){
            $equipmentcar = new Equipmentcar();
            $equipmentcar->control_gastos = $request->control_gastos;
            $equipmentcar->cuadrilla = $request->cuadrilla;
            $equipmentcar->fecha_insercion = $request->fecha_insercion;
            $equipmentcar->usuario_id = $request->usuario_id;
            $equipmentcar->extintor = $request->checkExtintor;
            $equipmentcar->botiquin = $request->checkBotiquin;
            $equipmentcar->conos = $request->checkConos;
            $equipmentcar->gata = $request->checkGata;
            $equipmentcar->neumatico = $request->checkNeumatico;
            $equipmentcar->ca_remolque = $request->checkCableRemolque;
            $equipmentcar->ca_bateria = $request->checkCableBateria;
            $equipmentcar->reflejante = $request->checkReflejante;
            $equipmentcar->kit = $request->checkKit;
            $equipmentcar->alarma = $request->checkAlarma;
            $equipmentcar->gps = $request->checkGps;
            $equipmentcar->tacos = $request->checkTacos;
            $equipmentcar->interna = $request->checkinterna;
            $equipmentcar->antivuelco = $request->checkAntivuelco;
            $equipmentcar->portaescalera = $request->checkPortaEscalera;
            $equipmentcar->placalateral = $request->checkPlacaLateral;
            $equipmentcar->save();
            return response()->json([
                'response'=>1
                ]
            );
        }
        return response()->json([
            'response'=>0
        ]);
    }

    public function checkStateCar(Request $request){
        $v = $this->validar($request->usuario_id,$request->token);
        if ($v){
            $statecar = new Statecar();
            $statecar->control_gastos = $request->control_gastos;
            $statecar->cuadrilla = $request->cuadrilla;
            $statecar->fecha_insercion = $request->fecha_insercion;
            $statecar->usuario_id = $request->usuario_id;
            $statecar->bocina = $request->bocina;
            $statecar->frenos = $request->frenos;
            $statecar->lucesaltasbajas = $request->lucesaltasbajas;
            $statecar->intermitentes = $request->intermitentes;
            $statecar->direccionales = $request->direccionales;
            $statecar->retrovisores = $request->retrovisores;
            $statecar->neumaticos = $request->neumatico;
            $statecar->parachoques = $request->parachoques;
            $statecar->temperatura = $request->temperatura;
            $statecar->aceite = $request->aceite;
            $statecar->combustible = $request->combustible;
            $statecar->aseovehiculo = $request->aseovehiculo;
            $statecar->puertas = $request->puertas;
            $statecar->parabrisas = $request->parabrisas;
            $statecar->motor = $request->motor;
            $statecar->bateria = $request->bateria;
            $statecar->save();
            return response()->json([
                'response'=>1
                ]
            );
        }
        return response()->json([
            'response'=>0
        ]);
    }

    public function checkCarDoc(Request $request){
        $v = $this->validar($request->usuario_id,$request->token);
        if ($v){
            $cardoc = new Cardoc();
            $cardoc->control_gastos = $request->control_gastos;
            $cardoc->cuadrilla = $request->cuadrilla;
            $cardoc->fecha_insercion = $request->fecha_insercion;
            $cardoc->usuario_id = $request->usuario_id;
            $cardoc->circulacion = $request->checkCirculacion;
            $cardoc->tecnica = $request->checkTecnica;
            $cardoc->soat = $request->checkSoat;
            $cardoc->save();
            return response()->json([
                'response'=>1
                ]
            );
        }
        return response()->json([
            'response'=>0
        ]);
    }

    public function checkControlEquipmentTools(Request $request){
        $v = $this->validar($request->usuario_id,$request->token);
        if ($v){
            $tollEquipment = new Equipmenttoll();
            // Asignar los valores recibidos por request a los campos del modelo
            $tollEquipment->control_gastos = $request->control_gastos;
            $tollEquipment->cuadrilla = $request->cuadrilla;
            $tollEquipment->fecha_insercion = $request->fecha_insercion;
            $tollEquipment->usuario_id = $request->usuario_id;
            $tollEquipment->hidrolavadora = $request->hidrolavadora;
            $tollEquipment->sopladora = $request->sopladora;
            $tollEquipment->megometro = $request->megometro;
            $tollEquipment->telurometro = $request->telurometro;
            $tollEquipment->aperimetrica = $request->aperimetrica;
            $tollEquipment->manometro = $request->manometro;
            $tollEquipment->pirometro = $request->pirometro;
            $tollEquipment->laptop = $request->laptop;
            $tollEquipment->taladro = $request->taladro;
            $tollEquipment->brujula = $request->brujula;
            $tollEquipment->inclinometro = $request->inclinometro;
            $tollEquipment->linterna = $request->linterna;
            $tollEquipment->powermeter = $request->powermeter;
            $tollEquipment->pistola = $request->pistola;
            $tollEquipment->pertiga = $request->pertiga;
            $tollEquipment->cuter = $request->cuter;
            $tollEquipment->escalera = $request->escalera;
            $tollEquipment->extension = $request->extension;
            $tollEquipment->pistolaestano = $request->pistolaestano;
            $tollEquipment->escaleratijera = $request->escaleratijera;
            $tollEquipment->carrito = $request->carrito;
            $tollEquipment->save();
            return response()->json([
                'response'=>1
                ]
            );
        }
        return response()->json([
            'response'=>0
        ]);
    }

    public function checkControlKitTools(Request $request){
        $v = $this->validar($request->usuario_id,$request->token);
        if ($v){
            $kittoll = new Kittoll();
            $kittoll->control_gastos = $request->control_gastos;
            $kittoll->cuadrilla = $request->cuadrilla;
            $kittoll->fecha_insercion = $request->fecha_insercion;
            $kittoll->usuario_id = $request->usuario_id;
            $kittoll->mosqueton = $request->checkMosqueton;
            $kittoll->pelacable = $request->checkPelacable;
            $kittoll->crimpeadora = $request->checkCrimpeadora;
            $kittoll->limas = $request->checkLimas;
            $kittoll->allen = $request->checkAllen;
            $kittoll->readline = $request->checkKitReadline;
            $kittoll->impacto = $request->checkImpacto;
            $kittoll->dielectricos = $request->checkDielectricos;
            $kittoll->corte = $request->checkCorte;
            $kittoll->fuerza = $request->checkFuerza;
            $kittoll->recto = $request->checkRecto;
            $kittoll->francesas = $request->checkFrancesas;
            $kittoll->sierra = $request->checkSierra;
            $kittoll->silicona = $request->checkSilicona;
            $kittoll->polea = $request->checkPolea;
            $kittoll->wincha = $request->checkWincha;
            $kittoll->eslinga = $request->checkEslinga;
            $kittoll->brocas = $request->checkBrocas;
            $kittoll->sacabocado = $request->checkSacabocado;
            $kittoll->extractor = $request->checkExtractor;
            $kittoll->maletagrande = $request->checkMaletaGrande;
            $kittoll->maletamediana = $request->checkMaletaMediana;
            $kittoll->save();
            return response()->json([
                'response'=>1
                ]
            );
        }
        return response()->json([
            'response'=>0
        ]);
    }

    public function checkControlTools(Request $request){
        $v = $this->validar($request->usuario_id,$request->token);
        if ($v){
            $controltoll = new Controltool();
            $controltoll->control_gastos = $request->control_gastos;
            $controltoll->cuadrilla = $request->cuadrilla;
            $controltoll->fecha_insercion = $request->fecha_insercion;
            $controltoll->usuario_id = $request->usuario_id;
            $controltoll->juegollaves = $request->checkJuegoLlaves;
            $controltoll->juegodados = $request->checkJuegoDados;
            $controltoll->cuter = $request->checkCuter;
            $controltoll->arnes = $request->checkArnes;
            $controltoll->save();
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
