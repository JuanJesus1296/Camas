<?php

namespace App\Exports;

use App\Doctor;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class DoctorExport implements FromView
{
    public function view(): View
    {
        return view('exports.doctors', [
            'doctores' => Doctor::all()
        ]);
    }
}
