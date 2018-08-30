<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand pull-right" href="#" onclick="loadPage('Dashboard.php')">پرستا</a>
    </div>
    <!-- Top Menu Items -->
    <ul class="nav navbar-right top-nav pull-left">
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <span id="lblFullName"></span>
                <b class="caret"></b>  <i class="fa fa-user"></i>
            </a>
            <ul class="dropdown-menu">
                <li>
                    <a href="#" id="btnLogout">خروج</a>
                </li>
            </ul>
        </li>
    </ul>
    <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav side-nav" id="sideNav">
            
        </ul>
    </div>
</nav>