app.factory('UserFactory', function($resource) {

	return $resource('/WebServisi/TicketingSystem/api/users');

});