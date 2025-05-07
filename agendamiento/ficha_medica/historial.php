<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="shortcut icon" type="image/x-icon" href="/taller3/img/abm.png">
        <title>CENTRO MEDICO VIDA Y AMOR</title>
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
                                    <h3 class="page-header text-center"><strong>Historial Médico</strong>
                                    <a href="/tdp/MANUAL DE USUARIO tdp.pdf" target="print">
                                    <span class="glyphicon glyphicon-question-sign"></span>
                                </a>
                                        <a href="ficha_index.php" class="btn btn-purple btn-sm pull-right" data-title="Volver" rel="tooltip" data-placement="left">
                                            <i class="fa fa-arrow-left"></i></a>                                            
                                    </div>
                                </div>
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
                                        <select name="cod_pacientes" id="paciente_diagnostico" class="form-control" onchange="historial_datopaciente(); return false;">
                                            <?php
                                            $diagnostico = consultas::get_datos("SELECT 'FICHA MÉDICA'::text AS tipo,
                                                f.cod_ficha,                                                
                                                f.fich_fecha AS fecha,
                                                f.cod_pacientes, concat(per.per_nombre, ' ', per.per_apellido) AS paciente
                                                FROM ficha_medica f
                                                JOIN pacientes p ON f.cod_pacientes = p.cod_pacientes
                                                JOIN persona per ON per.id_persona = p.id_persona
                                               ");
                                            ?>
                                            <option value="0">Seleccione Paciente</option>
                                            <?php foreach ($diagnostico as $diag) : ?>
                                                <option value="<?php echo $diag['cod_pacientes']; ?>" data-nombre="<?php echo $diag['paciente']; ?>">
                                                    <?= $diag['paciente']; ?>
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
                                                    <tr>
                                                        <th style="color: white;">TIPO</th>
                                                        <th style="color: white;">FECHA</th>
                                                        <th style="color: white;">DESCRIPCION</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="datos_diagnostico">
                                                    <tr>
                                                        <td colspan="3">
                                                            <div class="alert alert-info">
                                                                <span class="glyphicon glyphicon-info-sign"></span> 
                                                                No se han seleccionado Paciente...
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>   
                                </div>
                                <div class="row">
                                    <div class="col-md-12 text-right">
                                        <button class="btn btn-purple" onclick="imprimirHistorial()">Imprimir Historial</button>
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
            function historial_datopaciente() {
                var pacienteId = $("#paciente_diagnostico").val();
                var pacienteNombre = $("#paciente_diagnostico option:selected").data('nombre');
                if (pacienteId === "0") {
                    $('#datos_diagnostico').html(`<tr>
                                        <td colspan="3"><div class="alert alert-info">
                                                <span class="glyphicon glyphicon-info-sign"></span> 
                                                No se han seleccionado Paciente...
                                            </div></td>
                                    </tr>`);
                } else {
                    $.ajax({
                        type: "GET",
                        url: "historial_paciente.php?cod=" + pacienteId,
                        cache: false,
                        beforeSend: function () {
                            $('#datos_diagnostico').html('<img src="img/loader.gif" /><strong>Cargando...</strong>')
                        },
                        success: function (data) {
                            $('#datos_diagnostico').html(data);
                        },
                        error: function () {
                            $('#datos_diagnostico').html('<div class="alert alert-danger">Error al cargar el historial médico.</div>');
                        }
                    });
                }
            }

            function imprimirHistorial() {
                var contenido = document.getElementById('datos_diagnostico').innerHTML;
                var pacienteNombre = $("#paciente_diagnostico option:selected").data('nombre');
                var ventana = window.open('', '_blank');
                ventana.document.write('<html><head><title>Imprimir Historial</title>');
                ventana.document.write('<style>table {width: 100%; border-collapse: collapse;} table, th, td {border: 1px solid black;} th, td {padding: 10px; text-align: left;} th {background-color: #f2f2f2;}</style>');
                ventana.document.write('</head><body>');
                ventana.document.write('<div style="text-align: center;">');
                ventana.document.write('<img src="images/salud.png" alt="" style="width: 60px; height: auto;"><br>');
                ventana.document.write('<strong>CENTRO MEDICO VIDA Y AMOR"</strong><br>');
                ventana.document.write('Dirección: Ruta n°8 - Simón Bolivar<br>');
                ventana.document.write('Teléfono: 0975388433<br>');
                ventana.document.write('</div><br>');
                ventana.document.write('<h2 style="text-align: center;">Historial Médico del Paciente</h2>');
                ventana.document.write('<h3 style="text-align: center;">Paciente: ' + pacienteNombre + '</h3>');
                ventana.document.write('<table>' + contenido + '</table>');
                ventana.document.write('</body></html>');
                ventana.document.close();
                ventana.print();
            }
        </script>
        <?php require '../../estilos/js_lte.ctp'; ?> <!-- Agrega tus scripts JavaScript si es necesario -->
    </body>
</html>
