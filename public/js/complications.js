$(function(){
    $('#tbl').DataTable(
        {
            processing: true,
            serverSide: true,
            ajax: $('#route').val(),
            columns: [
                { data: 'name', name: 'name' },
                { data: 'action', name: 'action', orderable: false, searchable: false}
            ],
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