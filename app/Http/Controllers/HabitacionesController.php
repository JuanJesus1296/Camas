<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\HabitacionExport;
use App\Habitacion;
use App\Hospitalizacion;
use App\Piso;

class HabitacionesController extends Controller
{
    public function asignar($id){
      return view('habitaciones.asignar', ['id'=>$id]);
    }

    public function index(){
      return view('habitaciones.index');
    }

    public function active($id){
      $habitacion = Habitacion::find($id);
            if( !$habitacion ) {
                return abort(404, 'Recurso no encontrado');
            }
            $success = true;
            $class = 'success';
            $msg = '';
            try{
                $habitacion->estado = !$habitacion->estado;
                $habitacion->save();
                $msg = "Usuario actualizado correctamente";
            }catch( \Exception $e ){
                $success = false;
                $class = 'error';
                $msg = $e->getMessage();
            }
            return redirect()->route('habitaciones.index')->with('success', 'Habitación actualizada correctamente');
    }

    public function edit($id){
      $habitacion = Habitacion::find($id);
      $pisos = Piso::where('estado','1')->get();

      if(!$habitacion){
        return abort(404, 'Recurso no encontrado');
      }

      return view('habitaciones.edit', [
        'habitacion'=>$habitacion,
        'pisos'=>$pisos]);
    }

    public function update(Request $request, $id){
      $habitacion = Habitacion::find($id);

      if(!$habitacion){
        return abort(404, 'Recurso no encontrado');
      }

      try{
        $habitacion -> habitacion = $request->name;
        $habitacion -> piso_id = $request->piso;
        $habitacion -> updated_id = auth()->user()->id;
        $habitacion -> updated_at = date("Y-m-d H:i:s");
        $habitacion -> save();
      }catch(\Exception $e ){
        dd($e->getMessage());
      }

      return redirect()->route('habitaciones.index')->with('success', 'Habitación actualizada correctamente');
    }

    public function create(){
      $pisos = Piso::where('estado','1')->get();
      return view('habitaciones.create', [
        'pisos' => $pisos
      ]);
    }

    public function store(Request $request){
      try{
        $habitacion = Habitacion::firstwhere('habitacion', $request->name);

        if($habitacion){
          return redirect()->route('habitaciones.index')->with('error', 'La habitación ya se encuentra registrada');
        }

        $nueva_habitacion = new Habitacion;
        $nueva_habitacion -> piso_id = $request->piso;
        $nueva_habitacion -> estado_id = 1;
        $nueva_habitacion -> habitacion = $request->name;
        $nueva_habitacion -> created_at = date("Y-m-d H:i:s");
        $nueva_habitacion -> created_id = auth()->user()->id;
        $nueva_habitacion -> estado = 1;
        $nueva_habitacion -> save();

        return redirect()->route('habitaciones.index')->with('success', 'Habitación registrada correctamente');
      }catch( \Exception $e ) {
        dd($e->getMessage());
      }
    }

    public function export(){
      return Excel::download(new HabitacionExport, 'habitaciones_gestor_camas.xls');
    }

    public function mover(Request $request){
      //dd($request->habitacion_mover_anterior);
      try{
      $habitacion_anterior = Habitacion::firstwhere('habitacion', $request->habitacion_mover_anterior);
      $habitacion = Habitacion::firstwhere('habitacion', $request->habitacion_mover);

      $hospitalizacion = Hospitalizacion::firstwhere([
        ['habitacion_id',$habitacion_anterior->id],
        ['Estado_Anulacion','1']
        ]);

      $hospitalizacion -> Estado_Anulacion = 0;
      $hospitalizacion -> updated_id = auth()->user()->id;
      $hospitalizacion -> updated_at = date("Y-m-d H:i:s");
      $hospitalizacion -> save();

      $nueva_hospitalizacion = new Hospitalizacion;
      $nueva_hospitalizacion -> OA = $hospitalizacion -> OA;
      $nueva_hospitalizacion -> Estado_Anulacion = 1;
      $nueva_hospitalizacion -> estado = '2';
      $nueva_hospitalizacion -> created_id = auth()->user()->id;
      $nueva_hospitalizacion -> created_at = date("Y-m-d H:i:s");
      $nueva_hospitalizacion -> updated_id = auth()->user()->id;
      $nueva_hospitalizacion -> updated_at = date("Y-m-d H:i:s");
      $nueva_hospitalizacion -> person_id = $hospitalizacion -> person_id;
      $nueva_hospitalizacion -> doctor_id = $hospitalizacion -> doctor_id;
      $nueva_hospitalizacion -> habitacion_id = $hospitalizacion -> habitacion_id;
      $nueva_hospitalizacion -> diagnostico_id = $hospitalizacion -> diagnostico_id;
      $nueva_hospitalizacion -> gradodependencia_id = $hospitalizacion -> gradodependencia_id;
      $nueva_hospitalizacion -> observacion = $hospitalizacion->observacion;
      $nueva_hospitalizacion -> save();

      $habitacion_anterior -> estado_id = 1;
      $habitacion_anterior -> save();
      $habitacion -> estado_id = 2;
      $habitacion -> save();
      }catch( \Exception $e ){
        dd($e->getMessage());
      }

      return redirect()->route('home')->with('success', 'Habitación actualizada correctamente');
    }
}
