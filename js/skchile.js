/**
 * 
 * @class Skchile
 * @extends Controller
 */
function Skchile() {
    this.init();
}

Skchile.prototype = new Controller();
Skchile.prototype.constructor = Skchile;
Skchile.prototype.index = function() {
    Shared.login();
}