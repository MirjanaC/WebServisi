app.controller('projectCtrl', ['$scope', 'ProjectFactory', '$location', 'UserFactory', '$stateParams',
		function($scope, ProjectFactory, $location, UserFactory, $stateParams) {


	$scope.findUsers = function() {
          UserFactory.query(function(data){
            $scope.users = data;
          
          }, function(errorResponse){
          	console.log(errorResponse)
          });
      };

     
	$scope.project = {};


	 $scope.add = function() {
    			
		 angular.forEach($scope.project.users, function(u) {
		 	  console.log("fsfsd");
			$scope.us = u.user_id;

			var send = new ProjectFactory({

			project_name : $scope.project.name,
			user_id : $scope.us

			});

			console.log("SEND: " + angular.toJson(send));

			send.$save(function(response) {
				$location.path('/projects');
			}, function(error) {
				$scope.error = error.data.message;
			});

		});
	};

	$scope.find = function(){
		ProjectFactory.query(function(data) {
			$scope.projects = data;
	});
	};

	$scope.delete = function(project){
      if(project){
        user.$remove(function(){
          for(var i in $scope.projects){
            if($scope.projects[i] === project){
               $scope.projects.splice(i,1);
            }
          }
        });
      } else {
        $scope.project.$remove(function(){
          $location.path('projects/');
        });
      }
    };

     $scope.findOne = function() {
      ProjectFactory.get({
        project_id: $stateParams.project_id
      }, function(project) {
        $scope.project = project;
      });
    };

     $scope.update = function(){
      $scope.project.$update(function(){
        $location.path('/projects');
      }, function(errorResponse){
        $scope.error = errorResponse.data.message;
      });
    };


}]);