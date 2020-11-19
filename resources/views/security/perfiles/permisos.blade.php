@extends('layouts.plantilla')

@section('content')
<div class="row flex-grow">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Registro de Permisos para perfil {{ $rol->name }}</h4>
            <input type="hidden" id="route" value="{{ route('perfiles.show', $rol->id) }}">
            @foreach ($permisos->chunk(4) as $chunk)
                <div class="row">
                    @foreach ($chunk as $permiso)
                        <div class="col-md-3">
                                <div class="form-check">
                                    <input {{ $rol->hasPermissionTo($permiso->name) ? 'checked' : '' }} data-id="{{ $permiso->id }}" class="form-check-input" type="checkbox" value="{{ $permiso->id }}" id="permiso{{ $permiso->id }}">
                                    <label class="form-check-label" for="permiso{{ $permiso->id }}">
                                        {{ $permiso->name }}
                                    </label>
                                </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
            <a href="{{ route('seguridad.perfiles') }}" class="btn btn-danger mt-3 float-right">Regresar</a>
        </div>
      </div>
    </div>
    
  </div>
@endsection
@push('scripts')
    <script src="{{ asset('js/permisos.js') }}"></script>
@endpush