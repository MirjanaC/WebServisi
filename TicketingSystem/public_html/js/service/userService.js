app.factory('UserFactory', function($resource, $http) {

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
	

});