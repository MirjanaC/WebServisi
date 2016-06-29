app.factory('CommentFactory', ['$resource',
	function($resource){
	
		return $resource('/WebServisi/TicketingSystem/api/comments/:commentId', {
		    commentId : '@_id'
		  }, {
		    update : {
		      method: 'PUT'
		    },
		    getLogged: {
            	url: '/WebServisi/TicketingSystem/api/logged_user',
            	method: 'GET'
            },
            getUser: {
            	url: '/WebServisi/TicketingSystem/api/comments/user/{id}',
            	method: 'GET'
            }
		  });

}]);