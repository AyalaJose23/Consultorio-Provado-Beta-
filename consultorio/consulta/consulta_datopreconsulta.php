<?php
require '../../conexion.php';
?>
<?php
$preconsulta = consultas::get_datos("SELECT * FROM v_pre_consulta WHERE cod_precon = " . $_GET['cod']);
?>
<?php if (!empty($preconsulta)) { ?>            
    <?php
    foreach ($preconsulta as $precon) {      
            ?>
            <tr>
                
                <td data-title="#" class="cod_precon"><?php echo $precon['cod_precon']; ?></td>
                <td hidden class="cod_pacientes"><?php echo $precon['cod_pacientes']; ?></td>
                <td data-title="Paciente"><?php echo $precon['paciente']; ?></td>
                <td data-title="Presion Arterial"><?php echo $precon['presion_arterial']; ?></td>
                <td data-title="Temperatura"><?php echo $precon['temperatura']; ?></td>
                <td data-title="Frecuencia Respiratoria"><?php echo $precon['frecuencia_respiratoria']; ?></td>
                <td data-title="Frecuencia Cardiaca"><?php echo $precon['frecuencia_cardiaca']; ?></td>
                <td data-title="Saturacion"><?php echo $precon['saturacion']; ?></td>
                <td data-title="Talla"><?php echo $precon['talle']; ?></td> 
                <td data-title="Peso"><?php echo $precon['peso']; ?></td>
            </tr>
            <?php       
    }
} else {
    ?>
    <option value=""></option> 
<?php } ?>        


