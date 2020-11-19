<?php

namespace App\Exports;

use App\Diagnostico;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class DiagnosticoExport implements FromView
{

    public function view(): View
    {
        return view('exports.diagnosticos', [
          'diagnosticos' => Diagnostico::all()
        ]);
    }
}
