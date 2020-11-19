<?php

namespace App\Exports;

use App\Equipo;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class EquiposExport implements FromView
{
    public function view(): View
    {
        return view('exports.equipos',[
            'equipos' => Equipo::all()
        ]);
    }
}
