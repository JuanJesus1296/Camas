@extends('layouts.plantilla')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/token-input.css')  }}">
@endpush
@section('content')
<div class="row flex-grow">
    <div class="col-md-6">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Registro de Usuarios</h4>
          <p class="card-description">
            (*) Campos obligatorios

          </p>

          <form autocomplete="off" id="form" action="{{ route('usuarios.store') }}" method="POST" class="forms-sample">
            {{ csrf_field() }}
            @include('partials.loading')
            <div class="form-group">
                <label for="">Buscar Persona: </label>
                <input autofocus type="text" id="search" name="search" />
                <input type="hidden" id="ruta_search" value="{{ route('json.paciente') }}">
            </div>
            <div class="form-group">
              <label for="name">Nombre *</label>
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
                    <label for="name">Apellidos *</label>
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
              <label for="name">DNI *</label>
              <input name="dni"
                    id="dni"
                    value="{{ old('dni') }}"
                    required
                    autofocus
                    type="text"
                    onkeyup="this.value=this.value.replace(/[^\d]/,'')"
                    minlength="8"
                    maxlength="8"
                    class="form-control {{ $errors->has('dni') ? ' is-invalid' : '' }}"
                    placeholder="Documento de Identidad">
                @if ($errors->has('dni'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('dni') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group">
                <label for="perfil">Perfil *</label>
                <select required name="perfil" id="perfil" class="form-control {{ $errors->has('perfil') ? ' is-invalid' : '' }}">
                  <option value="">Seleccionar Perfil de Usuario...</option>
                  @foreach ($perfiles as $perfil)
                      <option value="{{ $perfil->id }}">{{ $perfil->name }}</option>
                  @endforeach
                </select>
                @if ($errors->has('perfil'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('perfil') }}</strong>
                    </span>
                @endif

            </div>
            <div class="form-group">
                <label for="username">Usuario *</label>
                <input name="username"
                      value="{{ old('username') }}"
                      required
                      autofocus
                      type="text"
                      class="form-control {{ $errors->has('username') ? ' is-invalid' : '' }}"
                      placeholder="Usuario de cuenta">
                  @if ($errors->has('username'))
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('username') }}</strong>
                      </span>
                  @endif
            </div>
            <div class="form-group">
                <label for="password">Clave *</label>
                <input name="password"
                      value=""
                      required
                      autofocus
                      type="password"
                      class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}"
                      placeholder="Clave Segura">
                      <small>* Mínimo 6 caracteres.</small>
                  @if ($errors->has('password'))
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('password') }}</strong>
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
