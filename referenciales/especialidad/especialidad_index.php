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
    <body class="hold-transition skin-purple sidebar-mini">  <!--Cabecera y menu izquierda-->
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
                                <strong>REGISTRO DE ESPECIALIDADES</strong>
                                <a href="/tdp/MANUAL DE USUARIO tdp.pdf" target="print">
                                    <span class="glyphicon glyphicon-question-sign"></span>
                                </a>
                                <a href="especialidad_add.php" class="btn btn-purple btn-sm pull-right" data-title="Agregar" rel="tooltip">
                                    <i class="fa fa-plus"></i> Agregar Especialidad
                                </a>
                            </h3>
                        </div>
                    </div>

                    <!-- Formulario de búsqueda -->
                    <div class="panel-body no-padding">
                        <form action="personas_index.php" method="post" accept-charset="utf8" class="form-horizontal">
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
                            <div class="panel-heading">Datos de las Especialidades</div>
                            <div class="panel-body">
                                                <?php
                                                $especialidades = consultas::get_datos("select * from especialidad ORDER BY cod_especialidad");
                                                if (!empty($especialidades)) { ?>
                                                <div>
                                                    <table class="table table-bordered table-striped ">
                                                        <thead>
                                                            <tr>
                                                                <th>Codigo</th>
                                                                <th>Especialidad</th>
                                                                <th>Estado</th>
                                                                <th class="text-center">Acciones</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php foreach ($especialidades as $especialidad) { ?>
                                                            <tr>
                                                                <td><?php echo $especialidad['cod_especialidad']; ?></td>
                                                                <td><?php echo $especialidad['descrip_espec'] ?></td>
                                                                <td><?php echo $especialidad['estado_espec'] ?></td>
                                                                <td class="text-center">
                                                                    <a onclick="editar(<?php echo "'" . $especialidad['cod_especialidad'] . "_" . $especialidad['descrip_espec'] . "'" ?>)" 
                                                                    class="btn btn-warning btn-sm" data-title="editar" rel="tooltip" data-toggle="modal" data-target="#editar">
                                                                    <i class="fa fa-edit"></i>
                                                                    </a>
                                                                    <a onclick="borrar(<?php echo "'" . $especialidad['cod_especialidad'] . "_" . $especialidad['descrip_espec'] . "'" ?>)" 
                                                                    accesskey=""class="btn btn-danger btn-sm" data-title="borrar" rel="tooltip" data-toggle="modal" data-target="#borrar">
                                                                    <i class="fa fa-trash"></i>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                             <?php } ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                              <?php  } else { ?>
                                                <div class="alert alert-info flat">
                                                    <span class="glyphicon glyphicon-info-sign"></span>
                                                    no se han registrado especialidades...
                                                </div>
                                                <?php }
                                                ?>
                                            </div> <!--Final de col consulta-->
                                        </div> <!--Final row consultas-->
                                    </div> <!--Final box body consultas-->
                                </div> <!--Final box primary-->
                            </div> <!--Final de col-->
                        </div> <!--Final de row-->
                    </div> <!--Final de Contenedor-->     
                </div> <!--Final de  content-wrapper-->
                <!-- INICIO MODAL REGISTRAR -->
                    <div class="modal fade" id="registrar" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="close">X</button>
                                <h4 class="modal-title"><strong>Registrar Especialidad</strong></h4>
                                </div>
                                <form action="especialidad_control.php" method="post" accept-charset="utf-8" class="form-horizontal">
                                    <input name="accion" value="1" type="hidden">
                                    <input name="vcod_especialidad" value="0" type="hidden">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label">Especialidad:</label>
                                            <div class="col-lg-8">
                                                <input type="text" class="form-control" name="vdescrip_espec" required="">   
                                            </div>
                                        </div>
                                    </div>
                                    <div class="box-footer">
                                        <button type="reset" data-dismiss="modal" class="btn btn-danger">Cerrar</button>
                                        <button type="submit" class="btn btn-primary pull-right">Registrar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- FIN MODAL REGISTRAR -->
                    <!-- INICIO MODAL EDITAR -->
                    <div class="modal fade" id="editar" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="close">X</button>
                                <h4 class="modal-title"><strong>Editar Especialidad</strong></h4>
                                </div>
                                <form action="especialidad_control.php" method="post" accept-charset="utf-8" class="form-horizontal">
                                    <input name="accion" value="2" type="hidden">
                                    <input id="cod" name="vcod_especialidad" value="0" type="hidden">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label">Especialidad:</label>
                                            <div class="col-lg-8">
                                                <input id="descri" type="text" class="form-control" name="vdescrip_espec" required="">   
                                            </div>
                                        </div>
                                    </div>
                                    <div class="box-footer">
                                        <button type="reset" data-dismiss="modal" class="btn btn-danger">Cerrar</button>
                                        <button type="submit" class="btn btn-primary pull-right">Actualizar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- FIN MODAL EDITAR -->
                    <!-- INICIO MODAL BORRAR -->
<div class="modal fade" id="borrar" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content" style="border-radius: 8px; overflow: hidden; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);">
            <div class="modal-header" style="background-color: #d8b4f2; color: #4a2d8b;">
                <button type="button" class="close" data-dismiss="modal" aria-label="close" style="color: #4a2d8b;">X</button>
                <h4 class="modal-title custom-align" id="Heading"><strong>¡Atención!</strong></h4>
            </div>
            <div class="modal-body" style="background-color: #f8e9ff;">
                <div class="alert alert-danger" id="confirmacion" style="margin-bottom: 0;">
                    <p>¿Estás seguro de que deseas borrar esto?</p>
                </div>
            </div>
            <div class="modal-footer" style="background-color: #ececec;">
                <a id="si" role="button" class="btn btn-primary" style="background-color: #b087e0; border-color: #b087e0; color: #fff;">
                    <span class="glyphicon glyphicon-ok-sign"></span> Sí
                </a>
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    <span class="glyphicon glyphicon-remove"></span> No
                </button>
            </div>
        </div>
    </div>
</div>
<!-- FIN MODAL BORRAR -->

        </div> <!--Final wrapper-->
         <?php require '../../estilos/pie.ctp'; ?>
         <?php require '../../estilos/js_lte.ctp'; ?><!--ARCHIVOS JS-->
        <script>
        $('.modal').on('shown.bs.modal',function(){
            $(this).find('input:text:visible:first').focus();
        });
        function editar(datos) {
            var dat = datos.split("_");
            $('#cod').val(dat[0]);
            $('#descri').val(dat[1]);
        }
        function borrar(datos){
             var dat = datos.split("_");
             $('#si').attr('href','especialidad_control.php?vcod_especialidad=' + dat[0] + '&vdescrip_espec=' + dat[1] + '&accion=3');
             $('#confirmacion').html('<span class="glyphicon glyphicon-warning-sign"></span> Desea borrar el Registro  <i><strong>' 
                     + dat[1] + '</strong></i>? ');
        }
        </script>
    </body>
</html>
