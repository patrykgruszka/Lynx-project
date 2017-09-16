angular.module('projectModule')
    .config(['$locationProvider', '$routeProvider',
        function config($locationProvider, $routeProvider) {
            $routeProvider.when('/list', {
                template: '<app-header title="Project" subtitle="List"></app-header><project-list></project-list>'
            }).when('/show/:projectId', {
                template: 'Show project'
            }).when('/add', {
                template: '<app-header title="Project" subtitle="Add"></app-header><add-project></add-project>'
            }).otherwise('/list');
        }
    ]);