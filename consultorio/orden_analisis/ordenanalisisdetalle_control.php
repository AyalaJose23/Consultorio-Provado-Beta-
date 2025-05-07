<?php
session_start();
include "../../conexion.php";

$sql = "SELECT sp_ordenanalisis_detalle(
         " . $_REQUEST['accion'] . ",
         " . (!empty($_REQUEST['vcod_analisis']) ? $_REQUEST['vcod_analisis'] : "0") . ",  
         " . (!empty($_REQUEST['vcod_t_analisis']) ? $_REQUEST['vcod_t_analisis'] : "0") . ",
         '" . (!empty($_REQUEST['vdescrip_analisis']) ? $_REQUEST['vdescrip_analisis']  : "0") . "' ) as resul";

$resultado = consultas::get_datos($sql);

if ($resultado[0]['resul']!=null) {
    $valor = explode("*", $resultado[0]['resul']);
    $_SESSION['mensaje']=$valor[0];
    header("location:ordenanalisisdetalle_add.php?vcod_analisis=".$_REQUEST['vcod_analisis']);
}else {
    $_SESSION['mensaje'] = "Error: Resultados no encontrados";
    header("location:ordenanalisis_index.php");
}
?>

