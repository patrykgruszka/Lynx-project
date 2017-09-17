angular.module('lynxModule').component('profile', {
    templateUrl: '/application/userpanel/components/profile.html',
    controller: function UserListController($http, $window) {
        var self = this;
        self.loading = true;

        $http.get('/userpanel/getProfile').then(function(response) {
            self.user = response.data;
            self.loading = false;
        });

        self.submitForm = function() {
            $http.post('/userpanel/updateProfile', JSON.stringify(self.user)).then(function(response){
                $window.alertify.success(response.data.msg);
            });
        };
    }
});