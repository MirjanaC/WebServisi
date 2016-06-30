app.factory('UserFactory', ['$resource', function($resource) {

	    return $resource('/WebServisi/TicketingSystem/api/users/:user_id', {
            user_id: '@_id'
            }, {
            update: {
                method: 'PUT'
            },
            getLogged: {
            	url: '/WebServisi/TicketingSystem/api/logged_user',
            	method: 'GET'
            }
        });
	

}]);
