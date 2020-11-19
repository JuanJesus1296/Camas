<?php

namespace App\Http\Controllers;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DoctorExport;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Doctor;
use App\Person;

class DoctorController extends Controller
{
    public function index(){
        return view('doctors.index');
    }

    public function edit($id){
        $doctor = Doctor::find($id);
      
      if(!$doctor){
        return abort(404, 'Recurso no encontrado');
      }

      return view('doctors.edit', ['doctor' => $doctor]);
    }

    public function update(Request $request, $id){
        $doctor = Doctor::find($id);
        
        if(!$doctor){
            return abort(404, 'Recurso no encontrado');
        }

        try{
        
            $doctor -> cmp = $request->cmp;
            $doctor -> rne = $request->rne;
            if(!is_null($request->especialidad)) $doctor -> especialidad_id = $request->id_especialidad;
            $doctor -> updated_id = auth()->user()->id;
            $doctor -> updated_at = date("Y-m-d H:i:s");
            $doctor -> save();

        }catch(\Exception $e ){
            dd($e->getMessage());
        }

        return redirect()->route('medicos.index')->with('success', 'Médico actualizado correctamente');
    }
  
    public function search(){
      $q = request()->query('q');
      $doctor = DB::table('doctors')
                ->join('people', 'doctors.person_id', '=', 'people.id')
                ->Where("people.fullname","like","%{$q}%")
                ->select(\DB::raw("people.fullname as name, doctors.id"))->take(5)->get();
      return $doctor;
    }

    public function show($doctor){
        $doctor = Doctor::where('id',$doctor)->first();
        return $doctor;
    }

    public function create(){
        return view('doctors.create');
    }

    public function store(Request $request){
        $persona = Person::find($request->id_buscador);
        if($persona->doctor){
            return redirect()->route('medicos.index')->with('error', 'Médico ya se encuentra registrado');
        }
        
        try{
            $nuevo_doctor = new Doctor;
            $nuevo_doctor -> person_id = $request->id_buscador;
            $nuevo_doctor -> cmp = $request->cmp;
            $nuevo_doctor -> rne = $request->rne;
            $nuevo_doctor -> estado = 1;
            $nuevo_doctor -> created_id = auth()->user()->id;
            $nuevo_doctor -> created_at = date("Y-m-d H:i:s");
            $nuevo_doctor -> especialidad_id = $request->id_especialidad;
            $nuevo_doctor -> save();
        }catch(\Exception $e ){
            dd($e->getMessage());
        }

        return redirect()->route('medicos.index')->with('success','Médico registrado correctamente');
    }

    public function export(){
        return Excel::download(new DoctorExport, 'medico_gestor_camas.xls');
    }
}
