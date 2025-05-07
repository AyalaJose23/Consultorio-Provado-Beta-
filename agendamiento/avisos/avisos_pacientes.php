<?php
include "../../conexion.php";
?>
<?php
$preconsulta = consultas::get_datos("SELECT * FROM v_citas WHERE cod_cita = " . $_GET['cod']);
?>
<?php if (!empty($preconsulta)) { ?>            
    <?php
    foreach ($preconsulta as $precon) {      
            ?>
            <tr>
                <td data-title="#" class="cod_cita"><?php echo $precon['cod_cita']; ?></td>
                <td hidden class="cod_pacientes"><?php echo $precon['cod_pacientes']; ?></td>
                <td data-title="Paciente"><?php echo $precon['paciente']; ?></td>
                <td data-title="Presion Arterial"><?php echo $precon['cita_fecha']; ?></td>
                <td data-title="Temperatura"><?php echo $precon['razon_cita']; ?></td>
                <td data-title="Frecuencia Respiratoria"><?php echo $precon['doctor']; ?></td>
                <td data-title="Frecuencia Cardiaca"><?php echo $precon['descrip_espec']; ?></td>
            </tr>
            <?php       
    }
} else {
    ?>
    <option value=""></option> 
<?php } ?>        


