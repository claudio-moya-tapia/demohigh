/**
 * 
 * @class AdminGaleria
 * @extends Controller 
 */
function AdminGaleria() {
    this.init();
    this.imagen = '#Galeria_imagen';
    this.img = '#Galeria_img';
}

AdminGaleria.prototype = new Controller();
AdminGaleria.prototype.constructor = AdminGaleria;

AdminGaleria.prototype.create = function() {
    this.form();
   
};

AdminGaleria.prototype.update = function() {
    this.form();
};

AdminGaleria.prototype.form = function() {
    Documento.uploadify(
        '#DocumentoUpload',
        this.onUploadSuccess,
        500
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
AdminGaleria.prototype.onUploadSuccess = function(DocumentoJson) {
    
    var adminGaleria = new AdminGaleria();
    $(adminGaleria.imagen).val(DocumentoJson.url);
    $(adminGaleria.img).attr('src', Config.baseUrlImg + DocumentoJson.url);
};
