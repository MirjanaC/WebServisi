app.factory('UserFactory', ['$resource',
	function($resource) {

/*
	function getAll() {
		return $resource('/WebServisi/TicketingSystem/api/users');
	}

	function addUser(user) {
		return $http.post('/WebServisi/TicketingSystem/api/users', user).then(function(response) {
			return response.data;
		});
	}

	return {

		getAll : getAll,
		addUser : addUser,

	}
*/
	return $resource('/WebServisi/TicketingSystem/api/users/:user_id', {
            user_id: '@_id'
        }, {
            update: {
                method: 'PUT'
            }
        });
	

}]);