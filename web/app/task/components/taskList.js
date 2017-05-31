angular.module('taskModule').component('taskList', {
    templateUrl: '/app/task/components/taskList.html',
    controller: function ProjectListController($http) {
        var self = this;
        self.project = false;
        self.projectsList = [];
        self.tasksList = [];

        $http.get('/project/getList').then(function(response) {
            self.projectsList = response.data;
        });

        self.selectProject = function(projectId) {
            // todo get task list
        };
    }
});