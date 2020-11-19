@extends('layouts.plantilla')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/token-input.css')  }}">
@endpush
@section('content')
<div class="row flex-grow">
    <div class="col-md-12">
    <a href="{{ route('exports.users') }}" class="btn btn-dark"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Descargar</a>
      <a href="{{ route('usuarios.create') }}" class="btn btn-success float-right"><i class="fa fa-plus"></i> Agregar</a>
    </div>
</div>
<div class="row flex-grow mt-2">
        <div class="col-md-12">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Listado de Usuarios</h4>
              <table id="tbl" class="table table-striped">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>Perfil</th>
                        <th>Dni</th>
                        <th>Usuario</th>
                        <th>Estado</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        <tr>
                            <td>{{ strtoupper($user->person->name) }}</td>
                            <td>{{ strtoupper($user->person->lastname) }}</td>
                            <td>{{ $user->roles[0]->name }}</td>
                            <td>{{ $user->person->document }}</td>
                            <td>{{ $user->username }}</td>
                            <td>
                                @if ($user->estado)
                                  <span class="badge badge-success">Activo</span>
                                @else
                                  <span class="badge badge-danger">Inhabilitado</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('usuarios.edit', ['usuario' => $user->id]) }}" class="btn btn-sm btn-primary"><i class="fa fa-pencil"></i> Editar</a>
                                @if ($user->estado)
                                <a href="{{ route('usuarios.active', $user->id) }}" class="btn btn-sm btn-danger"><i class="fa fa-ban"></i> Inhabilitar</a>
                                @else
                                <a href="{{ route('usuarios.active', $user->id) }}" class="btn btn-sm btn-success"><i class="fa fa-check"></i> Habilitar</a>
                                @endif

                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">No se encontraron registros.</td>
                        </tr>
                    @endforelse
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
@endsection
@push('scripts')
    <script src="{{ asset('js/jquery.tokeninput.js')  }}"></script>
    <script src="{{ asset('js/users.js') }}"></script>
@endpush
