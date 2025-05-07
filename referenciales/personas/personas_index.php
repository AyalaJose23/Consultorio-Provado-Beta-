<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <?php
        session_start();
        include "../../conexion.php";
        require '../../estilos/css_lte.ctp';
        ?>
    </head>
    <body class="hold-transition skin-purple sidebar-mini">
        <!-- Contenedor principal -->
        <div class="wrapper">
            <!-- Cabecera y menú izquierdo -->
            <?php require '../../estilos/cabecera.ctp'; ?>
            <?php require '../../estilos/izquierda.ctp'; ?>

            <!-- Contenido principal -->
            <div class="content-wrapper">
                <div class="content">
                    <!-- Título de la página -->
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-xs-12">
                            <?php if (!empty($_SESSION['mensaje'])) { ?>
                                <?php
                                $mensaje = explode("_/_", $_SESSION['mensaje']);
                                $class = ($mensaje[0] == 'NOTICIA') ? "success" : "danger";
                                ?>
                                <div class="alert alert-<?= $class; ?>" role="alert" id="mensaje">
                                    <i class="ion ion-information-circled"></i>
                                    <?= $mensaje[1]; ?>
                                    <?php $_SESSION['mensaje'] = ''; ?>
                                </div>
                            <?php } ?>

                            <h3 class="page-header text-center">
                                <strong>REGISTRO DE PERSONAS</strong>
                                <a href="/tdp/MANUAL DE USUARIO tdp.pdf" target="print">
                                    <span class="glyphicon glyphicon-question-sign"></span>
                                </a>
                                <a href="personas_add.php" class="btn btn-purple btn-sm pull-right" data-title="Agregar" rel="tooltip">
                                    <i class="fa fa-plus"></i> Agregar Personas
                                </a>
                            </h3>
                        </div>
                    </div>

                    <!-- Formulario de búsqueda -->
                    <div class="panel-body no-padding">
                        <form action="personas_index.php" method="post" accept-charset="utf8" class="form-horizontal">
                            <div class="form-group">
                                <div class="col-lg-12">
                                    <div class="input-group custom-search-form">
                                        <input type="search" class="form-control" name="buscar" placeholder="Buscar..." autofocus />
                                        <span class="input-group-btn">
                                            <button type="submit" class="btn btn-purple btn-flat" data-title="Buscar" data-placement="bottom" rel="tooltip">
                                                <span class="fa fa-search"></span>
                                            </button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <!-- Tabla de datos -->
                        <div class="panel panel-info">
                            <div class="panel-heading">Datos de las Personas</div>
                            <div class="panel-body">
                                <?php
                                $personas = consultas::get_datos("SELECT * FROM v_personas ORDER BY id_persona");
                                if (!empty($personas)) { ?>
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Código</th>
                                                <th>Nombre</th>
                                                <th>Apellido</th>
                                                <th>C.I</th>
                                                <th>R.U.C</th>
                                                <th>Fecha de Nacimiento</th>
                                                <th>Teléfono</th>
                                                <th>Dirección</th>
                                                <th>Sexo</th>
                                                <th>Ciudad</th>
                                                <th>Nacionalidad</th>
                                                <th>Estado</th>
                                                <th class="text-center">Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($personas as $persona) { ?>
                                                <tr>
                                                    <td><?= $persona['id_persona']; ?></td>
                                                    <td><?= $persona['per_nombre']; ?></td>
                                                    <td><?= $persona['per_apellido']; ?></td>
                                                    <td><?= $persona['per_ci']; ?></td>
                                                    <td><?= $persona['per_ruc']; ?></td>
                                                    <td><?= $persona['per_fnac']; ?></td>
                                                    <td><?= $persona['per_telefono']; ?></td>
                                                    <td><?= $persona['per_direccion']; ?></td>
                                                    <td><?= $persona['per_sexo']; ?></td>
                                                    <td><?= $persona['ciu_descri']; ?></td>
                                                    <td><?= $persona['nac_descri']; ?></td>
                                                    <td class="<?= $persona['per_estado'] === 'ANULADO' ? 'text-danger' : 'text-success'; ?>">
                                                        <?= $persona['per_estado']; ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <!-- Botón de editar -->
                                                        <a href="personas_edit.php?vid_persona=<?= $persona['id_persona']; ?>" class="btn btn-warning btn-sm" data-title="Editar" rel="tooltip">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                        <!-- Botón de anular (solo si no está ANULADO) -->
                                                        <?php if ($persona['per_estado'] !== 'ANULADO') { ?>
                                                            <button class="btn btn-danger btn-sm" data-title="Anular" onclick="cambiarEstado(<?= $persona['id_persona']; ?>, 'ANULADO')">
                                                                <i class="fa fa-ban"></i>
                                                            </button>
                                                        <?php } ?>
                                                        <!-- Botón de activar (solo si no está ACTIVO) -->
                                                        <?php if ($persona['per_estado'] !== 'ACTIVO') { ?>
                                                            <button class="btn btn-success btn-sm" data-title="Activar" onclick="cambiarEstado(<?= $persona['id_persona']; ?>, 'ACTIVO')">
                                                                <i class="fa fa-check"></i>
                                                            </button>
                                                        <?php } ?>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                <?php } else { ?>
                                    <div class="alert alert-info">
                                        <span class="glyphicon glyphicon-info-sign"></span> No se han registrado personas.
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pie de página y scripts -->
        <?php require '../../estilos/pie.ctp'; ?>
        <?php require '../../estilos/js_lte.ctp'; ?>

        <script>
            // Cambiar estado
            function cambiarEstado(id_persona, nuevo_estado) {
                window.location.href = "personas_cambiar_estado.php?vid_persona=" + id_persona + "&estado=" + nuevo_estado;
            }

            // Mensaje de alerta con temporizador
            $("#mensaje").delay(4000).slideUp(200, function() {
                $(this).alert('close');
            });
        </script>
    </body>
</html>
