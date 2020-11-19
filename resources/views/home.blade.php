@extends('layouts.plantilla')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/token-input.css')  }}">
@endpush


@section('content')
<div class="row flex-grow">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title"><b>Bienvenido al <a style="color: green;"> Gestor de Camas</a></b></h4>

          <div class="form-group">
            <div class="row">
              <div class="col-sm-auto">
                <i class="fa fa-bed"></i>
              </div>
                <div class="col-sm-2">

              <select class="form-control" id="exampleFormControlSelect1" name="selector" onchange="showDiv(this)">
                @foreach ($pisos as $piso)
                  <option value="{{$piso->name}}">{{$piso->name}}</option>
                @endforeach
              </select>
            </div>
            </div>
            </div>
            <center>
              @foreach($pisos as $piso)
          <table class="table table-bordered habitacionesPiso" id="table_{{$piso->name}}" style="display: none;">
          <tr>
            <td>Camas Disponibles</td>
            <td>Camas ocupadas</td>
            <td>Mantenimiento</td>
            <td>Limpieza</td>
            <td>Alta administrativa</td>
          </tr>
          <tr>
            <td class="text-center" style="width: 20rem; vertical-align:text-top;" VALIGN="TOP">
              @php $di = 0 @endphp
              @foreach ($habitaciones as $habitacion)
                @if ($habitacion->piso_id == $piso->id && $habitacion->estado_id == 1)
                  <button type="button" class="btn btn-success" data-toggle="modal"
                  data-target="#staticBackdrop" onclick="json_habitaciones('{{$habitacion->habitacion}}','{{$habitacion->piso->name}}')">{{$habitacion->habitacion}}</button></p>
                  @php $di++ @endphp
                @endif
              @endforeach
              @if($di == 0)
                No se encontraron registros
              @endif
            </td>
            <td class="text-center" style="width: 20rem; vertical-align:text-top;" VALIGN="TOP">
              @php $oc = 0 @endphp
              @foreach ($ocupadas as $ocupada)
                @if ($ocupada->habitacion->piso_id == $piso->id && $ocupada->Estado == 2)
                  <button type="button" class="btn btn-danger" data-toggle="modal"
                  data-target="#modal_ocupado" onclick="habitacion_ocupada(
                    '{{$ocupada->id}}',
                    '{{$ocupada->habitacion->habitacion}}',
                    '{{$ocupada->habitacion->piso->name}}',
                    '{{$ocupada->OA}}',
                    '{{$ocupada->paciente->fullname}}',
                    '{{$ocupada->gradodependencia_id}}',
                    '{{$ocupada->diagnostico->name}}',
                    '{{$ocupada->medico->person->fullname}}',
                    '{{$ocupada->observacion}}'
                  )">{{$ocupada->habitacion->habitacion}}</button></p>
                  @php $oc++ @endphp
                @endif
              @endforeach
              @if($oc == 0)
                No se encontraron registros
              @endif
            </td>
            <td class="text-center" style="width: 20rem; vertical-align:text-top;" VALIGN="TOP">
              @php $ma = 0 @endphp
              @foreach ($habitaciones as $habitacion)
                @if ($habitacion->piso_id == $piso->id && $habitacion->estado_id == 3)
                  <button type="button" class="btn" data-toggle="modal" data-target="#modal_mantenimiento" 
                  style="background-color: #9d5e1f; color: white" onclick="habitacion_mantenimiento(
                    '{{$habitacion->habitacion}}',
                    '{{$habitacion->piso->name}}'
                  )">{{$habitacion->habitacion}}</button></p>
                  @php $ma++ @endphp
                @endif
              @endforeach
              @if($ma == 0)
                No se encontraron registros
              @endif
            </td>
            <td class="text-center" style="width: 20rem; vertical-align:text-top;" VALIGN="TOP">
              @php $li = 0 @endphp
              @foreach ($habitaciones as $habitacion)
                @if ($habitacion->piso_id == $piso->id && $habitacion->estado_id == 4)
                  <button type="button" class="btn" data-toggle="modal" data-target="#modal_limpieza"
                  style="background-color: #0ca3b6; color: white" onclick="habitacion_limpieza(
                    '{{$habitacion->habitacion}}',
                    '{{$habitacion->piso->name}}'
                  )">{{$habitacion->habitacion}}</button></p>
                  @php $li++ @endphp
                @endif
              @endforeach
              @if($li == 0)
                No se encontraron registros
              @endif
            </td>
            <td class="text-center" style="width: 20rem; vertical-align:text-top;" VALIGN="TOP">
              @php $al = 0 @endphp
              @foreach ($altas as $alta)
                @if ($alta->habitacion->piso_id == $piso->id && $alta->Estado == 5)
                  <button type="button" class="btn" data-toggle="modal" data-target="#modal_alta_administrativa"
                  style="background-color: darkorchid; color: white" onclick="habitacion_alta_administrativa(
                    '{{$alta->id}}',
                    '{{$alta->habitacion->habitacion}}',
                    '{{$alta->habitacion->piso->name}}',
                    '{{$alta->OA}}',
                    '{{$alta->paciente->fullname}}',
                    '{{$alta->gradodependencia_id}}',
                    '{{$alta->diagnostico->name}}',
                    '{{$alta->medico->person->fullname}}',
                    '{{$alta->observacion}}'
                  )">{{$alta->habitacion->habitacion}}</button></p>
                  @php $al++ @endphp
                @endif
              @endforeach
              @if($al == 0)
                No se encontraron registros
              @endif
            </td>
          </tr>
        </table>
          @endforeach
    </center>


    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <form action="{{route('hospitalizacion.ocupada')}}" method="POST" id="formulario_disponible">
            @csrf
          <div class="modal-header" style="background-color: white;">
            <h5 class="modal-title" id="staticBackdropLabel">Hospitalización</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body" style="background-color: white;">

          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="inputEmail4">Habitación</label>
              <div class="input-group">
              <div class="input-group-prepend">
                  <div class="input-group-text"><i class="fa fa-bed"></i></div>
                </div>
              <input type="text" name="input_habitacion" class="form-control" id="input_habitacion" disabled>
              <input type="hidden" name="habitacion" class="form-control" id="habitacion">
            </div>
            </div>
            <div class="form-group col-md-6">
                <label for="inputPassword4">Piso</label>
                <div class="input-group">
              <div class="input-group-prepend">
                  <div class="input-group-text"><i class="fa fa-building"></i></div>
                </div>
                <input type="text" class="form-control" id="input_piso" disabled>
            </div>
            </div>
          </div>


          
          <div class="form-group row" id="divOA" style="">
            <label for="inputAddress" class="col-sm-3 col-form-label" style="padding-right: 0px;">OA</label>
            <div class="col-sm-9">
              <input type="number" name="oa" class="form-control" id="oa" maxlength="10" required>
            </div>
          </div>

          <div class="form-group row">
            <label for="inputAddress" class="col-sm-3 col-form-label" style="padding-right: 0px;">Estado</label>
            <div class="col-sm-9">
              <select class="form-control" id="estado" name="estado" onchange="cambio_disponible(this)" required>
                <option value="2">OCUPADO</option>
                <option value="3">MANTENIMIENTO</option>
                <option value="4">LIMPIEZA</option>
            </select>
            <input type="hidden" id="estado_hidden" name="estado_hidden" value="">
            </div>
          </div>

          <div class="form-group row" id="grado" style="display: none">
            <label for="inputAddress" class="col-sm-3 col-form-label" style="padding-right: 0px;">G. Dependencia</label>
            <div class="col-sm-9">
              <select class="form-control" name="grade" id="grade">
                  @foreach ($grados as $grado)
                    <option value="{{$grado->id}}">{{$grado->name}}</option>
                  @endforeach
              </select>
            </div>
          </div>

            <div class="form-group" id="paciente" style="">
              <label for="inputEmail4">Paciente</label>
              <div class="input-group">
                <input autofocus type="text" id="search" name="search" style="width: 100%" />
                <a href="#" data-toggle="modal" data-target="#agregar_paciente" data-dismiss="modal" style="font-size: 12px; color: green">
                  <i class="fa fa-plus-circle"></i> Agregar nuevo paciente</a>
                <input type="hidden" id="ruta_search" value="{{ route('json.people') }}">
                <input type="hidden" id="dni_paciente" name="dni_paciente" value="">
              </div>
            </div>


            <div class="form-group" id="doctor" style="display: none">
              <label for="inputAddress">Doctor</label>
              <input autofocus type="text" class="form-control" id="search_doctor" name="search_doctor">
              <input type="hidden" id="ruta_search_doctor" value="{{ route('json.doctor') }}">
              <input type="hidden" name="id_doctor" id="id_doctor" value="">
            </div>

            

            <div class="form-group" id="diagnostico" style="display: none">
              <label for="inputAddress">Diagnóstico</label>
              <input autofocus id="diagnostice" name="diagnostice" type="text" class="form-control">
              <input type="hidden" id="ruta_search_diagnostico" value="{{ route('json.diagnostico') }}">
              <input type="hidden" name="id_diagnostico" id="id_diagnostico" value="">
            </div>

            <div class="form-group" id="observacion" style="">
              <label for="inputAddress2">Observación</label>
              <textarea id="observacion"  placeholder="Observaciones" type="textarea" class="form-control" name="observacion"></textarea>
            </div>
          </div>

          <div class="modal-footer" style="background-color: white;">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-success">Registrar</button>
          </div>
          </form>
        </div>
      </div>
    </div>




    <!-- INICIO Modal Agregar paciente -->
    <div class="modal fade" id="agregar_paciente" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <form>
            @csrf
            <div class="modal-header" style="background-color: white;">
              <h5 class="modal-title" id="staticBackdropLabel">Hospitalización</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <div class="modal-body" style="background-color: white;">
              <div class="form-group">
                <label for="inputAddress">DNI</label>
                <input type="number" 
                class="form-control" 
                id="dni" 
                oninput="this.value = this.value.toUpperCase(); if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                maxlength="8"
                name="document">
            </div>

              <div class="form-group">
                <label for="inputAddress">Apellidos</label>
                <input type="text" class="form-control" id="apellido_paterno" name="apellidos">
              </div>

              {{-- <div class="form-group" id="grado">
                <label for="inputAddress">Apellido Materno</label>
                <input type="text" class="form-control" id="apellido_materno">
              </div> --}}

              <div class="form-group" id="diagnostico">
                <label for="inputAddress">Nombres</label>
                <input type="text" class="form-control" id="nombre" name="nombres">
              </div>

              <div class="form-group">
                <label for="inputAddress">Fecha de nacimiento</label>
                <input type="date" class="form-control" id="nacimiento" name="nacimiento">
              </div> 

          </div>

          <div class="modal-footer" style="background-color: white;">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-success" id="registrar_paciente">Registrar</button>
          </div>

          </form>
        </div>
      </div>
    </div>
    <!-- FIN Modal Agregar paciente -->

      <!-- MODAL PARA HABITACIONES OCUPADAS -->
      @include('modals.ocupada')

      <!-- MODAL PARA HABITACIONES ALTA ADMINISTRATIVA -->
      @include('modals.alta_administrativa')

      <!-- MODAL PARA HABITACIONES MANTENIMIENTO -->
      @include('modals.mantenimiento')

      <!-- MODAL PARA HABITACIONES LIMPIEZA -->
      @include('modals.limpieza')







      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('js/jquery.tokeninput.js')  }}"></script>
<script src="{{ asset('js/paciente_camas.js')  }}"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="{{ asset('js/registrar_paciente.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/mantenimiento.js') }}"></script>
<script src="{{ asset('js/limpieza.js') }}"></script>
<script src="{{ asset('js/alta_administrativa.js') }}"></script>
<script type="text/javascript">
function showDiv(elem){
    @foreach ($pisos as $piso)
    if(elem.value == '{{$piso->name}}' ){
      @foreach ($pisos as $pi)
        document.getElementById('table_{{$pi->name}}').style.display = "none";
      @endforeach
    console.log('abc{{$piso->name}}');
      document.getElementById('table_{{$piso->name}}').style.display = "table-cell";
    }
      @endforeach
}

function cambio_disponible(elem){
  if(elem.value == '2'){
    console.log('SE HA SELECCIONADO OPCIÓN DE OCUPADA DE HABITACIÓN');
    $('#observacion').css('display', '');
    $('#paciente').css('display', '');
    $('#divOA').css('display','');
    
  }else if(elem.value == '3'){
    console.log('SE HA SELECCIONADO OPCIÓN DE MANTENIMIENTO DE HABITACIÓN');
    $('#observacion').css('display', 'none');
    $('#paciente').css('display', 'none');
    $('#divOA').css('display','none');
    $('#oa').removeAttr('required');
  }else if(elem.value == '4'){
    console.log('SE HA SELECCIONADO OPCIÓN DE LIMPIEZA DE HABITACIÓN');
    $('#observacion').css('display', 'none');
    $('#paciente').css('display', 'none');
    $('#divOA').css('display','none');
    $('#oa').removeAttr('required');
  }
}

function cambiar_piso(elem){       
  var sel = document.getElementById('habitacion_mover');
  for (var i = 0; i < sel.options.length; i++ ){
      var opt = sel.options[i]
      if ( opt.hidden === true ) {
          // SE OCULTAN TODOS LAS HABITACIONES
          //opt.removeAttribute("hidden");
          @foreach($pisos as $piso)
          //var hid = document.createAttribute("hidden");
          //opt.setAttributeNode(hid);

          //if(elem.value != '{{$piso->id}}' && opt.piso  ){
          if(opt.getAttribute('piso') == '{{$piso->name}}' && opt.getAttribute('piso') == elem.value ){
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
    
}
</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script type="text/javascript">
@if (session('message') == 'success')
Swal.fire(
  'El sistema informa',
  'Diagnóstico actualizado correctamente',
  'success'
)
@elseif (session('message') == 'success_ocupada')
Swal.fire(
  'El sistema informa',
  'Se ha ocupado habitación correctamente',
  'success'
)
@elseif (session('message') == 'estado_ocupada_anulada')
Swal.fire(
  'El sistema informa',
  'Se ha anulado hospitalización correctamente',
  'success'
)
@elseif (session('message') == 'estado_ocupada_actualizada')
Swal.fire(
  'El sistema informa',
  'Se ha actualizado hospitalización correctamente',
  'success'
)
@elseif (session('message'))
Swal.fire(
  'El sistema informa',
  '{{session("message")}}',
  'success'
)
@endif

@if (session('success'))
Swal.fire(
  'El sistema informa',
  '{{session("success")}}',
  'success'
)
@endif
</script>
@endpush
