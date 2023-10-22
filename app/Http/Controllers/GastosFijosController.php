<?php

namespace App\Http\Controllers;

use App\Models\Gastosfijo;
use App\Models\Supplier;
use Illuminate\Http\Request;


class GastosFijosController extends Controller
{   
    public function gastosfijosindex($type){
        if ($type === "Camionetas") {
            $alquileres = Gastosfijo::where('state', 'Deuda')->where('tipo_alquiler', 'Camionetas')->get();
            return view('GastosFijos.Camioneta.inicio', compact('alquileres'));
        } elseif ($type === "Habitaciones") {
            $alquileres = Gastosfijo::where('state', 'Deuda')->where('tipo_alquiler', 'Habitaciones')->get();
            return view('GastosFijos.Habitaciones.inicio', compact('alquileres'));
        } else {
            $alquileres = Gastosfijo::where('state', 'Deuda')->where('tipo_alquiler', 'Terceros')->get();
            return view('GastosFijos.Terceros.inicio', compact('alquileres'));
        }

    }

    public function gastosfijosnewregistro($type){
        if ($type === "Camionetas") {
            $suppliers = Supplier::select('razon_social', 'id')->get();
            return view('GastosFijos.Camioneta.newregister',compact('suppliers'));
        } elseif ($type === "Habitaciones") {
            $suppliers = Supplier::select('razon_social', 'id')->get();
            return view('GastosFijos.Habitaciones.newregister',compact('suppliers'));
        }else {
            $suppliers = Supplier::select('razon_social', 'id')->get();
            return view('GastosFijos.Terceros.newregister',compact('suppliers'));
        }
    }

    public function gastosfijoscreate(Request $request){
        $type = $request->input('type_gasto');
        $newcamioneta = new Gastosfijo();
        $newcamioneta -> tipo_alquiler = $type;
        $newcamioneta -> control_gastos = $request->input('control_gastos');
        $newcamioneta -> zona = $request->input('zona');
        $newcamioneta -> proveedor = $request->input('name');
        $newcamioneta -> inicio_alquiler = $request->input('inicio_alquiler');
        $newcamioneta -> fin_alquiler = $request->input('fin_alquiler');
        $newcamioneta -> costo_alquiler = $request->input('costo_alquiler');
        $newcamioneta -> garantia = $request->input('garantia');
        $newcamioneta -> contrato = $request->input('contrato');
        $newcamioneta -> fecha_pago = $request->input('fecha_pago');
        $newcamioneta -> save();
        return redirect("/gastosfijos/alquileres/{$type}");
    }

    public function gastosfijospago(Request $request){
        $type = $request->input('type');
        $monto_pagado = $request->input('monto');
        $id = $request->input('id');
        
        $pagogastofijo = Gastosfijo::find($id);
        
        if ($pagogastofijo && $monto_pagado == $pagogastofijo->costo_alquiler) {
            $pagogastofijo->update([
                'monto_pagado' => $monto_pagado,
                'numero_operacion' => $request->input('operacion'),
                'fecha_pagado' => $request->input('fecha'),
                'descripcion' => $request->input('descripcion'),
                'state' => 'Pagado',
            ]);
        
            // Establecer el mensaje de éxito y el tipo de mensaje
            $message = 'El pago se realizó correctamente.';
            $message_type = 'alert-success';
        } else {
            // Establecer el mensaje de error y el tipo de mensaje
            $message = 'No se pudo procesar el pago.';
            $message_type = 'alert-danger';
        }
        
        // Redireccionar con el mensaje y el tipo de mensaje
        return redirect("/gastosfijos/alquileres/{$type}")
            ->with('message', $message)
            ->with('message_type', $message_type);        
        
    }

    public function proveedoresindex(){
        $suppliers = Supplier::all();
        return view('GastosFijos.Proveedores.index',compact('suppliers'));
    }

    public function proveedoresindexnewrent(){
        return view('GastosFijos.Proveedores.newproveedor');
    }

    public function proveedoresindexsaverent(Request $request){
        $supplier = new Supplier();
        $supplier->razon_social = $request->input('razon_social');
        $supplier->telefono = $request->input('telefono');
        $supplier->correo = $request->input('correo');
        $supplier->numero_cuenta = $request->input('numero_cuenta');
        $supplier->banco = $request->input('banco');
        $supplier->rubro = $request->input('rubro');
        $supplier->subrubro = $request->input('subrubro');
        $supplier->contacto = $request->input('contacto');
        $supplier->save();
        return redirect('/gastosfijos/proveedores');    
    }

    public function proveedoreseditar($id){
        $supplier = Supplier::find($id);
        return view('GastosFijos.Proveedores.editar',compact('supplier'));
    }

    public function proveedoresupdate(Request $request){
        $supplier = Supplier::find($request->input('id'));
        $supplier->razon_social = $request->input('razon_social');
        $supplier->telefono = $request->input('telefono');
        $supplier->correo = $request->input('correo');
        $supplier->numero_cuenta = $request->input('numero_cuenta');
        $supplier->banco = $request->input('banco');
        $supplier->rubro = $request->input('rubro');
        $supplier->subrubro = $request->input('subrubro');
        $supplier->contacto = $request->input('contacto');
        $supplier->save();
        return redirect('/gastosfijos/proveedores');
    }

    public function proveedoresdestroy($id){
        $supplier = Supplier::find($id);
        $supplier->delete();
        return redirect('/gastosfijos/proveedores');
    }
}
