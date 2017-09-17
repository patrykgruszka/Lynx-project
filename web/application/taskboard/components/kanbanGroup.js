angular.module('lynxModule').component('kanbanGroup', {
    templateUrl: '/application/taskboard/components/kanbanGroup.html',
    controller: function KanbanGroupController($http, $window) {
        this.$onInit = function () {
            var self = this;
            self.tasks = [];

            self.dragControlListeners = {
                itemMoved: self.onItemMove,
                additionalPlaceholderClass: 'kanban-task-placeholder'
            };

            $http.get('/task/getTasks/' + self.status.short_name + '/' + self.projectId + '/' + self.sprintId).then(function(response) {
                self.tasks = response.data;
            });
        };

        this.onItemMove = function(event, d) {
            var statusName = event.dest.sortableScope.element[0].getAttribute('data-name');
            var model = event.source.itemScope.task;

            $http.post('/task/updateStatus', {
                id: model.id,
                status: statusName
            }).then(function(response) {
                $window.alertify.success(response.data.msg);
            });
            return true;
        };
    },
    bindings: {
        tasks: '<',
        status: '<',
        projectId: '@',
        sprintId: '@'
    }
});