@extends('layouts.plantilla')

@push('styles')

@endpush

@section('content')
<div class="row flex-grow">
    <div class="col-md-6">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Edición de Habitaciones</h4><center>
          <img src="{{ asset('images/habitacion.svg') }}" alt="" width="20%"></center><br></br>
          <p class="card-description">
            (*) Campos obligatorios
          </p>
        <form autocomplete="off" id="form" action="{{ route('habitaciones.update', ['id'=>$habitacion->id]) }}" method="POST" class="forms-sample">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            @include('partials.loading')


            <div class="form-group">
              <label for="name">Nombre *</label>
              <input name="name"
                    value="{{$habitacion->habitacion}}"
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

            <div class="form-group">
                    <label for="rne">Piso *</label>
                    <select class="form-control" name="piso" id="piso">
                        @foreach ($pisos as $piso)
                        @if ($habitacion->piso_id == $piso->id)
                        <option value="{{$piso->id}}" selected>{{$piso->name}}</option>
                        @else
                        <option value="{{$piso->id}}">{{$piso->name}}</option>
                        @endif
                    @endforeach
                    </select>
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

@endpush
