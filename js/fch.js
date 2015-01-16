/**
 * 
 * @class Fch
 * @extends Controller
 */
function Fch() {
    this.init();
}

Fch.prototype = new Controller();
Fch.prototype.constructor = Fch;
Fch.prototype.index = function() {
    Shared.login();
}