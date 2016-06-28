<?php
/**
 * Created by PhpStorm.
 * User: Zoran Luledzija
 * Date: 25-Jun-16
 * Time: 9:31 PM
 */

use Psr\Http\Message\ResponseInterface;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface;

require '../vendor/autoload.php';
require '../resources/config.php';
require_once '../auth/Auth.php';

spl_autoload_register(function ($classname) {
    require ("dao/" . $classname . ".php");
});

$conf['displayErrorDetails'] = true;
$conf['db']['host']   = $config['db']['host'];
$conf['db']['user']   = $config['db']['username'];
$conf['db']['pass']   = $config['db']['password'];
$conf['db']['dbname'] = $config['db']['dbname'];

// Rest API
$app = new \Slim\App(["settings" => $conf]);

$container = $app->getContainer();
$container['view'] = new \Slim\Views\PhpRenderer("../templates/");
$container['logger'] = function($c) {
    $logger = new \Monolog\Logger('my_logger');
    $file_handler = new \Monolog\Handler\StreamHandler("../logs/app.log");
    $logger->pushHandler($file_handler);
    return $logger;
};
$container['db'] = function ($c) {
    $db = $c['settings']['db'];
    $pdo = new PDO("mysql:host=" . $db['host'] . ";dbname=" . $db['dbname'],
        $db['user'], $db['pass']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    return $pdo;
};

$app->add(function (ServerRequestInterface $request, ResponseInterface $response, callable $next) {
    // Check if is requested api/login
    $path = $request->getUri()->getPath();
    $method = $request->getMethod();

    $user_id = null;
    if (!($path == 'login' && $method == 'POST')) {
        if (isset($_COOKIE["ticketingSystem"])) {
            $token = $_COOKIE["ticketingSystem"];
            if (!empty($token)) {
                $auth = new Auth($this->db);
                $user_id = $auth->isLoggedIn($token);
            }
        }
        if ($user_id === null) {
            return $response->withStatus(401);
        }
    }

    return $next($request, $response);
});

#####################################################################
#                           REST API                                #
#####################################################################

#####################################################################
#                             LOGIN                                 #
// Login
$app->post('/login', function (Request $request, Response $response) {
    $this->logger->addInfo("Method: POST /login");

    $loginData = json_decode($request->getBody(), true);
    $email = $loginData['user_email'];
    $password = $loginData['user_password'];

    // Check email & password pair
    $userDao = new UsersDao($this->db);
    $user = $userDao->authenticate($email, $password);
    $token = null;
    if ($user != null) {
        // generate token
        $token = md5(uniqid(rand(), true));
        $auth = new Auth($this->db);
        $auth->logIn($token, $user['user_id']);
    }

    $response = $token;
    return $response;
});

// Logout
$app->delete('/logout', function (Request $request, Response $response) {
    $this->logger->addInfo("Method: DELETE /logout");

    $token = $_COOKIE["ticketingSystem"];
    $auth = new Auth($this->db);
    $auth->logOut($token);

    return $response;
});

#####################################################################
#                             USERS                                 #
// Fetch all users
$app->get('/logged_user', function (Request $request, Response $response) {
    $this->logger->addInfo("Method: GET /logged_user");

    $token = $_COOKIE["ticketingSystem"];
    $auth = new Auth($this->db);
    $user_id = $auth->isLoggedIn($token);

    $usersDao = new UsersDao($this->db);
    $user = $usersDao->fetchById($user_id);
    $response = json_encode($user);
    return $response;
});


// Fetch all users
$app->get('/users', function (Request $request, Response $response) {
    $this->logger->addInfo("Method: GET /users");

    $usersDao = new UsersDao($this->db);
    $users = $usersDao->fetchAll();
    $response = json_encode($users);
    return $response;
});

// Fetch user by ID
$app->get('/users/{id}', function (Request $request, Response $response) {
    $this->logger->addInfo("Method: GET /users/{id}");
    $id = $request->getAttribute('id');

    $usersDao = new UsersDao($this->db);
    $user = $usersDao->fetchById($id);
    $response = json_encode($user);
    return $response;
});

// Delete user by ID
$app->delete('/users/{id}', function (Request $request, Response $response) {
    $this->logger->addInfo("Method: DELETE /users/{id}");
    $id = $request->getAttribute('id');

    $usersDao = new UsersDao($this->db);
    $usersDao->delete($id);
    return $response;
});

// Edit user
$app->put('/users', function (Request $request, Response $response) {
    $this->logger->addInfo("Method: POST /users");
    $user = json_decode($request->getBody(), true);

    $usersDao = new UsersDao($this->db);
    $usersDao->update($user);
    return $response;
});

// Add new user
$app->post('/users', function (Request $request, Response $response) {
    $this->logger->addInfo("Method: POST /users");
    $user = json_decode($request->getBody(), true);

    $usersDao = new UsersDao($this->db);
    $usersDao->save($user);
    return $response;
});

#####################################################################
#                             TASKS                                 #
// Fetch all tasks
$app->get('/tasks', function (Request $request, Response $response) {
    $this->logger->addInfo("Method: GET /tasks");

    $tasksDao = new TasksDao($this->db);
    $tasks = $tasksDao->fetchAll();
    $response = json_encode($tasks);
    return $response;
});

// Fetch task by ID
$app->get('/tasks/{id}', function (Request $request, Response $response) {
    $this->logger->addInfo("Method: GET /tasks/{id}");
    $id = $request->getAttribute('id');

    $tasksDao = new TasksDao($this->db);
    $task = $tasksDao->fetchById($id);
    $response = json_encode($task);
    return $response;
});

// Delete task by ID
$app->delete('/tasks/{id}', function (Request $request, Response $response) {
    $this->logger->addInfo("Method: DELETE /tasks/{id}");
    $id = $request->getAttribute('id');

    $tasksDao = new TasksDao($this->db);
    $tasksDao->delete($id);
    return $response;
});

// Edit task
$app->put('/tasks', function (Request $request, Response $response) {
    $this->logger->addInfo("Method: POST /tasks");
    $task = json_decode($request->getBody(), true);

    $tasksDao = new TasksDao($this->db);
    $tasksDao->update($task);
    return $response;
});

// Add new task
$app->post('/tasks', function (Request $request, Response $response) {
    $this->logger->addInfo("Method: POST /tasks");
    $task = json_decode($request->getBody(), true);

    $tasksDao = new TasksDao($this->db);
    $tasksDao->save($task);
    return $response;
});

#####################################################################
#                            PROJECTS                               #
// Fetch all projects
$app->get('/projects', function (Request $request, Response $response) {
    $this->logger->addInfo("Method: GET /projects");

    $projectsDao = new ProjectsDao($this->db);
    $projects = $projectsDao->fetchAll();
    $response = json_encode($projects);
    return $response;
});

// Fetching users working on project 
$app->get('/projectsUsername/{id}', function (Request $request, Response $response) {
    $this->logger->addInfo("Method: GET /projectsUsername/{id}");
    $id = $request->getAttribute('id');

    $projectsDao = new ProjectsDao($this->db);
    $projects = $projectsDao->fetchNamesOfUsersWorkingOnProject($id);
    $response = json_encode($projects);
    return $response;
});

//
$app->get('/projectsTasks/{id}', function (Request $request, Response $response) {
    $this->logger->addInfo("Method: GET /projectsTasks/{id}");
    $id = $request->getAttribute('id');

    $projectsDao = new ProjectsDao($this->db);
    $projects = $projectsDao->fetchTasksOnProject($id);
    $response = json_encode($projects);
    return $response;
});

// Fetch project by ID
$app->get('/projects/{id}', function (Request $request, Response $response) {
    $this->logger->addInfo("Method: GET /projects/{id}");
    $id = $request->getAttribute('id');

    $projectsDao = new ProjectsDao($this->db);
    $project = $projectsDao->fetchById($id);
    $response = json_encode($project);
    return $response;
});

// Delete project by ID
$app->delete('/projects/{id}', function (Request $request, Response $response) {
    $this->logger->addInfo("Method: DELETE /projects/{id}");
    $id = $request->getAttribute('id');

    $projectsDao = new ProjectsDao($this->db);
    $projectsDao->delete($id);
    return $response;
});

// Edit project
$app->put('/projects', function (Request $request, Response $response) {
    $this->logger->addInfo("Method: POST /projects");
    $project = json_decode($request->getBody(), true);

    $projectsDao = new ProjectsDao($this->db);
    $projectsDao->update($project);
    return $response;
});

// Add new project
$app->post('/projects', function (Request $request, Response $response) {
    $this->logger->addInfo("Method: POST /projects");
    $user = json_decode($request->getBody(), true);

    $projectsDao = new ProjectsDao($this->db);
    $projectsDao->save($user);
    return $response;
});

#####################################################################
#                            COMMENTS                               #
// Fetch all comments
$app->get('/comments', function (Request $request, Response $response) {
    $this->logger->addInfo("Method: GET /comments");

    $commentsDao = new CommentsDao($this->db);
    $comments = $commentsDao->fetchAll();
    $response = json_encode($comments);
    return $response;
});

// Fetch comment by ID
$app->get('/comments/{id}', function (Request $request, Response $response) {
    $this->logger->addInfo("Method: GET /comments/{id}");
    $id = $request->getAttribute('id');

    $commentsDao = new CommentsDao($this->db);
    $comment = $commentsDao->fetchById($id);
    $response = json_encode($comment);
    return $response;
});

// Delete comment by ID
$app->delete('/comments/{id}', function (Request $request, Response $response) {
    $this->logger->addInfo("Method: DELETE /comments/{id}");
    $id = $request->getAttribute('id');

    $commentsDao = new CommentsDao($this->db);
    $commentsDao->delete($id);
    return $response;
});

// Edit comment
$app->put('/comments', function (Request $request, Response $response) {
    $this->logger->addInfo("Method: POST /comments");
    $project = json_decode($request->getBody(), true);

    $commentsDao = new CommentsDao($this->db);
    $commentsDao->update($project);
    return $response;
});

// Add new comment
$app->post('/comments', function (Request $request, Response $response) {
    $this->logger->addInfo("Method: POST /comments");
    $user = json_decode($request->getBody(), true);

    $commentsDao = new CommentsDao($this->db);
    $commentsDao->save($user);
    return $response;
});

$app->run();