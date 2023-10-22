<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Datosfamilia extends Model
{   
    protected $fillable = [
        'usuario_id', 'parentesco', 'nombres_apellidos', 'dni', 'grado_instruccion',
    ];
    
    use HasFactory;
    public function UsuarioCCIP(){
        return $this->belongsTo(UsuarioCCIP::class, 'usuario_id', 'id');
    }
}
