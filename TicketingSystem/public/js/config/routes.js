app.config(function($stateProvider, $urlRouterProvider) {

	$urlRouterProvider.otherwise('/');

	$stateProvider

	.state('home', {
		url: '/',
		templateUrl: '../public/login.html'
	})
	.state('dashboard', {
		url: '/dashboard',
		templateUrl: '../public/index.php'
	})
	.state('users', {
		url: '/users',
		templateUrl: '../public/users.html'
	})
	.state('createuser', {
		url: '/createuser',
		templateUrl: '../public/createUser.html',
		controller: 'userCtrl'
	})
	.state('projects', {
		url: '/projects',
		templateUrl: '../public/projects.html'
	})
	.state('createproject', {
		url: '/createproject',
		templateUrl: '../public/createProject.html',
		controller: 'projectCtrl'
	})
	.state('tasks', {
		url: '/tasks',
		templateUrl: '../public/tasks.html'
	})
	.state('comments', {
		url: '/comments',
		templateUrl: '../public/comments.html'
	})
	.state('editUser', {
	    url:'/users/:user_id/edit',
	    templateUrl: '../public/editUser.html'
	 });

});