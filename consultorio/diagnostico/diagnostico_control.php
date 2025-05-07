<?php
session_start();
include "../../conexion.php";

$sql = "SELECT sp_diagnostico(
         " . $_REQUEST['accion'] . ",
         " . $_REQUEST['vcod_diag'] . ",
         " . $_SESSION['usu_cod'] . ",  
         " . (!empty($_REQUEST['vcod_pacientes']) ? $_REQUEST['vcod_pacientes'] : "0") . ",
         " . (!empty($_REQUEST['vcod_estudios']) ? $_REQUEST['vcod_estudios'] : "0") . ",
         " . (!empty($_REQUEST['vcod_analisis']) ? $_REQUEST['vcod_analisis'] : "0")
         . " ) as resul";

$resultado = consultas::get_datos($sql);

if ($resultado[0]['resul'] != null) {
    $valor = explode("*", $resultado[0]['resul']);
    $_SESSION['mensaje'] = $valor[0];
    $sql = "select COALESCE(max(cod_diag), 0) AS vcod_diag from v_diagnostico";
    $resultado = consultas::get_datos($sql);
    header("location:diagnosticodetalle_add.php?vcod_diag=".$_REQUEST['vcod_diag']);
}else {
    $_SESSION['mensaje'] = "Error: Resultados no encontrados";
    header("location:diagnostico_index.php");
}
?>

