@extends('layouts.plantilla')

@section('content')
<div class="row flex-grow">
    <div class="col-md-6">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Edición de Equipos</h4>
          <p class="card-description">
            (*) Campos obligatorios
          </p>
        <form autocomplete="off" name="form" id="form" action="{{ route('equipos.update', ['id' => $equipo->id]) }}" method="POST" class="forms-sample" onsubmit="validacion_habitaciones(event, this);">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            


            <div class="form-group">
                    <label for="name">Nombre *</label>
                    <input name="name"
                          value="{{ $equipo->name }}"
                          required
                          autofocus
                          type="text"
                          class="form-control {{ $errors->has('dni') ? ' is-invalid' : '' }}"
                          >
                      @if ($errors->has('dni'))
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('dni') }}</strong>
                          </span>
                      @endif
                  </div>
            <div class="form-group">
              <label for="name">Piso *</label>
              <select class="form-control" name="piso" id="piso" onchange="cambiar_piso(this)">
                  @foreach($pisos as $piso)
                    @if($piso->id == $equipo->piso_id)
                        <option value="{{$piso->id}}" selected>{{$piso->name}}</option>
                    @else
                        <option value="{{$piso->id}}">{{$piso->name}}</option>
                    @endif
                  @endforeach
              </select>
            </div>

            
            <div class="row">
                <div class="col-sm">
                    <div class="form-group">
                        <label for="name">Habitación inicial *</label>
                        <select class="form-control" name="habitacion_inicial" id="habitacion_inicial">
                            @foreach($habitaciones as $habitacion)
                            @if($habitacion->id == $equipo->habitacioninicio_id)
                            <option value="{{$habitacion->id}}" piso="{{$habitacion->piso_id}}" selected style="">{{$habitacion->habitacion}}</option>
                            @else
                                @if ($habitacion->piso_id == $equipo->piso_id)
                                <option value="{{$habitacion->id}}" piso="{{$habitacion->piso_id}}" style="">{{$habitacion->habitacion}}</option>
                                @else
                                <option value="{{$habitacion->id}}" piso="{{$habitacion->piso_id}}" hidden>{{$habitacion->habitacion}}</option>
                                @endif
                            @endif
                            @endforeach
                        </select>
                      </div>
                  </div>
                  <div class="col-sm">
                    <div class="form-group">
                        <label for="name">Habitación final *</label>
                        <select class="form-control" name="habitacion_final" id="habitacion_final">
                            @foreach($habitaciones as $habitacion)
                            @if ($habitacion->id == $equipo->habitacionfin_id)
                            <option value="{{$habitacion->id}}" piso="{{$habitacion->piso_id}}" selected>{{$habitacion->habitacion}}</option>
                            @else
                                @if ($habitacion->piso_id == $equipo->piso_id)
                                <option value="{{$habitacion->id}}" piso="{{$habitacion->piso_id}}" style="">{{$habitacion->habitacion}}</option>
                                @else
                                <option value="{{$habitacion->id}}" piso="{{$habitacion->piso_id}}" hidden>{{$habitacion->habitacion}}</option>
                                @endif
                            @endif
                            @endforeach
                        </select>
                      </div>
                  </div>
            </div>
        


            <button class="btn btn-success mr-2">Guardar</button>
            <a href="{{ route('equipos.index') }}" class="btn btn-danger">Cancelar</a>
          </form>
        </div>
      </div>
    </div>

  </div>
@endsection

@push('scripts')
<script>
    function cambiar_piso(elem){
        
        var sel = document.getElementById('habitacion_inicial');
        for (var i = 0; i < sel.options.length; i++ ){
            var opt = sel.options[i]
            if ( opt.hidden === true ) {
                // SE OCULTAN TODOS LAS HABITACIONES
                //opt.removeAttribute("hidden");
                @foreach($pisos as $piso)
                //var hid = document.createAttribute("hidden");
                //opt.setAttributeNode(hid);

                //if(elem.value != '{{$piso->id}}' && opt.piso  ){
                if(opt.getAttribute('piso') == '{{$piso->id}}' && opt.getAttribute('piso') == elem.value ){
                    // SE MUESTRAN LAS HABITACIONES QUE NO SEAN DEL PISO SELECCIONADO
                    opt.removeAttribute('hidden');
                    //div.setAttribute("style","");                    
                }
                @endforeach
            
            // LOS OPTIONS QUE NO TIENEN ATRIBUTO HIDDEN
            }else{
                var hid = document.createAttribute("hidden");
                opt.setAttributeNode(hid);
            }
        }

        var sel2 = document.getElementById('habitacion_final');
        for (var i2 = 0; i2 < sel2.options.length; i2++ ){
            var opt2 = sel2.options[i2]
            if ( opt2.hidden === true ) {
                // SE OCULTAN TODOS LAS HABITACIONES
                //opt.removeAttribute("hidden");
                @foreach($pisos as $piso)
                //var hid = document.createAttribute("hidden");
                //opt.setAttributeNode(hid);

                //if(elem.value != '{{$piso->id}}' && opt.piso  ){
                if(opt2.getAttribute('piso') == '{{$piso->id}}' && opt2.getAttribute('piso') == elem.value ){
                    // SE MUESTRAN LAS HABITACIONES QUE NO SEAN DEL PISO SELECCIONADO
                    opt2.removeAttribute('hidden');
                    //div.setAttribute("style","");                   
                }
                @endforeach
            
            // LOS OPTIONS QUE NO TIENEN ATRIBUTO HIDDEN
            }else{
                var hid2 = document.createAttribute("hidden");
                opt2.setAttributeNode(hid2);
            }
        }        
    }

    function validacion_habitaciones(e){
        var formulario = document.form;
        
        var sel = document.getElementById('habitacion_inicial');
        var selectOption = sel.options[sel.selectedIndex];
        console.log(selectOption.value);


        var selF = document.getElementById('habitacion_final');
        var selectOptionF = selF.options[selF.selectedIndex];
        console.log(selectOptionF.value);
        
        if(parseInt(selectOption.value,10) > parseInt(selectOptionF.value,10)){
            alert('El orden de las habitaciones no es correcto');
            if(e.preventDefault) {
            e.preventDefault();
            } else {
            e.returnValue = false;
            }
        }
    }
</script>
@endpush
