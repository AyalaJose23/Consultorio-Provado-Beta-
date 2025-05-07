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

    </head>
    <body class="hold-transition skin-purple sidebar-mini">
        <div class="wrapper">
        <?php require '../../estilos/cabecera.ctp'; ?>
        <?php require '../../estilos/izquierda.ctp'; ?><!--MENU PRINCIPAL-->
            <div class="content-wrapper">
                <section class="content">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <?php if (!empty($_SESSION['mensaje'])) { ?>
                                <div class="alert alert-danger" role="alert" id="mensaje">
                                    <span class="glyphicon glyphicon-exclamation-sign"></span>
                                    <?php
                                    echo $_SESSION['mensaje'];
                                    $_SESSION['mensaje'] = '';
                                    ?>
                                </div>
                            <?php } ?>
                            <div class="panel panel-info">
                                <div class="panel-heading">
                                <h3 class="page-header text-center" style="background-color: rgba(147, 112, 219, 0.5); color: #800080;">
                                    <strong>AGREGAR DETALLE DE ORDEN DE ANALISIS</strong>
                                    <a href="ordenanalisis_add.php" class="btn btn-purple pull-right" rel="tooltip" title="Atrás">
                                        <i class="glyphicon glyphicon-arrow-left"></i>
                                    </a>
                                </h3>
                                </div>
                                <!--Inicio de cabecera -->
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">                                                                                     
                                        <?php
                                        $consulta = consultas::get_datos("select * FROM v_consultadetalle WHERE cod_consulta = (select max(cod_consulta) from v_consultadetalle)");
                                        if (!empty($consulta)) {
                                            ?>
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-striped table-condensed table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Fecha</th>
                                                            <th>Paciente</th>
                                                            <th>Tipo de Consulta</th>
                                                            <th>Motivo</th>
                                                            <th>Sintoma</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($consulta as $consul) { ?>
                                                            <tr>
                                                                <td data-title="#"><?php echo $consul['cod_consulta']; ?></td>
                                                                <td data-title="Fecha"><?php echo $consul['con_fecha']; ?></td>
                                                                <td data-title="Paciente"><?php echo $consul['paciente']; ?></td>
                                                                <td data-title="Tipo de Consulta"><?php echo $consul['tipcon_descri']; ?></td>
                                                                <td data-title="Motivo"><?php echo $consul['cons_motivo']; ?></td>
                                                                <td data-title="Sintomas"><?php echo $consul['sin_descri']; ?></td>

                                                            </tr>  
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        <?php } else { ?>
                                            <div class="alert alert-info">
                                                <span class="glyphicon glyphicon-info-sign"></span> 
                                                No se han registrado la Cabecera...
                                            </div>      
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">                                                                                     
                                        <?php
                                        $ordenestudios = consultas::get_datos("select * FROM v_ordenanalisis WHERE cod_analisis = (select max(cod_analisis) from v_ordenanalisis)");
                                        if (!empty($ordenestudios)) {
                                            ?>
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-striped table-condensed table-hover">

                                                    <tbody>
                                                        <?php foreach ($ordenestudios as $oe) { ?>
                                                            <tr>
                                                                <td  class="cod_analisis"><?php echo $oe['cod_analisis']; ?></td>
                                                            </tr>  
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                                <!--Fin de cabecera -->
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">                               
                                        <?php
                                        $detalletratamientos = consultas::get_datos("select * from v_ordenanalisisdetalle where cod_analisis= " . $_REQUEST['vcod_analisis']);
                                        if (!empty($detalletratamientos)) {
                                            ?>
                                            <div class="box-header">
                                                <i class="fa fa-list"></i>
                                                <h3 class="box-title">Detalle Orden de Analisis</h3>
                                            </div>
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-striped table-condensed table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Tipo de Analisis</th>
                                                            <th>Observacion</th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($detalletratamientos as $detalles) { ?>
                                                            <tr>
                                                                <td data-title="#"><?php echo $detalles['cod_analisis']; ?></td>
                                                                <td data-title="Doctor"><?php echo $detalles['descrip_t_analisis']; ?></td>
                                                                <td data-title="Especialidad"><?php echo $detalles['descrip_analisis']; ?></td>
                                                                <td class="text-center">

                                                                    <a onclick="editar(<?php echo $detalles['cod_t_analisis']; ?>, <?php echo $detalles['cod_t_analisis']; ?>)"
                                                                       class="btn btn-warning btn-sm" data-title="Editar" rel="tooltip" data-placement="left" data-toggle="modal" data-target="#editar">
                                                                        <i class="fa fa-edit"></i>
                                                                    </a> 
                                                                    <a onclick="borrar('<?php echo $detalles['cod_t_analisis'] . "_" . $detalles['cod_t_analisis']; ?>')" 
                                                                       data-toggle="modal" data-target="#borrar" class="btn btn-danger btn-sm" role="button" data-title="Quitar" rel="tooltip" data-placement="top">
                                                                        <i class="fa fa-trash"></i>
                                                                    </a>
                                                                </td>
                                                            </tr> 
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        <?php } else { ?>
                                            <div class="alert alert-info">
                                                <span class="glyphicon glyphicon-info-sign"></span> 
                                                Orden de Analisis aún no tiene detalle
                                            </div>      
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="box-body">
                                    <form action="ordenanalisisdetalle_control.php" method="post">
                                        <input type="hidden" name="accion" value="1">
                                        <input type="hidden" name="vcod_analisis"  value="<?php echo $ordenestudios[0]['cod_analisis'] ?>"/>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="card-header text-center" style="background-color: rgba(147, 112, 219, 0.5); color: #800080;">
                                                    COMPLETA LOS DATOS DEL DETALLE
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <label for="vcod_t_analisis">Tipo de Analisis:</label>
                                                <?php
                                                $tipoestudio = consultas::get_datos("SELECT * FROM v_tipoanalisis ORDER BY cod_t_analisis");
                                                ?>
                                                <select class="form-control" name="vcod_t_analisis" required id="vcod_t_analisis">
                                                    <option value="0">Seleccionar Tipo de Estudio</option>
                                                    <?php foreach ($tipoestudio as $tipoe) : ?>
                                                        <option value="<?php echo $tipoe['cod_t_analisis']; ?>"><?php echo $tipoe['descrip_t_analisis']; ?> </option> - 
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <label>Observacion</label>
                                                <input type="text" value="SIN OBSERVACION" class="form-control" name="vdescrip_analisis" id="Vdescrip_analisis" >
                                            </div>
                                        </div>
                                        <div class="box-footer">
                                            <a href="ordenestudios_index.php" class="btn btn-default">
                                                <i class="fa fa-remove"></i> CERRAR
                                            </a> 
                                            <button type="submit" class="btn btn-primary pull-right">
                                                <span class="glyphicon glyphicon-floppy-saved"></span> Registrar
                                            </button>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <?php require '../../estilos/pie.ctp'; ?> 
             <div class="modal" id="borrar" role="dialog">
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
            <!-- MODAL EDITAR-->
                <div class="modal" id="editar" role="dialog">
                      <div class="modal-dialog">
                          <div class="modal-content" id="detalles"></div>
                      </div>
                </div>
            <!-- FIN MODAL EDITAR-->
        </div>                  
        <?php require '../../estilos/js_lte.ctp'; ?><!--ARCHIVOS JS-->
        <script>
            $("#mensaje").delay(4000).slideUp(200, function () {
                $(this).alert('close');
            });
        </script>
        <script>  
            
            function remover(tr) {
                $(tr).remove();
            }
            
            function borrar(datos) {
                var dat = datos.split('_');
                $('#si').attr('href', 'ordenanalisisdetalle_control.php?vcod_analisis=' + dat[0] + '&vcod_t_analisis=' + dat[1] + '&accion=2');
                $("#confirmacion").html('<span class="glyphicon glyphicon-warning-sign"></span> \n\
        Deseas Borrar el detalle de la Orden de Estudio N° <strong>' + dat[0] + '</strong> ?');
            }
            function editar(cod_analisis,cod_t_analisis){
            $.ajax({
                type    : "GET",
                url     : "ordenanalisisdetalle_modificar.php?vcod_analisis="+cod_analisis+"&vcod_t_analisis="+cod_t_analisis,
                cache   : false,
                beforeSend:function(){
                    $("#detalles").html('<img src="img/loader.gif" /><strong>Cargando...</strong>')
                },
                success:function(data){
                    $("#detalles").html(data)
                }
            })
        };
        
        </script>
    </body>
</html>

