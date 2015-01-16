/**
 * 
 * @class Raya
 * @extends Controller
 */
function Raya() {
    this.init();
}

Raya.prototype = new Controller();
Raya.prototype.constructor = Raya;

Raya.prototype.index = function() {
    Shared.login();
};