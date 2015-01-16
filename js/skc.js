/**
 * 
 * @class Skc
 * @extends Controller
 */
function Skc() {
    this.init();
}

Skc.prototype = new Controller();
Skc.prototype.constructor = Skc;

Skc.prototype.index = function() {
    Shared.login();
}