app.controller('teamCtrl', function($scope, TeamFactory, $location) {

	// Hold users of current team
	$scope.teamUsers = [];

	// Hold free users
	$scope.freeUsers = [];

	// Currently selected team
	$scope.currentTeam = {};

	// Used for editing - deep copy
	$scope.editTeam = {};

	// Used for adding new team
	$scope.team = {};

	TeamFactory.getAll().query(function(data) {
		$scope.teams = data;
	});

	TeamFactory.getAllUsers().query(function(data) {
		$scope.users = data;
	});

	// add new team
	$scope.add = function() {
		var send = {
			team_name : $scope.team.name
		}
		TeamFactory.addTeam(send).then(function(response){
			console.log("Successfully added team");
			// Update team list
			TeamFactory.getAll().query(function(data) {
				$scope.teams = data;
			});
			// Clear input
			$scope.team.name = '';
		});
	}

	$scope.addUser = function(team) {
		$scope.currentTeam = team;
		$scope.teamUsers = [];
		TeamFactory.getAllTeamUsers($scope.currentTeam.team_id).then(function(data) {
			$scope.teamUsers = data;
			if (angular.isArray($scope.teamUsers)){
				$scope.freeUsers = [];
				$scope.users.forEach( function (user)
				{
					var founded = false;
					$scope.teamUsers.forEach(function (teamUser){
						if (user.user_id == teamUser.user_id){
							founded = true;
						}
					});
					if (!founded) {
						$scope.freeUsers.push(user);
					}
				});
			} else {
				$scope.freeUsers = $scope.users;
			}
		});
	}

	$scope.addUserToTeam = function(user){
		var send = {
			team_id : $scope.currentTeam.team_id,
			user_id : user.user_id
		}
		TeamFactory.addTeamMember(send).then(function(response){
			console.log("Successfully added user to team");
			// Refresh data
			$scope.teamUsers = [];
			TeamFactory.getAllTeamUsers($scope.currentTeam.team_id).then(function(data) {
				$scope.teamUsers = data;
			});
			// Update free users
			var index = $scope.freeUsers.indexOf(user);
			$scope.freeUsers.splice(index, 1);
		});
	}

	$scope.teamMembers = function(team) {
		$scope.currentTeam = team;
		$scope.teamUsers= [];
		TeamFactory.getAllTeamUsers($scope.currentTeam.team_id).then(function(response){
			$scope.teamUsers = response;
		});
	}

	// delete existing team
	$scope.delete = function(team) {
		TeamFactory.deleteTeam(team.team_id).then(function(response){
			console.log("Successfully deleted team");
			var index = $scope.teams.indexOf(team);
			$scope.teams.splice(index, 1);
		});
	}

	$scope.deleteTeamMember = function(user) {
		var send = {
			team_id : $scope.currentTeam.team_id,
			user_id : user.user_id
		}
		TeamFactory.deleteTeamMember(send).then(function(response){
			console.log("Successfully deleted team member");
			var index = $scope.teamUsers.indexOf(user);
			$scope.teamUsers.splice(index, 1);
		});
	}

	// deep-copy of team object
	$scope.editTeam = function(team) {
		angular.copy(team, $scope.editTeam);
	}

	// edit existing team
	$scope.submitEdit = function() {
		var send = {
			team_id : $scope.editTeam.team_id,
			team_name : $scope.editTeam.team_name
		}
		TeamFactory.editTeam(send).then(function(response){
			console.log("Successfully edited team");
			// Update team list
			TeamFactory.getAll().query(function(data) {
				$scope.teams = data;
			});
		});
	}

});