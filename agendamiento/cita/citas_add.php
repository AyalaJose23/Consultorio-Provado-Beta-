<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="shortcut icon" type="image/x-icon" href="/taller3/img/abm.png">
        <title>Agregar Citas</title>
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
                        <strong>AÑADIR CITA MÉDICA</strong>
                        <a href="citas_index.php" 
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
                                <strong>Agregar Citas</strong>
                            </div>
                            <div class="panel-body">
                                    <form action="citas_control.php" method="post">
                                            <input type="hidden" name="accion" value="1">
                                            <input type="hidden" name="vcod_cita" value="0">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <!-- Columna izquierda -->
                                                <div class="card-body">
                                                    <div class="card-header text-center" style="background-color: #800080; color: #ffffff;">
                                                            VERIFICACIÓN DE AGENDA
                                                        </div>
                                                    <div class="form-group">
                                                        <label for="fecha">Fecha:</label>
                                                        <?php $fecha = consultas::get_datos("SELECT current_date as fecha"); ?>
                                                        <input type="date" class="form-control" id="fecha" name="fecha" value="<?= $fecha[0]['fecha'];?>">
                                                    </div>
                                                    
                                                    <div class="form-group">
                                                        <label for="vcod_especialidad">Especialidad:</label>
                                                        <?php
                                                        $especialidad = consultas::get_datos("SELECT * FROM especialidad ORDER BY cod_especialidad");
                                                        ?>
                                                        <select class="form-control" name="vcod_especialidad" required id="especialidad"  onchange="doctores(); return false;">
                                                            <option value="">Seleccionar Especialidad</option>
                                                            <?php foreach ($especialidad as $espe) : ?>
                                                                <option value="<?php echo $espe['cod_especialidad']; ?>"><?php echo $espe['descrip_espec']; ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                        <div id="doctores"></div>
                                                    </div>
                                                    
                                                </div>

                                                <div class="form-group">
                                                    <label for="vcod_doctor">Doctor:</label>
                                                    <select class="form-control" name="vcod_doctor" id="vcod_doctor" readonly="" onchange="diasAgenda(); ">
                                                        
                                                    </select>
                                                </div>

                                                <div class="form-group" >
                                                    <?php $dias = consultas::get_datos("select * from dias order by cod_dia"); ?>
                                                    <label for="vdia_cod">Dias de Atención:</label>

                                                    <select class="form-control select2" name="dias" required="" id="dias" >
                                                       
                                                    </select>
                                                </div>

                                            </div>
<!--                                            COLUMNA 2 -->
                                            <div class="col-md-6">
                                                    <div class="card card-success">
                                                        <div class="card-header text-center" style="background-color: #800080; color: #ffffff;">
                                                            COMPLETA LOS DATOS
                                                        </div>
                                                        <div class="card-body">
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
                                                                <span class="input-group-btn">
                                                                    <button class="btn btn-purple btn-flat leftS" type="button" data-title="Agregar Paciente"
                                                                            rel="tooltip"   data-toggle="modal" data-target="#registrar">
                                                                        <i  class="fa fa-plus"></i>
                                                                    </button>
                                                                </span>
                                                            </div>

                                                            <div class="form-group">
                                                                <label>HORA DE LA CITA:</label>
                                                                <input type="time" class="form-control" name="vcita_hora" value="07:00">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="razon_cita">RAZÓN DE CITA:</label>
                                                                <textarea name="vrazon_cita" id="razon_cita" class="form-control" rows="4" required></textarea>
                                                            </div>
                                                            <div class="box-footer">
                                                                <a href="citas_index.php" class="btn btn-default">
                                                                    <i class="fa fa-remove"></i> CANCELAR
                                                                </a>   
                                                                <button type="submit" class="btn btn-purple pull-right">
                                                                    <i class="fa fa-floppy-o"></i> Registrar
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
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
    <?php require '../../estilos/pie.ctp'; ?>
           <!--INICIA MODAL REGISTRAR-->
            <div class="modal fade" id="registrar" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">X</button>
                            <h4 class="modal-title">AGREGAR PACIENTE</h4>
                        </div>
                <form action="citas_control.php" method="post" accept-charset="utf-8" class="form-horizontal">
                <input name="accion" value="5" type="hidden" />
                <input name="vcod_pacientes" value="0" type="hidden" />
                <div class="box-body">
                    <div class="form-group">
                        <?php $personas = consultas::get_datos("select * from v_personas order by id_persona"); ?>
                        <label class="col-sm-2 control-label">PERSONAS:</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <select class="form-control select2-container--classic" name="vid_persona" required="">
                                    <?php foreach ($personas as $per) { ?>
                                        <option value="<?php echo $per['id_persona']; ?>"><?php echo $per['per_nombre'] . " " . $per['per_apellido']; ?></option>
                                    <?php } ?>
                                </select>
                                <span class="input-group-btn">
                                    <a href="personas_add.php" class="btn btn-primary btn-flat">
                                        <i class="fa fa-plus"></i>
                                    </a>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" data-dismiss="modal" class="btn btn-default">
                        <i class="fa fa-remove"></i> Cerrar
                    </button>
                    <button type="submit" class="btn btn-primary pull-right">
                        <i class="fa fa-floppy-o"></i> Registrar
                    </button>
                </div>
            </form>
                    </div>
                </div>
            </div>
            <!--FIN MODAL REGISTRAR-->
</div>
<script>
    // Función para mostrar el mensaje inicial
    function mostrarMensajeInicial() {
        $('#mensaje-inicial').show();
    }
    
    function doctores() {
        console.log($('#especialidad').val());
            $.ajax({
                type: "GET",
                url: "citas_adddoc.php?vcod_especialidad=" + $('#especialidad').val(),
                cache: false,
                beforeSend: function () {
                    $('#vcod_doctor').html('<img src="img/loader.gif" /><strong>Cargando...</strong>')
                },
                success: function (data) {
                    console.log(data);
                    $('#vcod_doctor').html(data);
                }
            });
        }
        
    function diasAgenda() {
       
            $.ajax({
                type: "GET",
                url: "citas_adddocagen.php?vcod_doctor=" + $('#vcod_doctor').val()+"&fecha="+
                        $("#fecha").val(),
                cache: false,
                beforeSend: function () {
                    $('#dias').html('<img src="img/loader.gif" /><strong>Cargando...</strong>')
                },
                success: function (data) {
                    console.log(data);
                    $('#dias').html(data);
                }
            });
        }

    $(document).ready(function () {
        mostrarMensajeInicial(); // Muestra el mensaje inicial al abrir la página
        
        $('#agen_fecha, #hora_inicio, #hora_fin').on('change', function () {
            // Obtiene los valores de fecha, hora de inicio y hora de fin
            var fecha = $('#agen_fecha').val();
            var hora_inicio = $('#hora_inicio').val();
            var hora_fin = $('#hora_fin').val();
        });
    });
    
    
    
</script>
    <?php require '../../estilos/js_lte.ctp'; ?><!--ARCHIVOS JS-->
 <script>
                $('#mensaje').delay(4000).slideUp(200, function () {
                    $(this).alert('close');
                });
            </script><!-- Agrega tus scripts JavaScript si es necesario -->
</body>
</html>
