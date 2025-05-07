<?php
    require '../../conexion.php';

if (!isset($_GET['cod'])) {
    die('No se ha especificado un paciente.');
}

$cod_pacientes = intval($_GET['cod']);
$historial = consultas::get_datos("SELECT * FROM v_historial WHERE cod_pacientes = $cod_pacientes");

// Verificar si hay registros en el historial
if ($historial != null) {
    foreach ($historial as $his) {
        ?>
        <tr>
            <td data-title="Tipo"><?php echo htmlspecialchars($his['tipo']); ?></td>
            <td data-title="Fecha"><?php echo htmlspecialchars($his['fecha']); ?></td>
            <td data-title="Descripción"><?php echo htmlspecialchars($his['descripcion']); ?></td>
        </tr>
        <?php
    }
} else {
    ?>
    <tr>
        <td data-title="No hay historial" colspan="3" style="color: red;">NO HAY HISTORIAL</td>
    </tr>
    <?php
}
?>
