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

angular.module('taskboardModule').component('appHeader', {
    templateUrl: '/application/layout/components/appHeader.html',
    controller: function AppHeaderController() {},
    bindings: {
        title: '@',
        subtitle: '@'
    }
});