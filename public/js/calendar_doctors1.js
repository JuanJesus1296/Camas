$(function () {

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
    var doctor_id = doctor.val();

    doctor.select2({
        width: '100%',
    });

    var calendarEl = document.getElementById('calendar');

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
                doctor_id: doctor_id
            },
        },

    });

    calendar.setOption('locale', 'es');
    calendar.render();


    var socket = io.connect('http://10.4.0.196:3000');

    socket.on('connect', function () {
        console.log('Connected to sockets server');
    });

    socket.on('intervention', function (msg) {
        calendar.refetchEvents();
    });




})