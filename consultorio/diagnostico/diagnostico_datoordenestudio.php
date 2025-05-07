<?php
session_start();
include "../../conexion.php";
?>
<?php
$ordenestudio = consultas::get_datos("SELECT * FROM v_ordenestudiosdetalle WHERE cod_estudios = " . $_GET['cod']);
?>
<?php if (!empty($ordenestudio)) { ?>            
    <?php
    foreach ($ordenestudio as $oe) {
        ?>
        <tr>
            <td hidden class="cod_pacientes"><?php echo $oe['cod_pacientes']; ?></td>
            <td data-title="#" class="cod_estudios"><?php echo $oe['cod_estudios']; ?></td>
            <td data-title="Paciente"><?php echo $oe['paciente']; ?></td>
            <td data-title="Fecha de Orden Estudio"><?php echo $oe['fecha_estudio']; ?></td>
            <td data-title="Tipo de Orden Estudio"><?php echo $oe['descrip_t_estudio']; ?></td>
            <td data-title="Observación"><?php echo $oe['descrip_estudio']; ?></td>
        </tr>
        <?php
    }
} else {
    ?>
    <option value=""></option> 
<?php } ?>
        


