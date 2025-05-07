<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="shortcut icon" type="image/x-icon" href="/taller3/img/abm.png">
        <title>Agregar Ficha</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

        <!-- Agrega tus estilos CSS personalizados aquí si es necesario -->
        <?php session_start();  include "../../conexion.php";
                            require '../../estilos/css_lte.ctp'; ?>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    </head>
    <body class="hold-transition skin-purple sidebar-mini">
        <div class="wrapper">
        <?php require '../../estilos/cabecera.ctp'; ?>
        <?php require '../../estilos/izquierda.ctp'; ?>
        <div class="content-wrapper">
        <div class="container">
            <div class="content">
                <div class="row">
                    <!--impresion del titulo de la pagina-->
                    <div class="col-lg-12">
                    <h3 class="page-header text-center" style="background-color: rgba(147, 112, 219, 0.5); color: #800080;"> 
                        <strong>AÑADIR FICHA MÉDICA</strong>
                        <a href="ficha_index.php" 
                        class="btn btn-purple pull-right" 
                        rel='tooltip' title="Atras">
                            <i class="glyphicon glyphicon-arrow-left"></i>
                        </a> 
                    </h3>
                </div>
   
                </div>
                
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <strong>Agregar Ficha Médica</strong>
                            </div>
                            <div class="panel-body">
                                    <form action="ficha_control.php" method="post">
                                        <input type="text" name="accion" value="1" hidden>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <!-- Columna izquierda -->
                                                <div class="form-group">
                                                    <label for="vcod_pacientes">Pacientes:</label>
                                                    <?php
                                                    $pacientes = consultas::get_datos("SELECT * FROM v_pacientes ORDER BY cod_pacientes");
                                                    ?>
                                                    <select class="form-control" name="vcod_pacientes" required>
                                                        <option value="">Seleccionar Pacientes</option>
                                                        <?php foreach ($pacientes as $pac) : ?>
                                                            <option value="<?php echo $pac['cod_pacientes']; ?>"><?php echo $pac['paciente']; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                                

                                            </div>
                                            <div class="col-md-6">
                                                <!-- Columna derecha -->

                                            </div>
                                        </div>

                                        <div class="form-group" style="text-align: center;"> <!-- Centra el contenido horizontalmente -->
                                            <button type="submit" class="btn btn-purple" style="float: left;">Agregar detalle</button> <!-- Alinea a la izquierda con 'float' -->
                                            <a href="ficha_index.php" class="btn btn-default" style="float: right;">Cancelar</a> <!-- Alinea a la derecha con 'float' -->
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                    </div>
                </section>
            </div>
            <?php require '../../estilos/pie.ctp'; ?><!--ARCHIVOS JS-->        
        </div>
        <script>
            // Función para mostrar el mensaje inicial
            function mostrarMensajeInicial() {
                $('#mensaje-inicial').show();
            }

            $(document).ready(function () {
                mostrarMensajeInicial(); // Muestra el mensaje inicial al abrir la página

                $('#agen_fecha, #hora_inicio, #hora_fin').on('change', function () {
                    // Obtiene los valores de fecha, hora de inicio y hora de fin
                    var fecha = $('#agen_fecha').val();
                    var hora_inicio = $('#hora_inicio').val();
                    var hora_fin = $('#hora_fin').val();

                    // Realiza una solicitud al servidor para verificar la disponibilidad de la agenda
                    $.ajax({
                        type: 'POST',
                        url: 'verificar_agenda.php', // Debes crear este archivo en tu servidor
                        data: {fecha: fecha, hora_inicio: hora_inicio, hora_fin: hora_fin},
                        success: function (data) {
                            if (data === 'agenda_disponible') {
                                // Llena el combo de turnos con la información de la agenda
                                var comboTurnos = '<label for="codigo_turno">Seleccione el turno:</label>' +
                                        '<select name="codigo_turno" id="codigo_turno" class="form-control" required>' +
                                        '<option value="turno1">Mañana</option>' +
                                        '<option value="turno2">Tarde</option>' +
                                        '</select>';
                                $('#agenda-disponible').html(comboTurnos);
                            } else {
                                // No hay una agenda disponible, muestra un mensaje
                                $('#agenda-disponible').html('');
                                mostrarMensajeInicial(); // Muestra el mensaje inicial nuevamente
                            }
                        }
                    });
                });
            });
        </script>
        <?php require '../../estilos/js_lte.ctp'; ?> <!-- Agrega tus scripts JavaScript si es necesario -->
    </body>
</html>
