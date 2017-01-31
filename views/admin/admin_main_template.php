<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Admin</title>

    <link rel="stylesheet" href="/views/lib/bootstrap-3.3.7-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/views/css/admin.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="/views/lib/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
    <script src="/views/javascript/admin.js"></script>
</head>
<body>
<header>
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main-navbar" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse" id="main-navbar">
                <ul class="nav navbar-nav main-nav">
                    <li><a href="/admin/users">Users</a></li>
                    <li><a href="/admin/group">Group</a></li>
                    <li><a href="/admin/resource">Resource</a></li>
                    <li><a href="/admin/access">Access</a></li>
                    <li><a href="/admin/activity">Activity log</a></li>
                    <li><a href="/admin/log_group">Group log</a></li>
                    <li><a href="/admin/reports">Reports</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a>You <?=$param['user_type']?></a></li>
                    <li><a id="logout_btn" href="/admin/logout"><span class="glyphicon glyphicon-log-out"></span> Exit</a></li>
                </ul>
            </div>
        </div>
    </nav>
</header>
<main>
    <div class="container">
        <?php
        foreach ($this->content as $key){
            include $key;
        }
        ?>
    </div>

</main>
</body>
</html>