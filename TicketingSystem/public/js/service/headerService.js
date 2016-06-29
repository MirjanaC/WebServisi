/**
 * Created by Zoran Luledzija on 29-Jun-16.
 */
app.service('headerService', function($http, $cookies) {
    this.logout = function () {
        $http.delete('/WebServisi/TicketingSystem/api/logout').then(function(response) {
            console.log('Logout status: ' + response.status);
            if (response.status == 200) {
                $cookies.remove("ticketingSystem", { path: '/' });
                window.location = "http://localhost:8080/WebServisi/TicketingSystem/public";
            }
        });
    }
});