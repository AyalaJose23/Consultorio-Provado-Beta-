<?php
session_start();
include "../../conexion.php";

$sql = "SELECT sp_tratamiento(
         " . $_REQUEST['accion'] . ",
             " . $_REQUEST['vcod_trata'] . ",
         " . $_SESSION['usu_cod'] . ", 
         " . (!empty($_REQUEST['vcod_diag']) ? $_REQUEST['vcod_diag'] : "0") . ",
         " . (!empty($_REQUEST['cod_pacientes']) ? $_REQUEST['cod_pacientes']  : "0") . " ) as resul";

$resultado = consultas::get_datos($sql);

if ($resultado[0]['resul'] != null) {
    $valor = explode("*", $resultado[0]['resul']);
    $_SESSION['mensaje'] = $valor[0];
    $sql = "select COALESCE(max(cod_trata), 0) AS vcod_trata from v_tratamientos";
    $resultado = consultas::get_datos($sql);
    header("location:tratamientodetalle_add.php?vcod_trata=".$_REQUEST['vcod_trata']);
}else {
    $_SESSION['mensaje'] = "Error: Resultados no encontrados";
    header("location:tratamiento_index.php");
}
?>

