<?php

namespace App\Exports;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnWidths;

class TareasExportEmpty implements FromView,WithColumnWidths
{
    public function view(): View
    {
        return view('Reportes.tareasempty'); // Vista que contiene solo los encabezados de columna
    }
    public function columnWidths(): array{
        return [
            'A' => 15,
            'B' => 15,
            'C' => 18,
            'D' => 25,
            'E' => 25,
            'F' => 20,
            'G' => 25,
            'H' => 20,
            'I' => 20,
            'J' => 15,
            'K' => 15,
        ];
    }
}
