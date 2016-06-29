app.controller('projectCtrl', ['$scope', 'ProjectFactory', '$location', 'UserFactory', '$stateParams','$window',
		function($scope, ProjectFactory, $location, UserFactory, $stateParams,$window) {

	
	$scope.findUsers = function() {
          UserFactory.query(function(data){
            $scope.users = data;
          
          }, function(errorResponse){
          	console.log(errorResponse)
          });
      };


  $scope.getLoggedUser = function(){
        UserFactory.getLogged(function(data){
          $scope.loggedUser = data;
        });
    };    

     
	$scope.project = {};


	 $scope.add = function() {
    			
		 var spliting = $scope.project.name.split(' ');
      val1 = spliting[0];
      val2 = spliting[1];

      send = new ProjectFactory({
        project_name : $scope.project.name,
        project_code : "PR-"+val2,
        team_id : $scope.project.teams.team_id

      });

      console.log("SEND: " + angular.toJson(send));

     send.$save(function(response) {
        $location.path('/projects');
      }, function(error) {
        $scope.error = error.data.message;
      });
	};

	$scope.find = function(){
		ProjectFactory.query(function(data) {
			$scope.projects = data;
	});
	};

	$scope.delete = function(id){
      var project = ProjectFactory.get({project_id:id},function(response){})
      project.$delete({project_id:id},function(response){
       $window.location.reload();
      });
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

    $scope.projectName = {};
    $scope.userName = {};
    $scope.getUsers = function() {
      ProjectFactory.getData({project_id: $stateParams.project_id}, function(data){
        $scope.projectName = data.project_name;
        $scope.userName = data.user_name;

        console.log("Data1: " + angular.toJson($scope.projectName) + ", Data2: " + angular.toJson($scope.userName));

        if($scope.userName == null) {
          $scope.userName = "User not assigned.";
        }
      });
      
    };

    $scope.projName = {};
    $scope.taskTitle = {};
    $scope.taskId = {};
    $scope.getTasks = function() {
      ProjectFactory.getTaskData({project_id: $stateParams.project_id}, function(data){
        $scope.projName = data.project_name;
        $scope.taskTitle = data.task_title;
        $scope.taskId = data.task_id;

        console.log("Data1: " + angular.toJson($scope.projName) + ", Data2: " + angular.toJson($scope.taskTitle));

        if($scope.taskTitle == null) {
          $scope.taskTitle = "Tasks not assigned.";
        }
      });
      
    };

    $scope.userProjects = ProjectFactory.getUserProjects({ 
          user_id : 3},
          function(data){
       
      });
        console.log($scope.userProjects);
    
}]);