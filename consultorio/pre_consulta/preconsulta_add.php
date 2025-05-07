<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="shortcut icon" type="image/x-icon" href="/taller3/img/abm.png">
        <title>Agregar Citas</title>
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
                        <strong>AÑADIR PRE CONSULTA</strong>
                        <a href="preconsulta_index.php" 
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
                                <strong>Agregar Pre Consulta</strong>
                            </div>
                            <div class="panel-body">
                                    <form action="preconsulta_control.php" method="post" class="form-horizontal">
                                        <input type="hidden" name="accion" value="1">
                                        <input type="hidden" name="vcod_precon" value="0">
                                        <div class="row">
                                            <!-- Columna izquierda -->
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <?php $fecha = consultas::get_datos("SELECT current_date as fecha"); ?>
                                                    <label for="fecha" class="form-label">Fecha:</label>
                                                    <input type="date" name="vfecha_precon" class="form-control" id="fecha" value="<?php echo $fecha[0]['fecha']; ?>" readonly>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="hora" class="form-label">Hora:</label>
                                                    <input type="time" name="vhora_precon" class="form-control" id="hora" value="07:00">
                                                </div>

                                                <!-- Paciente -->
                                                <div class="mb-6">       
                                                    <label>Paciente</label>
                                                    <select name="vcod_cita" id="paciente_pre_consulta" class="form-control">
                                                        <?php
                                                        $pre = consultas::get_datos("SELECT c.cod_cita,
                                                                        p.cod_pacientes,
                                                                        per.per_nombre,
                                                                        per.per_apellido
                                                                FROM citas c 
                                                                JOIN pacientes p ON p.cod_pacientes = c.cod_pacientes
                                                                JOIN persona per ON per.id_persona = p.id_persona
                                                                WHERE c.cita_estado = 'CONFIRMADO'");
                                                        ?>
                                                        <option value="0">Citas del día</option>
                                                        <?php foreach ($pre as $con) : ?>
                                                            <option value="<?php echo $con['cod_cita']; ?>">
                                                                <?= $con['per_nombre']; ?> <?= $con['per_apellido']; ?>
                                                            </option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <!-- Columna derecha -->
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="presion" class="form-label">Presión Arterial (mmHg):</label>
                                                    <input type="number" class="form-control" name="vpresion_arterial" id="presion" placeholder="Presión Arterial">
                                                </div>

                                                <div class="mb-3">
                                                    <label for="temperatura" class="form-label">Temperatura (Cº):</label>
                                                    <input type="number" class="form-control" name="vtemperatura" id="temperatura" placeholder="Temperatura">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <!-- Campos adicionales -->
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="frecuencia_respiratoria" class="form-label">Frecuencia Respiratoria (x Minuto):</label>
                                                    <input type="number" class="form-control" name="vfrecuencia_respiratoria" id="frecuencia_respiratoria" placeholder="Frecuencia Respiratoria">
                                                </div>

                                                <div class="mb-3">
                                                    <label for="frecuencia_cardiaca" class="form-label">Frecuencia Cardiaca (x Minuto):</label>
                                                    <input type="number" class="form-control" name="vfrecuencia_cardiaca" id="frecuencia_cardiaca" placeholder="Frecuencia Cardiaca">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="saturacion" class="form-label">Saturación O2:</label>
                                                    <input type="number" class="form-control" name="vsaturacion" id="saturacion" placeholder="Saturación">
                                                </div>

                                                <div class="mb-3">
                                                    <label for="peso" class="form-label">Peso (Kg):</label>
                                                    <input type="number" class="form-control" name="vpeso" id="peso" placeholder="Peso">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label for="talla" class="form-label">Talla (cm):</label>
                                            <input type="number" class="form-control" name="vtalle" id="talla" placeholder="Talla">
                                        </div>

                                        <!-- Botones -->
                                        <div class="box-footer text-center">
                                            <a href="preconsulta_index.php" class="btn btn-default pull-right"><i></i> Cancelar</a>
                                            <button type="submit" class="btn btn-purple pull-right"><i></i> Registrar</button>
                                        </div>
                                    </form>
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
            function citas() {
                console.log($('#pacientes').val());
                $.ajax({
                    type: "GET",
                    url: "preconsulta_paccitas.php?vcod_paciente=" + $('#pacientes').val(),
                    cache: false,
                    beforeSend: function () {
                        $('#vcod_cita').html('<img src="img/loader.gif" /><strong>Cargando...</strong>')
                    },
                    success: function (data) {
                        console.log(data);
                        $('#vcod_cita').html(data);
                    }
                });
            }
        </script>
        <script>
            $(document).ready(function () {
                // Manejar el evento de cambio del select
                $('.seleccionar-paciente').change(function () {
                    // Obtener el valor seleccionado
                    var selectedPaciente = $(this).val();

                    // Realizar una llamada AJAX para obtener la información del paciente
                    // Aquí debes implementar la lógica para obtener la información del paciente según el valor seleccionado

                    // Actualizar los campos CI y Fecha de Nacimiento con la información obtenida
                    $('#vpac_ci').val('per_ci');
                    $('#vpac_fecnac').val('vpac_fecnac');
                });
            });
        </script>

<?php require '../../estilos/js_lte.ctp'; ?><!--ARCHIVOS JS-->
        <script>
            $('#mensaje').delay(4000).slideUp(200, function () {
                $(this).alert('close');
            });
        </script>
    </body>
</html>
