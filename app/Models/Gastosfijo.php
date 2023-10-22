<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gastosfijo extends Model
{
    use HasFactory;
    protected $fillable = [
        'monto_pagado', 
        'tipo_alquiler',
        'control_gastos',
        'zona',
        'proveedor',
        'inicio_alquiler',
        'fin_alquiler',
        'costo_alquiler',
        'garantia',
        'contrato',
        'fecha_pago',
        'state',
        'numero_operacion',
        'fecha_pagado',
        'descripcion'
    ];
}
