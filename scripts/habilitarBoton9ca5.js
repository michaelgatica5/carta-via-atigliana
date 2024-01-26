$(function() {
    function habilitar() {
        total=0;
        $('.cantidad').each(function(){
            c=parseInt($(this).val());
            total=total+c;
        });
        
        if(total>0) {
            $('#btnPedir').removeAttr('disabled');
        } else {
            $('#btnPedir').attr('disabled', 'disabled');
        }
    }
    
    $('.cantidad').on('change', function() {
       habilitar(); 
    });
    
    habilitar();
});
