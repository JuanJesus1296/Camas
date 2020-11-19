function habitacion_alta_administrativa(id,hab, pi, oa, paciente, gd, diagnostico, medico, observacion){
    const habitacion = $('#input_habitacion_alta');
    const piso = $('#input_piso_alta');
  
    $('#observacion').val("");
  
  
    $('.token-input-delete-token').click();
  
    $('#grado').css('display','none');
  
    $('#estado').prop('disabled', false);
  
    habitacion.val(hab);
    $('#habitacion_alta').val(hab);
    piso.val(pi);
  
    $('#input_oa_alta').val(oa);
    $('#oa_alta').val(oa);
  
    $('#paciente_alta').val(paciente);
    $('#estado_alta').val("5");
  
    $('#grado_alta').val(gd);
    $('#id_hospitalizacion_alta').val(id);
    $('#diagnostico_alta').val(diagnostico);
    $('#medico_alta').val(medico);
    $('#observacion_alta').val(observacion);
  

    $('#divObservacion_alta').css('display', '');
    $('#divNuevoMedico_alta').css('display', 'none');
    $('#divMedico_alta').css('display', '');
    $('#divNuevoDiagnostico_alta').css('display', 'none');
    $('#divDiagnostico_alta').css('display', '');
    $('#divGrado_alta').css('display', '');
    $('#divPaciente_alta').css('display', '');
    $('#divOa_alta').css('display', '');
  }

  function nuevoDiagnostico_Alta(){
    $('#divNuevoDiagnostico_alta').css('display', 'block');
  }
  
  function nuevoMedico_Alta(){
      $('#divNuevoMedico_alta').css('display','block');
  }
  
  function descartarDiagnostico_Alta(){
      $('#divNuevoDiagnostico_alta').css('display', 'none');
      $('#divNuevoDiagnostico_alta .token-input-delete-token').click();
  }
  
  function descartarMedico_Alta(){
      $('#divNuevoMedico_alta').css('display', 'none');
      $('#divNuevoMedico_alta .token-input-delete-token').click();
  }

  function cambio_alta(elem){
    if(elem.value == '5'){
      console.log('SE HA SELECCIONADO OPCIÓN DE OCUPADA DE HABITACIÓN');
      $('#divObservacion_alta').css('display', '');
      $('#divNuevoMedico_alta').css('display', 'none');
      $('#divMedico_alta').css('display', '');
      $('#divNuevoDiagnostico_alta').css('display', 'none');
      $('#divDiagnostico_alta').css('display', '');
      $('#divGrado_alta').css('display', '');
      $('#divPaciente_alta').css('display', '');
      $('#divOa_alta').css('display', '');

      
    }else if(elem.value == '3'){
      console.log('SE HA SELECCIONADO OPCIÓN DE MANTENIMIENTO DE HABITACIÓN');
      $('#divObservacion_alta').css('display', 'none');
      $('#divNuevoMedico_alta').css('display', 'none');
      $('#divMedico_alta').css('display', 'none');
      $('#divNuevoDiagnostico_alta').css('display', 'none');
      $('#divDiagnostico_alta').css('display', 'none');
      $('#divGrado_alta').css('display', 'none');
      $('#divPaciente_alta').css('display', 'none');
      $('#divOa_alta').css('display', 'none');

      $('#oa').removeAttr('required');
      $('#paciente').css('display', 'none');
      $('#divOA').css('display','none');
      $('#oa').removeAttr('required');
    }else if(elem.value == '4'){
      console.log('SE HA SELECCIONADO OPCIÓN DE LIMPIEZA DE HABITACIÓN');

      $('#divObservacion_alta').css('display', 'none');
      $('#divNuevoMedico_alta').css('display', 'none');
      $('#divMedico_alta').css('display', 'none');
      $('#divNuevoDiagnostico_alta').css('display', 'none');
      $('#divDiagnostico_alta').css('display', 'none');
      $('#divGrado_alta').css('display', 'none');
      $('#divPaciente_alta').css('display', 'none');
      $('#divOa_alta').css('display', 'none');

      $('#oa').removeAttr('required');
    }else if(elem.value == '1'){
      console.log('SE HA SELECCIONADO OPCIÓN DE MANTENIMIENTO DE HABITACIÓN');
      $('#divObservacion_alta').css('display', 'none');
      $('#divNuevoMedico_alta').css('display', 'none');
      $('#divMedico_alta').css('display', 'none');
      $('#divNuevoDiagnostico_alta').css('display', 'none');
      $('#divDiagnostico_alta').css('display', 'none');
      $('#divGrado_alta').css('display', 'none');
      $('#divPaciente_alta').css('display', 'none');
      $('#divOa_alta').css('display', 'none');

      $('#oa').removeAttr('required');
      $('#paciente').css('display', 'none');
      $('#divOA').css('display','none');
      $('#oa').removeAttr('required');
    }
  }