app.controller('taskCtrl',['$scope', '$filter','$location','TaskFactory', '$stateParams', 
	function($scope, $filter, $location, TaskFactory, $stateParams) {

	$scope.find = function(){
		TaskFactory.query(function(data) {
			$scope.tasks = data;
		});
	};

	$scope.datum1=new Date();
	$scope.task = {};

	$scope.add = function () {

		
		$scope.datum = $filter('date')($scope.datum1, 'yyyy-MM-dd');
	
		console.log($scope.datum);

		var task = new TaskFactory({

			task_mark : $scope.task.mark,
			task_title : $scope.task.name,
			task_description : $scope.task.description,
			task_userCreator : $scope.task.creator,
			task_userAssigned : $scope.task.assigned,
			task_creationDate : $scope.datum,
			task_priority : $scope.task.priority,
			task_status : $scope.task.status

		});

		console.log("TASK: " + angular.toJson(task));

		task.$save(function(response) {
			$location.path('/tasks');
		}, function(error) {
			$scope.error = error.data.message;
		});
	};

	$scope.findOne = function() {
      TaskFactory.get({
        task_id: $stateParams.task_id
      }, function(task) {
        $scope.task = task;
      });
    };

    $scope.update = function(){
  	 
      $scope.task.$update(function(){
      	
        $location.path('/tasks');
      }, function(errorResponse){
        $scope.error = errorResponse.data.message;
      });
    };

	$scope.delete = function(tid) {
		console.log("Deleted: " + tid);
		/*$scope.task.$delete(function(response) {
			console.log('Done.');
		}, function(errorResponse){
        	$scope.error = errorResponse.data.message;
      	});*/
      	TaskFactory.$delete({},{task_id:tid});
	};


}]);