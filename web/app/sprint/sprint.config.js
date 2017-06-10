angular.module('sprintModule')
    .config(['$locationProvider', '$routeProvider',
        function config($locationProvider, $routeProvider) {
            $routeProvider.when('/list', {
                template: '<sprint-list></sprint-list>'
            }).when('/show/:sprintId', {
                template: 'Show sprint'
            }).when('/add', {
                template: '<add-sprint></add-sprint>'
            }).otherwise('/list');
        }
    ]);