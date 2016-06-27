app.factory('TaskFactory', function($resource) {

	return $resource('/WebServisi/TicketingSystem/api/tasks');

});