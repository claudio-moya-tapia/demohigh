/**
 * 
 * @class Calendario
 * @extends Controller
 */
function Calendario() {
    this.init();
}

Calendario.prototype = new Controller();
Calendario.prototype.constructor = Calendario;

Calendario.prototype.index = function(){
    Shared.analytics(this);
};