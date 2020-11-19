<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Especialidad;

class EspecialidadController extends Controller
{
    public function search()
    {
        $q = request()->query('q');
        $doctor = DB::table('especialidades')
                ->Where("especialidad","like","%{$q}%")
                ->select(\DB::raw("especialidad as name, id"))->take(5)->get();
        return $doctor;
    }

    public function show($especialidad)
    {
        $especialidad = Especialidad::where('id',$especialidad)->first();
        return $especialidad;
    }
}
