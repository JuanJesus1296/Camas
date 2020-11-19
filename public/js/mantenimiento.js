function habitacion_mantenimiento(hab, pi){
    const habitacion = $('#input_mantenimiento_alta');
    const piso = $('#input_piso_mantenimiento');
    habitacion.val(hab);
    $('#habitacion_mantenimiento').val(hab);
    piso.val(pi);
  
    $('#estado_mantenimiento').val("3");  
}