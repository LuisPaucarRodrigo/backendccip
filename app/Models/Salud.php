<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salud extends Model
{   
    protected $fillable = [
        'usuario_id', 'grupo_sanguineo', 'peso', 'estatura', 'talla_zapato', 'talla_camisa', 'talla_pantalon', 'enfermedad', 'alergico_medicamento', 'operaciones', 'accidentes_graves', 'vacunas',
    ];
    
    use HasFactory;
    public function UsuarioCCIP(){
        return $this->belongsTo(UsuarioCCIP::class, 'usuario_id', 'id');
    }
}
