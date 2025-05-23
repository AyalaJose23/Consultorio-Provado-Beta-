<?php
include '../../conexion.php';
session_start();

$accion = intval($_REQUEST['accion']); // Conversión a entero
$vcod_agenda = (isset($_REQUEST['vcod_agenda']) && intval($_REQUEST['vcod_agenda']) > 0) ? intval($_REQUEST['vcod_agenda']) : 'NULL'; // Si no se proporciona, se usa NULL para nuevos registros.
$usu_cod = intval($_SESSION['usu_cod']); // Conversión a entero
$vagen_fecha = isset($_REQUEST['vagen_fecha']) ? $_REQUEST['vagen_fecha'] : ''; 
$vfecha_inicio = isset($_REQUEST['vfecha_inicio']) ? $_REQUEST['vfecha_inicio'] : ''; 
$vfecha_fin = isset($_REQUEST['vfecha_fin']) ? $_REQUEST['vfecha_fin'] : ''; 

// Generación de la consulta SQL
$sql = "SELECT sp_agenda(
    $accion, $vcod_agenda, $usu_cod, 
    '$vagen_fecha', '$vfecha_inicio', '$vfecha_fin'
) AS resul";

// Ejecución de la consulta
$resultado = consultas::get_datos($sql);

if ($resultado[0]['resul'] != null) {
    $valor = explode("*", $resultado[0]['resul']);
    $_SESSION['mensaje'] = $valor[0];
    if (count($valor) > 1) {
        $nuevo_agen_cod = $valor[1];
        header("location:agendadetalle_add.php?vcod_agenda=".$nuevo_agen_cod);
    } else {
        header("location:agenda_index.php");
    }
} else {
    $_SESSION['mensaje'] = "Error al procesar la agenda.";
    header("location:agenda_index.php");
}
?>
