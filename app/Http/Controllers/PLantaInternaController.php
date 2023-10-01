<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tarea;
use Carbon\Carbon;

class PLantaInternaController extends Controller
{
    public function controlgastos(Request $request){
        // Obtener todos los datos de Mantenimiento para todas las zonas
        if ($request->isMethod('get')) {
            $state = "Iniciar";
            $fechaActual = Carbon::now();
            $month = strval($fechaActual->month);
            $fechaInicioMensual = $fechaActual->firstOfMonth()->format('Y-m-d');
            $fechaFinMensual = $fechaActual->endOfMonth()->setHour(23)->setMinute(59)->setSecond(59)->format('Y-m-d H:i:s');
        }

        // Verificar si es una solicitud POST
        if ($request->isMethod('post')) {
            $state = $request->input('stateselect');
            $month = $request->input('mounthselect');
            $fechaInicioMensual = Carbon::createFromDate(date('Y'), $month, 1)->format('Y-m-d').' 00:00:00';
            $fechaFinMensual = Carbon::createFromDate(date('Y'), $month)->endOfMonth()->format('Y-m-d').' 23:59:59';
        }
        $data = Tarea::where("titulo", "Mantenimiento")
            ->whereIn("zona", ["Arequipa", "Chala", "MDD1", "Moquegua", "MDD2"])
            ->whereBetween('created_at', [$fechaInicioMensual, $fechaFinMensual])
            ->where('state',$state)
            ->select('operaciones', 'zona')
            ->get();

        $dataincidencia = Tarea::where("titulo", "Incidencia")
            ->whereIn("zona", ["Arequipa", "Chala", "MDD1", "Moquegua", "MDD2"])
            ->whereBetween('created_at', [$fechaInicioMensual, $fechaFinMensual])
            ->where('state',$state)
            ->select('operaciones', 'zona')
            ->get();

        // Inicializar un array para almacenar los recuentos de operaciones por zona
        $recuentoOperaciones = [];

        // Definir las operaciones que deseas contar
        $operacionesDeseadas = ["1RA", "2DA", "AA", "GEE", "TX"];

        // Inicializar el recuento para cada operación en cada zona
        foreach ($operacionesDeseadas as $operacion) {
            foreach (["Arequipa", "Chala", "MDD1", "Moquegua", "MDD2"] as $zona) {
                $recuentoOperaciones[$zona][$operacion] = 0;
            }
        }

        // Realizar el conteo de operaciones para todas las zonas
        foreach ($data as $dato) {
            $zona = $dato->zona;
            $operacionJson = json_decode($dato->operaciones, true);

            // Verificar si la operación existe en el JSON y contarla
            foreach ($operacionJson as $operacion) {
                if (in_array($operacion, $operacionesDeseadas)) {
                    $recuentoOperaciones[$zona][$operacion]++;
                }
            }
        }


        // Inicializar un array para almacenar los recuentos de operaciones por zona
        $recuentoOperacionesincidencia = [];

        // Definir las operaciones que deseas contar
        $operacionesDeseadasincidencia = [        "Afectado",
        "Corte",
        "Incidencia",
        "Instalacion",
        "Revision",
        "RRU Afectada",
        "Alarma de corte",
        "Corte Programado",
        "Log de Alarmas",
        "Ventana",
        "Vswr"];

        // Inicializar el recuento para cada operación en cada zona
        foreach ($operacionesDeseadasincidencia as $operacionincidencia) {
            foreach (["Arequipa", "Chala", "MDD1", "Moquegua", "MDD2"] as $zona) {
                $recuentoOperacionesincidencia[$zona][$operacionincidencia] = 0;
            }
        }

        // Realizar el conteo de operaciones para todas las zonas
        foreach ($dataincidencia as $dato) {
            $zona = $dato->zona;
            $operacionJsonindidencia = json_decode($dato->operaciones, true);

            // Verificar si la operación existe en el JSON y contarla
            foreach ($operacionJsonindidencia as $operacionincidencia) {
                if (in_array($operacionincidencia, $operacionesDeseadasincidencia)) {
                    $recuentoOperacionesincidencia[$zona][$operacionincidencia]++;
                }
            }
        }

        return view('PlantaInterna.controlgastos', compact('recuentoOperaciones','recuentoOperacionesincidencia','state','month'));
    }
}
