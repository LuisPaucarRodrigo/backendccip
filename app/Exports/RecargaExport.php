<?php

namespace App\Exports;

use App\Models\Recarga;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithStyles;

class RecargaExport implements FromView,WithColumnWidths,WithStyles
{
    var $fecha_inicio = "";
    var $fecha_fin = "";
    public function __construct($inicio,$fin){
        $this->fecha_inicio = $inicio;
        $this->fecha_fin = $fin;
    }
    public function view(): View
    {
        return view('Reportes.recargas', [
            'recarga' => Recarga::with('UsuarioCCIP')->whereBetween('fecha_recarga',[$this->fecha_inicio,$this->fecha_fin])->get()
        ]);
    }
    public function columnWidths(): array{
        return [
            'A' => 5,
            'B' => 9,
            'C' => 12,
            'D' => 15,
            'E' => 15,
            'F' => 18,
            'G' => 18,
            'H' => 35,
            'I' => 15,
        ];
    }
    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            2    => ['font' => ['bold' => true]],
            'E' => [
                'numberFormat' => [
                    'formatCode' => '0.00', // Formato de dos decimales
                ],
            ],
        ];
    }
}