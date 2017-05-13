lynxApp.controller('TaskboardController', function TaskboardController($scope) {
    $scope.toDoTasks = [
        {
            'name': 'Task 1',
            'description': 'Try mashing up the whipped cream watermelons with slobbery triple sec and cocktail sauce, simmered.'
        },
        {
            'name': 'Task 2',
            'description': 'Gooey, bloody pudding is best mixed with sour water.'
        }
    ];
    $scope.inProgressTasks = [
        {
            'name': 'Task 4',
            'description': 'Coffee soup is just not the same without baking powder and rich juicy pork butts.'
        }
    ];
    $scope.doneTasks = [
        {
            'name': 'Task 3',
            'description': 'The tragedy is a distant phenomenan.'
        }
    ];
});