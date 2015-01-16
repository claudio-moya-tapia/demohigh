/**
 * 
 * @class Anden
 * @extends Controller
 */
function Anden() {
    this.init();
}

Anden.prototype = new Controller();
Anden.prototype.constructor = Anden;

Anden.prototype.index = function() {
    Shared.login();
};
