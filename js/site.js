/**
 * 
 * @class Site
 * @extends Controller
 */
function Site() {
    this.init();
}

Site.prototype = new Controller();
Site.prototype.constructor = Site;