<?php

namespace App\Http\Controllers;

use App\Models\Alquilercamioneta;
use App\Models\Alquilerhabitacione;
use App\Models\Alquilertercero;
use Illuminate\Http\Request;

class GastosFijosController extends Controller
{
    public function camionetaindex(){
        $alquileres = Alquilercamioneta::all();
        return view('GastosFijos.Camioneta.inicio',compact('alquileres'));
    }

    public function camionetaindexnewrent(){
        $controlgastos="Cicsa_claro_pint";
        $zona="Arequipa";
        return view('GastosFijos.Camioneta.newregister',compact('zona','controlgastos'));
    }

    public function camionetaindexsaverent(Request $request){
        $newcamioneta = new Alquilercamioneta();
        $newcamioneta -> control_gastos = $request->input('control_gastos');
        $newcamioneta -> zona = $request->input('zona');
        $newcamioneta -> nombre = $request->input('name');
        $newcamioneta -> inicio_alquiler = $request->input('inicio_alquiler');
        $newcamioneta -> fin_alquiler = $request->input('fin_alquiler');
        $newcamioneta -> costo_alquiler = $request->input('costo_alquiler');
        $newcamioneta -> garantia = $request->input('garantia');
        $newcamioneta -> contrato = $request->input('contrato');
        $newcamioneta -> fecha_pago = $request->input('fecha_pago');
        $newcamioneta -> save();
        return redirect('/gastosfijos/camioneta');
    }

    public function habitacionesindex(){
        $alquileres = Alquilerhabitacione::all();
        return view('GastosFijos.Habitaciones.inicio',compact('alquileres'));
    }

    public function habitacionesindexnewrent(){
        $controlgastos="Cicsa_claro_pint";
        $zona="Arequipa";
        return view('GastosFijos.Habitaciones.newregister',compact('zona','controlgastos'));
    }

    public function habitacionesindexsaverent(Request $request){
        $newhabitaciones = new Alquilerhabitacione();
        $newhabitaciones -> control_gastos = $request->input('control_gastos');
        $newhabitaciones -> zona = $request->input('zona');
        $newhabitaciones -> nombre = $request->input('name');
        $newhabitaciones -> inicio_alquiler = $request->input('inicio_alquiler');
        $newhabitaciones -> fin_alquiler = $request->input('fin_alquiler');
        $newhabitaciones -> costo_alquiler = $request->input('costo_alquiler');
        $newhabitaciones -> garantia = $request->input('garantia');
        $newhabitaciones -> contrato = $request->input('contrato');
        $newhabitaciones -> fecha_pago = $request->input('fecha_pago');
        $newhabitaciones -> save();
        return redirect('/gastosfijos/habitaciones');
    }

    public function tercerosindex(){
        $alquileres = Alquilertercero::all();
        return view('GastosFijos.Terceros.inicio',compact('alquileres'));
    }

    public function tercerosindexnewrent(){
        $controlgastos="Cicsa_claro_pint";
        $zona="Arequipa";
        return view('GastosFijos.Terceros.newregister',compact('zona','controlgastos'));
    }

    public function tercerosindexsaverent(Request $request){
        $newterceros = new Alquilertercero();
        $newterceros -> control_gastos = $request->input('control_gastos');
        $newterceros -> zona = $request->input('zona');
        $newterceros -> nombre = $request->input('name');
        $newterceros -> inicio_alquiler = $request->input('inicio_alquiler');
        $newterceros -> fin_alquiler = $request->input('fin_alquiler');
        $newterceros -> costo_alquiler = $request->input('costo_alquiler');
        $newterceros -> garantia = $request->input('garantia');
        $newterceros -> contrato = $request->input('contrato');
        $newterceros -> fecha_pago = $request->input('fecha_pago');
        $newterceros -> save();
        return redirect('/gastosfijos/terceros');
    }
}
