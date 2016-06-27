app.controller('taskCtrl', ['$scope','TaskFactory',
	function($scope, TaskFactory) {


	$scope.find = function(){
		TaskFactory.query(function(data) {
			$scope.tasks = data;
		});
	};

	$scope.delete = function(task){
      if(task){
        task.$remove(function(){
          for(var i in $scope.tasks){
            if($scope.tasks[i] === task){
               $scope.tasks.splice(i,1);
            }
          }
        });
      } else {
        $scope.task.$remove(function(){
          $location.path('tasks/');
        });
      }
    };

     $scope.findOne = function() {
      UserFactory.get({
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


}]);