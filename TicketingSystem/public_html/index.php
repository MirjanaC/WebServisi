<?php
/**
 * Created by PhpStorm.
 * User: Zoran Luledzija
 * Date: 25-Jun-16
 * Time: 9:09 AM
 */

// load up your config file
require_once(realpath(dirname(__FILE__) . "/../resources/config.php"));
?>
<html>
<head>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.7/angular.min.js"></script>
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
