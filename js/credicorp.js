/**
 * 
 * @class Credicorp
 * @extends Controller
 */
function Credicorp() {
    this.init();
}

Credicorp.prototype = new Controller();
Credicorp.prototype.constructor = Credicorp;


Credicorp.prototype.index = function() {
    Shared.login();
};