<?php

namespace App\Exports;

use App\Models\Cgep;
use App\Models\Controlepp;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnWidths;

class ControlEppExport implements FromView,WithColumnWidths
{
    var $fecha_inicio = "";
    var $fecha_fin = "";
    public function __construct($inicio,$fin){
        $this->fecha_inicio = $inicio;
        $this->fecha_fin = $fin;
    }
    public function view(): View
    {
        return view('Reportes.controlepp', [
            'controlepps' => Controlepp::with('UsuarioCCIP')->whereBetween('fecha_insercion',[$this->fecha_inicio,$this->fecha_fin])->get()
        ]);
    }
    public function columnWidths(): array{
        return [
            'A' => 5,
            'B' => 10,
            'C' => 19,
            'D' => 15,
            'E' => 15,
            'F' => 15,
            'G' => 18,
            'H' => 15,
            'I' => 18,
            'J' => 15,
            'K' => 18,
            'L' => 15,
            'M' => 18,
            'N' => 15,
        ];
    }
}