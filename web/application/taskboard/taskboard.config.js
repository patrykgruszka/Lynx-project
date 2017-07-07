angular.module('taskboardModule')
    .config(['$locationProvider', '$routeProvider',
        function config($locationProvider, $routeProvider) {
            $routeProvider.when('/', {
                template: '<taskboard></taskboard>'
            }).otherwise('/');
        }
    ]);