app.factory('ProjectFactory', function($resource, $http) {

	function getAll() {
		return $resource('/WebServisi/TicketingSystem/api/projects');
	}

	function addProject(project) {
		return $http.post('/WebServisi/TicketingSystem/api/projects', project).then(function(response) {
			return response.data;
		});
	}

	return {

		getAll : getAll,
		addProject : addProject,

	}
	

});