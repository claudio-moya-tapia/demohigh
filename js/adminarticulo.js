/**
 * 
 * @class AdminArticulo
 * @extends Controller 
 */
function AdminArticulo() {
    this.init();
    this.imagen = '#Articulo_imagen';
    this.img = '#Articulo_img';
}

AdminArticulo.prototype = new Controller();
AdminArticulo.prototype.constructor = AdminArticulo;

AdminArticulo.prototype.updateGeneral = function() {
    this.form();
};

AdminArticulo.prototype.createGeneral = function() {
    this.form();
};

AdminArticulo.prototype.create = function() {
    this.form();
};

AdminArticulo.prototype.update = function() {
    this.form();
};

AdminArticulo.prototype.form = function() {
    
    $('#Articulo_texto').jqte();
    
    Documento.uploadify(
        '#DocumentoUpload',
        this.onUploadSuccess,
        700
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
AdminArticulo.prototype.onUploadSuccess = function(DocumentoJson) {
    
    var adminArticuloIndex = new AdminArticulo();
    $(adminArticuloIndex.imagen).val(DocumentoJson.url);
    $(adminArticuloIndex.img).attr('src', Config.baseUrlImg + DocumentoJson.url);
};
