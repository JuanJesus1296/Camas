<?php

namespace App\Http\Controllers;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PisoExport;
use Illuminate\Http\Request;
use App\Piso;

class PisosController extends Controller
{
    public function index()
    {
        return view('pisos.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pisos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $piso = Piso::firstwhere('name', $request->name);

        if($piso){
            return redirect()->route('pisos.index')->with('error', 'Piso ya se encuentra registrado');
        }

        try{
            $nuevo_piso = new Piso;
            $nuevo_piso -> name = $request->name;
            $nuevo_piso -> estado = 1;
            $nuevo_piso -> created_id = auth()->user()->id;
            $nuevo_piso -> updated_at = date("Y-m-d H:i:s");
            $nuevo_piso -> save();

        }catch( \Exception $e ){
            dd($e->getMessage());
        }

        return redirect()->route('pisos.index')->with('success', 'Piso registrado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $piso = Piso::find($id);
        if( !$piso ) {
            return abort(404, 'Recurso no encontrado');
        }

        return view('pisos.edit', [
            'piso' => $piso]);
    }

    public function update(Request $request, $id)
    {
        $piso = Piso::find($id);
        if( !$piso ) {
            return abort(404, 'Recurso no encontrado');
        }

        $piso -> name = $request->name;
        $piso -> save();

        return redirect()->route('pisos.index')->with('success', 'Piso actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function active($id){
        $piso = Piso::find($id);
            if( !$piso ) {
                return abort(404, 'Recurso no encontrado');
            }
            $success = true;
            $class = 'success';
            $msg = '';
            try{
                $piso->estado = !$piso->estado;
                $piso->save();
                $msg = "Usuario actualizado correctamente";
            }catch( \Exception $e ){
                $success = false;
                $class = 'error';
                $msg = $e->getMessage();
            }
            return redirect()->route('pisos.index')->with('success', 'Piso actualizado correctamente');
    }

    public function export(){
        return Excel::download(new PisoExport, 'pisos_gestor_camas.xls');
    }
}
