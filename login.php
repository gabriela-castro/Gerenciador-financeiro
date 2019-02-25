<?php

session_start();


include 'config/funcoes.php';
include 'config/mysql.php';

$id_admin = (isset($_SESSION['id_admin'])) ? $_SESSION['id_admin'] : '';

if ($id_admin != NULL)
{
	header("location: sistema.php");
	exit;
}

?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
   <meta charset="utf-8" />
   <title>Login - <?php echo $sistema.' v. '.$versao; ?></title>
   <meta content="width=device-width, initial-scale=1.0" name="viewport" />
   <meta content="" name="description" />
   <meta content="" name="author" />
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
            <img src="img/logob.png" alt="<?php echo $sistema; ?>" style="max-width:250px;" class="center">
        <!-- END LOGO -->
    </div>
    <div class="login-wrap">
        <div class="metro single-size cinza">
            <div class="locked">
                <i class="icon-lock"></i>
                <span>Identificação</span>
            </div>
        </div>
        <form action="checar.php" method="post">
        <div class="metro double-size green">
                <div class="input-append lock-input">
                    <input type="text" class="" placeholder="Usuário" name="login">
                </div>
        </div>
        <div class="metro double-size green">
                <div class="input-append lock-input">
                    <input type="password" class="" placeholder="Senha" name="senha">
                </div>
        </div>
        <div class="metro single-size cinza login">
                <button type="submit" class="btn login-btn">
                    Entrar
                    <i class=" icon-long-arrow-right"></i>
                </button>
           
        </div> </form>
    </div>
</body>
<!-- END BODY -->
</html>