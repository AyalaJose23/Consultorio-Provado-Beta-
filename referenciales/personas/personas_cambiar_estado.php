<?php
session_start();
include "../../conexion.php";

$vid_persona = intval($_REQUEST['vid_persona']);
$nuevo_estado = $_REQUEST['estado'];

$sql = "UPDATE persona SET per_estado = '$nuevo_estado' WHERE id_persona = $vid_persona";
$resultado = consultas::get_datos($sql);

if ($resultado) {
    $_SESSION['mensaje'] = 'ERROR_/_No se pudo cambiar el estado del registro';
} else {
    $_SESSION['mensaje'] = 'NOTICIA_/_Cambio de estado exitoso'; 
}

header("location:personas_index.php");
?>
