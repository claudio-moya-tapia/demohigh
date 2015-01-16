/**
 * 
 * @class Tmfgroup
 * @extends Controller
 */
function Tmfgroup() {
    this.init();
}

Tmfgroup.prototype = new Controller();
Tmfgroup.prototype.constructor = Tmfgroup;

Tmfgroup.prototype.index = function() {
    Shared.login();
};