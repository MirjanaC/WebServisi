<?php
/**
 * Created by PhpStorm.
 * User: Zoran Luledzija
 * Date: 25-Jun-16
 * Time: 9:09 AM
 */

require_once '../auth/Auth.php';
require_once(realpath(dirname(__FILE__) . "/../resources/config.php"));

// Check if user is logged-in
$user_id = null;
if (isset($_COOKIE["ticketingSystem"])) {
    $token = $_COOKIE['ticketingSystem'];
    if (!empty($token)) {
        $pdo = new PDO("mysql:host=" . $config['db']['host'] . ";dbname=" . $config['db']['dbname'],
            $config['db']['username'], $config['db']['password']);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $auth = new Auth($pdo);
        $user_id = $auth->isLoggedIn($token);
    }
}
if ($user_id === null) {
    header("Location: " . LOGIN_PAGE);
    exit;
}
?>

<html>
<head>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.7/angular.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.5.7/angular-cookies.min.js"></script>
    <script type="text/javascript" src="js/app.js"></script>
    <script type="text/javascript" src="js/controller/MainController.js"></script>
</head>
</head>
    <body ng-app = "myApp">
        <div class = "main" ng-controller = "MainController">

        <?php require_once(TEMPLATES_PATH . "/header.php"); ?>
        
        <h1>{{ title }}</h1>

        <?php require_once(TEMPLATES_PATH . "/footer.php"); ?>
        </div>

    </body>
</html>
