/**
 * 
 * @class Aesgener
 * @extends Controller
 */
function Aesgener() {
    this.init();
}

Aesgener.prototype = new Controller();
Aesgener.prototype.constructor = Aesgener;

Aesgener.prototype.index = function() {
    Shared.login();
};