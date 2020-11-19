$(function(){
    const search = $("#search");
    const ruta = $('#ruta').val();
    const name = $('#name');
    const lastname = $('#lastname');
    const phone = $('#phone');
    const dni = $('#dni');
    const ruta_personas = $('#ruta_personas').val();

    search.tokenInput(ruta, {
        tokenLimit: 1,
        minChars: 4,
        onAdd: function (item) {
            const go = ruta_personas + "/" + item.id;
            $.get(go, {}, function(response){
                console.log(response);
                name.val(response['name']);
                dni.val(response['dni']);
                lastname.val(response['lastname']);
                phone.val("");
            },'json');
        },
        onDelete: function (item) {
            name.val("");
            dni.val("");
            lastname.val("");
            phone.val("");
        }
    });
})