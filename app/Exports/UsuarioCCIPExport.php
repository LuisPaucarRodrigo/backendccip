<?php

namespace App\Exports;

use App\Models\UsuarioCCIP;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnWidths;

class UsuarioCCIPExport implements FromView,WithColumnWidths
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('Reportes.saldonegativo', [
            'saldonegativos' => UsuarioCCIP::where('saldo','<',0)->get()
        ]);
    }
    public function columnWidths(): array{
        return [
            'A' => 5,
            'B' => 10,
            'C' => 19,
            'D' => 19,
            'E' => 15,
            'F' => 25,
            'G' => 15,
            'H' => 15,
            'I' => 15,
        ];
    }
}
