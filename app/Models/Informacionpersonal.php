<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Informacionpersonal extends Model
{   
    protected $fillable = [
        'usuario_id', 'sexo', 'estado_civil', 'fecha_nacimiento', 'telefono_movil1', 'telefono_movil2', 'correo_personal', 'foto',
    ];
    
    use HasFactory;
    public function UsuarioCCIP(){
        return $this->belongsTo(UsuarioCCIP::class, 'usuario_id', 'id');
    }
}
