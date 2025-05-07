<?php 
require '../../conexion.php';
session_start();

$detalle = consultas::get_datos("select * from v_agenda_detalle"
        . " where cod_agenda=".$_REQUEST['vcod_agenda']." and cod_doctor =".$_REQUEST['vcod_doctor']
        ." and cod_especialidad =".$_REQUEST['vcod_especialidad'] 
        ."and cod_dia =".$_REQUEST['vcod_dia']
          ." and cod_turnos =".$_REQUEST['vcod_turnos']
          ." and cod_sala =".$_REQUEST['vcod_sala'] );
?>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">x</button>
    <h4 class="modal-title"><i class="fa fa-edit"></i> <strong>Editar Detalle de Agenda</strong></h4>
</div>
<form action="agendadetalle_control.php" method="post" accept-charset="utf-8" class="form-horizontal">
    <input type="hidden" name="accion" value="2"/>
    <input type="hidden" name="vcod_agenda" value="<?php echo $detalle[0]['cod_agenda'] ?>"/>
    <input type="hidden" name="vcod_doctor" value="<?php echo $detalle[0]['cod_doctor'] ?>"/>
    <input type="hidden" name="vcod_especialidad" value="<?php echo $detalle[0]['cod_especialidad'] ?>"/>
    <input type="hidden" name="vcod_dia" value="<?php echo $detalle[0]['cod_dia'] ?>"/>
    <input type="hidden" name="vcod_turnos" value="<?php echo $detalle[0]['cod_turnos'] ?>"/>
    <input type="hidden" name="vcod_sala" value="<?php echo $detalle[0]['cod_sala'] ?>"/>
    <div class="modal-body">
        
        <div class="form-group">
            <label class="control-label col-lg-2 col-sm-2 col-md-2">Doctor:</label>
            <div class="col-lg-6 col-sm-6 col-md-6">
                <input type="text" class="form-control" disabled="" value="<?php echo $detalle[0]['doctor']?>"/>
            </div>
        </div>
        
        <div class="form-group">
            <label class="control-label col-lg-2 col-sm-2 col-md-2">Especialidad:</label>
            <div class="col-lg-6 col-sm-6 col-md-6">
                <input type="text" class="form-control" disabled="" value="<?php echo $detalle[0]['descrip_espec']?>"/>
            </div>
        </div> 
        
        <div class="form-group">
            <label class="control-label col-lg-2 col-sm-2 col-md-2">Dias:</label>
            <div class="col-lg-6 col-sm-6 col-md-6">
                <input type="text" class="form-control" disabled="" value="<?php echo $detalle[0]['dia_descri']?>"/>
            </div>
        </div>
        
        <div class="form-group">
            <label class="control-label col-lg-2 col-sm-2 col-md-2">Turno:</label>
            <div class="col-lg-6 col-sm-6 col-md-6">
                <input type="text" class="form-control" disabled="" value="<?php echo $detalle[0]['descrip_tur']?>"/>
            </div>
        </div>  
        
    </div>
    <div class="modal-footer">
        <button type="reset" data-dismiss="modal" class="btn btn-default">
            <i class="fa fa-remove"></i> Cerrar
        </button>
        <button type="submit" class="btn btn-warning">
            <i class="fa fa-floppy-o"></i> Actualizar
        </button>                                      
    </div>
</form>