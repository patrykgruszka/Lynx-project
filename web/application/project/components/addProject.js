angular.module('lynxModule').component('addProject', {
    templateUrl: '/application/project/components/addProject.html',
    controller: function AddProjectController($scope, $http, $location) {
        var self = this;

        self.formData = {
            'name': '',
            'description': ''
        };

        self.submitForm = function() {
            $http.post('/project/save', JSON.stringify(self.formData)).then(function(){
                $location.path('/project');
            });
        };
    }
});