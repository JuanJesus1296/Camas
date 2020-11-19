<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Hospitalizacion;
use App\Person;
use App\Habitacion;

class HospitalizacionController extends Controller
{
    public function ocupada(Request $request){
      if ($request->estado == 3){
        $habitacion = Habitacion::firstwhere('habitacion',$request->habitacion);
        $habitacion -> estado_id = 3;
        $habitacion -> updated_id = auth()->user()->id;
        $habitacion -> updated_at = date("Y-m-d H:i:s");
        $habitacion -> save();
        return redirect('home')->with('message', 'Habitación cambió de estado a Mantenimiento');
      }elseif( $request->estado == 4 ){
        $habitacion = Habitacion::firstwhere('habitacion',$request->habitacion);
        $habitacion -> estado_id = 4;
        $habitacion -> updated_id = auth()->user()->id;
        $habitacion -> updated_at = date("Y-m-d H:i:s");
        $habitacion -> save();
        return redirect('home')->with('message', 'Habitación cambió de estado a Limpieza');
      }elseif( $request->estado_hidden == 2){      
        $oa = str_pad($request -> oa, 10, "0", STR_PAD_LEFT);
        $habitacion = Habitacion::firstwhere('habitacion', $request->habitacion);

        // Se registra la hospitalización
        $paciente = Person::firstwhere('document',$request -> dni_paciente);
        $hospitalizacion = new Hospitalizacion;
        $hospitalizacion -> oa = $oa;
        $hospitalizacion -> estado = '2';
        $hospitalizacion -> Estado_Anulacion = '1';
        $hospitalizacion -> created_id = auth()->user()->id;
        $hospitalizacion -> created_at = date("Y-m-d H:i:s");
        $hospitalizacion -> updated_id = auth()->user()->id;
        $hospitalizacion -> updated_at = date("Y-m-d H:i:s");
        $hospitalizacion -> person_id = $paciente->id;
        $hospitalizacion -> doctor_id = $request->id_doctor;
        $hospitalizacion -> habitacion_id = $habitacion->id;
        $hospitalizacion -> diagnostico_id = $request->id_diagnostico;
        $hospitalizacion -> gradodependencia_id = $request->grade;
        $hospitalizacion -> observacion = $request->observacion;
        $hospitalizacion -> save();

        // Se actualiza estado de habitación
        $habitacion -> estado_id = '2';
        $habitacion -> save();

        return redirect('home')->with('message', 'success_ocupada');
      }
    }

    public function estado_ocupada(Request $request){
      if( $request->selector == 99){
        $hospitalizacion = Hospitalizacion::find($request->id_hospitalizacion);
        $hospitalizacion -> Estado_Anulacion = 0;
        $hospitalizacion -> save();

        $nueva_hospitalizacion = new Hospitalizacion;
        $nueva_hospitalizacion -> OA = $hospitalizacion -> OA;
        $nueva_hospitalizacion -> Estado_Anulacion = 0;
        $nueva_hospitalizacion -> estado = '1002';
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

        $habitacion = Habitacion::find($hospitalizacion->habitacion_id);
        $habitacion -> estado_id = 1;
        $habitacion -> save();

        return redirect('home')->with('message', 'estado_ocupada_anulada');
      }elseif( $request->selector == 2 ){
        $hospitalizacion = Hospitalizacion::find($request->id_hospitalizacion);
        $hospitalizacion -> gradodependencia_id = $request -> grado_ocupada;
        if(!is_null($request->diagnostico_nuevo_ocupado)) $hospitalizacion -> diagnostico_id = $request->diagnostico_nuevo_ocupado;
        if(!is_null($request->medico_nuevo_ocupado)) $hospitalizacion -> doctor_id = $request->medico_nuevo_ocupado;
        $hospitalizacion -> save();

        return redirect('home')->with('message', 'estado_ocupada_actualizada');
      }elseif($request->selector == 5){
        $hospitalizacion = Hospitalizacion::find($request->id_hospitalizacion);
        $hospitalizacion -> Estado_Anulacion = 0;
        $hospitalizacion -> save();

        $nueva_hospitalizacion = new Hospitalizacion;
        $nueva_hospitalizacion -> OA = $hospitalizacion -> OA;
        $nueva_hospitalizacion -> Estado_Anulacion = 1;
        $nueva_hospitalizacion -> estado = '5';
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

        $habitacion = Habitacion::find($hospitalizacion->habitacion_id);
        $habitacion -> estado_id = 5;
        $habitacion -> save();

        return redirect('home')->with('message', 'Habitación cambió de estado a Alta Administrativa');
      }


      return redirect('home');
    }

    public function estado_mantenimiento(Request $request){
      if($request->estado_mantenimiento == 1){
        $habitacion = Habitacion::firstwhere('habitacion', $request->habitacion_mantenimiento);
        $habitacion -> estado_id = 1;
        $habitacion -> updated_id = auth()->user()->id;
        $habitacion -> updated_at = date("Y-m-d H:i:s");
        $habitacion -> save();
        return redirect('home')->with('message', 'Habitación cambió de estado a Disponible');
      }elseif ($request->estado_mantenimiento == 4){
        $habitacion = Habitacion::firstwhere('habitacion', $request->habitacion_mantenimiento);
        $habitacion -> estado_id = 4;
        $habitacion -> updated_id = auth()->user()->id;
        $habitacion -> updated_at = date("Y-m-d H:i:s");
        $habitacion -> save();
        return redirect('home')->with('message', 'Habitación cambió de estado a Limpieza');
      }
    }

    public function estado_limpieza(Request $request){
      if($request->estado_limpieza == 1){
        $habitacion = Habitacion::firstwhere('habitacion', $request->habitacion_limpieza);
        $habitacion -> estado_id = 1;
        $habitacion -> updated_id = auth()->user()->id;
        $habitacion -> updated_at = date("Y-m-d H:i:s");
        $habitacion -> save();
        return redirect('home')->with('message', 'Habitación cambió de estado a Disponible');
      }else{
        return redirect('home')->with('message', 'No se realizaron cambios de estado');
      }
    }

    public function estado_alta(Request $request){
      if($request->estado_alta == 5){
        $hospitalizacion = Hospitalizacion::firstwhere([
          ['id',$request->id_hospitalizacion_alta],
          ['Estado_Anulacion',1]
          ]);
        $hospitalizacion -> gradodependencia_id = $request -> grado_alta;
        if(!is_null($request->diagnostico_nuevo_ocupado)) $hospitalizacion -> diagnostico_id = $request->diagnostico_nuevo_alta;
        if(!is_null($request->medico_nuevo_ocupado)) $hospitalizacion -> doctor_id = $request->medico_nuevo_alta;
        $hospitalizacion -> observacion = $request -> observacion_alta;
        $hospitalizacion -> save();

        return redirect('home')->with('message', 'Habitación actualizada correctamente');
      }elseif($request->estado_alta == 3 || $request->estado == 4){
        $habitacion = Habitacion::firstwhere('habitacion', $request->habitacion_alta);
        $habitacion -> estado_id = $request->estado_alta;
        $habitacion -> updated_id = auth()->user()->id;
        $habitacion -> updated_at = date("Y-m-d H:i:s");
        $habitacion -> save();

        $hospitalizacion = Hospitalizacion::firstwhere([
          ['id',$request->id_hospitalizacion_alta],
          ['Estado_Anulacion',1]
          ]);
        $hospitalizacion -> Estado_Anulacion = 0;
        $hospitalizacion -> updated_id = auth()->user()->id;
        $hospitalizacion -> updated_at = date("Y-m-d H:i:s");
        $hospitalizacion -> save();

          return redirect('home')->with('message', 'Habitación actualizada correctamente');
      }
      elseif($request->estado_alta == 1){
        $habitacion = Habitacion::firstwhere('habitacion', $request->habitacion_alta);
        $habitacion -> estado_id = $request->estado_alta;
        $habitacion -> updated_id = auth()->user()->id;
        $habitacion -> updated_at = date("Y-m-d H:i:s");
        $habitacion -> save();

        $hospitalizacion = Hospitalizacion::firstwhere([
          ['id',$request->id_hospitalizacion_alta],
          ['Estado_Anulacion',1]
          ]);
        $hospitalizacion -> Estado_Anulacion = 0;
        $hospitalizacion -> updated_id = auth()->user()->id;
        $hospitalizacion -> updated_at = date("Y-m-d H:i:s");
        $hospitalizacion -> save();

          return redirect('home')->with('message', 'Habitación actualizada correctamente');
      }
    }
}
