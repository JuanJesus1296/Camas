<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Person;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UserExport;

class UsuariosController extends Controller
{
      public function index(){
        $users = User::with(['person','roles'])->get();
        return view('security.usuario.index', ['users' => $users]);
      }

      public function create(){
      $perfiles = Role::all();
      return view('security.usuario.create', compact('perfiles'));
      }

      public function store(Request $request){
        $success = true;
        $class = 'success';
        $msg = '';
        try{
            $persona = Person::where('document',$request->dni)->first();
            if ( $persona ){
              // La persona ya se encuentra registrada
            }else{
              // Se procede a registrar a la persona

              $persona = Person::create([
                "name" => $request->name,
                "lastname" => $request->lastname,
                "document" => $request->dni,
                "fullname" => $request->name.' '.$request->lastname,
                "created_id" => auth()->user()->id,
                "created_at" => date("Y-m-d H:i:s"),
              ]);

            }

            //Registramos usuario
            $usuario = User::create([
                "person_id" => $persona->id,
                "username" => $request->username,
                "password" => bcrypt($request->password),
                "estado" => True,
                "ch_clave" => True
            ]);
            //Asignamos Perfil
            $perfil = Role::find($request->perfil);
            $usuario->assignRole($perfil->name);

            $msg = "{$usuario->user} registrado corectamente";
            $class = 'success';
        }catch( \Exception $e ) {

            $success = false;
            $class = 'error';
            $msg = $e->getMessage();

        }
        return redirect()->route('cuentas.usuario');
    }

    public function edit($id){
      $user = User::where('id','=',$id)->with(['person','roles'])->first();

        if( !$user ) {
            return abort(404, 'Recurso no encontrado');
        }

        $perfiles = Role::all();

        return view('security.usuario.edit', array("user" => $user, "perfiles" => $perfiles));
    }

    public function update(Request $request, $user){
        $usuario = User::find($user);

          if( !$usuario ) {
              return abort(404, 'Recurso no encontrado');
          }

          $success = true;
          $class = 'success';
          $msg = '';

          try{

              //Actualizamos persona
              $persona = $usuario->person;
              $persona->name = $request->name;
              $persona->lastname = $request->lastname;
              $persona->document = $request->dni;
              $persona->fullname = $request->name.' '.$request->lastname;
              $persona->save();

              $usuario->username = $request->user;

              if( $request->password ){
                  $usuario->password = bcrypt($request->password);
                  $usuario->ch_clave = True;
              }

              $usuario->save();

              //Asignamos Perfil
              $perfil = Role::find($request->perfil);
              $usuario->syncRoles($perfil->name);

              $msg = "{$usuario->user} actualizado correctamente";

          }catch( \Exception $e ){
              $success = false;
              $class = 'error';
              $msg = $e->getMessage();
          }
          return redirect()->route('cuentas.usuario');
      }


      public function activar($id){
          $usuario = User::find($id);
            if( !$usuario ) {
                return abort(404, 'Recurso no encontrado');
            }
            $success = true;
            $class = 'success';
            $msg = '';
            try{
                $usuario->estado = !$usuario->estado;
                $usuario->save();
                $msg = "Usuario actualizado correctamente";
            }catch( \Exception $e ){
                $success = false;
                $class = 'error';
                $msg = $e->getMessage();
            }
            return redirect()->route('cuentas.usuario');
        }


        public function export(){
          return Excel::download(new UserExport, 'usuarios_gestor_camas.xlsx');
        }

}
