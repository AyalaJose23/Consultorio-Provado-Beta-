<?php
session_start();
include "../../conexion.php";
?>
<?php
$ordenanalisis = consultas::get_datos("SELECT * FROM v_ordenanalisisdetalle WHERE cod_analisis = " . $_GET['oacod']);
?>
<?php if (!empty($ordenanalisis)) { ?>            
    <?php
    foreach ($ordenanalisis as $oa) {
        ?>
        <tr>
            <td data-title="#" class="cod_analisis"><?php echo $oa['cod_analisis']; ?></td>
            <td data-title="Paciente"><?php echo $oa['paciente']; ?></td>
            <td data-title="Fecha de Orden Estudio"><?php echo $oa['fecha_analisis']; ?></td>
            <td data-title="Tipo de Orden Estudio"><?php echo $oa['descrip_t_analisis']; ?></td>
            <td data-title="Observación"><?php echo $oa['descrip_analisis']; ?></td>
        </tr>
        <?php
    }
} else {
    ?>
    <option value=""></option> 
<?php } ?>
        


