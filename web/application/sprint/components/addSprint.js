angular.module('lynxModule').component('addSprint', {
    templateUrl: '/application/sprint/components/addSprint.html',
    controller: function AddSprintController($scope, $http, $q, $location, $window) {
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
            if (!self.formData.project) {
                $window.alertify.error('Select project first');
            } else {
                $http.post('/sprint/save', JSON.stringify(self.formData)).then(function(){
                    $location.path('/sprint');
                });
            }
        };
    }
});