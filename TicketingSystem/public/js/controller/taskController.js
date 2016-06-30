app.controller('taskCtrl',['$scope', '$filter','$location','TaskFactory', '$stateParams','ProjectFactory','$window','UserFactory', 
	function($scope, $filter, $location, TaskFactory, $stateParams, ProjectFactory, $window, UserFactory) {

	$scope.find = function(){
		TaskFactory.query(function(data) {
			$scope.tasks = data;
		});
	};


	$scope.datum1=new Date();
	$scope.task = {};

	$scope.add = function () {

		
		$scope.datum = $filter('date')($scope.datum1, 'yyyy-MM-dd');

		var task = new TaskFactory({
			task_mark : $scope.task.projects.project_code+$scope.task.projects.project_id,
			task_title : $scope.task.title,
			task_creationDate : $scope.datum,
			task_description : $scope.task.description,
			task_priority : $scope.task.priority,
			task_status : $scope.task.status,
			project_id : $scope.task.projects.project_id
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
  	 
      $scope.task.$update(function(){
      	
        $location.path('/tasks');
      }, function(errorResponse){
        $scope.error = errorResponse.data.message;
      });
    };

	$scope.delete = function(id) {
		 var task = TaskFactory.get({task_id:id},function(response){})
			task.$delete({task_id:id},function(response){
			 $window.location.reload();
			});
	};

	$scope.newTasks = [];
    
    $scope.statusOrFilter = function(filter) {
        var i = $.inArray(filter, $scope.newTasks);
        if (i > -1) {
            $scope.newTasks.splice(i, 1);
        } else {
            $scope.newTasks.push(filter);
        }
    }
    
    $scope.statusFilter = function(task) {
        if ($scope.newTasks.length > 0) {
            if ($.inArray(task.task_status, $scope.newTasks) < 0)
                return;
        }
        return task;
	};
	
	$scope.priorityFilter = function(task) {
        if ($scope.newTasks.length > 0) {
            if (($.inArray(task.task_priority, $scope.newTasks) < 0) && ($.inArray(task.task_status, $scope.newTasks) < 0))
                return;
        }
        return task;
	};

	$scope.getLoggedUser = function(){
        UserFactory.getLogged(function(data){
          $scope.loggedUser = data;
        });
    };    

    $scope.findUsers = function() {
          UserFactory.query(function(data){
            $scope.users = data;
          
          }, function(errorResponse){
          	console.log(errorResponse)
          });
      };

    $scope.findProjects = function() {
        ProjectFactory.query(function(data){
           $scope.projects = data;
          
        }, function(errorResponse){
          console.log(errorResponse)
        });
    };
	

}]);