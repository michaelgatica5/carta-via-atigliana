$(function() {
    $('#btnLlamarMozo').on('click',function(e) {
       Swal.fire({
          title: 'Confirmación',
          text: "Confirmá que querés llamar al mozo",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Sí, llamar!',
          cancelButtonText: 'No, cancelar',
        }).then((result) => {
          if (result.value) {
            $.post('php/mesas/llamar_mozo.php',{action: 1}, function(data) {
                if(data.success && data.success==1) {
                    Swal.fire(
                      'Realizado!',
                      'Tu alerta fue enviada.',
                      'success'
                    );
                } else { // puede ser que devuelva una redirección si cerrraron la mesa
                    //location.reload();
                }
            })
            .fail(function() {
                Swal.fire(
                  'Error!',
                  'Ocurrió un error. Por favor volvé a intentarlo.',
                  'error'
                )
            });
          }
        })
    });
});
