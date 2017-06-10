angular.module('projectModule').component('projectList', {
    templateUrl: '/app/project/components/projectList.html',
    controller: function ProjectListController($http) {
        var self = this;
        self.projectsList = [];
        self.loading = true;

        $http.get('/project/getList').then(function(response) {
            self.projectsList = response.data;
            self.loading = false;
        });
    }
});