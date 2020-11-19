<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('home');
});

Auth::routes();

Route::GET('/pantalla/{id}', 'EquiposController@pantalla_view')->name('pantalla.view');
Route::GET('/pantalla_preview', 'EquiposController@pantalla_preview')->name('pantalla.preview');

//Route::middleware(['auth'])->group(function () {
    Route::get('/home', 'HomeController@index')->name('home');



    Route::GET('/usuarios', 'UsuariosController@index')->name('cuentas.usuario');
    Route::GET('/usuarios/create','UsuariosController@create')->name('usuarios.create');
    Route::POST('/usuarios', 'UsuariosController@store')->name('usuarios.store');
    Route::GET('/usuarios/{usuario}/edit', 'UsuariosController@edit')->name('usuarios.edit');
    Route::PUT('/usuarios/{user}', 'UsuariosController@update')->name('usuarios.update');
    Route::GET('/usuarios/{id}/activar', 'UsuariosController@activar')->name('usuarios.active');

    Route::get('/exp_usuarios', 'UsuariosController@export')->name('exports.users');

    // Rutas para seguridad
    Route::GET('/perfiles', 'RoleController@index')->name('seguridad.perfiles');
    Route::DELETE('/perfiles/{perfile}', 'RoleController@destroy')->name('perfiles.destroy');
    Route::GET('/cuenta', 'ProfileController@index')->name('perfil');
    Route::PUT('/cuenta', 'ProfileController@update')->name('perfil.update');
    Route::PUT('/perfiles/{id}/habilitar', 'RoleController@habilitar')->name('roles.habilitar');
    Route::GET('/perfiles/{perfile}/edit', 'RoleController@edit')->name('seguridad.perfiles.edit');
    Route::PUT('/perfiles/{perfile}', 'RoleController@update')->name('seguridad.perfiles.update');
    Route::GET('/perfiles/{id}/permisos', 'RoleController@permisos')->name('roles.permisos');
    Route::GET('/perfiles/{perfile}', 'RoleController@show')->name('perfiles.show');
    Route::GET('/perfil/create','RoleController@create')->name('perfiles.create');
    Route::POST('/perfiles','RoleController@store')->name('perfiles.store');

    // Rutas de Buscadores Json:
    Route::group(['prefix' => 'json'], function () {
        Route::get('/personas', 'PersonController@search')->name('json.people');
        Route::get('/personas/{person}', 'PersonController@show')->name('json.people.show');
        Route::get('/pacientes', 'PacienteController@search')->name('json.paciente');
        Route::get('/pacientes/{person}', 'PacienteController@show')->name('json.paciente.show');
        Route::get('/doctores', 'DoctorController@search')->name('json.doctor');
        Route::get('/doctores/{doctores}', 'DoctorController@show')->name('json.doctor.show');
        Route::get('/diagnostico', 'DiagnosticosController@search')->name('json.diagnostico');
        Route::get('/diagnostico/{diagnostico}', 'DiagnosticosController@show')->name('json.diagnostico.show');
        Route::get('/especialidad', 'EspecialidadController@search')->name('json.especialidad');
        Route::GET('/especialidad/{especialidad}', 'EspecialidadController@show')->name('json.especialidad.show');
    });

    Route::group(['prefix' => 'paciente'], function () {
        Route::get('/create', 'PacienteController@create')->name('paciente.create');
        Route::post('/ajax', 'PacienteController@registrar_ajax')->name('paciente.ajax');
    });

    // Rutas para habitaciones
    Route::group(['prefix' => 'habitaciones'], function() {
      /* Route::get('/{id}', 'HabitacionesController@asignar')->name('asignar.habitacion'); */
      Route::GET('/', 'HabitacionesController@index')->name('habitaciones.index');
      Route::GET('/{id}/activar', 'HabitacionesController@active')->name('habitaciones.active');
      Route::GET('/{id}/edit','HabitacionesController@edit')->name('habitaciones.edit');
      Route::PUT('/{id}', 'HabitacionesController@update')->name('habitaciones.update');
      Route::GET('/create', 'HabitacionesController@create')->name('habitaciones.create');
      Route::POST('/','HabitacionesController@store')->name('habitaciones.store');
      Route::GET('/export', 'HabitacionesController@export')->name('habitaciones.export');

      Route::POST('/mover', 'HabitacionesController@mover')->name('mover.habitacion');
    });

    Route::group(['prefix' => 'diagnosticos'], function() {
      Route::GET('/', 'DiagnosticosController@index')->name('diagnosticos.index');
      Route::GET('/ajax', 'DiagnosticosController@ajax')->name('diagnosticos.index.ajax');
      Route::GET('/{id}/activar', 'DiagnosticosController@active')->name('diagnosticos.active');
      Route::GET('/{id}', 'DiagnosticosController@edit')->name('diagnosticos.edit');
      Route::PUT('/{diagnostico}', 'DiagnosticosController@update')->name('diagnosticos.update');
      Route::GET('/nuevo/create', 'DiagnosticosController@create')->name('diagnosticos.create');
      Route::POST('/', 'DiagnosticosController@store')->name('diagnosticos.store');
      Route::get('/exp/diagnosticos', 'DiagnosticosController@export')->name('exports.diagnosticos');
    });

    Route::group(['prefix' => 'hospitalizacion'], function() {
      Route::POST('/disponible_ocupada', 'HospitalizacionController@ocupada')->name('hospitalizacion.ocupada');
      Route::POST('/estado_ocupada', 'HospitalizacionController@estado_ocupada')->name('estado.ocupada');
      Route::POST('/estado_mantenimiento', 'HospitalizacionController@estado_mantenimiento')->name('estado.mantenimiento');
      Route::POST('/estado_limpieza', 'HospitalizacionController@estado_limpieza')->name('estado.limpieza');
      Route::POST('/estado_alta','HospitalizacionController@estado_alta')->name('estado.alta');
    });

    Route::group(['prefix' => 'equipos'], function(){
      Route::GET('/', 'EquiposController@index')->name('equipos.index');
      Route::GET('/{id}/activar', 'EquiposController@activar')->name('equipos.active');
      Route::GET('/{id}/edit', 'EquiposController@edit')->name('equipos.edit');
      Route::PUT('/{id}', 'EquiposController@update')->name('equipos.update');
      Route::GET('/create', 'EquiposController@create')->name('equipos.create');
      Route::POST('/', 'EquiposController@store')->name('equipos.store');
      Route::GET('/export', 'EquiposController@export')->name('equipos.export');
    });

    Route::group(['prefix' => 'pacientes'], function(){
      Route::GET('/', 'PacienteController@index')->name('pacientes.index');
      Route::GET('/{id}/edit', 'PacienteController@edit')->name('pacientes.edit');
      Route::GET('/{id}/activar', 'PacienteController@active')->name('pacientes.active');
      Route::PUT('/{id}', 'PacienteController@update')->name('pacientes.update');
      Route::GET('/create', 'PacienteController@create')->name('pacientes.create');
      Route::POST('/', 'PacienteController@store')->name('pacientes.store');
      Route::GET('/export', 'PacienteController@export')->name('pacientes.export');
    });

    Route::group(['prefix' => 'medicos'], function(){
      Route::GET('/', 'DoctorController@index')->name('medicos.index');
      Route::GET('/{id}/edit', 'DoctorController@edit')->name('medicos.edit');
      Route::PUT('/{id}', 'DoctorController@update')->name('medicos.update');
      Route::GET('/{id}/activar', 'DoctorController@active')->name('medicos.active');
      Route::GET('/create','DoctorController@create')->name('medicos.create');
      Route::POST('/', 'DoctorController@store')->name('medicos.store');
      Route::GET('/export', 'DoctorController@export')->name('medicos.export');
    });

    Route::group(['prefix' => 'pisos'], function(){
      Route::GET('/', 'PisosController@index')->name('pisos.index');
      Route::GET('/{id}/activar', 'PisosController@active')->name('pisos.active');
      Route::GET('/{id}/edit','PisosController@edit')->name('pisos.edit');
      Route::PUT('/{id}','PisosController@update')->name('pisos.update');
      Route::GET('/create', 'PisosController@create')->name('pisos.create');
      Route::POST('/', 'PisosController@store')->name('pisos.store');
      Route::GET('/export', 'PisosController@export')->name('pisos.export');
    });




