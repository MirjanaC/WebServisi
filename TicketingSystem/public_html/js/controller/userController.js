app.controller('userCtrl', function($scope, UserFactory, $location) {

	UserFactory.getAll().query(function(data) {
		$scope.users = data;
	});

	$scope.data = {};

	$scope.add = function() {

		// NAPOMENA ZA EMAIL: Unositi samo u punom obliku - email@email.com, u suprotnom Error na nivou baze //
		// NAPOMENA ZA ROLE: paziti na broj karaktera inace error na nivou baze //

		console.log("User: NAME:" + $scope.data.name +" , EMAIL:"+ $scope.data.email +" , ROLE:"+ $scope.data.role);

		var send = {
			user_name : $scope.data.name,
			user_lastname : $scope.data.surname,
			user_email : $scope.data.email,
			user_password : $scope.data.password,
			user_role : $scope.data.role
		};

		console.log("SEND: " + angular.toJson(send));

		UserFactory.addUser(send).then(function(response) {
			console.log("Success.");
			$location.path('/projects');
		});

	}


});