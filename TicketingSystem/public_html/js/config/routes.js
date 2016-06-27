app.config(function($stateProvider, $urlRouterProvider) {

	$urlRouterProvider.otherwise('/');

	$stateProvider

	.state('home', {
		url: '/',
		templateUrl: '../public_html/login.html'
	})
	.state('users', {
		url: '/users',
		templateUrl: '../public_html/users.html'
	})
	// ne postoje za sada pa redirektuje na '/' //
	.state('projects', {
		url: '/projects',
		templateUrl: '../public_html/projects.html'
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