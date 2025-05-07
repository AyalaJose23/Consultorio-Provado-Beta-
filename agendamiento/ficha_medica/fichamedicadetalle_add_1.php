<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Ficha</title>
    <link rel="shortcut icon" type="image/x-icon" href="/taller3/img/abm.png">
    <?php 
        session_start();  
        include "../../conexion.php";
        require '../../estilos/css_lte.ctp'; 
    ?>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="hold-transition skin-purple sidebar-mini">
    <div class="wrapper">
        <!-- Cabecera -->
        <?php require '../../estilos/cabecera.ctp'; ?>
        <!-- Barra lateral -->
        <?php require '../../estilos/izquierda.ctp'; ?>

        <!-- Contenido principal -->
        <div class="content-wrapper">
            <section class="content">

                <!-- Mensaje de error -->
                <?php if (!empty($_SESSION['mensaje'])): ?>
                    <div class="alert alert-danger" role="alert" id="mensaje">
                        <span class="glyphicon glyphicon-exclamation-sign"></span>
                        <?php
                            echo $_SESSION['mensaje'];
                            $_SESSION['mensaje'] = '';
                        ?>
                    </div>
                <?php endif; ?>

                <!-- Título principal -->
                <div class="row">
                    <div class="col-lg-12">
                        <h3 class="page-header text-center" style="background-color: rgba(147, 112, 219, 0.5); color: #800080;">
                            <strong>AGREGAR DETALLE DE FICHA MÉDICA</strong>
                            <a href="ficha_index.php" class="btn btn-purple pull-right" rel="tooltip" title="Atrás">
                                <i class="glyphicon glyphicon-arrow-left"></i>
                            </a>
                        </h3>
                    </div>
                </div>

                <!-- Panel: Datos de ficha médica -->
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <strong>Datos Detalle Ficha Médica</strong>
                    </div>
                    <div class="panel-body">
                        <?php
                            $detalletratamiento = consultas::get_datos("SELECT * FROM v_fichamedica WHERE cod_ficha = " . $_REQUEST['vcod_ficha']);
                            if (!empty($detalletratamiento)):
                        ?>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Paciente</th>
                                            <th>CI</th>
                                            <th>Fecha de Nacimiento</th>
                                            <th>Género</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($detalletratamiento as $diag): ?>
                                            <tr>
                                                <td><?php echo $diag['cod_ficha']; ?></td>
                                                <td><?php echo $diag['paciente']; ?></td>
                                                <td><?php echo $diag['per_ci']; ?></td>
                                                <td><?php echo $diag['per_fnac']; ?></td>
                                                <td><?php echo $diag['per_sexo']; ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Botón para agregar documentos -->
                <div class="row">
                    <div class="col-md-2">
                        <button class="btn btn-purple form-control" data-toggle="modal" data-target="#documentos-modal" title="Agregar Documentos">
                            <i class="fa fa-plus"></i> Agregar Documentos
                        </button>
                    </div>
                </div>

                <!-- Detalles de alergias -->
                <div class="row">
                    <div class="col-md-6">
                        <?php
                            $detallealergias = consultas::get_datos("SELECT * FROM v_detallealergias WHERE cod_ficha = " . $_GET['vcod_ficha']);
                            if (!empty($detallealergias)):
                        ?>
                            <div class="panel panel-info">
                                <div class="panel-heading">
                                    <strong>Detalles de Alergias</strong>
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Alergias</th>
                                                    <th>Síntomas</th>
                                                    <th>Causas</th>
                                                    <th class="text-center">Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($detallealergias as $detalle): ?>
                                                    <tr>
                                                        <td><?php echo $detalle['cod_alergis']; ?></td>
                                                        <td><?php echo $detalle['descrip_aler']; ?></td>
                                                        <td><?php echo $detalle['sintomas_aler']; ?></td>
                                                        <td><?php echo $detalle['causa_aler']; ?></td>
                                                        <td class="text-center">
                                                            <!--a onclick="editar(<?php echo $detalle['cod_alergis']; ?>)" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editar" title="Editar">
                                                                <i class="fa fa-edit"></i>
                                                            </a-->
                                                            <a onclick="borrarAlergia(<?php echo $detalle['cod_alergis']; ?>)" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#borrar" title="Eliminar">
                                                                <i class="fa fa-trash"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        <?php else: ?>
                            <div class="alert alert-info">
                                <span class="glyphicon glyphicon-info-sign"></span> La ficha aún no tiene detalles de alergias.
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Detalles de patologías -->
                    <div class="col-md-6">
                        <?php
                            $detallepatologias = consultas::get_datos("SELECT * FROM v_detallepatologias WHERE cod_ficha = " . $_GET['vcod_ficha']);
                            if (!empty($detallepatologias)):
                        ?>
                            <div class="panel panel-info">
                                <div class="panel-heading">
                                    <strong>Detalles de Patologías</strong>
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Patologías</th>
                                                    <th class="text-center">Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($detallepatologias as $patologia): ?>
                                                    <tr>
                                                        <td><?php echo $patologia['pat_cod']; ?></td>
                                                        <td><?php echo $patologia['pat_descri']; ?></td>
                                                        <td class="text-center">
                                                            <!--a onclick="editar(<?php echo $patologia['pat_cod']; ?>)" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editar" title="Editar">
                                                                <i class="fa fa-edit"></i>
                                                            </a-->
                                                            <a onclick="borrarPatologia(<?php echo $patologia['pat_cod']; ?>)" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#borrar" title="Eliminar">
                                                                <i class="fa fa-trash"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        <?php else: ?>
                            <div class="alert alert-info">
                                <span class="glyphicon glyphicon-info-sign"></span> La ficha aún no tiene detalles de patologías.
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                                        <!--Fin de detalle -->
                                        <div class="row"> 
                                            <div class="col-md-6">
                                                <div class="box-body">
                                                    <form action="fichaalergiasdetalle_control.php" method="post">
                                                        <input type="hidden" name="accion" value="1">
                                                        <input type="text" name="cod_ficha" value="<?= $_GET['vcod_ficha'] ?>" hidden>
                                                        <input type="hidden" name="vcod_alergis"value="<?php echo $detallealergias[0]['cod_alergis'] ?>"/>

                                                        <div class="col-md-12">
                                                            <div class="card-header text-center" style="background-color: #800080; color: #ffffff;">
                                                                COMPLETA LOS DATOS DEL DETALLE
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="col-md-12">
                                                            <label for="vcod_alergis">Alergias:</label>
                                                            <?php
                                                            $especialidad = consultas::get_datos("SELECT * FROM alergias ORDER BY cod_alergis");
                                                            ?>
                                                            <select class="form-control" name="vcod_alergis" required id="especialidad" return false;">
                                                                <option value="">Seleccionar Alergias</option>
                                                                <?php foreach ($especialidad as $espe) : ?>
                                                                    <option value="<?php echo $espe['cod_alergis']; ?>"><?php echo $espe['descrip_aler']; ?> - <?php echo $espe['sintomas_aler']; ?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                            <div id="doctores"></div>
                                                            <div class="box-footer">
                                                                <button type="submit" class="btn btn-purple pull-right" onclick="location.reload();">
                                                                    <span class="glyphicon glyphicon-floppy-saved"></span> Agregar
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="box-body">
                                                    <form action="fichapatologiasdetalle_control.php" method="post">
                                                        <input type="hidden" name="accion" value="1">
                                                        <input type="text" name="cod_ficha" value="<?= $_GET['vcod_ficha'] ?>" hidden>
                                                        <input type="hidden" name="vpat_cod"value="<?php echo $detallepatologias[0]['pat_cod'] ?>"/>
                                                        <div class="row">
                                                        <div class="col-md-12">
                                                                <div class="card-header text-center" style="background-color: #800080; color: #ffffff;">
                                                                    COMPLETA LOS DATOS DEL DETALLE
                                                                </div>
                                                            </div>
                                                            <br>
                                                            <div class="col-md-12">
                                                                <label for="vpat_cod">Patologias:</label>
                                                                <?php
                                                                $especialidad = consultas::get_datos("SELECT * FROM patologias ORDER BY pat_cod");
                                                                ?>
                                                                <select class="form-control" name="vpat_cod" required id="especialidad" return false;">
                                                                    <option value="">Seleccionar Patologias</option>
                                                                    <?php foreach ($especialidad as $espe) : ?>
                                                                        <option value="<?php echo $espe['pat_cod']; ?>"><?php echo $espe['pat_descri']; ?></option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                                <div id="doctores"></div>
                                                                <div class="box-footer">
                                                                    <button type="submit" class="btn btn-purple pull-right">
                                                                        <span class="glyphicon glyphicon-floppy-saved"></span> Agregar
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!--Agregar mas al formulario-->
                                         <!--Inicio de detalle agregar-->
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <?php
                                        $detallerecetas = consultas::get_datos("select * from vista_detalle_fichamedica where cod_ficha= " . $_GET['vcod_ficha']);
                                        if (!empty($detallerecetas)) {
                                            ?>
                                            <div class="panel panel-info">
                                <div class="panel-heading">
                                    <strong>Detalles</strong>
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                                        <table class="table table-bordered table-striped table-condensed table-hover">
                                                            <thead>
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th>ANTECEDENTES ENFERMEDADES</th>
                                                                    <th>CIRUGIAS ANTERIOS</th>
                                                                    <th>OBSERVACIONES</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php foreach ($detallerecetas as $detalles) { ?>
                                                                    <tr>
                                                                        <td data-title="#"><?php echo $detalles['cod_ficha']; ?></td>
                                                                        <td data-title="Medicamentos"><?php echo $detalles['fich_antecedentes_enfermedades']; ?></td>
                                                                        <td data-title="Indicaciones"><?php echo $detalles['fich_cirugias_anteriores']; ?></td>
                                                                        <td data-title="Hora"><?php echo $detalles['fich_observacion']; ?></td>
                                                                        <td class="text-center">
                                                                            
                                                                        </td>
                                                                    </tr> 
                                                                <?php } ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } else { ?>
                                            <div class="alert alert-info">
                                                <span class="glyphicon glyphicon-info-sign"></span> 
                                                Lo agregado aún no tiene detalle
                                            </div>      
                                        <?php } ?>
                                    </div>
                                </div>

                                <!--Fin de detalle -->
                                <div class="box-body">
                                    <form action="fichamedicadetalle_control.php" method="post">
                                        <input type="hidden" name="accion" value="1">
                                       <input type="text" name="cod_ficha" value="<?= $_GET['vcod_ficha'] ?>" hidden>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>ANTECEDENTES ENFERMEDADES</label>
                                                <input type="text" class="form-control" name="vfich_antecedentes_enfermedades" id="vdetalle_obser" >
                                            </div>
                                            <div class="col-md-4">
                                                <label>CIRUGIAS ANTERIOS</label>
                                                <input type="text" class="form-control" name="vfich_cirugias_anteriores" id="vdetalle_obser" >
                                            </div>
                                            <div class="col-md-8">
                                                <label>OBSERVACION</label>
                                                <input type="text" class="form-control" name="vfich_observacion" id="vdetalle_obser" >
                                            </div>
                                        </div>
                                        <div class="box-footer">
                                            
                                            <button type="submit" class="btn btn-purple pull-right">
                                                Registrar <!-- Utilizo el ícono 'save' de Font Awesome para registrar -->
                                            </button>
                                        </div>

                                    </form>
                                </div>
                                    </div>
                                </div>
                            </div>
                        </div> 
                </section>
            </div>
            <?php require '../../estilos/pie.ctp'; ?><!--ARCHIVOS JS--> 
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
            <div class="modal" id="borrarr" role="dialog">
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
            <!--Modal Detalle de Ficha -->
            <div class="modal" id="documentos-modal" role="dialog" >
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header" >
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">x</button>
                            <h4 class="modal-title"><i class="fa fa-plus"></i><strong>Registrar Documentos Varios</strong></h4>
                        </div>
                        <form action="documentosvarios_control.php" method="post" accept-charset="utf-8" class="form-horizontal">
                            <input name="accion" value="1" type="hidden" />
                            <input name="vdocva_cod" value="0" type="hidden" />
                            <input type="text" name="cod_ficha" value="<?= $_GET['vcod_ficha'] ?>" hidden>
                            <div class="box-body">
                                <?php
                                date_default_timezone_set('America/Asuncion');
                                $fechaHoraActual = date('Y-m-d\TH:i:s', time()); // Formato ISO 8601
                                ?>
                                <div class="col-md-6">
                                    <label for="vfecha_hora">Fecha y Hora:</label>
                                    <input type="datetime-local" class="form-control" name="vfecha_hora" id="vfecha_hora" value="<?php echo $fechaHoraActual; ?>">
                                </div>
                                <div class="col-md-6">
                                    <label for="vtipodo_cod">Tipo de Documento:</label>
                                    <?php
                                    $tipodocumentos = consultas::get_datos("SELECT * FROM tipo_documento ORDER BY tipodo_cod");
                                    ?>
                                    <select class="form-control" name="vtipodo_cod" required id="vtipodo_cod">
                                        <option value="0">Seleccionar Tipo de Documento</option>
                                        <?php foreach ($tipodocumentos as $tipodo) : ?>
                                            <option value="<?php echo $tipodo['tipodo_cod']; ?>"><?php echo $tipodo['tipodo_descri']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-12">
                                    <label for="vdocva_observacion">Observación:</label>
                                    <input type="text" value="SIN OBSERVACION" class="form-control" name="vdocva_observacion" id="vdocva_observacion">
                                </div>
                            </div>
                            <!-- Agrega este bloque después del formulario -->
                            <?php
                            $detallepatologias = consultas::get_datos("select * from v_documentos_varios where cod_ficha= " . $_GET['vcod_ficha']);
                            if (!empty($detallepatologias)) {
                                ?>
                                <div class="box-header">
                                    <i class="fa fa-list"></i>
                                    <h3 class="box-title">Detalles de Documentos</h3>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-condensed table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Fecha</th>
                                                <th>Tipo de Documento</th>
                                                <th>Observación</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($detallepatologias as $detalles) { ?>
                                                <tr>
                                                    <td data-title="Doctor"><?php echo $detalles['cod_ficha']; ?></td>
                                                    <td data-title="Doctor"><?php echo $detalles['docva_fecha']; ?></td>
                                                    <td data-title="Doctor"><?php echo $detalles['tipo_documento']; ?></td>
                                                    <td data-title="Especialidad"><?php echo $detalles['docva_observacion']; ?></td>
                                                    <td class="text-center">
                                                    </td>
                                                </tr> 
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php } else { ?>
                                <div class="alert alert-info">
                                    <span class="glyphicon glyphicon-info-sign"></span> 
                                    La ficha aún no tiene detalle de Documentos
                                </div>      
                            <?php } ?>
                            <div class="box-footer">
                                <button type="reset" data-dismiss="modal" class="btn btn-default">
                                    <i class="fa fa-remove"></i> Cerrar
                                </button>
                                <button type="submit" class="btn btn-purple pull-right">
                                    <i class="fa fa-floppy-o"></i> Registrar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>    
        </div>
            <script>
    // Espera a que el documento esté completamente cargado
    $(document).ready(function() {
        // Maneja el evento de envío del formulario
        $("#formulario").submit(function(event) {
            event.preventDefault();

            // Realiza la petición AJAX para actualizar la tabla de detalles
            $.ajax({
                type: "POST",
                url: "documentos-modal", // Ajusta la URL según tu estructura
                data: $(this).serialize(), // Envía los datos del formulario
                success: function(response) {
                    // Actualiza la tabla de detalles en el modal
                    $("#documentos-modal").html(response);

                    // Puedes cerrar el modal aquí si es necesario
                    // $("#documentos-modal").modal("hide");
                }
            });
        });
    });
</script>

       <!--script>
    // Función para mostrar el mensaje inicial
    function mostrarMensajeInicial() {
        $('#mensaje-inicial').show();
    }

    $(document).ready(function () {
        mostrarMensajeInicial(); // Muestra el mensaje inicial al abrir la página

        function editar(oe_cod, tipooe_cod) {
            $.ajax({
                type: "GET",
                url: "ordenestudiodetalle_modificar.php?voe_cod=" + oe_cod + "&vtipooe_cod=" + tipooe_cod,
                cache: false,
                beforeSend: function () {
                    $("#detalles").html('<img src="img/loader.gif" /><strong>Cargando...</strong>');
                },
                success: function (data) {
                    $("#detalles").html(data);
                }
            });
        }
    });
</script-->

        <script>
                    // Muestra el mensaje
                    document.getElementById('mensaje').style.display = 'block';
                    // Desaparece el mensaje después de 5 segundos
                    setTimeout(function() {
                    document.getElementById('mensaje').style.display = 'none';
                    }, 5000);
        </script>
        <script>

            function borrarAlergia(vcod_alergis) {
            $('#si').attr('href', 'fichaalergiasdetalle_control.php?vcod_alergis=' + vcod_alergis + '&accion=2');
                            $("#confirmacion").html('<span class="glyphicon glyphicon-warning-sign"></span> \n\
            ¿Deseas borrar el detalle de Alergias de la Ficha N° <strong>' + vcod_alergis + '</strong>?');
                    }

            function borrarPatologia(vpat_cod) {
            $('#sic').attr('href', 'fichapatologiasdetalle_control.php?vpat_cod=' + vpat_cod + '&accion=2');
                    $("#confirmacionc").html('<span class="glyphicon glyphicon-warning-sign"></span> \n\
            ¿Deseas borrar el detalle de Patología de la Ficha N° <strong>' + vpat_cod + '</strong>?');
            }
        </script>
        <script>
            // Obtener el valor del campo fecha y hora
            var fechaHoraInput = document.getElementById('vfecha_hora');
                    // Escuchar cambios en el campo
                    fechaHoraInput.addEventListener('change', function () {
                    // Obtener la fecha y hora seleccionadas
                    var fechaHoraSeleccionada = fechaHoraInput.value;
                            // Formatear la fecha y hora (puedes personalizar el formato según tus necesidades)
                            var fechaHoraFormateada = new Date(fechaHoraSeleccionada).toLocaleString('es-ES', {
                    year: 'numeric',
                            month: '2-digit',
                            day: '2-digit',
                            hour: '2-digit',
                            minute: '2-digit'
                    });
                            // Puedes imprimir la fecha y hora formateada en la consola o usarla según tus necesidades
                            console.log('Fecha y Hora Formateada:', fechaHoraFormateada);
                    });
        </script>
     

        
    <?php require '../../estilos/js_lte.ctp'; ?><!--ARCHIVOS JS-->
</body>
</html>
