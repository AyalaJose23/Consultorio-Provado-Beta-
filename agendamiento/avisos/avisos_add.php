<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link rel="shortcut icon" type="image/x-icon" href="/taller3/img/abm.png">
        <title>Agregar Avisos</title>

        <!-- Incluye estilos personalizados -->
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

            <div class="content-wrapper">
                <section class="content">
                   
                            <!-- Mensaje de error -->
                            <?php if (!empty($_SESSION['mensaje'])) { ?>
                                <div class="alert alert-danger" role="alert" id="mensaje">
                                    <span class="glyphicon glyphicon-exclamation-sign"></span>
                                    <?php
                                        echo $_SESSION['mensaje'];
                                        $_SESSION['mensaje'] = '';
                                    ?>
                                </div>
                            <?php } ?>

                            <!-- Título de la página -->
                            <div class="text-center" style="margin-bottom: 20px;">
                                <h3 class="page-header" style="background-color: rgba(147, 112, 219, 0.5); color: #800080;">
                                    <strong>AÑADIR AVISOS</strong>
                                    <a href="avisos_index.php" class="btn btn-purple pull-right" title="Atrás">
                                        <i class="glyphicon glyphicon-arrow-left"></i>
                                    </a>
                                </h3>
                            </div>
 <!-- Panel principal -->
 <div class="panel panel-info">
                        <div class="panel-heading">
                            <strong>Agregar Avisos</strong>
                        </div>
                        <div class="box-body">
                                    <form action="avisos_control.php" method="post">
                                        <input type="hidden" name="cod_pacientes" id="cod_pacientes" value="">
                                        <input type="hidden" name="accion" value="1">
                                        <input type="hidden" name="vcod_avisos" value="0">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <!-- Columna izquierda -->
                                                <div class="card-body">
                                                    <div class="card-header text-center"
                                                    style="background-color: rgba(147, 112, 219, 0.5); color: #800080;">
                                                        COMPLETA LOS DATOS
                                                    </div>
                                                    <?php
                                                    date_default_timezone_set('America/Asuncion');
                                                    $fechaHoraActual = date('Y-m-d\TH:i:s', time()); // Formato ISO 8601
                                                    ?>
                                                    <BR>
                                                    <div class="col-md-6">
                                                        <input type="datetime-local" class="form-control" name="vfecha_hora" id="vfecha_hora" value="<?php echo $fechaHoraActual; ?>">
                                                    </div>
                                                    <br>
                                                    <br>
                                                    <div class="col-md-8">
                                                        <label>Paciente</label>
                                                        <select name="vcod_cita" id="paciente_pre_consulta"
                                                                class="form-control"
                                                                onchange="cargarPreConsulta(); return false;">
                                                                    <?php
                                                                    $pre = consultas::get_datos("SELECT
                                                        pc.cod_cita,
                                                        p.cod_pacientes,
                                                        per.per_nombre,
                                                        per.per_apellido
                                                        FROM citas  pc 
                                                        JOIN pacientes p 
                                                        ON p.cod_pacientes =  pc.cod_pacientes
                                                        JOIN persona per 
                                                        ON per.id_persona =  p.id_persona
                                                        WHERE pc.cita_estado = 'PENDIENTE'");
                                                                    ?>
                                                            <option value="0">Citas Pendientes del Paciente</option>
                                                    <?php foreach ($pre as $con) : ?>
                                                        <option value="<?php echo $con['cod_cita']; ?>" data-pac-cod="<?php echo $con['cod_pacientes']; ?>">
                                                                        <?= $con['per_nombre']; ?> <?= $con['per_apellido']; ?></option>
                                                    <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                        <div class="table-responsive">
                                                            <table
                                                                class="table table-bordered table-striped table-condensed table-hover">
                                                                <thead>
                                                                <th>#</th>
                                                                <th>Paciente</th>
                                                                <th>Fecha</th>
                                                                <th>Razon de Citas</th>
                                                                <th>Doctor</th>
                                                                <th>Especialidad</th>
                                                                </thead>
                                                                <tbody id="datos_pre_consulta">
                                                                    <tr>
                                                                        <td colspan="10">
                                                                            <div class="alert alert-info" >
                                                                                <span
                                                                                    class="glyphicon glyphicon-info-sign" ></span>
                                                                                No se han seleccionado Citas Pendientes...
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <br><br>
                                                    <div class="form-group">
                                                        <label for="aviso_observ">RAZÓN DE CITA:</label>
                                                        <textarea name="vaviso_observ" id="aviso_observ"
                                                                  class="form-control" rows="4" required></textarea>
                                                    </div>

                                                    <div class="box-footer">
                                                        <a href="avisos_index.php" class="btn btn-default">
                                                            <i class="fa fa-remove"></i> CANCELAR
                                                        </a>   
                                                        <button type="submit" class="btn btn-purple pull-right">
                                                            <i class="fa fa-floppy-o"></i> AVISAR
                                                        </button>
                                                    </div>

                                                </div>
                                            </div>
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
    <!--INICIA MODAL REGISTRAR-->
    <div class="modal fade" id="registrar" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">X</button>
                    <h4 class="modal-title">AGREGAR PACIENTE</h4>
                </div>
                <form action="citas_control.php" method="post" accept-charset="utf-8" class="form-horizontal">
                    <input name="accion" value="5" type="hidden" />
                    <input name="vcod_pacientes" value="0" type="hidden" />
                    <div class="box-body">
                        <div class="form-group">
                            <?php $personas = consultas::get_datos("select * from v_personas order by id_persona"); ?>
                            <label class="col-sm-2 control-label">PERSONAS:</label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <select class="form-control select2-container--classic" name="vid_persona" required="">
                                        <?php foreach ($personas as $per) { ?>
                                            <option value="<?php echo $per['id_persona']; ?>">
                                                <?php echo $per['per_nombre'] . " " . $per['per_apellido']; ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                    <span class="input-group-btn">
                                        <a href="personas_add.php" class="btn btn-purple btn-flat">
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
                        <button type="submit" class="btn btn-purple pull-right">
                            <i class="fa fa-floppy-o"></i> Registrar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--FIN MODAL REGISTRAR-->
</div>
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
<script>
    // Función para mostrar el mensaje inicial
    function mostrarMensajeInicial() {
        $('#mensaje-inicial').show();
    }


    function cargarPreConsulta() {

        if ($("#paciente_pre_consulta").val() === "0") {
            $('#datos_pre_consulta').html(`<tr>
                                <td colspan="10"><div class="alert alert-info">
                                        <span class="glyphicon glyphicon-info-sign"></span> 
                                        No se han seleccionado Pacientes con Citas Pendientes...
                                    </div></td>
                            </tr>`);
        } else {
            $.ajax({
                type: "GET",
                url: "avisos_pacientes.php?cod=" + $('#paciente_pre_consulta').val(),
                cache: false,
                beforeSend: function () {
                    $('#datos_pre_consulta').html('<img src="img/loader.gif" /><strong>Cargando...</strong>')
                },

                success: function (data) {
                    console.log(data);
                    $('#datos_pre_consulta').html(data);

                    // Obtener el código del paciente seleccionado
                    var pacCod = $('#paciente_pre_consulta').find(':selected').data('pac-cod');

                    // Asignar el código del paciente a un campo oculto en el formulario
                    $('#cod_pacientes').val(pacCod);
                }
            });
        }
    }

    $(document).ready(function () {
        mostrarMensajeInicial(); // Muestra el mensaje inicial al abrir la página

        $('#agen_fecha, #hora_inicio, #hora_fin').on('change', function () {
            // Obtiene los valores de fecha, hora de inicio y hora de fin
            var fecha = $('#agen_fecha').val();
            var hora_inicio = $('#hora_inicio').val();
            var hora_fin = $('#hora_fin').val();
        });
    });



</script>
<?php require '../../estilos/js_lte.ctp'; ?>
<script>
    $('#mensaje').delay(4000).slideUp(200, function () {
        $(this).alert('close');
    });
</script><!-- Agrega tus scripts JavaScript si es necesario -->
</body>

</html>