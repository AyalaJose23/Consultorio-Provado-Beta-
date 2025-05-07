<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <style>
        /* Estilo para el contenedor del fondo */
        .background-container {
            background-image: url('/taller3/img/fondo4.png');
            background-size: cover; /* Ajusta la imagen al tamaño del contenedor */
            background-repeat: repeat; /* Repite la imagen cuando se agranda la pantalla */
            background-position: center; /* Centra la imagen */
            position: relative; /* Necesario para posicionar elementos dentro */
            height: 100vh; /* Ocupa toda la altura de la pantalla */
        }

        /* Estilo para el texto */
        .welcome-text {
            position: absolute;
            top: 50%; /* Centra verticalmente */
            left: 50%; /* Centra horizontalmente */
            transform: translate(-50%, -50%); /* Ajusta la posición al centro exacto */
            color: white; /* Texto en blanco */
            font-size: 2rem; /* Tamaño del texto */
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.7); /* Sombra para mayor visibilidad */
            text-align: center;
        }
    </style>
    <?php
    session_start();
    include "conexion.php";
    require 'estilos/css_lte.ctp';
    ?>
</head>
<body class="hold-transition skin-purple sidebar-mini">
    <div class="wrapper">
        <?php require 'estilos/cabecera.ctp'; ?>
        <?php require 'estilos/izquierda.ctp'; ?>
        <div class="content-wrapper">
            <section class="content-header">
                <section class="content">
                    <!-- Contenedor del fondo -->
                    <div class="background-container">
                        <!-- Texto de bienvenida sobre la imagen -->
                        <div class="welcome-text">
                            <h3>BIENVENIDO AL SISTEMA...</h3>
                        </div>
                    </div>
                </section>
            </section>
        </div>
    </div>  
    <?php require 'estilos/pie.ctp'; ?>
    <?php require 'estilos/js_lte.ctp'; ?><!--ARCHIVOS JS-->
</body>
</html>
