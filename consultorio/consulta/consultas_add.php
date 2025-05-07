<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="shortcut icon" type="image/x-icon" href="/taller3/img/abm.png">
        <title>Agregar Cionsultas</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

        <!-- Agrega tus estilos CSS personalizados aquí si es necesario -->
        <?php session_start();  include "../../conexion.php";
                            require '../../estilos/css_lte.ctp'; ?>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
                
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <strong>Agregar Consultas</strong>
                            </div>
                            <div class="panel-body">
                                    <form action="consulta_control.php" method="post" accept-charset="utf-8" class="form-horizontal">
                                        <input type="hidden" name="cod_pacientes" id="cod_pacientes" value="">
                                        <input type="hidden" name="accion" value="1">
                                        <input type="hidden" name="vcod_consulta" value="0">
                                        <div class="row">
                                            <?php
                                            date_default_timezone_set('America/Asuncion');
                                            $fechaHoraActual = date('Y-m-d\TH:i:s', time()); // Formato ISO 8601
                                            ?>
                                            <div class="col-md-2">
                                                <input type="datetime-local" class="form-control" name="vfecha_hora" id="vfecha_hora" value="<?php echo $fechaHoraActual; ?>">

                                            </div>
                                            <br>
                                            <br>
                                            <div class="col-md-2">
                                                <label>Precio</label>
                                                <input type="numeric" value="100.000" class="form-control" name="vcons_precio" id="vcons_precio">
                                            </div>
                                            <br>
                                            <br>
                                            <br>
                                            <div class="col-md-3">
                                                <label for="vtipcon_cod">Tipo de Consulta:</label>
                                                <?php
                                                $tipo_consulta = consultas::get_datos("SELECT * FROM tipo_consulta ORDER BY tipcon_cod");
                                                ?>
                                                <select class="form-control" name="vtipcon_cod" required id="vtipcon_cod">
                                                    <option value="0">Seleccionar Tipo de Consulta</option>
                                                    <?php foreach ($tipo_consulta as $tipo_con) : ?>
                                                        <option value="<?php echo $tipo_con['tipcon_cod']; ?>"><?php echo $tipo_con['tipcon_descri']; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <label>Paciente</label>
                                                <select  name="vcod_precon" id="paciente_pre_consulta" class="form-control" onchange="cargarPreConsulta(); return false;">
                                                    <?php
                                                    $pre = consultas::get_datos("SELECT
                                                        pc.cod_precon,
                                                        p.cod_pacientes,
                                                        per.per_nombre,
                                                        per.per_apellido
                                                        FROM pre_consulta  pc 
                                                        JOIN citas c 
                                                        ON c.cod_cita =  pc.cod_cita
                                                        JOIN pacientes p 
                                                        ON p.cod_pacientes =  c.cod_pacientes
                                                        JOIN persona per 
                                                        ON per.id_persona =  p.id_persona
                                                        WHERE pc.pcon_estado = 'CONFIRMADO'");
                                                    ?>
                                                    <option value="0">Pre consultas del dia</option>
                                                    <?php foreach ($pre as $con) : ?>
                                                        <option value="<?php echo $con['cod_precon']; ?>" data-pac-cod="<?php echo $con['cod_pacientes']; ?>">
                                                            <?= $con['per_nombre']; ?> <?= $con['per_apellido']; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row" >
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">  

                                                <div class="table-responsive">
                                                    <table class="table table-bordered table-striped table-condensed table-hover">
                                                        <thead>
                                                        <th>#</th>
                                                        <th>Paciente</th>
                                                        <th>Presion Arterial</th>
                                                        <th>Temperatura</th>
                                                        <th>Frecuencia Respiratoria</th>
                                                        <th>Frecuencia Cardiaca</th>
                                                        <th>Saturación</th>
                                                        <th>Peso</th>
                                                        <th>Talla</th>
                                                        </thead>
                                                        <tbody id="datos_pre_consulta">
                                                            <tr>
                                                                <td colspan="10"><div class="alert alert-info">
                                                                        <span class="glyphicon glyphicon-info-sign"></span> 
                                                                        No se han seleccionado Pre Consulta...
                                                                    </div></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label>Motivo</label>
                                                <input type="text" class="form-control" name="vcon_motivo" id="vcon_motivo" >
                                            </div>
                                        </div>
                                        <br>
                                        <br>
                                        <br>
                                        <br>
                                        <div class="box-footer">
                                            <a href="consulta_index.php" class="btn btn-danger">
                                                <i class="fa fa-remove"></i> CANCELAR
                                            </a>   
                                            <button type="submit" class="btn btn-primary pull-right">
                                                <i class="fa fa-floppy-o"></i> Detalles
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
            </div>
        </section>
    </div>
    <?php require '../../estilos/pie.ctp'; ?>

</div>
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
                                                    No se han seleccionado Pre Consulta...
                                                </div></td>
                                        </tr>`);
        } else {
            $.ajax({
                type: "GET",
                url: "consulta_datopreconsulta.php?cod=" + $('#paciente_pre_consulta').val(),
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

    function remover(tr) {
        $(tr).remove();
    }
    ;

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
<script>
    $('#mensaje').delay(4000).slideUp(200, function () {
        $(this).alert('close');
    });
</script><!-- Agrega tus scripts JavaScript si es necesario -->
</body>
</html>
