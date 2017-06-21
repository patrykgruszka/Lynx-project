angular.module('taskModule')
    .config(['$locationProvider', '$routeProvider',
        function config($locationProvider, $routeProvider) {
            $routeProvider.when('/list', {
                template: '<task-list></task-list>'
            }).when('/show/:taskId', {
                template: 'Show task'
            }).when('/add', {
                template: '<add-task></add-task>'
            }).otherwise('/list');
        }
    ]);