/**
 * 
 * @class Versus
 * @extends Controller 
 * @property {Integer} versus_id 
 * @property {Pais} paisB
 * @property {Integer} golesA
 * @property {Integer} golesB 
 * @property {Pais} ganador
 */
function Versus() {
    this.init();
    this.versus_id = 0;
    this.fecha = new Date();
    this.paisA = new Pais();
    this.paisB = new Pais();
    this.prediccionA = -1;
    this.prediccionB = -1;
    this.tienePrediccion = false;
    this.ganador = new Pais();
    this.jugado = false;
    this.resultadoA = '';
    this.resultadoB = '';
    this.PTSganadorA = 0;
    this.PTSganadorB = 0;
    this.PTSempate = 0;
    this.PTSscoreA = 0;
    this.PTSscoreB = 0;
    this.PTS = 0;    
    this.puntosGanador = 0;
    this.puntosGolesGanador = 0;
    this.puntosGolesPerdedor = 0;
    this.puntosTotal = 0;
    this.canplay = 0;
}

Versus.prototype = new Controller();
Versus.prototype.constructor = Versus;

Versus.prototype.set = function(versus) {
    this.versus_id = versus.versus_id;
    this.fecha = versus.fecha;
    this.paisA = versus.paisA;
    this.paisB = versus.paisB;
    this.prediccionA = versus.prediccionA;
    this.prediccionB = versus.prediccionB;
    this.tienePrediccion = versus.tienePrediccion;
    this.ganador = versus.ganador;
    this.jugado = versus.jugado;
    this.resultadoA = versus.resultadoA;
    this.resultadoB = versus.resultadoB;
    this.PTSganadorA = versus.PTSganadorA;
    this.PTSganadorB = versus.PTSganadorB;
    this.PTSempate = versus.PTSempate;
    this.PTSscoreA = versus.PTSscoreA;
    this.PTSscoreB = versus.PTSscoreB;
    this.PTS = versus.PTS;
    this.puntosGanador = versus.puntosGanador;
    this.puntosGolesGanador = versus.puntosGolesGanador;
    this.puntosGolesPerdedor = versus.puntosGolesPerdedor;
    this.puntosTotal = versus.puntosTotal;
    this.canplay = 0;
};