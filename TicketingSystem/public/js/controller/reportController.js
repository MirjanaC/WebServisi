app.controller('reportCtrl', ['$scope', 'ProjectFactory', '$location', 'UserFactory', '$stateParams','$window', 'ReportFactory',
		function($scope, ProjectFactory, $location, UserFactory, $stateParams,$window, ReportFactory) {


  $scope.getLoggedUser = function(){
        UserFactory.getLogged(function(data){
          $scope.loggedUser = data;
        });
    }; 

  $scope.findOne = function() {
      ProjectFactory.get({
        	project_id: $stateParams.project_id
      	}, function(project) {
        	$scope.project = project;
      	});
  }; 

  $scope.p_id = $stateParams.project_id;
  console.log('ID: ' + $scope.p_id);


  $scope.labels = [];
	$scope.data = [];
	$scope.series = [];

	$scope.getChartForAssignedTasks = function() {

		console.log("Bar udje u funkciju.");

		$scope.labels = ["January", "February", "March", "April", "May", "June", "July"];
    $scope.series = ['Series A', 'Series B'];
    $scope.data = [
        [28, 48, 40, 19, 86, 27, 90]
    ];

    console.log("LABELS: " + angular.toJson($scope.labels));
    console.log("SERIES: " + angular.toJson($scope.series));
    console.log("DATA: " + angular.toJson($scope.data));

	};


}]);