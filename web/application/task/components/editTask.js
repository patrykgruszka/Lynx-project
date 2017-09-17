var EditTaskController = function AddTaskController($scope, $http, $q, $location, $window) {
    var self = this;
    self.loading = true;
    self.isNew = false;

    self.$onInit = function() {
        var projectList,
            priorityList,
            sprintList,
            statusList,
            userList,
            task;

        var projectRequest = $http.get('/project/getList').then(function(response) {
            projectList = response.data;
        });

        var priorityRequest = $http.get('/priority/getList').then(function(response) {
            priorityList = response.data;
        });

        var sprintRequest = $http.get('/sprint/getList').then(function(response) {
            sprintList = response.data;
        });

        var statusRequest = $http.get('/status/getList').then(function(response) {
            statusList = response.data;
        });

        var usersRequest = $http.get('/userpanel/getUsers').then(function(response) {
            userList = response.data;
        });

        var taskRequest = $http.get('/task/getTask/' + self.taskId).then(function(response) {
            task = response.data;
        });

        $q.all([projectRequest, priorityRequest, sprintRequest, statusRequest, usersRequest, taskRequest]).finally(function() {
            self.projectList = projectList;
            self.priorityList = priorityList;
            self.sprintList = sprintList;
            self.statusList = statusList;
            self.userList = userList;
            self.task = task;
            self.formData = {
                id: task.id,
                name: task.name,
                description: task.description,
                project: task.project.id,
                status: task.status.id,
                priority: task.priority.id,
                reporter: task.reporter.id
            };

            if (task.assignee) {
                self.formData.assignee = task.assignee.id;
            }

            if (task.sprint) {
                self.formData.sprint = task.sprint.id;
            }
            self.loading = false;
        });
    };

    self.submitForm = function() {
        $http.post('/task/update', JSON.stringify(self.formData)).then(function(response){
            $window.alertify.success(response.data.msg);
            $location.path('/task');
        });
    };
};

angular.module('lynxModule').component('editTask', {
    templateUrl: '/application/task/components/editTask.html',
    controller: EditTaskController,
    bindings: {
        taskId: '@'
    }
});