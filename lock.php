<?php

include 'config/mysql.php';
include 'config/funcoes.php';
include 'config/check.php';

?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="pt"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
   <meta charset="utf-8" />
   <title>Lock Screen</title>
   <meta content="width=device-width, initial-scale=1.0" name="viewport" />
   <meta content="" name="description" />
   <meta content="Sistema Financeiro" name="author" />
   <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
   <link href="assets/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" />
   <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
   <link href="css/style.css" rel="stylesheet" />
   <link href="css/style-responsive.css" rel="stylesheet" />
   <link href="css/style-default.css" rel="stylesheet" id="style_color" />
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="lock">
    <div class="lock-header">
        <!-- BEGIN LOGO -->
        <a class="center" id="logo" href="index.html">
            <img class="center" alt="logo" src="img/logo.png">
        </a>
        <!-- END LOGO -->
    </div>
    <div class="lock-wrap"> <!--
        <div class="metro single-size gray">
            <img src="img/lock-thumb.jpg" alt="" style="height: 165px" >
        </div>-->
        <div class="metro double-size blue">
            <h1><?php echo $nome_admin; ?></h1>
            <p><?php echo $email_admin; ?></p>
        </div>
        <div class="metro double-size green">
            <form action="http://thevectorlab.net/metrolab/index.html">
                <div class="input-append lock-input">
                    <input type="password" class="" name="senha" placeholder="Senha">
                    <button type="submit" class="btn tarquoise"><i class=" icon-arrow-right"></i></button>
                </div>
            </form>
        </div>
        <div class="metro double-size red">
            <div class="locked"><br><br>
                <i class="icon-lock"></i><br>
                <span>Bloqueado</span>
            </div>
        </div><!--
        <div class="metro double-size gray ">
            <a href="login.html" class="user-position">
                <i class="icon-user"></i>
                <span>Trocar de usuário</span>
            </a>
        </div>-->
        <div class="metro double-size orange">
            <a href="sair.php" class="user-position">
                <i class="icon-key"></i>
                <span>Trocar de usuário</span>
            </a>
        </div>
    </div>
</body>
<!-- END BODY -->
</html>