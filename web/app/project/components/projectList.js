angular.module('projectModule').component('projectList', {
    templateUrl: '/app/project/components/projectList.html',
    controller: function ProjectListController($http) {
        var self = this;
        this.projectsList = [];

        $http.get('/project/getList').then(function(response) {
            self.projectsList = response.data;
        });
    }
});