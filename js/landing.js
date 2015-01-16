/**
 * 
 * @class Landing
 * @extends Controller
 */
function Landing() {
    this.init();
    this.imagen = '#Usuario_imagen';
    this.img = '#Usuario_img';
}

Landing.prototype = new Controller();
Landing.prototype.constructor = Landing;

Landing.prototype.index = function() {

    Documento.uploadify(
            '#DocumentoUpload',
            this.onUploadSuccess,
            200
            );

    if ($(this.imagen).val() != 'images/empty.gif') {
        $(this.img).attr('src', Config.baseUrlImg + $(this.imagen).val());
    }
    
    /**
     * Avatares
     */
    $('#avatarImg1,#avatarImg2,#avatarImg3,#avatarImg4,#avatarImg5,#avatarImg6,#avatarImg7,#avatarImg8').click(function(){       
        var id = new String($(this).attr('id'));
        var idRadio = id.replace('Img','');       
        $('#'+idRadio).attr('checked','checked');
    });

    /**
     * Pasos para landing usuarios
     */
	$('#siguientePaso3').click(function(e) {
		if (e.preventDefault) {
			e.preventDefault();
		} else {
			e.returnValue = false;
		}


		var usuarioName = $.trim($('#usuarioName').val());

		if (usuarioName != '') {

			$("#paso3").fadeOut("slow", function() {
				$("#paso4").fadeIn("slow", function() {

				});
			});

		} else {
			alert("Necesita agregar un nickname");
		}
	});
    
    $('#anteriorPaso4').click(function(e) {
        if (e.preventDefault) {
            e.preventDefault();
        } else {
            e.returnValue = false;
        }

        $("#paso4").fadeOut("slow", function() {
            $("#paso3").fadeIn("slow", function() {

            });
        });
    });

    $('#siguientePaso4').click(function(e) {
        if (e.preventDefault) {
            e.preventDefault();
        } else {
            e.returnValue = false;
        }

        if ($("#avatar1").is(':checked')) {
            $('#isLocalAvatar').val('si');
            $('#ImgDB').val("/images/avatar-1.jpg");
            $("#paso4").fadeOut("slow", function() {
                $("#paso5").fadeIn("slow", function() {

                });
            });
        }

        if ($("#avatar2").is(':checked')) {
            $('#isLocalAvatar').val('si');
            $('#ImgDB').val("/images/avatar-2.jpg");
            $("#paso4").fadeOut("slow", function() {
                $("#paso5").fadeIn("slow", function() {

                });
            });
        }

        if ($("#avatar3").is(':checked')) {
            $('#isLocalAvatar').val('si');
            $('#ImgDB').val("/images/avatar-3.jpg");
            $("#paso4").fadeOut("slow", function() {
                $("#paso5").fadeIn("slow", function() {

                });
            });
        }

        if ($("#avatar4").is(':checked')) {
            $('#isLocalAvatar').val('si');
            $('#ImgDB').val("/images/avatar-4.jpg");
            $("#paso4").fadeOut("slow", function() {
                $("#paso5").fadeIn("slow", function() {

                });
            });
        }

        if ($("#avatar5").is(':checked')) {
            $('#isLocalAvatar').val('si');
            $('#ImgDB').val("/images/avatar-5.jpg");
            $("#paso4").fadeOut("slow", function() {
                $("#paso5").fadeIn("slow", function() {

                });
            });
        }

        if ($("#avatar6").is(':checked')) {
            $('#isLocalAvatar').val('si');
            $('#ImgDB').val("/images/avatar-6.jpg");
            $("#paso4").fadeOut("slow", function() {
                $("#paso5").fadeIn("slow", function() {

                });
            });
        }

        if ($("#avatar7").is(':checked')) {
            $('#isLocalAvatar').val('si');
            $('#ImgDB').val("/images/avatar-7.jpg");
            $("#paso4").fadeOut("slow", function() {
                $("#paso5").fadeIn("slow", function() {

                });
            });
        }

        if ($("#avatar8").is(':checked')) {
            $('#isLocalAvatar').val('si');
            $('#ImgDB').val("/images/avatar-8.jpg");
            $("#paso4").fadeOut("slow", function() {
                $("#paso5").fadeIn("slow", function() {

                });
            });
        }

        /**
         * Nueva validacion para uploadify
         * 
         */
        if ($('#isLocalAvatar').val() == 'no') {

            $('#ImgDB').val($('#Usuario_imagen').val());
            $("#paso4").fadeOut("slow", function() {
                $("#paso5").fadeIn("slow", function() {

                });
            });
        }

    });

    $('#anteriorPaso5').click(function(e) {
        if (e.preventDefault) {
            e.preventDefault();
        } else {
            e.returnValue = false;
        }
        $("#paso5").fadeOut("slow", function() {
            $("#paso4").fadeIn("slow", function() {

            });
        });

    });

    $('#siguientePaso5').click(function(e) {
        if (e.preventDefault) {
            e.preventDefault();
        } else {
            e.returnValue = false;
        }
        $("#paso5").fadeOut("slow", function() {
            $("#paso6").fadeIn("slow", function() {

            });
        });
    });

    $('#siguientePaso6').click(function(e) {
        if (e.preventDefault) {
            e.preventDefault();
        } else {
            e.returnValue = false;
        }
        var redirect = window.location.href;
        var repla = redirect.replace('landing', 'home')
        var landing = new Landing();
        var nickname = $('#usuarioName').val();
        var img = $('#ImgDB').val();
		
		var updateMoreFields = $('#updateMoreFields').val();
		var usuario_pais_id = $('#Usuario_usuario_pais_id').val();
		var usuarioNombres = $('#usuarioNombres').val();
		var usuarioApellidoPaterno = $('#usuarioApellidoPaterno').val();
		var usuarioApellidoMaterno = $('#usuarioApellidoMaterno').val();
		var usuarioRut = $('#usuarioRut').val();
		
        $.get(landing.getActionUrl('ajaxInsert'), {
				nickname: nickname, 
				img: img,
				updateMoreFields:updateMoreFields,
				usuario_pais_id:usuario_pais_id,
				usuarioNombres:usuarioNombres,
				usuarioApellidoPaterno:usuarioApellidoPaterno,
				usuarioApellidoMaterno:usuarioApellidoMaterno,
				usuarioRut:usuarioRut
			}, function(response) {
            window.location = repla;
        });
    });
};

Landing.prototype.onUploadSuccess = function(DocumentoJson) {

    var landing = new Landing();
    $(landing.imagen).val(DocumentoJson.url);
    $(landing.img).attr('src', Config.baseUrlImg + DocumentoJson.url);
    $('#isLocalAvatar').val('no');
};