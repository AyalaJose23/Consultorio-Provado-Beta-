<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="shortcut icon" type="image/x-icon" href="/taller3/img/abm.png">
        <title>Agregar Orden de Estudios</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

        <!-- Agrega tus estilos CSS personalizados aquí si es necesario -->
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
                                <strong>AÑADIR ORDEN DE ESTUDIO</strong>
                                <a href="ordenestudios_index.php" 
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
                                <strong>Agregar Orden de Estudio</strong>
                            </div>

                                <!--Inicio de cabecera -->
                                <div class="panel-body">
                                    <form action="ordenestudios_control.php" method="post" accept-charset="utf-8" class="form-horizontal">
                                        <input type="hidden" name="cod_pacientes" id="cod_pacientes" value="">
                                        <input type="hidden" name="accion" value="1">
                                        <input type="hidden" name="vcod_estudios" value="0">
                                        <!--Inicio de cabecera -->
                                        <div class="row">
                                            <?php
                                            date_default_timezone_set('America/Asuncion');
                                            $fechaHoraActual = date('Y-m-d\TH:i:s', time()); // Formato ISO 8601
                                            ?>
                                            <div class="col-md-2">
                                                <input type="datetime-local" class="form-control" disabled="" name="vfecha_hora" id="vfecha_hora" value="<?php echo $fechaHoraActual; ?>">

                                            </div>
                                            <br>
                                            <br>
                                            <div class="col-md-12">
                                                <label>Paciente</label>
                                                <select name="vcod_consulta" id="paciente_consulta" class="form-control" onchange="cargarConsulta(); return false;">
                                                <?php
                                                    $consulta = consultas::get_datos("SELECT DISTINCT ON (c.cod_consulta) 
                                                            c.cod_consulta,
                                                            c.cod_pacientes,
                                                            per.per_nombre,
                                                            per.per_apellido
                                                        FROM consulta c
                                                            JOIN detalle_consulta dc ON c.cod_consulta = dc.cod_consulta
                                                            JOIN pacientes p ON c.cod_pacientes = p.cod_pacientes
                                                            JOIN persona per ON per.id_persona = p.id_persona
                                                        WHERE c.con_fecha = CURRENT_DATE 
                                                            AND c.con_estado::text = 'CONFIRMADO'::text;");
                                                    ?>
                                                    <option value="0">Consultas</option>
                                                    <?php foreach ($consulta as $con) : ?>
                                                        <option value="<?php echo $con['cod_consulta']; ?>" data-pac-cod="<?php echo $con['cod_pacientes']; ?>">
                                                            <?= $con['per_nombre']; ?> <?= $con['per_apellido']; ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered table-striped table-condensed table-hover">
                                                        <thead>
                                                        <th>#</th>
                                                        <th>Paciente</th>
                                                        <th>Fecha</th>
                                                        <th>Tipo de Consulta</th>
                                                        <th>Motivo</th>
                                                        <th>Sintomas</th>
                                                        </thead>
                                                        <tbody id="datos_consulta">
                                                            <tr>
                                                                <td colspan="6">
                                                                    <div class="alert alert-info">
                                                                        <span class="glyphicon glyphicon-info-sign"></span> 
                                                                        No se ha seleccionado alguna consulta...
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="box-footer">
                                            <a href="ordenestudios_index.php" class="btn btn-default">
                                                <i class="fa fa-remove"></i>CANCELAR
                                            </a>   
                                            <button type="submit" class="btn btn-primary pull-right">
                                                <i class="fa fa-floppy-o"></i> Detalles
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                <!--Fin de cabecera -->
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


    function cargarConsulta() {
        if ($("#paciente_consulta").val() === "0") {
            $('#datos_consulta').html(`<tr>
                                        <td colspan="10"><div class="alert alert-info">
                                                <span class="glyphicon glyphicon-info-sign"></span> 
                                                Seleccione un Paciente para realizar la Orden de Estudio...
                                            </div></td>
                                    </tr>`);
        } else {
            $.ajax({
                type: "GET",
                url: "ordenestudio_datoconsulta.php?cod=" + $('#paciente_consulta').val(),
                cache: false,
                beforeSend: function () {
                    $('#datos_consulta').html('<img src="img/loader.gif" /><strong>Cargando...</strong>')
                },
                success: function (data) {
                    console.log(data);
                    $('#datos_consulta').html(data);

                    // Obtener el código del paciente seleccionado
                    var pacCod = $('#paciente_consulta').find(':selected').data('pac-cod');

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
