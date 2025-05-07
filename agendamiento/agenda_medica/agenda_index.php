<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="shortcut icon" type="image/x-icon" href="/taller3/img/abm.png">
        <title>CENTRO MEDICO VIDA Y AMOR</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <title>Mensaje</title>

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
                                    <h3 class="page-header text-center"><strong>AGENDA MÉDICA</strong>
                                    <a href="/tdp/MANUAL DE USUARIO tdp.pdf" target="print">
                                    <span class="glyphicon glyphicon-question-sign"></span>
                                </a>
                                <a href="agenda_add.php" class="btn btn-purple btn-sm pull-right" data-title="Agregar" rel="tooltip"> 
                                        <i class="fa fa-plus">  </i> AGREGAR AGENDA
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
                                                Datos de la Agenda
                                            </div>                     
                                                    <!-- /.panel-heading -->
                                        <div class="panel-body">
                                            <?php
                                            $agenda = consultas::get_datos("SELECT * FROM v_agenda WHERE agen_fecha::text ILIKE '%%' ORDER BY cod_agenda;");
                                            ?>
                                            <table class="table col-lg-12 col-md-12 col-xs-12 table-bordered table-striped table-condensed">
                                                <thead>
                                                    <tr>
                                                        <th>Nro</th>
                                                        <th>Fecha</th>
                                                        <th>Fecha Inicio</th>
                                                        <th>Fecha Fin</th>
                                                        <th>Estado</th>
                                                        <th class="text-center">Acciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($agenda as $agen) { ?>
                                                        <tr>
                                                            <td data-title="Nro"><?php echo $agen['cod_agenda']; ?></td>
                                                            <td data-title="Fecha"><?php echo $agen['agen_fecha']; ?></td>
                                                            <td data-title="Agenda Inicio"><?php echo $agen['fecha_inicio']; ?></td>
                                                            <td data-title="Agenda Fin"><?php echo $agen['fecha_fin']; ?></td>
                                                            <td data-title="Estado"><?php echo $agen['agen_estado']; ?></td>
                                                            <td data-title="Acciones" class="text-center">
                                                                <?php if ($agen['agen_estado'] == 'ACTIVO') { ?>
                                                                    <a onclick="anular(<?php echo "'" . $agen['cod_agenda'] . "'"; ?>)"
                                                                       class="btn btn-danger btn-sm" role="button" data-title="Anular" rel="tooltip" data-placement="top" 
                                                                       data-toggle="modal" data-target="#anular">
                                                                        <span class="glyphicon glyphicon-remove"></span>
                                                                    </a>
                                                                    <a href="agenda_edit.php?vcod_agenda=<?php echo $agen['cod_agenda']; ?>" class="btn btn-warning btn-sm" role="button" data-title="Editar" 
                                                                       rel="tooltip" data-placement="top">
                                                                        <span class="glyphicon glyphicon-edit"></span></a>
                                                                    <a href="agendadetalle_add.php?vcod_agenda=<?php echo $agen['cod_agenda']; ?>" 
                                                                       class="btn btn-purple btn-sm" role="button" data-title="Detalles" 
                                                                       rel="tooltip" data-placement="top">
                                                                        <span class="glyphicon glyphicon-list"></span></a>
                                                                    

                                                                <?php } ?>
                                                                <a href="agendamiento_print.php?vcod_agenda=<?php echo $agen['cod_agenda']; ?>" class="btn btn-default btn-sm" role="button" data-title="Imprimir" 
                                                                   rel="tooltip" data-placement="top" target="print">
                                                                    <span class="glyphicon glyphicon-print"></span></a>                                                                          
                                                            </td>
                                                        </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php require '../../estilos/pie.ctp'; ?>
            <?php require '../../estilos/js_lte.ctp'; ?><!--ARCHIVOS JS-->
            <div class="modal" id="anular" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">X</button>
                            <h4 class="modal-title custom_align">ATENCIÓN...!!!</h4>
                        </div>
                        <div class="modal-body">
                            <div class="alert alert-danger" id="confirmacion"></div>
                        </div>
                        <div class="modal-footer">
                            <a id="si" role="buttom" class="btn btn-danger">
                                <span class="glyphicon glyphicon-ok-sign"></span> SI
                            </a>
                            <button type="button" class="btn btn-default" data-dismiss="modal">
                                <span class="glyphicon glyphicon-remove"></span> NO
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- MODAL confirmar-->
            <div class="modal" id="confirmar" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">X</button>
                            <h4 class="modal-title custom_align">ATENCIÓN...!!!</h4>
                        </div>
                        <div class="modal-body">
                            <div class="alert alert-danger" id="confirmacionc"></div>
                        </div>
                        <div class="modal-footer">
                            <a id="sic" role="buttom" class="btn btn-danger">
                                <span class="glyphicon glyphicon-ok-sign"></span> SI
                            </a>
                            <button type="button" class="btn btn-default" data-dismiss="modal">
                                <span class="glyphicon glyphicon-remove"></span> NO
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- FIN MODAL confirmar--> 

        </div>
        <script>

            function anular(datos) {
                // La función split() divide la cadena de texto en un array usando el guion bajo como separador
                var dat = datos.split('_');

                // Actualiza el atributo href del elemento con id 'si' con una nueva URL
                $('#si').attr('href', 'agenda_control.php?vcod_agenda=' + dat[0] + '&accion=3');

                // Actualiza el contenido del elemento con id 'confirmacion' con un mensaje HTML
                $("#confirmacion").html('<span class="glyphicon glyphicon-warning-sign"></span> \n\
       Desea anular la Agenda N° <strong>' + dat[0] + ' ?</strong>');
            }

        </script> 
        <?php require 'menu/js_lte.ctp'; ?>
    </body>
</html>
