@extends('layouts.plantilla')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/token-input.css')  }}">
@endpush
@section('content')
<div class="row flex-grow">
    <div class="col-md-6">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Registro de Paciente</h4><center>
            <img src="{{ asset('images/people.svg') }}" alt="" width="20%"></center><br></br>
          <p class="card-description">
            (*) Campos obligatorios

          </p>

          <form autocomplete="off" id="form" action="{{ route('pacientes.store') }}" method="POST" class="forms-sample">
            {{ csrf_field() }}
            @include('partials.loading')

            <div class="form-group">
                <label for="lastname">DNI *</label>
                <input name="document"
                      id="document"
                      value="{{ old('document') }}"
                      oninput="this.value = this.value.toUpperCase(); if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                      required
                      maxlength="8"
                      autofocus
                      type="number"
                      class="form-control {{ $errors->has('document') ? ' is-invalid' : '' }}"
                      placeholder="DNI">
                  @if ($errors->has('document'))
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('document') }}</strong>
                      </span>
                  @endif
              </div>

            <div class="form-group">
              <label for="name">Nombres *</label>
              <input name="name"
                    id="name"
                    value="{{ old('name') }}"
                    oninput="this.value = this.value.toUpperCase()"
                    required
                    autofocus
                    type="text"
                    class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}"
                    placeholder="Nombres">
                @if ($errors->has('name'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group">
                    <label for="lastname">Apellidos *</label>
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
                    <label for="nacimiento">Fecha de nacimiento *</label>
                    <input name="nacimiento"
                          id="nacimiento"
                          value="{{ old('nacimiento') }}"
                          
                          required
                          maxlength="8"
                          autofocus
                          type="date"
                          class="form-control {{ $errors->has('nacimiento') ? ' is-invalid' : '' }}"
                        >
                      @if ($errors->has('nacimiento'))
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('nacimiento') }}</strong>
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
@push('scripts')
<script src="{{ asset('js/jquery.tokeninput.js')  }}"></script>
<script src="{{ asset('js/paciente_camas.js')  }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    @if (session('alert'))
    Swal.fire(
      'El sistema informa',
      '{{session("alert")}}',
      'warning'
    )
    @endif
</script>
@endpush
