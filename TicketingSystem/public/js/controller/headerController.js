/**
 * Created by Zoran Luledzija on 29-Jun-16.
 */
app.controller('headerCtrl', ['$scope', '$location', 'headerService',
    function($scope, $location, headerService) {

        $scope.logout = function() {
            headerService.logout();
        }

    }]);