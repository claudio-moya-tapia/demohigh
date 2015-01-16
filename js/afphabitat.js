/**
 * 
 * @class Afphabitat
 * @extends Controller
 */
function Afphabitat() {
    this.init();
}

Afphabitat.prototype = new Controller();
Afphabitat.prototype.constructor = Afphabitat;

Afphabitat.prototype.index = function() {
    Shared.login();
};