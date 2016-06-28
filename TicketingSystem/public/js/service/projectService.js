app.factory('ProjectFactory', ['$resource', function($resource) {

	return $resource('/WebServisi/TicketingSystem/api/projects/:project_id', {
            user_id: '@_id'
        }, {
            update: {
                method: 'PUT'
            }
        });
	

}]);