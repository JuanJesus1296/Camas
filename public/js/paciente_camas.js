$(function(){

    const search = $("#search");
    const ruta = $('#ruta_search');
    const name  = $('#name');
    const dni_paciente = $('#dni_paciente');
    const lastname = $('#lastname');
    const dni = $('#dni');
    const estado_doc = document.getElementById('estado');
    const estado = $('#estado');
    const grado = $('#grado');
    const diagnostico = $('#diagnostico');


    //PARA MOSTRAR MEDICOS
    const search_doctor = $("#search_doctor");
    const ruta_doctor = $('#ruta_search_doctor');
    const id_doctor = $('#id_doctor');

    //PARA MOSTRAR DIAGNOSTICOS
    const search_diagnostico = $("#diagnostice");
    const ruta_diagnostico = $('#ruta_search_diagnostico');
    const id_diagnostico = $('#id_diagnostico');

    //PARA MOSTRAR DIAGNOSTICOS - OCUPADOS
    const search_diagnostico_ocupada = $("#diagnostico_nuevo_ocupado");
    const ruta_diagnostico_ocupada = $('#ruta_search_diagnostico');
    const id_diagnostico_ocupada = $('#id_diagnostico');

    //PARA MOSTRAR MEDICO - OCUPADOS
    const search_medico_ocupada = $("#medico_nuevo_ocupado");
    const ruta_medico_ocupada = $('#ruta_search_medico_ocupado');
    const id_medico_ocupada = $('.id_medico_ocupado');

    //PARA MOSTRAR DIAGNOSTICOS - ALTA ADMINISTRATIVA
    const search_diagnostico_alta = $("#diagnostico_nuevo_alta");
    const ruta_diagnostico_alta = $('#ruta_search_diagnostico_alta');
    const id_diagnostico_alta = $('#id_diagnostico_alta');

    //PARA MOSTRAR MEDICO - ALTA ADMINISTRATIVA
    const search_medico_alta = $("#medico_nuevo_alta");
    const ruta_medico_alta = $('#ruta_search_medico_alta');
    const id_medico_alta = $('#id_medico_alta');


    search.tokenInput(ruta.val(), {
        tokenLimit: 1,
        minChars: 4,
        onAdd: function (item) {
            const go = ruta.val() + "/" + item.id;
            $.get(go, {}, function(response){
                console.log(response);
                if( response['user'] != null ){

                    name.val("");
                    dni.val("");
                    lastname.val("");
                    //window.swal('La persona seleccionada ya tiene registrada una cuenta de usuario','','warning');
                    //Swal.fire("La persona seleccionada ya tiene registrada una cuenta de usuario","","warning");
                    return;
                }else{
                    // SE CAMBIA SELECT DE ESTADO
                    estado.prop('disabled', true);
                   /* if (document.getElementById('estado').value != 2){
                        var opt = document.createElement('option');
                        opt.value = '2';
                        opt.innerHTML = 'OCUPADO';
                        estado_doc.appendChild(opt);                        
                    } */
                    estado.val("2");
                    $('#estado_hidden').val('2');

                    name.val(response['name']);
                    lastname.val(response['lastname']);
                    dni_paciente.val(response['document']);

                    grado.css('display', '');
                    diagnostico.css('display', 'block');

                    $('#doctor').css('display', 'block')

                }

            },'json');
        },
        onDelete: function (item) {
            name.val("");
            dni.val("");
            lastname.val("");
        }

    });

    search_doctor.tokenInput(ruta_doctor.val(), {
      tokenLimit: 1,
      minChars: 4,
      onAdd: function (item) {
          const go = ruta_doctor.val() + "/" + item.id;
          $.get(go, {}, function(response){
              console.log(response);
              if( response['user'] != null ){

                  name.val("");
                  dni.val("");
                  lastname.val("");
                  //window.swal('La persona seleccionada ya tiene registrada una cuenta de usuario','','warning');
                  //Swal.fire("La persona seleccionada ya tiene registrada una cuenta de usuario","","warning");
                  return;
              }else{
                  name.val(response['name']);
                  lastname.val(response['lastname']);
                  id_doctor.val(response['id']);

                  grado.css('display', '');
                  diagnostico.css('display', 'block');

              }

          },'json');
      },
      onDelete: function (item) {
          name.val("");
          dni.val("");
          lastname.val("");
      }
    });

    search_diagnostico.tokenInput(ruta_diagnostico.val(), {
      tokenLimit: 1,
      minChars: 4,
      onAdd: function (item) {
          const go = ruta_diagnostico.val() + "/" + item.id;
          $.get(go, {}, function(response){
              console.log(response);
              if( response['user'] != null ){
                  return;
              }else{
                  name.val(response['name']);
                  lastname.val(response['lastname']);
                  id_diagnostico.val(response['id']);

                  grado.css('display', '');
                  diagnostico.css('display', 'block');

              }

          },'json');
      },
      onDelete: function (item) {
          name.val("");
          dni.val("");
          lastname.val("");
      }
    });

    search_diagnostico_ocupada.tokenInput(ruta_diagnostico_ocupada.val(), {
      tokenLimit: 1,
      minChars: 4,
      onAdd: function (item) {
          const go = ruta_diagnostico_ocupada.val() + "/" + item.id;
          $.get(go, {}, function(response){
              console.log(response);
              if( response['user'] != null ){
                  name.val("");
                  dni.val("");
                  lastname.val("");
                  //window.swal('La persona seleccionada ya tiene registrada una cuenta de usuario','','warning');
                  //Swal.fire("La persona seleccionada ya tiene registrada una cuenta de usuario","","warning");
                  return;
              }else{
                  name.val(response['name']);
                  lastname.val(response['lastname']);
                  id_diagnostico_ocupada.val(response['id']);

                  estado.val("OCUPADO");
                  estado.prop('disabled', true);

                  grado.css('display', 'block');
                  diagnostico.css('display', 'block');

              }

          },'json');
      },
      onDelete: function (item) {
          name.val("");
          dni.val("");
          lastname.val("");
      }
    });

    search_medico_ocupada.tokenInput(ruta_medico_ocupada.val(), {
        tokenLimit: 1,
        minChars: 4,
        onAdd: function (item) {
            const go = ruta_search_medico_ocupada.val() + "/" + item.id;
            $.get(go, {}, function(response){
                console.log(response);
                if( response['user'] != null ){
                    name.val("");
                    dni.val("");
                    lastname.val("");
                    //window.swal('La persona seleccionada ya tiene registrada una cuenta de usuario','','warning');
                    //Swal.fire("La persona seleccionada ya tiene registrada una cuenta de usuario","","warning");
                    return;
                }else{
                    id_medico_ocupada.val(response['id']);
  
                    estado.val("OCUPADO");
                    estado.prop('disabled', true);
  
                    grado.css('display', 'block');
                    diagnostico.css('display', 'block');
  
                }
  
            },'json');
        },
        onDelete: function (item) {
            name.val("");
            dni.val("");
            lastname.val("");
        }
      });

      search_diagnostico_alta.tokenInput(ruta_diagnostico_alta.val(), {
        tokenLimit: 1,
        minChars: 4,
        onAdd: function (item) {
            const go = ruta_diagnostico_alta.val() + "/" + item.id;
            $.get(go, {}, function(response){
                console.log(response);
                if( response['user'] != null ){
                    name.val("");
                    dni.val("");
                    lastname.val("");
                    //window.swal('La persona seleccionada ya tiene registrada una cuenta de usuario','','warning');
                    //Swal.fire("La persona seleccionada ya tiene registrada una cuenta de usuario","","warning");
                    return;
                }else{
                    name.val(response['name']);
                    lastname.val(response['lastname']);
                    id_diagnostico_alta.val(response['id']);
  
                    estado.val("OCUPADO");
                    estado.prop('disabled', true);
  
                    grado.css('display', 'block');
                    diagnostico.css('display', 'block');
  
                }
  
            },'json');
        },
        onDelete: function (item) {
            name.val("");
            dni.val("");
            lastname.val("");
        }
      });
  
      search_medico_alta.tokenInput(ruta_medico_alta.val(), {
          tokenLimit: 1,
          minChars: 4,
          onAdd: function (item) {
              const go = ruta_medico_alta.val() + "/" + item.id;
              $.get(go, {}, function(response){
                  console.log(response);
                  if( response['user'] != null ){
                      name.val("");
                      dni.val("");
                      lastname.val("");
                      //window.swal('La persona seleccionada ya tiene registrada una cuenta de usuario','','warning');
                      //Swal.fire("La persona seleccionada ya tiene registrada una cuenta de usuario","","warning");
                      return;
                  }else{
                      id_medico_alta.val(response['id']);
    
                      estado.val("OCUPADO");
                      estado.prop('disabled', true);
    
                      grado.css('display', 'block');
                      diagnostico.css('display', 'block');
    
                  }
    
              },'json');
          },
          onDelete: function (item) {
              name.val("");
              dni.val("");
              lastname.val("");
          }
        });


})

function json_habitaciones(hab, pi){
  const habitacion = $('#input_habitacion');
  const piso = $('#input_piso');

  $('#observacion').val("");
  
  $('#diagnostice').val("");
  $('#grade').val("1");
  $('#estado').val("2");
  //$("#estado option[value='2']").remove();

  $('.token-input-delete-token').click();

  // CAMPOS QUE NO SE DEBEN MOSTRAR DESDE EL INICIO DE MODAL - DISPONIBLE
  $('#grado').css('display','none');
  $('#diagnostico').css('display','none');
  $('#doctor').css('display', 'none')

  $('#estado').prop('disabled', false);

    // CAMPOS QUE SE DEBEN MOSTRAR DESDE EL INICIO DE MODAL - DISPONIBLE
    $('#observacion').css('display', 'block');
    $('#paciente').css('display', 'block');
    $('#divOA').css('display','');
    $('#oa').val("");
  habitacion.val(hab); 
  $('#habitacion').val(hab);
  piso.val(pi);

}


function habitacion_ocupada(id,hab, pi, oa, paciente, gd, diagnostico, medico, observacion){
  const habitacion = $('#input_habitacion_ocupada');
  const piso = $('#input_piso_ocupada');

  $('#observacion').val("");
  $('#oa').val("");
  $('#diagnostice').val("");
  $('#grade').val("0");
  $('#estado').val("");


  $('.token-input-delete-token').click();

  $('#grado').css('display','none');
  $('#diagnostico').css('display','none');

  $('#estado').prop('disabled', false);

  habitacion.val(hab);
  $('#habitacion_ocupada').val(hab);
  piso.val(pi);

    $("#habitacion_mover option[value='"+hab+"']").prop('selected', true);
    $("#habitacion_mover_anterior").val(hab);
    $("#piso_mover option[value='"+pi+"']").prop('selected', true);

  $('#input_oa_ocupada').val(oa);
  $('#oa_ocupada').val(oa);

  $('#paciente_ocupada').val(paciente);
  $('#estado_selector').val("2");

  $('#divNuevoDiagnostico').css('display', 'none');
  $('#grado_ocupada').val(gd);
  $('#id_hospitalizacion').val(id);
  $('#diagnostico_ocupado').val(diagnostico);
  $('#medico_ocupado').val(medico);
  $('#observacion_ocupada').val(observacion);

}



function nuevoDiagnostico(){
  $('#divNuevoDiagnostico').css('display', 'block');
}

function nuevoMedico(){
    $('#divNuevoMedico').css('display','block');
}

function descartarDiagnostico(){
    $('#divNuevoDiagnostico').css('display', 'none');
    $('#divNuevoDiagnostico','.token-input-delete-token').click();
}

function descartarMedico(){
    $('#divNuevoMedico').css('display', 'none');
    $('#divNuevoMedico','.token-input-delete-token').click();
}



