<!-- Modal -->
<div class="modal fade" id="modal_ocupado" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <form action="{{route('estado.ocupada')}}" method="POST">
        @csrf
        <input type="hidden" id="id_hospitalizacion" name="id_hospitalizacion" value="">

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
              <input type="text" name="input_habitacion_ocupada" class="form-control" id="input_habitacion_ocupada" disabled>
              <input type="hidden" name="habitacion_ocupada" class="form-control" id="habitacion_ocupada">
            </div>
            </div>

            <div class="form-group col-md-6">
              <div class="row">
              <div class="col-sm"><label for="inputPassword4">Piso</label> </div>
              <div class="col-sm">
                <a href="#" style="font-size: 12px; color: blue; float: right" data-toggle="modal" data-target="#habitacion_ocupada_mover" data-dismiss="modal"><i class="fa fa-location-arrow"></i> Mover</a></div>
              </div>
                <div class="input-group">
               <div class="input-group-prepend">
                   <div class="input-group-text"><i class="fa fa-building"></i></div>
                 </div>
                <input type="text" class="form-control" id="input_piso_ocupada" disabled>
            </div>
            </div>
          </div>

          <div class="form-group row">
            <label for="inputAddress" class="col-sm-3 col-form-label" style="padding-right: 0px;">OA</label>
            <div class="col-sm-9">
              <input type="number" name="input_oa_ocupada" class="form-control" id="input_oa_ocupada" maxlength="10" disabled>
              <input type="hidden" name="oa_ocupada" class="form-control" id="oa_ocupada">
            </div>
          </div>

          <div class="form-group row">
              <label for="inputEmail4" class="col-sm-3 col-form-label" style="padding-right: 0px;">Paciente: </label>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="paciente_ocupada" name="paciente_ocupada" disabled>
              </div>
          </div>

          <div class="form-group row">
            <label for="inputAddress" class="col-sm-3 col-form-label" style="padding-right: 0px;">Estado: </label>
            <div class="col-sm-9">
              <select class="form-control" id="estado_selector" name="selector">
                  <option value="2">OCUPADO</option>
                  <option value="5">ALTA ADMINISTRATIVA</option>
                  <option value="99">ANULAR HOSPITALIZACIÓN</option>
              </select>
            </div>
          </div>

          <div class="form-group row" id="grado">
            <label for="inputAddress" class="col-sm-3 col-form-label" style="padding-right: 0px;">G. Dependencia</label>
            <div class="col-sm-9">
              <select class="form-control" name="grado_ocupada" id="grado_ocupada">
                @foreach ($grados as $grado)
                  <option value="{{$grado->id}}">{{$grado->name}}</option>
                @endforeach
              </select>
            </div>
          </div>

          <div class="form-group">
            <label for="diagnostico_ocupado">Diagnóstico: </label>
            <div class="input-group">
              <input type="text" class="form-control" id="diagnostico_ocupado" name="diagnostico_ocupado" disabled>
              <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="button" onclick="nuevoDiagnostico()">Nuevo</button>
              </div>
            </div>
          </div>

          <div class="form-group" id="divNuevoDiagnostico" style="display: none">
            <label for="diagnostico_ocupado">Nuevo Diagnóstico: </label>
            <input autofocus type="text" class="form-control" id="diagnostico_nuevo_ocupado" name="diagnostico_nuevo_ocupado">
            <a href="#" onclick="descartarDiagnostico()" style="font-size: 12px; color: red">Descartar nuevo diagnóstico</a>
            <input type="hidden" id="ruta_search_diagnostico_ocupado" value="{{ route('json.diagnostico') }}">
            <input type="hidden" name="id_diagnostico_ocupada" id="id_diagnostico_ocupada" value="">
          </div> 


          <div class="form-group">
            <label for="inputAddress">Médico:</label>
            <div class="input-group">
              <input id="medico_ocupado" name="medico_ocupado" type="text" class="form-control" disabled>
              <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="button" onclick="nuevoMedico()">Nuevo</button>
              </div>
            </div>
          </div>



          <div class="form-group" id="divNuevoMedico" style="display: none">
            <label for="inputAddress">Nuevo Médico:</label>
            <div class="input-group">
              <input autofocus id="medico_nuevo_ocupado" name="medico_nuevo_ocupado" type="text" class="form-control">
              <a href="#" onclick="descartarMedico()" style="font-size: 12px; color: red">Descartar nuevo médico</a>
              <input type="hidden" id="ruta_search_medico_ocupado" value="{{ route('json.doctor') }}">
              <input type="hidden" name="id_medico_ocupado" id="id_medico_ocupada" value="">
            </div>
          </div>

          <div class="form-group">
            <label for="inputAddress2">Observación</label>
            <textarea id="observacion_ocupada" name="observacion" type="textarea" class="form-control"></textarea>
          </div>
        </div>

      <div class="modal-footer" style="background-color: white;">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-success">Grabar</button>
      </div>
      </form>
    </div>
  </div>
</div>


    <!-- INICIO Modal MOVER DE HABITACIÓN -->
    <div class="modal fade" id="habitacion_ocupada_mover" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <form action="{{route('mover.habitacion')}}" method="POST">
            @csrf
            <div class="modal-header" style="background-color: white;">
              <h5 class="modal-title" id="staticBackdropLabel">Hospitalización</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

          <div class="modal-body" style="background-color: white;">

            <div class="form-group">
              <label for="inputAddress">Piso</label>
              <select class="form-control" name="piso_mover" id="piso_mover" onchange="cambiar_piso(this)">
                @foreach($pisos as $piso)
                  <option value="{{$piso->name}}">{{$piso->name}}</option>
                @endforeach
              </select>
            </div>

            <div class="form-group">
              <label for="inputAddress">Habitación</label>
              <input type="hidden" name="habitacion_mover_anterior" id="habitacion_mover_anterior">
              <select class="form-control" name="habitacion_mover" id="habitacion_mover">
                @foreach($habitaciones as $habitacion)
                @if($habitacion->estado_id == 1)
                  <option value="{{$habitacion->habitacion}}" piso="{{$habitacion->piso->name}}" hidden>{{$habitacion->habitacion}}</option>
                @endif
                @endforeach
              </select>
            </div>

            

          </div>

          <div class="modal-footer" style="background-color: white;">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-success" id="registrar_paciente">Mover</button>
          </div>

          </form>
        </div>
      </div>
    </div>