<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\reporteRequest;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CgepExport;
use App\Exports\CombustibleExport;
use App\Exports\ControlEppExport;
use App\Exports\OperacionExport;
use App\Exports\OtrosExport;
use App\Exports\PeajeExport;
use App\Exports\TrasladoExport;
use App\Exports\RecargaExport;
use App\Exports\TareaExport;
use App\Exports\KitHerramientasExport;
use App\Exports\EquipHerramientasExport;
use App\Exports\ControlHerramientasExport;
use App\Exports\DocumentosCamionetaExport;
use App\Exports\EquiposCamionetaExport;
use App\Exports\EstadoCamionetaExport;
use App\Exports\EstadoCamiontaExport;
use App\Models\UsuarioCCIP;

class ReportesController extends Controller
{
    public function generate(reporteRequest $request){
        $accion = $request->input('submit');
        $date = Carbon::now()->format('Y-m-d');
        $inicio = $request->inicio.' 00:00:00';
        $fin = $request->fin.' 23:59:59';
        $tableselect = $request->tabla;
        if ($accion === 'generar') {
            switch ($tableselect){
                case('Operaciones'):
                    return Excel::download(new OperacionExport($inicio,$fin), 'General '.$date.'.xlsx');
                case('Combustible'):
                    return Excel::download(new CombustibleExport($inicio,$fin), 'Combustible '.$date.'.xlsx');
                case('2'):
                    return Excel::download(new TrasladoExport($inicio,$fin), 'Traslado '.$date.'.xlsx');
                case('Peaje'):
                    return Excel::download(new PeajeExport($inicio,$fin), 'Peaje '.$date.'.xlsx');
                case('Otros'):
                    return Excel::download(new OtrosExport($inicio,$fin), 'Otros '.$date.'.xlsx');
                case('Cgep'):
                    return Excel::download(new CgepExport($inicio,$fin), 'Cgep '.$date.'.xlsx');
                case('6'):
                    return Excel::download(new RecargaExport($inicio,$fin), 'Recarga '.$date.'.xlsx');
                case('7'):
                    return Excel::download(new TareaExport($inicio,$fin), 'Tareas '.$date.'.xlsx');
                case('8'):
                    return Excel::download(new KitHerramientasExport($inicio,$fin), 'KitHerramientas '.$date.'.xlsx');
                case('9'):
                    return Excel::download(new EquipHerramientasExport($inicio,$fin), 'EquiposHerramientas '.$date.'.xlsx');
                case('10'):
                    return Excel::download(new ControlEppExport($inicio,$fin), 'ControlEpp '.$date.'.xlsx');
                case('11'):
                    return Excel::download(new DocumentosCamionetaExport($inicio,$fin), 'DocumentosCamioneta '.$date.'.xlsx');
                case('12'):
                    return Excel::download(new EquiposCamionetaExport($inicio,$fin), 'EquiposCamioneta '.$date.'.xlsx');
                case('13'):
                    return Excel::download(new EstadoCamionetaExport($inicio,$fin), 'EstadoCamioneta '.$date.'.xlsx');
                default:
                    return redirect('/home/reportes');
            }
        } elseif ($accion === 'previsualizacion') {
           
            $usuario = $request->input('usuarios');
            $users = UsuarioCCIP::all();
            $recargatotal = UsuarioCCIP::select('monto_total')
            ->where('id',$request->input('usuarios'))
            ->first();
            $select = "App\Models\\" . $tableselect;
            if(class_exists($select)){
                if($tableselect === "Operaciones"){
                    $columnas = [
                        'id' => 'ID',
                        'monto_total' => 'Monto Total',
                        'fecha_documento' => 'Fecha del Documento',
                        'cuadrilla' => 'Cuadrilla',
                        'concepto' => 'Concepto',
                    ];                    
                    $result = $select::select('id', 'monto_total','concepto','fecha_documento','cuadrilla')
                    ->where('usuario_id',$request->input('usuarios'))
                    ->get();
                }else{
                    $columnas = [
                        'id' => 'ID',
                        'monto_total' => 'Monto Total',
                        'fecha_documento' => 'Fecha del Documento',
                        'cuadrilla' => 'Cuadrilla',
                    ];                    
                    $result = $select::select('id', 'monto_total','fecha_documento','cuadrilla')->where('usuario_id',$request->input('usuarios'))
                    ->whereBetween('fecha_insercion', [$inicio, $fin])
                    ->get();
                }
                return view('Reportes.generar',compact('result','users','usuario','recargatotal','columnas'));
            }else{
                return redirect('/home/reportes');
            }
           
        }
    }

    public function generar(){
        $usuario = 0;
        $users = UsuarioCCIP::all();
        return view('Reportes.generar',compact('usuario','users'));
    }
}
