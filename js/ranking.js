/**
 * 
 * @class Ranking
 * @extends Controller
 */
function Ranking() {
    this.init();
}

Ranking.prototype = new Controller();
Ranking.prototype.constructor = Ranking;

Ranking.prototype.index = function(){
    
    Shared.analytics(this);
    
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
    }else{
        this.setRankingAmigos();
    }
        
    var rankingIndex = this;
    
    $('.ranking-amigos').click(function(){
        if(confirm('¿Seguro que deseas quitar a '+$(this).attr('alt')+' de ranking de amigos?\nSu eliminación se verá reflejada despues del próximo partido.')){            
            rankingIndex.ajaxDeleteFriend(this);
        }       
    });
};

Ranking.prototype.setRankingTodos = function() {
    $('#rankingContainer').before(RankingHelper.getRankingTodos());
};

Ranking.prototype.setRankingArea = function() {
    $('#rankingContainer').before(RankingHelper.getRankingArea());
};

Ranking.prototype.setRankingPais = function() {        
    $('#rankingContainer').before(RankingHelper.getRankingPais());
};

Ranking.prototype.setRankingAmigos = function() {        
    $('#rankingContainer').before(RankingHelper.getRankingAmigos());
};

Ranking.prototype.top100 = function() {        
    $('#rankingContainer').before(RankingHelper.getRankingTop100());
};

Ranking.prototype.top100cuartosyoctavos = function() { 
    RankingHelper.isOctavos = true;
    $('#rankingContainer').before(RankingHelper.getRankingTop100Area());
};

Ranking.prototype.ajaxDeleteFriend = function(obj) {    
    var usuario_id = $(obj).attr('id');
    var id = usuario_id.replace('usuario_id_','');
    var rankingIndex = this;
    var usuario = new Usuario();
    
    $.get(usuario.getActionUrl('ajaxDeleteFriend'), {id:id}, function(response) {        
        rankingIndex.ajaxPrediccionResponse(response,obj);
    });
};

Ranking.prototype.ajaxPrediccionResponse = function(response,obj) {
    $(obj).parent().parent().fadeOut('slow');    
};