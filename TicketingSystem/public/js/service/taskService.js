app.factory('TaskFactory', ['$resource', 
	function($resource) {


	return $resource('/WebServisi/TicketingSystem/api/tasks/:task_id', {
            task_id: '@_id'
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