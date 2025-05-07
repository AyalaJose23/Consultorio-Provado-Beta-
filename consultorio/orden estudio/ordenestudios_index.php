<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="shortcut icon" type="image/x-icon" href="/taller3/img/abm.png">
        <title>Orden de Estudios - Centro Medico VIDA & AMOR</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

        <?php
        session_start();
        include "../../conexion.php";
        require '../../estilos/css_lte.ctp';
        ?><!--ARCHIVOS CSS-->
    </head>
    <body class="hold-transition skin-purple sidebar-mini">
        <div class="wrapper">
            
        <?php require '../../estilos/cabecera.ctp'; ?>
        <?php require '../../estilos/izquierda.ctp'; ?>
            <div class="content-wrapper">
              <section class="content">
                <div class="content">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-xs-12">
                            <?php if (!empty($_SESSION['mensaje'])) { ?>
                                <div class="alert alert-danger" role="alert" id="mensaje">
                                    <span class="glyphicon glyphicon-exclamation-sign"></span>
                                    <?php
                                    echo $_SESSION['mensaje'];
                                    $_SESSION['mensaje'] = '';
                                    ?>
                                </div>
                            <?php } ?>
                            <div class="col-lg-12">
                                    <h3 class="page-header text-center"><strong>ORDEN DE ESTUDIO</strong>
                                    <a href="/taller3/MANUAL DE USUARIO tdp.pdf" target="print">
                                    <span class="glyphicon glyphicon-question-sign"></span>
                                </a>
                                <a href="ordenestudios_add.php" class="btn btn-purple btn-sm pull-right" data-title="Agregar" rel="tooltip"> 
                                        <i class="fa fa-plus">  </i> AGREGAR ORDEN DE ESTUDIO
                                    </a>
                                            <a href="agendamiento_print.php" class="btn btn-default btn-sm pull-right" data-title="Imprimir" rel="tooltip"
                                           data-placement="left"><i class="fa fa-print"></i></a>
                                        
                                </div>
                        </div>
                    </div>        

                                <div class="box-body no-padding">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-xs-12">
                                            <form method="post" accept-charset="utf-8" class="form-horizontal">
                                                <div class="box-body">
                                                    <div class="form-group">
                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                            <div class="input-group custom-search-form">
                                                                <input type="search" name="buscar" class="form-control" placeholder="Ingrese valor a buscar..." autofocus="" />
                                                                <span class="input-group-btn">
                                                                    <button type="submit" class="btn btn-purple btn-flat" data-title="Buscar" rel="tooltip">
                                                                        <i class="fa fa-search"></i>
                                                                    </button>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                            
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="panel panel-info">
                                            <div class="panel-heading">
                                                Datos de la Orden de Estudio
                                            </div>                     
                                                    <!-- /.panel-heading -->
                                        <div class="panel-body">
                                            <?php
                                            $ordenestudios = consultas::get_datos("SELECT * FROM v_ordenestudio WHERE fecha_estudio::text ILIKE '%%' ORDER BY cod_estudios desc;");
                                            if (!empty($ordenestudios)){
                                            ?>
                                            <table class="table col-lg-12 col-md-12 col-xs-12 table-bordered table-striped table-condensed">
                                                <thead>
                                                <th>#</th>
                                                <th>Fecha</th>
                                                <th>Paciente</th>
                                                <th>Estado</th>
                                                <th class="text-center">Acciones</th>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($ordenestudios as $oe) { ?>
                                                        <tr>
                                                            <td data-title="#"><?php echo $oe['cod_estudios']; ?></td>
                                                            <td data-title="Fecha"><?php echo $oe['fecha_estudio']; ?></td>
                                                            <td data-title="Paciente"><?php echo $oe['paciente']; ?></td>
                                                            <td data-title="Estado"><?php echo $oe['estado_estudio']; ?></td>
                                                            <td data-title="Acciones" class="text-center">
                                                                <?php if ($oe['estado_estudio'] == 'PENDIENTE') { ?>
                                                                   <a href="ordenestudiosdetalle_add.php?vcod_estudios=<?php echo $oe['cod_estudios']; ?>" 
                                                                       class="btn btn-success btn-sm" role="button" data-title="Detalles" 
                                                                       rel="tooltip" data-placement="top">
                                                                        <span class="glyphicon glyphicon-list"></span></a>
                                                                        
                                                                <?php } ?>
                                                                <a href="ordenestudios_print.php?vcod_estudios=<?php echo $oe['cod_estudios']; ?>" class="btn btn-primary btn-sm" role="button" data-title="Imprimir" 
                                                                   rel="tooltip" data-placement="top" target="print">
                                                                    <span class="glyphicon glyphicon-print"></span></a>                                                                          
                                                            </td>
                                                        </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                         <?php } else { ?>
                                            <div class="alert alert-info">
                                                <span class="glyphicon glyphicon-info-sign"></span> 
                                                No se han registrado Orden de Estudios...
                                            </div>      
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
              </section>
            </div>  
        <script>
        $("#mensaje").delay(4000).slideUp(200,function(){
           $(this).alert('close'); 
        });
        </script>
       <?php require '../../estilos/pie.ctp'; ?>
       <?php require '../../estilos/js_lte.ctp'; ?><!--ARCHIVOS JS-->
    </body>
</html>
