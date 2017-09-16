angular.module('userpanelModule')
    .config(['$locationProvider', '$routeProvider',
        function config($locationProvider, $routeProvider) {
            $routeProvider.when('/team', {
                template: '<app-header title="User panel" subtitle="Team"></app-header><user-list></user-list>'
            }).when('/profile', {
                template: '<app-header title="User panel" subtitle="Profile"></app-header><profile></profile>'
            }).when('/add-user', {
                template: '<app-header title="User panel" subtitle="Add user"></app-header><add-user></add-user>'
            }).otherwise('/team');
        }
    ]);