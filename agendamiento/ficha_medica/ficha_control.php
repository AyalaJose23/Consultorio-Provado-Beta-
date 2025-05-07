<?php
session_start();
include "../../conexion.php";
ob_start(); // Start output buffering

require '../../estilos/css_lte.ctp';

$sql = "SELECT sp_fichamedica(
    " . $_REQUEST['accion'] . ",
    " . $_SESSION['usu_cod'] . ",
    " . (!empty($_REQUEST['vcod_pacientes']) ? $_REQUEST['vcod_pacientes'] : "0") . ""
    . " ) as resul";

$resultado = consultas::get_datos($sql);

if ($resultado[0]['resul']!=null) {
    header("location:fichadetalle_add.php?vcod_ficha=".$resultado[0]['resul']);
} else {
    $_SESSION['mensaje'] = "Error: Resultados no encontrados";
    header("location:ficha_add.php");
}

ob_end_flush(); // Send the buffered output
?>