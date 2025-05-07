<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="shortcut icon" type="image/x-icon" href="/taller3/img/abm.png">
        <title>CENTRO MEDICO VIDA Y AMOR</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

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
            <div class="content-wrapper">
                <div class="content">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <?php if (!empty($_SESSION['mensaje'])) { ?>
                                <div class="alert alert-warning" role="alert" id="mensaje">
                                    <span class="glyphicon glyphicon-exclamation-sign"></span>
                                    <?php
                                    echo $_SESSION['mensaje'];
                                    $_SESSION['mensaje'] = '';
                                    ?>
                                </div>

                            <?php } ?>
                            <div class="col-lg-12">
                                    <h3 class="page-header text-center"><strong>REPORTE AGENDA MÉDICA</strong>
                                </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="panel panel-default">
                                            <div class="panel-heading">
                                                Informe Agenda Médica
                                            </div>                     
                                                    <!-- /.panel-heading -->
                                        <div class="panel-body">
                                            <?php
                                            $opcion = "2";
                                            if (isset($_REQUEST['opcion'])) {
                                                $opcion = $_REQUEST['opcion'];
                                            }
                                            ?>
                                            <form action="agendamiento_print.php" method="get" accept-charset="utf-8" class="form-horizontal" target="print">
                                                <input type="hidden" name="opcion" value="<?php echo $opcion; ?>"/>
                                                  <!-- Combo Box de Procesos -->
                                            <div class="form-group">
                                                <label class="control-label col-lg-2 col-md-2">Proceso:</label>
                                                <div class="col-lg-6 col-md-6">
                                                    <select class="form-control" id="selectProceso" name="proceso">
                                                        <option value="facturacion">Agenda Médica</option>s
                                                        
                                                    </select>
                                                </div>
                                            </div>
                                                <div class="box-body">
                                                    <div class="col-md-4 col-sm-4 col-lg-4">
                                                        <div class="panel panel-default">
                                                            <div class="panel-heading">
                                                                <strong>OPCIONES</strong>
                                                            </div>
                                                            <div class="panel-body">
                                                                <div class="list-group">
                                                                    <a href="agendamiento_rpt.php?opcion=1" class="list-group-item">Por Fechas</a>
                                                                    <a href="agendamiento_rpt.php?opcion=2" class="list-group-item">Por Doctor</a>
                                                                    <a href="agendamiento_rpt.php?opcion=3" class="list-group-item">Por Especialidad</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8 col-sm-8 col-lg-8">
                                                        <div class="panel panel-default">
                                                            <div class="panel-heading">
                                                                <strong>FILTROS</strong>
                                                            </div>
                                                            <div class="panel-body">
                                                                <?php
                                                                switch ($opcion) {
                                                                    case 1://por fecha 
                                                                        ?>
                                                                        <div class="form-group has-feedback">
                                                                            <label class="control-label col-lg-2 col-md-2">Desde:</label>
                                                                            <div class="col-lg-6 col-md-6">
                                                                                <input type="date" name="vdesde" class="form-control"/>
                                                                                <i class="fa fa-calendar form-control-feedback"></i>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group has-feedback">
                                                                            <label class="control-label col-lg-2 col-md-2">Hasta:</label>
                                                                            <div class="col-lg-6 col-md-6">
                                                                                <input type="date" name="vhasta" class="form-control"/>
                                                                                <i class="fa fa-calendar form-control-feedback"></i>
                                                                            </div>
                                                                        </div>                                                                
                                                                        <?php
                                                                        break;
                                                                    case 2:
                                                                        $pacientes = consultas::get_datos("select * from vista_doctor where cod_doctor in(select cod_doctor from agenda)");
                                                                        ?>
                                                                        <div class="form-group">
                                                                            <label class="control-label col-lg-2 col-md-2 col-sm-2">Doctor:</label>
                                                                            <div class="col-lg-6 col-md-6 col-sm-6">
                                                                                <select class="form-control select2" name="vcod_doctor" required="">
                                                                                    <?php foreach ($pacientes as $pac) { ?>
                                                                                        <option value="<?php echo $pac['cod_doctor']; ?>"><?php echo $pac['doctor']; ?></option>
                                                                                    <?php } ?>
                                                                                </select>
                                                                            </div>
                                                                        </div>                                                                 

                                                                       <?php
                                                                        break;
                                                                    case 3:
                                                                        $pacientes = consultas::get_datos("select * from especialidad where cod_especialidad in(select cod_especialidad from agenda)");
                                                                        ?>
                                                                        <div class="form-group">
                                                                            <label class="control-label col-lg-2 col-md-2 col-sm-2">Especialidad:</label>
                                                                            <div class="col-lg-6 col-md-6 col-sm-6">
                                                                                <select class="form-control select2" name="vesp_cod" required="">
                                                                                    <?php foreach ($pacientes as $pac) { ?>
                                                                                        <option value="<?php echo $pac['cod_especialidad']; ?>"><?php echo $pac['descrip_espec']; ?></option>
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
                                                    <button type="submit" class="btn btn-purple pull-right">
                                                        <i class="fa fa-print"></i>LISTAR
                                                    </button>
                                                </div>  
                                                <div class="IrArriba"></div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php require '../../estilos/pie.ctp'; ?>
        </div>                  
        <?php require '../../estilos/js_lte.ctp'; ?><!--ARCHIVOS JS--> 
        <script>
            $("#mensaje").delay(4000).slideUp(200, function () {
                $(this).alert('close');
            });
        </script>
    </body>
</html>

