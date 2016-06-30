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
        <title>Register</title>
        <!-- Bootstrap core CSS -->
        <link href="https://netdna.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet">
                        
        <!-- User -->
        <link href="css/style-auto.css" rel="stylesheet">
        
    </head>
    <body data-brix_class="1466797764013" ng-app = "myApp">
       <section ng-controller="registerCtrl">
        <h1 style="align:center">Registration</h1>
    <form name="userForm" ng-submit="register(userForm.$valid)" novalidate>
        <div>
            <div class="row" data-brix_class="1466801424887">
                <div class="col-md-2" data-brix_class="1466801408662">
                    <span class="col-md-10" data-brix_class="1466800797345" name="name">Name</span>
                    <span class="col-md-10" data-brix_class="1466800875659" name="surname">Surname</span>
                    <span class="col-md-10" data-brix_class="1466800981358" name="email">Email</span>
                    <span class="col-md-10" data-brix_class="1466801006952" name="password">Password</span>
                    <span class="col-md-10" data-brix_class="1466801006952" name="password2">Repeat password</span>
                </div>
                
                <div class="col-md-6">
                    <div class="form-group" ng-class="{ 'has-error' : submitted && userForm.name.$invalid }">
                        <input name="name" type="text" ng-model="data.name"  class="form-control" data-brix_class="1466801214715" required="true">
                            <div ng-show="submitted && userForm.name.$invalid" class="help-block">
                                <p ng-show="userForm.name.$error.required">User name is required!</p>
                            </div>
                    </div>
                    <div class="form-group" ng-class="{ 'has-error' : submitted && userForm.surname.$invalid }">
                        <input type="text" name="surname" ng-model="data.surname" class="form-control" data-brix_class="1466801257042" required="true">
                            <div ng-show="submitted && userForm.surname.$invalid" class="help-block">
                                <p ng-show="userForm.surname.$error.required">User surname is required</p>
                            </div>
                    </div>
                    <div class="form-group" ng-class="{ 'has-error' : submitted && userForm.email.$invalid }">
                        <input type="email" name="email" ng-model="data.email" class="form-control" data-brix_class="1466801267231" required="true">
                            <div ng-show="submitted && userForm.surname.$invalid" class="help-block">
                                <p ng-show="userForm.surname.$error.required">User email is required</p>
                            </div>
                    </div>
                     <div class="form-group" ng-class="{ 'has-error' : submitted && userForm.password.$invalid }">
                        <input type="password" name="password" ng-model="data.password" class="form-control" data-brix_class="1466801277136" required="true" ng-match="password2">
                            <div ng-show="submitted && userForm.password.$invalid" class="help-block">
                                <p ng-show="userForm.password.$error.required">User password is required</p>
                            </div>
                    </div>
                     <div class="form-group" ng-class="{ 'has-error' : submitted &&  !userForm.password2.$valid}">
                        <input type="password" name="password2" ng-model="data.password2" class="form-control" data-brix_class="1466801277136" required="true" ng-match="data.password">
                            <div ng-show="submitted && userForm.password2.$invalid" class="help-block">
                                <p ng-show="userForm.password2.$error.required">User password is required</p>
                            </div>
                            <div ng-show="!userForm.password2.$valid" class="help-block">
                             <p ng-show="userForm.password2.$error.match">Passwords do not match.</p>
                             </div>

                    </div>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-default" data-brix_class="1466801549135">Register&nbsp;</button>
       </form>
</section>


        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.7/angular.min.js"></script>
        <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/angularjs/1.5.7/angular-cookies.min.js"></script>
        <!-- node modules -->
        <script type="text/javascript" src="node_modules/angular-ui-router/release/angular-ui-router.min.js"></script>
        <script type="text/javascript" src="node_modules/angular-resource/angular-resource.min.js"></script>
        <script type="text/javascript" src="node_modules/chart.js/Chart.min.js"></script>
        <script type="text/javascript" src="node_modules/angular-chart.js/dist/angular-chart.min.js"></script>
        <script type="text/javascript" src="js/app.js"></script>
        <script type="text/javascript" src="js/controller/userController.js"></script>
        <script type="text/javascript" src="js/service/userService.js"></script>
    
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://netdna.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>

  </body>
</html>