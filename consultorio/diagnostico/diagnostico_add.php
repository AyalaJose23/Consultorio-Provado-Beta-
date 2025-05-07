<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="shortcut icon" type="image/x-icon" href="/sistema_consultorio/favicon.ico">
        <title>AGREGAR DIAGNOSTICO</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

        <!-- Agrega tus estilos CSS personalizados aquí si es necesario -->
        <?php
        session_start();
        include "../../conexion.php";
        require '../../estilos/css_lte.ctp';
        ?><!-- ARCHIVOS CSS -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
                                <strong>AÑADIR DIAGNOSTICO</strong>
                                <a href="diagnostico_index.php" 
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
                                    <strong>Agregar Diagnostico</strong>
                                </div>
                                <div class="box-body">
                                    <form action="diagnostico_control.php" method="post" accept-charset="utf-8" class="form-horizontal">
                                        <input type="hidden" name="vcod_pacientes" id="cod_pacientes" value="">
                                        <input type="hidden" name="accion" value="1">
                                        <input type="hidden" name="vcod_diag" value="0">
                                        <!--Inicio de cabecera -->
                                        <div class="row">
                                            <?php
                                            date_default_timezone_set('America/Asuncion');
                                            $fechaHoraActual = date('Y-m-d\TH:i:s', time()); // Formato ISO 8601
                                            ?>
                                            <div class="col-md-3">
                                                <input type="datetime-local" class="form-control" disabled="" name="vfecha_hora" id="vfecha_hora" value="<?php echo $fechaHoraActual; ?>">
                                            </div>
                                            <br>
                                            <br>
                                            <div class="col-md-4">
                                                <label>ORDEN DE ESTUDIO</label>
                                                <select  name="vcod_estudios" id="paciente_ordenestudio" class="form-control" onchange="cargarestudios(); return false;">
                                                    <?php
                                                    $ordenestudio = consultas::get_datos("SELECT oe.cod_estudios, 
                                                        oe.cod_pacientes,
                                                         per.per_nombre,
                                                         per.per_apellido
                                                        FROM 
                                                            orden_estudio oe
                                                        JOIN 
                                                            detalle_ordenestudio det ON oe.cod_estudios = det.cod_estudios
                                                        JOIN 
                                                            pacientes p ON oe.cod_pacientes = p.cod_pacientes
                                                        JOIN 
                                                            persona per ON per.id_persona = p.id_persona
                                                       where 
                                                            oe.estado_estudio = 'CONFIRMADO'");
                                                    ?>
                                                    <option value="0">Orden de estudios</option>
                                                    <?php foreach ($ordenestudio as $oe) : ?>
                                                        <option value="<?php echo $oe['cod_estudios']; ?>" data-pac-cod="<?php echo $oe['cod_pacientes']; ?>">
                                                            <?= $oe['per_nombre']; ?> <?= $oe['per_apellido']; ?>
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
                                                        <th>Tipo de Orden Estudio</th>
                                                        <th>Observacion</th>
                                                        </thead>
                                                        <tbody id="datos_consulta">
                                                            <tr>
                                                                <td colspan="5">
                                                                    <div class="alert alert-info">
                                                                        <span class="glyphicon glyphicon-info-sign"></span> 
                                                                        No se han seleccionado Orden de estudio...
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <label>ORDEN DE ANALISIS</label>
                                                <select name="vcod_analisis" id="paciente_ordenanalisis" class="form-control" onchange="cargaranalisis(); return false;">
                                                    <?php
                                                    $ordenanalisis = consultas::get_datos("SELECT oa.cod_analisis, 
                                                           oa.cod_pacientes, 
                                                           per.per_nombre, 
                                                           per.per_apellido
                                                    FROM orden_analisis oa
                                                    LEFT JOIN detalle_analisis det ON oa.cod_analisis = det.cod_analisis
                                                    LEFT JOIN pacientes p ON oa.cod_pacientes = p.cod_pacientes
                                                    LEFT JOIN persona per ON per.id_persona = p.id_persona
                                                    WHERE oa.estado_analisis = 'CONFIRMADO'");
                                                    ?>
                                                    <option value="">Orden de Analisis</option>
                                                    <?php foreach ($ordenanalisis as $oa) : ?>
                                                        <option value="<?php echo $oa['cod_analisis']; ?>" data-pac-cod="<?php echo $oa['cod_pacientes']; ?>">
                                                            <?= $oa['per_nombre']; ?> <?= $oa['per_apellido']; ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                    <div class="table-responsive">
                                                        <table class="table table-bordered table-striped table-condensed table-hover">
                                                            <thead>
                                                            <th>#</th>
                                                            <th>Paciente</th>
                                                            <th>Fecha</th>
                                                            <th>Tipo de Orden Analisis</th>
                                                            <th>Observacion</th>
                                                            </thead>
                                                            <tbody id="datos_consultas">
                                                                <tr>
                                                                    <td colspan="5">
                                                                        <div class="alert alert-info">
                                                                            <span class="glyphicon glyphicon-info-sign"></span> 
                                                                            No se han seleccionado Orden de Analisis...
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="box-footer">
                                                <a href="diagnostico_index.php" class="btn btn-danger">
                                                    <i class="fa fa-remove"></i> CANCELAR
                                                </a>   
                                                <button type="submit" class="btn btn-primary pull-right">
                                                    <i class="fa fa-floppy-o"></i> Detalles
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!--Fin de cabecera -->
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <?php require '../../estilos/pie.ctp'; ?>
<script>
    function cargarestudios() {
        if ($("#paciente_ordenestudio").val() === "0") {
            $('#datos_consulta').html(`<tr>
                                        <td colspan="10"><div class="alert alert-info">
                                                <span class="glyphicon glyphicon-info-sign"></span> 
                                                No se han seleccionado Paciente de Orden de Estudio...
                                            </div></td>
                                    </tr>`);
        } else {
            $.ajax({
                type: "GET",
                url: "diagnostico_datoordenestudio.php?cod=" + $('#paciente_ordenestudio').val(),
                cache: false,
                beforeSend: function () {
                    $('#datos_consulta').html('<img src="img/loader.gif" /><strong>Cargando...</strong>')
                },
                success: function (data) {
                    console.log(data);
                    $('#datos_consulta').html(data);

                    // Obtener el código del paciente seleccionado
                    var pacCod = $('#paciente_ordenestudio').find(':selected').data('pac-cod');

                    // Asignar el código del paciente a un campo oculto en el formulario
                    $('#cod_pacientes').val(pacCod);
                }
            });
        }
    }
    function cargaranalisis() {
        var selectedVal = $("#paciente_ordenanalisis").val();
        console.log("Selected Order Analysis ID: " + selectedVal);

        if (selectedVal === "") {
            $('#datos_consultas').html(`<tr>
            <td colspan="10"><div class="alert alert-info">
                <span class="glyphicon glyphicon-info-sign"></span> 
                No se han seleccionado Paciente de Orden de Analisis...
            </div></td>
        </tr>`);
        } else {
            $.ajax({
                type: "GET",
                url: "diagnostico_datoordenanalisis.php?oacod=" + selectedVal,
                cache: false,
                beforeSend: function () {
                    $('#datos_consultas').html('<img src="img/loader.gif" /><strong>Cargando...</strong>')
                },
                success: function (data) {
                    console.log("Response Data: ", data);
                    $('#datos_consultas').html(data);

                    // Obtener el código del paciente seleccionado
                    var pacCod = $('#paciente_ordenanalisis').find(':selected').data('pac-cod');
                    console.log("Patient Code: " + pacCod);

                    // Asignar el código del paciente a un campo oculto en el formulario
                    $('#cod_pacientes').val(pacCod);
                },
                error: function (xhr, status, error) {
                    console.log("Error: " + error);
                    console.log("Status: " + status);
                }
            });
        }
    }

</script>
<script>
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
<?php require '../../estilos/js_lte.ctp'; ?><!--ARCHIVOS JS-->
<script>
    $('#mensaje').delay(4000).slideUp(200, function () {
        $(this).alert('close');
    });
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
</body>
</html>
