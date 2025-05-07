<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="shortcut icon" type="image/x-icon" href="/taller3/img/abm.png">
        <title>CENTRO MEDICO VIDA Y AMOR</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

        <?php
        session_start(); /* Reanudar sesion */
        
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
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <?php if (!empty($_SESSION['mensaje'])) { ?>
                                <div class="alert alert-danger" role="alert" id="mensaje">
                                    <span class="glyphicon glyphicon-exclamation-sign"></span>
                                    <?php
                                    echo $_SESSION['mensaje'];
                                    $_SESSION['mensaje'] = '';
                                    ?>
                                </div>
                            <?php } ?>
                            <div class="content">
                                <div class="row">
                                    <!--impresion del titulo de la pagina-->
                                    <div class="col-lg-12">
                                    <h3 class="page-header text-center" style="background-color: rgba(147, 112, 219, 0.5); color: #800080;"> 
                                    <strong>AGREGAR DETALLE DE AGENDA</strong>
                                    <a href="agenda_index.php" 
                                            class="btn btn-purple pull-right" 
                                            rel='tooltip' title="Atras">
                                                <i class="glyphicon glyphicon-arrow-left"></i>
                                            </a> 

                                        </h3>
                                    </div>     
                                    <!--Buscador-->
                                </div>
                                <!--INICIO cabecera-->
                                <div class="panel panel-info">
                                    <div class="panel-heading">
                                        <strong>Datos Detalle Agenda</strong>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-xs-12">                                                                               
                                        <?php
                                      $agenda = consultas::get_datos("select * FROM v_agenda WHERE cod_agenda = ".$_REQUEST['vcod_agenda']); 
                                        if (!empty($agenda)) {
                                            ?>
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-striped table-condensed table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Fecha</th>
                                                            <th>Fecha Inicio</th>
                                                            <th>Fecha Fin</th>
                                                            <th>Estado</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($agenda as $agen) { ?>
                                                            <tr>
                                                                <td data-title="#"><?php echo $agen['cod_agenda']; ?></td>
                                                                <td data-title="Fecha"><?php echo $agen['agen_fecha']; ?></td>
                                                                <td data-title="Fecha Inicio"><?php echo $agen['fecha_inicio']; ?></td>
                                                                <td data-title="Fecha Fin"><?php echo $agen['fecha_fin']; ?></td>
                                                                <td data-title="Estado"><?php echo $agen['agen_estado']; ?></td>
                                                            </tr>  
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        <?php } else { ?>
                                            <div class="alert alert-info">
                                                <span class="glyphicon glyphicon-info-sign"></span> 
                                                No se han registrado detalle de agenda...
                                            </div>      
                                        <?php } ?>
                                    </div>
                                </div>
                                <!--Fin de cabecera -->
                                <!--Inicio de detalle agregar-->
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">                               
                                        <?php
                                        $agendadetalle = consultas::get_datos("select * from v_agenda_detalle where cod_agenda= " . $agenda[0]['cod_agenda'] );
                                        if (!empty($agendadetalle)) {
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
                                                            <th>DOCTOR</th>
                                                            <th>ESPECIALIDAD</th>
                                                            <th>TURNO</th>
                                                            <th>DIA</th>
                                                            <th>SALA</th>
                                                            <th>HORA INICIO</th>
                                                            <th>HORA FIN</th>
                                                            <th>CUPOS</th>
                                                            <th class="text-center" >Accciones</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($agendadetalle as $detalle) { ?>
                                                            <tr>
                                                                <td data-title="#"><?php echo $detalle['cod_agenda']; ?></td>
                                                                <td data-title="Doctor"><?php echo $detalle['doctor']; ?></td>
                                                                <td data-title="Especialidad"><?php echo $detalle['descrip_espec']; ?></td>
                                                                <td data-title="Turno."><?php echo $detalle['descrip_tur']; ?></td>
                                                                <td data-title="Dia"><?php echo $detalle['dia_descri']; ?></td>
                                                                <td data-title="Sala"><?php echo $detalle['descrip_sala']; ?></td>
                                                                <td data-title="Inicio"><?php echo $detalle['hora_inicio']; ?></td>
                                                                <td data-title="Fin"><?php echo $detalle['hora_fin']; ?></td>
                                                                <td data-title="Cupos"><?php echo $detalle['cupos']; ?></td>
                                                                <td class="text-center">
                                                                    <a onclick="editar(<?php echo $detalle['cod_agenda'] . "_" . $detalle['cod_doctor'] . "_" . $detalle['cod_especialidad'] 
                                                                            . "_" . $detalle['cod_dia'] . "_" . $detalle['cod_turnos'] . "_" . $detalle['cod_sala']; ?>)"
                                                                               class="btn btn-warning btn-sm" data-title="Editar" rel="tooltip" data-placement="left" data-toggle="modal" data-target="#editar">
                                                                                <i class="fa fa-edit"></i>
                                                                    </a>   
                                                                    <a onclick="borrar( '<?php echo $detalle['cod_agenda'] . "_" . $detalle['cod_doctor'] . "_" . $detalle['cod_especialidad'] 
                                                                            . "_" . $detalle['cod_dia'] . "_" . $detalle['cod_turnos'] . "_" . $detalle['cod_sala']; ?>')" 
                                                                            data-toggle="modal" data-target="#borrar" class="btn btn-danger btn-sm" role="button" data-title="Quitar"rel="tooltip" data-placement="top">
                                                                            <i class="fa fa-trash"></i>
                                                                    </a>
                                                                </td>
                                                            </tr>  
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        <?php } else { ?>
                                            <div class="alert alert-info">
                                                <span class="glyphicon glyphicon-info-sign"></span> 
                                                La agenda  aún no tiene detalles cargados...
                                            </div>      
                                        <?php } ?>
                                    </div>
                                </div>
                                <!--Fin de detalle -->
                                <div class="box-body">
                                    <div class="box-body">
                                        <form action="agendadetalle_control.php" method="post">
                                            <input type="hidden" name="accion" value="1">
                                            <input type="hidden" name="vcod_agenda" value="<?php echo $agenda[0]['cod_agenda'] ?>"/>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="card-primary">
                                                        <div class="card-header text-center" style="background-color: #800080; color: #ffffff;">
                                                            AGENDA
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="form-group">
                                                                <label for="vcod_doctor">Doctor:</label>
                                                                <?php
                                                                $doctor = consultas::get_datos("SELECT * FROM vista_doctor ORDER BY cod_doctor");
                                                                ?>
                                                                <select class="form-control" name="vcod_doctor" required>
                                                                    <option value="">Seleccionar Doctor</option>
                                                                    <?php foreach ($doctor as $dr) : ?>
                                                                        <option value="<?php echo $dr['cod_doctor']; ?>"><?php echo $dr['doctor']; ?></option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="vcod_especialidad">Especialidad:</label>
                                                                <?php
                                                                $especialidad = consultas::get_datos("SELECT * FROM especialidad ORDER BY cod_especialidad");
                                                                ?>
                                                                <select class="form-control" name="vcod_especialidad" required>
                                                                    <option value="">Seleccionar Especialidad</option>
                                                                    <?php foreach ($especialidad as $espe) : ?>
                                                                        <option value="<?php echo $espe['cod_especialidad']; ?>"><?php echo $espe['descrip_espec']; ?></option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                            </div>
                                                            
                                                            <div class="form-group" >
                                                                <?php $dias = consultas::get_datos("select * from dias order by cod_dia"); ?>
                                                                   <label for="vcod_dia">Dias de Atención:</label>
                                                             
                                                                    <select class="form-control select2" name="vcod_dia" required="">
                                                                        <option value="">Seleccionar Dias</option>
                                                                        <?php foreach ($dias as $dia) { ?>
                                                                            <option value="<?php echo $dia['cod_dia']; ?>"><?php echo $dia['dia_descri']; ?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                            </div>
                                                         

                                                            <div class="form-group">
                                                                <label for="vcod_turnos">Turno:</label>
                                                                <?php
                                                                $turnos = consultas::get_datos("SELECT * FROM turnos ORDER BY cod_turnos");
                                                                ?>
                                                                <select class="form-control" name="vcod_turnos" required>
                                                                    <option value="">Seleccionar Turno</option>
                                                                    <?php foreach ($turnos as $turno) : ?>
                                                                        <option value="<?php echo $turno['cod_turnos']; ?>"><?php echo $turno['descrip_tur']; ?></option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                            </div>
                                                            
                                                            <div class="form-group">
                                                                <label for="vcod_sala">SALA:</label>
                                                                <?php
                                                                $sala = consultas::get_datos("SELECT * FROM sala ORDER BY cod_sala");
                                                                ?>
                                                                <select class="form-control" name="vcod_sala" required>
                                                                    <option value="">Seleccionar Sala</option>
                                                                    <?php foreach ($sala as $sal) : ?>
                                                                        <option value="<?php echo $sal['cod_sala']; ?>"><?php echo $sal['descrip_sala']; ?></option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                            </div>
                                                            
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="card card-success">
                                                        <div class="card-header text-center" style="background-color: #800080; color: #ffffff;">
                                                            COMPLETA LOS DATOS
                                                        </div>
                                                        <div class="form-group">
                                                            <label>INICIO:</label>
                                                            <input type="time" class="form-control" name="vhora_inicio" value="07:00">
<!--                                                            <input type="time" name="vhora_inicio" class="form-control" value="<?php echo date('H:i:s'); ?>" required>-->

                                                        </div>
                                                        <div class="card-body">
                                                            <div class="form-group">
                                                                <label>FIN:</label>
                                                                <input type="time" class="form-control" name="vhora_fin" value="07:00">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>CUPOS:</label>
                                                                <input type="number" class="form-control" name="vcupos" value="5">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="razon_cita">Observación:</label>
                                                                <textarea name="vobservacion" id="razon_cita" class="form-control" rows="4" ></textarea>
                                                            </div>
                                                            <div class="box-footer">
                                                                 <a href="agenda_index.php" class="btn btn-default">
                                                                    <i class="fa fa-remove"></i> CERRAR
                                                                </a> 
                                                                <button type="submit" class="btn btn-purple pull-right">
                                                                    <span class="glyphicon glyphicon-floppy-saved"></span> Registrar
                                                                </button>
                                                            </div>
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
                <?php require '../../estilos/pie.ctp'; ?>
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
                                  <a id="si" role="buttom" class="btn btn-primary">
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
                    <!-- inicio modal editar detalle-->
                  <div class="modal" id="editar" role="dialog">
                      <div class="modal-dialog">
                          <div class="modal-content" id="detalles">
                          </div>
                      </div>
                  </div>
                  <!-- fin modal editar detalle-->
            </div>                  
            <?php require '../../estilos/js_lte.ctp'; ?><!--ARCHIVOS JS-->
            <script>
                $('#mensaje').delay(4000).slideUp(200, function () {
                    $(this).alert('close');
                });
            </script>
             <script>
        $("#mensaje").delay(4000).slideUp(200,function(){
           $(this).alert('close'); 
        });
        </script>
        <script>
   function borrar(datos) {
    var dat = datos.split('_');
    $('#si').attr('href', 'agendadetalle_control.php?vcod_agenda=' + dat[0] + '&vcod_doctor=' + dat[1] + '&vcod_especialidad=' + dat[2] + '&vcod_dia=' + dat[3] +
        '&vcod_turnos=' + dat[4] + '&vcod_sala=' + dat[5] + '&accion=3');
    $("#confirmacion").html('<span class="glyphicon glyphicon-warning-sign"></span> \n\
            Deseas quitar los datos del detalle <strong>' + dat[1] + '</strong> de la agenda?');
}

        </script> 
        <script>
            function precio(){
                car dat =$('#articulo').val().split('_');
                $('#vprecio').val(dat[1]);
            }
        </script>
        <script >
            function editar(agen,doc, esp,dia,tur,sal){
            $.ajax({
                type    :   "GET",
                url     :   "/taller3/agendamiento/agenda_medica/agendadetalle_editar.php?vcod_agenda="+agen+"&vcod_doctor="+doc+"&vcod_especialidad="+esp+"&vcod_dia="+dia+"&vcod_turnos="+tur
                +"&vcod_sala="+sal,
                cache   :   false,
                beforeSend:function(){
                    $('#detalles').html('<img src="img/loading.gif" /><strong>Cargando...</strong>');
                },
                success:function(data){
                    $('#detalles').html(data);
                }
            })
        }
        </script>
    </body>
</html>
