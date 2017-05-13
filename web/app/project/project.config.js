angular.module('projectModule')
    .config(['$locationProvider', '$routeProvider',
        function config($locationProvider, $routeProvider) {
            $routeProvider.when('/list', {
                template: '<project-list></project-list>'
            }).when('/show/:projectId', {
                template: 'Show project'
            }).when('/add', {
                template: '<add-project></add-project>'
            }).otherwise('/list');
        }
    ]);