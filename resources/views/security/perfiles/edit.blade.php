@extends('layouts.plantilla')

@section('content')
<div class="row flex-grow">
    <div class="col-md-6">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Edición de Perfiles</h4><center>
          <img src="{{ asset('images/perfil.svg') }}" alt="" width="20%"></center><br></br>
          <p class="card-description">
            (*) Campos obligatorios
          </p>
          <form id="form" action="{{ route('seguridad.perfiles.update', $rol->id) }}" method="POST" class="forms-sample">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            @include('partials.loading')
            <div class="form-group">
              <label for="name">Nombre *</label>
              <input name="name" value="{{ $rol->name }}" required autofocus type="text" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}">
                @if ($errors->has('name'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>
            
            <button type="submit" class="btn btn-success mr-2">Guardar</button>
            <a href="{{ route('seguridad.perfiles') }}" class="btn btn-danger">Cancelar</a>
          </form>
        </div>
      </div>
    </div>
    
  </div>
@endsection