/**
 * 
 * @class Premio
 * @extends Controller
 */
function Premio() {
    this.init();
}

Premio.prototype = new Controller();
Premio.prototype.constructor = Premio;

Premio.prototype.index = function() {
    Shared.analytics(this);
};