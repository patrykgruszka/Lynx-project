(function($, window) {
    var Sidebar = function() {
        this.htmlId = 'app-sidebar';
    };

    Sidebar.prototype.init = function() {
        this.$sidebar = $('#' + this.htmlId);
    };

    Sidebar.prototype.activate = function(name) {
        var $li = this.$sidebar.find('li.' + name);
        $li.addClass('active').siblings().removeClass('active');
    };

    window.sidebar = new Sidebar();

    $(function() {
       sidebar.init();
    });
}(jQuery, window));