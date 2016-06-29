app.controller('userCtrl', ['$scope', 'UserFactory', '$location', '$stateParams','$window', 
	function($scope, UserFactory, $location,$stateParams,$window) {

	$scope.data = {};

	$scope.add = function(isValid) {

		// NAPOMENA ZA EMAIL: Unositi samo u punom obliku - email@email.com, u suprotnom Error na nivou baze //
		// NAPOMENA ZA ROLE: paziti na broj karaktera inace error na nivou baze //

		console.log("User: NAME:" + $scope.data.name +" , EMAIL:"+ $scope.data.email +" , ROLE:"+ $scope.data.role);


    if (isValid) {
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
       }else{
        console.log("i");
        $scope.submitted=true;
      }
    };

	$scope.find = function(){
  	UserFactory.query(function(data) {
  		$scope.users = data;
  	});
	};

	$scope.delete = function(id){
     var user = UserFactory.get({user_id:id},function(response){})
      user.$delete({user_id:id},function(response){
       $window.location.reload();
      });
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

  $scope.getLoggedUser = function(){
      UserFactory.getLogged(function(data){
        $scope.loggedUser = data;
      });
  };    

  
}])

app.controller('registerCtrl', ['$scope', 'UserFactory', '$location','$window',
  function($scope, UserFactory, $location, $window) {

    $scope.role='programmer';

    $scope.register = function(isValid) {

    console.log("User: NAME:" + $scope.data.name +" , EMAIL:"+ $scope.data.email +" , ROLE:"+ $scope.role + $scope.data.password);

    if (isValid) {
      if($scope.data.password == $scope.data.password2){
  
       var userRegister = new UserFactory({
        user_name : $scope.data.name,
        user_lastname : $scope.data.surname,
        user_email : $scope.data.email,
        user_password : $scope.data.password,
        user_role : $scope.role
      })
       
      userRegister.$save(function(response){
          window.location.href="/WebServisi/TicketingSystem/public/login.php";
        }, function(errorResponse){
          $scope.error = errorResponse.data.message;
        });
       }else{
          alert("Password doesnt match");
       }
     }else{
        $scope.submitted=true;
      }
    };


}]);