@extends('layouts.plantilla')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/token-input.css')  }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
@endpush
@section('content')
<div class="row flex-grow">
    <div class="col-md-12">
    <a href="{{ route('exports.diagnosticos') }}" class="btn btn-dark"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Descargar</a>
      <a href="{{ route('diagnosticos.create') }}" class="btn btn-success float-right"><i class="fa fa-plus"></i> Agregar</a>
    </div>
</div>
<div class="row flex-grow mt-2">
        <div class="col-md-12">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Listado de Diagnósticos</h4>

              <table id="tabla_ajax" class="table table-striped">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>CIE10</th>
                        <th>Estado</th>
                        <th>Opciones</th>
                    </tr>
                </thead>

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
    <script type="text/javascript">
    $(document).ready(function(){
      $('#tabla_ajax').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": "{{ url('api/diagnosticos') }}",
        "columns":[
          {data: "name"},
          {data: "cie10"},
          {data: "estado_diagnostico"},
          {data: "options"},
        ]
      });
    });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

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
    @endif
    </script>

@endpush
