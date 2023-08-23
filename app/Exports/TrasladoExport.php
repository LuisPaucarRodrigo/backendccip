<?php

namespace App\Exports;

use App\Models\Traslado;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnWidths;

class TrasladoExport implements FromView, WithColumnWidths
{
    var $fecha_inicio = "";
    var $fecha_fin = "";
    public function __construct($inicio,$fin){
        $this->fecha_inicio = $inicio;
        $this->fecha_fin = $fin;
    }
    public function view(): View
    {
        return view('Reportes.traslados', [
            'traslados' => Traslado::with('UsuarioCCIP')->whereBetween('fecha_insercion',[$this->fecha_inicio,$this->fecha_fin])->get()
        ]);
    }
    public function columnWidths(): array{
        return [
            'A' => 5,
            'B' => 9,
            'C' => 15,
            'D' => 15,
            'E' => 32,
            'F' => 15,
            'G' => 10,
            'H' => 20,
            'I' => 15,
        ];
    }
}
