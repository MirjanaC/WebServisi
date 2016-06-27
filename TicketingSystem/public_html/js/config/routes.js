app.config(function($stateProvider, $urlRouterProvider) {

	$urlRouterProvider.otherwise('/');

	$stateProvider

	.state('home', {
		url: '/',
		templateUrl: '../public_html/login.html'
	})
	.state('dashboard', {
		url: '/dashboard',
		templateUrl: '../public_html/index.php'
	})
	.state('users', {
		url: '/users',
		templateUrl: '../public_html/users.html'
	})
	.state('createuser', {
		url: '/createuser',
		templateUrl: '../public_html/createUser.html',
		controller: 'userCtrl'
	})
	.state('projects', {
		url: '/projects',
		templateUrl: '../public_html/projects.html'
	})
	.state('createproject', {
		url: '/createproject',
		templateUrl: '../public_html/createProject.html',
		controller: 'projectCtrl'
	})
	.state('tasks', {
		url: '/tasks',
		templateUrl: '../public_html/tasks.html'
	})
	.state('comments', {
		url: '/comments',
		templateUrl: '../public_html/comments.html'
	});

});