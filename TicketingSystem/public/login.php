<?php
    require_once '../auth/Auth.php';
    require_once(realpath(dirname(__FILE__) . "/../resources/config.php"));

    // Check if user is logged-in
    $token = $_SERVER["HTTP_AUTHORIZATION"];
    $auth = new Auth($config);
    $user_id = $auth->isLoggedIn($token);
    if ($user_id != null) {
        $index_page = INDEX_PAGE;
        header("Location: $index_page");
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
    <body data-brix_class="1466797764013">
        <div class="container">
            <form class="form-signin text-center" role="form">
                <h2 class="form-signin-heading" data-brix_class="1466797919220">Please sign in</h2>
                <input type="email" class="form-control text-left" placeholder="Email address" required="" autofocus="" data-brix_class="1466797867149">
                <input type="password" class="form-control text-left" placeholder="Password" required="" data-brix_class="1466797887560">
                <button class="btn btn-lg btn-primary btn-block" type="submit" data-brix_class="1466797946433">Sign in</button>
            </form>
        </div>

        <!-- Placed at the end of the document so the pages load faster -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
  </body>
</html>