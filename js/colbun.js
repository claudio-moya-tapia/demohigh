/**
 * 
 * @class Colbun
 * @extends Controller
 */
function Colbun() {
    this.init();
}

Colbun.prototype = new Controller();
Colbun.prototype.constructor = Colbun;

Colbun.prototype.index = function() {
    Shared.login();
};