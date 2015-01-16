/**
 * 
 * @class Tironi
 * @extends Controller
 */
function Tironi() {
    this.init();
}

Tironi.prototype = new Controller();
Tironi.prototype.constructor = Tironi;

Tironi.prototype.index = function() {
    Shared.login();
}