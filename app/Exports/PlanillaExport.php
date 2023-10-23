<?php

namespace App\Exports;

use App\Models\Planilla;
use App\Models\Typepension;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnWidths;

class PlanillaExport implements FromView,WithColumnWidths
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {   
        $usuarios = Planilla::with('UsuarioCCIP')->get();
        $afps = Typepension::select('val_csf', 'type')->get();
        return view('Reportes.planilla', compact(
            'usuarios','afps',
        ));
    }
    public function columnWidths(): array{
        return [
            'A' => 5,
            'B' => 10,
            'C' => 19,
            'D' => 19,
            'E' => 15,
            'F' => 20,
            'G' => 16,
            'H' => 16,
            'I' => 16,
            'J' => 16,
            'K' => 16,
            'L' => 16,
            'M' => 16,
            'N' => 16,
            'O' => 16,
            'P' => 16,
            'Q' => 16,
            'R' => 16,
            'S' => 16,
            'T' => 16,
            'U' => 16,
            'V' => 16,
        ];
    }


}
