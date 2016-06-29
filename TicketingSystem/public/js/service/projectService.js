app.factory('ProjectFactory', ['$resource', function($resource) {

	return $resource('/WebServisi/TicketingSystem/api/projects/:project_id', {project_id: '@_id'}, {
            update: {
                method: 'PUT'
            },
            getData: {
            	url: '/WebServisi/TicketingSystem/api/projectsUsername/:project_id',
            	method: 'GET',
            	isArray: false
            },
            getTaskData: {
                url: '/WebServisi/TicketingSystem/api/projectsTasks/:project_id',
                method: 'GET',
                isArray: false
            }
        });
	

}]);