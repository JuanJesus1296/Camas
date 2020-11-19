<?php

namespace App\Http\Controllers;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Requests\RoleStoreRequest;
use App\Http\Requests\RoleUpdateRequest;

class RoleController extends Controller
{
    public function index(){
        $roles = Role::all();
        return view('security.perfiles.index',  array('roles' => $roles));
    }

    public function destroy($perfile){
        $rol = Role::find($perfile);
        if( !$rol ) {
            return abort(404, 'Recurso no encontrado');
        }
        $success = true;
        $class = 'success';
        $msg = '';
        try{
            $rol->status = false;
            $rol->save();
            $msg = "{$rol->name} inhabilitado correctamente";
        }catch( \Exception $e ){
            $success = false;
            $class = 'error';
            $msg = $e->getMessage();
        }
        alert('El Sistema Informa',$msg, $class);
        return redirect()->route('seguridad.perfiles');
    }

    public function habilitar($id){
        $rol = Role::find($id);
        if( !$rol ) {
            return abort(404, 'Recurso no encontrado');
        }
        $success = true;
        $class = 'success';
        $msg = '';
        try{
            $rol->status = true;
            $rol->save();
            $msg = "{$rol->name} habilitado correctamente";
        }catch( \Exception $e ){
            $success = false;
            $class = 'error';
            $msg = $e->getMessage();
        }
        alert('El Sistema Informa',$msg, $class);
        return redirect()->route('seguridad.perfiles');
    }

    public function edit($role){
        $rol = Role::find($role);
        if( !$rol ){
            return abort(404, 'Recurso no encontrado');
        }
        return view('security.perfiles.edit', array('rol' => $rol));
    }

    public function update(RoleUpdateRequest $request, $role){
        $rol = Role::find($role);
        if( !$rol ) { return abort(404, 'Recurso no encontrado'); }

        $success = true;
        $class = 'success';
        $msg = '';
        try{
            $rol->name = $request->name;
            $rol->save();
            $msg = "{$rol->name} actualizado correctamente";
        }catch( \Exception $e ){
            $success = false;
            $class = 'error';
            $msg = $e->getMessage();
        }
        alert('El Sistema Informa',$msg, $class);
        return redirect()->route('seguridad.perfiles');
    }

    public function permisos($role){
        $rol = Role::find($role);
        $permisos = Permission::all();

        return view('security.perfiles.permisos', compact('rol','permisos'));
    }

    public function show($perfile){
        $msg = null;
        try {
            $perfile = Role::find($perfile);
            $permiso = Permission::find(request()->permiso);
            if( $perfile->hasPermissionTo($permiso->name) )
            {
                // Lo borramos
                $perfile->revokePermissionTo($permiso->name);
                $msg = "Permiso {$permiso->name} eliminado a {$perfile->name}";
            }else {
                // Lo agregamos
                $perfile->givePermissionTo($permiso->name);
                $msg = "Permiso {$permiso->name} otorgado a {$perfile->name}";
            }
        }catch( \Exception $e ){
            $msg = $e->getMessage();
        }
        return response()->json([
            'msg' => $msg
        ]);
    }

    public function create(){
        return view('security.perfiles.create');
    }

    public function store(RoleStoreRequest $request){
        $success = true;
        $class = 'success';
        $msg = '';
        try{
            $role = Role::create(['name' => $request->name, "created_at" => date("Y-m-d H:i:s"), "updated_at" => date("Y-m-d H:i:s"),]);
            $msg = "{$role->name} registrado corectamente";
            $class = 'success';
        }catch( \Exception $e ) {
            $success = false;
            $class = 'error';
            $msg = $e->getMessage();
        }
        return redirect()->route('seguridad.perfiles');
    }
}
