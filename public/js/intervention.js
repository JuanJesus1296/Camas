$(function () {

    //Constantes y Variables
    const doctor_id = $('#doctor_id');
    const procedure_id = $('#procedure_id');
    const schedule_id = $('#schedule_id');
    const timecheck = $('#anesthesia');
    const time_anest = $('#time_anest');
    const time = $('#time');
    const date = $('#date');
    const form = $('#form');
    const select_room = $('#room_id');
    const room = $('#room');
    const base_url = $('#base_url');

    room.on('change', () => {
        var val = room.val();
        var base = base_url.val();
        var redirect = base + '?sala=' + val;
        location.href = redirect;
    });

    form.on('submit', function (e) {
        e.preventDefault();
        var input_date = date.val();
        var fecha = new Date(`${date.val()} ${time.val()}`);
        var hoy = new Date();
        var validacion_fecha = $('#validacion_fecha').val();

        if (input_date == validacion_fecha) {

            if (hoy > fecha) {

                Swal.fire({
                    title: '¿Está seguro de realizar esta acción?',
                    text: "Se registrará una intervención con una hora menor a la actual",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, agregar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.value) {
                        $('#form').off('submit').submit();
                    } else {
                        console.log('cancelad');
                        $('#loading').hide();
                        location.reload();
                    }
                })

                //if( !confirm('¿Selecciono?') )
            } else {
                $('#form').off('submit').submit();
            }

        } else {
            $('#form').off('submit').submit();
        }

    });



    /*
    time.on('change', function(){

        var input_date = date.val();
        var fecha = new Date(`${date.val()} ${time.val()}`);
        var hoy = new Date();
        var validacion_fecha = $('#validacion_fecha').val();

        if( input_date == validacion_fecha ){

            if( hoy > fecha ){
                
                console.log('Fecha seleccionada menor');
                //$('#error_time').text('Introducir una hora mayor a la actual');
                $('#guardar').prop('disabled', true);

                if( confirm('¿Está seguro de registrar una intervención con una ahora menor a la actual?') ){
                    $('#guardar').removeAttr('disabled');
                } else {
                    $('#guardar').prop('disabled', true);
                }
                
               //if( !confirm('¿Selecciono?') )
            }
            
            else{
                $('#guardar').removeAttr('disabled');
                //$('#error_time').text('');
            }
            
        }

       
        
    })
    
    */

    timecheck.on('change', function () {
        if (this.checked) {
            console.log('checked');
            time_anest.val('30');
            time_anest.removeAttr('readonly');

        } else {
            console.log('no checked');
            time_anest.val('0');
            time_anest.prop('readonly', true);
        }
    });

    doctor_id.select2({
        width: '100%',
        dropdownParent: $("#exampleModal")
    });

    procedure_id.select2({
        width: '100%',
        dropdownParent: $("#exampleModal")
    });

    schedule_id.select2({
        width: '100%',
        dropdownParent: $("#exampleModal")
    });

    select_room.select2({
        width: '100%',
        dropdownParent: $("#exampleModal")
    });

    var ruta = $('#ruta').val();
    var room_id = room.val();
    var calendarEl = document.getElementById('calendar');
    var ahora = moment().format("YYYY-MM-DD");
    var calendar = new FullCalendar.Calendar(calendarEl, {

        plugins: ['interaction', 'dayGrid', 'timeGrid', 'interaction'],
        droppable: true,
        timeZone: 'America/Lima',
        lange: 'es',
        //themeSystem: 'bootstrap',
        defaultView: 'dayGridMonth',
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        eventMouseEnter: function (event) {
            //console.log(event);
            const text = event.event.extendedProps.description;

            $(event.el).prop('title', text);
        },
        events: {
            url: ruta,
            extraParams: {
                room_id: room_id
            },
        },

    });

    calendar.setOption('locale', 'es');
    calendar.render();



    calendar.on('dateClick', function (info) {

        let now = moment().format("YYYY-MM-DD");

        let fecha = moment(info.dateStr).format("YYYY-MM-DD");

        let hora_separada = info.dateStr.split("T");
        let hora_seleccionada = hora_separada[1];

        if (fecha >= ahora) {

            $('#date').val(fecha);
            hora_seleccionada == 'undefined' ? $('#time').val('') : $('#time').val(hora_seleccionada);
            $('#exampleModal').modal({
                keyboard: false,
                backdrop: 'static',
            });

        } else {

            Swal.fire({
                title: '¿Está seguro de realizar esta acción?',
                text: "Se registrará una intervención con una fecha menor a la actual",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, agregar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.value) {
                    $('#date').val(fecha);
                    hora_seleccionada == 'undefined' ? $('#time').val('') : $('#time').val(hora_seleccionada);
                    $('#exampleModal').modal({
                        keyboard: false,
                        backdrop: 'static',
                    });
                }
            })
            /*
            Swal.fire(
                'Oooops!',
                'Lo Sentimos, el Sistema no permite registrar intervenciones con fechas menores a la actual.',
                'warning'
            )
            */


        }


    });


    var socket = io.connect('http://10.0.4.196:3000');

    socket.on('connect', function () {
        console.log('Connected to sockets server');
    });

    socket.on('intervention', function (msg) {
        calendar.refetchEvents();
    });




})