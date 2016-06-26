app.config(function($stateProvider, $urlRouterProvider) {

	$urlRouterProvider.otherwise('/');

	$stateProvider

	.state('login', {
		url: '/login',
		templateUrl: 'public_html/login.html'
	})
	.state('users', {
		url: '/users',
		templateUrl: 'public_html/users.html'
	});

});