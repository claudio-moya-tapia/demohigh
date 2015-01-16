/**
 * 
 * @class Cmr
 * @extends Controller
 */
function Cmr() {
    this.init();
}

Cmr.prototype = new Controller();
Cmr.prototype.constructor = Cmr;

Cmr.prototype.index = function() {
    Shared.login();
};