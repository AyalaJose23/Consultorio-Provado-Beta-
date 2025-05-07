<?php
require 'clases/conexion.php';
session_start();
$sql = "SELECT sp_fichadetalle(
         " . $_REQUEST['accion'] . ",
        " . (!empty($_REQUEST['cod_ficha']) ? $_REQUEST['cod_ficha'] : "0") . ",  
             '" . (!empty($_REQUEST['vantecedentes_enfer']) ? $_REQUEST['vantecedentes_enfer'] : "0") . "',
                  '" . (!empty($_REQUEST['vcirugias']) ? $_REQUEST['vcirugias'] : "0") . "',
         '" . (!empty($_REQUEST['vobservacion']) ? $_REQUEST['vobservacion'] : "0"). "' ) as resul";

$resultado = consultas::get_datos($sql);

if ($resultado[0]['resul'] != null) {
        if($resultado[0]['resul'] == "EXISTE PATOLOGIA"){
            $_SESSION['mensaje'] = "DETALLES DE FICHA AGREGADO";
        header("location:fichadetalle_add.php?vcod_ficha=" . $_REQUEST['cod_ficha']);
        }
        
    } else {
        $_SESSION['mensaje'] = "Error: Resultados no encontrados";
        header("location:ficha_add.php");
    }
?>