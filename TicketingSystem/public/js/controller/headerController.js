/**
 * Created by Zoran Luledzija on 29-Jun-16.
 */
app.controller('headerCtrl', ['$scope', '$cookies', '$location', 'headerService',
    function($scope, $cookies, $location, headerService) {

        $scope.logout = function() {
            headerService.logout();
        }

    }]);