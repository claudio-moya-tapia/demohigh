/**
 * 
 * @class Ucinf
 * @extends Controller
 */
function Ucinf() {
    this.init();
}

Ucinf.prototype = new Controller();
Ucinf.prototype.constructor = Ucinf;


Ucinf.prototype.index = function() {
    Shared.login();
};