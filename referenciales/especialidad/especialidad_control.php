<?php
require '../../conexion.php';
session_start();
$sql="SELECT public.sp_especialidad(
    " . $_REQUEST['accion'] .",
    " . $_REQUEST['vcod_especialidad'] .",
    '" . $_REQUEST['vdescrip_espec'] ."'
) as result;";
$resultado = consultas::get_datos($sql);
if ($resultado[0]['result']!=null) {
    $_SESSION['mensaje'] = $resultado[0]['result'];
    header("location:especialidad_index.php");
} else {
    $_SESSION['mensaje'] = $resultado[0]['result'];
}
?>