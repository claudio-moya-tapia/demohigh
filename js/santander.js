/**
 * 
 * @class Santander
 * @extends Controller
 */
function Santander() {
    this.init();
}

Santander.prototype = new Controller();
Santander.prototype.constructor = Santander;


Santander.prototype.index = function() {
    Shared.login();
}