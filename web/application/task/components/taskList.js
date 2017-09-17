angular.module('taskModule').component('taskList', {
    templateUrl: '/application/task/components/taskList.html',
    controller: function TaskListController($http, $window) {
        var self = this;
        self.tasksList = [];
        self.loading = true;

        $http.get('/task/getList').then(function(response) {
            self.tasksList = response.data;
        }).finally(function() {
            self.loading = false;
        });

        self.removeTask = function(task) {
            $http.post('/task/remove', JSON.stringify(task)).then(function(response) {
                var index = self.tasksList.indexOf(task);
                self.tasksList.splice(index, 1);
                $window.alertify.success(response.data.msg);
                return false;
            });
        };
    }
});