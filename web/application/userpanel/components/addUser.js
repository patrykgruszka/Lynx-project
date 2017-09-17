angular.module('lynxModule').component('addUser', {
    templateUrl: '/application/userpanel/components/addUser.html',
    controller: function UserListController($http, $window, $location) {
        var self = this;
        self.loading = false;

        self.user = {
            username: '',
            email: '',
            name: '',
            lastname: '',
            password: '',
            passwordRepeat: '',
            role: 'ROLE_USER',
            enabled: true
        };

        self.submitForm = function() {
            console.log(JSON.stringify(self.user));
            if (self.user.password === self.user.passwordRepeat) {
                $http.post('/userpanel/addUser', JSON.stringify(self.user)).then(function(response){
                    $window.alertify.success(response.data.msg);
                    $location.path('/userpanel/team');
                });
            } else {
                $window.alertify.error('Password does not match confirmation');
            }
        };
    }
});