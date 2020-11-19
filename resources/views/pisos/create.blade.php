@extends('layouts.plantilla')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/token-input.css')  }}">
@endpush

@section('content')
<div class="row flex-grow">
    <div class="col-md-6">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Crear Piso</h4><center>
          <img src="{{ asset('images/pisos.svg') }}" alt="" width="20%"></center><br></br>
          <p class="card-description">
            (*) Campos obligatorios
          </p>
        <form autocomplete="off" id="form" action="{{ route('pisos.store') }}" method="POST" class="forms-sample">
            {{ csrf_field() }}
            @include('partials.loading')


            <div class="form-group">
                <label for="name">Nombre *</label>
                <input name="name"
                      oninput="this.value = this.value.toUpperCase();"
                      required
                      autofocus
                      type="text"
                      class="form-control {{ $errors->has('cmp') ? ' is-invalid' : '' }}"
                      placeholder="Nombre">
                  @if ($errors->has('cmp'))
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('cmp') }}</strong>
                      </span>
                  @endif
              </div>


            <button type="submit" class="btn btn-success mr-2">Guardar</button>
            <a href="{{ route('habitaciones.index') }}" class="btn btn-danger">Cancelar</a>
          </form>
        </div>
      </div>
    </div>

  </div>
@endsection

@push('scripts')
<script src="{{ asset('js/jquery.tokeninput.js')  }}"></script>
<script src="{{ asset('js/especialidad.js') }}"></script>
@endpush
