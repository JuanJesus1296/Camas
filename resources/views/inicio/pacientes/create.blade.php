@extends('layouts.plantilla')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/token-input.css')  }}">
@endpush
@section('content')
<div class="row flex-grow">
    <div class="col-md-6">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Registro de Pacientes</h4>
          <p class="card-description">
            (*) Campos obligatorios

          </p>

          <form autocomplete="off" id="form" action="{{ route('usuarios.store') }}" method="POST" class="forms-sample">
            {{ csrf_field() }}
            @include('partials.loading')
            <div class="form-group">
              <label for="name">DNI *</label>
              <input name="name"
                    id="name"
                    value="{{ old('name') }}"
                    oninput="this.value = this.value.toUpperCase()"
                    required
                    autofocus
                    type="text"
                    class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}"
                    placeholder="Nombre">
                @if ($errors->has('name'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group">
              <label for="name">Apellido Paterno *</label>
              <input name="name"
                    id="name"
                    value="{{ old('name') }}"
                    oninput="this.value = this.value.toUpperCase()"
                    required
                    autofocus
                    type="text"
                    class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}"
                    placeholder="Nombre">
                @if ($errors->has('name'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group">
                    <label for="name">Apellido Materno *</label>
                    <input name="lastname"
                          id="lastname"
                          value="{{ old('lastname') }}"
                          oninput="this.value = this.value.toUpperCase()"
                          required
                          autofocus
                          type="text"
                          class="form-control {{ $errors->has('lastname') ? ' is-invalid' : '' }}"
                          placeholder="Apellidos">
                      @if ($errors->has('lastname'))
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('lastname') }}</strong>
                          </span>
                      @endif
                  </div>
            <div class="form-group">
              <label for="name">Nombres *</label>
              <input name="dni"
                    id="datetimepicker1"
                    value="{{ old('dni') }}"
                    required
                    autofocus
                    type="text"
                    onkeyup="this.value=this.value.replace(/[^\d]/,'')"
                    minlength="8"
                    maxlength="8"
                    class="form-control datetimepicker {{ $errors->has('dni') ? ' is-invalid' : '' }}"
                    placeholder="Documento de Identidad">
                @if ($errors->has('dni'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('dni') }}</strong>
                    </span>
                @endif
            </div>

            <button type="submit" class="btn btn-success mr-2">Guardar</button>
            <a href="{{ route('cuentas.usuario') }}" class="btn btn-danger">Cancelar</a>
          </form>
        </div>
      </div>
    </div>

  </div>
@endsection
@push('scripts')
<script src="{{ asset('js/jquery.tokeninput.js')  }}"></script>
<script src="{{ asset('js/paciente_camas.js')  }}"></script>
@endpush
