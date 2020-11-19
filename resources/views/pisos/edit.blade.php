@extends('layouts.plantilla')

@section('content')
<div class="row flex-grow">
    <div class="col-md-6">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Edición de Pisos</h4><center>
          <img src="{{ asset('images/pisos.svg') }}" alt="" width="20%"></center><br></br>
          <p class="card-description">
            (*) Campos obligatorios
          </p>
        <form autocomplete="off" id="form" action="{{ route('pisos.update', ['id'=>$piso->id]) }}" method="POST" class="forms-sample">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            @include('partials.loading')


            <div class="form-group">
              <label for="name">Nombre *</label>
              <input name="name"
                    value="{{$piso->name}}"
                    oninput="this.value = this.value.toUpperCase();"
                    required
                    autofocus
                    type="text"
                    class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}"
                    placeholder="Nombre de piso">
                @if ($errors->has('name'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>

            <button type="submit" class="btn btn-success mr-2">Guardar</button>
            <a href="{{ route('pisos.index') }}" class="btn btn-danger">Cancelar</a>
          </form>
        </div>
      </div>
    </div>

  </div>
@endsection
