/**
 * 
 * @class Falabella
 * @extends Controller
 */
function Falabella() {
    this.init();
}

Falabella.prototype = new Controller();
Falabella.prototype.constructor = Falabella;


Falabella.prototype.index = function() {
    Shared.login();
};