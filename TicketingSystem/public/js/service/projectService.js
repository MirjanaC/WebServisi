app.factory('ProjectFactory', function($resource, $http) {

/*
	function addProject(project) {
		return $http.post('/WebServisi/TicketingSystem/api/projects', project).then(function(response) {
			return response.data;
		});
	}

	return {

		addProject : addProject

	}
*/

	return $resource('/WebServisi/TicketingSystem/api/projects/:project_id', {
            user_id: '@_id'
        }, {
            update: {
                method: 'PUT'
            }
        });
	

});