/**
 * 
 * @class Ripley
 * @extends Controller
 */
function Ripley() {
    this.init();
}

Ripley.prototype = new Controller();
Ripley.prototype.constructor = Ripley;

Ripley.prototype.index = function() {
    Shared.login();
}