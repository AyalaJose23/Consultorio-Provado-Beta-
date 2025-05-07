<?php
session_start();
include "../../conexion.php";

$sql = "SELECT sp_diagnostico_detalle(
         " . $_REQUEST['accion'] . ",
         " . (!empty($_REQUEST['vcod_diag']) ? $_REQUEST['vcod_diag'] : "0") . ",  
         " . (!empty($_REQUEST['venfe_cod']) ? $_REQUEST['venfe_cod'] : "0") . ",
         '" . (!empty($_REQUEST['vdetalle_descri']) ? $_REQUEST['vdetalle_descri']  : "0") . "' ) as resul";

$resultado = consultas::get_datos($sql);

if ($resultado[0]['resul']!=null) {
    $valor = explode("*", $resultado[0]['resul']);
    $_SESSION['mensaje']=$valor[0];
    header("location:diagnosticodetalle_add.php?vcod_diag=".$_REQUEST['vcod_diag']);
}else {
    $_SESSION['mensaje'] = "Error: Resultados no encontrados";
    header("location:diagnostico_index.php");
}
?>

