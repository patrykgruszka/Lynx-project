angular.module('lynxModule')
    .config(['$locationProvider', '$routeProvider',

        function config($locationProvider, $routeProvider) {
            $routeProvider

                .when('/project', {
                    template: '<app-header title="Project" subtitle="List"></app-header><project-list></project-list>'
                })
                .when('/project/add', {
                    template: '<app-header title="Project" subtitle="Add"></app-header><add-project></add-project>'
                })

                .when('/sprint', {
                    template: '<app-header title="Sprint" subtitle="List"></app-header><sprint-list></sprint-list>'
                })
                .when('/sprint/add', {
                    template: '<app-header title="Sprint" subtitle="Add"></app-header><add-sprint></add-sprint>'
                })

                .when('/task', {
                    template: '<app-header title="Task" subtitle="List"></app-header><task-list></task-list>'
                })
                .when('/task/add', {
                    template: '<app-header title="Task" subtitle="Add"></app-header><add-task></add-task>'
                })
                .when('/task/:taskId/edit', {
                    template: function (params) {
                        return '<app-header title="Task" subtitle="Edit"></app-header><edit-task task-id="' + params.taskId + '"></edit-task>';
                    }
                })

                .when('/taskboard', {
                    template: '<choose-sprint></choose-sprint>'
                })
                .when('/taskboard/project/:projectId/sprint/:sprintId', {
                    template: function (params) {
                        return '<taskboard project-id="' + params.projectId + '" sprint-id="' + params.sprintId + '"></taskboard>';
                    }
                })

                .when('/userpanel', {
                    template: '<app-header title="User panel" subtitle="Team"></app-header><user-list></user-list>'
                })
                .when('/userpanel/profile', {
                    template: '<app-header title="User panel" subtitle="Profile"></app-header><profile></profile>'
                })
                .when('/userpanel/add-user', {
                    template: '<app-header title="User panel" subtitle="Add user"></app-header><add-user></add-user>'
                })

                .otherwise('/taskboard');
        }

    ]);