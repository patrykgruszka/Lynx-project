angular.module('taskModule').component('addTask', {
    templateUrl: '/app/task/components/addTask.html',
    controller: function AddTaskController($scope, $http, $location) {
        var self = this;

        self.formData = {
            'name': '',
            'description': ''
        };

        self.selectProject = function() {
            self.formData.project = self.project.name;
        };
        self.selectPriority = function() {
            self.formData.priority = self.priority.name;
        };
        self.selectSprint = function() {
            self.formData.sprint = self.sprint.name;
        };
        self.selectStatus = function() {
            self.formData.status = self.status.name;
        };

        $http.get('/project/getList').then(function(response) {
            self.projectList = response.data;
        });
        $http.get('/priority/getList').then(function(response) {
            self.priorityList = response.data;
        });
        $http.get('/sprint/getList').then(function(response) {
            self.sprintList = response.data;
        });
        $http.get('/status/getList').then(function(response) {
            self.statusList = response.data;
        });

        self.submitForm = function() {
            $http.post('/task/save', JSON.stringify(self.formData)).then(function(response){});
        };
    }
});