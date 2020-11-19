$(function () {

    const fecha = $('#fecha');
    const year = $('#year');
    const room = $('#room_id');
    const ruta = $('#route').val();
    const buscar = $('#buscar');
    const page_link = $('.page-link');

    list(ruta);

    fecha.select2({
        theme: "classic",
    });

    year.select2({
        theme: "classic",
    });

    room.select2({
        theme: "classic",
    });

    room.on('change', function () {
        let val = $(this).val();
        let buscar = $('#buscar').val();
        let mes = $('#fecha').val();
        let anio = $('#year').val();


        let ir_a = `${ruta}?mes=${mes}&year=${anio}&q=${buscar}&room=${val}`;
        let search = $(this).val();
        list(ir_a);


    });

    fecha.on('change', function () {

        let val = $(this).val();
        let buscar = $('#buscar').val();
        let anio = $('#year').val();
        let room = $('#room_id').val();

        if (val != '') {

            let ir_a = `${ruta}?mes=${val}&year=${anio}&q=${buscar}&room=${room}`;
            let search = $(this).val();
            list(ir_a);
        }
    });

    year.on('change', function () {

        let val = $(this).val();
        let buscar = $('#buscar').val();
        let mes = $('#fecha').val();
        let room = $('#room_id').val();

        if (val != '') {

            let ir_a = `${ruta}?mes=${mes}&year=${val}&q=${buscar}&room=${room}`;
            let search = $(this).val();
            list(ir_a);
        }
    });

    buscar.on('keyup', function () {
        let mes = fecha.val();
        let search = $(this).val();
        let anio = year.val();
        let room = $('#room_id').val();
        let ir_a = `${ruta}?mes=${mes}&year=${anio}&q=${search}&room=${room}`;

        list(ir_a);
    });

    page_link.on('click', function (e) {
        e.preventDefault();

        let ruta = $(this).prop('href');
        let ir_a = `${ruta}`;
        list(ir_a);
    })


});


function list(ruta) {

    $.get(ruta, {}, function (response) {

        console.log(response);

        let intervenciones = {
            current_page: response['intervenciones']['current_page'],
            data: response['intervenciones']['data'],
            first_page_url: response['intervenciones']['first_page_url'],
            from: response['intervenciones']['from'],
            last_page: response['intervenciones']['last_page'],
            last_page_url: response['intervenciones']['last_page_url'],
            next_page_url: response['intervenciones']['next_page_url'],
            path: response['intervenciones']['path'],
            per_page: response['intervenciones']['per_page'],
            prev_page_url: response['intervenciones']['prev_page_url'],
            to: response['intervenciones']['to'],
            total: response['intervenciones']['total'],
        }



        let html = '';
        let total = 0;

        if (response['intervenciones']['data'].length > 0) {

            $.each(response['intervenciones']['data'], function (index, value) {

                total += Number(value['cantidad']);


                html += "<tr>"
                html += "<td>" + value['name'] + "</td>";
                html += "<td>" + value['date'] + "</td>";
                html += "<td>" + value['cantidad'] + "</td>";
                html += "</tr>";

            });

        } else {

            html += "<tr>"
            html += "<td colspan='3'>No se encontraron registros</td>";
            html += "</tr>";

        }

        $('#tbl > tbody').html(html);
        $('#totalregistros').text(total);

        if (intervenciones['prev_page_url']) {
            $('#anterior').removeClass('disabled');
            $('#anterior > a').prop('href', intervenciones['prev_page_url']);
        } else {
            $('#anterior').addClass('disabled');
            $('#anterior > a').prop('href', '#');
        }

        if (intervenciones['next_page_url']) {
            $('#siguiente').removeClass('disabled');
            $('#siguiente > a').prop('href', intervenciones['next_page_url']);
        } else {
            $('#siguiente').addClass('disabled');
            $('#siguiente > a').prop('href', '#');
        }



        $.each(response['reporte'], function (indice, valor) {
            valor['y'] = Number(valor['y']);
        })

        var chart = new CanvasJS.Chart("chartContainer", {
            animationEnabled: true,
            exportEnabled: true,
            title: {
                text: "Estados de Procedimientos por mes"
            },
            axisX: {
                interval: 1
            },
            axisY2: {
                interlacedColor: "rgba(1,77,101,.2)",
                gridColor: "rgba(1,77,101,.1)",
                title: "Cantidad"
            },
            data: [{
                type: "bar",
                name: "Procedimientos",
                axisYType: "secondary",
                color: "#014D65",
                dataPoints: response['reporte']
            }]
        });
        chart.render();




    }, 'json')


}