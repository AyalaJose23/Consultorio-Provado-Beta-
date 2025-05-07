<?php
session_start();
if ($_SESSION) {
    session_destroy();
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Acceso al Sistema</title>
        <link rel="shortcut icon" type="image/x-icon" href="/taller3/img/abm.png">
        <meta name="viewport" content="width=device-width,initial-scale=1, user-scalable=no"> 
        <?php require 'estilos/css_lte.ctp'; ?>
        <style>
            body {
                padding-top: 100px;
                padding-bottom: 50px;
                background: url('/taller3/img/fondo.png') no-repeat center center fixed;
                background-size: cover;
                font-family: 'Arial', sans-serif;
            }
            .login {
                max-width: 300px;
                padding: 10px;
                margin: 0 auto;
            }
            #sha {
                max-width: 350px;
                box-shadow: 0px 0px 18px 2px rgba(80, 50, 50, 0.48);
                border-radius: 10px;
                padding: 20px;
                background-color: rgba(255, 255, 255, 0.9);
            }
            #avatar {
                width: 100px;
                height: 100px;
                margin: 0px auto 10px;
                display: block;
                border-radius: 50%;
                border: 3px solid #AEABFF;
            }
            .centered-text {
                text-align: center;
                font-family: 'Georgia', serif';
                font-size: 1.2em;
                color: #333;
                margin-top: 10px;
            }
            .centered-text span {
                font-weight: bold;
                color: #008CBA;
            }
            .btn-primary {
                background-color: #008CBA;
                border-color: #007BB5;
                padding: 10px;
                font-size: 1em;
                border-radius: 5px;
            }
            .btn-primary:hover {
                background-color: #005F8C;
                border-color: #004C73;
            }
            .help-block a {
                text-decoration: none;
                color: #008CBA;
            }
            .help-block a:hover {
                color: #005F8C;
                text-decoration: underline;
            }
        </style>
    </head>
    <body>
        <div class="container well" id="sha">
            <div class="row">
                <div class="col-xs-12">
                    <img class="img-responsive" src="/taller3/img/abm3.png" id="avatar">
                    <div class="centered-text">CENTRO MÉDICO <span>VIDA Y AMOR</span></div>
                </div>
            </div>
            <form class="login" action="acceso.php" method="post">
                <div class="form-group has-feedback">
                    <input type="text" name="usuario" class="form-control" placeholder="Ingrese nombre de usuario" required autofocus>
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" name="pass" class="form-control" placeholder="Ingrese su contraseña" required>
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>                
                <button class="btn btn-lg btn-primary btn-block" type="submit">Iniciar Sesión</button>
                <div class="checkbox text-center" style="padding: 10px 0;"> 
                    <p class="help-block"><a href="mailto:soporte@tallermedico.com?subject=Problema%20de%20acceso%20al%20sistema&body=Por%20favor%2C%20describa%20su%20problema%20aquí">¿No puede ingresar a su cuenta?</a></p> 
                </div>
                <!--Mensaje-->
                <?php if (!empty($_SESSION['error'])) { ?>
                    <div class="alert alert-danger" role="alert">
                        <span class="glyphicon glyphicon-info-sign"></span>
                        <?php echo $_SESSION['error'] ?>
                    </div>
                <?php } ?>
                <!--Mensaje-->
            </form>
        </div>
        <?php require 'estilos/js_lte.ctp'; ?>
    </body>
</html>
