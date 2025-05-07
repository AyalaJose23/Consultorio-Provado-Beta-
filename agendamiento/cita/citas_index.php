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
                                    <h3 class="page-header text-center"><strong>CITAS MEDICAS</strong>
                                    <a href="/tdp/MANUAL DE USUARIO tdp.pdf" target="print">
                                    <span class="glyphicon glyphicon-question-sign"></span>
                                </a>
                                <a href="citas_add.php" class="btn btn-purple btn-sm pull-right" data-title="Agregar" rel="tooltip">
                                            <i class="fa fa-plus"></i> AGREGAR CITAS
                                        </a>
                                    <a href="citas_print.php" class="btn btn-default btn-sm pull-right" onclick="ImprimirCitas()" data-title="Imprimir" rel="tooltip">
                                            <i class="fa fa-print"></i>
                                        </a>
                                        
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
                                                Datos de la Cita
                                            </div>                     
                                                    <!-- /.panel-heading -->
                                        <div class="panel-body">
                                            <?php
                                            $citas = consultas::get_datos("SELECT * FROM v_citas WHERE cita_fecha::text ILIKE '%%' ORDER BY cod_cita DESC;");
                                            if (!empty($citas)) {
                                                ?>
                                                <table class="table col-lg-12 col-md-12 col-xs-12 table-bordered table-striped table-condensed">
                                                    <thead>
                                                    <th>#</th>
                                                    <th>Fecha</th>
                                                    <th>Doctor</th>
                                                    <th>Especialidad</th>
                                                    <th>Hora</th>
                                                    <th>Paciente</th>
                                                    <th>Turnos</th>
                                                    <th>Dias</th>
                                                    <th>Razon Cita</th>
                                                    <th>Estado</th>
                                                    <th class="text-center">Acciones</th>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($citas as $cit) { ?>
                                                            <tr>
                                                                <td data-title="#"><?php echo $cit['cod_cita']; ?></td>
                                                                <td data-title="Fecha"><?php echo $cit['cita_fecha']; ?></td>
                                                                <td data-title="Doctor"><?php echo $cit['doctor']; ?></td>
                                                                <td data-title="Especialidad"><?php echo $cit['descrip_espec']; ?></td>
                                                                <td data-title="Hora"><?php echo $cit['cita_hora']; ?></td>
                                                                <td data-title="Paciente"><?php echo $cit['paciente']; ?></td>
                                                                <td data-title="Turnos"><?php echo $cit['descrip_tur']; ?></td>
                                                                <td data-title="Dias"><?php echo $cit['dia_descri']; ?></td>
                                                                <td data-title="Razon Cita"><?php echo $cit['razon_cita']; ?></td>
                                                                <td data-title="Estado"><?php echo $cit['cita_estado']; ?></td>
                                                                <td data-title="Acciones" class="text-center">
                                                                <?php if ($cit['cita_estado'] == 'PENDIENTE') { ?>
                                                                        <a onclick="confirmar(<?php echo "'" . $cit['cod_cita'] . "_" . $cit['paciente'] . "_" . $cit['cita_fecha'] . "'"; ?>)" 
                                                                           class="btn btn-success btn-sm" data-title="Confirmar" rel="tooltip" data-placement="left" data-toggle="modal" data-target="#confirmar">
                                                                            <i class="fa fa-check"></i></a>
                                                                        <a href="citas_edit.php?vagen_cod=<?php echo $cit['cod_cita']; ?>" class="btn btn-warning btn-sm" role="button" data-title="Editar" 
                                                                           rel="tooltip" data-placement="top">
                                                                            <span class="glyphicon glyphicon-edit"></span></a>
                                                                        <a onclick="anular(<?php echo "'" . $cit['cod_cita'] . "_" . $cit['paciente'] . "_" . $cit['cita_fecha'] . "'"; ?>)"
                                                                           class="btn btn-danger btn-sm" role="button" data-title="Anular" rel="tooltip" data-placement="top" 
                                                                           data-toggle="modal" data-target="#anular">
                                                                            <span class="glyphicon glyphicon-remove"></span></a>
                                                                    <?php } ?>
                                                                    <a href="citas_print.php?vcod_cita=<?php echo $cit['cod_cita']; ?>" class="btn btn-default btn-sm" role="button" 
                                                                       data-title="Imprimir" rel="tooltip" data-placement="top" target="print">
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
                                                No se han registrado Citas...
                                            </div>      
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                </section>
            </div>
        </div>
        <?php require '../../estilos/pie.ctp'; ?>
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
                        <div class="alert alert-success" id="confirmacionc"></div>
                    </div>
                    <div class="modal-footer">
                        <a id="sic" role="buttom" class="btn btn-success">
                            <span class="glyphicon glyphicon-ok-sign"></span> SI
                        </a>
                        <button type="button" class="btn btn-default" data-dismiss="modal">
                            <span class="glyphicon glyphicon-remove"></span> NO
                        </button>
                    </div>
                </div>
            </div>
        </div>
 
    <script>
        $("#mensaje").delay(4000).slideUp(200, function () {
            $(this).alert('close');
        });
    </script>
    <script>
        function anular(datos) {
            var dat = datos.split('_');
            $('#si').attr('href', 'citas_control.php?vcod_cita=' + dat[0] + '&accion=4');
            $("#confirmacion").html('<span class="glyphicon glyphicon-warning-sign"></span> \n\
       Desea anular la Cita N° <strong>' + dat[0] + '</strong> del Paciente <strong>' + dat[1] + '</strong> de fecha  <strong>' + dat[2] + ' ?</strong>')
        }
        function confirmar(datos) {
            var dat = datos.split('_');
            $('#sic').attr('href', 'citas_control.php?vcod_cita=' + dat[0] + '&accion=3');
            $("#confirmacionc").html('<span class="glyphicon glyphicon-info-sign"></span> \n\
       Desea confirmar la Cita N° <strong>' + dat[0] + '</strong> del Paciente <strong>' + dat[1] + '</strong> de fecha  <strong>' + dat[2] + ' ?</strong>')
        }
    </script> 
    <script>
        function ImprimirCitas() {
            window.print();
        }
    </script>
            <?php require '../../estilos/js_lte.ctp'; ?><!--ARCHIVOS JS-->
</body>
</html>
