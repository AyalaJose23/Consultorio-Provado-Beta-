<?php
session_start();
include "../../conexion.php";
$sql = "SELECT sp_ordenanalisis(
         " . $_REQUEST['accion'] . ",
             " . $_REQUEST['vcod_analisis'] . ",
         " . $_SESSION['usu_cod'] . ",
         " . (!empty($_REQUEST['vcod_pacientes']) ? $_REQUEST['vcod_pacientes']  : "0") . " ) as resul";

$resultado = consultas::get_datos($sql);

if ($resultado[0]['resul'] != null) {
    $valor = explode("*", $resultado[0]['resul']);
    $_SESSION['mensaje'] = $valor[0];
    $sql = "select COALESCE(max(cod_analisis), 0) AS vcod_analisis from v_ordenanalisis";
    $resultado = consultas::get_datos($sql);
    header("location:ordenanalisisdetalle_add.php?vcod_analisis=".$_REQUEST['vcod_analisis']);
}else {
    $_SESSION['mensaje'] = "Error: Resultados no encontrados";
    header("location:ordenanalisis_index.php");
}
?>

