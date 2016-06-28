app.controller('userCtrl', ['$scope', 'UserFactory', '$location', '$stateParams', 
	function($scope, UserFactory, $location,$stateParams) {

	$scope.data = {};

	$scope.add = function() {

		// NAPOMENA ZA EMAIL: Unositi samo u punom obliku - email@email.com, u suprotnom Error na nivou baze //
		// NAPOMENA ZA ROLE: paziti na broj karaktera inace error na nivou baze //

		console.log("User: NAME:" + $scope.data.name +" , EMAIL:"+ $scope.data.email +" , ROLE:"+ $scope.data.role);

		 var user = new UserFactory({
			user_name : $scope.data.name,
			user_lastname : $scope.data.surname,
			user_email : $scope.data.email,
			user_password : $scope.data.password,
			user_role : $scope.data.role
		})

		user.$save(function(response){
        $location.path('/users');
      }, function(errorResponse){
        $scope.error = errorResponse.data.message;
      });
    };

	

	$scope.find = function(){
  	UserFactory.query(function(data) {
  		$scope.users = data;
  	});
	};

	$scope.delete = function(user){
     if (user) {
           user.$remove(user);
           $location.path('/users');
          } else {
            $scope.user.$remove(function(response) {
              $location.path('/users');
              });
      }
    };

     $scope.findOne = function() {
      UserFactory.get({
        user_id: $stateParams.user_id
      }, function(user) {
        $scope.user = user;
      });
    };

     $scope.update = function(){
      $scope.user.$update(function(){
        $location.path('/users');
      }, function(errorResponse){
        $scope.error = errorResponse.data.message;
      });
    };

}]);