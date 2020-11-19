@extends('layouts.plantilla')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/token-input.css')  }}">
@endpush

@section('content')
<div class="row flex-grow">
    <div class="col-md-6">
      <div class="card">
        <div class="card-body">
          @if ( session('mensaje') )
          <div class="alert alert-success alert-dismissible fade show" role="alert">
          <center>  {{ session('mensaje') }} </center>
          </div>
          @endif
          <div class="row">
            <div class="col-sm-6">
              <h4 class="card-title">Consultorio {{$id}}</h4>
            </div>
            <div class="col-sm-6">
            <button type="button" class="btn btn-success" style="float: right" name="button">Agregar Paciente</button>
            </div>
            </div>




          @if ($errors->any())
                <div class="alert alert-danger" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

          <p class="card-description">
            (*) Campos obligatorios
          </p>
          <form id="form" action="{{ route('perfil.update') }}" method="POST" class="forms-sample">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            <div class="form-group">
                <label for="">Buscar Paciente: </label>
                <input autofocus type="text" id="search" name="search" />
                <input type="hidden" id="ruta_search" value="{{ route('json.paciente') }}">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Paciente *</label>
              <input name="name"
                    value="{{strtoupper(auth()->user()->person->name)}}"
                    required
                    autofocus
                    type="text"
                    class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}"
                    placeholder="Nombre de Complicación">

            </div>
            <div class="form-group">
                    <label for="name">Estado *</label>
                    <input name="dni"
                          value="{{auth()->user()->person->document}}"
                          required
                          type="number"
                          class="form-control {{ $errors->has('dni') ? ' is-invalid' : '' }}"
                          placeholder="Documento de Identidad">

            </div>

            <div class="form-group">
                    <label for="name">Diagnóstico *</label>
                    <input name="dni"
                          value="{{auth()->user()->person->document}}"
                          required
                          type="number"
                          class="form-control {{ $errors->has('dni') ? ' is-invalid' : '' }}"
                          placeholder="Documento de Identidad">

            </div>

            <div class="form-group">
                    <label for="name">Gra. Depe. *</label>
                    <input name="dni"
                          value="{{auth()->user()->person->document}}"
                          required
                          type="number"
                          class="form-control {{ $errors->has('dni') ? ' is-invalid' : '' }}"
                          placeholder="Documento de Identidad">

            </div>

            <div class="form-group">
                    <label for="name">Médico *</label>
                    <input name="dni"
                          value="{{auth()->user()->person->document}}"
                          required
                          type="number"
                          class="form-control {{ $errors->has('dni') ? ' is-invalid' : '' }}"
                          placeholder="Documento de Identidad">

            </div>

            <div class="form-group">
                    <label for="user">Observación *</label>
                    <input name="user"
                          value="{{auth()->user()->username}}"
                          required
                          type="text"
                          class="form-control {{ $errors->has('user') ? ' is-invalid' : '' }}"
                          placeholder="Usuario de cuenta">

            </div>

            <button type="submit" class="btn btn-success mr-2">Guardar</button>
            <a href="{{ route('home') }}" class="btn btn-danger">Cancelar</a>
          </form>
        </div>
      </div>
    </div>

  </div>
@endsection

@push('scripts')
<script src="{{ asset('js/jquery.tokeninput.js')  }}"></script>
<script src="{{ asset('js/users.js')  }}"></script>
@endpush
