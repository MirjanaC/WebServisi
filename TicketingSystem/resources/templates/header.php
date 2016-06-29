<div ng-controller="headerCtrl" class="container-fluid" data-brix_class="1466800444174">
    <div>
        <ul class="nav navbar-nav">
            <li class="active"><a href="#" data-brix_class="1466802309147" name="home" class="btn btn-link"><img src="images/ticket.png" width="25px" height="25px" /></a></li>
        </ul>
    </div>
    <ul class="nav navbar-nav navbar-right">
        <li class="dropdown" ng-show = "loggedUser.user_role=='admin'">
            <a span="" data-toggle="dropdown" href="#" data-brix_class="1466802392777" name="settings">Settings&nbsp;<span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
                <li><a href="#/projects">Projects</a></li>
                <li><a href="#/users">Users</a></li>
                <li><a href="#/tasks">Tasks</a></li>
            </ul>
        </li>
        <ul class="nav navbar-nav">
            <li class="active"><a ng-click="logout()" href="" class="glyphicon glyphicon-log-out" data-brix_class="1466802392777" name="logout">  Logout</a></li>
        </ul>
    </ul>
</div>
