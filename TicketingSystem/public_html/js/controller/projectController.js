app.controller('projectCtrl', function($scope, ProjectFactory) {

	ProjectFactory.query(function(data) {
		$scope.projects = data;
	});


});