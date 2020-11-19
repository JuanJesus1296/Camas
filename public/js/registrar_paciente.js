$(document).ready(function(){
    const search = $("#search");
    const ruta = $('#ruta').val();
    const name = $('#name');
    const lastname = $('#lastname');
    const dni = $('#dni');
    const ruta_personas = $('#ruta_personas').val();

    const registrar_paciente = document.getElementById('registrar_paciente');

    registrar_paciente.addEventListener('click',() => {
      axios.post('/paciente/ajax',{
        apellido_materno: $('#apellido_materno').val(),
        apellido_paterno: $('#apellido_paterno').val(),
        dni: $('#dni').val(),
        nombre: $('#nombre').val(),
        nacimiento: $('#nacimiento').val(),
      })
      .then(
        res => {
            console.log(res.data),
            $('#staticBackdrop').modal('show'),
            $('#agregar_paciente').modal('hide')
        }
      )
      .catch(err => console.log(err))
    });

})
