angular.module('taskboardModule').component('taskboard', {
    templateUrl: '/application/taskboard/components/taskboard.html',
    controller: function TaskboardController($http, $q) {
        var self = this;
        self.statuses = [];
        self.loading = true;

        self.$onInit = function() {
            var statusRequest = $http.get('/status/getList').then(function(response) {
                self.statuses = response.data;
            });

            var projectRequest = $http.get('/project/getProject/' + self.projectId).then(function(response) {
                self.project = response.data;
            });

            var sprintRequest = $http.get('/sprint/getSprint/' + self.sprintId).then(function(response) {
                self.sprint = response.data;
            });

            $q.all([statusRequest, projectRequest, sprintRequest]).finally(function() {
                self.loading = false;
            });
        };
    },
    bindings: {
        projectId: '@',
        sprintId: '@'
    }
});
