var AppHeaderComponent = {
    templateUrl: '/application/layout/components/appHeader.html',
    controller: function AppHeaderController() {},
    bindings: {
        title: '@',
        subtitle: '@'
    }
};

angular.module('lynxModule').component('appHeader', AppHeaderComponent);
