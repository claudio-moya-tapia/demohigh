/**
 * 
 * @class Anam
 * @extends Controller
 */
function Anam() {
    this.init();
}

Anam.prototype = new Controller();
Anam.prototype.constructor = Anam;

Anam.prototype.index = function() {
    Shared.login();
};