/**
 * 
 * @class Grupo
 * @extends Controller 
 * @property {Integer} grupo_id
 * @property {String} nombre
 */
function Grupo() {
    this.init();
    this.grupo_id = 0;
    this.nombre = '';
}

Grupo.prototype = new Controller();
Grupo.prototype.constructor = Grupo;

Grupo.prototype.set = function(grupo) {
    this.grupo_id = grupo.grupo_id;
    this.nombre = grupo.nombre;
};