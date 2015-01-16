/**
 * 
 * @class Shared
 */
var Shared = {
    aryVersusJSON:{},
    aryVersus:[],
    loginType: 'new',
    login: function() {

        $('#btnSiguiente').click(function(e) {
            if (e.preventDefault) {
                e.preventDefault();
            } else {
                e.returnValue = false;
            }

            var value = new String($('#userName').val());
            $('#userName').val(value.toLowerCase());
            Shared.ajaxCheckLogin($('#userName').val());
        });

        $('#btnIngresar').click(function(e) {
            if (e.preventDefault) {
                e.preventDefault();
            } else {
                e.returnValue = false;
            }

            $('#loadingMsg').html('Cargando...');
            $('#loadingBox').slideDown();

            Shared.loginFormCheck();
        });

    },
    loginFormCheck: function() {

        var formOk = true;
        var userName = new String($.trim($('#userName').val()));
        var userPass = new String($.trim($('#userPass').val()));
        var userPassConfirm = new String($.trim($('#userPassConfirm').val()));

        if (userName.length == 0) {
            formOk = false;
            $('#msgUserName').fadeIn(function() {
                $('#userName').val('');
                $(this).html('El campo no puede estar vacío.');
            });
        }

        if (userPass.length < 5) {
            formOk = false;
            $('#msgUserPass').fadeIn(function() {
                $('#userPass').val('');
                $(this).html('La contraseña debe tener al menos 5 caracteres.');
            });

        }

        if (Shared.loginType == 'new') {

            if (userPassConfirm.length < 5) {
                formOk = false;
                $('#msgPassConfirm').fadeIn(function() {
                    $('#userPassConfirm').val('');
                    $(this).html('La contraseña debe tener al menos 5 caracteres.');
                });
            }

            if (userPass.toString() != userPassConfirm.toString()) {
                formOk = false;
                $('#msgPassConfirm').fadeIn(function() {
                    $('#userPass').val('');
                    $('#userPassConfirm').val('');
                    $(this).html('Las contraseñas no coinciden.');
                });
            }

        } else {

        }

        if (formOk) {

            $('#loadingMsg').html('Cargando...');
            $('#loadingBox').slideDown();

            var token = $('#LoginForm_token').val();

            var userNameEnctrypt = Aes.Ctr.encrypt(userName.toString(), token, 256);
            var userPassEnctrypt = Aes.Ctr.encrypt(userPass.toString(), token, 256);
            var userPassConfirmEnctrypt = Aes.Ctr.encrypt(userPassConfirm.toString(), token, 256);

            $('.paso2').hide();
            $('#pasoIngresando').show();

            $('#userNameEnc').val(userNameEnctrypt);
            $('#userPassEnc').val(userPassEnctrypt);
            $('#userPassConfirm').val(userPassConfirmEnctrypt);

            $('#login-form').submit();
        }
    },
    ajaxCheckLogin: function(userName) {

        $('#loadingMsg').html('Cargando...');
        $('#loadingBox').slideDown();

        var usuario = new Usuario();

        $.getJSON(usuario.getActionUrl('ajaxCheckLogin'), {userName: userName}, function(data) {
            Shared.ajaxCheckLoginResponse(data);
        });
    },
    ajaxCheckLoginResponse: function(response) {

        $('#loadingBox').slideUp(function() {
            $('#loadingMsg').html('');
        });

        Shared.loginResetSubmit();

        if (response.status == 'valid_user') {

            Shared.loginDisableNext();

            if (response.load_landing == 'ok') {
                Shared.loginType = 'new';
                Shared.loginEnablePassNew();
                Shared.loginEnablePassConfirm();
            } else {
                Shared.loginType = 'old';

                Shared.loginEnablePass();
                Shared.loginEnablePassForget();
            }

            Shared.loginEnableSubmit();

        } else {
            Shared.loginErrorUser();
        }
    },
    loginDisableNext: function() {
        $('#btnSiguiente').slideUp();
    },
    loginErrorUser: function() {
        $('#msgUserName').fadeIn(function() {
            $('#userName').val('');
            $(this).html('Usuario inválido.');
        });
    },
    loginResetSubmit: function() {
        $('#userPass, #userPassConfirm').html('');
        $('#boxPass, #boxPassConfirm').fadeOut();

        $('#msgUserName, #msgUserPass, #msgPassConfirm').html('');
        $('#msgUserName, #msgUserPass, #msgPassConfirm').fadeOut();

        $('#btnIngresar').fadeOut();
    },
    loginEnablePassForget: function() {
        //$('#btnPassForget').fadeIn();
    },
    loginDisablePassForget: function() {
        $('#btnPassForget').fadeOut();
    },
    loginEnablePassNew: function() {
        $('#boxPass label').html('Crear contraseña');
        $('#boxPass').fadeIn();
    },
    loginEnablePass: function() {
        $('#boxPass').fadeIn();
    },
    loginEnablePassConfirm: function() {
        $('#boxPassConfirm').fadeIn();
    },
    loginEnableSubmit: function() {
        $('#btnIngresar').fadeIn();
    },
    analytics: function(clase) {
        var href = location.href.toString();
        var url = decodeURI(href.split(Config.baseUrl)[1]);
        var analytic = new Analytic();

        $.getJSON(analytic.getActionUrl('create'), {url: url}, function(data) {
        });
    },

    canPlay: function(versus_id) {
        var canPlayStatus = true;
        var versus = new Versus();
        
                
        for(var i in Shared.aryVersusJSON){
            versus = Shared.aryVersusJSON[i];
            
            if(versus.versus_id == versus_id){
                
                if(versus.canplay == 0){   
                    canPlayStatus = false;
                    break;
                }
            }
        }
        
//        var checkVersus = false;
//        var minDiff = 0;
//        var hourDiff = 0;
//        var aryVersus = Shared.getVersus();
//        var versus = new Versus();
//        var dateNow = new Date();
//        //var dateNow = new Date(2014, 5, 13, 16, 55, 0, 0);
//
//        for (var x in aryVersus) {
//            versus = new Versus();
//            versus.set(aryVersus[x]);
//
//            if (versus.versus_id == versus_id) {
//
//                var nowCompareDate = dateNow.getFullYear() + '-' + dateNow.getMonth() + '-' + dateNow.getDate();
//                var nowCompareHour = dateNow.getHours() + ':' + dateNow.getMinutes();
//
//                var versusCompareDate = versus.fecha.getFullYear() + '-' + versus.fecha.getMonth() + '-' + versus.fecha.getDate();
//                var versusCompareHour = versus.fecha.getHours() + ':' + versus.fecha.getMinutes();
//
//                if (nowCompareDate < versusCompareDate) {
//                    canPlayStatus = true;
//                }
//
//                if (nowCompareDate == versusCompareDate) {
//
//                    var hoursToMinsItem = versus.fecha.getHours() * 60;
//                    var hoursToMinsNow = dateNow.getHours() * 60;
//                    minDiff = (hoursToMinsNow + dateNow.getMinutes()) - (hoursToMinsItem + versus.fecha.getMinutes());
//                    hourDiff = Math.floor(minDiff / 60);
//
//                    if (hourDiff < 0) {
//                        //hora anterior                        
//                        if (minDiff < 0) {
//
//                            if (minDiff >= -5) {
//                                canPlayStatus = false;
//                            }
//                        }
//                    }
//
//                    if (hourDiff == 0) {
//                        //misma hora
//                        canPlayStatus = false;
//                    }
//
//                    if (hourDiff > 0) {
//                        //hora superada
//                        canPlayStatus = false;
//                    }
//                }
//
//                if (nowCompareDate > versusCompareDate) {
//                    canPlayStatus = false;
//                }
//            }
//        }

        return canPlayStatus;
    },
    /* @returns {Grupo} grupo */
    getGrupos: function() {
        var aryGrupos = new Array();

        var grupo = new Grupo();
        grupo.grupo_id = 1;
        grupo.nombre = 'Grupo A';

        aryGrupos.push(grupo);

        var grupo = new Grupo();
        grupo.grupo_id = 2;
        grupo.nombre = 'Grupo B';

        aryGrupos.push(grupo);

        var grupo = new Grupo();
        grupo.grupo_id = 3;
        grupo.nombre = 'Grupo C';

        aryGrupos.push(grupo);

        var grupo = new Grupo();
        grupo.grupo_id = 4;
        grupo.nombre = 'Grupo D';

        aryGrupos.push(grupo);

        var grupo = new Grupo();
        grupo.grupo_id = 5;
        grupo.nombre = 'Grupo E';

        aryGrupos.push(grupo);

        var grupo = new Grupo();
        grupo.grupo_id = 6;
        grupo.nombre = 'Grupo F';

        aryGrupos.push(grupo);

        var grupo = new Grupo();
        grupo.grupo_id = 7;
        grupo.nombre = 'Grupo G';

        aryGrupos.push(grupo);

        var grupo = new Grupo();
        grupo.grupo_id = 8;
        grupo.nombre = 'Grupo H';

        aryGrupos.push(grupo);

        return aryGrupos;
    },
    /* @returns {Pais} pais */
    getPaises: function() {
        var aryPaises = new Array();

        var grupo = new Grupo();
        grupo.grupo_id = 1;
        grupo.nombre = 'Grupo A';

        var pais = new Pais();
        pais.pais_id = 1;
        pais.nombre = 'Brasil';
        pais.grupo = grupo;

        aryPaises.push(pais);

        var grupo = new Grupo();
        grupo.grupo_id = 1;
        grupo.nombre = 'Grupo A';

        var pais = new Pais();
        pais.pais_id = 2;
        pais.nombre = 'Croacia';
        pais.grupo = grupo;

        aryPaises.push(pais);

        var grupo = new Grupo();
        grupo.grupo_id = 1;
        grupo.nombre = 'Grupo A';

        var pais = new Pais();
        pais.pais_id = 3;
        pais.nombre = 'MÃ©xico';
        pais.grupo = grupo;

        aryPaises.push(pais);

        var grupo = new Grupo();
        grupo.grupo_id = 1;
        grupo.nombre = 'Grupo A';

        var pais = new Pais();
        pais.pais_id = 4;
        pais.nombre = 'CamerÃºn';
        pais.grupo = grupo;

        aryPaises.push(pais);

        var grupo = new Grupo();
        grupo.grupo_id = 2;
        grupo.nombre = 'Grupo B';

        var pais = new Pais();
        pais.pais_id = 5;
        pais.nombre = 'EspaÃ±a';
        pais.grupo = grupo;

        aryPaises.push(pais);

        var grupo = new Grupo();
        grupo.grupo_id = 2;
        grupo.nombre = 'Grupo B';

        var pais = new Pais();
        pais.pais_id = 6;
        pais.nombre = 'Holanda';
        pais.grupo = grupo;

        aryPaises.push(pais);

        var grupo = new Grupo();
        grupo.grupo_id = 2;
        grupo.nombre = 'Grupo B';

        var pais = new Pais();
        pais.pais_id = 7;
        pais.nombre = 'Chile';
        pais.grupo = grupo;

        aryPaises.push(pais);

        var grupo = new Grupo();
        grupo.grupo_id = 2;
        grupo.nombre = 'Grupo B';

        var pais = new Pais();
        pais.pais_id = 8;
        pais.nombre = 'Australia';
        pais.grupo = grupo;

        aryPaises.push(pais);

        var grupo = new Grupo();
        grupo.grupo_id = 3;
        grupo.nombre = 'Grupo C';

        var pais = new Pais();
        pais.pais_id = 9;
        pais.nombre = 'Colombia';
        pais.grupo = grupo;

        aryPaises.push(pais);

        var grupo = new Grupo();
        grupo.grupo_id = 3;
        grupo.nombre = 'Grupo C';

        var pais = new Pais();
        pais.pais_id = 10;
        pais.nombre = 'Grecia';
        pais.grupo = grupo;

        aryPaises.push(pais);

        var grupo = new Grupo();
        grupo.grupo_id = 3;
        grupo.nombre = 'Grupo C';

        var pais = new Pais();
        pais.pais_id = 11;
        pais.nombre = 'Costa de Marfil';
        pais.grupo = grupo;

        aryPaises.push(pais);

        var grupo = new Grupo();
        grupo.grupo_id = 3;
        grupo.nombre = 'Grupo C';

        var pais = new Pais();
        pais.pais_id = 12;
        pais.nombre = 'JapÃ³n';
        pais.grupo = grupo;

        aryPaises.push(pais);

        var grupo = new Grupo();
        grupo.grupo_id = 4;
        grupo.nombre = 'Grupo D';

        var pais = new Pais();
        pais.pais_id = 13;
        pais.nombre = 'Uruguay';
        pais.grupo = grupo;

        aryPaises.push(pais);

        var grupo = new Grupo();
        grupo.grupo_id = 4;
        grupo.nombre = 'Grupo D';

        var pais = new Pais();
        pais.pais_id = 14;
        pais.nombre = 'Costa Rica';
        pais.grupo = grupo;

        aryPaises.push(pais);

        var grupo = new Grupo();
        grupo.grupo_id = 4;
        grupo.nombre = 'Grupo D';

        var pais = new Pais();
        pais.pais_id = 15;
        pais.nombre = 'Inglaterra';
        pais.grupo = grupo;

        aryPaises.push(pais);

        var grupo = new Grupo();
        grupo.grupo_id = 4;
        grupo.nombre = 'Grupo D';

        var pais = new Pais();
        pais.pais_id = 16;
        pais.nombre = 'Italia';
        pais.grupo = grupo;

        aryPaises.push(pais);

        var grupo = new Grupo();
        grupo.grupo_id = 5;
        grupo.nombre = 'Grupo E';

        var pais = new Pais();
        pais.pais_id = 17;
        pais.nombre = 'Suiza';
        pais.grupo = grupo;

        aryPaises.push(pais);

        var grupo = new Grupo();
        grupo.grupo_id = 5;
        grupo.nombre = 'Grupo E';

        var pais = new Pais();
        pais.pais_id = 18;
        pais.nombre = 'Ecuador';
        pais.grupo = grupo;

        aryPaises.push(pais);

        var grupo = new Grupo();
        grupo.grupo_id = 5;
        grupo.nombre = 'Grupo E';

        var pais = new Pais();
        pais.pais_id = 19;
        pais.nombre = 'Francia';
        pais.grupo = grupo;

        aryPaises.push(pais);

        var grupo = new Grupo();
        grupo.grupo_id = 5;
        grupo.nombre = 'Grupo E';

        var pais = new Pais();
        pais.pais_id = 20;
        pais.nombre = 'Honduras';
        pais.grupo = grupo;

        aryPaises.push(pais);

        var grupo = new Grupo();
        grupo.grupo_id = 6;
        grupo.nombre = 'Grupo F';

        var pais = new Pais();
        pais.pais_id = 21;
        pais.nombre = 'Argentina';
        pais.grupo = grupo;

        aryPaises.push(pais);

        var grupo = new Grupo();
        grupo.grupo_id = 6;
        grupo.nombre = 'Grupo F';

        var pais = new Pais();
        pais.pais_id = 22;
        pais.nombre = 'Bosnia Herzegovina';
        pais.grupo = grupo;

        aryPaises.push(pais);

        var grupo = new Grupo();
        grupo.grupo_id = 6;
        grupo.nombre = 'Grupo F';

        var pais = new Pais();
        pais.pais_id = 23;
        pais.nombre = 'IrÃ¡n';
        pais.grupo = grupo;

        aryPaises.push(pais);

        var grupo = new Grupo();
        grupo.grupo_id = 6;
        grupo.nombre = 'Grupo F';

        var pais = new Pais();
        pais.pais_id = 24;
        pais.nombre = 'Nigeria';
        pais.grupo = grupo;

        aryPaises.push(pais);

        var grupo = new Grupo();
        grupo.grupo_id = 7;
        grupo.nombre = 'Grupo G';

        var pais = new Pais();
        pais.pais_id = 25;
        pais.nombre = 'Alemania';
        pais.grupo = grupo;

        aryPaises.push(pais);

        var grupo = new Grupo();
        grupo.grupo_id = 7;
        grupo.nombre = 'Grupo G';

        var pais = new Pais();
        pais.pais_id = 26;
        pais.nombre = 'Portugal';
        pais.grupo = grupo;

        aryPaises.push(pais);

        var grupo = new Grupo();
        grupo.grupo_id = 7;
        grupo.nombre = 'Grupo G';

        var pais = new Pais();
        pais.pais_id = 27;
        pais.nombre = 'Ghana';
        pais.grupo = grupo;

        aryPaises.push(pais);

        var grupo = new Grupo();
        grupo.grupo_id = 7;
        grupo.nombre = 'Grupo G';

        var pais = new Pais();
        pais.pais_id = 28;
        pais.nombre = 'Estados Unidos';
        pais.grupo = grupo;

        aryPaises.push(pais);

        var grupo = new Grupo();
        grupo.grupo_id = 8;
        grupo.nombre = 'Grupo H';

        var pais = new Pais();
        pais.pais_id = 29;
        pais.nombre = 'BÃ©lgica';
        pais.grupo = grupo;

        aryPaises.push(pais);

        var grupo = new Grupo();
        grupo.grupo_id = 8;
        grupo.nombre = 'Grupo H';

        var pais = new Pais();
        pais.pais_id = 30;
        pais.nombre = 'Argelia';
        pais.grupo = grupo;

        aryPaises.push(pais);

        var grupo = new Grupo();
        grupo.grupo_id = 8;
        grupo.nombre = 'Grupo H';

        var pais = new Pais();
        pais.pais_id = 31;
        pais.nombre = 'Rusia';
        pais.grupo = grupo;

        aryPaises.push(pais);

        var grupo = new Grupo();
        grupo.grupo_id = 8;
        grupo.nombre = 'Grupo H';

        var pais = new Pais();
        pais.pais_id = 32;
        pais.nombre = 'Corea del Sur';
        pais.grupo = grupo;

        aryPaises.push(pais);

        return aryPaises;
    },
    setVersus:function(){
        Shared.aryVersusJSON = jsonVersus;
        Shared.aryVersus = new Array();
        var x = 0;
        
        for(x in jsonVersus){
            var grupo = new Grupo();
            grupo.grupo_id = jsonVersus[x].grupo_id;
            grupo.nombre = jsonVersus[x].grupo_nombre;

            var paisA = new Pais();
            paisA.pais_id = jsonVersus[x].pais_a_id;
            paisA.nombre = jsonVersus[x].pais_a_nombre;
            paisA.grupo = grupo;

            var paisB = new Pais();
            paisB.pais_id = jsonVersus[x].pais_b_id;
            paisB.nombre = jsonVersus[x].pais_b_nombre;
            paisB.grupo = grupo;

            //parse fecha
            var dateTimeVersus = new String(jsonVersus[x].fecha);
            var aryDateVersus = dateTimeVersus.split(' ');

            var dateVersusFecha = aryDateVersus[0];
            var dateVersusHora = aryDateVersus[1];

            var aryFecha = dateVersusFecha.split('-');
            var aryaHora = dateVersusHora.split(':');

            var year = aryFecha[0];
            var month = parseInt(aryFecha[1]) - 1;
            var day = aryFecha[2];
            var hour = aryaHora[0];
            var mins = aryaHora[1];

            var dateVersus = new Date(year, month, day, hour, mins, 0, 0);

            var versus = new Versus();
            versus.versus_id = jsonVersus[x].versus_id;    
            versus.fecha = dateVersus;
            versus.paisA = paisA;
            versus.paisB = paisB;
            versus.golesA = jsonVersus[x].goles_a;
            versus.golesB = jsonVersus[x].goles_b;
            versus.ganador = paisA;

            Shared.aryVersus.push(versus);
        }
        
        jsonVersus = null;
        
    },
    /* @returns {Versus} versus */
    getVersus: function() {        
        return Shared.aryVersus;
    }
    
//    getVersus: function() {
//        
//        
//                var aryVersus = new Array();
//                
//                var grupo = new Grupo();
//                grupo.grupo_id = 1;
//                grupo.nombre = 'Grupo A';
//
//                var paisA = new Pais();
//                paisA.pais_id = 1;
//                paisA.nombre = 'Brasil';
//                paisA.grupo = grupo;
//
//                var paisB = new Pais();
//                paisB.pais_id = 2;
//                paisB.nombre = 'Croacia';
//                paisB.grupo = grupo;
//                
//                //parse fecha
//                var dateTimeVersus = new String('2014-06-12 16:00:00');
//                var aryDateVersus = dateTimeVersus.split(' ');
//
//                var dateVersusFecha = aryDateVersus[0];
//                var dateVersusHora = aryDateVersus[1];
//
//                var aryFecha = dateVersusFecha.split('-');
//                var aryaHora = dateVersusHora.split(':');
//
//                var year = aryFecha[0];
//                var month = parseInt(aryFecha[1]) - 1;
//                var day = aryFecha[2];
//                var hour = aryaHora[0];
//                var mins = aryaHora[1];
//
//                var dateVersus = new Date(year, month, day, hour, mins, 0, 0);
//
//                var versus = new Versus();
//                versus.versus_id = 1;    
//                versus.fecha = dateVersus;
//                versus.paisA = paisA;
//                versus.paisB = paisB;
//                versus.golesA = 0;
//                versus.golesB = 0;
//                versus.ganador = paisA;
//
//                aryVersus.push(versus);
//                
//                var grupo = new Grupo();
//                grupo.grupo_id = 1;
//                grupo.nombre = 'Grupo A';
//
//                var paisA = new Pais();
//                paisA.pais_id = 3;
//                paisA.nombre = 'México';
//                paisA.grupo = grupo;
//
//                var paisB = new Pais();
//                paisB.pais_id = 4;
//                paisB.nombre = 'Camerún';
//                paisB.grupo = grupo;
//                
//                //parse fecha
//                var dateTimeVersus = new String('2014-06-13 12:00:00');
//                var aryDateVersus = dateTimeVersus.split(' ');
//
//                var dateVersusFecha = aryDateVersus[0];
//                var dateVersusHora = aryDateVersus[1];
//
//                var aryFecha = dateVersusFecha.split('-');
//                var aryaHora = dateVersusHora.split(':');
//
//                var year = aryFecha[0];
//                var month = parseInt(aryFecha[1]) - 1;
//                var day = aryFecha[2];
//                var hour = aryaHora[0];
//                var mins = aryaHora[1];
//
//                var dateVersus = new Date(year, month, day, hour, mins, 0, 0);
//
//                var versus = new Versus();
//                versus.versus_id = 2;    
//                versus.fecha = dateVersus;
//                versus.paisA = paisA;
//                versus.paisB = paisB;
//                versus.golesA = 0;
//                versus.golesB = 0;
//                versus.ganador = paisA;
//
//                aryVersus.push(versus);
//                
//                var grupo = new Grupo();
//                grupo.grupo_id = 2;
//                grupo.nombre = 'Grupo B';
//
//                var paisA = new Pais();
//                paisA.pais_id = 5;
//                paisA.nombre = 'España';
//                paisA.grupo = grupo;
//
//                var paisB = new Pais();
//                paisB.pais_id = 6;
//                paisB.nombre = 'Holanda';
//                paisB.grupo = grupo;
//                
//                //parse fecha
//                var dateTimeVersus = new String('2014-06-13 15:00:00');
//                var aryDateVersus = dateTimeVersus.split(' ');
//
//                var dateVersusFecha = aryDateVersus[0];
//                var dateVersusHora = aryDateVersus[1];
//
//                var aryFecha = dateVersusFecha.split('-');
//                var aryaHora = dateVersusHora.split(':');
//
//                var year = aryFecha[0];
//                var month = parseInt(aryFecha[1]) - 1;
//                var day = aryFecha[2];
//                var hour = aryaHora[0];
//                var mins = aryaHora[1];
//
//                var dateVersus = new Date(year, month, day, hour, mins, 0, 0);
//
//                var versus = new Versus();
//                versus.versus_id = 3;    
//                versus.fecha = dateVersus;
//                versus.paisA = paisA;
//                versus.paisB = paisB;
//                versus.golesA = 0;
//                versus.golesB = 0;
//                versus.ganador = paisA;
//
//                aryVersus.push(versus);
//                
//                var grupo = new Grupo();
//                grupo.grupo_id = 2;
//                grupo.nombre = 'Grupo B';
//
//                var paisA = new Pais();
//                paisA.pais_id = 7;
//                paisA.nombre = 'Chile';
//                paisA.grupo = grupo;
//
//                var paisB = new Pais();
//                paisB.pais_id = 8;
//                paisB.nombre = 'Australia';
//                paisB.grupo = grupo;
//                
//                //parse fecha
//                var dateTimeVersus = new String('2014-06-13 18:00:00');
//                var aryDateVersus = dateTimeVersus.split(' ');
//
//                var dateVersusFecha = aryDateVersus[0];
//                var dateVersusHora = aryDateVersus[1];
//
//                var aryFecha = dateVersusFecha.split('-');
//                var aryaHora = dateVersusHora.split(':');
//
//                var year = aryFecha[0];
//                var month = parseInt(aryFecha[1]) - 1;
//                var day = aryFecha[2];
//                var hour = aryaHora[0];
//                var mins = aryaHora[1];
//
//                var dateVersus = new Date(year, month, day, hour, mins, 0, 0);
//
//                var versus = new Versus();
//                versus.versus_id = 4;    
//                versus.fecha = dateVersus;
//                versus.paisA = paisA;
//                versus.paisB = paisB;
//                versus.golesA = 0;
//                versus.golesB = 0;
//                versus.ganador = paisA;
//
//                aryVersus.push(versus);
//                
//                var grupo = new Grupo();
//                grupo.grupo_id = 3;
//                grupo.nombre = 'Grupo C';
//
//                var paisA = new Pais();
//                paisA.pais_id = 9;
//                paisA.nombre = 'Colombia';
//                paisA.grupo = grupo;
//
//                var paisB = new Pais();
//                paisB.pais_id = 10;
//                paisB.nombre = 'Grecia';
//                paisB.grupo = grupo;
//                
//                //parse fecha
//                var dateTimeVersus = new String('2014-06-14 12:00:00');
//                var aryDateVersus = dateTimeVersus.split(' ');
//
//                var dateVersusFecha = aryDateVersus[0];
//                var dateVersusHora = aryDateVersus[1];
//
//                var aryFecha = dateVersusFecha.split('-');
//                var aryaHora = dateVersusHora.split(':');
//
//                var year = aryFecha[0];
//                var month = parseInt(aryFecha[1]) - 1;
//                var day = aryFecha[2];
//                var hour = aryaHora[0];
//                var mins = aryaHora[1];
//
//                var dateVersus = new Date(year, month, day, hour, mins, 0, 0);
//
//                var versus = new Versus();
//                versus.versus_id = 5;    
//                versus.fecha = dateVersus;
//                versus.paisA = paisA;
//                versus.paisB = paisB;
//                versus.golesA = 0;
//                versus.golesB = 0;
//                versus.ganador = paisA;
//
//                aryVersus.push(versus);
//                
//                var grupo = new Grupo();
//                grupo.grupo_id = 3;
//                grupo.nombre = 'Grupo C';
//
//                var paisA = new Pais();
//                paisA.pais_id = 11;
//                paisA.nombre = 'Costa de Marfil';
//                paisA.grupo = grupo;
//
//                var paisB = new Pais();
//                paisB.pais_id = 12;
//                paisB.nombre = 'Japón';
//                paisB.grupo = grupo;
//                
//                //parse fecha
//                var dateTimeVersus = new String('2014-06-14 21:00:00');
//                var aryDateVersus = dateTimeVersus.split(' ');
//
//                var dateVersusFecha = aryDateVersus[0];
//                var dateVersusHora = aryDateVersus[1];
//
//                var aryFecha = dateVersusFecha.split('-');
//                var aryaHora = dateVersusHora.split(':');
//
//                var year = aryFecha[0];
//                var month = parseInt(aryFecha[1]) - 1;
//                var day = aryFecha[2];
//                var hour = aryaHora[0];
//                var mins = aryaHora[1];
//
//                var dateVersus = new Date(year, month, day, hour, mins, 0, 0);
//
//                var versus = new Versus();
//                versus.versus_id = 6;    
//                versus.fecha = dateVersus;
//                versus.paisA = paisA;
//                versus.paisB = paisB;
//                versus.golesA = 0;
//                versus.golesB = 0;
//                versus.ganador = paisA;
//
//                aryVersus.push(versus);
//                
//                var grupo = new Grupo();
//                grupo.grupo_id = 4;
//                grupo.nombre = 'Grupo D';
//
//                var paisA = new Pais();
//                paisA.pais_id = 13;
//                paisA.nombre = 'Uruguay';
//                paisA.grupo = grupo;
//
//                var paisB = new Pais();
//                paisB.pais_id = 14;
//                paisB.nombre = 'Costa Rica';
//                paisB.grupo = grupo;
//                
//                //parse fecha
//                var dateTimeVersus = new String('2014-06-14 15:00:00');
//                var aryDateVersus = dateTimeVersus.split(' ');
//
//                var dateVersusFecha = aryDateVersus[0];
//                var dateVersusHora = aryDateVersus[1];
//
//                var aryFecha = dateVersusFecha.split('-');
//                var aryaHora = dateVersusHora.split(':');
//
//                var year = aryFecha[0];
//                var month = parseInt(aryFecha[1]) - 1;
//                var day = aryFecha[2];
//                var hour = aryaHora[0];
//                var mins = aryaHora[1];
//
//                var dateVersus = new Date(year, month, day, hour, mins, 0, 0);
//
//                var versus = new Versus();
//                versus.versus_id = 7;    
//                versus.fecha = dateVersus;
//                versus.paisA = paisA;
//                versus.paisB = paisB;
//                versus.golesA = 0;
//                versus.golesB = 0;
//                versus.ganador = paisA;
//
//                aryVersus.push(versus);
//                
//                var grupo = new Grupo();
//                grupo.grupo_id = 4;
//                grupo.nombre = 'Grupo D';
//
//                var paisA = new Pais();
//                paisA.pais_id = 15;
//                paisA.nombre = 'Inglaterra';
//                paisA.grupo = grupo;
//
//                var paisB = new Pais();
//                paisB.pais_id = 16;
//                paisB.nombre = 'Italia';
//                paisB.grupo = grupo;
//                
//                //parse fecha
//                var dateTimeVersus = new String('2014-06-14 18:00:00');
//                var aryDateVersus = dateTimeVersus.split(' ');
//
//                var dateVersusFecha = aryDateVersus[0];
//                var dateVersusHora = aryDateVersus[1];
//
//                var aryFecha = dateVersusFecha.split('-');
//                var aryaHora = dateVersusHora.split(':');
//
//                var year = aryFecha[0];
//                var month = parseInt(aryFecha[1]) - 1;
//                var day = aryFecha[2];
//                var hour = aryaHora[0];
//                var mins = aryaHora[1];
//
//                var dateVersus = new Date(year, month, day, hour, mins, 0, 0);
//
//                var versus = new Versus();
//                versus.versus_id = 8;    
//                versus.fecha = dateVersus;
//                versus.paisA = paisA;
//                versus.paisB = paisB;
//                versus.golesA = 0;
//                versus.golesB = 0;
//                versus.ganador = paisA;
//
//                aryVersus.push(versus);
//                
//                var grupo = new Grupo();
//                grupo.grupo_id = 5;
//                grupo.nombre = 'Grupo E';
//
//                var paisA = new Pais();
//                paisA.pais_id = 17;
//                paisA.nombre = 'Suiza';
//                paisA.grupo = grupo;
//
//                var paisB = new Pais();
//                paisB.pais_id = 18;
//                paisB.nombre = 'Ecuador';
//                paisB.grupo = grupo;
//                
//                //parse fecha
//                var dateTimeVersus = new String('2014-06-15 12:00:00');
//                var aryDateVersus = dateTimeVersus.split(' ');
//
//                var dateVersusFecha = aryDateVersus[0];
//                var dateVersusHora = aryDateVersus[1];
//
//                var aryFecha = dateVersusFecha.split('-');
//                var aryaHora = dateVersusHora.split(':');
//
//                var year = aryFecha[0];
//                var month = parseInt(aryFecha[1]) - 1;
//                var day = aryFecha[2];
//                var hour = aryaHora[0];
//                var mins = aryaHora[1];
//
//                var dateVersus = new Date(year, month, day, hour, mins, 0, 0);
//
//                var versus = new Versus();
//                versus.versus_id = 9;    
//                versus.fecha = dateVersus;
//                versus.paisA = paisA;
//                versus.paisB = paisB;
//                versus.golesA = 0;
//                versus.golesB = 0;
//                versus.ganador = paisA;
//
//                aryVersus.push(versus);
//                
//                var grupo = new Grupo();
//                grupo.grupo_id = 5;
//                grupo.nombre = 'Grupo E';
//
//                var paisA = new Pais();
//                paisA.pais_id = 19;
//                paisA.nombre = 'Francia';
//                paisA.grupo = grupo;
//
//                var paisB = new Pais();
//                paisB.pais_id = 20;
//                paisB.nombre = 'Honduras';
//                paisB.grupo = grupo;
//                
//                //parse fecha
//                var dateTimeVersus = new String('2014-06-15 15:00:00');
//                var aryDateVersus = dateTimeVersus.split(' ');
//
//                var dateVersusFecha = aryDateVersus[0];
//                var dateVersusHora = aryDateVersus[1];
//
//                var aryFecha = dateVersusFecha.split('-');
//                var aryaHora = dateVersusHora.split(':');
//
//                var year = aryFecha[0];
//                var month = parseInt(aryFecha[1]) - 1;
//                var day = aryFecha[2];
//                var hour = aryaHora[0];
//                var mins = aryaHora[1];
//
//                var dateVersus = new Date(year, month, day, hour, mins, 0, 0);
//
//                var versus = new Versus();
//                versus.versus_id = 10;    
//                versus.fecha = dateVersus;
//                versus.paisA = paisA;
//                versus.paisB = paisB;
//                versus.golesA = 0;
//                versus.golesB = 0;
//                versus.ganador = paisA;
//
//                aryVersus.push(versus);
//                
//                var grupo = new Grupo();
//                grupo.grupo_id = 6;
//                grupo.nombre = 'Grupo F';
//
//                var paisA = new Pais();
//                paisA.pais_id = 21;
//                paisA.nombre = 'Argentina';
//                paisA.grupo = grupo;
//
//                var paisB = new Pais();
//                paisB.pais_id = 22;
//                paisB.nombre = 'Bosnia Herzegovina';
//                paisB.grupo = grupo;
//                
//                //parse fecha
//                var dateTimeVersus = new String('2014-06-15 18:00:00');
//                var aryDateVersus = dateTimeVersus.split(' ');
//
//                var dateVersusFecha = aryDateVersus[0];
//                var dateVersusHora = aryDateVersus[1];
//
//                var aryFecha = dateVersusFecha.split('-');
//                var aryaHora = dateVersusHora.split(':');
//
//                var year = aryFecha[0];
//                var month = parseInt(aryFecha[1]) - 1;
//                var day = aryFecha[2];
//                var hour = aryaHora[0];
//                var mins = aryaHora[1];
//
//                var dateVersus = new Date(year, month, day, hour, mins, 0, 0);
//
//                var versus = new Versus();
//                versus.versus_id = 11;    
//                versus.fecha = dateVersus;
//                versus.paisA = paisA;
//                versus.paisB = paisB;
//                versus.golesA = 0;
//                versus.golesB = 0;
//                versus.ganador = paisA;
//
//                aryVersus.push(versus);
//                
//                var grupo = new Grupo();
//                grupo.grupo_id = 6;
//                grupo.nombre = 'Grupo F';
//
//                var paisA = new Pais();
//                paisA.pais_id = 23;
//                paisA.nombre = 'Irán';
//                paisA.grupo = grupo;
//
//                var paisB = new Pais();
//                paisB.pais_id = 24;
//                paisB.nombre = 'Nigeria';
//                paisB.grupo = grupo;
//                
//                //parse fecha
//                var dateTimeVersus = new String('2014-06-16 15:00:00');
//                var aryDateVersus = dateTimeVersus.split(' ');
//
//                var dateVersusFecha = aryDateVersus[0];
//                var dateVersusHora = aryDateVersus[1];
//
//                var aryFecha = dateVersusFecha.split('-');
//                var aryaHora = dateVersusHora.split(':');
//
//                var year = aryFecha[0];
//                var month = parseInt(aryFecha[1]) - 1;
//                var day = aryFecha[2];
//                var hour = aryaHora[0];
//                var mins = aryaHora[1];
//
//                var dateVersus = new Date(year, month, day, hour, mins, 0, 0);
//
//                var versus = new Versus();
//                versus.versus_id = 12;    
//                versus.fecha = dateVersus;
//                versus.paisA = paisA;
//                versus.paisB = paisB;
//                versus.golesA = 0;
//                versus.golesB = 0;
//                versus.ganador = paisA;
//
//                aryVersus.push(versus);
//                
//                var grupo = new Grupo();
//                grupo.grupo_id = 7;
//                grupo.nombre = 'Grupo G';
//
//                var paisA = new Pais();
//                paisA.pais_id = 25;
//                paisA.nombre = 'Alemania';
//                paisA.grupo = grupo;
//
//                var paisB = new Pais();
//                paisB.pais_id = 26;
//                paisB.nombre = 'Portugal';
//                paisB.grupo = grupo;
//                
//                //parse fecha
//                var dateTimeVersus = new String('2014-06-16 12:00:00');
//                var aryDateVersus = dateTimeVersus.split(' ');
//
//                var dateVersusFecha = aryDateVersus[0];
//                var dateVersusHora = aryDateVersus[1];
//
//                var aryFecha = dateVersusFecha.split('-');
//                var aryaHora = dateVersusHora.split(':');
//
//                var year = aryFecha[0];
//                var month = parseInt(aryFecha[1]) - 1;
//                var day = aryFecha[2];
//                var hour = aryaHora[0];
//                var mins = aryaHora[1];
//
//                var dateVersus = new Date(year, month, day, hour, mins, 0, 0);
//
//                var versus = new Versus();
//                versus.versus_id = 13;    
//                versus.fecha = dateVersus;
//                versus.paisA = paisA;
//                versus.paisB = paisB;
//                versus.golesA = 0;
//                versus.golesB = 0;
//                versus.ganador = paisA;
//
//                aryVersus.push(versus);
//                
//                var grupo = new Grupo();
//                grupo.grupo_id = 7;
//                grupo.nombre = 'Grupo G';
//
//                var paisA = new Pais();
//                paisA.pais_id = 27;
//                paisA.nombre = 'Ghana';
//                paisA.grupo = grupo;
//
//                var paisB = new Pais();
//                paisB.pais_id = 28;
//                paisB.nombre = 'Estados Unidos';
//                paisB.grupo = grupo;
//                
//                //parse fecha
//                var dateTimeVersus = new String('2014-06-16 18:00:00');
//                var aryDateVersus = dateTimeVersus.split(' ');
//
//                var dateVersusFecha = aryDateVersus[0];
//                var dateVersusHora = aryDateVersus[1];
//
//                var aryFecha = dateVersusFecha.split('-');
//                var aryaHora = dateVersusHora.split(':');
//
//                var year = aryFecha[0];
//                var month = parseInt(aryFecha[1]) - 1;
//                var day = aryFecha[2];
//                var hour = aryaHora[0];
//                var mins = aryaHora[1];
//
//                var dateVersus = new Date(year, month, day, hour, mins, 0, 0);
//
//                var versus = new Versus();
//                versus.versus_id = 14;    
//                versus.fecha = dateVersus;
//                versus.paisA = paisA;
//                versus.paisB = paisB;
//                versus.golesA = 0;
//                versus.golesB = 0;
//                versus.ganador = paisA;
//
//                aryVersus.push(versus);
//                
//                var grupo = new Grupo();
//                grupo.grupo_id = 8;
//                grupo.nombre = 'Grupo H';
//
//                var paisA = new Pais();
//                paisA.pais_id = 29;
//                paisA.nombre = 'Bélgica';
//                paisA.grupo = grupo;
//
//                var paisB = new Pais();
//                paisB.pais_id = 30;
//                paisB.nombre = 'Argelia';
//                paisB.grupo = grupo;
//                
//                //parse fecha
//                var dateTimeVersus = new String('2014-06-17 13:00:00');
//                var aryDateVersus = dateTimeVersus.split(' ');
//
//                var dateVersusFecha = aryDateVersus[0];
//                var dateVersusHora = aryDateVersus[1];
//
//                var aryFecha = dateVersusFecha.split('-');
//                var aryaHora = dateVersusHora.split(':');
//
//                var year = aryFecha[0];
//                var month = parseInt(aryFecha[1]) - 1;
//                var day = aryFecha[2];
//                var hour = aryaHora[0];
//                var mins = aryaHora[1];
//
//                var dateVersus = new Date(year, month, day, hour, mins, 0, 0);
//
//                var versus = new Versus();
//                versus.versus_id = 15;    
//                versus.fecha = dateVersus;
//                versus.paisA = paisA;
//                versus.paisB = paisB;
//                versus.golesA = 0;
//                versus.golesB = 0;
//                versus.ganador = paisA;
//
//                aryVersus.push(versus);
//                
//                var grupo = new Grupo();
//                grupo.grupo_id = 8;
//                grupo.nombre = 'Grupo H';
//
//                var paisA = new Pais();
//                paisA.pais_id = 31;
//                paisA.nombre = 'Rusia';
//                paisA.grupo = grupo;
//
//                var paisB = new Pais();
//                paisB.pais_id = 32;
//                paisB.nombre = 'Corea del Sur';
//                paisB.grupo = grupo;
//                
//                //parse fecha
//                var dateTimeVersus = new String('2014-06-17 18:00:00');
//                var aryDateVersus = dateTimeVersus.split(' ');
//
//                var dateVersusFecha = aryDateVersus[0];
//                var dateVersusHora = aryDateVersus[1];
//
//                var aryFecha = dateVersusFecha.split('-');
//                var aryaHora = dateVersusHora.split(':');
//
//                var year = aryFecha[0];
//                var month = parseInt(aryFecha[1]) - 1;
//                var day = aryFecha[2];
//                var hour = aryaHora[0];
//                var mins = aryaHora[1];
//
//                var dateVersus = new Date(year, month, day, hour, mins, 0, 0);
//
//                var versus = new Versus();
//                versus.versus_id = 16;    
//                versus.fecha = dateVersus;
//                versus.paisA = paisA;
//                versus.paisB = paisB;
//                versus.golesA = 0;
//                versus.golesB = 0;
//                versus.ganador = paisA;
//
//                aryVersus.push(versus);
//                
//                var grupo = new Grupo();
//                grupo.grupo_id = 1;
//                grupo.nombre = 'Grupo A';
//
//                var paisA = new Pais();
//                paisA.pais_id = 1;
//                paisA.nombre = 'Brasil';
//                paisA.grupo = grupo;
//
//                var paisB = new Pais();
//                paisB.pais_id = 3;
//                paisB.nombre = 'México';
//                paisB.grupo = grupo;
//                
//                //parse fecha
//                var dateTimeVersus = new String('2014-06-17 16:00:00');
//                var aryDateVersus = dateTimeVersus.split(' ');
//
//                var dateVersusFecha = aryDateVersus[0];
//                var dateVersusHora = aryDateVersus[1];
//
//                var aryFecha = dateVersusFecha.split('-');
//                var aryaHora = dateVersusHora.split(':');
//
//                var year = aryFecha[0];
//                var month = parseInt(aryFecha[1]) - 1;
//                var day = aryFecha[2];
//                var hour = aryaHora[0];
//                var mins = aryaHora[1];
//
//                var dateVersus = new Date(year, month, day, hour, mins, 0, 0);
//
//                var versus = new Versus();
//                versus.versus_id = 17;    
//                versus.fecha = dateVersus;
//                versus.paisA = paisA;
//                versus.paisB = paisB;
//                versus.golesA = 0;
//                versus.golesB = 0;
//                versus.ganador = paisA;
//
//                aryVersus.push(versus);
//                
//                var grupo = new Grupo();
//                grupo.grupo_id = 1;
//                grupo.nombre = 'Grupo A';
//
//                var paisA = new Pais();
//                paisA.pais_id = 4;
//                paisA.nombre = 'Camerún';
//                paisA.grupo = grupo;
//
//                var paisB = new Pais();
//                paisB.pais_id = 2;
//                paisB.nombre = 'Croacia';
//                paisB.grupo = grupo;
//                
//                //parse fecha
//                var dateTimeVersus = new String('2014-06-18 18:00:00');
//                var aryDateVersus = dateTimeVersus.split(' ');
//
//                var dateVersusFecha = aryDateVersus[0];
//                var dateVersusHora = aryDateVersus[1];
//
//                var aryFecha = dateVersusFecha.split('-');
//                var aryaHora = dateVersusHora.split(':');
//
//                var year = aryFecha[0];
//                var month = parseInt(aryFecha[1]) - 1;
//                var day = aryFecha[2];
//                var hour = aryaHora[0];
//                var mins = aryaHora[1];
//
//                var dateVersus = new Date(year, month, day, hour, mins, 0, 0);
//
//                var versus = new Versus();
//                versus.versus_id = 18;    
//                versus.fecha = dateVersus;
//                versus.paisA = paisA;
//                versus.paisB = paisB;
//                versus.golesA = 0;
//                versus.golesB = 0;
//                versus.ganador = paisA;
//
//                aryVersus.push(versus);
//                
//                var grupo = new Grupo();
//                grupo.grupo_id = 2;
//                grupo.nombre = 'Grupo B';
//
//                var paisA = new Pais();
//                paisA.pais_id = 5;
//                paisA.nombre = 'España';
//                paisA.grupo = grupo;
//
//                var paisB = new Pais();
//                paisB.pais_id = 7;
//                paisB.nombre = 'Chile';
//                paisB.grupo = grupo;
//                
//                //parse fecha
//                var dateTimeVersus = new String('2014-06-18 16:00:00');
//                var aryDateVersus = dateTimeVersus.split(' ');
//
//                var dateVersusFecha = aryDateVersus[0];
//                var dateVersusHora = aryDateVersus[1];
//
//                var aryFecha = dateVersusFecha.split('-');
//                var aryaHora = dateVersusHora.split(':');
//
//                var year = aryFecha[0];
//                var month = parseInt(aryFecha[1]) - 1;
//                var day = aryFecha[2];
//                var hour = aryaHora[0];
//                var mins = aryaHora[1];
//
//                var dateVersus = new Date(year, month, day, hour, mins, 0, 0);
//
//                var versus = new Versus();
//                versus.versus_id = 19;    
//                versus.fecha = dateVersus;
//                versus.paisA = paisA;
//                versus.paisB = paisB;
//                versus.golesA = 0;
//                versus.golesB = 0;
//                versus.ganador = paisA;
//
//                aryVersus.push(versus);
//                
//                var grupo = new Grupo();
//                grupo.grupo_id = 2;
//                grupo.nombre = 'Grupo B';
//
//                var paisA = new Pais();
//                paisA.pais_id = 8;
//                paisA.nombre = 'Australia';
//                paisA.grupo = grupo;
//
//                var paisB = new Pais();
//                paisB.pais_id = 6;
//                paisB.nombre = 'Holanda';
//                paisB.grupo = grupo;
//                
//                //parse fecha
//                var dateTimeVersus = new String('2014-06-18 13:00:00');
//                var aryDateVersus = dateTimeVersus.split(' ');
//
//                var dateVersusFecha = aryDateVersus[0];
//                var dateVersusHora = aryDateVersus[1];
//
//                var aryFecha = dateVersusFecha.split('-');
//                var aryaHora = dateVersusHora.split(':');
//
//                var year = aryFecha[0];
//                var month = parseInt(aryFecha[1]) - 1;
//                var day = aryFecha[2];
//                var hour = aryaHora[0];
//                var mins = aryaHora[1];
//
//                var dateVersus = new Date(year, month, day, hour, mins, 0, 0);
//
//                var versus = new Versus();
//                versus.versus_id = 20;    
//                versus.fecha = dateVersus;
//                versus.paisA = paisA;
//                versus.paisB = paisB;
//                versus.golesA = 0;
//                versus.golesB = 0;
//                versus.ganador = paisA;
//
//                aryVersus.push(versus);
//                
//                var grupo = new Grupo();
//                grupo.grupo_id = 3;
//                grupo.nombre = 'Grupo C';
//
//                var paisA = new Pais();
//                paisA.pais_id = 9;
//                paisA.nombre = 'Colombia';
//                paisA.grupo = grupo;
//
//                var paisB = new Pais();
//                paisB.pais_id = 11;
//                paisB.nombre = 'Costa de Marfil';
//                paisB.grupo = grupo;
//                
//                //parse fecha
//                var dateTimeVersus = new String('2014-06-19 13:00:00');
//                var aryDateVersus = dateTimeVersus.split(' ');
//
//                var dateVersusFecha = aryDateVersus[0];
//                var dateVersusHora = aryDateVersus[1];
//
//                var aryFecha = dateVersusFecha.split('-');
//                var aryaHora = dateVersusHora.split(':');
//
//                var year = aryFecha[0];
//                var month = parseInt(aryFecha[1]) - 1;
//                var day = aryFecha[2];
//                var hour = aryaHora[0];
//                var mins = aryaHora[1];
//
//                var dateVersus = new Date(year, month, day, hour, mins, 0, 0);
//
//                var versus = new Versus();
//                versus.versus_id = 21;    
//                versus.fecha = dateVersus;
//                versus.paisA = paisA;
//                versus.paisB = paisB;
//                versus.golesA = 0;
//                versus.golesB = 0;
//                versus.ganador = paisA;
//
//                aryVersus.push(versus);
//                
//                var grupo = new Grupo();
//                grupo.grupo_id = 3;
//                grupo.nombre = 'Grupo C';
//
//                var paisA = new Pais();
//                paisA.pais_id = 12;
//                paisA.nombre = 'Japón';
//                paisA.grupo = grupo;
//
//                var paisB = new Pais();
//                paisB.pais_id = 10;
//                paisB.nombre = 'Grecia';
//                paisB.grupo = grupo;
//                
//                //parse fecha
//                var dateTimeVersus = new String('2014-06-19 19:00:00');
//                var aryDateVersus = dateTimeVersus.split(' ');
//
//                var dateVersusFecha = aryDateVersus[0];
//                var dateVersusHora = aryDateVersus[1];
//
//                var aryFecha = dateVersusFecha.split('-');
//                var aryaHora = dateVersusHora.split(':');
//
//                var year = aryFecha[0];
//                var month = parseInt(aryFecha[1]) - 1;
//                var day = aryFecha[2];
//                var hour = aryaHora[0];
//                var mins = aryaHora[1];
//
//                var dateVersus = new Date(year, month, day, hour, mins, 0, 0);
//
//                var versus = new Versus();
//                versus.versus_id = 22;    
//                versus.fecha = dateVersus;
//                versus.paisA = paisA;
//                versus.paisB = paisB;
//                versus.golesA = 0;
//                versus.golesB = 0;
//                versus.ganador = paisA;
//
//                aryVersus.push(versus);
//                
//                var grupo = new Grupo();
//                grupo.grupo_id = 4;
//                grupo.nombre = 'Grupo D';
//
//                var paisA = new Pais();
//                paisA.pais_id = 13;
//                paisA.nombre = 'Uruguay';
//                paisA.grupo = grupo;
//
//                var paisB = new Pais();
//                paisB.pais_id = 15;
//                paisB.nombre = 'Inglaterra';
//                paisB.grupo = grupo;
//                
//                //parse fecha
//                var dateTimeVersus = new String('2014-06-19 16:00:00');
//                var aryDateVersus = dateTimeVersus.split(' ');
//
//                var dateVersusFecha = aryDateVersus[0];
//                var dateVersusHora = aryDateVersus[1];
//
//                var aryFecha = dateVersusFecha.split('-');
//                var aryaHora = dateVersusHora.split(':');
//
//                var year = aryFecha[0];
//                var month = parseInt(aryFecha[1]) - 1;
//                var day = aryFecha[2];
//                var hour = aryaHora[0];
//                var mins = aryaHora[1];
//
//                var dateVersus = new Date(year, month, day, hour, mins, 0, 0);
//
//                var versus = new Versus();
//                versus.versus_id = 23;    
//                versus.fecha = dateVersus;
//                versus.paisA = paisA;
//                versus.paisB = paisB;
//                versus.golesA = 0;
//                versus.golesB = 0;
//                versus.ganador = paisA;
//
//                aryVersus.push(versus);
//                
//                var grupo = new Grupo();
//                grupo.grupo_id = 4;
//                grupo.nombre = 'Grupo D';
//
//                var paisA = new Pais();
//                paisA.pais_id = 16;
//                paisA.nombre = 'Italia';
//                paisA.grupo = grupo;
//
//                var paisB = new Pais();
//                paisB.pais_id = 14;
//                paisB.nombre = 'Costa Rica';
//                paisB.grupo = grupo;
//                
//                //parse fecha
//                var dateTimeVersus = new String('2014-06-20 13:00:00');
//                var aryDateVersus = dateTimeVersus.split(' ');
//
//                var dateVersusFecha = aryDateVersus[0];
//                var dateVersusHora = aryDateVersus[1];
//
//                var aryFecha = dateVersusFecha.split('-');
//                var aryaHora = dateVersusHora.split(':');
//
//                var year = aryFecha[0];
//                var month = parseInt(aryFecha[1]) - 1;
//                var day = aryFecha[2];
//                var hour = aryaHora[0];
//                var mins = aryaHora[1];
//
//                var dateVersus = new Date(year, month, day, hour, mins, 0, 0);
//
//                var versus = new Versus();
//                versus.versus_id = 24;    
//                versus.fecha = dateVersus;
//                versus.paisA = paisA;
//                versus.paisB = paisB;
//                versus.golesA = 0;
//                versus.golesB = 0;
//                versus.ganador = paisA;
//
//                aryVersus.push(versus);
//                
//                var grupo = new Grupo();
//                grupo.grupo_id = 5;
//                grupo.nombre = 'Grupo E';
//
//                var paisA = new Pais();
//                paisA.pais_id = 17;
//                paisA.nombre = 'Suiza';
//                paisA.grupo = grupo;
//
//                var paisB = new Pais();
//                paisB.pais_id = 19;
//                paisB.nombre = 'Francia';
//                paisB.grupo = grupo;
//                
//                //parse fecha
//                var dateTimeVersus = new String('2014-06-20 16:00:00');
//                var aryDateVersus = dateTimeVersus.split(' ');
//
//                var dateVersusFecha = aryDateVersus[0];
//                var dateVersusHora = aryDateVersus[1];
//
//                var aryFecha = dateVersusFecha.split('-');
//                var aryaHora = dateVersusHora.split(':');
//
//                var year = aryFecha[0];
//                var month = parseInt(aryFecha[1]) - 1;
//                var day = aryFecha[2];
//                var hour = aryaHora[0];
//                var mins = aryaHora[1];
//
//                var dateVersus = new Date(year, month, day, hour, mins, 0, 0);
//
//                var versus = new Versus();
//                versus.versus_id = 25;    
//                versus.fecha = dateVersus;
//                versus.paisA = paisA;
//                versus.paisB = paisB;
//                versus.golesA = 0;
//                versus.golesB = 0;
//                versus.ganador = paisA;
//
//                aryVersus.push(versus);
//                
//                var grupo = new Grupo();
//                grupo.grupo_id = 5;
//                grupo.nombre = 'Grupo E';
//
//                var paisA = new Pais();
//                paisA.pais_id = 20;
//                paisA.nombre = 'Honduras';
//                paisA.grupo = grupo;
//
//                var paisB = new Pais();
//                paisB.pais_id = 18;
//                paisB.nombre = 'Ecuador';
//                paisB.grupo = grupo;
//                
//                //parse fecha
//                var dateTimeVersus = new String('2014-06-20 19:00:00');
//                var aryDateVersus = dateTimeVersus.split(' ');
//
//                var dateVersusFecha = aryDateVersus[0];
//                var dateVersusHora = aryDateVersus[1];
//
//                var aryFecha = dateVersusFecha.split('-');
//                var aryaHora = dateVersusHora.split(':');
//
//                var year = aryFecha[0];
//                var month = parseInt(aryFecha[1]) - 1;
//                var day = aryFecha[2];
//                var hour = aryaHora[0];
//                var mins = aryaHora[1];
//
//                var dateVersus = new Date(year, month, day, hour, mins, 0, 0);
//
//                var versus = new Versus();
//                versus.versus_id = 26;    
//                versus.fecha = dateVersus;
//                versus.paisA = paisA;
//                versus.paisB = paisB;
//                versus.golesA = 0;
//                versus.golesB = 0;
//                versus.ganador = paisA;
//
//                aryVersus.push(versus);
//                
//                var grupo = new Grupo();
//                grupo.grupo_id = 6;
//                grupo.nombre = 'Grupo F';
//
//                var paisA = new Pais();
//                paisA.pais_id = 21;
//                paisA.nombre = 'Argentina';
//                paisA.grupo = grupo;
//
//                var paisB = new Pais();
//                paisB.pais_id = 23;
//                paisB.nombre = 'Irán';
//                paisB.grupo = grupo;
//                
//                //parse fecha
//                var dateTimeVersus = new String('2014-06-21 13:00:00');
//                var aryDateVersus = dateTimeVersus.split(' ');
//
//                var dateVersusFecha = aryDateVersus[0];
//                var dateVersusHora = aryDateVersus[1];
//
//                var aryFecha = dateVersusFecha.split('-');
//                var aryaHora = dateVersusHora.split(':');
//
//                var year = aryFecha[0];
//                var month = parseInt(aryFecha[1]) - 1;
//                var day = aryFecha[2];
//                var hour = aryaHora[0];
//                var mins = aryaHora[1];
//
//                var dateVersus = new Date(year, month, day, hour, mins, 0, 0);
//
//                var versus = new Versus();
//                versus.versus_id = 27;    
//                versus.fecha = dateVersus;
//                versus.paisA = paisA;
//                versus.paisB = paisB;
//                versus.golesA = 0;
//                versus.golesB = 0;
//                versus.ganador = paisA;
//
//                aryVersus.push(versus);
//                
//                var grupo = new Grupo();
//                grupo.grupo_id = 6;
//                grupo.nombre = 'Grupo F';
//
//                var paisA = new Pais();
//                paisA.pais_id = 24;
//                paisA.nombre = 'Nigeria';
//                paisA.grupo = grupo;
//
//                var paisB = new Pais();
//                paisB.pais_id = 22;
//                paisB.nombre = 'Bosnia Herzegovina';
//                paisB.grupo = grupo;
//                
//                //parse fecha
//                var dateTimeVersus = new String('2014-06-21 18:00:00');
//                var aryDateVersus = dateTimeVersus.split(' ');
//
//                var dateVersusFecha = aryDateVersus[0];
//                var dateVersusHora = aryDateVersus[1];
//
//                var aryFecha = dateVersusFecha.split('-');
//                var aryaHora = dateVersusHora.split(':');
//
//                var year = aryFecha[0];
//                var month = parseInt(aryFecha[1]) - 1;
//                var day = aryFecha[2];
//                var hour = aryaHora[0];
//                var mins = aryaHora[1];
//
//                var dateVersus = new Date(year, month, day, hour, mins, 0, 0);
//
//                var versus = new Versus();
//                versus.versus_id = 28;    
//                versus.fecha = dateVersus;
//                versus.paisA = paisA;
//                versus.paisB = paisB;
//                versus.golesA = 0;
//                versus.golesB = 0;
//                versus.ganador = paisA;
//
//                aryVersus.push(versus);
//                
//                var grupo = new Grupo();
//                grupo.grupo_id = 7;
//                grupo.nombre = 'Grupo G';
//
//                var paisA = new Pais();
//                paisA.pais_id = 25;
//                paisA.nombre = 'Alemania';
//                paisA.grupo = grupo;
//
//                var paisB = new Pais();
//                paisB.pais_id = 27;
//                paisB.nombre = 'Ghana';
//                paisB.grupo = grupo;
//                
//                //parse fecha
//                var dateTimeVersus = new String('2014-06-21 16:00:00');
//                var aryDateVersus = dateTimeVersus.split(' ');
//
//                var dateVersusFecha = aryDateVersus[0];
//                var dateVersusHora = aryDateVersus[1];
//
//                var aryFecha = dateVersusFecha.split('-');
//                var aryaHora = dateVersusHora.split(':');
//
//                var year = aryFecha[0];
//                var month = parseInt(aryFecha[1]) - 1;
//                var day = aryFecha[2];
//                var hour = aryaHora[0];
//                var mins = aryaHora[1];
//
//                var dateVersus = new Date(year, month, day, hour, mins, 0, 0);
//
//                var versus = new Versus();
//                versus.versus_id = 29;    
//                versus.fecha = dateVersus;
//                versus.paisA = paisA;
//                versus.paisB = paisB;
//                versus.golesA = 0;
//                versus.golesB = 0;
//                versus.ganador = paisA;
//
//                aryVersus.push(versus);
//                
//                var grupo = new Grupo();
//                grupo.grupo_id = 7;
//                grupo.nombre = 'Grupo G';
//
//                var paisA = new Pais();
//                paisA.pais_id = 28;
//                paisA.nombre = 'Estados Unidos';
//                paisA.grupo = grupo;
//
//                var paisB = new Pais();
//                paisB.pais_id = 26;
//                paisB.nombre = 'Portugal';
//                paisB.grupo = grupo;
//                
//                //parse fecha
//                var dateTimeVersus = new String('2014-06-22 18:00:00');
//                var aryDateVersus = dateTimeVersus.split(' ');
//
//                var dateVersusFecha = aryDateVersus[0];
//                var dateVersusHora = aryDateVersus[1];
//
//                var aryFecha = dateVersusFecha.split('-');
//                var aryaHora = dateVersusHora.split(':');
//
//                var year = aryFecha[0];
//                var month = parseInt(aryFecha[1]) - 1;
//                var day = aryFecha[2];
//                var hour = aryaHora[0];
//                var mins = aryaHora[1];
//
//                var dateVersus = new Date(year, month, day, hour, mins, 0, 0);
//
//                var versus = new Versus();
//                versus.versus_id = 30;    
//                versus.fecha = dateVersus;
//                versus.paisA = paisA;
//                versus.paisB = paisB;
//                versus.golesA = 0;
//                versus.golesB = 0;
//                versus.ganador = paisA;
//
//                aryVersus.push(versus);
//                
//                var grupo = new Grupo();
//                grupo.grupo_id = 8;
//                grupo.nombre = 'Grupo H';
//
//                var paisA = new Pais();
//                paisA.pais_id = 29;
//                paisA.nombre = 'Bélgica';
//                paisA.grupo = grupo;
//
//                var paisB = new Pais();
//                paisB.pais_id = 31;
//                paisB.nombre = 'Rusia';
//                paisB.grupo = grupo;
//                
//                //parse fecha
//                var dateTimeVersus = new String('2014-06-22 13:00:00');
//                var aryDateVersus = dateTimeVersus.split(' ');
//
//                var dateVersusFecha = aryDateVersus[0];
//                var dateVersusHora = aryDateVersus[1];
//
//                var aryFecha = dateVersusFecha.split('-');
//                var aryaHora = dateVersusHora.split(':');
//
//                var year = aryFecha[0];
//                var month = parseInt(aryFecha[1]) - 1;
//                var day = aryFecha[2];
//                var hour = aryaHora[0];
//                var mins = aryaHora[1];
//
//                var dateVersus = new Date(year, month, day, hour, mins, 0, 0);
//
//                var versus = new Versus();
//                versus.versus_id = 31;    
//                versus.fecha = dateVersus;
//                versus.paisA = paisA;
//                versus.paisB = paisB;
//                versus.golesA = 0;
//                versus.golesB = 0;
//                versus.ganador = paisA;
//
//                aryVersus.push(versus);
//                
//                var grupo = new Grupo();
//                grupo.grupo_id = 8;
//                grupo.nombre = 'Grupo H';
//
//                var paisA = new Pais();
//                paisA.pais_id = 32;
//                paisA.nombre = 'Corea del Sur';
//                paisA.grupo = grupo;
//
//                var paisB = new Pais();
//                paisB.pais_id = 30;
//                paisB.nombre = 'Argelia';
//                paisB.grupo = grupo;
//                
//                //parse fecha
//                var dateTimeVersus = new String('2014-06-22 16:00:00');
//                var aryDateVersus = dateTimeVersus.split(' ');
//
//                var dateVersusFecha = aryDateVersus[0];
//                var dateVersusHora = aryDateVersus[1];
//
//                var aryFecha = dateVersusFecha.split('-');
//                var aryaHora = dateVersusHora.split(':');
//
//                var year = aryFecha[0];
//                var month = parseInt(aryFecha[1]) - 1;
//                var day = aryFecha[2];
//                var hour = aryaHora[0];
//                var mins = aryaHora[1];
//
//                var dateVersus = new Date(year, month, day, hour, mins, 0, 0);
//
//                var versus = new Versus();
//                versus.versus_id = 32;    
//                versus.fecha = dateVersus;
//                versus.paisA = paisA;
//                versus.paisB = paisB;
//                versus.golesA = 0;
//                versus.golesB = 0;
//                versus.ganador = paisA;
//
//                aryVersus.push(versus);
//                
//                var grupo = new Grupo();
//                grupo.grupo_id = 1;
//                grupo.nombre = 'Grupo A';
//
//                var paisA = new Pais();
//                paisA.pais_id = 4;
//                paisA.nombre = 'Camerún';
//                paisA.grupo = grupo;
//
//                var paisB = new Pais();
//                paisB.pais_id = 1;
//                paisB.nombre = 'Brasil';
//                paisB.grupo = grupo;
//                
//                //parse fecha
//                var dateTimeVersus = new String('2014-06-23 17:00:00');
//                var aryDateVersus = dateTimeVersus.split(' ');
//
//                var dateVersusFecha = aryDateVersus[0];
//                var dateVersusHora = aryDateVersus[1];
//
//                var aryFecha = dateVersusFecha.split('-');
//                var aryaHora = dateVersusHora.split(':');
//
//                var year = aryFecha[0];
//                var month = parseInt(aryFecha[1]) - 1;
//                var day = aryFecha[2];
//                var hour = aryaHora[0];
//                var mins = aryaHora[1];
//
//                var dateVersus = new Date(year, month, day, hour, mins, 0, 0);
//
//                var versus = new Versus();
//                versus.versus_id = 33;    
//                versus.fecha = dateVersus;
//                versus.paisA = paisA;
//                versus.paisB = paisB;
//                versus.golesA = 0;
//                versus.golesB = 0;
//                versus.ganador = paisA;
//
//                aryVersus.push(versus);
//                
//                var grupo = new Grupo();
//                grupo.grupo_id = 1;
//                grupo.nombre = 'Grupo A';
//
//                var paisA = new Pais();
//                paisA.pais_id = 2;
//                paisA.nombre = 'Croacia';
//                paisA.grupo = grupo;
//
//                var paisB = new Pais();
//                paisB.pais_id = 3;
//                paisB.nombre = 'México';
//                paisB.grupo = grupo;
//                
//                //parse fecha
//                var dateTimeVersus = new String('2014-06-23 17:00:00');
//                var aryDateVersus = dateTimeVersus.split(' ');
//
//                var dateVersusFecha = aryDateVersus[0];
//                var dateVersusHora = aryDateVersus[1];
//
//                var aryFecha = dateVersusFecha.split('-');
//                var aryaHora = dateVersusHora.split(':');
//
//                var year = aryFecha[0];
//                var month = parseInt(aryFecha[1]) - 1;
//                var day = aryFecha[2];
//                var hour = aryaHora[0];
//                var mins = aryaHora[1];
//
//                var dateVersus = new Date(year, month, day, hour, mins, 0, 0);
//
//                var versus = new Versus();
//                versus.versus_id = 34;    
//                versus.fecha = dateVersus;
//                versus.paisA = paisA;
//                versus.paisB = paisB;
//                versus.golesA = 0;
//                versus.golesB = 0;
//                versus.ganador = paisA;
//
//                aryVersus.push(versus);
//                
//                var grupo = new Grupo();
//                grupo.grupo_id = 2;
//                grupo.nombre = 'Grupo B';
//
//                var paisA = new Pais();
//                paisA.pais_id = 8;
//                paisA.nombre = 'Australia';
//                paisA.grupo = grupo;
//
//                var paisB = new Pais();
//                paisB.pais_id = 5;
//                paisB.nombre = 'España';
//                paisB.grupo = grupo;
//                
//                //parse fecha
//                var dateTimeVersus = new String('2014-06-23 13:00:00');
//                var aryDateVersus = dateTimeVersus.split(' ');
//
//                var dateVersusFecha = aryDateVersus[0];
//                var dateVersusHora = aryDateVersus[1];
//
//                var aryFecha = dateVersusFecha.split('-');
//                var aryaHora = dateVersusHora.split(':');
//
//                var year = aryFecha[0];
//                var month = parseInt(aryFecha[1]) - 1;
//                var day = aryFecha[2];
//                var hour = aryaHora[0];
//                var mins = aryaHora[1];
//
//                var dateVersus = new Date(year, month, day, hour, mins, 0, 0);
//
//                var versus = new Versus();
//                versus.versus_id = 35;    
//                versus.fecha = dateVersus;
//                versus.paisA = paisA;
//                versus.paisB = paisB;
//                versus.golesA = 0;
//                versus.golesB = 0;
//                versus.ganador = paisA;
//
//                aryVersus.push(versus);
//                
//                var grupo = new Grupo();
//                grupo.grupo_id = 2;
//                grupo.nombre = 'Grupo B';
//
//                var paisA = new Pais();
//                paisA.pais_id = 6;
//                paisA.nombre = 'Holanda';
//                paisA.grupo = grupo;
//
//                var paisB = new Pais();
//                paisB.pais_id = 7;
//                paisB.nombre = 'Chile';
//                paisB.grupo = grupo;
//                
//                //parse fecha
//                var dateTimeVersus = new String('2014-06-23 13:00:00');
//                var aryDateVersus = dateTimeVersus.split(' ');
//
//                var dateVersusFecha = aryDateVersus[0];
//                var dateVersusHora = aryDateVersus[1];
//
//                var aryFecha = dateVersusFecha.split('-');
//                var aryaHora = dateVersusHora.split(':');
//
//                var year = aryFecha[0];
//                var month = parseInt(aryFecha[1]) - 1;
//                var day = aryFecha[2];
//                var hour = aryaHora[0];
//                var mins = aryaHora[1];
//
//                var dateVersus = new Date(year, month, day, hour, mins, 0, 0);
//
//                var versus = new Versus();
//                versus.versus_id = 36;    
//                versus.fecha = dateVersus;
//                versus.paisA = paisA;
//                versus.paisB = paisB;
//                versus.golesA = 0;
//                versus.golesB = 0;
//                versus.ganador = paisA;
//
//                aryVersus.push(versus);
//                
//                var grupo = new Grupo();
//                grupo.grupo_id = 3;
//                grupo.nombre = 'Grupo C';
//
//                var paisA = new Pais();
//                paisA.pais_id = 12;
//                paisA.nombre = 'Japón';
//                paisA.grupo = grupo;
//
//                var paisB = new Pais();
//                paisB.pais_id = 9;
//                paisB.nombre = 'Colombia';
//                paisB.grupo = grupo;
//                
//                //parse fecha
//                var dateTimeVersus = new String('2014-06-24 16:00:00');
//                var aryDateVersus = dateTimeVersus.split(' ');
//
//                var dateVersusFecha = aryDateVersus[0];
//                var dateVersusHora = aryDateVersus[1];
//
//                var aryFecha = dateVersusFecha.split('-');
//                var aryaHora = dateVersusHora.split(':');
//
//                var year = aryFecha[0];
//                var month = parseInt(aryFecha[1]) - 1;
//                var day = aryFecha[2];
//                var hour = aryaHora[0];
//                var mins = aryaHora[1];
//
//                var dateVersus = new Date(year, month, day, hour, mins, 0, 0);
//
//                var versus = new Versus();
//                versus.versus_id = 37;    
//                versus.fecha = dateVersus;
//                versus.paisA = paisA;
//                versus.paisB = paisB;
//                versus.golesA = 0;
//                versus.golesB = 0;
//                versus.ganador = paisA;
//
//                aryVersus.push(versus);
//                
//                var grupo = new Grupo();
//                grupo.grupo_id = 3;
//                grupo.nombre = 'Grupo C';
//
//                var paisA = new Pais();
//                paisA.pais_id = 10;
//                paisA.nombre = 'Grecia';
//                paisA.grupo = grupo;
//
//                var paisB = new Pais();
//                paisB.pais_id = 11;
//                paisB.nombre = 'Costa de Marfil';
//                paisB.grupo = grupo;
//                
//                //parse fecha
//                var dateTimeVersus = new String('2014-06-24 17:00:00');
//                var aryDateVersus = dateTimeVersus.split(' ');
//
//                var dateVersusFecha = aryDateVersus[0];
//                var dateVersusHora = aryDateVersus[1];
//
//                var aryFecha = dateVersusFecha.split('-');
//                var aryaHora = dateVersusHora.split(':');
//
//                var year = aryFecha[0];
//                var month = parseInt(aryFecha[1]) - 1;
//                var day = aryFecha[2];
//                var hour = aryaHora[0];
//                var mins = aryaHora[1];
//
//                var dateVersus = new Date(year, month, day, hour, mins, 0, 0);
//
//                var versus = new Versus();
//                versus.versus_id = 38;    
//                versus.fecha = dateVersus;
//                versus.paisA = paisA;
//                versus.paisB = paisB;
//                versus.golesA = 0;
//                versus.golesB = 0;
//                versus.ganador = paisA;
//
//                aryVersus.push(versus);
//                
//                var grupo = new Grupo();
//                grupo.grupo_id = 4;
//                grupo.nombre = 'Grupo D';
//
//                var paisA = new Pais();
//                paisA.pais_id = 16;
//                paisA.nombre = 'Italia';
//                paisA.grupo = grupo;
//
//                var paisB = new Pais();
//                paisB.pais_id = 13;
//                paisB.nombre = 'Uruguay';
//                paisB.grupo = grupo;
//                
//                //parse fecha
//                var dateTimeVersus = new String('2014-06-24 13:00:00');
//                var aryDateVersus = dateTimeVersus.split(' ');
//
//                var dateVersusFecha = aryDateVersus[0];
//                var dateVersusHora = aryDateVersus[1];
//
//                var aryFecha = dateVersusFecha.split('-');
//                var aryaHora = dateVersusHora.split(':');
//
//                var year = aryFecha[0];
//                var month = parseInt(aryFecha[1]) - 1;
//                var day = aryFecha[2];
//                var hour = aryaHora[0];
//                var mins = aryaHora[1];
//
//                var dateVersus = new Date(year, month, day, hour, mins, 0, 0);
//
//                var versus = new Versus();
//                versus.versus_id = 39;    
//                versus.fecha = dateVersus;
//                versus.paisA = paisA;
//                versus.paisB = paisB;
//                versus.golesA = 0;
//                versus.golesB = 0;
//                versus.ganador = paisA;
//
//                aryVersus.push(versus);
//                
//                var grupo = new Grupo();
//                grupo.grupo_id = 4;
//                grupo.nombre = 'Grupo D';
//
//                var paisA = new Pais();
//                paisA.pais_id = 14;
//                paisA.nombre = 'Costa Rica';
//                paisA.grupo = grupo;
//
//                var paisB = new Pais();
//                paisB.pais_id = 15;
//                paisB.nombre = 'Inglaterra';
//                paisB.grupo = grupo;
//                
//                //parse fecha
//                var dateTimeVersus = new String('2014-06-24 13:00:00');
//                var aryDateVersus = dateTimeVersus.split(' ');
//
//                var dateVersusFecha = aryDateVersus[0];
//                var dateVersusHora = aryDateVersus[1];
//
//                var aryFecha = dateVersusFecha.split('-');
//                var aryaHora = dateVersusHora.split(':');
//
//                var year = aryFecha[0];
//                var month = parseInt(aryFecha[1]) - 1;
//                var day = aryFecha[2];
//                var hour = aryaHora[0];
//                var mins = aryaHora[1];
//
//                var dateVersus = new Date(year, month, day, hour, mins, 0, 0);
//
//                var versus = new Versus();
//                versus.versus_id = 40;    
//                versus.fecha = dateVersus;
//                versus.paisA = paisA;
//                versus.paisB = paisB;
//                versus.golesA = 0;
//                versus.golesB = 0;
//                versus.ganador = paisA;
//
//                aryVersus.push(versus);
//                
//                var grupo = new Grupo();
//                grupo.grupo_id = 5;
//                grupo.nombre = 'Grupo E';
//
//                var paisA = new Pais();
//                paisA.pais_id = 20;
//                paisA.nombre = 'Honduras';
//                paisA.grupo = grupo;
//
//                var paisB = new Pais();
//                paisB.pais_id = 17;
//                paisB.nombre = 'Suiza';
//                paisB.grupo = grupo;
//                
//                //parse fecha
//                var dateTimeVersus = new String('2014-06-25 16:00:00');
//                var aryDateVersus = dateTimeVersus.split(' ');
//
//                var dateVersusFecha = aryDateVersus[0];
//                var dateVersusHora = aryDateVersus[1];
//
//                var aryFecha = dateVersusFecha.split('-');
//                var aryaHora = dateVersusHora.split(':');
//
//                var year = aryFecha[0];
//                var month = parseInt(aryFecha[1]) - 1;
//                var day = aryFecha[2];
//                var hour = aryaHora[0];
//                var mins = aryaHora[1];
//
//                var dateVersus = new Date(year, month, day, hour, mins, 0, 0);
//
//                var versus = new Versus();
//                versus.versus_id = 41;    
//                versus.fecha = dateVersus;
//                versus.paisA = paisA;
//                versus.paisB = paisB;
//                versus.golesA = 0;
//                versus.golesB = 0;
//                versus.ganador = paisA;
//
//                aryVersus.push(versus);
//                
//                var grupo = new Grupo();
//                grupo.grupo_id = 5;
//                grupo.nombre = 'Grupo E';
//
//                var paisA = new Pais();
//                paisA.pais_id = 18;
//                paisA.nombre = 'Ecuador';
//                paisA.grupo = grupo;
//
//                var paisB = new Pais();
//                paisB.pais_id = 19;
//                paisB.nombre = 'Francia';
//                paisB.grupo = grupo;
//                
//                //parse fecha
//                var dateTimeVersus = new String('2014-06-25 17:00:00');
//                var aryDateVersus = dateTimeVersus.split(' ');
//
//                var dateVersusFecha = aryDateVersus[0];
//                var dateVersusHora = aryDateVersus[1];
//
//                var aryFecha = dateVersusFecha.split('-');
//                var aryaHora = dateVersusHora.split(':');
//
//                var year = aryFecha[0];
//                var month = parseInt(aryFecha[1]) - 1;
//                var day = aryFecha[2];
//                var hour = aryaHora[0];
//                var mins = aryaHora[1];
//
//                var dateVersus = new Date(year, month, day, hour, mins, 0, 0);
//
//                var versus = new Versus();
//                versus.versus_id = 42;    
//                versus.fecha = dateVersus;
//                versus.paisA = paisA;
//                versus.paisB = paisB;
//                versus.golesA = 0;
//                versus.golesB = 0;
//                versus.ganador = paisA;
//
//                aryVersus.push(versus);
//                
//                var grupo = new Grupo();
//                grupo.grupo_id = 6;
//                grupo.nombre = 'Grupo F';
//
//                var paisA = new Pais();
//                paisA.pais_id = 24;
//                paisA.nombre = 'Nigeria';
//                paisA.grupo = grupo;
//
//                var paisB = new Pais();
//                paisB.pais_id = 21;
//                paisB.nombre = 'Argentina';
//                paisB.grupo = grupo;
//                
//                //parse fecha
//                var dateTimeVersus = new String('2014-06-25 13:00:00');
//                var aryDateVersus = dateTimeVersus.split(' ');
//
//                var dateVersusFecha = aryDateVersus[0];
//                var dateVersusHora = aryDateVersus[1];
//
//                var aryFecha = dateVersusFecha.split('-');
//                var aryaHora = dateVersusHora.split(':');
//
//                var year = aryFecha[0];
//                var month = parseInt(aryFecha[1]) - 1;
//                var day = aryFecha[2];
//                var hour = aryaHora[0];
//                var mins = aryaHora[1];
//
//                var dateVersus = new Date(year, month, day, hour, mins, 0, 0);
//
//                var versus = new Versus();
//                versus.versus_id = 43;    
//                versus.fecha = dateVersus;
//                versus.paisA = paisA;
//                versus.paisB = paisB;
//                versus.golesA = 0;
//                versus.golesB = 0;
//                versus.ganador = paisA;
//
//                aryVersus.push(versus);
//                
//                var grupo = new Grupo();
//                grupo.grupo_id = 6;
//                grupo.nombre = 'Grupo F';
//
//                var paisA = new Pais();
//                paisA.pais_id = 22;
//                paisA.nombre = 'Bosnia Herzegovina';
//                paisA.grupo = grupo;
//
//                var paisB = new Pais();
//                paisB.pais_id = 23;
//                paisB.nombre = 'Irán';
//                paisB.grupo = grupo;
//                
//                //parse fecha
//                var dateTimeVersus = new String('2014-06-25 13:00:00');
//                var aryDateVersus = dateTimeVersus.split(' ');
//
//                var dateVersusFecha = aryDateVersus[0];
//                var dateVersusHora = aryDateVersus[1];
//
//                var aryFecha = dateVersusFecha.split('-');
//                var aryaHora = dateVersusHora.split(':');
//
//                var year = aryFecha[0];
//                var month = parseInt(aryFecha[1]) - 1;
//                var day = aryFecha[2];
//                var hour = aryaHora[0];
//                var mins = aryaHora[1];
//
//                var dateVersus = new Date(year, month, day, hour, mins, 0, 0);
//
//                var versus = new Versus();
//                versus.versus_id = 44;    
//                versus.fecha = dateVersus;
//                versus.paisA = paisA;
//                versus.paisB = paisB;
//                versus.golesA = 0;
//                versus.golesB = 0;
//                versus.ganador = paisA;
//
//                aryVersus.push(versus);
//                
//                var grupo = new Grupo();
//                grupo.grupo_id = 7;
//                grupo.nombre = 'Grupo G';
//
//                var paisA = new Pais();
//                paisA.pais_id = 28;
//                paisA.nombre = 'Estados Unidos';
//                paisA.grupo = grupo;
//
//                var paisB = new Pais();
//                paisB.pais_id = 25;
//                paisB.nombre = 'Alemania';
//                paisB.grupo = grupo;
//                
//                //parse fecha
//                var dateTimeVersus = new String('2014-06-26 13:00:00');
//                var aryDateVersus = dateTimeVersus.split(' ');
//
//                var dateVersusFecha = aryDateVersus[0];
//                var dateVersusHora = aryDateVersus[1];
//
//                var aryFecha = dateVersusFecha.split('-');
//                var aryaHora = dateVersusHora.split(':');
//
//                var year = aryFecha[0];
//                var month = parseInt(aryFecha[1]) - 1;
//                var day = aryFecha[2];
//                var hour = aryaHora[0];
//                var mins = aryaHora[1];
//
//                var dateVersus = new Date(year, month, day, hour, mins, 0, 0);
//
//                var versus = new Versus();
//                versus.versus_id = 45;    
//                versus.fecha = dateVersus;
//                versus.paisA = paisA;
//                versus.paisB = paisB;
//                versus.golesA = 0;
//                versus.golesB = 0;
//                versus.ganador = paisA;
//
//                aryVersus.push(versus);
//                
//                var grupo = new Grupo();
//                grupo.grupo_id = 7;
//                grupo.nombre = 'Grupo G';
//
//                var paisA = new Pais();
//                paisA.pais_id = 26;
//                paisA.nombre = 'Portugal';
//                paisA.grupo = grupo;
//
//                var paisB = new Pais();
//                paisB.pais_id = 27;
//                paisB.nombre = 'Ghana';
//                paisB.grupo = grupo;
//                
//                //parse fecha
//                var dateTimeVersus = new String('2014-06-26 13:00:00');
//                var aryDateVersus = dateTimeVersus.split(' ');
//
//                var dateVersusFecha = aryDateVersus[0];
//                var dateVersusHora = aryDateVersus[1];
//
//                var aryFecha = dateVersusFecha.split('-');
//                var aryaHora = dateVersusHora.split(':');
//
//                var year = aryFecha[0];
//                var month = parseInt(aryFecha[1]) - 1;
//                var day = aryFecha[2];
//                var hour = aryaHora[0];
//                var mins = aryaHora[1];
//
//                var dateVersus = new Date(year, month, day, hour, mins, 0, 0);
//
//                var versus = new Versus();
//                versus.versus_id = 46;    
//                versus.fecha = dateVersus;
//                versus.paisA = paisA;
//                versus.paisB = paisB;
//                versus.golesA = 0;
//                versus.golesB = 0;
//                versus.ganador = paisA;
//
//                aryVersus.push(versus);
//                
//                var grupo = new Grupo();
//                grupo.grupo_id = 8;
//                grupo.nombre = 'Grupo H';
//
//                var paisA = new Pais();
//                paisA.pais_id = 32;
//                paisA.nombre = 'Corea del Sur';
//                paisA.grupo = grupo;
//
//                var paisB = new Pais();
//                paisB.pais_id = 29;
//                paisB.nombre = 'Bélgica';
//                paisB.grupo = grupo;
//                
//                //parse fecha
//                var dateTimeVersus = new String('2014-06-26 17:00:00');
//                var aryDateVersus = dateTimeVersus.split(' ');
//
//                var dateVersusFecha = aryDateVersus[0];
//                var dateVersusHora = aryDateVersus[1];
//
//                var aryFecha = dateVersusFecha.split('-');
//                var aryaHora = dateVersusHora.split(':');
//
//                var year = aryFecha[0];
//                var month = parseInt(aryFecha[1]) - 1;
//                var day = aryFecha[2];
//                var hour = aryaHora[0];
//                var mins = aryaHora[1];
//
//                var dateVersus = new Date(year, month, day, hour, mins, 0, 0);
//
//                var versus = new Versus();
//                versus.versus_id = 47;    
//                versus.fecha = dateVersus;
//                versus.paisA = paisA;
//                versus.paisB = paisB;
//                versus.golesA = 0;
//                versus.golesB = 0;
//                versus.ganador = paisA;
//
//                aryVersus.push(versus);
//                
//                var grupo = new Grupo();
//                grupo.grupo_id = 8;
//                grupo.nombre = 'Grupo H';
//
//                var paisA = new Pais();
//                paisA.pais_id = 30;
//                paisA.nombre = 'Argelia';
//                paisA.grupo = grupo;
//
//                var paisB = new Pais();
//                paisB.pais_id = 31;
//                paisB.nombre = 'Rusia';
//                paisB.grupo = grupo;
//                
//                //parse fecha
//                var dateTimeVersus = new String('2014-06-26 17:00:00');
//                var aryDateVersus = dateTimeVersus.split(' ');
//
//                var dateVersusFecha = aryDateVersus[0];
//                var dateVersusHora = aryDateVersus[1];
//
//                var aryFecha = dateVersusFecha.split('-');
//                var aryaHora = dateVersusHora.split(':');
//
//                var year = aryFecha[0];
//                var month = parseInt(aryFecha[1]) - 1;
//                var day = aryFecha[2];
//                var hour = aryaHora[0];
//                var mins = aryaHora[1];
//
//                var dateVersus = new Date(year, month, day, hour, mins, 0, 0);
//
//                var versus = new Versus();
//                versus.versus_id = 48;    
//                versus.fecha = dateVersus;
//                versus.paisA = paisA;
//                versus.paisB = paisB;
//                versus.golesA = 0;
//                versus.golesB = 0;
//                versus.ganador = paisA;
//
//                aryVersus.push(versus);
//
//        return aryVersus;
//    }
};


/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -  */
/*  AES implementation in JavaScript (c) Chris Veness 2005-2014                                   */
/*   - see http://csrc.nist.gov/publications/PubsFIPS.html#197                                    */
/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -  */

var Aes = {};  // Aes namespace

/**
 * AES Cipher function: encrypt 'input' state with Rijndael algorithm
 *   applies Nr rounds (10/12/14) using key schedule w for 'add round key' stage
 *
 * @param {Number[]} input 16-byte (128-bit) input state array
 * @param {Number[][]} w   Key schedule as 2D byte-array (Nr+1 x Nb bytes)
 * @returns {Number[]}     Encrypted output state array
 */
Aes.cipher = function(input, w) {    // main Cipher function [§5.1]
    var Nb = 4;               // block size (in words): no of columns in state (fixed at 4 for AES)
    var Nr = w.length / Nb - 1; // no of rounds: 10/12/14 for 128/192/256-bit keys

    var state = [[], [], [], []];  // initialise 4xNb byte-array 'state' with input [§3.4]
    for (var i = 0; i < 4 * Nb; i++)
        state[i % 4][Math.floor(i / 4)] = input[i];

    state = Aes.addRoundKey(state, w, 0, Nb);

    for (var round = 1; round < Nr; round++) {
        state = Aes.subBytes(state, Nb);
        state = Aes.shiftRows(state, Nb);
        state = Aes.mixColumns(state, Nb);
        state = Aes.addRoundKey(state, w, round, Nb);
    }

    state = Aes.subBytes(state, Nb);
    state = Aes.shiftRows(state, Nb);
    state = Aes.addRoundKey(state, w, Nr, Nb);

    var output = new Array(4 * Nb);  // convert state to 1-d array before returning [§3.4]
    for (var i = 0; i < 4 * Nb; i++)
        output[i] = state[i % 4][Math.floor(i / 4)];
    return output;
}

/**
 * Perform Key Expansion to generate a Key Schedule
 *
 * @param {Number[]} key Key as 16/24/32-byte array
 * @returns {Number[][]} Expanded key schedule as 2D byte-array (Nr+1 x Nb bytes)
 */
Aes.keyExpansion = function(key) {  // generate Key Schedule (byte-array Nr+1 x Nb) from Key [§5.2]
    var Nb = 4;            // block size (in words): no of columns in state (fixed at 4 for AES)
    var Nk = key.length / 4  // key length (in words): 4/6/8 for 128/192/256-bit keys
    var Nr = Nk + 6;       // no of rounds: 10/12/14 for 128/192/256-bit keys

    var w = new Array(Nb * (Nr + 1));
    var temp = new Array(4);

    for (var i = 0; i < Nk; i++) {
        var r = [key[4 * i], key[4 * i + 1], key[4 * i + 2], key[4 * i + 3]];
        w[i] = r;
    }

    for (var i = Nk; i < (Nb * (Nr + 1)); i++) {
        w[i] = new Array(4);
        for (var t = 0; t < 4; t++)
            temp[t] = w[i - 1][t];
        if (i % Nk == 0) {
            temp = Aes.subWord(Aes.rotWord(temp));
            for (var t = 0; t < 4; t++)
                temp[t] ^= Aes.rCon[i / Nk][t];
        } else if (Nk > 6 && i % Nk == 4) {
            temp = Aes.subWord(temp);
        }
        for (var t = 0; t < 4; t++)
            w[i][t] = w[i - Nk][t] ^ temp[t];
    }

    return w;
}

/*
 * ---- remaining routines are private, not called externally ----
 */

Aes.subBytes = function(s, Nb) {    // apply SBox to state S [§5.1.1]
    for (var r = 0; r < 4; r++) {
        for (var c = 0; c < Nb; c++)
            s[r][c] = Aes.sBox[s[r][c]];
    }
    return s;
}

Aes.shiftRows = function(s, Nb) {    // shift row r of state S left by r bytes [§5.1.2]
    var t = new Array(4);
    for (var r = 1; r < 4; r++) {
        for (var c = 0; c < 4; c++)
            t[c] = s[r][(c + r) % Nb];  // shift into temp copy
        for (var c = 0; c < 4; c++)
            s[r][c] = t[c];         // and copy back
    }          // note that this will work for Nb=4,5,6, but not 7,8 (always 4 for AES):
    return s;  // see asmaes.sourceforge.net/rijndael/rijndaelImplementation.pdf
}

Aes.mixColumns = function(s, Nb) {   // combine bytes of each col of state S [§5.1.3]
    for (var c = 0; c < 4; c++) {
        var a = new Array(4);  // 'a' is a copy of the current column from 's'
        var b = new Array(4);  // 'b' is a•{02} in GF(2^8)
        for (var i = 0; i < 4; i++) {
            a[i] = s[i][c];
            b[i] = s[i][c] & 0x80 ? s[i][c] << 1 ^ 0x011b : s[i][c] << 1;

        }
        // a[n] ^ b[n] is a•{03} in GF(2^8)
        s[0][c] = b[0] ^ a[1] ^ b[1] ^ a[2] ^ a[3]; // 2*a0 + 3*a1 + a2 + a3
        s[1][c] = a[0] ^ b[1] ^ a[2] ^ b[2] ^ a[3]; // a0 * 2*a1 + 3*a2 + a3
        s[2][c] = a[0] ^ a[1] ^ b[2] ^ a[3] ^ b[3]; // a0 + a1 + 2*a2 + 3*a3
        s[3][c] = a[0] ^ b[0] ^ a[1] ^ a[2] ^ b[3]; // 3*a0 + a1 + a2 + 2*a3
    }
    return s;
}

Aes.addRoundKey = function(state, w, rnd, Nb) {  // xor Round Key into state S [§5.1.4]
    for (var r = 0; r < 4; r++) {
        for (var c = 0; c < Nb; c++)
            state[r][c] ^= w[rnd * 4 + c][r];
    }
    return state;
}

Aes.subWord = function(w) {    // apply SBox to 4-byte word w
    for (var i = 0; i < 4; i++)
        w[i] = Aes.sBox[w[i]];
    return w;
}

Aes.rotWord = function(w) {    // rotate 4-byte word w left by one byte
    var tmp = w[0];
    for (var i = 0; i < 3; i++)
        w[i] = w[i + 1];
    w[3] = tmp;
    return w;
}

// sBox is pre-computed multiplicative inverse in GF(2^8) used in subBytes and keyExpansion [§5.1.1]
Aes.sBox = [0x63, 0x7c, 0x77, 0x7b, 0xf2, 0x6b, 0x6f, 0xc5, 0x30, 0x01, 0x67, 0x2b, 0xfe, 0xd7, 0xab, 0x76,
    0xca, 0x82, 0xc9, 0x7d, 0xfa, 0x59, 0x47, 0xf0, 0xad, 0xd4, 0xa2, 0xaf, 0x9c, 0xa4, 0x72, 0xc0,
    0xb7, 0xfd, 0x93, 0x26, 0x36, 0x3f, 0xf7, 0xcc, 0x34, 0xa5, 0xe5, 0xf1, 0x71, 0xd8, 0x31, 0x15,
    0x04, 0xc7, 0x23, 0xc3, 0x18, 0x96, 0x05, 0x9a, 0x07, 0x12, 0x80, 0xe2, 0xeb, 0x27, 0xb2, 0x75,
    0x09, 0x83, 0x2c, 0x1a, 0x1b, 0x6e, 0x5a, 0xa0, 0x52, 0x3b, 0xd6, 0xb3, 0x29, 0xe3, 0x2f, 0x84,
    0x53, 0xd1, 0x00, 0xed, 0x20, 0xfc, 0xb1, 0x5b, 0x6a, 0xcb, 0xbe, 0x39, 0x4a, 0x4c, 0x58, 0xcf,
    0xd0, 0xef, 0xaa, 0xfb, 0x43, 0x4d, 0x33, 0x85, 0x45, 0xf9, 0x02, 0x7f, 0x50, 0x3c, 0x9f, 0xa8,
    0x51, 0xa3, 0x40, 0x8f, 0x92, 0x9d, 0x38, 0xf5, 0xbc, 0xb6, 0xda, 0x21, 0x10, 0xff, 0xf3, 0xd2,
    0xcd, 0x0c, 0x13, 0xec, 0x5f, 0x97, 0x44, 0x17, 0xc4, 0xa7, 0x7e, 0x3d, 0x64, 0x5d, 0x19, 0x73,
    0x60, 0x81, 0x4f, 0xdc, 0x22, 0x2a, 0x90, 0x88, 0x46, 0xee, 0xb8, 0x14, 0xde, 0x5e, 0x0b, 0xdb,
    0xe0, 0x32, 0x3a, 0x0a, 0x49, 0x06, 0x24, 0x5c, 0xc2, 0xd3, 0xac, 0x62, 0x91, 0x95, 0xe4, 0x79,
    0xe7, 0xc8, 0x37, 0x6d, 0x8d, 0xd5, 0x4e, 0xa9, 0x6c, 0x56, 0xf4, 0xea, 0x65, 0x7a, 0xae, 0x08,
    0xba, 0x78, 0x25, 0x2e, 0x1c, 0xa6, 0xb4, 0xc6, 0xe8, 0xdd, 0x74, 0x1f, 0x4b, 0xbd, 0x8b, 0x8a,
    0x70, 0x3e, 0xb5, 0x66, 0x48, 0x03, 0xf6, 0x0e, 0x61, 0x35, 0x57, 0xb9, 0x86, 0xc1, 0x1d, 0x9e,
    0xe1, 0xf8, 0x98, 0x11, 0x69, 0xd9, 0x8e, 0x94, 0x9b, 0x1e, 0x87, 0xe9, 0xce, 0x55, 0x28, 0xdf,
    0x8c, 0xa1, 0x89, 0x0d, 0xbf, 0xe6, 0x42, 0x68, 0x41, 0x99, 0x2d, 0x0f, 0xb0, 0x54, 0xbb, 0x16];

// rCon is Round Constant used for the Key Expansion [1st col is 2^(r-1) in GF(2^8)] [§5.2]
Aes.rCon = [[0x00, 0x00, 0x00, 0x00],
    [0x01, 0x00, 0x00, 0x00],
    [0x02, 0x00, 0x00, 0x00],
    [0x04, 0x00, 0x00, 0x00],
    [0x08, 0x00, 0x00, 0x00],
    [0x10, 0x00, 0x00, 0x00],
    [0x20, 0x00, 0x00, 0x00],
    [0x40, 0x00, 0x00, 0x00],
    [0x80, 0x00, 0x00, 0x00],
    [0x1b, 0x00, 0x00, 0x00],
    [0x36, 0x00, 0x00, 0x00]];


/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -  */
/*  AES Counter-mode implementation in JavaScript (c) Chris Veness 2005-2014                      */
/*   - see http://csrc.nist.gov/publications/nistpubs/800-38a/sp800-38a.pdf                       */
/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -  */

Aes.Ctr = {};  // Aes.Ctr namespace: a subclass or extension of Aes

/** 
 * Encrypt a text using AES encryption in Counter mode of operation
 *
 * Unicode multi-byte character safe
 *
 * @param {String} plaintext Source text to be encrypted
 * @param {String} password  The password to use to generate a key
 * @param {Number} nBits     Number of bits to be used in the key (128, 192, or 256)
 * @returns {string}         Encrypted text
 */
Aes.Ctr.encrypt = function(plaintext, password, nBits) {
    var blockSize = 16;  // block size fixed at 16 bytes / 128 bits (Nb=4) for AES
    if (!(nBits == 128 || nBits == 192 || nBits == 256))
        return '';  // standard allows 128/192/256 bit keys
    plaintext = Utf8.encode(plaintext);
    password = Utf8.encode(password);
    //var t = new Date();  // timer

    // use AES itself to encrypt password to get cipher key (using plain password as source for key 
    // expansion) - gives us well encrypted key (though hashed key might be preferred for prod'n use)
    var nBytes = nBits / 8;  // no bytes in key (16/24/32)
    var pwBytes = new Array(nBytes);
    for (var i = 0; i < nBytes; i++) {  // use 1st 16/24/32 chars of password for key
        pwBytes[i] = isNaN(password.charCodeAt(i)) ? 0 : password.charCodeAt(i);
    }
    var key = Aes.cipher(pwBytes, Aes.keyExpansion(pwBytes));  // gives us 16-byte key
    key = key.concat(key.slice(0, nBytes - 16));  // expand key to 16/24/32 bytes long

    // initialise 1st 8 bytes of counter block with nonce (NIST SP800-38A §B.2): [0-1] = millisec, 
    // [2-3] = random, [4-7] = seconds, together giving full sub-millisec uniqueness up to Feb 2106
    var counterBlock = new Array(blockSize);

    var nonce = (new Date()).getTime();  // timestamp: milliseconds since 1-Jan-1970
    var nonceMs = nonce % 1000;
    var nonceSec = Math.floor(nonce / 1000);
    var nonceRnd = Math.floor(Math.random() * 0xffff);

    for (var i = 0; i < 2; i++)
        counterBlock[i] = (nonceMs >>> i * 8) & 0xff;
    for (var i = 0; i < 2; i++)
        counterBlock[i + 2] = (nonceRnd >>> i * 8) & 0xff;
    for (var i = 0; i < 4; i++)
        counterBlock[i + 4] = (nonceSec >>> i * 8) & 0xff;

    // and convert it to a string to go on the front of the ciphertext
    var ctrTxt = '';
    for (var i = 0; i < 8; i++)
        ctrTxt += String.fromCharCode(counterBlock[i]);

    // generate key schedule - an expansion of the key into distinct Key Rounds for each round
    var keySchedule = Aes.keyExpansion(key);

    var blockCount = Math.ceil(plaintext.length / blockSize);
    var ciphertxt = new Array(blockCount);  // ciphertext as array of strings

    for (var b = 0; b < blockCount; b++) {
        // set counter (block #) in last 8 bytes of counter block (leaving nonce in 1st 8 bytes)
        // done in two stages for 32-bit ops: using two words allows us to go past 2^32 blocks (68GB)
        for (var c = 0; c < 4; c++)
            counterBlock[15 - c] = (b >>> c * 8) & 0xff;
        for (var c = 0; c < 4; c++)
            counterBlock[15 - c - 4] = (b / 0x100000000 >>> c * 8)

        var cipherCntr = Aes.cipher(counterBlock, keySchedule);  // -- encrypt counter block --

        // block size is reduced on final block
        var blockLength = b < blockCount - 1 ? blockSize : (plaintext.length - 1) % blockSize + 1;
        var cipherChar = new Array(blockLength);

        for (var i = 0; i < blockLength; i++) {  // -- xor plaintext with ciphered counter char-by-char --
            cipherChar[i] = cipherCntr[i] ^ plaintext.charCodeAt(b * blockSize + i);
            cipherChar[i] = String.fromCharCode(cipherChar[i]);
        }
        ciphertxt[b] = cipherChar.join('');
    }

    // Array.join is more efficient than repeated string concatenation in IE
    var ciphertext = ctrTxt + ciphertxt.join('');
    ciphertext = Base64.encode(ciphertext);  // encode in base64

    //alert((new Date()) - t);
    return ciphertext;
}

/** 
 * Decrypt a text encrypted by AES in counter mode of operation
 *
 * @param {String} ciphertext Source text to be encrypted
 * @param {String} password   The password to use to generate a key
 * @param {Number} nBits      Number of bits to be used in the key (128, 192, or 256)
 * @returns {String}          Decrypted text
 */
Aes.Ctr.decrypt = function(ciphertext, password, nBits) {
    var blockSize = 16;  // block size fixed at 16 bytes / 128 bits (Nb=4) for AES
    if (!(nBits == 128 || nBits == 192 || nBits == 256))
        return '';  // standard allows 128/192/256 bit keys
    ciphertext = Base64.decode(ciphertext);
    password = Utf8.encode(password);
    //var t = new Date();  // timer

    // use AES to encrypt password (mirroring encrypt routine)
    var nBytes = nBits / 8;  // no bytes in key
    var pwBytes = new Array(nBytes);
    for (var i = 0; i < nBytes; i++) {
        pwBytes[i] = isNaN(password.charCodeAt(i)) ? 0 : password.charCodeAt(i);
    }
    var key = Aes.cipher(pwBytes, Aes.keyExpansion(pwBytes));
    key = key.concat(key.slice(0, nBytes - 16));  // expand key to 16/24/32 bytes long

    // recover nonce from 1st 8 bytes of ciphertext
    var counterBlock = new Array(8);
    ctrTxt = ciphertext.slice(0, 8);
    for (var i = 0; i < 8; i++)
        counterBlock[i] = ctrTxt.charCodeAt(i);

    // generate key schedule
    var keySchedule = Aes.keyExpansion(key);

    // separate ciphertext into blocks (skipping past initial 8 bytes)
    var nBlocks = Math.ceil((ciphertext.length - 8) / blockSize);
    var ct = new Array(nBlocks);
    for (var b = 0; b < nBlocks; b++)
        ct[b] = ciphertext.slice(8 + b * blockSize, 8 + b * blockSize + blockSize);
    ciphertext = ct;  // ciphertext is now array of block-length strings

    // plaintext will get generated block-by-block into array of block-length strings
    var plaintxt = new Array(ciphertext.length);

    for (var b = 0; b < nBlocks; b++) {
        // set counter (block #) in last 8 bytes of counter block (leaving nonce in 1st 8 bytes)
        for (var c = 0; c < 4; c++)
            counterBlock[15 - c] = ((b) >>> c * 8) & 0xff;
        for (var c = 0; c < 4; c++)
            counterBlock[15 - c - 4] = (((b + 1) / 0x100000000 - 1) >>> c * 8) & 0xff;

        var cipherCntr = Aes.cipher(counterBlock, keySchedule);  // encrypt counter block

        var plaintxtByte = new Array(ciphertext[b].length);
        for (var i = 0; i < ciphertext[b].length; i++) {
            // -- xor plaintxt with ciphered counter byte-by-byte --
            plaintxtByte[i] = cipherCntr[i] ^ ciphertext[b].charCodeAt(i);
            plaintxtByte[i] = String.fromCharCode(plaintxtByte[i]);
        }
        plaintxt[b] = plaintxtByte.join('');
    }

    // join array of blocks into single plaintext string
    var plaintext = plaintxt.join('');
    plaintext = Utf8.decode(plaintext);  // decode from UTF8 back to Unicode multi-byte chars

    //alert((new Date()) - t);
    return plaintext;
}


/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -  */
/*  Base64 class: Base 64 encoding / decoding (c) Chris Veness 2002-2014                          */
/*    note: depends on Utf8 class                                                                 */
/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -  */

var Base64 = {};  // Base64 namespace

Base64.code = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=";

/**
 * Encode string into Base64, as defined by RFC 4648 [http://tools.ietf.org/html/rfc4648]
 * (instance method extending String object). As per RFC 4648, no newlines are added.
 *
 * @param {String} str The string to be encoded as base-64
 * @param {Boolean} [utf8encode=false] Flag to indicate whether str is Unicode string to be encoded 
 *   to UTF8 before conversion to base64; otherwise string is assumed to be 8-bit characters
 * @returns {String} Base64-encoded string
 */
Base64.encode = function(str, utf8encode) {  // http://tools.ietf.org/html/rfc4648
    utf8encode = (typeof utf8encode == 'undefined') ? false : utf8encode;
    var o1, o2, o3, bits, h1, h2, h3, h4, e = [], pad = '', c, plain, coded;
    var b64 = Base64.code;

    plain = utf8encode ? str.encodeUTF8() : str;

    c = plain.length % 3;  // pad string to length of multiple of 3
    if (c > 0) {
        while (c++ < 3) {
            pad += '=';
            plain += '\0';
        }
    }
    // note: doing padding here saves us doing special-case packing for trailing 1 or 2 chars

    for (c = 0; c < plain.length; c += 3) {  // pack three octets into four hexets
        o1 = plain.charCodeAt(c);
        o2 = plain.charCodeAt(c + 1);
        o3 = plain.charCodeAt(c + 2);

        bits = o1 << 16 | o2 << 8 | o3;

        h1 = bits >> 18 & 0x3f;
        h2 = bits >> 12 & 0x3f;
        h3 = bits >> 6 & 0x3f;
        h4 = bits & 0x3f;

        // use hextets to index into code string
        e[c / 3] = b64.charAt(h1) + b64.charAt(h2) + b64.charAt(h3) + b64.charAt(h4);
    }
    coded = e.join('');  // join() is far faster than repeated string concatenation in IE

    // replace 'A's from padded nulls with '='s
    coded = coded.slice(0, coded.length - pad.length) + pad;

    return coded;
}

/**
 * Decode string from Base64, as defined by RFC 4648 [http://tools.ietf.org/html/rfc4648]
 * (instance method extending String object). As per RFC 4648, newlines are not catered for.
 *
 * @param {String} str The string to be decoded from base-64
 * @param {Boolean} [utf8decode=false] Flag to indicate whether str is Unicode string to be decoded 
 *   from UTF8 after conversion from base64
 * @returns {String} decoded string
 */
Base64.decode = function(str, utf8decode) {
    utf8decode = (typeof utf8decode == 'undefined') ? false : utf8decode;
    var o1, o2, o3, h1, h2, h3, h4, bits, d = [], plain, coded;
    var b64 = Base64.code;

    coded = utf8decode ? str.decodeUTF8() : str;


    for (var c = 0; c < coded.length; c += 4) {  // unpack four hexets into three octets
        h1 = b64.indexOf(coded.charAt(c));
        h2 = b64.indexOf(coded.charAt(c + 1));
        h3 = b64.indexOf(coded.charAt(c + 2));
        h4 = b64.indexOf(coded.charAt(c + 3));

        bits = h1 << 18 | h2 << 12 | h3 << 6 | h4;

        o1 = bits >>> 16 & 0xff;
        o2 = bits >>> 8 & 0xff;
        o3 = bits & 0xff;

        d[c / 4] = String.fromCharCode(o1, o2, o3);
        // check for padding
        if (h4 == 0x40)
            d[c / 4] = String.fromCharCode(o1, o2);
        if (h3 == 0x40)
            d[c / 4] = String.fromCharCode(o1);
    }
    plain = d.join('');  // join() is far faster than repeated string concatenation in IE

    return utf8decode ? plain.decodeUTF8() : plain;
}


/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -  */
/*  Utf8 class: encode / decode between multi-byte Unicode characters and UTF-8 multiple          */
/*              single-byte character encoding (c) Chris Veness 2002-2014                         */
/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -  */

var Utf8 = {};  // Utf8 namespace

/**
 * Encode multi-byte Unicode string into utf-8 multiple single-byte characters 
 * (BMP / basic multilingual plane only)
 *
 * Chars in range U+0080 - U+07FF are encoded in 2 chars, U+0800 - U+FFFF in 3 chars
 *
 * @param {String} strUni Unicode string to be encoded as UTF-8
 * @returns {String} encoded string
 */
Utf8.encode = function(strUni) {
    // use regular expressions & String.replace callback function for better efficiency 
    // than procedural approaches
    var strUtf = strUni.replace(
            /[\u0080-\u07ff]/g, // U+0080 - U+07FF => 2 bytes 110yyyyy, 10zzzzzz
            function(c) {
                var cc = c.charCodeAt(0);
                return String.fromCharCode(0xc0 | cc >> 6, 0x80 | cc & 0x3f);
            }
    );
    strUtf = strUtf.replace(
            /[\u0800-\uffff]/g, // U+0800 - U+FFFF => 3 bytes 1110xxxx, 10yyyyyy, 10zzzzzz
            function(c) {
                var cc = c.charCodeAt(0);
                return String.fromCharCode(0xe0 | cc >> 12, 0x80 | cc >> 6 & 0x3F, 0x80 | cc & 0x3f);
            }
    );
    return strUtf;
}

/**
 * Decode utf-8 encoded string back into multi-byte Unicode characters
 *
 * @param {String} strUtf UTF-8 string to be decoded back to Unicode
 * @returns {String} decoded string
 */
Utf8.decode = function(strUtf) {
    // note: decode 3-byte chars first as decoded 2-byte strings could appear to be 3-byte char!
    var strUni = strUtf.replace(
            /[\u00e0-\u00ef][\u0080-\u00bf][\u0080-\u00bf]/g, // 3-byte chars
            function(c) {  // (note parentheses for precence)
                var cc = ((c.charCodeAt(0) & 0x0f) << 12) | ((c.charCodeAt(1) & 0x3f) << 6) | (c.charCodeAt(2) & 0x3f);
                return String.fromCharCode(cc);
            }
    );
    strUni = strUni.replace(
            /[\u00c0-\u00df][\u0080-\u00bf]/g, // 2-byte chars
            function(c) {  // (note parentheses for precence)
                var cc = (c.charCodeAt(0) & 0x1f) << 6 | c.charCodeAt(1) & 0x3f;
                return String.fromCharCode(cc);
            }
    );
    return strUni;
}