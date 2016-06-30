app.factory('ReportFactory', ['$resource', function($resource) {

	return $resource('/WebServisi/TicketingSystem/api/reports/:project_id', {project_id: '@_id'}, {
            update: {
                method: 'PUT'
            },
            getReport1: {
            	url: '/WebServisi/TicketingSystem/api/taskReport/:project_id',
            	method: 'GET',
            	isArray: true            
            }
        });
	

}]);