/**
 * 
 * @class AdminCache
 * @extends Controller 
 */
function AdminCache() {
    this.init();   
    this.aryProject = new Array();
    this.nextProyect = false;
}

AdminCache.prototype = new Controller();
AdminCache.prototype.constructor = AdminCache;

AdminCache.prototype.ranking = function() {
    this.setProjects();
    var adminCache = this;
    adminCache.ajaxRanking();
};

AdminCache.prototype.noticias = function() {
    this.setProjects();
    var adminCache = this;
    adminCache.ajaxNoticias();
};

AdminCache.prototype.setProjects = function() {
    var adminCache = this;
    
    var project = {};
    project.name = 'rayalab';
    project.db = 'mundialero_rayalab';

    adminCache.aryProject.push(project);

    var project = {};
    project.name = 'enaex';
    project.db = 'mundialero_enaex';

    adminCache.aryProject.push(project);

    var project = {};
    project.name = 'fch';
    project.db = 'mundialero_fch';

    adminCache.aryProject.push(project);

    var project = {};
    project.name = 'dcv';
    project.db = 'mundialero_dcv';

    adminCache.aryProject.push(project);

    var project = {};
    project.name = 'skberge';
    project.db = 'mundialero_skberge';

    adminCache.aryProject.push(project);

    var project = {};
    project.name = 'anden';
    project.db = 'mundialero_anden';

    adminCache.aryProject.push(project);

    var project = {};
    project.name = 'bbva';
    project.db = 'mundialero_bbva';

    adminCache.aryProject.push(project);

    var project = {};
    project.name = 'credicorp';
    project.db = 'mundialero_credicorp';

    adminCache.aryProject.push(project);

    var project = {};
    project.name = 'ripley';
    project.db = 'mundialero_ripley';

    adminCache.aryProject.push(project);

    var project = {};
    project.name = 'skchile';
    project.db = 'mundialero_skchile';

    adminCache.aryProject.push(project);

    var project = {};
    project.name = 'afphabitat';
    project.db = 'mundialero_afphabitat';

    adminCache.aryProject.push(project);

    var project = {};
    project.name = 'clc';
    project.db = 'mundialero_clc';

    adminCache.aryProject.push(project);

    var project = {};
    project.name = 'skc';
    project.db = 'mundialero_skc';

    adminCache.aryProject.push(project);

    var project = {};
    project.name = 'cmr';
    project.db = 'mundialero_cmr';

    adminCache.aryProject.push(project);

    var project = {};
    project.name = 'bancofalabella';
    project.db = 'mundialero_bancofalabella';

    adminCache.aryProject.push(project);

    var project = {};
    project.name = 'falabella';
    project.db = 'mundialero_falabella';

    adminCache.aryProject.push(project);

    var project = {};
    project.name = 'santander';
    project.db = 'mundialero_santander';

    adminCache.aryProject.push(project);

    var project = {};
    project.name = 'tironi';
    project.db = 'mundialero_tironi';

    adminCache.aryProject.push(project);

    var project = {};
    project.name = 'euroamerica';
    project.db = 'mundialero_euroamerica';

    adminCache.aryProject.push(project);

    var project = {};
    project.name = 'aesgener';
    project.db = 'mundialero_aesgener';

    adminCache.aryProject.push(project);

    var project = {};
    project.name = 'contract';
    project.db = 'mundialero_contract';

    adminCache.aryProject.push(project);

    var project = {};
    project.name = 'ucinf';
    project.db = 'mundialero_ucinf';

    adminCache.aryProject.push(project);

    var project = {};
    project.name = 'bancochile';
    project.db = 'mundialero_bancochile';

    adminCache.aryProject.push(project);

    var project = {};
    project.name = 'gruposiglo';
    project.db = 'mundialero_gruposiglo';

    adminCache.aryProject.push(project);

    var project = {};
    project.name = 'colbun';
    project.db = 'mundialero_colbun';

    adminCache.aryProject.push(project);

    var project = {};
    project.name = 'cchc';
    project.db = 'mundialero_cchc';

    adminCache.aryProject.push(project);

    var project = {};
    project.name = 'cristal';
    project.db = 'mundialero_cristal';

    adminCache.aryProject.push(project);

    var project = {};
    project.name = 'brotecicafal';
    project.db = 'mundialero_brotecicafal';

    adminCache.aryProject.push(project);

    var project = {};
    project.name = 'raya';
    project.db = 'mundialero_raya';

    adminCache.aryProject.push(project);

    var project = {};
    project.name = 'anam';
    project.db = 'mundialero_anam';

    adminCache.aryProject.push(project);

    var project = {};
    project.name = 'copec';
    project.db = 'mundialero_copec';

    adminCache.aryProject.push(project);

    var project = {};
    project.name = 'tmfgroup';
    project.db = 'mundialero_tmfgroup';

    adminCache.aryProject.push(project);
    
};

AdminCache.prototype.ajaxRanking = function() {
    
    var status = '<tr><td>'+this.aryProject[0].name+'</td>';
    status += '<td id="status_'+this.aryProject[0].name+'">Actualizando...</td>';   
    status += '<td id="time_'+this.aryProject[0].name+'"></td>';   
    status += '<td id="url_'+this.aryProject[0].name+'"></td></tr>'; 
    
    $('#status').prepend(status);
    
    var adminCache = this;
    var project = this.aryProject[0].name;
    var base = this.aryProject[0].db;
        
    $.get(Config.baseUrl+'/adminCache/ajaxRanking',{project:project,base:base},function(response){        
        $('#url_'+project).html('<a href="'+this.url+'" target="_blank">'+this.url+'</a>');
        adminCache.checkProyect(response);
    });
};

AdminCache.prototype.checkProyect = function(response) {
    
    $('#status_'+this.aryProject[0].name).html(response.status);
    $('#time_'+this.aryProject[0].name).html(response.time);
    this.aryProject.shift();
    
    if(this.aryProject.length > 0){        
        this.ajaxRanking();
    }else{
        window.location.assign(Config.baseUrl+'/adminVersus/admin');
    }    
};


AdminCache.prototype.ajaxNoticias = function() {
    
    var status = '<tr><td>'+this.aryProject[0].name+'</td>';
    status += '<td id="status_'+this.aryProject[0].name+'">Actualizando...</td>';   
    status += '<td id="time_'+this.aryProject[0].name+'"></td>';   
    status += '<td id="url_'+this.aryProject[0].name+'"></td></tr>'; 
    
    $('#status').prepend(status);
    
    var adminCache = this;
    var project = this.aryProject[0].name;
    var base = this.aryProject[0].db;
        
    $.get(Config.baseUrl+'/adminCache/ajaxNoticias',{project:project,base:base},function(response){        
        $('#url_'+project).html('<a href="'+this.url+'" target="_blank">'+this.url+'</a>');
        adminCache.checkProyectNoticias(response);
    });
};

AdminCache.prototype.checkProyectNoticias = function(response) {
    
    $('#status_'+this.aryProject[0].name).html(response.status);
    $('#time_'+this.aryProject[0].name).html(response.time);
    this.aryProject.shift();
    
    if(this.aryProject.length > 0){        
        this.ajaxNoticias();
    }    
};