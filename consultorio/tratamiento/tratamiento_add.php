<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="shortcut icon" type="image/x-icon" href="/taller3/img/abm.png">
        <title>Agregar Tratamiento</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

        <!-- Agrega tus estilos CSS personalizados aquí si es necesario -->
        <?php
        session_start();
        include "../../conexion.php";
        require '../../estilos/css_lte.ctp';
        ?><!-- ARCHIVOS CSS -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
            <?php require '../../estilos/cabecera.ctp'; ?>
            <?php require '../../estilos/izquierda.ctp'; ?>
                <div class="content-wrapper">
                    <section class="content">
                        <div class="row">
                            <div class="col-lg-12">
                                <h3 class="page-header text-center" style="background-color: rgba(147, 112, 219, 0.5); color: #800080;"> 
                                    <strong>AÑADIR TRATAMIENTO</strong>
                                    <a href="tratamiento_index.php" 
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
                                        <strong>Agregar Tratamiento</strong>
                                    </div>

                                <div class="box-body">
                                    <form action="tratamiento_control.php" method="post" accept-charset="utf-8" class="form-horizontal">
                                        <input type="hidden" name="vcod_pacientes" id="cod_pacientes" value="">
                                        <input type="hidden" name="accion" value="1">
                                        <input type="hidden" name="vcod_trata" value="0">
                                        <!--Inicio de cabecera -->
                                        <div class="row">
                                            <?php
                                            date_default_timezone_set('America/Asuncion');
                                            $fechaHoraActual = date('Y-m-d\TH:i:s', time()); // Formato ISO 8601
                                            ?>
                                            <div class="col-md-3">
                                                <input type="datetime-local" disabled="" class="form-control" name="vfecha_hora" id="vfecha_hora" value="<?php echo $fechaHoraActual; ?>">

                                            </div>
                                            <div class="col-md-12">
                                                <label>Paciente</label>
                                                <select  name="vcod_diag" id="paciente_diagnostico" class="form-control" onchange="cargardiagnostico(); return false;">
                                                    <?php
                                                    $diagnostico = consultas::get_datos("SELECT DISTINCT
                                                            d.cod_diag,
                                                            d.cod_pacientes,
                                                            per.per_nombre,
                                                            per.per_apellido
                                                        FROM
                                                            diagnostico d
                                                        JOIN 
                                                            detalle_diagnostico dd ON d.cod_diag = dd.cod_diag
                                                        JOIN
                                                            pacientes p ON d.cod_pacientes = p.cod_pacientes
                                                        JOIN
                                                            persona per ON per.id_persona = p.id_persona
                                                        WHERE
                                                            d.estado_diag = 'DIAGNOSTICADO'
                                                        GROUP BY
                                                            d.cod_diag, d.cod_pacientes, per.per_nombre, per.per_apellido;
                                                        ");
                                                    ?>
                                                    <option value="0">Seleccione Paciente para ver su diagnostico</option>
                                                    <?php foreach ($diagnostico as $diag) : ?>
                                                        <option value="<?php echo $diag['cod_diag']; ?>" data-pac-cod="<?php echo $diag['cod_pacientes']; ?>">
                                                            <?= $diag['per_nombre']; ?> <?= $diag['per_apellido']; ?>
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
                                                        <th>Tipo de Enfermedad</th>
                                                        <th>Enfermedad</th>
                                                        <th>Observacion</th>
                                                        </thead>
                                                        <tbody id="datos_diagnostico">
                                                            <tr>
                                                                <td colspan="6">
                                                                    <div class="alert alert-info">
                                                                        <span class="glyphicon glyphicon-info-sign"></span> 
                                                                        No se ha seleccionado un diagnostico...
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>   
                                        </div>
                                        <div class="box-footer">
                                            <a href="tratamiento_index.php" class="btn btn-default">
                                                <i class="fa fa-remove"></i> CANCELAR
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
        </section>
    </div>
    <?php require '../../estilos/pie.ctp'; ?>
    <!--INICIA MODAL REGISTRAR-->

    <!--FIN MODAL REGISTRAR-->
</div>
<script>
    // Función para mostrar el mensaje inicial
    function mostrarMensajeInicial() {
        $('#mensaje-inicial').show();
    }

    function cargardiagnostico() {
        if ($("#paciente_diagnostico").val() === "0") {
            $('#datos_diagnostico').html(`<tr>
                                        <td colspan="10"><div class="alert alert-info">
                                                <span class="glyphicon glyphicon-info-sign"></span> 
                                                No se han seleccionado Paciente de Diagnostico...
                                            </div></td>
                                    </tr>`);
        } else {
            $.ajax({
                type: "GET",
                url: "tratamiento_datodiagnostico.php?cod=" + $('#paciente_diagnostico').val(),
                cache: false,
                beforeSend: function () {
                    $('#datos_diagnostico').html('<img src="img/loader.gif" /><strong>Cargando...</strong>')
                },
                success: function (data) {
                    console.log(data);
                    $('#datos_diagnostico').html(data);

                    // Obtener el código del paciente seleccionado
                    var pacCod = $('#paciente_diagnostico').find(':selected').data('pac-cod');

                    // Asignar el código del paciente a un campo oculto en el formulario
                    $('#cod_pacientes').val(pacCod);
                }
            });
        }
    }

    function agregardetalle() {
        if ($("#tipoconsulta").val() === "0") {

            alert("Debes seleccionar un tipo de consulta");
            return;
        }
        if ($("#vcons_descri").val().length === 0) {
            alert("Debes ingresar una descripcion");
            return;
        }
        if ($("#vprecio").val().length === 0) {
            alert("Debes ingresar un precio");
            return;
        }
        if (parseInt($("#vprecio").val()) <= 0) {
            alert("El precio no puede ser menor o igual a cero");
            return;
        }
        let repetido = false;

        $("#detalle_consulta tr").each(function (evt) {
            if ($(this).find("td:eq(0)").text() === $("#tipoconsulta").val()) {
                repetido = true;
            }
        });

        if (repetido) {
            alert("El tipo de consulta ya ha sido agregado");
            return;
        }
        let fila = "";
        fila += `<tr>`;
        fila += `<td>${$("#tipoconsulta").val()}</td>`;
        fila += `<td>${$("#tipoconsulta option:selected").html()}</td>`;
        fila += `<td>${$("#vdescripcion").val()}</td>`;
        fila += `<td>${$("#vprecio").val()}</td>`;
        fila += `<td><button class='btn btn-danger'>Remover</button></td>`;
        fila += `</tr>`;

        $("#detalle_consulta").append(fila);

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
<?php require '../../estilos/js_lte.ctp'; ?> 
<script>
    $('#mensaje').delay(4000).slideUp(200, function () {
        $(this).alert('close');
    });
</script><!-- Agrega tus scripts JavaScript si es necesario -->
</body>
</html>
