$(function () {

    const start = $('#start');
    const end = $('#end');
    const room_id = $('#room_id');

    $('#end, #start').on('change', function () {

        const val = $('#end').val();

        if (val < start.val()) {
            $('#btn_filtrar').prop('disabled', true);
        } else {
            $('#btn_filtrar').removeAttr('disabled');
        }

    })

    $('#tbl').DataTable({
        "order": [
            [1, "desc"],
            [2, 'asc']
        ],
        "pageLength": 50,
        /*
        processing: true,
        serverSide: true,
        ajax: $('#route').val(),
        columns: [
            {data: 'action', name: 'action', orderable: false, searchable: false},
            {data: 'date', name: 'interventions.date'},
            {data: 'time', searchable: false,name: 'interventions.time', render:function (data, type, full, meta) {
                return data.split(".")[0]
            }},
            {data: 'time_to', searchable: false, name: 'interventions.time_to', render:function (data, type, full, meta) {
                return data.split(".")[0]
            }},
            {data: 'execution_time', name: 'interventions.execution_time', orderable: false, searchable: false, render:function (data, type, full, meta) {
                return data +' minutos';
            }},
            {data: 'patient', name: 'p.fullname'},
            {data: 'oa_code', name: 'oas.oa_code'},
            {data: 'insurance', searchable: false, name: 'insurances.name'},
            {data: 'doctor', name: 'people.fullname'},
            {data: 'procedure', name: 'procedures.name'},
            {data: 'status', searchable: false, name: 'statuses.name'},
            {data: 'drop', name: 'interventions.drop',  orderable: false, searchable: false, render:function (data, type, full, meta) {
                return data == 1 ? 'SI' : 'NO'
            }},
            {data: 'assistance', name: 'assistance',  orderable: false, searchable: false,render:function (data, type, full, meta) {
                return data == 1 ? 'SI' : 'NO'
            }},
            {data: 'origin', name: 'origins.name'},
            {data: 'death', name: 'interventions.death',  orderable: false, searchable: false, render:function (data, type, full, meta) {
                return data == 1 ? 'SI' : 'NO'
            }},
            {data: 'complication', name: 'complications.name', orderable: false, searchable: false},
            {data: 'anesthesiologist', name: 'pe.fullname', searchable: false},
            {data: 'nurse_delivers', name: 'peo.fullname', searchable: false},
            {data: 'urpa_starts', name: 'interventions.urpa_starts' , searchable: false},
            {data: 'nurse_receives', name: 'peo2.fullname', searchable: false},
            {data: 'urpa_ends', name: 'interventions.urpa_ends', orderable: false, searchable: false},
            {data: 'urpa_time', name: 'interventions.urpa_time',  orderable: false, searchable: false},
            {data: 'condition', name: 'conditions.name'},
            {data: 'date_delivery_file', name: 'interventions.date_delivery_file', orderable: false, searchable: false},
            {data: 'date_reception_file', name: 'interventions.date_reception_file', orderable: false, searchable: false},
           
        ],*/


        "language": {
            "lengthMenu": "Mostrar _MENU_ registros por página",
            "zeroRecords": "No encontramos lo que buscabas, lo sentimos",
            "info": "Mostrando página _PAGE_ de _PAGES_",
            "infoEmpty": "No se encontraron registros",
            "infoFiltered": "(filtrados desde _MAX_ registros totales)",
            "sSearch": "Buscar:",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            },
        }
    });
})