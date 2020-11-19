$(function () {

    //Constantes y Variables
    const doctor_id = $('#doctor_id');
    const room_id = $('#room_id');
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
    const role_input = $('#role_input').val();
    const info = $('#info');
    const timecheck = $('#anesthesia');
    const time_anest = $('#time_anest');
    const opciones = $('.opciones');
    const edit_modal = $('#edit_modal');
    const name_edit = $('#name_edit');
    const lastname_edit = $('#lastname_edit');
    const dni_edit = $('#dni_edit');
    const phone_edit = $('#phone_edit');
    const cambiar_paciente = $('#cambiar_paciente');
    const cancel_modal = $('#cancel_modal');
    const btn_search_new = $('#btn_search_new');
    const name_actualizar = $('#name_actualizar');
    const lastname_actualizar = $('#lastname_actualizar');
    const dni_actualizar = $('#dni_actualizar');
    const phone_actualizar = $('#phone_actualizar');
    const search_dni = $('#search_dni').val();
    const id_actualizar = $('#id_actualizar');
    const ruta_cambiar = $('#ruta_cambiar');

    btn_search_new.on('click', function () {
        let dni = dni_actualizar.val();
        let ruta = `${search_dni}/json/patients/${dni}`;
        $.get(ruta, function (response) {
            name_actualizar.val(response['name']);
            lastname_actualizar.val(response['lastname']);
            dni_actualizar.val(response['dni']);
            phone_actualizar.val(response['patient']['phone']);
            id_actualizar.val(response['patient']['id']);
        }, 'json')
    });

    cambiar_paciente.on('click', function (e) {
        e.preventDefault();
        cancel_modal.click();
        $('#exampleModal_edit').modal();
    })

    edit_modal.on('click', function () {

        name_edit.val(name.val());
        lastname_edit.val(lastname.val());
        dni_edit.val(dni.val());
        phone_edit.val(phone.val());
        $('#exampleModal').modal();
    })

    $.each(opciones, function (index, value) {
        if ($(this).hasClass('no')) {
            $(this).hide();
        }
    })

    if (role_input == 'Médico') {

        info.hide();

    }

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

    room_id.select2({
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


})

function ponerCeros(obj) {
    if (obj.value == '') return;
    while (obj.value.length < 10)
        obj.value = '0' + obj.value;
}