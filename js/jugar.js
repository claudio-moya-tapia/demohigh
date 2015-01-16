/**
 * 
 * @class Jugar
 * @extends Controller
 */
function Jugar() {
    this.init();
    this.aryVersus = new Array();
    this.isJugar = true;
}

Jugar.prototype = new Controller();
Jugar.prototype.constructor = Jugar;

Jugar.prototype.index = function() {
    Shared.analytics(this);
    this.setNumbersOnly();
    this.setPrediccionEvent();
    //this.ajaxPrediccion();
    this.ajaxResultados();

    //fake button
    $('#botonGuardarPredicciones').click(function(e) {
        if (e.preventDefault) {
            e.preventDefault();
        } else {
            e.returnValue = false;
        }

        $('#loadingMsg').html('Guardando...');
        $('#loadingBox').slideDown(function() {
            $('#loadingMsg').html('');
            $('#loadingBox').slideUp();
        });
    });
};

Jugar.prototype.cuartosOctavos = function() {
    this.isJugar = false;
    Shared.analytics(this);
    this.setNumbersOnly();
    this.setPrediccionEvent();
    this.ajaxResultados();
};

Jugar.prototype.final = function() {
    this.isJugar = false;
    Shared.analytics(this);
    this.setNumbersOnly();
    this.setPrediccionEvent();
    this.ajaxResultados();
};


Jugar.prototype.setNumbersOnly = function() {
    $('input[name="PrediccionA[]"],input[name="PrediccionB[]"]').keydown(function(e) {

        // Allow: backspace, delete, tab, escape, enter
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110]) !== -1 ||
                // Allow: Ctrl+A
                        (e.keyCode == 65 && e.ctrlKey === true) ||
                        // Allow: home, end, left, right
                                (e.keyCode >= 35 && e.keyCode <= 39)) {
                    // let it happen, don't do anything
                    return;
                }
                // Ensure that it is a number and stop the keypress
                if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                    e.preventDefault();
                }
            });
};

Jugar.prototype.setPrediccionEvent = function() {

    var jugarIndex = new Jugar();
    var isJugar = this.isJugar;

    $('input[name="PrediccionA[]"]').change(function() {
        jugarIndex.ajaxPrediccionUpdate(this, 'A');
        if (isJugar) {
            jugarIndex.refreshTablaPosiciones();
        }
    });

    $('input[name="PrediccionB[]"]').change(function() {
        jugarIndex.ajaxPrediccionUpdate(this, 'B');
        if (isJugar) {
            jugarIndex.refreshTablaPosiciones();
        }
    });
};

Jugar.prototype.ajaxPrediccionUpdate = function(obj, tipo) {

    $('input[name="PrediccionA[]"]').prop('readonly', true);
    $('input[name="PrediccionB[]"]').prop('readonly', true);

    $('#loadingMsg').html('Guardando...');
    $('#loadingBox').slideDown();

    var jugarIndex = this;
    var prediccion = new Prediccion();
    var params = '';
    var versus_id = $(obj).attr('id').toString();

    if (tipo == 'A') {

        var id = versus_id.replace('PrediccionA_', '');

        params = {id: id, goles_a: $(obj).val()};
    } else
    if (tipo == 'B') {

        var id = versus_id.replace('PrediccionB_', '');

        params = {id: id, goles_b: $(obj).val()};
    }

    $.get(prediccion.getActionUrl('ajaxUpdate'), params, function(response) {
        jugarIndex.ajaxPrediccionUpdateResponse(response);
    }).fail(function() {
        $('#loadingBox').slideUp(function() {
            $('#loadingMsg').html('');
        });

        alert('Su sesión a caducado, vuelva a ingresar al sistema.');
        location.assign(Config.baseUrl + '/' + Config.project);
    });
};

Jugar.prototype.ajaxPrediccionUpdateResponse = function(response) {

    $('#loadingBox').slideUp(function() {
        $('#loadingMsg').html('');
        $('input[name="PrediccionA[]"]').prop('readonly', false);
        $('input[name="PrediccionB[]"]').prop('readonly', false);
    });

    switch (response) {
        case 'error-grupo':
            alert('Sólo el administrador del grupo puede cambiar las predicciones.');
            break;
        case 'out-of-time':
            alert('Las predicciones sólo se pueden editar 5 minutos antes del partido.');
            break;
    }
};

/* @function {Grupo} grupo */
/* @function {Pais} pais */
/* @function {Versus} versus */
Jugar.prototype.setVersus = function() {

    var versus = new Versus();
    this.aryVersus = versus.getGrupos();
};

Jugar.prototype.ajaxResultados = function() {

    $('#loadingMsg').html('Cargando...');
    $('#loadingBox').slideDown();

    var versus = new Object();

    for (var i in Shared.aryVersusJSON) {
        versus = Shared.aryVersusJSON[i];

        if (!Shared.canPlay(versus.versus_id)) {
            $('#VersusResultado_' + versus.versus_id).html(versus.goles_a + ' - ' + versus.goles_b);
            $('#VersusGanador_' + versus.versus_id).val(versus.ganador);
            $('#ResultadoA_' + versus.versus_id).val(versus.goles_a);
            $('#ResultadoB_' + versus.versus_id).val(versus.goles_b);
        }
    }

    this.ajaxPrediccion();
//    var jugarIndex = this;
//    var versus = new Versus();
//    $.getJSON(versus.getActionUrl('ajaxList'), {}, function(response) {         
//        Shared.aryVersusJSON = response;        
//        jugarIndex.ajaxResultadosResponse(response);
//    });
};

//Jugar.prototype.ajaxResultadosResponse = function(jsonListVersus) {
//    
//    var versus = new Object();
//    
//    for (var i in jsonListVersus) {
//        versus = jsonListVersus[i];
//        
//        if(!Shared.canPlay(versus.versus_id)){            
//            $('#VersusResultado_'+ versus.versus_id).html(versus.goles_a+' - '+versus.goles_b);
//            $('#VersusGanador_'+ versus.versus_id).val(versus.ganador);
//            $('#ResultadoA_'+ versus.versus_id).val(versus.goles_a);
//            $('#ResultadoB_'+ versus.versus_id).val(versus.goles_b);
//        }        
//    }
//    
//    this.ajaxPrediccion();
//};

Jugar.prototype.ajaxPrediccion = function() {

    $('#loadingMsg').html('Cargando...');
    $('#loadingBox').slideDown();

    var jugarIndex = this;
    var prediccion = new Prediccion();
    $.getJSON(prediccion.getActionUrl('ajaxList'), {}, function(response) {
        jugarIndex.ajaxPrediccionResponse(response);
    });
};

/* @function {Versus} versus */
/* @function {Versus} aryVersus */
Jugar.prototype.ajaxPrediccionResponse = function(jsonListPrediccion) {

    $('#loadingBox').slideUp(function() {
        $('#loadingMsg').html('');
    });

    var jugarIndex = new Jugar();
    var aryVersus = Shared.getVersus();
    var versus = new Versus();
    var prediccion = new Prediccion();

    for (var x in aryVersus) {
        versus = new Versus();
        versus.set(aryVersus[x]);

        for (var y in jsonListPrediccion) {
            prediccion = jsonListPrediccion[y];

            if (versus.versus_id == prediccion.versus_id) {

                $('#PrediccionA_' + prediccion.versus_id).val(prediccion.goles_a);
                $('#PrediccionB_' + prediccion.versus_id).val(prediccion.goles_b);

                if (!Shared.canPlay(prediccion.versus_id)) {
                    var valueA = $('#PrediccionA_' + prediccion.versus_id).val();
                    var hiddenA = '<input type="hidden" name="PrediccionA[]" id="PrediccionA_' + prediccion.versus_id + '" value="' + valueA + '" />';
                    var spanA = '<span style="float:left">' + prediccion.goles_a + '&nbsp;-</span>';

                    var valueB = $('#PrediccionB_' + prediccion.versus_id).val();
                    var hiddenB = '<input type="hidden" name="PrediccionB[]" id="PrediccionB_' + prediccion.versus_id + '" value="' + valueB + '" />';
                    var spanB = '<span style="float:left">&nbsp;' + prediccion.goles_b + '</span>';

                    $('#PrediccionA_' + prediccion.versus_id).replaceWith(hiddenA + spanA);
                    $('#PrediccionB_' + prediccion.versus_id).replaceWith(hiddenB + spanB);
                }
            }
        }
    }


    for (var x in aryVersus) {
        versus = new Versus();
        versus.set(aryVersus[x]);

        if (this.isJugar) {
            //fase grupos
            if (x > 47) {
                break;
            }

        } else {
            //fase octavos y cuartos
            if (x < 48) {
                continue;
            }
        }


        if (!Shared.canPlay(versus.versus_id)) {

            var check = $('#PrediccionA_' + versus.versus_id).val();
           
            if(parseInt(check) >= 0){
                
                var valueA = $('#PrediccionA_' + versus.versus_id).val();
                var valueB = $('#PrediccionB_' + versus.versus_id).val();
                var removeEmpty = false;

                if (valueA.length == 0) {
                    removeEmpty = true;
                }

                if (valueB.length == 0) {
                    removeEmpty = true;
                }

                if (removeEmpty) {
                    var hiddenA = '<input type="hidden" name="PrediccionA[]" id="PrediccionA_' + versus.versus_id + '" value="" />';
                    var hiddenB = '<input type="hidden" name="PrediccionB[]" id="PrediccionB_' + versus.versus_id + '" value="" />';

                    $('#PrediccionA_' + versus.versus_id).replaceWith(hiddenA);
                    $('#PrediccionB_' + versus.versus_id).replaceWith(hiddenB);
                }                
            }            
        }
    }

    
    jugarIndex.refreshTablaPosiciones();    
};

Jugar.prototype.setTablaDataValor = function(item, id, valor) {
    $('#' + item + '_' + id).html(valor);
};

/* @function {Prediccion} prediccion */
/* @returns {Prediccion} prediccion */
Jugar.prototype.getPrediccionFrom = function(obj) {
    var aryPrediccion = $(obj).children('input').eq(0).val().split('&');
    var pais_id_a = parseInt(aryPrediccion[0].replace('pais_id_a=', ''));
    var pais_id_b = parseInt(aryPrediccion[1].replace('pais_id_b=', ''));
    var goles_a = parseInt(aryPrediccion[2].replace('goles_a=', ''));
    var goles_b = parseInt(aryPrediccion[3].replace('goles_b=', ''));
    var ganador = parseInt(aryPrediccion[4].replace('ganador=', ''));

    var prediccion = new Prediccion();
    prediccion.pais_id_a = pais_id_a;
    prediccion.pais_id_b = pais_id_b;
    prediccion.goles_a = goles_a;
    prediccion.goles_b = goles_b;
    prediccion.ganador = ganador;

    return prediccion;
};

Jugar.prototype.calcularPJ = function(versus, pais, tipo) {

    if (tipo == 'A') {
        if (versus.tienePrediccion) {
            pais.PJ += 1;
        }
    }

    if (tipo == 'B') {
        if (versus.tienePrediccion) {
            pais.PJ += 1;
        }
    }

    return pais;
};

Jugar.prototype.calcularPG = function(versus, pais, tipo) {

    if (tipo == 'A') {
        if (versus.prediccionA > versus.prediccionB) {
            pais.PG += 1;
        }
    }

    if (tipo == 'B') {
        if (versus.prediccionB > versus.prediccionA) {
            pais.PG += 1;
        }
    }

    return pais;
};

Jugar.prototype.calcularPE = function(versus, pais) {

    if (versus.prediccionA == versus.prediccionB) {
        pais.PE += 1;
    }

    return pais;
};

Jugar.prototype.calcularPP = function(versus, pais, tipo) {

    if (tipo == 'A') {
        if (versus.prediccionA < versus.prediccionB) {
            pais.PP += 1;
        }
    }

    if (tipo == 'B') {
        if (versus.prediccionA > versus.prediccionB) {
            pais.PP += 1;
        }
    }

    return pais;
};

Jugar.prototype.calcularGF = function(versus, pais, tipo) {

    if (tipo == 'A') {
        if (versus.prediccionA > versus.prediccionB) {
            pais.GF += versus.prediccionA;
        }

        if (versus.prediccionA == versus.prediccionB) {
            pais.GF += versus.prediccionA;
        }

        if (versus.prediccionA < versus.prediccionB) {
            pais.GF += versus.prediccionA;
        }
    }

    if (tipo == 'B') {
        if (versus.prediccionB > versus.prediccionA) {
            pais.GF += versus.prediccionB;
        }

        if (versus.prediccionA == versus.prediccionB) {
            pais.GF += versus.prediccionB;
        }

        if (versus.prediccionB < versus.prediccionA) {
            pais.GF += versus.prediccionB;
        }
    }

    return pais;
};

Jugar.prototype.calcularGC = function(versus, pais, tipo) {

    if (tipo == 'A') {
        pais.GC += versus.prediccionB;
    }

    if (tipo == 'B') {
        pais.GC += versus.prediccionA;
    }

    return pais;
};

Jugar.prototype.calcularDIF = function(versus, pais) {

    pais.DIF = pais.GF - pais.GC;

    return pais;
};

Jugar.prototype.calcularPTSG = function(versusObj, paisObj, tipo) {
    var versus = new Versus();
    versus.set(versusObj);

    var pais = new Pais();
    pais.set(paisObj);

    if (tipo == 'A') {
        if (versus.prediccionA > versus.prediccionB) {
            pais.PTSG += 3;
        }
    }

    if (tipo == 'B') {
        if (versus.prediccionA < versus.prediccionB) {
            pais.PTSG += 3;
        }
    }

    return pais;
};

Jugar.prototype.calcularPTSE = function(versusObj, paisObj) {
    var versus = new Versus();
    versus.set(versusObj);

    var pais = new Pais();
    pais.set(paisObj);

    if (versus.prediccionA == versus.prediccionB) {
        pais.PTSE += 1;
    }

    return pais;
};

Jugar.prototype.calcularPTS = function(versusObj, paisObj) {
    var versus = new Versus();
    versus.set(versusObj);

    var pais = new Pais();
    pais.set(paisObj);

    pais.PTS = pais.PTSG + pais.PTSE;

    return pais;
};

/* @function {Versus} versus */
Jugar.prototype.calcularPTSVersus = function(versusObj) {
    var versus = new Versus();
    versus.set(versusObj);

    var puntos = 0;

    //REGLA 1 puntos a ganador o empate
    //Ganador A
    if (versus.ganador.pais_id == versus.paisA.pais_id) {

        if (versus.prediccionA > versus.prediccionB) {
            puntos += 3;
            versus.PTSganadorA = 3;
        }
    }

    //Ganador B
    if (versus.ganador.pais_id == versus.paisB.pais_id) {

        if (versus.prediccionA < versus.prediccionB) {
            puntos += 3;
            versus.PTSganadorB = 3;
        }
    }

    //Empate
    if (versus.ganador.pais_id == 0) {

        if (versus.prediccionA == versus.prediccionB) {
            puntos += 3;
            versus.PTSempate = 3;
        }
    }

    //REGLA 2
    //Puntaje por Score 1: Si acierta a los goles que convirtió el equipo A
    if (versus.resultadoA == versus.prediccionA) {

        if (versus.resultadoA == 0) {
            puntos += 1;
            versus.PTSscoreA = 1;
        }

        if (versus.resultadoA == 1) {
            puntos += 1;
            versus.PTSscoreA = 1;
        }

        //
        if (versus.resultadoA > 1 && versus.resultadoA < 5) {
            puntos += parseInt(versus.resultadoA);
            versus.PTSscoreA = versus.resultadoA;
        }

        if (versus.resultadoA >= 5) {
            puntos += 5;
            versus.PTSscoreA = 5;
        }
    }

    //Puntaje por Score 2: Si acierta a los goles que convirtió el equipo B
    if (versus.resultadoB == versus.prediccionB) {

        if (versus.resultadoB == 0) {
            puntos += 1;
            versus.PTSscoreB = 1;
        }

        if (versus.resultadoB == 1) {
            puntos += 1;
            versus.PTSscoreB = 1;
        }

        if (versus.resultadoB > 1 && versus.resultadoB < 5) {
            puntos += parseInt(versus.resultadoB);
            versus.PTSscoreB = versus.resultadoB;
        }

        if (versus.resultadoB >= 5) {
            puntos += 5;
            versus.PTSscoreB = 5;
        }
    }

    versus.puntosGanador = versus.PTSganadorA + versus.PTSganadorB + versus.PTSempate;
    versus.puntosGolesGanador = versus.PTSscoreA;
    versus.puntosGolesPerdedor = versus.PTSscoreB;
    versus.puntosTotal = versus.puntosGanador + versus.puntosGolesGanador + versus.puntosGolesPerdedor;

    return versus;
};

Jugar.prototype.setPTSVersus = function(versusObj) {
    var versus = new Versus();
    versus.set(versusObj);

    $('#PuntosVersus_' + versus.versus_id + ' > .PuntosGanador').html(versus.puntosGanador);
    $('#PuntosVersus_' + versus.versus_id + ' > .PuntosGolesGanador').html(versus.puntosGolesGanador);
    $('#PuntosVersus_' + versus.versus_id + ' > .PuntosGolesPerdedor').html(versus.puntosGolesPerdedor);
    $('#PuntosVersusTotal_' + versus.versus_id).html(versus.puntosTotal);

    $('#PuntosVersusTotal_' + versus.versus_id).mouseover(function() {
        $('#PuntosVersus_' + versus.versus_id).fadeIn();
    });

    $('#PuntosVersusTotal_' + versus.versus_id).mouseout(function() {
        $('#PuntosVersus_' + versus.versus_id).fadeOut();
    });
};

Jugar.prototype.setGrupoPuntosTotal = function(grupo, grupoPuntosTotal) {

    if (grupoPuntosTotal > 0) {
        $('#grupoPuntosTotal_' + grupo.grupo_id).val('Total ' + grupoPuntosTotal + 'pts');
    }
};

Jugar.prototype.ajaxUpdateUsuarioPuntos = function(puntos, puntosPlenos) {

    var jugarIndex = new Jugar();
    var usuario = new Usuario();

    $.getJSON(usuario.getActionUrl('AjaxPuntos'), {puntos: puntos, puntosPlenos: puntosPlenos}, function(response) {
    });
};

/* @var {Pais} pais */
Jugar.prototype.refreshTablaPosiciones = function() {

    var aryVersus = Shared.getVersus();
    var aryPaises = Shared.getPaises();
    var aryGrupos = Shared.getGrupos();
    var versus = new Versus();
    var pais = new Pais();
    var grupo = new Grupo();
    var grupoPuntosTotal = 0;
    var totalPuntosUsuario = 0;
    var totalPuntosPlenos = 0;
    var tienePrediccion = false;

    //update prediccion
    for (var x in aryVersus) {
        versus = new Versus();
        versus.set(aryVersus[x]);

        var prediccionA = $.trim($('#PrediccionA_' + versus.versus_id).val());
        if (prediccionA != '') {
            prediccionA = parseInt(prediccionA);
        } else {
            prediccionA = -1;
        }

        var prediccionB = $.trim($('#PrediccionB_' + versus.versus_id).val());
        if (prediccionB != '') {
            prediccionB = parseInt(prediccionB);
        } else {
            prediccionB = -1;
        }

        versus.prediccionA = prediccionA;
        versus.prediccionB = prediccionB;

        tienePrediccion = true;
        if (versus.prediccionA == -1) {
            tienePrediccion = false;
        }

        if (versus.prediccionB == -1) {
            tienePrediccion = false;
        }

        versus.tienePrediccion = tienePrediccion;

//        if ((versus.prediccionA != -1) && (versus.prediccionA != -2)) {
//            versus.tienePrediccion = true;
//        }

        var resultadoA = $('#ResultadoA_' + versus.versus_id).val();
        var resultadoB = $('#ResultadoB_' + versus.versus_id).val();

        versus.resultadoA = parseInt(resultadoA);
        versus.resultadoB = parseInt(resultadoB);

//        if ((typeof resultadoA != 'undefined') || (typeof resultadoB != 'undefined')) {
//            versus.jugado = true;
//        }

//        var versusGanador = $('#VersusGanador_' + versus.versus_id).val();
//        if(versusGanador != 0){
//            versus.jugado = true;
//        }

        if (!Shared.canPlay(versus.versus_id)) {
            versus.jugado = true;
        }

        if (versus.jugado && versus.tienePrediccion) {

            if (versus.resultadoA > versus.resultadoB) {
                versus.ganador = versus.paisA;
            }

            if (versus.resultadoA < versus.resultadoB) {
                versus.ganador = versus.paisB;
            }

            if (versus.resultadoA == versus.resultadoB) {
                versus.ganador = new Pais();
            }

            versus = this.calcularPTSVersus(versus);
            this.setPTSVersus(versus);
        }

        aryVersus[x] = versus;
    }

    if (this.isJugar) {
        //update total puntos grupos    
        for (var x in aryGrupos) {
            grupo = new Grupo();
            grupo.set(aryGrupos[x]);
            grupoPuntosTotal = 0;

            for (var x in aryVersus) {
                versus = new Versus();
                versus.set(aryVersus[x]);

                if (versus.jugado) {
                    if (versus.paisA.grupo.grupo_id == grupo.grupo_id) {
                        grupoPuntosTotal += versus.puntosTotal;

                        //resultado pleno
                        if ((versus.resultadoA == versus.prediccionA) && (versus.resultadoB == versus.prediccionB)) {
                            totalPuntosPlenos++;
                        }
                    }
                }
            }

            totalPuntosUsuario += grupoPuntosTotal;
            this.setGrupoPuntosTotal(grupo, grupoPuntosTotal);
        }

        //update total puntos usuario
        //this.ajaxUpdateUsuarioPuntos(totalPuntosUsuario,totalPuntosPlenos);

        //order tabla posiciones    
        for (var x in aryGrupos) {
            grupo = new Grupo();
            grupo.set(aryGrupos[x]);
        }

        //set new values
        for (var x in aryPaises) {
            pais = new Pais();
            pais.set(aryPaises[x]);

            for (var y in aryVersus) {
                versus = new Versus();
                versus.set(aryVersus[y]);

                if (versus.tienePrediccion) {

                    if (versus.paisA.pais_id == pais.pais_id) {
                        pais = this.calcularPJ(versus, pais, 'A');
                        pais = this.calcularPG(versus, pais, 'A');
                        pais = this.calcularPE(versus, pais);
                        pais = this.calcularPP(versus, pais, 'A');
                        pais = this.calcularGF(versus, pais, 'A');
                        pais = this.calcularGC(versus, pais, 'A');
                        pais = this.calcularDIF(versus, pais);
                        pais = this.calcularPTSG(versus, pais, 'A');
                        pais = this.calcularPTSE(versus, pais);
                        pais = this.calcularPTS(versus, pais);
                    }

                    if (versus.paisB.pais_id == pais.pais_id) {
                        pais = this.calcularPJ(versus, pais, 'B');
                        pais = this.calcularPG(versus, pais, 'B');
                        pais = this.calcularPE(versus, pais);
                        pais = this.calcularPP(versus, pais, 'B');
                        pais = this.calcularGF(versus, pais, 'B');
                        pais = this.calcularGC(versus, pais, 'B');
                        pais = this.calcularDIF(versus, pais);
                        pais = this.calcularPTSG(versus, pais, 'B');
                        pais = this.calcularPTSE(versus, pais);
                        pais = this.calcularPTS(versus, pais);
                    }
                }
            }

            aryPaises[x] = pais;
        }

        //set table
        for (var x in aryPaises) {
            pais = new Pais();
            pais.set(aryPaises[x]);

            this.setTablaDataValor('PJ', pais.pais_id, pais.PJ);
            this.setTablaDataValor('PG', pais.pais_id, pais.PG);
            this.setTablaDataValor('PE', pais.pais_id, pais.PE);
            this.setTablaDataValor('PP', pais.pais_id, pais.PP);
            this.setTablaDataValor('GF', pais.pais_id, pais.GF);
            this.setTablaDataValor('GC', pais.pais_id, pais.GC);
            this.setTablaDataValor('DIF', pais.pais_id, pais.DIF);
            this.setTablaDataValor('PTS', pais.pais_id, pais.PTS);
        }

        //table order by PTS
        var aryPaisTmp = new Array();
        var aryTablaGrupo = new Array();

        for (var x in aryGrupos) {
            grupo = new Grupo();
            grupo.set(aryGrupos[x]);

            aryPaisTmp = new Array();
            aryTablaGrupo = new Array();

            for (var y in aryPaises) {
                pais = new Pais();
                pais.set(aryPaises[y]);

                if (pais.grupo.grupo_id == grupo.grupo_id) {
                    aryPaisTmp.push(pais);
                }
            }

            aryPaisTmp.sort(function(a, b) {
                if (a.PTS > b.PTS)
                    return -1;
                if (a.PTS < b.PTS)
                    return 1;
                // a must be equal to b
                return 0;
            });

            //order by DIF de goles
            aryPaisTmp.sort(function(a, b) {
                if (a.PTS == b.PTS) {

                    if (a.DIF == b.DIF) {

                        if (a.GF > b.GF) {
                            return -1;
                        }

                        if (a.GF < b.GF) {
                            return 1;
                        }

                    } else {

                        if (a.DIF > b.DIF) {
                            return -1;
                        }

                        if (a.DIF < b.DIF) {
                            return 1;
                        }
                    }
                }

                // a must be equal to b
                return 0;
            });

            for (var j in aryPaisTmp) {
                pais = new Pais();
                pais.set(aryPaisTmp[j]);

                $('.tablaGrupo_' + grupo.grupo_id).each(function(i) {
                    if ($(this).attr('id') == 'tablaPosicion_' + pais.pais_id) {
                        aryTablaGrupo.push(this);
                    }
                });
            }

            $('#tablaPosicionGrupo_' + grupo.grupo_id + ' .tablaGrupo_' + grupo.grupo_id).remove();

            for (var j in aryTablaGrupo) {
                $('#tablaPosicionGrupo_' + grupo.grupo_id).append($(aryTablaGrupo[j]));
            }
        }
    }
};

/**
 * End Jugar
 */