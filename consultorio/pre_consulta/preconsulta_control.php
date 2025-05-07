<?php
require '../../conexion.php';
session_start();
$sql = "SELECT sp_pre_consulta(
           " . $_REQUEST['accion'] . ",
           ".$_REQUEST['vcod_precon'].", 
           " . (isset($_REQUEST['vfecha_precon']) ? "'" . date('Y-m-d', strtotime($_REQUEST['vfecha_precon'])) . "'" : 'NULL') . ",   
           '" . (!empty($_REQUEST['vhora_precon']) ? $_REQUEST['vhora_precon'] : "00:00:00") . "',
           " . (!empty($_REQUEST['vpresion_arterial']) ? $_REQUEST['vpresion_arterial'] : "0") . ",
           " . (!empty($_REQUEST['vtemperatura']) ? $_REQUEST['vtemperatura'] : "0") . ",
           " . (!empty($_REQUEST['vfrecuencia_respiratoria']) ? $_REQUEST['vfrecuencia_respiratoria'] : "0") . ",  
           " . (!empty($_REQUEST['vfrecuencia_cardiaca']) ? $_REQUEST['vfrecuencia_cardiaca'] : "0") . ",
           " . (!empty($_REQUEST['vsaturacion']) ? $_REQUEST['vsaturacion'] : "0") . ",
           " . (!empty($_REQUEST['vtalle']) ? $_REQUEST['vtalle'] : "0") . ", 
           " . (!empty($_REQUEST['vpeso']) ? $_REQUEST['vpeso'] : "0") . ",
           " . (!empty($_REQUEST['vcod_cita']) ? $_REQUEST['vcod_cita'] : "0"). ", 
           " . $_SESSION['usu_cod']. ") as resul";

$resultado = consultas::get_datos($sql);

if ($resultado[0]['resul'] != null) {
    $valor = explode("*", $resultado[0]['resul']);
    $_SESSION['mensaje'] = $valor[0];
    $sql = "select COALESCE(max(cod_precon), 0) AS vcod_precon from v_pre_consulta";
    $resultado = consultas::get_datos($sql);
    header("location:preconsulta_index.php?vcod_precon=" . $resultado[0]['vcod_precon']);
} else {
    $_SESSION['mensaje'] = "ERROR: $sql";
    header("location:preconsulta_index.php?vcod_precon=" . $_REQUEST['vcod_precon']);
}
?>

