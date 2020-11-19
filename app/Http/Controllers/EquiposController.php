<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Equipo;
use App\Piso;
use App\Habitacion;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\EquiposExport;

class EquiposController extends Controller
{
    public function index(){
        $equipos = Equipo::all();
        return view('equipos.index', [
            'equipos' => $equipos]);
    }

    public function activar($id){
        $equipo = Equipo::find($id);
            if( !$equipo ) {
                return abort(404, 'Recurso no encontrado');
            }
            $success = true;
            $class = 'success';
            $msg = '';
            try{                
                $equipo->estado = !$equipo->estado;
                $equipo->save();
            }catch( \Exception $e ){
                $success = false;
                $class = 'error';
                $msg = $e->getMessage();
            }
            return redirect()->route('equipos.index');
    }

    public function edit($id){

        $equipo = Equipo::where('id','=',$id)->first();
        $pisos = Piso::where('estado', '1')->get();
        $habitaciones = Habitacion::all();
        if( !$equipo ) {
            return abort(404, 'Recurso no encontrado');
        }

        return view('equipos.edit', [
            'equipo' => $equipo, 'pisos' => $pisos,
            'habitaciones' => $habitaciones]);
    }


    public function update(Request $request, $id){
        $equipo = Equipo::find($id);

          if( !$equipo ) {
              return abort(404, 'Recurso no encontrado');
          }

          $success = true;
          $class = 'success';
          $msg = '';

          try{

              //Actualizamos persona
              $equipo -> name = $request -> name;
              $equipo -> piso_id = $request->piso;
              $equipo -> habitacioninicio_id = $request->habitacion_inicial;
              $equipo -> habitacionfin_id = $request->habitacion_final;
              $equipo -> updated_id = auth()->user()->id;
              $equipo -> updated_at = date("Y-m-d H:i:s");
              $equipo -> save();

          }catch( \Exception $e ){
              $success = false;
              $class = 'error';
              $msg = $e->getMessage();
          }
          return redirect()->route('equipos.index');
    }

    public function create(){
        $pisos = Piso::where('estado', '1')->get();
        $habitaciones = Habitacion::all();
        return view('equipos.create', [
            'pisos' => $pisos,
            'habitaciones' => $habitaciones
        ]);
    }

    public function store(Request $request){
        $equipo = new Equipo;
        $equipo -> name = $request -> name;
        $equipo -> piso_id = $request -> piso;
        $equipo -> estado = 1;
        $equipo -> habitacioninicio_id = $request -> habitacion_inicial;
        $equipo -> habitacionfin_id = $request -> habitacion_final;
        $equipo -> created_id = auth()->user()->id;
        $equipo -> created_at = date("Y-m-d H:i:s");
        $equipo -> save();

        return redirect()->route('equipos.index')->with('message','Equipo agregado correctamente');
    }

    public function export(){
        return Excel::download(new EquiposExport, 'equipos_gestor_camas.xlsx');
    }

    //Debe recibir como parámetro el id de la pantalla para mostrar las habitaciones
    public function pantalla_view($id){
        $equipo = Equipo::find($id);

        $habitaciones= Habitacion::where([
            ['piso_id',$equipo->piso_id],
            ['id','>=',$equipo->habitacioninicio_id],
            ['id','<=',$equipo->habitacionfin_id]
            ])->get();
        return view('pantalla', ['habitaciones' => $habitaciones, 'equipo' => $equipo]);
    }

    public function pantalla_preview(){
        $equipos = Equipo::where('estado', '1')->get();
        return view('pantalla_preview', ['equipos' => $equipos]);
    }
}
