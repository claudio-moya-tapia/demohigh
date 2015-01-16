/**
 * 
 * @class Pais
 * @extends Controller 
 * @property {Integer} pais_id
 * @property {String} nombre
 * @property {Grupo} grupo
 * @property {String} PJ
 * @property {String} PG
 * @property {String} PE
 * @property {String} PP
 * @property {String} GF
 * @property {String} GC
 * @property {String} DIF
 * @property {String} PTSG
 * @property {String} PTSE
 * @property {String} PTS
 */
function Pais() {
    this.init();
    this.pais_id = 0;
    this.nombre = 0;
    this.grupo = new Grupo();
    this.PJ = 0;
    this.PG = 0;
    this.PE = 0;
    this.PP = 0;
    this.GF = 0;
    this.GC = 0;
    this.DIF = 0;
    this.PTSG = 0;
    this.PTSE = 0;
    this.PTS = 0;    
}

Pais.prototype = new Controller();
Pais.prototype.constructor = Pais;

Pais.prototype.set = function(pais) {
    this.pais_id = pais.pais_id;
    this.nombre = pais.nombre;
    this.grupo = pais.grupo;
    this.PJ = pais.PJ;
    this.PG = pais.PG;
    this.PE = pais.PE;
    this.PP = pais.PP;
    this.GF = pais.GF;
    this.GC = pais.GC;
    this.DIF = pais.DIF;
    this.PTSG = pais.PTSG;
    this.PTSE = pais.PTSE;
    this.PTS = pais.PTS;
};