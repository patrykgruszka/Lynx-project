angular.module('projectModule').component('addProject', {
    templateUrl: '/app/project/components/addProject.html',
    controller: function AddProjectController($scope, $http) {
        var self = this;

        self.formData = {
            'name': '',
            'description': ''
        };

        self.submitForm = function() {

            console.log($http);
            $http.post('/project/save', JSON.stringify(self.formData)).success(function(response){
                console.log(response);
            });
        };
    }
});