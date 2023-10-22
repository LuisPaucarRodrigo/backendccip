<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Planilla extends Model
{   
    protected $fillable = [
        'usuario_id', 'regimen_pensionario', 'sueldo_basico', 'fecha_ingreso',
    ];
    
    use HasFactory;
    public function UsuarioCCIP(){
        return $this->belongsTo(UsuarioCCIP::class, 'usuario_id', 'id');
    }
}
