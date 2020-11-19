@extends('layouts.plantilla')

@section('content')
<div class="row flex-grow">
    <div class="col-md-6">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Registro de Perfiles</h4><center>
            <img src="{{ asset('images/perfil.svg') }}" alt="" width="20%"></center><br></br>
          <p class="card-description">
            (*) Campos obligatorios
          </p>
          <form id="form" action="{{ route('perfiles.store') }}" method="POST" class="forms-sample">
            {{ csrf_field() }}
            @include('partials.loading')
            <div class="form-group">
              <label for="exampleInputEmail1">Nombre *</label>
              <input name="name" 
                    value="{{ old('name') }}" 
                    required 
                    autofocus 
                    type="text" 
                    class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" 
                    placeholder="Nombre de Perfil">
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
