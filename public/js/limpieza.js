function habitacion_limpieza(hab, pi){
    const habitacion = $('#input_limpieza_alta');
    const piso = $('#input_piso_limpieza');
    habitacion.val(hab);
    $('#habitacion_limpieza').val(hab);
    piso.val(pi);
  
    $('#estado_limpieza').val("4");  
}