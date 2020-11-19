@extends('layouts.plantilla')

@section('content')
<div class="row flex-grow">
    <div class="col-md-6">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Edición de Paciente</h4><center>
          <img src="{{ asset('images/people.svg') }}" alt="" width="20%"></center><br></br>
          <p class="card-description">
            (*) Campos obligatorios
          </p>
        <form autocomplete="off" id="form" action="{{ route('pacientes.update', ['id'=>$persona->id]) }}" method="POST" class="forms-sample">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            @include('partials.loading')


            <div class="form-group">
              <label for="name">DNI *</label>
              <input name="document"
                    value="{{$persona->document}}"
                    oninput="this.value = this.value.toUpperCase(); if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                    required
                    autofocus
                    type="number"
                    maxlength="8"
                    class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}"
                    placeholder="Documento de indentidad">
                @if ($errors->has('name'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group">
                    <label for="name">Nombre *</label>
                    <input name="name"
                          value="{{$persona->name}}"
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
                    <label for="name">Apellido *</label>
                    <input name="lastname"
                          value="{{$persona->lastname}}"
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
                    <label for="nacimiento">Fecha de nacimiento *</label>
                    <input name="nacimiento"
                          value="{{$persona->f_nacimiento}}"
                          {{-- oninput="this.value = this.value.toUpperCase(); if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" --}}
                          required
                          autofocus
                          type="date"
                          {{-- maxlength="8" --}}
                          class="form-control {{ $errors->has('nacimiento') ? ' is-invalid' : '' }}"
                          {{-- placeholder="Documento de indentidad"> --}}>
                      @if ($errors->has('nacimiento'))
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('nacimiento') }}</strong>
                          </span>
                      @endif
                  </div>


            <button type="submit" class="btn btn-success mr-2">Guardar</button>
            <a href="{{ route('pacientes.index') }}" class="btn btn-danger">Cancelar</a>
          </form>
        </div>
      </div>
    </div>

  </div>
@endsection
