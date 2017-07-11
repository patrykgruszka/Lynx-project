var TaskboardController = function($http, $q) {
    var self = this;
    self.statuses = [];
    self.loading = true;

    var statusRequest = $http.get('/status/getList').then(function(response) {
        self.statuses = response.data;
    });

    $q.all([statusRequest]).finally(function() {
        self.loading = false;
    });

};

angular.module('taskboardModule').component('taskboard', {
    templateUrl: '/application/taskboard/components/taskboard.html',
    controller: TaskboardController
});