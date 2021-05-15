<?php
include_once ('inc/main.php');

$loginError = '';

if (isset($_POST['do_login'])) {
    $user = (!empty($_POST['user'])) ? $db->escape($_POST['user']) : '';
    $password = (!empty($_POST['password'])) ? md5($db->escape($_POST['password'])) : '';

    $login = do_login($user, $password);

    if (!$login) {
        $loginError = 'Error al iniciar sesión, usuario o contraseña incorrectos';
    }
    else {
        header('location: index.php');
    }
}
?>
<!DOCTYPE html>
<html dir="ltr" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex,nofollow">
    <title>
        Ingenieria de software
    </title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="plugins/images/favicon.png">
    <!-- Custom CSS -->
    <link href="plugins/bower_components/chartist/dist/chartist.min.css" rel="stylesheet">
    <link rel="stylesheet" href="plugins/bower_components/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.css">
    <!-- Custom CSS -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body class="container">

<div class="row">
    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
        <div class="white-box">
            <div class="loginBox">
                <div class="text-center"><h3 class="box-title">Iniciar sesión</h3></div>
                <form action="login.php" method="POST" class="form-horizontal form-material">
                    <div class="text-danger p-2 text-center">
                        <?php print $loginError ?>
                    </div>
                    <div class="form-group mb-4">
                        <label class="col-md-12 p-0">
                            <b>Usuario</b>
                        </label>
                        <div class="col-md-12 border-bottom p-0">
                            <input type="text" placeholder="Escriba aquí" class="form-control p-0 border-0" name="user"/>
                        </div>
                    </div>
                    <div class="form-group mb-4">
                        <label class="col-md-12 p-0">
                            <b>Contraseña</b>
                        </label>
                        <div class="col-md-12 border-bottom p-0">
                            <input type="password" value="" class="form-control p-0 border-0" placeholder="Escriba aquí" name="password"/>
                        </div>
                    </div>
                    <div class="form-group mb-4">
                        <div class="col-sm-12 text-center">
                            <button name="do_login" class="btn btn-success">Iniciar Sesión</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<footer class="footer text-center">
    2021 © Ingenieria de software - UMG
</footer>

<script src="plugins/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap tether Core JavaScript -->
<script src="bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="js/app-style-switcher.js"></script>
<script src="plugins/bower_components/jquery-sparkline/jquery.sparkline.min.js"></script>
<!--Wave Effects -->
<script src="js/waves.js"></script>
<!--Menu sidebar -->
<script src="js/sidebarmenu.js"></script>
<!--Custom JavaScript -->
<script src="js/custom.js"></script>
<!--This page JavaScript -->
<!--chartis chart-->
<script src="plugins/bower_components/chartist/dist/chartist.min.js"></script>
<script src="plugins/bower_components/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js"></script>
<script src="js/pages/dashboards/dashboard1.js"></script>
</body>

</html>