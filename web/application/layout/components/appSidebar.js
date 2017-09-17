var AppSidebarComponent = {
    templateUrl: '/application/layout/components/appSidebar.html',
    controller: function AppHeaderController($scope, $location) {
        var self = this;
        self.currentPath = $location.path();

        $scope.$on('$routeChangeStart', function() {
            self.currentPath = $location.path();
        });

        self.pathEquals = function(path) {
            return self.currentPath === path;
        };

        self.pathContains = function(path) {
            return self.currentPath.indexOf(path) !== -1;
        };

        self.pathMatches = function(exp) {
            return self.currentPath.match(exp);
        };
    }
};

angular.module('lynxModule').component('appSidebar', AppSidebarComponent);
