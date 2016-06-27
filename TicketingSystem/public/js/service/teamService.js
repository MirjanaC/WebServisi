app.factory('TeamFactory', function($resource, $http) {

	function getAll() {
		return $resource('/WebServisi/TicketingSystem/api/teams');
	}

	function addTeam(team) {
		return $http.post('/WebServisi/TicketingSystem/api/teams', team).then(function(response) {
			return response.data;
		});
	}

	return {

		getAll : getAll,
		addTeam : addTeam,

	}
	

});