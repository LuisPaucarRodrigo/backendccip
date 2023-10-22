<?php

namespace App\Exports;

use App\Models\Combustible;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class CombustibleExport implements FromView,WithColumnWidths,WithStyles
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
            'C' => 17,
            'D' => 11,
            'E' => 15,
            'F' => 15,
            'G' => 20,
            'H' => 15,
            'I' => 15,
            'J' => 50,
            'K' => 50,
            'L' => 20,
            'M' => 15,
        ];
    }
    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            2    => ['font' => ['bold' => true]],
            'H' => [
                'numberFormat' => [
                    'formatCode' => '0.00', // Formato de dos decimales
                ],
            ],
        ];
    }
}
