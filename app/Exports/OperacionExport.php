<?php

namespace App\Exports;

use App\Models\Operaciones;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class OperacionExport implements FromView,WithColumnWidths,WithStyles
{
    var $fecha_inicio = "";
    var $fecha_fin = "";
    public function __construct($inicio,$fin){
        $this->fecha_inicio = $inicio;
        $this->fecha_fin = $fin;
    }
    public function view(): View
    {
        return view('Reportes.operaciones', [
            'operaciones' => Operaciones::with('UsuarioCCIP')
                ->whereBetween('fecha_insercion',[$this->fecha_inicio,$this->fecha_fin])->get()
        ]);
    }
    public function columnWidths(): array{
        return [
            'A' => 5,
            'B' => 9,
            'C' => 19,
            'D' => 15,
            'E' => 12,
            'F' => 20,
            'G' => 18,
            'H' => 16,
            'I' => 16,
            'J' => 16,
            'K' => 18,
            'L' => 14,
            'M' => 15
        ];
    }
    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            2    => ['font' => ['bold' => true]],
            'J' => [
                'numberFormat' => [
                    'formatCode' => '0.00', // Formato de dos decimales
                ],
            ],
        ];
    }
}
