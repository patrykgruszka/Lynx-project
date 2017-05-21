angular.module('projectModule').component('addProject', {
    templateUrl: '/app/project/components/addProject.html',
    controller: function AddProjectController($scope, $http, $location) {
        var self = this;

        self.formData = {
            'name': '',
            'description': ''
        };

        self.submitForm = function() {
            $http.post('/project/save', JSON.stringify(self.formData)).then(function(response){
                $location.path('/').replace();
                $scope.$apply();
            });
        };
    }
});