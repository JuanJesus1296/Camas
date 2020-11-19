<?php

namespace App\Exports;

use App\Piso;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class PisoExport implements FromView
{
    public function view(): View
    {
        return view('exports.pisos',[
            'pisos' => Piso::all()
        ]);
    }
}
