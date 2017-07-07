angular.module('taskboardModule').component('taskboard', {
    templateUrl: '/application/taskboard/components/taskboard.html',
    controller: function TaskboardController($http) {
        var self = this;

        self.toDoTasks = [];
        self.inProgressTasks = [];
        self.doneTasks = [];

        self.loading = true;
        $http.get('/task/getList').then(function(response) {
            for(var i = 0; i < response.data.length; i++) {
                var task = response.data[i];

                switch(task.status.name) {
                    case 'To do':
                        self.toDoTasks.push(task);
                        break;
                    case 'In progress':
                        self.inProgressTasks.push(task);
                        break;
                    default:
                        self.toDoTasks.push(task);
                }
            }
        }).finally(function() {
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
    }
});