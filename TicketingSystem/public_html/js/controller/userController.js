app.controller('userCtrl', function($scope, UserFactory) {

	UserFactory.query(function(data) {
		$scope.users = data;
	});


});