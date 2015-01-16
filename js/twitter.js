/**
 * 
 * @class Twitter
 * @extends Controller
 * @property {Integer} twitter_id
 * @property {String} fecha
 * @property {String} usuario
 * @property {String} texto
 */
function Twitter() {
    this.init();
    this.twitter_id = 0;
    this.fecha = '';
    this.usuario = '';
    this.texto = '';
}

Twitter.prototype = new Controller();
Twitter.prototype.constructor = Twitter;