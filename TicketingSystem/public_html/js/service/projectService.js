app.factory('ProjectFactory', function($resource) {

	return $resource('/WebServisi/TicketingSystem/api/projects');

});