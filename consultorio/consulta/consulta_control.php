<?php

require '../../conexion.php';
session_start();

$sql = "SELECT sp_consulta(
         " . $_REQUEST['accion'] . ",
         " . $_REQUEST['vcod_consulta'] . ",
         " . $_SESSION['usu_cod'] . ", 
         " . (!empty($_REQUEST['vcod_precon']) ? $_REQUEST['vcod_precon'] : "0") . ",
         " . (!empty($_REQUEST['cod_pacientes']) ? $_REQUEST['cod_pacientes'] : "0") . ",
         " . (!empty($_REQUEST['vcons_precio']) ? $_REQUEST['vcons_precio'] : "0") . ",
         '" . (!empty($_REQUEST['vcon_motivo']) ? $_REQUEST['vcon_motivo'] : "") . "',
         " . (!empty($_REQUEST['vtipcon_cod']) ? $_REQUEST['vtipcon_cod'] : "0") . " ) as resul";
$resultado = consultas::get_datos($sql);

if ($resultado[0]['resul'] != null) {
    $valor = explode("*", $resultado[0]['resul']);
    $_SESSION['mensaje'] = $valor[0];
    $sql = "select COALESCE(max(cod_consulta), 0) AS id from v_consulta";
    $resultado = consultas::get_datos($sql);
    header("location:consultadetalle_add.php?vcod_consulta=" . $resultado[0]['id']);
} else {
    $_SESSION['mensaje'] = "Error: Resultados no encontrados";
    header("location:consultas_index.php");
}
?>
