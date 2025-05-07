<!DOCTYPE html>
<html>
    <head>
         <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="shortcut icon" type="image/x-icon" href="/taller3/img/abm.png">
        <title>CENTRO MEDICO VIDA Y AMOR</title>
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
        <div class="container">
            <div class="content">
                <div class="row">
                    <!--impresion del titulo de la pagina-->
                    <div class="col-lg-12">
                    <h3 class="page-header text-center" style="background-color: rgba(147, 112, 219, 0.5); color: #800080;"> 
                        <strong>AÑADIR CONSULTA</strong>
                        <a href="consultas_index.php" 
                        class="btn btn-purple pull-right" 
                        rel='tooltip' title="Atras">
                            <i class="glyphicon glyphicon-arrow-left"></i>
                        </a> 
                    </h3>
                </div>
   
                </div>
                                <!--Inicio de cabecera -->
                                <?php
                                    $consulta = consultas::get_datos("select * FROM v_consulta WHERE cod_consulta =" . $_REQUEST['vcod_consulta']);
                                    if (!empty($consulta)) {
                                        if ($consulta[0]['con_estado'] == "PENDIENTE") {
                                            ?> <!--Si el estado de la consulta no es igual a PENDIENTE, no se muestran los botones -->
                                
                                            <div class="buttons-container">
                                                <a href="ordenanalisis_add.php" class="btn btn-purple btn-sm" data-title="Agregar" rel="tooltip">
                                                    <i class="fa fa-plus"></i> Orden de Análisis
                                                </a>
                                                <a href="ordenestudios_add.php" class="btn btn-purple btn-sm" data-title="Agregar" rel="tooltip">
                                                    <i class="fa fa-plus"></i> Orden de Estudios
                                                </a>
                                                <a href="recetasindicaciones_add.php" class="btn btn-purple btn-sm" data-title="Agregar" rel="tooltip">
                                                    <i class="fa fa-plus"></i> Recetas/Indicaciones
                                                </a>
                                            </div>
                                            <?php
                                        }
                                    } else {
                                        echo "<div class='alert alert-warning'>Consulta no encontrada o datos no disponibles.</div>";
                                    }
                                    ?>

                                
                                <div class="row">
                                    
                                    <div class="col-md-6">
                                        
                                        <button class="btn btn-primary form-control" data-toggle="modal" data-target="#ficha-modal" 
                                                class="btn btn-danger btn-sm" role="button" data-title="Ficha" rel="tooltip" data-placement="top">Ficha del paciente</button>
                                    </div>
                                    <div class="col-md-6">
                                        <button class="btn btn-primary form-control" data-toggle="modal" data-target="#historial-modal" class="btn btn-danger btn-sm" role="button" data-title="Historial" rel="tooltip" data-placement="top">Historial del paciente</button>
                                    </div>

                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">                                                                                     
                                        <?php
                                        $consulta = consultas::get_datos("select * FROM v_consulta WHERE cod_consulta =" . $_REQUEST['vcod_consulta']);
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
                                <!--Fin de cabecera -->
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">                               
                                        <?php
                                        $detalletratamientos = consultas::get_datos("select * from v_consultadetalle where cod_consulta= " . $_REQUEST['vcod_consulta']);
                                        if (!empty($detalletratamientos)) {
                                            ?>
                                             <div class="col-md-12">
                                               
                                            <div class="card-header">
                                                <h4 class="box-title"style="background-color: rgba(147, 112, 219, 0.5); color: #800080;">DETALLE CONSULTA</h4>
                                            </div>
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-striped table-condensed table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Síntomas</th>
                                                            <th>Observacion</th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($detalletratamientos as $detalles) { ?>
                                                            <tr>
                                                                <td data-title="#"><?php echo $detalles['cod_consulta']; ?></td>
                                                                <td data-title="Doctor"><?php echo $detalles['sin_descri']; ?></td>
                                                                <td data-title="Especialidad"><?php echo $detalles['observacion']; ?></td>
                                                                <td class="text-center">
                                                                    <?php if (!empty($consulta) && $consulta[0]['con_estado'] == "PENDIENTE") { ?>
                                                                        <a onclick="editar(<?php echo $detalles['cod_consulta']; ?>, <?php echo $detalles['sin_cod']; ?>)"
                                                                        class="btn btn-warning btn-sm" data-title="Editar" rel="tooltip" data-placement="left" data-toggle="modal" data-target="#editar">
                                                                            <i class="fa fa-edit"></i>
                                                                        </a> 
                                                                        <a onclick="borrar('<?php echo $detalles['cod_consulta'] . "_" . $detalles['sin_cod']; ?>')" 
                                                                        data-toggle="modal" data-target="#borrar" class="btn btn-danger btn-sm" role="button" data-title="Quitar" rel="tooltip" data-placement="top">
                                                                            <i class="fa fa-trash"></i>
                                                                        </a>
                                                                    <?php } ?>
                                                                </td>
                                                            </tr>
                                                        <?php } ?>
                                                    </tbody>

                                                </table>
                                            </div>
                                        <?php } else { ?>
                                            <div class="alert alert-info">
                                                <span class="glyphicon glyphicon-info-sign"></span> 
                                                La consulta aún no tiene detalle
                                            </div>      
                                        <?php } ?>
                                    </div>
                                </div>
                                <!--Fin de detalle -->
                                <div class="box-body">
                                    <form action="consultadetalle_control.php" method="post">
                                        <input type="hidden" name="accion" value="1">
                                        <input type="hidden" name="vcod_consulta" value="<?php echo $consulta[0]['cod_consulta'] ?>"/>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="card-header text-center" style="background-color: rgba(147, 112, 219, 0.5); color: #800080;">
                                                    <strong>COMPLETA LOS DATOS DEL DETALLE </strong>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <label for="vsin_cod">Síntomas:</label>
                                                <?php
                                                $sintomas = consultas::get_datos("SELECT * FROM sintomas ORDER BY sin_cod");
                                                ?>
                                                <select class="form-control" name="vsin_cod" required id="vsin_cod" 
                                                        <?php echo ($consulta[0]['con_estado'] != "PENDIENTE") ? 'disabled title="La consulta ya está confirmada"' : ''; ?>>
                                                    <option value="0">Seleccionar Síntomas</option>
                                                    <?php foreach ($sintomas as $sintoma) : ?>
                                                        <option value="<?php echo $sintoma['sin_cod']; ?>"><?php echo $sintoma['sin_descri']; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <label>Observación</label>
                                                <input type="text" value="SIN OBSERVACION" class="form-control" name="vobservacion" id="vobservacion" 
                                                    <?php echo ($consulta[0]['con_estado'] != "PENDIENTE") ? 'disabled title="La consulta ya está confirmada"' : ''; ?>>
                                            </div>
                                        </div>
                                        <div class="box-footer">
                                            <a href="consultas_index.php" class="btn btn-default">
                                                <i class="fa fa-remove"></i> CERRAR
                                            </a> 
                                            <button type="submit" class="btn btn-purple pull-right" 
                                                    <?php echo ($consulta[0]['con_estado'] != "PENDIENTE") ? 'disabled title="La consulta ya está confirmada"' : ''; ?>>
                                                <span class="glyphicon glyphicon-floppy-saved"></span> Agregar
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
            <!--Modal Detalle de Ficha -->
            <div class="modal" id="ficha-modal" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header" style="background-color: #3498db; color: white;">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">X</button>
                            <h4 class="modal-title center-block">VISUALIZACION DE FICHA DEL PACIENTE</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <?php
                                    $patologias = consultas::get_datos("SELECT
                                    p.pat_descri
                                    FROM ficha_medica fm 
                                    JOIN detalle_patologias dp 
                                    ON dp.cod_ficha =  fm.cod_ficha
                                    JOIN consulta c 
                                    ON c.cod_consulta = " . $_GET['vcod_consulta'] . "
                                    JOIN patologias p 
                                    ON p.pat_cod = dp.pat_cod
                                    WHERE fm.cod_pecientes = c.cod_pecientes");
                                    if (!empty($patologias)) {
                                        ?>
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>PATOLOGIAS</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($patologias as $pat) { ?>
                                                    <tr>
                                                        <td data-title="#"><?php echo $pat['pat_descri']; ?></td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                <?php } else { ?>
                                    <div class="alert alert-info">
                                        <span class="glyphicon glyphicon-info-sign"></span> 
                                        Sin Registros...
                                    </div>      
                                <?php } ?>

                                <div class="col-md-6">
                                    <?php
                                    $alergia = consultas::get_datos("SELECT
                                p.ale_descri,
                                fm.cod_pecientes
                                FROM ficha_medica fm 
                                JOIN detalle_alergias dp 
                                ON dp.cod_ficha =  fm.cod_ficha
                                JOIN consulta c 
                                ON c.cod_consulta = " . $_GET['vcod_consulta'] . "
                                JOIN alergias p 
                                ON p.ale_cod = dp.ale_cod
                                WHERE fm.cod_pecientes = c.cod_pecientes;");
                                    if (!empty($alergia)) {
                                        ?>
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>ALERGIAS</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($alergia as $aler) { ?>
                                                    <tr>
                                                        <td data-title="#"><?php echo $aler['ale_descri']; ?></td>
                                                    </tr>
                                                    <?php
                                                    $_SESSION['cod_pecientes'] = $aler['cod_pecientes'];
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                <?php } else { ?>
                                    <div class="alert alert-info">
                                        <span class="glyphicon glyphicon-info-sign"></span> 
                                        Sin Registros...
                                    </div>      
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--Fin Modal Detalle de Ficha -->
            <!--Modal Detalle de Historial -->
            <div class="modal modal-lg" id="historial-modal" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header" style="background-color: #3498db; color: white;">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">X</button>
                            <h4 class="modal-title center-block">VISUALIZACION DE HISTORIAL DEL PACIENTE</h4>
                        </div>
                        <div class="modal-body">
                            <?php
                            $historial = consultas::get_datos(" select * from v_historial where cod_pecientes = " . $_SESSION['cod_pecientes']);
                            if (!empty($historial)) {
                                ?>
                                <div class="row">
                                    <div class="col-md-10">
                                        <table class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th style="color: white;">TIPO</th>
                                                    <th style="color: white;">FECHA</th>
                                                    <th style="color: white;">DESCRIPCION</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if ($historial != null) {
                                                    foreach ($historial as $his) {
                                                        ?>
                                                        <tr>
                                                            <td data-title="#"><?php echo $his['tipo']; ?></td>
                                                            <td data-title="#"><?php echo $his['fecha']; ?></td>
                                                            <td data-title="#"><?php echo $his['descripcion']; ?></td>
                                                        </tr>  
                                                        <?php
                                                    }
                                                } else {
                                                    ?>
                                                    <tr>
                                                        <td data-title="#" colspan="3" style="color: white;">NO HAY HISTORIAL</td>
                                                    </tr> 
                                                <?php }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            <?php } else { ?>
                                <div class="alert alert-info">
                                    <span class="glyphicon glyphicon-info-sign"></span> 
                                    No hay registros...
                                </div>      
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <!--Fin Modal Detalle de Historial -->
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
// Muestra el mensaje
            document.getElementById('mensaje').style.display = 'block';

// Desaparece el mensaje después de 5 segundos
            setTimeout(function () {
                document.getElementById('mensaje').style.display = 'none';
            }, 5000);
        </script>
        <script>
            $("#mensaje").delay(4000).slideUp(200, function () {
                $(this).alert('close');
            });
        </script>
        <script>
            function borrar(datos) {
                var dat = datos.split('_');
                $('#si').attr('href', 'consultadetalle_control.php?vcod_consulta=' + dat[0] + '&vsin_cod=' + dat[1] + '&accion=2');
                $("#confirmacion").html('<span class="glyphicon glyphicon-warning-sign"></span> \n\
        Deseas Borrar el detalle de la Consulta N° <strong>' + dat[0] + '</strong> ?');
            }

            function remover(tr) {
                $(tr).remove();
            }

            function editar(consulta, sintomas) {
                $.ajax({
                    type: "GET",
                    url: "consultadetalle_modificar.php?vcod_consulta=" + consulta + "&vsin_cod=" + sintomas,
                    cache: false,
                    beforeSend: function () {
                        $("#detalles").html('<img src="img/loader.gif" /><strong>Cargando...</strong>')
                    },
                    success: function (data) {
                        $("#detalles").html(data)
                    }
                })
            }
            ;
        </script>
    </body>
</html>

