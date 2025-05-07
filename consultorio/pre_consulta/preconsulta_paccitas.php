<?php
session_start();
include "../../conexion.php";
?>
<?php
$paciente = "cod_paciente = " . $_REQUEST['vcod_paciente'];
$citas = consultas::get_datos("SELECT c.cod_cita, c.cita_hora, c.cita_fecha, c.cod_paciente 
                              FROM citas c
                              JOIN pacientes p ON c.cod_paciente = p.cod_paciente
                              WHERE c.cita_estado = 'CONFIRMADO' and c.cod_paciente = " . $_GET['vcod_paciente']);
?>
<?php if (!empty($citas)){ ?>            
    <option value="">Citas Disponibles</option>        
    <?php foreach ($citas as $cit) { ?>
        <option value="<?php echo $cit['cod_cita'] ?>">
            <?= $cit['cita_fecha'] ?> || <?= $cit['cita_hora'] ?>
        </option>            
    <?php } ?>
<?php } else { ?>
    <option value="">Este Paciente no tiene citas disponibles</option> 
<?php } ?>
