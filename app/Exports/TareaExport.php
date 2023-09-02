<?php

namespace App\Exports;

use App\Models\Tarea;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnWidths;

class TareaExport implements FromView,WithColumnWidths
{
    var $fecha_inicio = "";
    var $fecha_fin = "";
    public function __construct($inicio,$fin){
        $this->fecha_inicio = $inicio;
        $this->fecha_fin = $fin;
    }
    public function view(): View
    {
        return view('Reportes.tareas', [
            'tareas' => Tarea::with('UsuarioCCIP')->whereBetween('fechaCreacion',[$this->fecha_inicio,$this->fecha_fin])->get()
        ]);
    }
    public function columnWidths(): array{
        return [
            'A' => 5,
            'B' => 10,
            'C' => 15,
            'D' => 18,
            'E' => 18,
            'F' => 18,
            'G' => 13,
            'h' => 15,
        ];
    }
}