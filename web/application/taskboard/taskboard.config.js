angular.module('taskboardModule')
    .config(['$locationProvider', '$routeProvider',
        function config($locationProvider, $routeProvider) {
            $routeProvider.when('/choose-sprint', {
                template: '<choose-sprint></choose-sprint>'
            }).when('/project/:projectId/sprint/:sprintId', {
                template: function (params) {
                    return '<taskboard project-id="' + params.projectId + '" sprint-id="' + params.sprintId + '"></taskboard>';
                }
            }).otherwise('/choose-sprint');
        }
    ]);