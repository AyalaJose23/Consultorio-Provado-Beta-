<?php
session_start();
include "../../conexion.php";

$detalles = consultas::get_datos("select * from v_ordenestudiosdetalle"
            . " where cod_estudios=" . $_REQUEST['vcod_estudios'] . " and cod_t_estudio =" . $_REQUEST['vcod_t_estudios']);?>

<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">x</button>
    <h4 class="modal-title"><i class="fa fa-edit"></i> <strong>Actualizar Detalle</strong></h4>
</div>

<form action="ordenestudiosdetalle_control.php" method="post" accept-charset="utf-8" class="form-horizontal">
    <input type="hidden" name="accion" value="3"/>
    <input type="hidden" name="vcod_estudios" value="<?php echo $detalles[0]['cod_estudios'] ?>"/>
    <input type="hidden" name="vcod_t_estudios" value="<?php echo $detalles[0]['cod_t_estudio'] ?>"/>
    <div class="modal-body">

        <div class="form-group">
            <label class="control-label col-lg-2 col-sm-3 col-md-2 col-xs-2">Tipo de Estudios:</label>
            <div class="col-lg-6 col-md-6 col-sm-7">
                <?php
                $tipoestudio = consultas::get_datos("SELECT * FROM v_tipoestudio ORDER BY cod_t_estudio");
                ?>
                <select class="form-control select2" name="vcod_t_estudios">
                    <?php if (!empty($tipoestudio)) { ?>            
                        <option value="0">Seleccionar Tipo Orden de Estudio</option>       
                        <?php foreach ($tipoestudio as $tipoe) { ?>
                            <option value="<?php echo $tipoe['cod_t_estudio']; ?>"><?php echo $tipoe['descrip_t_estudio']; ?></option>                          
                            <?php
                        }
                    }
                    ?>
                    <?php ?>        
                </select>
            </div>
            <br>
            <br>
            <br>
            <div class="form-group">
                <label class="control-label col-lg-2 col-sm-2 col-md-2">Observacion:</label>
                <div class="col-lg-6 col-sm-6 col-md-7">
                    <input type="text" name="vdescrip_estudio" class="form-control"  required="" value="<?php echo $detalles[0]['descrip_estudio'] ?>"/>
                </div>
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