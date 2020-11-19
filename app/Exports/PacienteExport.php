<?php

namespace App\Exports;

use App\Person;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class PacienteExport implements FromView
{
    public function view(): View
    {
        return view('exports.pacientes', [
            'pacientes' => Person::all()
        ]);
    }
}
