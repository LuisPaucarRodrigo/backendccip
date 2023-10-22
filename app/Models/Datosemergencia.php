<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Datosemergencia extends Model
{   

    protected $fillable = [
        'usuario_id', 'nombres_apellidos', 'parentesco', 'telefono',
    ];
    
    use HasFactory;
    public function UsuarioCCIP(){
        return $this->belongsTo(UsuarioCCIP::class, 'usuario_id', 'id');
    }
}
