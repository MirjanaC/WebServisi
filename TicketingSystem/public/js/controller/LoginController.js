/**
 * Created by Zoran Luledzija on 26-Jun-16.
 */
app.controller('loginController', ['$scope', '$http', '$cookies', '$cookieStore', function($scope, $http, $cookies, $cookieStore) {
    $scope.user_email;
    $scope.user_password;
    $scope.login = function(){
        var data = {
            "user_email": $scope.user_email,
            "user_password": $scope.user_password
        };
        var config = {
            headers : {
                'Content-Type': 'application/json;charset=utf-8;'
            }
        }
        $http.post("http://localhost:8080/WebServisi/TicketingSystem/api/login", data, config)
            .success(function (data, status, headers, config) {
                if (status == 200 && data != null) {
                    $cookies.put('ticketingSystem', data, {'path':'/'});
                    window.location = "http://localhost:8080/WebServisi/TicketingSystem/public";
                }
            });
    };
}]);
