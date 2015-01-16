/**
 * 
 * @class Usuario
 * @extends Controller 
 */
function Usuario() {
    this.init();
    this.imagen = '#' + this.name + '_imagen';
    this.img = '#' + this.name + '_img';
}

Usuario.prototype = new Controller();
Usuario.prototype.constructor = Usuario;

Usuario.prototype.view = function() {
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
        $('.btn-crear').html('');
        this.top100();
    }
    
    this.setRankingAmigos();
};

Usuario.prototype.setRankingTodos = function() {
    $('#rankingContainer').before(RankingHelper.getRankingTodos());
};

Usuario.prototype.setRankingArea = function() {        
    $('#rankingContainer').before(RankingHelper.getRankingArea());
};

Usuario.prototype.setRankingPais = function() {        
    $('#rankingContainer').before(RankingHelper.getRankingPais());
};

Usuario.prototype.setRankingAmigos = function() {        
    $('#rankingContainer').before(RankingHelper.getRankingAmigos());
};

Usuario.prototype.top100 = function() {        
    $('#rankingContainer').before(RankingHelper.getRankingTop100());
};

Usuario.prototype.update = function() {
    this.form();
};

Usuario.prototype.form = function() {
    
    Documento.uploadify(
        '#DocumentoUpload',
        this.onUploadSuccess,
        200
    );

    if ($(this.imagen).val() != 'images/empty.gif') {
        $(this.img).attr('src', Config.baseUrlImg + $(this.imagen).val());
    }    
};

/**
 *      
 * @param {Documento} DocumentoJson description
 * @returns void
 */
Usuario.prototype.onUploadSuccess = function(DocumentoJson) {

    usuario = new Usuario();

    $(usuario.imagen).val(DocumentoJson.url);
    $(usuario.img).attr('src', Config.baseUrlImg + DocumentoJson.url);
};