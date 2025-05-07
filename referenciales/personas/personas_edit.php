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
                                 <?php $personas = consultas::get_datos("select * from v_personas where id_persona =" . $_REQUEST['vid_persona'] . "");?>
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                                            <input type="hidden" name="accion" value="2">
                                            <input type="hidden" name="vid_persona" value="<?php echo $personas[0]['id_persona'] ?>">
                                            <div class="form-group">
                                        <label class="control-label col-lg-2 col-md-2 col-xs-2 col-sm-2" > Nombre: </label>
                                        <div class="col-lg-6 col-md-6 col-xs-6 col-sm-6">
                                            <input type="text" name="vper_nombre" class="form-control" required="" autofocus=""
                                                   value="<?php echo $personas[0]['per_nombre'] ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-lg-2 col-md-2 col-xs-2 col-sm-2" > Apellido: </label>
                                        <div class="col-lg-6 col-md-6 col-xs-6 col-sm-6">
                                            <input type="text" name="vper_apellido" class="form-control" required="" autofocus=""
                                                   value="<?php echo $personas[0]['per_apellido'] ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-lg-2 col-md-2 col-xs-2 col-sm-2" > C.I: </label>
                                        <div class="col-lg-6 col-md-6 col-xs-6 col-sm-6">
                                            <input type="text" name="vper_ci" class="form-control" required="" autofocus=""
                                                   value="<?php echo $personas[0]['per_ci'] ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-lg-2 col-md-2 col-xs-2 col-sm-2" > R.U.C: </label>
                                        <div class="col-lg-6 col-md-6 col-xs-6 col-sm-6">
                                            <input type="text" name="vper_ruc" class="form-control" required="" autofocus=""
                                                   value="<?php echo $personas[0]['per_ruc'] ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-lg-2 col-md-2 col-xs-2 col-sm-2" > Fecha de nacimiento: </label>
                                        <div class="col-lg-6 col-md-6 col-xs-6 col-sm-6">
                                            <input type="date" name="vper_fnac" class="form-control" required="" autofocus=""
                                                   value="<?= $personas[0]['per_fnac'];?>" max="<?= date('Y-m-d');?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-lg-2 col-md-2 col-xs-2 col-sm-2" > Teléfono: </label>
                                        <div class="col-lg-6 col-md-6 col-xs-6 col-sm-6">
                                            <input type="text" name="vper_telefono" class="form-control" required="" autofocus=""
                                                   value="<?php echo $personas[0]['per_telefono'] ?>">
                                        </div> 
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-lg-2 col-md-2 col-xs-2 col-sm-2" > Direccion: </label>
                                        <div class="col-lg-6 col-md-6 col-xs-6 col-sm-6">
                                            <input type="text" name="vper_direccion" class="form-control" required="" autofocus=""
                                                   value="<?php echo $personas[0]['per_direccion'] ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-lg-2 col-md-2 col-xs-2 col-sm-2" > Sexo: </label>
                                        <div class="col-lg-6 col-md-6 col-xs-6 col-sm-6">
                                            <input type="text" name="vper_sexo" class="form-control" required="" autofocus=""
                                                   value="<?php echo $personas[0]['per_sexo'] ?>">
                                        </div>
                                    </div>
                                    <!-- inicio select de marcas -->
                                        <div class="form-group">
                                            <label class="control-label col-lg-2">Ciudad: </label>
                                            <div class="col-lg-8">
                                              <?php
                                              $ciudad = consultas::get_datos("select * from ciudad order by ciu_descri = '" . $personas[0]['ciu_descri'] ."' DESC");?>
                                                <select class="form-control select2" required="" name="vid_ciudad">
                                                 <?php if (!empty($ciudad)) {  
                                                     foreach ($ciudad as $ciudad) { ?>
                                                    <option value="<?php echo $ciudad['id_ciudad'] ?>"><?php echo $ciudad['ciu_descri'] ?></option>
                                                   <?php } ?>                                                     
                                                    <?php  } else {  ?>
                                                      <option value="0">debe insertar alguna ciudad</option> 
                                               <?php  } ?>    
                                                </select>
                                            </div>
                                        </div>
                                        <!-- fin select de marcas -->
                                         <!-- inicio select de modelo -->
                                        <div class="form-group">
                                            <label class="control-label col-lg-2">Nacionalidad: </label>
                                            <div class="col-lg-8">
                                              <?php
                                              $nacionalidades = consultas::get_datos("select * from nacionalidad order by nac_descri = '" . $personas[0]['nac_descri'] . "' DESC ");?>
                                                <select class="form-control select2" required="" name="vid_nacion">
                                                 <?php if (!empty($nacionalidades)) {  
                                                     foreach ($nacionalidades as $nacionalidad) { ?>
                                                    <option value="<?php echo $nacionalidad['id_nacion'] ?>"><?php echo $nacionalidad['nac_descri'] ?></option>
                                                   <?php } ?>                                                     
                                                    <?php  } else {  ?>
                                                      <option value="0">debe insertar alguna nacionalidad</option> 
                                               <?php  } ?>    
                                                </select>
                                            </div>
                                        </div>
                                        <!-- fin select de modelo -->
                                           <div class="box-footer">
                                            <button type="submit" class="btn btn-warning pull-right">
                                            <i class="fa fa-edit"></i>Modificar
                                            </button>
                                        </div>
                                        </div> <!--Final de col consulta-->
                                    </div> <!--Final row consultas-->
                                </div> <!--Final box body consultas-->
                                </form>
                            </div> <!--Final box primary-->

                        </div> <!--Final de col-->
                    </div> <!--Final de row-->
                </div> <!--Final de Contenedor-->     
            </div> <!--Final de  content-wrapper-->
        </div> <!--Final wrapper-->
    </body>
    <?php require '../../estilos/pie.ctp'; ?>
    <?php require '../../estilos/js_lte.ctp'; ?><!--ARCHIVOS JS-->
</html>
