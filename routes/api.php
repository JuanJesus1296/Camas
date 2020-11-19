<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Diagnostico;
use App\Equipo;
use App\Person;
use App\Doctor;
use App\Habitacion;
use App\Piso;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/

Route::GET('diagnosticos', function(){
 return datatables()->eloquent(Diagnostico::query())
        ->addColumn('options', function($data){
          $button = '<a href="/diagnosticos/'.$data->id.'" type="button" name="edit" id="'.$data->id.'" class="btn btn-sm btn-primary btn-sm"><i class="fa fa-pencil"></i> Editar</a>';
          $button .= '&nbsp;&nbsp;';
          if($data->estado){
            $button .= '<a href="'.route('diagnosticos.active', $id=$data->id).'" class="btn btn-sm btn-danger"><i class="fa fa-ban"></i> Inhabilitar</a>';
            return $button;
          }else{
            $button .= '<a href="'.route('diagnosticos.active', $id=$data->id).'" class="btn btn-sm btn-success"><i class="fa fa-check"></i> Habilitar</a>';
            return $button;
          }
          return $button;
        })
        ->addColumn('estado_diagnostico', function($data){
          if($data->estado){
            $button_e = '<span class="badge badge-success">Activo</span>';
            return $button_e;
          }else{
            $button_e = '<span class="badge badge-danger">Inhabilitado</span>';
            return $button_e;
          }
        })
        ->rawColumns(['options','estado_diagnostico'])->make(true);
});


Route::GET('pacientes', function(){
  return datatables()->eloquent(Person::query())
         ->addColumn('options', function($data){
           $button = '<a href="/pacientes/'.$data->id.'/edit" type="button" name="edit" id="'.$data->id.'" class="btn btn-sm btn-primary btn-sm"><i class="fa fa-pencil"></i> Editar</a>';
           $button .= '&nbsp;&nbsp;';
           if($data->estado){
             $button .= '<a href="'.route('pacientes.active', $id=$data->id).'" class="btn btn-sm btn-danger"><i class="fa fa-ban"></i> Inhabilitar</a>';
             return $button;
           }else{
             $button .= '<a href="'.route('pacientes.active', $id=$data->id).'" class="btn btn-sm btn-success"><i class="fa fa-check"></i> Habilitar</a>';
             return $button;
           }
           return $button;
         })
         ->addColumn('estado_diagnostico', function($data){
           if($data->estado){
             $button_e = '<span class="badge badge-success">Activo</span>';
             return $button_e;
           }else{
             $button_e = '<span class="badge badge-danger">Inhabilitado</span>';
             return $button_e;
           }
         })
         ->rawColumns(['options','estado_diagnostico'])->make(true);
 });


 Route::GET('doctores', function(){
   return datatables()->eloquent(Doctor::with('person'))
   ->addColumn('options', function($data){
    $button = '<a href="/medicos/'.$data->id.'/edit" type="button" name="edit" id="'.$data->id.'" class="btn btn-sm btn-primary btn-sm"><i class="fa fa-pencil"></i> Editar</a>';
    $button .= '&nbsp;&nbsp;';
    if($data->estado){
      $button .= '<a href="'.route('medicos.active', $id=$data->id).'" class="btn btn-sm btn-danger"><i class="fa fa-ban"></i> Inhabilitar</a>';
      return $button;
    }else{
      $button .= '<a href="'.route('medicos.active', $id=$data->id).'" class="btn btn-sm btn-success"><i class="fa fa-check"></i> Habilitar</a>';
      return $button;
    }
    return $button;
  })
  ->addColumn('estado_diagnostico', function($data){
    if($data->estado){
      $button_e = '<span class="badge badge-success">Activo</span>';
      return $button_e;
    }else{
      $button_e = '<span class="badge badge-danger">Inhabilitado</span>';
      return $button_e;
    }
  })
  ->rawColumns(['options','estado_diagnostico'])->make(true);
 });


 Route::GET('habitaciones', function(){
  return datatables()->eloquent(Habitacion::with('piso', 'estado'))
  ->addColumn('options', function($data){
   $button = '<a href="/habitaciones/'.$data->id.'/edit" type="button" name="edit" id="'.$data->id.'" class="btn btn-sm btn-primary btn-sm"><i class="fa fa-pencil"></i> Editar</a>';
   $button .= '&nbsp;&nbsp;';
   if($data->estado){
     $button .= '<a href="'.route('habitaciones.active', $id=$data->id).'" class="btn btn-sm btn-danger"><i class="fa fa-ban"></i> Inhabilitar</a>';
     return $button;
   }else{
     $button .= '<a href="'.route('habitaciones.active', $id=$data->id).'" class="btn btn-sm btn-success"><i class="fa fa-check"></i> Habilitar</a>';
     return $button;
   }
   return $button;
 })
 ->addColumn('estado_diagnostico', function($data){
   if($data->estado){
     $button_e = '<span class="badge badge-success">Activo</span>';
     return $button_e;
   }else{
     $button_e = '<span class="badge badge-danger">Inhabilitado</span>';
     return $button_e;
   }
 })
 ->rawColumns(['options','estado_diagnostico'])->make(true);
});


Route::GET('pisos', function(){
  return datatables()->eloquent(Piso::query())
  ->addColumn('options', function($data){
   $button = '<a href="'.route('pisos.edit', $id=$data->id).'" type="button" name="edit" id="'.$data->id.'" class="btn btn-sm btn-primary btn-sm"><i class="fa fa-pencil"></i> Editar</a>';
   $button .= '&nbsp;&nbsp;';
   if($data->estado){
     $button .= '<a href="'.route('pisos.active', $id=$data->id).'" class="btn btn-sm btn-danger"><i class="fa fa-ban"></i> Inhabilitar</a>';
     return $button;
   }else{
     $button .= '<a href="'.route('pisos.active', $id=$data->id).'" class="btn btn-sm btn-success"><i class="fa fa-check"></i> Habilitar</a>';
     return $button;
   }
   return $button;
 })
 ->addColumn('estado_diagnostico', function($data){
   if($data->estado){
     $button_e = '<span class="badge badge-success">Activo</span>';
     return $button_e;
   }else{
     $button_e = '<span class="badge badge-danger">Inhabilitado</span>';
     return $button_e;
   }
 })
 ->rawColumns(['options','estado_diagnostico'])->make(true);
});


