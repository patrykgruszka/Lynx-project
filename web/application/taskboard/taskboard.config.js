angular.module('taskboardModule')
    .config(['$locationProvider', '$routeProvider',
        function config($locationProvider, $routeProvider) {
            $routeProvider.when('/', {
                template: '<app-header title="Taskboard"></app-header><taskboard></taskboard>'
            }).otherwise('/');
        }
    ]);