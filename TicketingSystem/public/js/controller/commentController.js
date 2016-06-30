app.controller('commentCtrl', ["$scope", "CommentFactory", "UserFactory",  "$location", "$filter","$window", function($scope, CommentFactory, $location, UserFactory,$filter,$window) {
		
		$scope.comment = {};
		$scope.datum1=new Date();

		$scope.add = function () {
		
			$scope.datum = $filter('date')($scope.datum1, 'yyyy-MM-dd');

			var comment = new CommentFactory({

				comment_creationDate : $scope.datum,
				comment_text : $scope.comment_text,
				user_id : $scope.loggedUser.user_id,
				task_id : 1

			});

			console.log("COMMENT: " + angular.toJson(comment));

			comment.$save(function(response) {
				$window.location.reload();
			}, function(error) {
				$scope.error = error.data.message;
			});
		};


		$scope.find = function(){
			CommentFactory.query(function(data) {
				$scope.comments = data;
			});
		};

		$scope.getLoggedUser = function(){
	        CommentFactory.getLogged(function(data){
	          $scope.loggedUser = data;
        	});
		};   

		$scope.update = function(){
		    $scope.comment.$update(function(){
		      $window.location.reload();
		    }, function(errorResponse){
		      $scope.error = errorResponse.data.message;
		    });
		  };

		 $scope.delete = function(id){
		     var comment = CommentFactory.get({comment_id:id},function(response){})
		      comment.$delete({comment_id:id},function(response){
		       $window.location.reload();
		      });
		    };
	    
	    $scope.findOne = function() {
	      CommentFactory.get({
	        comment_id: $stateParams.comment_id
	      }, function(comment) {
	        $scope.comment = comment;
	      });
	    };
}]);
