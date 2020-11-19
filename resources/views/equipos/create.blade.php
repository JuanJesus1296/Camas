@extends('layouts.plantilla')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/token-input.css')  }}">
@endpush
@section('content')
<div class="row flex-grow">
    <div class="col-md-6">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Registro de Equipos</h4><center>
          <img src="{{ asset('images/equipo.svg') }}" alt="" width="20%"></center><br></br>
          <p class="card-description">
            (*) Campos obligatorios

          </p>

          <form autocomplete="off" id="form" action="{{ route('equipos.store') }}" method="POST" class="forms-sample" onsubmit="validacion_habitaciones(event, this);">
            {{ csrf_field() }}
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
                    placeholder="Nombre de equipo">
                @if ($errors->has('name'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group">
                <label for="name">Piso *</label>
                <select class="form-control" name="piso" id="piso" onchange="cambiar_piso(this)">
                    @foreach($pisos as $piso)
                      <option value="{{$piso->id}}">{{$piso->name}}</option>
                    @endforeach
                </select>
              </div>
  
              
              <div class="row">
                  <div class="col-sm">
                      <div class="form-group">
                          <label for="name">Habitación inicial *</label>
                          <select class="form-control" name="habitacion_inicial" id="habitacion_inicial">
                            <option value="">Seleccionar</option>
                              @foreach($habitaciones as $habitacion)
                              <option value="{{$habitacion->id}}" piso="{{$habitacion->piso_id}}" hidden style="">{{$habitacion->habitacion}}</option>
                              @endforeach
                          </select>
                        </div>
                    </div>
                    <div class="col-sm">
                      <div class="form-group">
                          <label for="name">Habitación final *</label>
                          <select class="form-control" name="habitacion_final" id="habitacion_final">
                            <option value="">Seleccionar</option>
                              @foreach($habitaciones as $habitacion)
                              <option value="{{$habitacion->id}}" piso="{{$habitacion->piso_id}}" hidden>{{$habitacion->habitacion}}</option>
                              @endforeach
                          </select>
                        </div>
                    </div>
              </div>


            <button class="btn btn-success mr-2">Guardar</button>
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
