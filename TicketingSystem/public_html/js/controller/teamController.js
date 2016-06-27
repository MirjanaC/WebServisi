app.controller('teamCtrl', function($scope, TeamFactory, $location, UserFactory) {

	TeamFactory.getAll().query(function(data) {
		$scope.projects = data;
	});

	UserFactory.getAll().query(function(data) {
		$scope.users = data;
	});

	$scope.team = {};

	$scope.add = function() {

		// NAPOMENA: korisnici kojima je dodeljen tim se cuvaju svaki u posebnom redu tabele //
		// ako je potrebno izvuci tim, lako je preko SQL upita, uslov po imenu //

		angular.forEach($scope.team.user, function(u) {
			console.log("One user: " + angular.toJson(u.user_id));
			$scope.us = u.user_id;

			var send = {
			team_name : $scope.team.name,
			user_id : $scope.us
			};


			console.log("SEND: " + angular.toJson(send));

			TeamFactory.addTeam(send).then(function(response) {
				console.log("Success.");
				$location.path('/dashboard');
			});

		});


	}

});