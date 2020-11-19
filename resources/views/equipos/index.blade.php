@extends('layouts.plantilla')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/token-input.css')  }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
@endpush
@section('content')
<div class="row flex-grow">
    <div class="col-md-12">
    <a href="{{ route('equipos.export') }}" class="btn btn-dark"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Descargar</a>
      <a href="{{ route('equipos.create') }}" class="btn btn-success float-right"><i class="fa fa-plus"></i> Agregar</a>
    </div>
</div>
<div class="row flex-grow mt-2">
        <div class="col-md-12">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Listado de Equipos</h4>

              <table id="tabla_ajax" class="table table-striped">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Piso</th>
                        {{-- <th>IP</th> --}}
                        <th>Habitación inicio</th>
                        <th>Habitación final</th>
                        <th>Estado</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($equipos as $equipo)
                    <tr>
                        <td>{{$equipo->name}}</td>
                        <td>{{$equipo->piso->name}}</td>
                        {{-- <td>127.0.0.1</td> --}}
                        <td>{{$equipo->habitacionInicio->habitacion}}</td>
                        <td>{{$equipo->habitacionFinal->habitacion}}</td>
                        <td>
                            @if ($equipo->estado)
                                <span class="badge badge-success">Activo</span>
                            @else
                                <span class="badge badge-danger">Inhabilitado</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('equipos.edit', ['id' => $equipo->id]) }}" class="btn btn-sm btn-primary"><i class="fa fa-pencil"></i> Editar</a>
                            @if ($equipo->estado)
                                <a href="{{ route('equipos.active', $equipo->id) }}" class="btn btn-sm btn-danger"><i class="fa fa-ban"></i> Inhabilitar</a>
                            @else
                                <a href="{{ route('equipos.active', $equipo->id) }}" class="btn btn-sm btn-success"><i class="fa fa-check"></i> Habilitar</a>
                            @endif
                        </td>
                    </tr>
                    @endforeach
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
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
      <script>
        $('#tabla_ajax').DataTable();
      </script>
    <script type="text/javascript">
    @if (session('rpta') == 'success')
    Swal.fire(
      'El sistema informa',
      'Diagnóstico actualizado correctamente',
      'success'
    )
    @elseif (session('rpta') == 'success_create')
    Swal.fire(
      'El sistema informa',
      'Diagnóstico creado correctamente',
      'success'
    )
    @elseif (session('message'))
    Swal.fire(
      'El sistema informa',
      '{{session("message")}}',
      'success'
    )
    @endif
    </script>

@endpush