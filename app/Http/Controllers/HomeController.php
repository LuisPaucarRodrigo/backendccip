<?php

namespace App\Http\Controllers;

use App\Exports\CgepExport;
use App\Exports\CombustibleExport;
use App\Exports\OperacionExport;
use App\Exports\OtrosExport;
use App\Exports\PeajeExport;
use App\Exports\TrasladoExport;
use App\Exports\RecargaExport;
use App\Http\Requests\reporteRequest;
use Illuminate\Http\Request;
use App\Models\Cgep;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\UsuarioCCIP as usuarios;
use App\Models\Combustible;
use App\Models\Notification;
use App\Models\Operaciones;
use App\Models\Tarea;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use \PDF;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{   
    public function registertask(){
        $task = new Tarea();
        $task->usuario_id = request()->input('usuario_id');
        $task->titulo = request()->input('titulo');
        $task->prioridad = request()->input('prioridad');
        $task->fechaCreacion = request()->input('fechaCreacion');
        $task->fechaVencimiento = request()->input('fechaVencimiento');
        $task->mensaje = request()->input('descripcion');
        $task->save();
        return redirect('home/tareas');
    }

    public function listtareas(Request $request){
        $users = usuarios::select('id', 'name')->get();
        //dd($users);
        $usuarios = usuarios::select('id')->orderBy('id')->first();
        $usuario = $usuarios ? $usuarios->id : 0;
        $tasks = Tarea::where('usuario_id', $usuario)->get();
        if ($request->isMethod('post')) {
            $usuario_id = request()->input('usuario_id');
            $tasks = Tarea::where('usuario_id', $usuario_id)->get();
            $usuarios = usuarios::find($usuario_id);
            if ($usuarios) {
                $usuario = $usuarios->id;
            }
            //dd($usuario);
        }
        //dd($users);
        return view('Tareas.listtareas',compact('users', 'tasks','usuario'));
    }

    public function notification(Request $request){
        $notify = new Notification();
        $notify->Titulo = $request->input('notificationTitle');
        $notify->Mensaje = $request->input('notificationText');
        $notify->save();
        return redirect('/home');
    }
    public function general(Request $request){
        $countuser = usuarios::all()->count('user');
        $users = usuarios::select('id', 'name')->get();
        $usuarios = usuarios::select('id')->orderBy('id')->first();
        $usuario = $usuarios ? $usuarios->id : 0;

        $fechaActual = Carbon::now();
        $year = $fechaActual->year;
        $month = strval($fechaActual->month);
        $fechaInicioAnual = Carbon::createFromDate($year, 1, 1)->format('Y-m-d').' 00:00:00';
        $fechaFinAnual = Carbon::createFromDate($year,12, 31)->format('Y-m-d').' 23:59:59';

        $fechaInicioMensual = $fechaActual->firstOfMonth()->format('Y-m-d');
        $fechaFinMensual = $fechaActual->endOfMonth()->setHour(23)->setMinute(59)->setSecond(59)->format('Y-m-d H:i:s');

        $updateType = $request->input('updateType');

        $gastosPorCampoUsuario = [];
        foreach (['Combustible', 'Peaje', 'Otros', 'CombustibleGep'] as $concepto) {
            $gastosPorCampoUsuario[$concepto] = Operaciones::where('concepto', $concepto)
                ->where('usuario_id', $usuario)
                ->whereBetween('fecha_insercion', [$fechaInicioMensual, $fechaFinMensual])
                ->sum('gasto');
        }

        if ($request->isMethod('post')) {
            
            $yearmodify = $request->input('year');
            $fechaInicioAnual = Carbon::createFromDate($yearmodify, 1, 1)->format('Y-m-d').' 00:00:00';
            $fechaFinAnual = Carbon::createFromDate($yearmodify,12, 31)->format('Y-m-d').' 23:59:59';
            $year = $yearmodify;

            $monthmodify = $request->input('month');
            $fechaInicioMensual = Carbon::createFromDate(date('Y'), $monthmodify, 1)->format('Y-m-d').' 00:00:00';
            $fechaFinMensual = Carbon::createFromDate(date('Y'), $monthmodify)->endOfMonth()->format('Y-m-d').' 23:59:59';
            $month = $monthmodify;

            $usuariomodify = $request->input('usuario');

                foreach (['Combustible', 'Peaje', 'Otros', 'CombustibleGep'] as $concepto) {
                    $gastosPorCampoUsuario[$concepto] = Operaciones::where('concepto', $concepto)
                        ->where('usuario_id', $usuariomodify)
                        ->whereBetween('fecha_insercion', [$fechaInicioMensual, $fechaFinMensual])
                        ->sum('gasto');
                }

            $usuario = $usuariomodify;
        }

        $gastosPorAnual = Operaciones::whereBetween('fecha_insercion', [$fechaInicioAnual, $fechaFinAnual])->sum('gasto');
        // Realizar la consulta para sumar los gastos del mes actual
        $gastosPorMes = Operaciones::whereBetween('fecha_insercion', [$fechaInicioMensual, $fechaFinMensual])
                                    ->sum('gasto');
                                
        $gastosPorCampo = [];
        
        foreach (['Combustible', 'Peaje', 'Otros', 'CombustibleGep'] as $concepto) {
            $gastosPorCampo[$concepto] = Operaciones::where('concepto', $concepto)
                ->whereBetween('fecha_insercion', [$fechaInicioMensual, $fechaFinMensual])
                ->sum('gasto');
        }

        return view('General.principal',compact('gastosPorAnual', 'gastosPorMes','gastosPorCampo','gastosPorCampoUsuario','countuser','year','month','usuario','users'));
    }

    public function generate(reporteRequest $request){
        $date = Carbon::now()->format('Y-m-d');
        $inicio = $request->inicio.' 00:00:00';
        $fin = $request->fin.' 23:59:59';
        switch ($request->tabla){
            case('0'):
                return Excel::download(new OperacionExport($inicio,$fin), 'General '.$date.'.xlsx');
            case('1'):
                return Excel::download(new CombustibleExport($inicio,$fin), 'Combustible '.$date.'.xlsx');
            case('2'):
                return Excel::download(new TrasladoExport($inicio,$fin), 'Traslado '.$date.'.xlsx');
            case('3'):
                return Excel::download(new PeajeExport($inicio,$fin), 'Peaje '.$date.'.xlsx');
            case('4'):
                return Excel::download(new OtrosExport($inicio,$fin), 'Otros '.$date.'.xlsx');
            case('5'):
                return Excel::download(new CgepExport($inicio,$fin), 'Cgep '.$date.'.xlsx');
            case('6'):
                return Excel::download(new RecargaExport($inicio,$fin), 'Recarga '.$date.'.xlsx');
            default:
                return redirect('/home');
        }
        return redirect('/home');
    }

    public function generar(){
        return view('Reportes.generar');
    }

    public function generarpdf(){
        $usuarios = usuarios::all();
        // echo "El contenido de \$usuarios es: " . json_encode($usuarios);
        return view('Informes.generarpdf')->with('usuarios', $usuarios);
    }

    public function generatepdf(){
        // ... Lógica previa para obtener los datos del formulario ...
        $date = Carbon::now()->format('Y-m-d');
        $iniciopdf = request('fecha_inicio') . ' 00:00:00';
        $finalpdf = request('fecha_fin') . ' 23:59:59';
        $usuariospdf = request('usuariospdf');

        $combustibles = Combustible::where('usuario_id', $usuariospdf)
        ->whereBetween('fecha_insercion', [$iniciopdf, $finalpdf])
        ->get();

        // Pasar los datos a la vista pdf.blade.php
        $pdf = PDF::loadView('informes.pdf', [
            'usuario' => $usuariospdf,
            'fecha_Inicio' => $iniciopdf,
            'fecha_Fin' => $finalpdf,
            'combustibles' => $combustibles
        ]);

        $pdf->setPaper('letter'); // Ajusta el tamaño del papel del PDF si es necesario.

        // Descargar el PDF.
        return $pdf->download("reporte_{$date}.pdf");
    
    }
    public function downloadImageToLocal($url){
        $image = Http::timeout(180)->get($url)->body();
        $path = public_path('imagenes/') . basename($url); // Obtener el nombre del archivo de la URL
        file_put_contents($path, $image);
        return $path;
    }
}
