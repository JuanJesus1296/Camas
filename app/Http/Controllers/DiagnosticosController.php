<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Diagnostico;
use Yajra\Datatables\Datatables;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DiagnosticoExport;

class DiagnosticosController extends Controller
{
    public function index(){
      return view('diagnosticos.index');
    }

    public function create(){
      return view('diagnosticos.create');
    }

    public function store(Request $request){
      $diagnostico = Diagnostico::create([
        "name" => $request -> name,
        "cie10" => $request -> cie10,
        "estado" => 1,
        "created_id" => auth()->user()->id,
        "created_at" => date("Y-m-d H:i:s"),
        "updated_id" => auth()->user()->id,
        "updated_at" => date("Y-m-d H:i:s"),
      ]);
      return redirect()->route('diagnosticos.index')->with('rpta', 'success_create');
    }

    public function edit($id){
      $diagnostico = Diagnostico::find($id);
        if( !$diagnostico ) {
            return abort(404, 'Recurso no encontrado');
        }
      return view('diagnosticos.edit', ['diagnostico'=>$diagnostico]);
    }

    public function update(Request $request, $diagnostico){
      $diagnostico = Diagnostico::find($diagnostico);
      if( !$diagnostico ) {
          return abort(404, 'Recurso no encontrado');
      }
      try{
        $diagnostico -> name =  $request -> name;
        $diagnostico -> cie10 = $request -> cie10;
        $diagnostico -> updated_id = auth()->user()->id;
        $diagnostico -> updated_at = date("Y-m-d H:i:s");
        $diagnostico -> save();
      }catch( \Exception $e ){
        $success = false;
        $class = 'error';
        $msg = $e->getMessage();
      }
      return redirect()->route('diagnosticos.index')->with('rpta', 'success');
    }

    public function ajax(){
      return Datatables::of(Diagnostico::query())->make(true);
    }

    public function active($id){
      $diagnostico = Diagnostico::find($id);
      if( !$diagnostico ){
        return abort(404, 'Recurso no encontrado');
      }
      try{
        $diagnostico->estado = !$diagnostico->estado;
        $diagnostico->save();
      }catch( \Exception $e ){
            $success = false;
            $class = 'error';
            $msg = $e->getMessage();
        }
        return redirect()->route('diagnosticos.index')->with('rpta', 'success');
    }

    public function export(){
      return Excel::download(new DiagnosticoExport, 'diagnosticos_gestor_camas.xlsx');
    }

    public function search(){
        $q = request()->query('q');
        $diagnostico = Diagnostico::where("name", "like", "%{$q}%")
                    ->select(\DB::raw("name, id"))->get();
        return $diagnostico;
    }

    public function show($diagnostico)
      {
          $diagnostico = Diagnostico::where('id',$diagnostico)->first();
          return $diagnostico;
      }
}
