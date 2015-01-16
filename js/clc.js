/**
 * 
 * @class Clc
 * @extends Controller
 */
function Clc() {
    this.init();
}

Clc.prototype = new Controller();
Clc.prototype.constructor = Clc;

Clc.prototype.index = function() {
    Shared.login();
};