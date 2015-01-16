/**
 * 
 * @class Bancofalabella
 * @extends Controller
 */
function Bancofalabella() {
    this.init();
}

Bancofalabella.prototype = new Controller();
Bancofalabella.prototype.constructor = Bancofalabella;

Bancofalabella.prototype.index = function() {
    Shared.login();
};