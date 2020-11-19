@extends('layouts.plantilla')

@section('content')
<div class="row flex-grow">
    <div class="col-md-6">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Edición de Usuarios</h4>
          <p class="card-description">
            (*) Campos obligatorios
          </p>
          <form autocomplete="off" id="form" action="{{ route('usuarios.update', $user->id) }}" method="POST" class="forms-sample">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            @include('partials.loading')


            <div class="form-group">
                    <label for="name">DNI *</label>
                    <input name="dni"
                          value="{{ $user->person->document }}"
                          required
                          autofocus
                          type="number"
                          class="form-control {{ $errors->has('dni') ? ' is-invalid' : '' }}"
                          placeholder="Documento de Identidad">
                      @if ($errors->has('dni'))
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('dni') }}</strong>
                          </span>
                      @endif
                  </div>
            <div class="form-group">
              <label for="name">Nombre *</label>
              <input name="name"
                    value="{{ $user->person->name }}"
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
            <div class="form-group">
                    <label for="lastname">Apellidos *</label>
                    <input name="lastname"
                          value="{{ $user->person->lastname }}"
                          oninput="this.value = this.value.toUpperCase()"
                          required
                          autofocus
                          type="text"
                          class="form-control {{ $errors->has('lastname') ? ' is-invalid' : '' }}"
                          placeholder="Nombre de Complicación">
                      @if ($errors->has('lastname'))
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('lastname') }}</strong>
                          </span>
                      @endif
                  </div>

            <div class="form-group">
                <label for="perfil">Perfil *</label>
                <select required name="perfil" id="perfil" class="form-control {{ $errors->has('perfil') ? ' is-invalid' : '' }}">
                  <option value="">Seleccionar Perfil de Usuario...</option>
                  @foreach ($perfiles as $perfil)
                      <option {{ $user->roles[0]['id'] == $perfil->id ? 'selected' : '' }} value="{{ $perfil->id }}">{{ $perfil->name }}</option>
                  @endforeach
                </select>
                @if ($errors->has('perfil'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('perfil') }}</strong>
                    </span>
                @endif

            </div>
            <div class="form-group">
                <label for="user">Usuario *</label>
                <input name="user"
                      value="{{ $user->username }}"
                      required
                      autofocus
                      type="text"
                      class="form-control {{ $errors->has('user') ? ' is-invalid' : '' }}"
                      placeholder="Usuario de cuenta">
                  @if ($errors->has('user'))
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('user') }}</strong>
                      </span>
                  @endif
            </div>
            <div class="form-group">
                <label for="password">Clave *</label>
                <input name="password"
                      value=""

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
