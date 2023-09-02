<?php

namespace App\Exports;

use App\Models\Cgep;
use App\Models\Kittoll;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnWidths;

class KitHerramientasExport implements FromView,WithColumnWidths
{
    var $fecha_inicio = "";
    var $fecha_fin = "";
    public function __construct($inicio,$fin){
        $this->fecha_inicio = $inicio;
        $this->fecha_fin = $fin;
    }
    public function view(): View
    {
        return view('Reportes.kittolls', [
            'kittolls' => Kittoll::with('UsuarioCCIP')->whereBetween('fecha_insercion',[$this->fecha_inicio,$this->fecha_fin])->get()
        ]);
    }
    public function columnWidths(): array{
        return [
            'A' => 5,
            'B' => 10,
            'C' => 19,
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
            'W' => 15,
            'X' => 15,
            'Y' => 15,
            'Z' => 15,
            'AA' => 15,
            'AB' => 15,
            'AC' => 15,
            'AD' => 15,
            'AE' => 15,
            'AF' => 15,
            'AG' => 15,
            'AH' => 15,
            'AI' => 15,
            'AJ' => 15,
            'AK' => 15,
            'AL' => 15,
            'AM' => 15,
            'AN' => 15,
            'AO' => 15,
            'AP' => 15,
            'AQ' => 15,
            'AR' => 15,
            'AS' => 15,
            'AT' => 15,
            'AU' => 15,
            'AV' => 15,
            'AW' => 15,
            'AX' => 15,
            'AY' => 15,
            'AZ' => 15,
            'BA' => 15,
            'BB' => 15,
            'BC' => 15,
            'BD' => 15,
            'BE' => 15,
            'BF' => 15,
            'BG' => 15,
        ];
    }
}