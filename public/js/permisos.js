$(function(){
    $( "input[type=checkbox]" ).on( "click", function(){
        let id = $(this).data('id');
        let url = $('#route').val();

        $.get(url, {permiso: id}, function(response){
            console.log(response);
        },'json')
    });
});