angular.module('lynxModule').component('chooseSprint', {
    templateUrl: '/application/taskboard/components/chooseSprint.html',
    controller: function ChooseSprintController($http) {
        var self = this;
        self.sprintsList = [];
        self.loading = true;

        $http.get('/sprint/getList').then(function(response) {
            self.sprintsList = response.data;
        }).finally(function() {
            self.loading = false;
        });
    }
});