app.controller('taskCtrl', function($scope, TaskFactory) {

	TaskFactory.query(function(data) {
		$scope.tasks = data;
	});


});