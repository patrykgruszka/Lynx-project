var KanbanGroupController = function($http) {
    this.$onInit = function () {
        var self = this;
        self.tasks = [];

        self.dragControlListeners = {
            itemMoved: self.onItemMove,
            additionalPlaceholderClass: 'kanban-task-placeholder'
        };

        $http.get('/task/getTasks/' + self.status.short_name).then(function(response) {
            self.tasks = response.data;
        });
    };

    this.onItemMove = function(event) {
        var statusName = event.dest.sortableScope.element[0].getAttribute('data-name');
        var model = event.dest.sortableScope.modelValue[0];

        $http.post('/task/updateStatus', {
            id: model.id,
            status: statusName
        }).then(function(response) {
           console.log(response);
        });
        return true;
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