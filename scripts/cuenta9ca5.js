$(function() {
    $('body').on('click','.lnkPedirCuenta',function(e){
       e.preventDefault();
       $(this).attr('disabled','disabled');
       href=$(this).attr('href');
       Swal.fire({
          title: 'Confirmación',
          text: "Confirmá que querés pedir la cuenta",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Sí, pedir!',
          cancelButtonText: 'No, cancelar',
        }).then((result) => {
          if (result.value) {
              location.replace(href);
          } else {
              $(this).removeAttr('disabled');
          }
        })
    });
});
