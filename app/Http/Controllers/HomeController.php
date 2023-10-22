<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\UsuarioCCIP;
use App\Models\Notification;
use App\Models\Operaciones;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use \PDF;
use Illuminate\Support\Facades\Auth;
use Psy\Readline\Hoa\Console;

class HomeController extends Controller
{

    public function notification(Request $request)
    {
        $notify = new Notification();
        $notify->Titulo = $request->input('notificationTitle');
        $notify->Mensaje = $request->input('notificationText');
        $notify->save();
        return redirect('/home');
    }

    public function actualizargraficusers(Request $request)
    {
        $fechaActual = Carbon::now();
        $gastosPorCampoUsuariojs = [];
        $usuariomodify = $request->input('usuario');
        $monthmodify = $request->input('month');
        $cuadrilla = $request->input('zona');
        $year = $request->input('year');
        $fechaInicioMensual = $fechaActual->createFromDate($year, $monthmodify, 1)->format('Y-m-d') . ' 00:00:00';
        $fechaFinMensual = $fechaActual->createFromDate($year, $monthmodify)->endOfMonth()->format('Y-m-d') . ' 23:59:59';

        foreach (['Combustible', 'Peaje', 'Otros', 'CombustibleGep'] as $concepto) {
            $gastosPorCampoUsuariojs[$concepto] = Operaciones::where('concepto', $concepto)
                ->where('usuario_id', $usuariomodify)
                ->where('cuadrilla', $cuadrilla)
                ->whereBetween('fecha_insercion', [$fechaInicioMensual, $fechaFinMensual])
                ->sum('monto_total');
        }
        $gastototalusersjs = 0;

        foreach ($gastosPorCampoUsuariojs as $gasto) {
            $gastototalusersjs += $gasto;
        }

        $responsegrafic = [
            'gastosPorCampoUsuariojs' => $gastosPorCampoUsuariojs,
            'gastototalusers' => $gastototalusersjs,
        ];
        return response()->json($responsegrafic);
    }

    public function actualizar(Request $request)
    {
        $concept = $request->input('concepto');
        $cuadrilla = $request->input('zona');
        $monthmodify = $request->input('month');
        $year = $request->input('year');
        $gastosPorCampojs = [];

        for ($month = 1; $month <= 12; $month++) {
            $fechaInicioMes = Carbon::createFromDate($year, $month, 1)->format('Y-m-d') . ' 00:00:00';
            $fechaFinMes = Carbon::createFromDate($year, $month)->endOfMonth()->format('Y-m-d') . ' 23:59:59';

            $gastosPorCampojs[$month] = Operaciones::where('concepto', $concept)
                ->where('cuadrilla', $cuadrilla)
                ->whereBetween('fecha_insercion', [$fechaInicioMes, $fechaFinMes])
                ->sum('monto_total');
        }
        $fechaInicioAnual = Carbon::createFromDate($year, 1, 1)->format('Y-m-d') . ' 00:00:00';
        $fechaFinAnual = Carbon::createFromDate($year, 12, 31)->format('Y-m-d') . ' 23:59:59';

        $fechaInicioMensual = Carbon::createFromDate($year, $monthmodify, 1)->format('Y-m-d') . ' 00:00:00';
        $fechaFinMensual = Carbon::createFromDate($year, $monthmodify)->endOfMonth()->format('Y-m-d') . ' 23:59:59';

        $gastosPorAnual = Operaciones::whereBetween('fecha_insercion', [$fechaInicioAnual, $fechaFinAnual])->sum('monto_total');
        $gastosPorMes = Operaciones::whereBetween('fecha_insercion', [$fechaInicioMensual, $fechaFinMensual])
            ->sum('monto_total');

        $gastosPorCuadrilla = Operaciones::whereBetween('fecha_insercion', [$fechaInicioMensual, $fechaFinMensual])
            ->where('cuadrilla', $cuadrilla)
            ->sum('monto_total');



        $response = [
            'gastosPorCuadrilla' => $gastosPorCuadrilla,
            'gastosPorCampojs' => $gastosPorCampojs,
            'gastosPorAnual' => $gastosPorAnual,
            'gastosPorMes' => $gastosPorMes,
        ];
        return response()->json($response);
    }


    public function general(Request $request)
    {
        $countuser = UsuarioCCIP::all()->count('user');
        $users = UsuarioCCIP::select('id', 'name')->get();
        $usuarios = UsuarioCCIP::select('id')->orderBy('id')->first();
        $usuario = $usuarios ? $usuarios->id : 0;
        $fechaActual = Carbon::now();
        $year = $fechaActual->year;
        $month = strval($fechaActual->month);
        $month2 = strval($fechaActual->month);
        $concept = "Combustible";
        $zona = "Arequipa";
        $fechaInicioAnual = Carbon::createFromDate($year, 1, 1)->format('Y-m-d') . ' 00:00:00';
        $fechaFinAnual = Carbon::createFromDate($year, 12, 31)->format('Y-m-d') . ' 23:59:59';

        $fechaInicioMensual = $fechaActual->firstOfMonth()->format('Y-m-d');
        $fechaFinMensual = $fechaActual->endOfMonth()->setHour(23)->setMinute(59)->setSecond(59)->format('Y-m-d H:i:s');

        $updateType = $request->input('updateType');

        $gastosPorCampoUsuario = [];
        foreach (['Combustible', 'Peaje', 'Otros', 'CombustibleGep'] as $concepto) {
            $gastosPorCampoUsuario[$concepto] = Operaciones::where('concepto', $concepto)
                ->where('usuario_id', $usuario)
                ->where('cuadrilla', $zona)
                ->whereBetween('fecha_insercion', [$fechaInicioMensual, $fechaFinMensual])
                ->sum('monto_total');
        }

        $gastosPorCampo = [];
        for ($month = 1; $month <= 12; $month++) {
            $fechaInicioMes = Carbon::createFromDate($year, $month, 1)->format('Y-m-d') . ' 00:00:00';
            $fechaFinMes = Carbon::createFromDate($year, $month)->endOfMonth()->format('Y-m-d') . ' 23:59:59';

            $gastosPorCampo[$month] = Operaciones::where('concepto', $concept)
                ->where('cuadrilla', $zona)
                ->whereBetween('fecha_insercion', [$fechaInicioMes, $fechaFinMes])
                ->sum('monto_total');
        }
        //dd($gastosPorCampoUsuario);
        $gastototalusers = 0;

        foreach ($gastosPorCampoUsuario as $gasto) {
            $gastototalusers += $gasto;
        }

        //dd($gastototalusers);

        if ($request->isMethod('post')) {
            $concept = $request->input('concepto');
            $yearmodify = $request->input('year');
            $monthmodify = $request->input('month');
            $zona = $request->input('zona');
            $usuariomodify = $request->input('usuario');

            for ($month = 1; $month <= 12; $month++) {
                $fechaInicioMes = Carbon::createFromDate($yearmodify, $month, 1)->format('Y-m-d') . ' 00:00:00';
                $fechaFinMes = Carbon::createFromDate($yearmodify, $month)->endOfMonth()->format('Y-m-d') . ' 23:59:59';

                $gastosPorCampo[$month] = Operaciones::where('concepto', $concept)
                    ->where('cuadrilla', $zona)
                    ->whereBetween('fecha_insercion', [$fechaInicioMes, $fechaFinMes])
                    ->sum('monto_total');
            }

            $fechaInicioAnual = Carbon::createFromDate($yearmodify, 1, 1)->format('Y-m-d') . ' 00:00:00';
            $fechaFinAnual = Carbon::createFromDate($yearmodify, 12, 31)->format('Y-m-d') . ' 23:59:59';
            $year = $yearmodify;

            $fechaInicioMensual = Carbon::createFromDate($yearmodify, $monthmodify, 1)->format('Y-m-d') . ' 00:00:00';
            $fechaFinMensual = Carbon::createFromDate(date('Y'), $monthmodify)->endOfMonth()->format('Y-m-d') . ' 23:59:59';
            $month2 = $monthmodify;


            foreach (['Combustible', 'Peaje', 'Otros', 'CombustibleGep'] as $concepto) {
                $gastosPorCampoUsuario[$concepto] = Operaciones::where('concepto', $concepto)
                    ->where('usuario_id', $usuariomodify)
                    ->where('cuadrilla', $zona)
                    ->whereBetween('fecha_insercion', [$fechaInicioMensual, $fechaFinMensual])
                    ->sum('monto_total');
            }

            $usuario = $usuariomodify;
        }

        $gastosPorAnual = Operaciones::whereBetween('fecha_insercion', [$fechaInicioAnual, $fechaFinAnual])->sum('monto_total');

        $gastosPorMes = Operaciones::whereBetween('fecha_insercion', [$fechaInicioMensual, $fechaFinMensual])
            ->sum('monto_total');

        $gastosPorCuadrilla = Operaciones::whereBetween('fecha_insercion', [$fechaInicioMensual, $fechaFinMensual])
            ->where('cuadrilla', $zona)
            ->sum('monto_total');

        return view('General.principal', compact('gastototalusers', 'gastosPorAnual', 'gastosPorMes', 'gastosPorCuadrilla', 'zona', 'gastosPorCampo', 'gastosPorCampoUsuario', 'countuser', 'year', 'month2', 'usuario', 'users', 'concept'));
    }

    public function generarpdf()
    {
        $usuarios = UsuarioCCIP::all();
        // echo "El contenido de \$usuarios es: " . json_encode($usuarios);
        return view('Informes.generarpdf')->with('usuarios', $usuarios);
    }

    public function downloadImageToLocal($url)
    {
        $image = Http::timeout(180)->get($url)->body();
        $path = public_path('imagenes/') . basename($url); // Obtener el nombre del archivo de la URL
        file_put_contents($path, $image);
        return $path;
    }
}
