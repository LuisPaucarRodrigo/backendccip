<?php

namespace App\Exports;

use App\Models\Combustible;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnWidths;

class CombustibleExport implements FromView,WithColumnWidths
{
    var $fecha_inicio = "";
    var $fecha_fin = "";
    public function __construct($inicio,$fin){
        $this->fecha_inicio = $inicio;
        $this->fecha_fin = $fin;
    }
    public function view(): View
    {
        return view('Reportes.combustibles', [
            'combustible' => Combustible::with('UsuarioCCIP')->whereBetween('fecha_insercion',[$this->fecha_inicio,$this->fecha_fin])->get()
        ]);
    }
    public function columnWidths(): array{
        return [
            'A' => 5,
            'B' => 9,
            'C' => 11,
            'D' => 15,
            'E' => 15,
            'F' => 20,
            'G' => 15,
            'H' => 15,
            'I' => 50,
            'J' => 50,
            'K' => 20,
            'L' => 15,
        ];
    }
}
