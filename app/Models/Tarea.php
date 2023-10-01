<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{
    use HasFactory;
    protected $fillable = ['zona', 'site', 'titulo','operaciones', 'descripcion', 'observaciones', 'crqincidencias', 'fechaCreacion', 'fechaVencimiento', 'state','usuario_id'];
    public function UsuarioCCIP(){
        return $this->belongsTo(UsuarioCCIP::class, 'usuario_id', 'id');
    }
}
