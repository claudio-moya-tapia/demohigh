$(function() {
    //Slide home
    var mySwiper = new Swiper('.swiper-container',{
      pagination: '.pagination',
      loop:true,
      grabCursor: true,
      paginationClickable: true,
      autoplay: 8000,
      })
      $('.arrow-left').on('click', function(e){
      e.preventDefault()
      mySwiper.swipePrev()
      })
      $('.arrow-right').on('click', function(e){
      e.preventDefault()
      mySwiper.swipeNext()
    })

    //scrollTo
    $('li a').click(function(){
		$.scrollTo($(this).attr('href'),500,{offset:-150} );
		
		$('li a').removeClass('select');
		$(this).addClass('select');
		
        return false;
    });
});

var Enviar = {
    
    email: function(e){
        
        e.preventDefault();
        
        $('.confirm').fadeIn();
        $('.confirm').html('Enviando email, favor espere.');
        
        $.post('enviar.php', {
            Nombre: $('#Nombre').val(),
            Apellido: $('#Apellido').val(),
            Mail: $('#Mail').val(),
            Telefono: $('#Telefono').val(),
            Mensaje: $('#Mensaje').val()
        }, function (data) {
            Enviar.emailOnComplete(data);
        });
    },
    
    emailOnComplete: function(data){
        
        if(data == 'true'){            
            $('.confirm').html('Tu mensaje ha sido <strong>enviado correctamente</strong>.');
        }else{            
            $('.confirm').html('Correo no enviado, intente mas tarde.');
        }
        
    }
};