<?php

require_once '../auth/Auth.php';
require_once(realpath(dirname(__FILE__) . "/../resources/config.php"));

// Check if user is logged-in
$user_id = null;
if (isset($_COOKIE["ticketingSystem"])) {
    $token = $_COOKIE["ticketingSystem"];
    if (!empty($token)) {
        $pdo = new PDO("mysql:host=" . $config['db']['host'] . ";dbname=" . $config['db']['dbname'],
            $config['db']['username'], $config['db']['password']);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $auth = new Auth($pdo);
        $user_id = $auth->isLoggedIn($token);
    }
}
if ($user_id !== null) {
    header("Location: " . INDEX_PAGE);
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="favicon.ico">
        <title>Login</title>
        <!-- Bootstrap core CSS -->
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://maxcdn.bootstrapcdn.com/bootswatch/3.2.0/superhero/bootstrap.min.css" rel="stylesheet" data-mbcode_theme="true">

        <!-- Custom styles for this template -->
        <link href="css/signin.css" rel="stylesheet">
        <link href="css/style-auto.css" rel="stylesheet">
    </head>
    <body data-brix_class="1466797764013" ng-app = "myApp">
        <div class="container" ng-controller = "loginController">
            <form class="form-signin text-center" role="form">
                <h2 class="form-signin-heading" data-brix_class="1466797919220">Please sign in</h2>
                <input type="email" ng-model="user_email" class="form-control text-left" placeholder="Email address" required="" autofocus="" data-brix_class="1466797867149">
                <input type="password" ng-model="user_password" class="form-control text-left" placeholder="Password" required="" data-brix_class="1466797887560">
                <button ng-click="login()" class="btn btn-lg btn-primary btn-block" type="submit" data-brix_class="1466797946433">Sign in</button>
            </form>
        </div>

        <!-- Placed at the end of the document so the pages load faster -->
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.7/angular.min.js"></script>
        <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/angularjs/1.5.7/angular-cookies.min.js"></script>
        <!-- node modules -->
        <script type="text/javascript" src="node_modules/angular-ui-router/release/angular-ui-router.min.js"></script>
        <script type="text/javascript" src="node_modules/angular-resource/angular-resource.min.js"></script>
        <script type="text/javascript" src="js/app.js"></script>
        <script type="text/javascript" src="js/controller/loginController.js"></script>
  </body>
</html>