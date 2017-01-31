<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?=SITE_NAME?></title>

    <link rel="stylesheet" href="/views/lib/bootstrap-3.3.7-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/views/css/main.css">
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="/views/lib/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
    <script src="/views/javascript/script.js"></script>
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
                        <li><a href="/main">Home</a></li>
                        <li><a href="/resources">Resources</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a id="signup_btn" href="" data-toggle="modal" data-target="#modal-signup"><span class="glyphicon glyphicon-edit"></span> Sign Up</a></li>
                        <li><a id="login_btn" href="" data-toggle="modal" data-target="#modal-login"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                        <li><a id="logout_btn" href="/main/logout"><span class="glyphicon glyphicon-log-out"></span> Exit</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <div class="banner">
        <a href="/resources" class="btn btn-primary">Посмотреть все курсы</a>
    </div>
    <main>
        <?php
        foreach ($this->content as $key){
            include $key;
        }
        ?>
    </main>
    <div id="modal-signup" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modal-title">Sign Up</h4>
                </div>
                <div class="modal-body">
                    <form action="/main/registryuser" method="post" id="form-signup">
                        <div class="form-group">
                            <input type="text" class="form-control" name="user_login" value="" placeholder="*Login" required maxlength="20" pattern="[a-zA-Z0-9_-]+">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="user_email" value="" placeholder="*Email" required pattern="[a-z0-9_-]+@[a-z0-9-]+\.([a-z]{1,6}\.)?[a-z]{2,6}">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="user_fio" value="" placeholder="*Full name" required pattern="[а-яА-ЯёЁa-zA-Z ]+">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="user_phone" value="" placeholder="Phone" pattern="[+0-9]+">
                        </div>
                        <div class="form-group">
                            <input type="date" class="form-control" name="user_date_birth" value="" >
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="user_password" value="" placeholder="*Password" required pattern="[a-zA-Z0-9]{4,20}">
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default" type="button" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" type="submit" form="form-signup">Sign Up</button>
                </div>
            </div>
        </div>
    </div>
    <div id="modal-login" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modal-title">Login</h4>
                </div>
                <div class="modal-body">
                    <form action="" method="post" id="form-login">
                        <div class="form-group">
                            <input type="text" class="form-control" name="user_login" value="" placeholder="Your login" required>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="user_password" value="" placeholder="Your password" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default" type="button" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" type="submit" form="form-login">Login</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('#form-login').on('submit',function(e){
            e.preventDefault();
            var data_input= $('#form-login').serialize();
            $.ajax({
                url: "/main/login",
                data: data_input,
                type: 'POST',
                success : function (data){
                    if(data==false){
                        $('#form-login').find('input').each(function(){
                            $(this).val('');
                        });
                        $('#modal-login .modal-body').append("<div class='alert alert-warning text-center'>Неверный логин или пароль</div>");
                    }
                    else location.reload();
                }
            });
        });
    </script>
</body>
</html>