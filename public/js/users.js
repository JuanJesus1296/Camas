$(function(){

    const search = $("#search");
    const ruta = $('#ruta_search');
    const name  = $('#name');
    const lastname = $('#lastname');
    const dni = $('#dni');


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
                    window.swal('La persona seleccionada ya tiene registrada una cuenta de usuario','','warning');
                    //Swal.fire("La persona seleccionada ya tiene registrada una cuenta de usuario","","warning");
                    return;
                }else{
                    name.val(response['name']);
                    lastname.val(response['lastname']);
                    dni.val(response['document']);
                }

            },'json');
        },
        onDelete: function (item) {
            name.val("");
            dni.val("");
            lastname.val("");
        }

    });


    $('#tbl').DataTable(
        {
            "language": {
                "lengthMenu": "Mostrar _MENU_ registros por página",
                "zeroRecords": "No encontramos lo que buscabas, lo sentimos",
                "info": "Mostrando página _PAGE_ de _PAGES_",
                "infoEmpty": "No se encontraron registros",
                "infoFiltered": "(filtrados desde _MAX_ registros totales)",
                "sSearch": "Buscar:",
                "oPaginate": {
                    "sFirst":    "Primero",
                    "sLast":     "Último",
                    "sNext":     "Siguiente",
                    "sPrevious": "Anterior"
                },
            }
        }
    );
})
