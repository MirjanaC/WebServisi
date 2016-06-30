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

	$scope.getChartForAssignedTasksTest = function() {

		/*console.log("Bar udje u funkciju.");

		$scope.labels = ["January", "February", "March", "April", "May", "June", "July"];
    $scope.series = ['Series A', 'Series B'];
    $scope.data = [
        [28, 48, 40, 19, 86, 27, 90]
    ];

    console.log("LABELS: " + angular.toJson($scope.labels));
    console.log("SERIES: " + angular.toJson($scope.series));
    console.log("DATA: " + angular.toJson($scope.data));*/

    var pieData = [
            {
                    value: 20,
                    color:"#878BB6"
            },
            {
                    value : 40,
                    color : "#4ACAB4"
            }
    ];
    var pieOptions = {
            segmentShowStroke : false,
            animateScale : true,
            responsive: false
    }
    var expenses = document.getElementById("canvas").getContext("2d");
    new Chart(expenses).Pie(pieData, pieOptions);

	};

  /*$scope.pieData = [];
  $scope.addingData = [{
        value: '',
        color: ''
  }];
  $scope.add = function(itemToAdd) {
    var index = $scope.itemsToAdd.indexOf(itemToAdd);
    $scope.addingData.splice(index, 1);
    $scope.items.push(angular.copy(itemToAdd))
  };*/

  $scope.getChartForAssignedTasks = function() {

    console.log("Bar udje u funkciju.");

    ReportFactory.getReport1({project_id: $stateParams.project_id}, function(data) {
        
        console.log("Data: " + angular.toJson(data));
      
        $scope.percent = {};

        angular.forEach(data, function(value) {
            
          percent = Math.round(((value.user_id / value.task_id) * 100) * 100) / 100;
          console.log("percent: " + percent);

          var pieData = [{
              value: percent,
              color: "#878BB6"
          }];

          var pieOptions = {
            segmentShowStroke : false,
            animateScale : true,
            responsive: false
          }
          var expenses = document.getElementById("canvas").getContext("2d");
          new Chart(expenses).Pie(pieData, pieOptions);

        }); 

    }); 

  };


}]);