@extends('layouts.plantilla')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/token-input.css')  }}">
@endpush

@section('content')
<div class="row flex-grow">
    <div class="col-md-6">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Edición de Doctores</h4><center>
          <img src="{{ asset('images/medico.svg') }}" alt="" width="20%"></center><br></br>
          <p class="card-description">
            (*) Campos obligatorios
          </p>
        <form autocomplete="off" id="form" action="{{ route('medicos.store') }}" method="POST" class="forms-sample">
            {{ csrf_field() }}
            @include('partials.loading')


            <div class="form-group" id="divNuevaEspecialidad" style="">       
                <label for="buscador">DNI / Nombres *</label>
                <input autofocus type="text" class="form-control" id="buscador" name="buscador" value="">
                  <input type="hidden" id="ruta_search_buscador" value="{{ route('json.people') }}">
                  <input type="hidden" id="id_buscador" name="id_buscador" value="">
            </div>


            <div class="form-group">
              <label for="cmp">CMP *</label>
              <input name="cmp"
                    oninput="this.value = this.value.toUpperCase(); if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                    required
                    autofocus
                    type="number"
                    maxlength="8"
                    class="form-control {{ $errors->has('cmp') ? ' is-invalid' : '' }}"
                    placeholder="Número CMP">
                @if ($errors->has('cmp'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('cmp') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group">
                    <label for="rne">RNE *</label>
                    <input name="rne"
                          oninput="this.value = this.value.toUpperCase()"
                          autofocus
                          type="number"
                          class="form-control {{ $errors->has('rne') ? ' is-invalid' : '' }}"
                          placeholder="Número RNE">
                      @if ($errors->has('rne'))
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('rne') }}</strong>
                          </span>
                      @endif
                  </div>

                  <div class="form-group" id="divNuevaEspecialidad" style="">
                   
                    <label for="especialidad">Especialidad *</label>
                    <input autofocus type="text" class="form-control" id="especialidad" name="especialidad"
                          value="">
                      <input type="hidden" id="ruta_search_especialidad" value="{{ route('json.especialidad') }}">
                      <input type="hidden" id="id_especialidad" name="id_especialidad" value="">
                      
                    
                  </div>

            <button type="submit" class="btn btn-success mr-2">Guardar</button>
            <a href="{{ route('medicos.index') }}" class="btn btn-danger">Cancelar</a>
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
