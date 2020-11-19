@extends('layouts.plantilla')

@section('content')
<div class="row flex-grow">
    <div class="col-md-12">
      <a href="{{ route('perfiles.create') }}" class="btn btn-success float-right"><i class="fa fa-plus"></i> Agregar</a>
    </div>
</div>

<div class="row flex-grow mt-2">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Listado de Perfiles</h4>
          <input type="hidden" id="route" value="#">
          <table id="tbl" class="table table-striped">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($roles as $role)
                    <tr>
                        <td>{{ $role->name }}</td>
                        <td>
                            <a href="{{ route('seguridad.perfiles.edit', ['perfile' => $role->id]) }}" class="btn btn-sm btn-primary"><i class="fa fa-pencil"></i> Editar</a>
                            <a href="{{ route('roles.permisos', ['id' => $role->id]) }}" class="btn btn-sm btn-info"><i class="fa fa-lock"></i> Permisos</a>
                            
                            @if ($role->status)
                                <form class="mt-2" action="{{ route('perfiles.destroy', $role->id) }}" method="POST" style="display: inline">
                                  {{ csrf_field() }}
                                  {{ method_field('DELETE') }}
                                  <button type="submit"  class="btn btn-danger btn-sm"><i class="fa fa-ban" aria-hidden="true"></i> Inhabilitar</button>
                                </form>
                            @else
                            <form class="mt-2" action="{{ route('roles.habilitar', $role->id) }}" method="POST" style="display: inline">
                              {{ csrf_field() }}
                              {{ method_field('PUT') }}
                              <button type="submit"  class="btn btn-success btn-sm"><i class="fa fa-check-square-o" aria-hidden="true"></i> Habilitar</button>
                            </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">No se encontraron registros.</td>
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
<script src="{{ asset('js/roles.js') }}"></script>
@endpush