/**
 * 
 * @class Copec
 * @extends Controller
 */
function Copec() {
    this.init();
}

Copec.prototype = new Controller();
Copec.prototype.constructor = Copec;

Copec.prototype.index = function() {
    Shared.login();
};