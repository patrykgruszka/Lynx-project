angular.module('projectModule').component('addProject', {
    templateUrl: '/app/project/components/addProject.html',
    controller: function AddProjectController($scope) {
        var self = this;

        self.formData = {
            'name': '',
            'description': ''
        };

        self.submitForm = function() {
            console.log(self.formData);
        };
    }
});