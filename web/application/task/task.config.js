angular.module('taskModule')
    .config(['$locationProvider', '$routeProvider',
        function config($locationProvider, $routeProvider) {
            $routeProvider.when('/list', {
                template: '<app-header title="Task" subtitle="List"></app-header><task-list></task-list>'
            }).when('/show/:taskId', {
                template: 'Show task'
            }).when('/add', {
                template: '<app-header title="Task" subtitle="Add"></app-header><add-task></add-task>'
            }).otherwise('/list');
        }
    ]);