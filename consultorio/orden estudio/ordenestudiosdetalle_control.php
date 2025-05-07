
<?php
require  "../../conexion.php";
session_start();

$sql = "SELECT sp_ordenestudios_detalle(
         " . $_REQUEST['accion'] . ",
         " . (!empty($_REQUEST['vcod_estudios']) ? $_REQUEST['vcod_estudios'] : "0") . ",  
         " . (!empty($_REQUEST['vcod_t_estudio']) ? $_REQUEST['vcod_t_estudio'] : "0") . ",
         '" . (!empty($_REQUEST['vdescrip_estudio']) ? $_REQUEST['vdescrip_estudio']  : "0") . "' ) as resul";

$resultado = consultas::get_datos($sql);

if ($resultado[0]['resul']!=null) {
    $valor = explode("*", $resultado[0]['resul']);
    $_SESSION['mensaje']=$valor[0];
    header("location:ordenestudiosdetalle_add.php?vcod_estudios=".$_REQUEST['vcod_estudios']);
}else {
    $_SESSION['mensaje'] = "Error: Resultados no encontrados";
    header("location:ordenestudios_index.php");
}
?>

