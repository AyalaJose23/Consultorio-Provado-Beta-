<!DOCTYPE html>
<?php session_start(); ?>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <?php
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
                            <div class="box box-primary" >
                                    <div class="box-header">
                                        <i class="fa fa-plus"></i>
                                        <h3 class="box-title">PERSONAS</h3>
                                        <div class="box-tools">
                                            <a href="personas_index.php" class="btn btn-primary pull-right btn-sm">
                                                <i class="fa fa-arrow-left"></i>
                                            </a>
                                        </div>
                                    </div> <!-- fin de box-header -->
                            <!-- /.row consultas -->
                             
                            <form action="personas_control.php" method="post" accept-charset="utf-8" class="form-horizontal">
                                    <input type="hidden" name="accion" value="1"/>
                                    <input type="hidden" name="vid_persona" value="0"/>    
                            <div class="box-body">
                                    <div class="row">
                                        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                                            <input type="hidden" name="accion" value="1">
                                            <input type="hidden" name="vid_persona" value="0">
                                            <div class="form-group">
                                                <label class="control-label col-lg-2">Nombres:</label>
                                                <div class="col-lg-8">
                                                    <input type="text" name="vper_nombre" class="form-control" required="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-lg-2">Apellido:</label>
                                                <div class="col-lg-8">
                                                    <input type="text" name="vper_apellido" class="form-control" required="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-lg-2">C.I:</label>
                                                <div class="col-lg-8">
                                                    <input type="text" name="vper_ci" class="form-control" required="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-lg-2">R.U.C:</label>
                                                <div class="col-lg-8">
                                                    <input type="text" name="vper_ruc" class="form-control" required="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-lg-2">Fecha de nacimiento:</label>
                                                <div class="col-lg-8">
                                                    <input type="date" name="vper_fnac" class="form-control" required value="<?= date('Y-m-d');?>" max="<?= date('Y-m-d');?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-lg-2">Teléfono:</label>
                                                <div class="col-lg-8">
                                                    <input type="text" name="vper_telefono" class="form-control" required="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-lg-2">Dirección:</label>
                                                <div class="col-lg-8">
                                                    <input type="text" name="vper_direccion" class="form-control" required="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-lg-2">Sexo:</label>
                                                <div class="col-lg-8">
                                                    <input type="text" name="vper_sexo" class="form-control" required minlength="3">
                                                </div>
                                            </div>
                                            <!-- Inicio select de ciudad -->
                                            <div class="form-group">
                                                <label class="control-label col-lg-2">Ciudad:</label>
                                                <div class="col-lg-8">
                                                    <?php $ciudad = consultas::get_datos("select * from ciudad order by id_ciudad"); ?>
                                                    <select class="form-control select2" required name="vid_ciudad">
                                                        <?php if (!empty($ciudad)) { foreach ($ciudad as $ciudadItem) { ?>
                                                            <option value="<?php echo $ciudadItem['id_ciudad'] ?>"><?php echo $ciudadItem['ciu_descri'] ?></option>
                                                        <?php } } else { ?>
                                                            <option value="0">Debe insertar alguna ciudad</option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <!-- Fin select de ciudad -->
                                            <!-- Inicio select de nacionalidad -->
                                            <div class="form-group">
                                                <label class="control-label col-lg-2">Nacionalidad:</label>
                                                <div class="col-lg-8">
                                                    <?php $nacionalidades = consultas::get_datos("select * from nacionalidad order by id_nacion"); ?>
                                                    <select class="form-control select2" required name="vid_nacion">
                                                        <?php if (!empty($nacionalidades)) { foreach ($nacionalidades as $nacionalidad) { ?>
                                                            <option value="<?php echo $nacionalidad['id_nacion'] ?>"><?php echo $nacionalidad['nac_descri'] ?></option>
                                                        <?php } } else { ?>
                                                            <option value="0">Debe insertar alguna nacionalidad</option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <!-- Fin select de nacionalidad -->
                                            <div class="box-footer">
                                                <button type="submit" class="btn btn-primary pull-right">
                                                    <i class="fa fa-floppy-o"></i>Registrar
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>

                            </div> <!--Final box primary-->

                        </div> <!--Final de col-->
                    </div> <!--Final de row-->
                </div> <!--Final de Contenedor-->     
            </div> <!--Final de  content-wrapper-->
        </div> <!--Final wrapper-->
    </body>
    <?php require '../../estilos/pie.ctp'; ?>
    <?php require '../../estilos/js_lte.ctp'; ?><!--ARCHIVOS JS-->
</html>