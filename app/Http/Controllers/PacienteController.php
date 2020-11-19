<?php

namespace App\Http\Controllers;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PacienteExport;
use Illuminate\Http\Request;
use App\Person;

class PacienteController extends Controller
{
  public function index(){
    return view('pacientes.index');
  }
  
  public function search()
  {
      $q = request()->query('q');
      $people = Person::where("document", "like", "%{$q}%")
                  ->orWhere("name","like","%{$q}%")
                  ->select(\DB::raw("CONCAT(name,' ',lastname) as name, id"))->take(5)->get();
      return $people;
  }

  public function show($person)
    {
        $persona = Person::with('user')->where('id',$person)->first();
        return $persona;
    }

    public function create(){
      return view('pacientes.create');
    }

    public function store(Request $request){
      try{
        $persona = Person::firstwhere('document', $request->document);

        if( $persona ){
          return redirect()->back()->with('alert', 'El paciente ya se encuentra registrado');

        }

        $nueva_persona = new Person;
        $nueva_persona -> name = $request->name;
        $nueva_persona -> lastname = $request->lastname;
        $nueva_persona -> fullname = $request->name.' '.$request->lastname;
        $nueva_persona -> document = $request->document;
        $nueva_persona -> f_nacimiento = $request->nacimiento;
        $nueva_persona -> estado = 1;
        $nueva_persona -> created_id = auth()->user()->id;
        $nueva_persona -> created_at = date("Y-m-d H:i:s");
        $nueva_persona -> save();

          return redirect()->route('pacientes.index')->with('message','Se creó paciente correctamente');
        
      }catch( \Exception $e ) {
        dd($e->getMessage());
      }
    }

    public function registrar_ajax(Request $request){
      $apellido_paterno = $request -> POST('apellido_paterno');
      $apellido_materno = $request -> POST('apellido_materno');
      $nombre = $request->POST('nombre');
      $dni = $request->POST('dni');
      $nacimiento = $request->POST('nacimiento');

        $persona = new Person;
        $persona -> name = strtoupper($nombre);
        $persona -> lastname = strtoupper($apellido_paterno).' '.strtoupper($apellido_materno);
        $persona -> fullname = strtoupper($apellido_paterno).' '.strtoupper($apellido_materno).' '.strtoupper($nombre);
        $persona -> f_nacimiento = $nacimiento;
        $persona -> document = $dni;
        $persona -> estado = 1;
        $persona -> created_id = auth()->user()->id;
        $persona -> created_at = date("Y-m-d H:i:s");
        $persona -> save();


      return response(json_encode($persona), 200)->header('Content-type','text/plain');
    }

    public function edit($id){
      $persona = Person::find($id);
      
      if(!$persona){
        return abort(404, 'Recurso no encontrado');
      }

      return view('pacientes.edit', ['persona' => $persona]);
    }

    public function update(Request $request, $id){
      $persona = Person::find($id);

      if(!$persona){
        return abort(404, 'Recurso no encontrado');
      }

      try{
        $persona -> name = $request->name;
        $persona -> lastname = $request->lastname;
        $persona -> fullname = $request->name.' '.$request->lastname;
        $persona -> document = $request->document;
        $persona -> f_nacimiento = $request->nacimiento;
        $persona -> updated_id = auth()->user()->id;
        $persona -> updated_at = date("Y-m-d H:i:s");
        $persona -> save();
      }catch(\Exception $e ){
        dd($e->getMessage());
      }

      return redirect()->route('pacientes.index')->with('message', 'Paciente actualizado correctamente');
    }

    public function export(){
      return Excel::download(new PacienteExport, 'pacientes_gestor_camas.xls');
    }

    public function active($id){
      $persona = Person::find($id);
            if( !$persona ) {
                return abort(404, 'Recurso no encontrado');
            }
            $success = true;
            $class = 'success';
            $msg = '';
            try{
                $persona->estado = !$persona->estado;
                $persona->save();
                $msg = "Usuario actualizado correctamente";
            }catch( \Exception $e ){
                $success = false;
                $class = 'error';
                $msg = $e->getMessage();
            }
            return redirect()->route('pacientes.index')->with('message', 'Paciente actualizado correctamente');
    }
}
