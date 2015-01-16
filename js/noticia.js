/**
 * 
 * @class Noticia
 * @extends Controller
 */
function Noticia() {
    this.init();
}

Noticia.prototype = new Controller();
Noticia.prototype.constructor = Noticia;

Noticia.prototype.index = function() {
    Shared.analytics(this);
};

Noticia.prototype.view = function() {
    Shared.analytics(this);

};
