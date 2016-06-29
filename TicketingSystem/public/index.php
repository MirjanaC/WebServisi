<?php
/**
 * Created by PhpStorm.
 * User: Zoran Luledzija
 * Date: 25-Jun-16
 * Time: 9:09 AM
 */

// load up your config file
require_once(realpath(dirname(__FILE__) . "/../resources/config.php"));
require_once '../auth/Auth.php';

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
    <!-- node modules -->
    <script type="text/javascript" src="node_modules/angular-ui-router/release/angular-ui-router.min.js"></script>
    <script type="text/javascript" src="node_modules/angular-resource/angular-resource.min.js"></script>

    <script type="text/javascript" src="js/app.js"></script>
    <!-- services -->
    <script type="text/javascript" src="js/service/headerService.js"></script>
    <script type="text/javascript" src="js/service/userService.js"></script>
    <script type="text/javascript" src="js/service/projectService.js"></script>
    <script type="text/javascript" src="js/service/taskService.js"></script>

    <!-- controllers -->
    <script type="text/javascript" src="js/controller/headerController.js"></script>
    <script type="text/javascript" src="js/controller/userController.js"></script>
    <script type="text/javascript" src="js/controller/projectController.js"></script>
    <script type="text/javascript" src="js/controller/taskController.js"></script>

     <!-- node modules -->
    <script type="text/javascript" src="js/config/routes.js"></script>

    <link href="https://netdna.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet">
    
                    
    <!-- User -->
    <link href="css/signin.css" rel="stylesheet">
    <link href="css/style-auto.css" rel="stylesheet">
    
    
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://netdna.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
        
    <style type="text/css"></style><style type="text/css"></style><style type="text/css"></style><style type="text/css"></style><style type="text/css"></style><style type="text/css"></style><style type="text/css"></style><style type="text/css"></style><style type="text/css"></style><style type="text/css"></style><style type="text/css"></style><style type="text/css"></style><style type="text/css"></style><style type="text/css"></style><style type="text/css"></style><style type="text/css"></style><style type="text/css"></style><style type="text/css"></style><style type="text/css"></style><style type="text/css"></style><style type="text/css"></style><style type="text/css"></style><style type="text/css"></style><style type="text/css"></style><style type="text/css"></style><style type="text/css"></style>
    <!-- END styling pages -->
    
</head>

    <body ng-app = "myApp" data-brix_class="1466799338091">
        <div>

        <?php require_once(TEMPLATES_PATH . "/header.php"); ?>
        
       
        <div ui-view>
        </div>

        

        <?php require_once(TEMPLATES_PATH . "/footer.php"); ?>
        </div>

    </body>
</html>
