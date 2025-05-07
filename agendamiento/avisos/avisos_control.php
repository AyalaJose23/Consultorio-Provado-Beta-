<?php

include "../../conexion.php";
session_start();

$sql = "SELECT sp_avisos(
         " . $_REQUEST['accion'] . ",
          " . (!empty($_REQUEST['vcod_avisos']) ? $_REQUEST['vcod_avisos'] : "0") . ",
         " . $_SESSION['usu_cod'] . ", 
         " . (!empty($_REQUEST['vcod_cita']) ? $_REQUEST['vcod_cita'] : "0") . ",
         '" . (!empty($_REQUEST['vaviso_observ']) ? $_REQUEST['vaviso_observ'] : "") . "',
         " . (!empty($_REQUEST['cod_pacientes']) ? $_REQUEST['cod_pacientes'] : "0") . " ) as resul";
$resultado = consultas::get_datos($sql);

if ($resultado[0]['resul'] != null) {
    $valor = explode("*", $resultado[0]['resul']);
    $_SESSION['mensaje'] = $valor[0];
    $sql = "select COALESCE(max(cod_avisos), 0) AS id from v_avisos_recordatorios";
    $resultado = consultas::get_datos($sql);
    header("location:avisos_index.php?vcod_avisos=" . $resultado[0]['id']);
} else {
    $_SESSION['mensaje'] = "ERROR: $sql";
    header("location:avisos_index.php?vcod_avisos=".$_REQUEST['vcod_avisos']);
}
?>
