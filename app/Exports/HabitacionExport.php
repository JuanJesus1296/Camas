<?php

namespace App\Exports;

use App\Habitacion;
use App\Estado;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class HabitacionExport implements FromView
{
    public function view(): View
    {
        return view('exports.habitaciones',[
            'estados' => Estado::all(),
            'habitaciones' => Habitacion::all()
        ]);
    }
}
