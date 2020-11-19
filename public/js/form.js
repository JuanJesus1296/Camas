$(function(){
    
    $('#loading').hide();

    $('#form').on('submit', function(e){
        $('button[type="submit"]').prop('disabled', true);
       $('#loading').show();
    })

})