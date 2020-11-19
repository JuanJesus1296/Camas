<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Piso;
use App\Habitacion;
use App\Hospitalizacion;
use App\Gradodependencia;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $grados = Gradodependencia::where('estado',1)->get();
        $pisos = Piso::where('estado',1)->get();
        $habitaciones = Habitacion::all();

        $ocupadas = Hospitalizacion::where('Estado','2')
                        ->where('Estado_Anulacion','1')->get();
        
        $altas = Hospitalizacion::where('Estado', '5')
                        ->where('Estado_Anulacion', '1')->get();

        return view('home', [
              'pisos' => $pisos,
              'habitaciones' => $habitaciones,
              'ocupadas' => $ocupadas, 'altas' => $altas,
              'grados' => $grados]);
    }
}
