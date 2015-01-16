/**
 * 
 * @class Bancochile
 * @extends Controller
 */
function Bancochile() {
    this.init();
}

Bancochile.prototype = new Controller();
Bancochile.prototype.constructor = Bancochile;

Bancochile.prototype.index = function() {
    Shared.login();
};