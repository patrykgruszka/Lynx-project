angular.module('lynxModule').component('userList', {
    templateUrl: '/application/userpanel/components/userList.html',
    controller: function UserListController($http, $window) {
        var self = this;
        self.usersList = [];
        self.loading = true;

        $http.get('/userpanel/getUsers').then(function(response) {
            self.usersList = response.data;
            self.loading = false;
        });
    }
});