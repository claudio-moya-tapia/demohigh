/**
 * 
 * @class Masisa
 * @extends Controller
 */
function Masisa() {
    this.init();
}

Masisa.prototype = new Controller();
Masisa.prototype.constructor = Masisa;

Masisa.prototype.index = function() {
    Shared.login();
}