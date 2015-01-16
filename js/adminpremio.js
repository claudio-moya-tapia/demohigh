/**
 * 
 * @class AdminPremio
 * @extends Controller 
 */
function AdminPremio() {
    this.init();
    this.imagen = '#Premio_imagen';
    this.img = '#Premio_img';
}

AdminPremio.prototype = new Controller();
AdminPremio.prototype.constructor = AdminPremio;

AdminPremio.prototype.create = function() {
    this.form();
};

AdminPremio.prototype.update = function() {
    this.form();
};

AdminPremio.prototype.form = function() {
    
    $('#Premio_texto').jqte();
    	
	Documento.uploadify(
        '#DocumentoUpload',
        this.onUploadSuccess,
        220
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
AdminPremio.prototype.onUploadSuccess = function(DocumentoJson) {
    
    var adminPremioIndex = new AdminPremio();
    $(adminPremioIndex.imagen).val(DocumentoJson.url);
    $(adminPremioIndex.img).attr('src', Config.baseUrlImg + DocumentoJson.url);
};
