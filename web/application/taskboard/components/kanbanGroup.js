var KanbanGroupController = function() {
    var ctrl = this;
};

angular.module('taskboardModule').component('kanbanGroup', {
    templateUrl: '/application/taskboard/components/kanbanGroup.html',
    controller: KanbanGroupController,
    bindings: {
        tasks: '<',
        status: '<'
    }
});