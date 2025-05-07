<?php
session_start();
include "../../conexion.php";
$sql = "SELECT sp_ordenestudios(
         " . $_REQUEST['accion'] . ",
             " . $_REQUEST['vcod_estudios'] . ",
         " . $_SESSION['usu_cod'] . ",
         " . (!empty($_REQUEST['vcod_pacientes']) ? $_REQUEST['vcod_pacientes']  : "0") . " ) as resul";

$resultado = consultas::get_datos($sql);

if ($resultado[0]['resul'] != null) {
    $valor = explode("*", $resultado[0]['resul']);
    $_SESSION['mensaje'] = $valor[0];
    $sql = "select COALESCE(max(cod_estudios), 0) AS vcod_estudios from v_ordenestudio";
    $resultado = consultas::get_datos($sql);
    header("location:ordenestudiosdetalle_add.php?vcod_estudios=".$_REQUEST['vcod_estudios']);
}else {
    $_SESSION['mensaje'] = "Error: Resultados no encontrados";
    header("location:ordenestudios_index.php");
}
?>

