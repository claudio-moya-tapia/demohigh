/**
 * 
 * @class Mobile
 * @extends Controller
 */
function Mobile() {
    this.init();
    this.dateNow = new Date();
}

Mobile.prototype = new Controller();
Mobile.prototype.constructor = Mobile;

Mobile.prototype.index = function() {
    
    Shared.analytics(this);   
    this.setRankingTodos();
    this.setPartidosDelDia();  
//    this.setNumbersOnly();    
//    this.setPrediccionEvent();
//    this.ajaxResultados();    
};

Mobile.prototype.setPartidosDelDia = function() {
    
    var i = 0;
    var versus = {};
    var tpl = '<h1>Próximos partidos</h1>';
    
    var fechaFormato = '';
    var fechaText = '';
        
    for(i in Shared.aryVersusJSON){ 
        versus = {};
        versus = Shared.aryVersusJSON[i];
        
        if(versus.versus_id < 63){
            continue;
        }
        
        var aryDateVersus = versus.fecha.split(' ');

        var dateVersusFecha = aryDateVersus[0];
        var dateVersusHora = aryDateVersus[1];

        var aryFecha = dateVersusFecha.split('-');
        var aryaHora = dateVersusHora.split(':');

        var year = aryFecha[0];
        var month = aryFecha[1];
        var day = aryFecha[2];
        var hour = aryaHora[0];
        var mins = aryaHora[1];

        var monthText = '';
        if(month == '06'){
            monthText = 'Junio';
        }else        
        if(month == '07'){
            monthText = 'Julio';
        }

        fechaText = day+' de '+monthText+' a las '+hour+':'+mins+'hrs.';
        fechaFormato = year+'-'+month+'-'+day+' '+hour+':'+mins+':00';

        tpl += '<div class="par partidos-dia" id="versus_id_'+versus.versus_id+'" style="display:none">';
            tpl += '<input type="hidden" value="'+fechaFormato+'" name="versus_fecha" id="versus_fecha">';
            
            tpl += '<p class="hr">'+fechaText+'</p>';
            tpl += '<img class="img1" src="'+versus.pais_a_imagen_big+'" alt="'+versus.pais_a_nombre+'">';
            tpl += '<input id="PrediccionA_'+versus.versus_id+'" maxlength="2" type="text" value="" name="PrediccionA[]">';
            tpl += '<span>-</span>';
            tpl += '<input id="PrediccionB_'+versus.versus_id+'" maxlength="2" type="text" value="" name="PrediccionB[]">';       
            tpl += '<img class="img2" src="'+versus.pais_b_imagen_big+'" alt="'+versus.pais_b_nombre+'">';
            tpl += '<div class="clear"></div>';
        tpl += '</div>';

    }
    
    $('.cont-pdd').html(tpl);
    
    this.setNumbersOnly();
    this.setPrediccionEvent();
    this.ajaxResultados();
};

Mobile.prototype.setRankingTodos = function() {
    $('#rankingContainer').before(RankingHelper.getMobileTodos());
};

Mobile.prototype.ranking = function() {
    RankingHelper.setShow();
    if(RankingHelper.showTodos){
        this.setRankingTodos();
    }
    
    if(RankingHelper.showArea){
        this.setRankingArea();
    }
    
    if(RankingHelper.showPais){
        this.setRankingPais();
    }    
    
    if(RankingHelper.showGrupos){
        this.setRankingTodos();
    }else{
        this.setRankingAmigos(); 
    }     
};

Mobile.prototype.setRankingTodos = function() {
    $('#rankingContainer').before(RankingHelper.getMobileTodos());
};

Mobile.prototype.setRankingArea = function() {        
    $('#rankingContainer').before(RankingHelper.getMobileArea());
};

Mobile.prototype.setRankingPais = function() {        
    $('#rankingContainer').before(RankingHelper.getMobilePais());
};

Mobile.prototype.setRankingAmigos = function() {        
    $('#rankingContainer').before(RankingHelper.getMobileAmigos());
};

Mobile.prototype.ajaxResultados = function() {
    
    this.partidosDelDia();
    this.ajaxPrediccion();
//    var jugarIndex = this;
//    var versus = new Versus();
//    $.getJSON(versus.getActionUrl('ajaxList'), {}, function(response) {         
//        Shared.aryVersusJSON = response;        
//        jugarIndex.ajaxResultadosResponse(response);
//    });
};
//
//Mobile.prototype.ajaxResultadosResponse = function(jsonListVersus) {    
//    this.partidosDelDia();
//    this.ajaxPrediccion();
//};

Mobile.prototype.setNumbersOnly = function() {
    $('input[name="PrediccionA[]"],input[name="PrediccionB[]"]').keydown(function(e) {

        // Allow: backspace, delete, tab, escape, enter
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110]) !== -1 ||
                // Allow: Ctrl+A
                        (e.keyCode == 65 && e.ctrlKey === true) ||
                        // Allow: mobile, end, left, right
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

/* @function {Mobile} mobileIndex */
Mobile.prototype.slider = function() {

    var mobileIndex = this;
    var noticia = new Noticia();

    $.getJSON(noticia.getActionUrl('destacados'), function(data) {
        mobileIndex.sliderResponse(data);
    });
};

Mobile.prototype.sliderResponse = function(data) {
    $("#flavor_2").agile_carousel({
        carousel_data: data,
        carousel_outer_height: 350,
        carousel_height: 250,
        slide_height: 250,
        carousel_outer_width: 700,
        slide_width: 700,
        transition_type: "fade",
        transition_time: 600,
        timer: 3000,
        continuous_scrolling: true,
        control_set_1: "numbered_buttons,previous_button, pause_button,next_button",
        control_set_2: "content_buttons",
        change_on_hover: "content_buttons"
    });
};

Mobile.prototype.setTwitter = function() {

    var mobileIndex = this;

    $('#Twitter_texto').keypress(function(event) {
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if (keycode == '13') {
            mobileIndex.ajaxTwitterCreate();
        }
    });

    $('#btnTwitter').click(function(e) {
        if (e.preventDefault) {
            e.preventDefault();
        } else {
            e.returnValue = false;
        }

        mobileIndex.ajaxTwitterCreate();
    });

    this.ajaxTwitterList();

    setInterval(function() {
        mobileIndex.ajaxTwitterList();
    }, 30000);
};

/**
 *      
 * @var {Mobile} mobileIndex
 */
Mobile.prototype.twitterCheckDate = function() {

    var mobileIndex = this;
    var tweetDate = '';

    $('#cajaTwitter > p > input.tweet_date').each(function(index, obj) {
        tweetDate = mobileIndex.parseTwitterDate($(obj).val());
        $(obj).parent().find('span.min').html(tweetDate);
    });
};

/**
 *      
 * @param {Date} dateItem
 * @returns {String}
 */
Mobile.prototype.parseTwitterDate = function(dateTweet) {

    var aryDateTime = dateTweet.split(' ');
    var aryDate = aryDateTime[0].split('-');
    var year = aryDate[0];
    var month = parseInt(aryDate[1]) - 1;
    var day = aryDate[2];
    var aryTime = aryDateTime[1].split(':');
    var hour = aryTime[0];
    var min = aryTime[1];
    var sec = aryTime[2];
    var dateItem = new Date(year, month, day, hour, min, sec, 0);
    var dateNow = new Date();
    var dateMsg = '';
    var dayDiff = 0;
    var hourDiff = 0;
    var minDiff = 0;
    var secDiff = 0;

    if (dateNow.getDay() > dateItem.getDay()) {
        dayDiff = dateNow.getDay() - dateItem.getDay();

        if (dayDiff == 1) {
            dateMsg = 'Ayer';
        } else {
            dateMsg = 'hace ' + dayDiff + ' días';
        }

    } else
    if (dateNow.getDay() == dateItem.getDay()) {

        var hoursToMinsItem = dateItem.getHours() * 60;
        var hoursToMinsNow = dateNow.getHours() * 60;
        minDiff = (hoursToMinsNow + dateNow.getMinutes()) - (hoursToMinsItem + dateItem.getMinutes());
        hourDiff = Math.floor(minDiff / 60);

        if (minDiff > 60) {

            if (hourDiff == 1) {
                dateMsg = hourDiff + 'hora';
            } else {
                dateMsg = hourDiff + 'horas';
            }

        } else {

            if (minDiff == 0) {
                secDiff = dateNow.getSeconds() - dateItem.getSeconds();
                dateMsg = secDiff + 'secs';

            } else
            if (minDiff == 1) {
                dateMsg = minDiff + 'min';
            } else {
                dateMsg = minDiff + 'mins';
            }

        }
    }

    return dateMsg;
};

Mobile.prototype.ajaxTwitterCreate = function() {

    var item_html = $("#Twitter_texto").val();
    var texto = $.trim(item_html.replace(/<\/?[^>]+>/gi, ''));

    if (texto.length > 0) {
        var mobileIndex = this;
        var twitter = new Twitter();

        $.getJSON(twitter.getActionUrl('ajaxCreate'), {texto: texto}, function(response) {
            mobileIndex.ajaxTwitterCreateResponse(response);
        });

    } else {
        alert('Ingresa un texto para el tweet.');
        $("#Twitter_texto").val('');
    }
};

Mobile.prototype.ajaxTwitterCreateResponse = function(jsonResponse) {

    if (jsonResponse.status != 'ok') {
        alert('Ocurrio un error, intente mas tarde.');
    } else {
        $('#Twitter_texto').val('');
    }

    this.ajaxTwitterList();
};

Mobile.prototype.ajaxTwitterList = function() {

    var mobileIndex = this;
    var twitter = new Twitter();

    $.getJSON(twitter.getActionUrl('ajaxList'), {}, function(response) {
        mobileIndex.ajaxTwitterListResponse(response);
    });
};

Mobile.prototype.ajaxTwitterListResponse = function(jsonResponse) {

    var twitter = new Twitter();
    var item = '';
    var itemHeight = 0;
    var mobileIndex = this;

    for (var x in jsonResponse) {
        twitter = jsonResponse[x];

        if ($('#tweet_id_' + twitter.twitter_id).length == 0) {
            item = '<p id="tweet_id_' + twitter.twitter_id + '">\n\
                    <span>' + twitter.usuario + '</span>\n\
                    <br />' + twitter.texto + '\
                    <span class="min"></span>\n\
                    <input type="hidden" class="tweet_date" value="' + twitter.fecha + '">\n\
                    </p>';
            $('#cajaTwitter').append(item);
        }

        itemHeight += $('#tweet_id_' + twitter.twitter_id).height();
    }

    $('#cajaTwitter').scrollTop($('#cajaTwitter').prop('scrollHeight'));

    mobileIndex.twitterCheckDate();
};

Mobile.prototype.ajaxPrediccion = function() {

    var mobileIndex = this;
    var prediccion = new Prediccion();
    $.getJSON(prediccion.getActionUrl('ajaxList'), {}, function(response) {
        mobileIndex.ajaxPrediccionResponse(response);
    });
};

/* @function {Versus} versus */
/* @function {Versus} aryVersus */
Mobile.prototype.ajaxPrediccionResponse = function(jsonListPrediccion) {
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
                
                if(!Shared.canPlay(versus.versus_id)){
                    $('#PrediccionA_' + prediccion.versus_id).replaceWith('<span>'+prediccion.goles_a+'</span>');
                    $('#PrediccionB_' + prediccion.versus_id).replaceWith('<span>'+prediccion.goles_b+'</span>');
                }
            }
        }
    }
};

Mobile.prototype.setPrediccionEvent = function() {
    var mobileIndex = this;
    $('input[name="PrediccionA[]"]').change(function() {
        mobileIndex.ajaxPrediccionUpdate(this, 'A');
    });

    $('input[name="PrediccionB[]"]').change(function() {
        mobileIndex.ajaxPrediccionUpdate(this, 'B');
    });
};

Mobile.prototype.ajaxPrediccionUpdate = function(obj, tipo) {
    var mobileIndex = this;
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
        mobileIndex.ajaxPrediccionUpdateResponse(response);
    }).fail(function() {
        $('#loadingBox').slideUp(function(){
            $('#loadingMsg').html('');
        });
        
        alert('Su sesión a caducado, vuelva a ingresar al sistema.');
        location.assign(Config.baseUrl+'/'+Config.project);
    });
};

Mobile.prototype.ajaxPrediccionUpdateResponse = function(response) {

};

Mobile.prototype.partidosDelDia = function() {

    var maxVersus = 3;
    var versusShowed = 0;

    $('.par').each(function() {
        var versusId = $(this).attr('id');
        var versus_id = parseInt(versusId.replace('versus_id_',''));
        
        if (versusShowed <= maxVersus) {
            $(this).prev().show();
            $(this).show();
            $(this).next().show();
            versusShowed++;
        }
//        
//        if (Shared.canPlay(versus_id)) {
//            if (versusShowed <= maxVersus) {
//                $(this).prev().show();
//                $(this).show();
//                $(this).next().show();
//                versusShowed++;
//            }
//        }
    });
};