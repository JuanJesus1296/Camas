$(function(){
    
    var dtable = $('#tbl').DataTable(
        {
            processing: true,
            serverSide: true,
            ajax: $('#route').val(),
            columns: [
                {data: 'person.name', name: 'person.name'},
                {data: 'person.lastname', name: 'person.lastname'},
                {data: 'person.dni', name: 'person.dni'},
                {data: 'phone', name: 'patients.phone'},
                { data: 'active', name: 'patients.active', render:function (data, type, full, meta) {
                    return data == 1 ? 'Activo' : 'Inactivo'
                }},
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

    $(".dataTables_filter input")
    .unbind() // Unbind previous default bindings
    .bind("input", function(e) { // Bind our desired behavior
        // If the length is 3 or more characters, or the user pressed ENTER, search
        if(this.value.length >= 4 || e.keyCode == 13) {
            // Call the API search function
            dtable.search(this.value).draw();
        }
        // Ensure we clear the search if they backspace far enough
        if(this.value == "") {
            dtable.search("").draw();
        }
        return;
    });

})