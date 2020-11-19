$(function(){
    const especialidad = $("#especialidad");
    const ruta_especialidad = $("#ruta_search_especialidad");
    const id_especialidad = $("#id_especialidad");

    const dni_nombres = $("#buscador");
    const ruta_dni_nombres = $("#ruta_search_buscador");
    const id_dni_nombres = $("#id_buscador");

    especialidad.tokenInput(ruta_especialidad.val(),{
        tokenLimit: 1,
        minChars: 4,
        onAdd: function (item){
            const go = ruta_especialidad.val() + "/" + item.id;
            $.get(go, {}, function(response){
                console.log(response);     
                id_especialidad.val(response['id']);           
            })
        }
    })

    dni_nombres.tokenInput(ruta_dni_nombres.val(),{
        tokenLimit: 1,
        minChars: 4,
        onAdd: function (item){
            const go = ruta_dni_nombres.val() + "/" + item.id;
            $.get(go, {}, function(response){
                console.log(response);     
                id_dni_nombres.val(response['id']);           
            })
        }
    })
})

function mostrarEspecialidad(){
    $('#divNuevaEspecialidad').css('display','block');
}

function descartarEspecialidad(){
    $('#divNuevaEspecialidad').css('display','none');
    $('#divNuevaEspecialidad .token-input-delete-token').click();
}