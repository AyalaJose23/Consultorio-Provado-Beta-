<?php
include '../../conexion.php';
session_start();

// Parámetros para la función sp_agenda_detalle
$sql = "SELECT sp_agenda_detalle(
        ".$_REQUEST['accion'].",
        ".(!empty($_REQUEST['vcod_agenda'])? $_REQUEST['vcod_agenda']:"0").",
        ".(!empty($_REQUEST['vcod_doctor']) ? $_REQUEST['vcod_doctor'] : "0").",
        ".(!empty($_REQUEST['vcod_especialidad']) ? $_REQUEST['vcod_especialidad'] : "0").",
        ".(!empty($_REQUEST['vcod_dia']) ? $_REQUEST['vcod_dia'] : "0").",
        ".(!empty($_REQUEST['vcod_turnos']) ? $_REQUEST['vcod_turnos'] : "0").",
        '".(!empty($_REQUEST['vhora_inicio']) ? $_REQUEST['vhora_inicio'] : "00:00:00")."',
        '".(!empty($_REQUEST['vhora_fin']) ? $_REQUEST['vhora_fin'] : "00:00:00")."',
        ".(!empty($_REQUEST['vcupos']) ? $_REQUEST['vcupos'] : "0").",
        ".(!empty($_REQUEST['vcod_sala']) ? $_REQUEST['vcod_sala'] : "0").",
        '".(!empty($_REQUEST['vobservacion']) ? $_REQUEST['vobservacion'] : "")."',
        '".(!empty($_REQUEST['vdet_estado']) ? $_REQUEST['vdet_estado'] : "CONFIRMADO")."' ) as resul";
// Ejecutar la consulta
$resultado = consultas::get_datos($sql);

// Verificar el resultado y redirigir
if ($resultado[0]['resul'] != null) {
    $_SESSION['mensaje'] = $resultado[0]['resul'];
    header("location:agendadetalle_add.php?vcod_agenda=".$_REQUEST['vcod_agenda']);
} else {
    $_SESSION['mensaje'] = "ERROR: $sql";
    header("location:agendadetalle_add.php?vcod_agenda=".$_REQUEST['vcod_agenda']);
}
?>

