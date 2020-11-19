$(function () {

    //Constantes y Variables
    const doctor_id = $('#doctor_id');
    const procedure_id = $('#procedure_id');
    const schedule_id = $('#schedule_id');
    const anesthesiologist_id = $('#anesthesiologist_id');
    const nurse_delivers_id = $('#nurse_delivers_id');
    const nurse_receives_id = $('#nurse_receives_id');
    const status_id = $('#status_id');
    const assistance = $('#assistance');
    const origin_id = $('#origin_id');
    const complication_id = $('#complication_id');
    const death = $('#death');
    const drop = $('#drop');
    const condition_id = $('#condition_id');
    const insurance_id = $('#insurance_id');
    const search = $("#search");
    const ruta = $('#ruta_search');
    const ruta_paciente = $('#ruta_paciente');
    const name = $('#name');
    const lastname = $('#lastname');
    const dni = $('#dni');
    const phone = $('#phone');
    const patient_id = $('#patient_id');
    const urpa_starts = $('#urpa_starts');
    const urpa_ends = $('#urpa_ends');
    const date_delivery_file = $('#date_delivery_file');
    const date_reception_file = $('#date_reception_file');
    const timecheck = $('#anesthesia');
    const time_anest = $('#time_anest');
    const form = $('#form');
    const date = $('#date');
    const time = $('#time');
    const room_id = $("#room_id");

    form.on('submit', function (e) {
        e.preventDefault();
        var input_date = date.val();
        var fecha = new Date(`${date.val()} ${time.val()}`);
        var hoy = new Date();
        var validacion_fecha = $('#validacion_fecha').val();



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

    search.tokenInput(ruta.val(), {
        tokenLimit: 1,
        minChars: 4,
        onAdd: function (item) {
            const go = ruta_paciente.val() + "/" + item.id;
            $.get(go, {}, function (response) {
                name.val(response['person']['name']);
                lastname.val(response['person']['lastname']);
                dni.val(response['person']['dni']);
                phone.val(response['phone']);
                patient_id.val(response['id']);
            }, 'json');
        },
        onDelete: function (item) {
            name.val("");
            lastname.val("");
            dni.val("");
            phone.val("");
            patient_id.val("");
        }
    });

    date_delivery_file.on('change', function () {
        let fecha = $(this).val();
        date_reception_file.prop('min', fecha);
    });

    urpa_starts.on('change', function () {
        let time = $(this).val();
        urpa_ends.prop('min', time);
    });

    doctor_id.select2({
        theme: "classic",
        width: '100%',
    });

    procedure_id.select2({
        theme: "classic",
        width: '100%',
    });

    schedule_id.select2({
        theme: "classic",
        width: '100%',

    });

    anesthesiologist_id.select2({
        theme: "classic",
        width: '100%',
    });

    nurse_delivers_id.select2({
        theme: "classic",
        width: '100%',
    });

    nurse_receives_id.select2({
        theme: "classic",
        width: '100%',
    });

    status_id.select2({
        theme: "classic",
        width: '100%',
    });

    assistance.select2({
        theme: "classic",
        width: '100%',
    });

    origin_id.select2({
        theme: "classic",
        width: '100%',
    });

    complication_id.select2({
        theme: "classic",
        width: '100%',
    });

    death.select2({
        theme: "classic",
        width: '100%',
    });

    drop.select2({
        theme: "classic",
        width: '100%',
    });

    condition_id.select2({
        theme: "classic",
        width: '100%',
    });

    insurance_id.select2({
        theme: "classic",
        width: '100%',
    });

    room_id.select2({
        theme: "classic",
        width: '100%',
    });


})


function ponerCeros(obj) {

    if (obj.value == '') return;

    while (obj.value.length < 10)
        obj.value = '0' + obj.value;
}