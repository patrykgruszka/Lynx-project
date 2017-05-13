angular.module('projectModule').component('projectList', {
    templateUrl: '/app/project/components/projectList.html',
    controller: function ProjectListController() {
        this.projectsList = [
            {
                'id': 1,
                'name': 'Project destiny',
                'description': 'You have to appear, and believe attraction by your sitting.'
            }, {
                'id': 2,
                'name': 'Project hope',
                'description': 'Shangri-la is not the atomic control of the wind.'
            }
        ];
    }
});