<!-- Modal -->
<div class="modal fade" id="modal_limpieza" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <form action="{{route('estado.limpieza')}}" method="POST">
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
                <input type="text" name="input_habitacion_limpieza" class="form-control" id="input_limpieza_alta" disabled>
                <input type="hidden" name="habitacion_limpieza" class="form-control" id="habitacion_limpieza">
              </div>
              </div>
  
              <div class="form-group col-md-6">
                  <label for="inputPassword4">Piso</label>
                  <div class="input-group">
                 <div class="input-group-prepend">
                     <div class="input-group-text"><i class="fa fa-building"></i></div>
                   </div>
                  <input type="text" class="form-control" id="input_piso_limpieza" disabled>
              </div>
              </div>
            </div>
  
            <div class="form-group row">
              <label for="estado_mantenimiento" class="col-sm-3 col-form-label" style="padding-right: 0px;">Estado: </label>
              <div class="col-sm-9">
                <select class="form-control" id="estado_limpieza" name="estado_limpieza">
                    <option value="1">DISPONIBLE</option>
                    <option value="4">LIMPIEZA</option>
                </select>
              </div>
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
  