app.controller('projectCtrl', ['$scope', 'ProjectFactory', '$location', 'UserFactory',
		function($scope, ProjectFactory, $location, UserFactory) {

	ProjectFactory.getAll().query(function(data) {
		$scope.projects = data;
	});

	UserFactory.getAll().query(function(data) {
		$scope.users = data;
	});

	$scope.project = {};

	$scope.add = function() {

		// NAPOMENA: korisnici kojima je dodeljen projekat se cuvaju svaki u posebnom redu tabele //
		// ako je potrebno izvuci sve koji rade na odredjenom projektu, lako je preko SQL upita //

		angular.forEach($scope.project.user, function(u) {
			console.log("One user: " + angular.toJson(u.user_id));
			$scope.us = u.user_id;

			var send = {
			project_name : $scope.project.name,
			user_id : $scope.us
			};


			console.log("SEND: " + angular.toJson(send));

			ProjectFactory.addProject(send).then(function(response) {
				console.log("Success.");
				$location.path('/dashboard');
			});

		});


	}

}]);