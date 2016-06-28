app.factory('UserFactory', ['$resource',
	function($resource) {


	return $resource('/WebServisi/TicketingSystem/api/users/:user_id', {
            user_id: '@_id'
        }, {
            update: {
                method: 'PUT'
            }
        });
	

}]);