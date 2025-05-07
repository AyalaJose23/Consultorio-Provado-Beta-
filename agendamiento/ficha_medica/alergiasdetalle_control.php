<?php
require 'clases/conexion.php';
session_start();

$sql = "SELECT sp_detallealergia(
         " . $_REQUEST['accion'] . ",
        " . (!empty($_REQUEST['vcod_ficha']) ? $_REQUEST['cod_ficha'] : "0") . ",  
         " . (!empty($_REQUEST['vcod_alergis']) ? $_REQUEST['cod_alergis'] : "0"). " ) as resul";

$resultado = consultas::get_datos($sql);

if ($resultado[0]['resul'] != null) {
        if($resultado[0]['resul'] == "EXISTE ALERGIA"){
            $_SESSION['mensaje'] = "LA ALERGIA YA EXISTE";
        header("location:fichadetalle_add.php?vcod_ficha=" . $_REQUEST['cod_ficha']);
        }else{
            $_SESSION['mensaje'] = "ALERGIA AGREGADO CORRECTAMENTE";
        header("location:fichadetalle_add.php?vcod_ficha=" . $_REQUEST['cod_ficha']);
        }
        
    } else {
        $_SESSION['mensaje'] = "Error: Resultados no encontrados";
        header("location:ficha_add.php");
    }
?>

