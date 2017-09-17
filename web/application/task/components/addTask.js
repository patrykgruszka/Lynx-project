var AddTaskController = function AddTaskController($scope, $http, $q, $location, $window) {
    var self = this;
    self.isNew = true;

    self.formData = {
        'name': '',
        'description': '',
        'assignee': ''
    };

    self.loading = true;

    var projectRequest = $http.get('/project/getList').then(function(response) {
        self.projectList = response.data;
        self.formData.project = self.projectList[0].id;

    });

    var priorityRequest = $http.get('/priority/getList').then(function(response) {
        self.priorityList = response.data;
        self.formData.priority = self.priorityList[0].id;
    });

    var sprintRequest = $http.get('/sprint/getList').then(function(response) {
        self.sprintList = response.data;
    });

    var statusRequest = $http.get('/status/getList').then(function(response) {
        self.statusList = response.data;
        self.formData.status = self.statusList[0].id;
    });

    var usersRequest = $http.get('/userpanel/getUsers').then(function(response) {
        self.userList = response.data;
    });

    var profileRequest = $http.get('/userpanel/getProfile').then(function(response) {
        self.profile = response.data;
        self.formData.reporter = self.profile.id;
    });

    $q.all([projectRequest, priorityRequest, sprintRequest, statusRequest, usersRequest, profileRequest]).finally(function() {
        self.loading = false;
    });

    self.submitForm = function() {
        $http.post('/task/save', JSON.stringify(self.formData)).then(function(response){
            $window.alertify.success(response.data.msg);
            $location.path('/task');
        });
    };
};

angular.module('lynxModule').component('addTask', {
    templateUrl: '/application/task/components/editTask.html',
    controller: AddTaskController
});