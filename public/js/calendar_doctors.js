$(function () {

    const doctor_id = $('#doctor_id');
    const procedure_id = $('#procedure_id');
    const schedule_id = $('#schedule_id');
    const timecheck = $('#anesthesia');
    const time_anest = $('#time_anest');
    const time = $('#time');
    const date = $('#date');
    const form = $('#form');
    const select_room = $('#room_id');

    const doctor = $('#doctor');
    const base_url = $('#base_url');
    doctor.on('change', () => {
        var val = doctor.val();
        var base = base_url.val();
        var redirect = base + '?doctor=' + val;
        location.href = redirect;
    });
    moment.locale('es');
    const now = moment().format("Y-M-D H:m:s");
    console.log(now);
    var ruta = $('#ruta').val();
    var doctor_selected_id = doctor.val();

    doctor.select2({
        width: '100%',
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


    var calendarEl = document.getElementById('calendar');
    var ahora = moment().format("YYYY-MM-DD");
    var calendar = new FullCalendar.Calendar(calendarEl, {
        plugins: ['interaction', 'dayGrid', 'timeGrid', 'momentTimezonePlugin', 'interaction'],
        timeZone: 'America/Lima',
        //themeSystem: 'bootstrap',
        defaultView: 'dayGridMonth',
        //defaultDate: '2019-05-13',
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        //lazyFetching: true,

        eventMouseEnter: function (event) {
            console.log(event);
            const text = event.event.extendedProps.description;

            $(event.el).prop('title', text);

        },
        events: {
            url: ruta,
            extraParams: {
                doctor_id: doctor_selected_id
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



    var socket = io.connect('http://10.4.0.196:3000');

    socket.on('connect', function () {
        console.log('Connected to sockets server');
    });

    socket.on('intervention', function (msg) {
        calendar.refetchEvents();
    });




})