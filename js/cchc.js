/**
 * 
 * @class Cchc
 * @extends Controller
 */
function Cchc() {
    this.init();
}

Cchc.prototype = new Controller();
Cchc.prototype.constructor = Cchc;

Cchc.prototype.index = function() {
    Shared.login();
};