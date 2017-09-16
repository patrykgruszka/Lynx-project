angular.module('sprintModule')
    .config(['$locationProvider', '$routeProvider',
        function config($locationProvider, $routeProvider) {
            $routeProvider.when('/list', {
                template: '<app-header title="Sprint" subtitle="List"></app-header><sprint-list></sprint-list>'
            }).when('/show/:sprintId', {
                template: 'Show sprint'
            }).when('/add', {
                template: '<app-header title="Sprint" subtitle="Add"></app-header><add-sprint></add-sprint>'
            }).otherwise('/list');
        }
    ]);