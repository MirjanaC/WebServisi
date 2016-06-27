app.controller('taskCtrl', ['$scope','TaskFactory',
	function($scope, TaskFactory) {


	$scope.find = function(){
		TaskFactory.query(function(data) {
			$scope.tasks = data;
		});
	};


});