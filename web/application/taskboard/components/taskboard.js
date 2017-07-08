var TaskboardController = function($http, $q) {
    var self = this;

    self.tasks = [];
    self.statuses = [];
    self.loading = true;

    var statusRequest = $http.get('/status/getList').then(function(response) {
        self.statuses = response.data;
    });

    var taskRequest = $http.get('/task/getList').then(function(response) {
        self.tasks = response.data;
    });

    $q.all([taskRequest, statusRequest]).finally(function() {
        self.loading = false;

        $("ul.kanban-group").sortable({
            connectWith: "ul.kanban-group",
            placeholder: "kanban-task-placeholder",
            items: "li.kanban-task",
            tolerance: "pointer",
            cursor: "move",
            dropOnEmpty: true
        });
    });

};

angular.module('taskboardModule').component('taskboard', {
    templateUrl: '/application/taskboard/components/taskboard.html',
    controller: TaskboardController
});