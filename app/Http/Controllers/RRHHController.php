<?php

namespace App\Http\Controllers;

use App\Models\Informacionusuario;
use Illuminate\Http\Request;

class RRHHController extends Controller
{
    public function planillaindex(){
        return view('RRHH.planilla');
    }

    public function personalindex(){
        
        return view('RRHH.personal');
    }
    
    public function personalindexnewregister(Request $request){
        $informacionadicional = new Informacionusuario();
        $informacionadicional->regimen_pensionario = $request->input('regimen_pensionario');
        $informacionadicional->fecha_ingreso = $request->input('fecha_ingreso');
        $informacionadicional->sueldo_base = $request->input('sueldo_base');
        $informacionadicional->institucion_carrera = $request->input('institucion_carrera');
        $informacionadicional->donde_estudio = $request->input('donde_estudio');
        $informacionadicional->carrera_estudio = $request->input('carrera_estudio');
        $informacionadicional->condicion_magister = $request->input('condicion_magister');
        $informacionadicional->tiene_carga_familiar = $request->has('tiene_carga_familiar');
        $informacionadicional->save();
        return redirect('/rrhh/personal');
    }
}
