var AppHeaderComponent = {
    templateUrl: '/application/layout/components/appHeader.html',
    controller: function AppHeaderController() {},
    bindings: {
        title: '@',
        subtitle: '@'
    }
};

angular.module('taskboardModule').component('appHeader', AppHeaderComponent);
angular.module('projectModule').component('appHeader', AppHeaderComponent);
angular.module('sprintModule').component('appHeader', AppHeaderComponent);
angular.module('taskModule').component('appHeader', AppHeaderComponent);
angular.module('userpanelModule').component('appHeader', AppHeaderComponent);

