/**
 * 
 * @class Prediccion
 * @extends Controller
 * @property {Integer} prediccion_id
 * @property {Integer} versus_id
 * @property {Integer} goles_a
 * @property {Integer} goles_b
 * @property {Integer} ganador
 */
function Prediccion() {
    this.init();
    this.prediccion_id = 0;
    this.versus_id = 0;
    this.goles_a = 0;
    this.goles_b = 0;
    this.ganador = 0;
}

Prediccion.prototype = new Controller();
Prediccion.prototype.constructor = Prediccion;