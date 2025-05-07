<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="/taller3/img/abm.png">
    <title>Agregar Agenda</title>
    <!-- Incluye tus estilos CSS personalizados aquí -->
    <?php session_start();  include "../../conexion.php";
                            require '../../estilos/css_lte.ctp'; ?>
    
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
                            <strong>AÑADIR AGENDA MEDICA</strong>
                            <a href="agenda_index.php" 
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
                                <strong>Agregar Agenda</strong>
                            </div>
                            <div class="panel-body">
                                <form action="agenda_control.php" method="post" accept-charset="utf-8" class="form-horizontal">
                                    <input type="hidden" name="accion" value="1">
                                    <input type="hidden" name="vcod_agenda" value="<?php echo isset($vcod_agenda) ? $vcod_agenda : ''; ?>"/>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <?php $fecha = consultas::get_datos("SELECT current_date as fecha"); ?>
                                                <label class="control-label">Fecha:</label>
                                                <input type="date" name="vagen_fecha" class="form-control" required="" value="<?php echo $fecha[0]['fecha']; ?>" readonly="">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">FECHA INICIO:</label>
                                                <input type="date" name="vfecha_inicio" class="form-control" min="<?php echo date('Y-m-d'); ?>" value="<?php echo date('Y-m-d'); ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">FECHA FIN:</label>
                                                <input type="date" name="vfecha_fin" class="form-control" min="<?php echo date('Y-m-d'); ?>" value="<?php echo date('Y-m-d'); ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="box-footer">
                                        <a href="agenda_index.php" class="btn btn-default">
                                            <i class="fa fa-remove"></i> CANCELAR
                                        </a>
                                        <button type="submit" class="btn btn-purple">
                                            <i class="fa fa-floppy-o"></i> REGISTRAR
                                        </button>
                                    </div>
                                </form>
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
        $('#mensaje').delay(4000).slideUp(200, function() {
            $(this).alert('close');
        });
    </script>
</body>

</html>
