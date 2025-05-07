<?php
session_start();
include "../../conexion.php";
require '../../estilos/css_lte.ctp';

$sql = "SELECT sp_tratamiento_detalle(
         " . $_REQUEST['accion'] . ",
         " . (!empty($_REQUEST['vcod_trata']) ? $_REQUEST['vcod_trata'] : "0") . ",  
         " . (!empty($_REQUEST['vcod_t_trata']) ? $_REQUEST['vcod_t_trata'] : "0") . ",
         '" . (!empty($_REQUEST['vdetalle_observ']) ? $_REQUEST['vdetalle_observ']  : "0") . "',
         " . (!empty($_REQUEST['vprecio']) ? $_REQUEST['vprecio']  : "0") . ",
         '" .(isset($_REQUEST['vfecha_inicio']) ? $_REQUEST['vfecha_inicio'] : ''). "', 
         '" .(isset($_REQUEST['vfecha_fin']) ? $_REQUEST['vfecha_fin'] : ''). "') AS resul";

$resultado = consultas::get_datos($sql);

// Verificar el resultado y redirigir con el mensaje correspondiente
if ($resultado[0]['resul'] != null) {
    $_SESSION['mensaje'] = $resultado[0]['resul'];
    header("location:tratamientodetalle_add.php?vcod_trata=".$_REQUEST['vcod_trata']);
} else {
    $_SESSION['mensaje'] = "ERROR: $sql";
    header("location:tratamientodetalle_add.php?vcod_trata=".$_REQUEST['vcod_trata']);
}
?>

