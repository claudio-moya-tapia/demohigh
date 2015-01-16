/**
 * 
 * @class AdminUsuario
 * @extends Controller 
 */
function AdminUsuario() {
    this.init();   
    this.imagen = '#Usuario_imagen';
    this.img = '#Usuario_img';
    this.aryProject = new Array();
    this.nextProyect = false;
}

AdminUsuario.prototype = new Controller();
AdminUsuario.prototype.constructor = AdminUsuario;

AdminUsuario.prototype.totalPuntos = function() {
    var adminUsuario = this;
    
    var project = {};
    project.name = 'rayalab';
    project.db = 'mundialero_rayalab';

    adminUsuario.aryProject.push(project);

    var project = {};
    project.name = 'enaex';
    project.db = 'mundialero_enaex';

    adminUsuario.aryProject.push(project);

    var project = {};
    project.name = 'fch';
    project.db = 'mundialero_fch';

    adminUsuario.aryProject.push(project);

    var project = {};
    project.name = 'dcv';
    project.db = 'mundialero_dcv';

    adminUsuario.aryProject.push(project);

    var project = {};
    project.name = 'skberge';
    project.db = 'mundialero_skberge';

    adminUsuario.aryProject.push(project);

    var project = {};
    project.name = 'anden';
    project.db = 'mundialero_anden';

    adminUsuario.aryProject.push(project);

    var project = {};
    project.name = 'bbva';
    project.db = 'mundialero_bbva';

    adminUsuario.aryProject.push(project);

    var project = {};
    project.name = 'credicorp';
    project.db = 'mundialero_credicorp';

    adminUsuario.aryProject.push(project);

    var project = {};
    project.name = 'ripley';
    project.db = 'mundialero_ripley';

    adminUsuario.aryProject.push(project);

    var project = {};
    project.name = 'skchile';
    project.db = 'mundialero_skchile';

    adminUsuario.aryProject.push(project);

    var project = {};
    project.name = 'afphabitat';
    project.db = 'mundialero_afphabitat';

    adminUsuario.aryProject.push(project);

    var project = {};
    project.name = 'clc';
    project.db = 'mundialero_clc';

    adminUsuario.aryProject.push(project);

    var project = {};
    project.name = 'skc';
    project.db = 'mundialero_skc';

    adminUsuario.aryProject.push(project);

    var project = {};
    project.name = 'cmr';
    project.db = 'mundialero_cmr';

    adminUsuario.aryProject.push(project);

    var project = {};
    project.name = 'bancofalabella';
    project.db = 'mundialero_bancofalabella';

    adminUsuario.aryProject.push(project);

    var project = {};
    project.name = 'falabella';
    project.db = 'mundialero_falabella';

    adminUsuario.aryProject.push(project);

    var project = {};
    project.name = 'santander';
    project.db = 'mundialero_santander';

    adminUsuario.aryProject.push(project);

    var project = {};
    project.name = 'tironi';
    project.db = 'mundialero_tironi';

    adminUsuario.aryProject.push(project);

    var project = {};
    project.name = 'euroamerica';
    project.db = 'mundialero_euroamerica';

    adminUsuario.aryProject.push(project);

    var project = {};
    project.name = 'aesgener';
    project.db = 'mundialero_aesgener';

    adminUsuario.aryProject.push(project);

    var project = {};
    project.name = 'contract';
    project.db = 'mundialero_contract';

    adminUsuario.aryProject.push(project);

    var project = {};
    project.name = 'ucinf';
    project.db = 'mundialero_ucinf';

    adminUsuario.aryProject.push(project);

    var project = {};
    project.name = 'bancochile';
    project.db = 'mundialero_bancochile';

    adminUsuario.aryProject.push(project);

    var project = {};
    project.name = 'gruposiglo';
    project.db = 'mundialero_gruposiglo';

    adminUsuario.aryProject.push(project);

    var project = {};
    project.name = 'colbun';
    project.db = 'mundialero_colbun';

    adminUsuario.aryProject.push(project);

    var project = {};
    project.name = 'cchc';
    project.db = 'mundialero_cchc';

    adminUsuario.aryProject.push(project);

    var project = {};
    project.name = 'cristal';
    project.db = 'mundialero_cristal';

    adminUsuario.aryProject.push(project);

    var project = {};
    project.name = 'brotecicafal';
    project.db = 'mundialero_brotecicafal';

    adminUsuario.aryProject.push(project);

    var project = {};
    project.name = 'raya';
    project.db = 'mundialero_raya';

    adminUsuario.aryProject.push(project);

    var project = {};
    project.name = 'anam';
    project.db = 'mundialero_anam';

    adminUsuario.aryProject.push(project);

    var project = {};
    project.name = 'copec';
    project.db = 'mundialero_copec';

    adminUsuario.aryProject.push(project);

    var project = {};
    project.name = 'tmfgroup';
    project.db = 'mundialero_tmfgroup';

    adminUsuario.aryProject.push(project);
    
    adminUsuario.ajaxTotalPuntos();
};

AdminUsuario.prototype.ajaxTotalPuntos = function() {
    
    var status = '<tr><td>'+this.aryProject[0].name+'</td>';
    status += '<td id="status_'+this.aryProject[0].name+'">Actualizando...</td>';   
    status += '<td id="time_'+this.aryProject[0].name+'"></td>';   
    status += '<td id="url_'+this.aryProject[0].name+'"></td></tr>'; 
    
    $('#status').prepend(status);
    
    var adminUsuario = this;
    var project = this.aryProject[0].name;
    var base = this.aryProject[0].db;
        
    $.get(Config.baseUrl+'/adminUsuario/ajaxTotalPuntos',{project:project,base:base},function(response){        
        $('#url_'+project).html('<a href="'+this.url+'" target="_blank">'+this.url+'</a>');
        adminUsuario.checkProyect(response);
    });
};

AdminUsuario.prototype.buscarPuntos = function() {
    
    var adminUsuario = this;
   
};

AdminUsuario.prototype.checkProyect = function(response) {
    
    $('#status_'+this.aryProject[0].name).html(response.status);
    $('#time_'+this.aryProject[0].name).html(response.time);
    this.aryProject.shift();
    
    if(this.aryProject.length > 0){        
        this.ajaxTotalPuntos();
    }else{
        window.location.assign(Config.baseUrl+'/adminCache/versus');
    }    
};

AdminUsuario.prototype.create = function() {
    this.form();
};

AdminUsuario.prototype.update = function() {
    this.form();
};

AdminUsuario.prototype.form = function() {
    
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
AdminUsuario.prototype.onUploadSuccess = function(DocumentoJson) {

    var adminUsuario = new AdminUsuario();

    $(adminUsuario.imagen).val(DocumentoJson.url);
    $(adminUsuario.img).attr('src', Config.baseUrlImg + DocumentoJson.url);
};
