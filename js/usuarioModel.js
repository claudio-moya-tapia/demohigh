/**
 * 
 * @function UsuarioModel
 * @property {Integer} usuario_id
 * @property {String} nombre
 * @property {String} apellido_paterno
 * @property {Integer} total_puntos
 * @property {Integer} total_plenos
 * @property {String} imagen
 * @property {Integer} usuario_pais_id
 * @property {Integer} empresa_id
 * @property {Integer} area_id
 * @property {Integer} amigos_usuario_id
 * @property {Integer} posicion
 */
function UsuarioModel() {
    this.usuario_id = 0;
    this.nombre = '';
    this.apellido_paterno = '';
    this.total_puntos = 0;
    this.total_plenos = 0;
    this.imagen = '';
    this.usuario_pais_id = 0;
    this.empresa_id = 0;
    this.area_id = 0;
    this.amigos_usuario_id = 0;
    this.posicion = 0;
}

UsuarioModel.prototype = new UsuarioModel();
UsuarioModel.prototype.constructor = UsuarioModel;

UsuarioModel.prototype.set = function(usuarioJson) {
    this.usuario_id = usuarioJson.ui;
    this.nombre = usuarioJson.nm;
    this.apellido_paterno = usuarioJson.ap;
    this.total_puntos = usuarioJson.tp;
    this.total_plenos = usuarioJson.pl;
    this.imagen = usuarioJson.im;
    this.usuario_pais_id = usuarioJson.pi;
    this.empresa_id = usuarioJson.ei;
    this.area_id = usuarioJson.ai;
    this.amigos_usuario_id = usuarioJson.fi;
    this.posicion = 0;
};