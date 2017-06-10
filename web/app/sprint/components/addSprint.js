angular.module('sprintModule').component('addSprint', {
    templateUrl: '/app/sprint/components/addSprint.html',
    controller: function AddSprintController($scope, $http, $q, $location) {
        var self = this;

        self.formData = {
            'name': '',
            'description': ''
        };

        self.selectProject = function() {
            self.formData.project = self.project.name;
        };

        self.loading = true;

        $http.get('/project/getList').then(function(response) {
            self.projectList = response.data;
            self.loading = false;
        });

        self.submitForm = function() {
            $http.post('/sprint/save', JSON.stringify(self.formData)).then(function(){
                $location.path('/list');
            });
        };
    }
});