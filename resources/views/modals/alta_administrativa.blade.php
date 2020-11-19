<!-- Modal -->
<div class="modal fade" id="modal_alta_administrativa" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <form action="{{route('estado.alta')}}" method="POST">
          @csrf
          <input type="hidden" id="id_hospitalizacion_alta" name="id_hospitalizacion_alta" value="">
  
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
                <input type="text" name="input_habitacion_alta" class="form-control" id="input_habitacion_alta" disabled>
                <input type="hidden" name="habitacion_alta" class="form-control" id="habitacion_alta">
              </div>
              </div>
  
              <div class="form-group col-md-6">
                  <label for="inputPassword4">Piso</label>
                  <div class="input-group">
                 <div class="input-group-prepend">
                     <div class="input-group-text"><i class="fa fa-building"></i></div>
                   </div>
                  <input type="text" class="form-control" id="input_piso_alta" disabled>
              </div>
              </div>
            </div>
  
            <div class="form-group row" id="divOa_alta">
              <label for="inputAddress" class="col-sm-3 col-form-label" style="padding-right: 0px;">OA</label>
              <div class="col-sm-9">
                <input type="number" name="input_oa_alta" class="form-control" id="input_oa_alta" maxlength="10" disabled>
                <input type="hidden" name="oa_alta" class="form-control" id="oa_alta">
              </div>
            </div>
  
            <div class="form-group row" id="divPaciente_alta">
                <label for="inputEmail4" class="col-sm-3 col-form-label" style="padding-right: 0px;">Paciente: </label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="paciente_alta" name="paciente_alta" disabled>
                </div>
            </div>
  
            <div class="form-group row">
              <label for="estado_alta" class="col-sm-3 col-form-label" style="padding-right: 0px;">Estado: </label>
              <div class="col-sm-9">
                <select class="form-control" id="estado_alta" name="estado_alta" onchange="cambio_alta(this)">
                    <option value="1">DISPONIBLE</option>
                    <option value="3">MANTENIENTO</option>
                    <option value="4">LIMPIEZA</option>
                    <option value="5">ALTA ADMINISTRATIVA</option>
                </select>
              </div>
            </div>
  
            <div class="form-group row" id="divGrado_alta">
              <label for="grado_alta" class="col-sm-3 col-form-label" style="padding-right: 0px;">G. Dependencia</label>
              <div class="col-sm-9">
                <select class="form-control" name="grado_alta" id="grado_alta">
                  @foreach ($grados as $grado)
                    <option value="{{$grado->id}}">{{$grado->name}}</option>
                  @endforeach
                </select>
              </div>
            </div>
  
            <div class="form-group" id="divDiagnostico_alta">
              <label for="diagnostico_alta">Diagnóstico: </label>
              <div class="input-group">
                <input type="text" class="form-control" id="diagnostico_alta" name="diagnostico_alta" disabled>
                <div class="input-group-append">
                  <button class="btn btn-outline-secondary" type="button" onclick="nuevoDiagnostico_Alta()">Nuevo</button>
                </div>
              </div>
            </div>
  
         <!--   <div class="form-group" id="divNuevoDiagnostico" style="display: none">
              <label for="diagnostico_ocupado">Nuevo Diagnóstico: </label>
              <input autofocus type="text" class="form-control" id="diagnostico_nuevo_ocupado" name="diagnostico_nuevo_ocupado">
              <input type="hidden" id="ruta_search_diagnostico_ocupado" value="{{ route('json.diagnostico') }}">
              <input type="hidden" name="id_diagnostico_ocupada" id="id_diagnostico_ocupada" value="">
            </div>  -->
  
            <div class="form-group" id="divNuevoDiagnostico_alta" style="display: none">
              <label for="diagnostico_alta">Nuevo Diagnóstico: </label>
              <input autofocus type="text" class="form-control" id="diagnostico_nuevo_alta" name="diagnostico_nuevo_alta">
              <a href="#" onclick="descartarDiagnostico_Alta()" style="font-size: 12px; color: red">Descartar nuevo diagnóstico</a>
              <input type="hidden" id="ruta_search_diagnostico_alta" value="{{ route('json.diagnostico') }}">
              <input type="hidden" name="id_diagnostico_alta" id="id_diagnostico_ocupada" value="">
            </div> 
  
  
            <div class="form-group" id="divMedico_alta">
              <label for="medico_alta">Médico:</label>
              <div class="input-group">
                <input id="medico_alta" name="medico_alta" type="text" class="form-control" disabled>
                <div class="input-group-append">
                  <button class="btn btn-outline-secondary" type="button" onclick="nuevoMedico_Alta()">Nuevo</button>
                </div>
              </div>
            </div>
  
  
  
            <div class="form-group" id="divNuevoMedico_alta" style="display: none">
              <label for="inputAddress">Nuevo Médico:</label>
                <input autofocus id="medico_nuevo_alta" name="medico_nuevo_alta" type="text" class="form-control">
                <a href="#" onclick="descartarMedico_Alta()" style="font-size: 12px; color: red">Descartar nuevo médico</a>
                <input type="hidden" id="ruta_search_medico_alta" value="{{ route('json.doctor') }}">
                <input type="hidden" name="id_medico_alta" id="id_medico_alta" value="">
            </div>
  
            <div class="form-group" id="divObservacion_alta">
              <label for="observacion_alta">Observación</label>
              <textarea id="observacion_alta" name="observacion_alta" type="textarea" class="form-control"></textarea>
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
  