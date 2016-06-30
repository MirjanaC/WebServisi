app.config(function($stateProvider, $urlRouterProvider) {

	$urlRouterProvider.otherwise('/');

	$stateProvider

	.state('dashboard', {
		url: '/',
		templateUrl: '../public/tasks.html'
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
	.state('createtask', {
		url: '/createtask',
		templateUrl: '../public/createTask.html',
		controller: 'taskCtrl'
	})
	.state('teams', {
		url: '/teams',
		templateUrl: '../public/teams.html',
		controller: 'teamCtrl'
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
	 })
	.state('editProject', {
	    url:'/projects/:project_id/edit',
	    templateUrl: '../public/editProject.html'
	 })
	.state('editTask', {
	    url:'/tasks/:task_id/edit',
	    templateUrl: '../public/editTask.html'
	 })
	.state('findProject', {
	    url:'/tasks/:project_id',
	    templateUrl: '../public/tasks.html'
	 })
	.state('getUsernames', {
		url: '/projectsUsername/:project_id',
		templateUrl: '../public/projectsUsers.html'
	})
	.state('getTasks', {
		url: '/projectsTasks/:project_id',
		templateUrl: '../public/projectsTasks.html'
	})
	.state('reports', {
		url: '/reports/:project_id',
		templateUrl: '../public/reports.html'
	})
	.state('taskReport', {
		url: '/taskReport/:project_id',
		templateUrl: '../public/taskReport.html'
	});
});