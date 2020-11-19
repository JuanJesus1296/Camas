@extends('layouts.plantilla')

@section('content')
<div class="row flex-grow">
    <div class="col-md-6">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Edición de Diagnósticos</h4><center>
          <img src="{{ asset('images/diagnostico.jpg') }}" alt="" width="50%" style="border-radius: 50%;"></center><br></br>
          <p class="card-description">
            (*) Campos obligatorios
          </p>
          <form autocomplete="off" id="form" action="{{route('diagnosticos.update', $diagnostico->id)}}" method="POST" class="forms-sample">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            @include('partials.loading')

            <div class="form-group">
                    <label for="name">CIE10 *</label>
                    <input name="cie10"
                          value="{{$diagnostico->cie10}}"
                          oninput="this.value = this.value.toUpperCase()"
                          required
                          autofocus
                          type="text"
                          class="form-control {{ $errors->has('cie10') ? ' is-invalid' : '' }}"
                          placeholder="Documento de Identidad">
                      @if ($errors->has('dni'))
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('cie10') }}</strong>
                          </span>
                      @endif
                  </div>
            <div class="form-group">
              <label for="name">Nombre *</label>
              <input name="name"
                    value="{{$diagnostico->name}}"
                    oninput="this.value = this.value.toUpperCase()"
                    required
                    autofocus
                    type="text"
                    class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}"
                    placeholder="Nombre de Complicación">
                @if ($errors->has('name'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>


            <button type="submit" class="btn btn-success mr-2">Guardar</button>
            <a href="{{ route('diagnosticos.index') }}" class="btn btn-danger">Cancelar</a>
          </form>
        </div>
      </div>
    </div>

  </div>
@endsection
