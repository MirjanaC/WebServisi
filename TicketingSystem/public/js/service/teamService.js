app.factory('TeamFactory', function($resource, $http) {

	function getAll() {
		return $resource('/WebServisi/TicketingSystem/api/teams');
	}

	function getAllUsers() {
		return $resource('/WebServisi/TicketingSystem/api/users');
	}

	function getAllTeamUsers(id) {
		return $http.get('/WebServisi/TicketingSystem/api/teamUsers/' + id).then(function(response){
			return response.data;
		});
	}

	function addTeam(team) {
		return $http.post('/WebServisi/TicketingSystem/api/teams', team).then(function(response) {
			return response.data;
		});
	}

	function addTeamMember(teamMember) {
		return $http.post('/WebServisi/TicketingSystem/api/teamMember', teamMember).then(function(response) {
			return response.data;
		});
	}

	function deleteTeam(id) {
		return $http.delete('/WebServisi/TicketingSystem/api/teams/' + id ).then(function(response) {
			return response.data;
		});
	}

	function deleteTeamMember(teamMember) {
		return $http.delete('/WebServisi/TicketingSystem/api/teamMember', { data : teamMember }).then(function(response) {
			return response.data;
		});
	}

	function editTeam(team) {
		return $http.put('/WebServisi/TicketingSystem/api/teams', team).then(function(response) {
			return response.data;
		});
	}

	return {
		getAll : getAll,
		getAllUsers : getAllUsers,
		getAllTeamUsers : getAllTeamUsers,
		addTeam : addTeam,
		addTeamMember : addTeamMember,
		deleteTeam : deleteTeam,
		deleteTeamMember : deleteTeamMember,
		editTeam : editTeam
	}

});