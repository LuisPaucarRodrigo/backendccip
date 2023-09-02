<?php

namespace App\Exports;

use App\Models\Cgep;
use App\Models\Statecar;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnWidths;

class EstadoCamionetaExport implements FromView,WithColumnWidths
{
    var $fecha_inicio = "";
    var $fecha_fin = "";
    public function __construct($inicio,$fin){
        $this->fecha_inicio = $inicio;
        $this->fecha_fin = $fin;
    }
    public function view(): View
    {
        return view('Reportes.statecar', [
            'statecars' => Statecar::with('UsuarioCCIP')->whereBetween('fecha_insercion',[$this->fecha_inicio,$this->fecha_fin])->get()
        ]);
    }
    public function columnWidths(): array{
        return [
            'A' => 5,
            'B' => 10,
            'C' => 18,
            'D' => 15,
            'E' => 18,
            'F' => 15,
            'G' => 15,
            'H' => 15,
            'I' => 15,
            'J' => 15,
            'K' => 15,
            'L' => 15,
            'M' => 15,
            'N' => 15,
            'O' => 15,
            'P' => 15,
            'Q' => 15,
            'R' => 15,
            'S' => 15,
            'T' => 15,
            'U' => 15,
            'V' => 15,
            'W' => 35,
            'X' => 35,
            'Y' => 35,
            'Z' => 35,
            'AA' => 15,
        ];
    }
}