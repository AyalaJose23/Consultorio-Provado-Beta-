<?php
session_start();
include "../../conexion.php";
?>
<?php
$diagnostico = consultas::get_datos("SELECT * FROM v_diagnosticodetalle WHERE cod_diag = " . $_GET['cod']);
?>
<?php if (!empty($diagnostico)) { ?>            
    <?php
    foreach ($diagnostico as $diag) {
            ?>
        <tr>
            <td hidden class="cod_pacientes"><?php echo $diag['cod_pacientes']; ?></td>
            <td data-title="#" class="cod_diag"><?php echo $diag['cod_diag']; ?></td>
            <td data-title="Paciente"><?php echo $diag['paciente']; ?></td>
            <td data-title="Fecha"><?php echo $diag['fecha_diag']; ?></td>
            <td data-title="Tipo de Enfermedad"><?php echo $diag['descrip_t_enfer']; ?></td>
            <td data-title="Enfermedad"><?php echo $diag['enfe_descri']; ?></td>
            <td data-title="Observacion"><?php echo $diag['detalle_descri']; ?></td>
        </tr>
            <?php      
    }
} else {
    ?>
    <option value=""></option> 
<?php } ?>        


