<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Domicilio extends Model
{   
    protected $fillable = [
        'usuario_id', 'distrito', 'provincia', 'departamento', 'nacionalidad', 'direccion',
    ];
    

    use HasFactory;
    public function UsuarioCCIP(){
        return $this->belongsTo(UsuarioCCIP::class, 'usuario_id', 'id');
    }
}
