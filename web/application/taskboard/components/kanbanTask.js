var KanbanTaskController = function() {
    var ctrl = this;
};

angular.module('taskboardModule').component('kanbanTask', {
    templateUrl: '/application/taskboard/components/kanbanTask.html',
    controller: KanbanTaskController,
    bindings: {
        task: '<'
    }
});