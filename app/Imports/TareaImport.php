<?php

namespace App\Imports;

use App\Models\Tarea;
use App\Models\UsuarioCCIP;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class TareaImport implements ToModel, WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    
    */
    public function startRow(): int
    {
        return 3; // Iniciar desde la tercera fila (puedes ajustarlo según tus necesidades).
    }
    
    public function model(array $row)
    {
        
        $nombreUsuario = $row[10];

        // Busca al usuario por nombre en la tabla de usuarios
        $usuario = UsuarioCCIP::where('name', $nombreUsuario)->first();
        $cadena = $row[3];
        $valores = explode(", ", $cadena);
        return new Tarea([
            'zona' => $row[0],
            'site' => $row[1],
            'titulo' => $row[2],
            'operaciones' => json_encode($valores), // Mapea la columna 'operaciones' como JSON
            'descripcion' => $row[4], // Mapea la columna 'descripcion'
            'observaciones' => $row[5], // Mapea la columna 'observaciones'
            'crqincidencias' => $row[6], // Mapea la columna 'crqincidencias'
            'fechaCreacion' => $row[7], // Mapea la columna 'fechaCreacion'
            'fechaVencimiento' => $row[8], // Mapea la columna 'fechaVencimiento'
            'state' => $row[9], // Mapea la columna 'state'
            'usuario_id' => $usuario ? $usuario->id : null, // Mapea la columna 'usuario_id'
        ]);
    }
}
