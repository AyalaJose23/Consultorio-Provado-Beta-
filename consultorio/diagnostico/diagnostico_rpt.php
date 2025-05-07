<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" type="image/x-icon" href="taller3/img/abm.png">
    <title>CENTRO MEDICO VIDA Y AMOR</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <?php
        session_start();
        include "../../conexion.php";
        require '../../estilos/css_lte.ctp';
        ?><!--ARCHIVOS CSS-->

<style>
            .panel-default > .panel-heading {
                background-color: #9370db; /* Morado claro */
                color: white;
                font-weight: bold;
            }
           
        </style>
    </head>
    <body class="hold-transition skin-purple sidebar-mini">
        <div class="wrapper">
             <?php require '../../estilos/cabecera.ctp'; ?>
        <?php require '../../estilos/izquierda.ctp'; ?>
        
        <main class="content-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-lg-12">
                        <?php if (!empty($_SESSION['mensaje'])) { ?>
                            <div class="alert alert-warning" role="alert" id="mensaje">
                                <span class="glyphicon glyphicon-exclamation-sign"></span>
                                <?php echo $_SESSION['mensaje']; $_SESSION['mensaje'] = ''; ?>
                            </div>
                        <?php } ?>

                        <div class="col-lg-12">
                                    <h3 class="page-header text-center"><strong>REPORTE CITAS</strong>
                                </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="panel panel-default">
                                            <div class="panel-heading">
                                                Informe Diagnostico
                                            </div>                     
                                                    <!-- /.panel-heading -->
                                        <div class="panel-body">
                                <form action="diagnostico_print.php" method="get" class="form-horizontal" target="print">
                                    <input type="hidden" name="opcion" value="<?php echo isset($_REQUEST['opcion']) ? $_REQUEST['opcion'] : '2'; ?>"/>
                                    <!-- Combo Box de Procesos -->
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="panel panel-warning">
                                                <div class="panel-heading">
                                                    <strong>OPCIONES</strong>
                                                </div>
                                                <div class="panel-body">
                                                    <div class="list-group">
                                                        <a href="diagnostico_rpt.php?opcion=1" class="list-group-item">Por Fechas</a>
                                                        <a href="diagnostico_rpt.php?opcion=2" class="list-group-item">Por Paciente</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="panel panel-warning">
                                                <div class="panel-heading">
                                                    <strong>FILTROS</strong>
                                                </div>
                                                <div class="panel-body">
                                                    <?php
                                                    $opcion = isset($_REQUEST['opcion']) ? $_REQUEST['opcion'] : 2;
                                                    switch ($opcion) {
                                                        case 1: // por fecha 
                                                            ?>
                                                            <div class="form-group">
                                                                <label class="control-label col-lg-2">Desde:</label>
                                                                <div class="col-lg-6">
                                                                    <input type="date" name="vdesde" class="form-control" required/>
                                                                    <i class="fa fa-calendar form-control-feedback"></i>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-lg-2">Hasta:</label>
                                                                <div class="col-lg-6">
                                                                    <input type="date" name="vhasta" class="form-control" required/>
                                                                    <i class="fa fa-calendar form-control-feedback"></i>
                                                                </div>
                                                            </div>
                                                            <?php
                                                            break;

                                                        case 2:
                                                            // Asegúrate de que consultas::get_datos está bien definido y retorna un array
                                                            $pacientes = consultas::get_datos("SELECT * FROM v_paciente WHERE pac_cod IN (SELECT pac_cod FROM diagnostico)");
                                                            ?>
                                                            <div class="form-group">
                                                                <label class="control-label col-lg-2">Pacientes:</label>
                                                                <div class="col-lg-6">
                                                                    <select class="form-control select2" name="vpac_cod" required>
                                                                        <option value="">Seleccione un Paciente</option>
                                                                        <?php foreach ($pacientes as $pac) { ?>
                                                                            <option value="<?php echo $pac['pac_cod']; ?>"><?php echo htmlspecialchars($pac['paciente']); ?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <?php
                                                            break;

                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="box-footer">
                                        <button type="submit" class="btn btn-warning pull-right">
                                            <i class="fa fa-print"></i> LISTAR
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <?php require 'menu/footer_lte.ctp'; ?> <!-- ARCHIVOS JS -->
    </div>                  
    <script>
        $(document).ready(function() {
            $("#mensaje").delay(4000).slideUp(200, function () {
                $(this).alert('close'); 
            });
        });
    </script>
</body>
 <?php require 'menu/js_lte.ctp'; ?>
</html>
