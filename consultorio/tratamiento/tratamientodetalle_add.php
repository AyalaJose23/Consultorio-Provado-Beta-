<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="shortcut icon" type="image/x-icon" href="/sistema_consultorio/favicon.ico">
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
            <?php require '../../estilos/izquierda.ctp'; ?>
                <div class="content-wrapper">
                    <section class="content">
                        <div class="row">
                            <div class="col-lg-12">
                                <h3 class="page-header text-center" style="background-color: rgba(147, 112, 219, 0.5); color: #800080;"> 
                                    <strong>AÑADIR DETALLE</strong>
                                    <a href="tratamiento_index.php" 
                                    class="btn btn-purple pull-right" 
                                    rel='tooltip' title="Atras">
                                        <i class="glyphicon glyphicon-arrow-left"></i>
                                    </a> 
                                </h3> 
                            </div>
                        </div>
                                <!--Inicio de cabecera -->
                                
                                <!--Fin de cabecera -->
                               <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">                                                                                     
                                        <?php
                                        $detalletratamiento = consultas::get_datos("select * FROM v_tratamientos WHERE cod_trata = (select max(cod_trata) from v_tratamientos)");
                                        if (!empty($detalletratamiento)) {
                                            ?>
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-striped table-condensed table-hover">
                                                    <thead>
                                                    <label>Datos de la cabecera</label>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Paciente</th>
                                                            <th>Fecha</th>
                                                            <th>#Diagnostico</th>
                                                            <th>Enfermedad</th>
                                                            <th>Tipo de Enfermedad</th>
                                                            <th>Descripcion</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($detalletratamiento as $diag) { ?>
                                                            <tr>
                                                                <td data-title="#"><?php echo $diag['cod_trata']; ?></td>
                                                                <td data-title="Paciente"><?php echo $diag['paciente']; ?></td>
                                                                <td data-title="Fecha"><?php echo $diag['tra_fecha']; ?></td>
                                                                <td data-title="Estado"><?php echo $diag['cod_diag']; ?></td>
                                                                <td data-title="Estado"><?php echo $diag['enfe_descri']; ?></td>
                                                                <td data-title="Estado"><?php echo $diag['descrip_t_enfer']; ?></td>
                                                                <td data-title="Estado"><?php echo $diag['detalle_descri']; ?></td>
                                                            </tr>  
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                                <!--Inicio de detalle agregar-->
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">                               
                                        <?php
                                        $detalletratamientos = consultas::get_datos("select * from v_detalletratamiento where cod_trata= ".$_REQUEST['vcod_trata']); 
                                        if (!empty($detalletratamientos)) {
                                            ?>
                                            <div class="box-header">
                                                <i class="fa fa-list"></i>
                                                <h3 class="box-title">DETALLES</h3>
                                            </div>
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-striped table-condensed table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>TIPO TRATAMIENTO</th>
                                                            <th>PRECIO</th>
                                                            <th>INICIO</th>
                                                            <th>FIN</th>
                                                            <th>OBSERVACION</th>
                                                            <th>ESTADO</th>
                                                            <th class="text-center" >Accciones</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($detalletratamientos as $detalles) { ?>
                                                            <tr>
                                                                <td data-title="#"><?php echo $detalles['cod_trata']; ?></td>
                                                                <td data-title="Doctor"><?php echo $detalles['descrip_t_trata']; ?></td>
                                                                <td data-title="Especialidad"><?php echo $detalles['precio']; ?></td>
                                                                <td data-title="Turno."><?php echo $detalles['fecha_inicio']; ?></td>
                                                                <td data-title="Dia"><?php echo $detalles['fecha_fin']; ?></td>
                                                                <td data-title="Sala"><?php echo $detalles['detalle_observ']; ?></td>
                                                                <td data-title="Sala"><?php echo $detalles['detalle_estado']; ?></td>
                                                                <td class="text-center">
                                                                    <?php if ($detalles['detalle_estado'] == 'PENDIENTE') { ?>
                                                                    <a onclick="confirmar('<?php echo $detalles['cod_trata'] . "_" . $detalles['cod_t_trata']; ?>')" 
                                                                       class="btn btn-success btn-sm" data-title="Confirmar" rel="tooltip" data-placement="left" data-toggle="modal" data-target="#confirmar">
                                                                        <i class="fa fa-check"></i></a>
                                                                    <a onclick="editar(<?php echo $detalles['cod_trata'] . "_" . $detalles['descrip_t_trata']; ?>)"
                                                                       class="btn btn-warning btn-sm" data-title="Editar" rel="tooltip" data-placement="left" data-toggle="modal" data-target="#editar">
                                                                        <i class="fa fa-edit"></i>
                                                                    </a> 
                                                                    <a onclick="borrar('<?php echo $detalles['cod_trata'] . "_" . $detalles['cod_t_trata']; ?>', '<?php echo $detalles['fecha_inicio']; ?>', '<?php echo $detalles['fecha_fin']; ?>')" 
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
                                                El tratamiento aún no tiene detalle
                                            </div>      
                                        <?php } ?>
                                    </div>
                                </div>
                                <!--Fin de detalle -->
                                <div class="box-body">
                                    <form action="tratamientodetalle_control.php" method="post">
                                        <input type="hidden" name="accion" value="1">
                                        <input type="hidden" name="vcod_trata"value="<?php echo $detalletratamiento[0]['cod_trata'] ?>"/>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="card-header text-center" style="background-color: rgba(147, 112, 219, 0.5); color: #800080;">
                                                    COMPLETA LOS DATOS DEL DETALLE
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <label for="vcod_t_trata">Tipo de Tratamiento:</label>
                                                <?php
                                                $tipotratamiento = consultas::get_datos("SELECT * FROM tipo_tratamiento ORDER BY cod_t_trata");
                                                ?>
                                                <select class="form-control" name="vcod_t_trata" required id="vcod_t_trata">
                                                    <option value="0">Seleccionar Tipo de Tratamiento</option>
                                                    <?php foreach ($tipotratamiento as $tipotra) : ?>
                                                        <option value="<?php echo $tipotra['cod_t_trata']; ?>"><?php echo $tipotra['descrip_t_trata']; ?> <?php endforeach; ?>
                                                </select>
                                                <div id="doctores"></div>
                                            </div>

                                            <div class="col-md-3">
                                                <label>Observacion</label>
                                                <input type="text" class="form-control" name="vdetalle_observ" id="vdetalle_observ" >
                                            </div>

                                            <div class="col-md-3">
                                                <label>Precio</label>
                                                <input type="text" value="50.000" class="form-control" name="vprecio" id="vprecio" >
                                            </div>
                                            <br>
                                            <div class="col-md-3">
                                                <label class="control-label">FECHA INICIO:</label>
                                                <input type="date" name="vfecha_inicio" class="form-control" min="<?php echo date("Y-m-d"); ?>" value="<?php echo date("Y-m-d"); ?>">
                                            </div>
                                            <div class="col-md-3">
                                                <label class="control-label">FECHA INICIO:</label>
                                                <input type="date" name="vfecha_fin" class="form-control" min="<?php echo date("Y-m-d"); ?>" value="<?php echo date("Y-m-d"); ?>">
                                            </div>
                                        </div>
                                        <div class="box-footer">
                                            <a href="tratamiento_index.php" class="btn btn-default">
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
            <!-- INICIO MODAL confirmar-->
            <div class="modal" id="confirmar" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">X</button>
                            <h4 class="modal-title custom_align">ATENCIÓN...!!!</h4>
                        </div>
                        <div class="modal-body">
                            <div class="alert alert-success" id="confirmacion"></div>
                        </div>
                        <div class="modal-footer">
                            <a id="si" role="buttom" class="btn btn-success">
                                <span class="glyphicon glyphicon-ok-sign"></span> SI
                            </a>
                            <button type="button" class="btn btn-default" data-dismiss="modal">
                                <span class="glyphicon glyphicon-remove"></span> NO
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- fin MODAL confirmar-->
            <div class="modal" id="borrar" role="dialog">
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
            <!-- FIN MODAL BORRAR--> 
        </div>                     
        <script>
            function borrar(datos, fechaInicio, fechaFin) {
    var dat = datos.split('_');
    var fechaInicioFormatted = encodeURIComponent(fechaInicio);
    var fechaFinFormatted = encodeURIComponent(fechaFin);
    var queryString = 'tratamientodetalle_control.php?vcod_trata=' + dat[0] +
                      '&vcod_t_trata=' + dat[1] + '&accion=3' +
                      '&vfecha_inicio=' + fechaInicioFormatted +
                      '&vfecha_fin=' + fechaFinFormatted;
    $('#sic').attr('href', queryString);
    $("#confirmacionc").html('<span class="glyphicon glyphicon-info-sign"></span> \n\
    Desea confirmar el tratamiento </strong>');
}



            function agregardetalle() {
                if ($("#vcod_t_trata").val() === "0") {
                    alert("Debes seleccionar un Tipo de Tratamiento");
                    return;
                }

                let repetido = false;
                $("#detalle_consulta tr").each(function (index, tr) {
                    if ($(tr).find("td:eq(0)").text() === $("#venfe_cod").val()) {
                        repetido = true;
                    }
                });
                if (repetido) {
                    alert("El Tipo de Tratamiento ya ha sido agregado");
                    return;
                }
                let fila = "<tr>";
                fila += `<td>${$("#vcod_t_trata").val()}</td>`;
                fila += `<td>${$("#vcod_t_trata option:selected").html()}</td>`;
                fila += `<td>${$("#vdetalle_observ").val()}</td>`;
                fila += `<td>${$("#vprecio").val()}</td>`;
                fila += `<td><button class='btn btn-danger remover-item' onclick='remover($(this).closest("tr")); return false;'>Borrar</button></td>`;
                fila += "</tr>";
                $("#detalle_consulta").append(fila);
            }
            function remover(tr) {
                $(tr).remove();
            }
           function confirmar(datos) {
    var dat = datos.split('_');
    
    // Intenta obtener los valores de fecha por ID si están disponibles
    var fechaInicio = document.getElementById("vfecha_inicio") ? document.getElementById("vfecha_inicio").value : '';
    var fechaFin = document.getElementById("vfecha_fin") ? document.getElementById("vfecha_fin").value : '';

    // Si no se pudo obtener por ID, intenta por nombre
    if (!fechaInicio || !fechaFin) {
        fechaInicio = document.getElementsByName("vfecha_inicio")[0] ? document.getElementsByName("vfecha_inicio")[0].value : '';
        fechaFin = document.getElementsByName("vfecha_fin")[0] ? document.getElementsByName("vfecha_fin")[0].value : '';
    }

    $('#si').attr('href', 'tratamientodetalle_control.php?vcod_trata=' + dat[0] + '&vcod_t_trata=' + dat[1] + '&accion=2&vfecha_inicio=' + fechaInicio + '&vfecha_fin=' + fechaFin);
    $("#confirmacion").html('<span class="glyphicon glyphicon-info-sign"></span> \n\
    Desea confirmar el tratamiento </strong>');
}


        </script>
        <?php require '../../estilos/js_lte.ctp'; ?> 
        <script>
            $('#mensaje').delay(4000).slideUp(200, function () {
                $(this).alert('close');
            });
        </script><!-- Agrega tus scripts JavaScript si es necesario -->
    </body>
</html>

