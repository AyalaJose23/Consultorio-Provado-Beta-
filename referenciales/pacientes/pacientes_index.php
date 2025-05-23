<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
         <?php
        session_start();
        include "../../conexion.php";
        require '../../estilos/css_lte.ctp';
        ?>
    </head>
    <body class="hold-transition skin-blue sidebar-mini">  <!--Cabecera y menu izquierda-->
            <div class="wrapper">
                <?php require '../../estilos/cabecera.ctp'; ?>
                <?php require '../../estilos/izquierda.ctp'; ?>
                <div class="content-wrapper "> <!--Contenedor-->
                    <div class="content"> 
                        <!--row titulo-->
                        <div class="row">
                            <!--impresion del titulo de la pagina-->
                            <div class="col-lg-12 col-md-12 col-xs-12">
                                <?php if (!empty($_SESSION['mensaje'])) { ?>
                                    <?php
                                    $mensaje = explode("_/_", $_SESSION['mensaje']);
                                    if (($mensaje[0] == 'NOTICIA')) {
                                        $class = "success";
                                    } else {
                                        $class = "danger";
                                    }
                                    ?>
                                    <div class="alert alert-<?= $class; ?>" role="alert" id="mensaje">
                                        <i class="ion ion-information-circled"></i>
                                        <?php
                                        echo $mensaje[1];
                                        $_SESSION['mensaje'] = '';
                                        ?>
                                    </div>
                                <?php } ?>
                                <h3 class="page-header text-center">
                                <strong>REGISTRO DE PACIENTES</strong>
                                <a href="/tdp/MANUAL DE USUARIO tdp.pdf" target="print">
                                    <span class="glyphicon glyphicon-question-sign"></span>
                                </a>
                                <a href="paciente_add.php" class="btn btn-purple btn-sm pull-right" data-title="Agregar" rel="tooltip">
                                    <i class="fa fa-plus"></i> Agregar Paciente
                                </a>
                            </h3>
                        </div>
                    </div>

                    <!-- Formulario de búsqueda -->
                    <div class="panel-body no-padding">
                        <form action="pacientes_index.php" method="post" accept-charset="utf8" class="form-horizontal">
                            <div class="form-group">
                                <div class="col-lg-12">
                                    <div class="input-group custom-search-form">
                                        <input type="search" class="form-control" name="buscar" placeholder="Buscar..." autofocus />
                                        <span class="input-group-btn">
                                            <button type="submit" class="btn btn-purple btn-flat" data-title="Buscar" data-placement="bottom" rel="tooltip">
                                                <span class="fa fa-search"></span>
                                            </button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <!-- Tabla de datos -->
                        <div class="panel panel-info">
                            <div class="panel-heading">Datos de los Pacientes</div>
                            <div class="panel-body">
                                                <?php
                                                 $pacientes = consultas::get_datos("select * from v_pacientes where (paciente) ilike '%" . (isset($_REQUEST['buscar']) ? $_REQUEST['buscar'] : "") . "%' order by cod_pacientes");
                                        
                                                if (!empty($pacientes)) {
                                                    ?>
                                                    <div class="table-responsive">
                                                        <table class="table col-lg-12 col-md-12 col-xs-12 table-bordered table-striped table-condensed">
                                                            <thead>
                                                                <th>Codigo</th>
                                                                <th>Nombre y Apellido</th>
                                                                <th>C.I</th>
                                                                <th>R.U.C</th>
                                                                <th>Teléfono</th>
                                                                <th>Sexo</th>
                                                                <th>Ciudad</th>
                                                                <th>Nacionalidad</th>
                                                                <th>Estado</th>
                                                            <th class="text-center">Acciones</th>
                                                            </thead>
                                                            <tbody>
                                                                <?php foreach ($pacientes as $paciente) { ?>
                                                                    <tr>
                                                                        <td><?php echo $paciente['cod_pacientes']; ?></td>
                                                                        <td><?php echo $paciente['paciente'] ?></td>
                                                                        <td><?php echo $paciente['per_ci'] ?></td>
                                                                        <td><?php echo $paciente['per_ruc'] ?></td>
                                                                        <td><?php echo $paciente['per_telefono'] ?></td>
                                                                        <td><?php echo $paciente['per_sexo'] ?></td>
                                                                        <td><?php echo $paciente['ciu_descri'] ?></td>
                                                                        <td><?php echo $paciente['nac_descri'] ?></td>
                                                                        <td><?php echo $paciente['paciente_estado'] ?></td>
                                                                        <td data-title="Acciones" class="text-center">
                                                                <?php if ($paciente['paciente_estado'] == 'ACTIVO') { ?>
                                                                                <a onclick="editar('<?php echo $paciente['cod_pacientes'] . "_" . $paciente['paciente']; ?>')"       
                                                                                class="btn btn-xs btn-warning" role="button" data-title="Editar"
                                                                                rel="tooltip" data-placement="top" data-toggle="modal" data-target="#editar">
                                                                                    <span class="fa fa-edit"></span></a>
                                                                                <a onclick="deshabilitar('<?php echo $paciente['cod_pacientes'] . "_" . $paciente['paciente']; ?>')" 
                                                                                class="btn btn-xs btn-danger" role="button" data-title="Deshabilitar"
                                                                                rel="tooltip" data-placement="top" data-toggle="modal" data-target="#deshabilitar">
                                                                                    <span class="glyphicon glyphicon-remove"></span></a>
                                                                <?php } else { ?>
                                                                                <a onclick="activar('<?php echo $paciente['cod_pacientes'] . "_" . $paciente['paciente']; ?>')" 
                                                                                class="btn btn-xs btn-success" role="button" data-title="Activar"
                                                                                rel="tooltip" data-placement="top" data-toggle="modal" data-target="#activar">
                                                                                    <span class="fa fa-check"></span></a>
                                                                    <?php } ?> 
                                                                        </td>
                                                                    </tr>
                                                                    <?php } ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                <?php } else { ?>
                                                    <div class="alert alert-info flat">
                                                        <span class="glyphicon glyphicon-info-sign"></span>
                                                        No se han registrado Pacientes...
                                                    </div>
                                                <?php } ?>
                                            </div> <!--Final de col consulta-->
                                        </div> <!--Final row consultas-->
                                    </div> <!--Final box body consultas-->
                                </div> <!--Final box primary-->
                            </div> <!--Final de col-->
                        </div> <!--Final de row-->
                    </div> <!--Final de Contenedor-->     
                </div> <!--Final de  content-wrapper-->
            <!--INICIA MODAL REGISTRAR--> 
         <?php require '../../estilos/pie.ctp'; ?>
        <?php require '../../estilos/js_lte.ctp'; ?><!--ARCHIVOS JS-->
                <div class="modal fade" id="registrar" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">X</button>
                                <h4 class="modal-title">REGISTRAR PACIENTE</h4>
                            </div>
                            <form action="pacientes_control.php" method="post" accept-charset="utf-8" class="form-horizontal">
                                <input name="accion" value="1" type="hidden" />
                                <input name="vcod_pacientes" value="0" type="hidden" />
                                <div class="box-body">
                                    <div class="form-group">
                                        <?php $personas = consultas::get_datos("select * from v_personas WHERE per_estado = 'ACTIVO' "); ?>
                                        <label class="col-sm-2 control-label">PERSONAS:</label>
                                        <div class="col-sm-10">
                                            <div class="input-group">
                                                <select class="form-control select2-container--classic" name="vid_persona" required="">
                                                    <?php foreach ($personas as $per) { ?>
                                                        <option value="<?php echo $per['id_persona']; ?>"><?php echo $per['per_nombre'] . " " . $per['per_apellido']; ?></option>
                                                    <?php } ?>
                                                </select>
                                                <span class="input-group-btn">
                                                    <a href="personas_index.php" class="btn btn-primary btn-flat">
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
                
                <!--INICIA MODAL EDITAR-->
                <div class="modal fade" id="editar" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">x</button>
                                <h4 class="modal-title">Actualizar PACIENTES</h4>
                            </div>
                            <form action="pacientes_control.php" method="post" accept-charset="utf-8" class="form-horizontal">
                                <input name="accion" value="2" type="hidden"/>
                                <input id="cod" name="vid_persona" type="hidden"/>
                                    <div class="box-body">
                                        <div class="form-group">
                                            <?php $personas = consultas::get_datos("select * from v_personas WHERE per_estado = 'ACTIVO' "); ?>
                                            <label class="col-sm-2 control-label">PERSONAS:</label>
                                            <div class="col-sm-10">
                                                <div class="input-group">
                                                    <select class="form-control select2-container--classic" name="vid_persona" required="">
                                                        <?php foreach ($personas as $per) { ?>
                                                            <option value="<?php echo $per['id_persona']; ?>"><?php echo $per['per_nombre'] . " " . $per['per_apellido']; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                    <span class="input-group-btn">
                                                        <a href="personas_index.php" class="btn btn-warning btn-flat">
                                                            <i class="fa fa-plus"></i>
                                                        </a>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <div class="modal-footer">
                                    <button type="reset" data-dismiss="modal" class="btn btn-default">
                                        <a class="fa fa-remove"></a> Cerrar</button>
                                    <button type="submit" class="btn btn-warning pull-right">
                                        <a class="fa fa-floppy-o"></a> Actualizar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!--FIN MODAL EDITAR-->
                <!--INICIA MODAL ANULAR-->
                <div class="modal fade" id="deshabilitar" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">x</button>
                                <h4 class="data-title custom_align" id="Heading" >Atencion!!!</h4>
                            </div>
                            <div class="modal-body">
                                <div class="alert alert-warning" id="confirmacion"></div>
                            </div>
                            <div class="modal-footer">
                                <a id="si" role="button" class="btn btn-primary">
                                    <span class="glyphicon glyphicon-ok-sign"></span> Si</a>
                                <button type="button" class="btn btn-default" data-dismiss="modal">
                                    <span class="glyphicon glyphicon-remove"></span> No</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!--FIN MODAL ANULAR-->
                <!--INICIA MODAL ACTIVAR-->
                <div class="modal fade" id="activar" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">x</button>
                                <h4 class="data-title custom_align" id="Heading" >Atencion!!!</h4>
                            </div>
                            <div class="modal-body">
                                <div class="alert alert-warning" id="confirmacion">Desea activar el registro?</div>
                            </div>
                            <div class="modal-footer">
                                <a id="si_activar" role="button" class="btn btn-primary">
                                    <span class="glyphicon glyphicon-ok-sign"></span> Si</a>
                                <button type="button" class="btn btn-default" data-dismiss="modal">
                                    <span class="glyphicon glyphicon-remove"></span> No</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!--FIN MODAL ACTIVAR-->
        </div> <!--Final wrapper--> 
        <script>
            $("#mensaje").delay(4000).slideUp(200, function () {
                $(this).alert('close');
            });
            $('.modal').on('shown.bs.modal', function () {
                $(this).find('input:text:visible:first').focus();
            });
        </script>
        <script>
            function editar(datos) {
                var dat = datos.split("_");
                $('#cod').val(dat[0]);
                $('#descri').val(dat[1]);
            }
            function deshabilitar(datos) {
                var dat = datos.split("_");
                $('#si').attr('href', 'pacientes_control.php?vcod_pacientes=' + dat[0] + '&vid_persona=' + dat[1] + '&accion=3');
                $('#confirmacion').html('<span class="glyphicon glyphicon-warning-sign"></span> \n\
                                Desea inhabilitar datos del Paciente <i><strong>' + dat[1] + '</strong></i>');
            }
            function activar(datos) {
                var dat = datos.split("_");
                var vcod_pacientes = dat[0];
                var vid_persona = dat[1];
                var vpac_estado = dat[2];
                // Configurar la URL para enviar los datos al script ciudad_control.php
                var url = 'pacientes_control.php?accion=4&vcod_pacientes=' + vcod_pacientes + '&vid_persona=' + vcod_pacientes + '&vpac_estado=' + vdoc_estado;
                // Actualizar el enlace 'si' con la URL correcta
                $('#si_activar').attr('href', url);

                // Configurar el mensaje de confirmación
                var mensaje = 'Desea activar datos del Pacientes <strong>' + dat[1] + '</strong>?';
                $('#confirmacion').html('<span class="glyphicon glyphicon-warning-sign"></span> ' + mensaje);
            }
        </script>
    </body>
</html>