var KanbanGroupController = function($http) {
    this.$onInit = function () {
        var self = this;
        self.tasks = [];

        $http.get('/task/getTasks/' + self.status.short_name).then(function(response) {
            self.tasks = response.data;

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
};

angular.module('taskboardModule', ['ngRoute', 'as.sortable']).component('kanbanGroup', {
    templateUrl: '/application/taskboard/components/kanbanGroup.html',
    controller: KanbanGroupController,
    bindings: {
        tasks: '<',
        status: '<'
    }
});