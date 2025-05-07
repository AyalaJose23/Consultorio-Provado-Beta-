<?php
require '../../conexion.php';
session_start();
 /* $vid_articulo = $_REQUEST['vid_articulo'];
  $vmar_cod = $_REQUEST['vmar_cod'];
  $vart_descri = $_REQUEST['vart_descri'];
  $vpre_compra = $_REQUEST['vpre_compra'];
  $vart_imagen = $_REQUEST['vart_imagen'];
  $vart_iva = $_REQUEST['vart_iva'];
  $vcod_barra = $_REQUEST['vcod_barra'];
  $vpre_venta = $_REQUEST['vpre_venta'];
  $vcod_tipo = $_REQUEST['vcod_tipo'];
  $vcod_modelo = $_REQUEST['vcod_modelo'];
  $sql = "select sp_articulos( ". $_REQUEST['accion'] .", " .
        (!empty($vid_articulo) ? $vid_articulo : 0 ) . ", " .
        (!empty($vmar_cod) ? $vmar_cod : 0 )  .", '" .
        (!empty($vart_descri) ? $vart_descri : 0 )  ."', " .
        (!empty($vpre_compra) ? $vpre_compra : 0 )  .",'" .
        (!empty($vart_iva) ? $vart_iva : 0 )  ."', '" .
        (!empty($vcod_barra) ? $vcod_barra : 0 )  ."', " .
        (!empty($vpre_venta) ? $vpre_venta : 0 )  .", " .
        (!empty($vcod_tipo) ? $vcod_tipo : 0 )  .", " .
        (!empty($vcod_modelo) ? $vcod_modelo : 0 )  .") as result "; */

        
        
        $sql = "SELECT sp_personas( 
            " . intval($_REQUEST['accion']) . ", 
            " . intval($_REQUEST['vid_persona']) . ", '
            " . pg_escape_string(!empty($_REQUEST['vper_nombre']) ? $_REQUEST['vper_nombre'] : '') . "', '
            " . pg_escape_string(!empty($_REQUEST['vper_apellido']) ? $_REQUEST['vper_apellido'] : '') . "', '
            " . pg_escape_string(!empty($_REQUEST['vper_ci']) ? $_REQUEST['vper_ci'] : '') . "', '
            " . pg_escape_string(!empty($_REQUEST['vper_ruc']) ? $_REQUEST['vper_ruc'] : '') . "', '
            " . pg_escape_string(!empty($_REQUEST['vper_fnac']) ? $_REQUEST['vper_fnac'] : '') . "', '
            " . pg_escape_string(!empty($_REQUEST['vper_telefono']) ? $_REQUEST['vper_telefono'] : '') . "', '
            " . pg_escape_string(!empty($_REQUEST['vper_direccion']) ? $_REQUEST['vper_direccion'] : '') . "', '
            " . pg_escape_string(!empty($_REQUEST['vper_sexo']) ? $_REQUEST['vper_sexo'] : '') . "', 
            " . intval(!empty($_REQUEST['vid_ciudad']) ? $_REQUEST['vid_ciudad'] : 0) . ", 
            " . intval(!empty($_REQUEST['vid_nacion']) ? $_REQUEST['vid_nacion'] : 0) . " ) 
        as result"; 
        $resultado = consultas::get_datos($sql); 
        if ($resultado[0]['result'] != null) { 
            $_SESSION['mensaje'] = $resultado[0]['result'];
             header("location:personas_index.php"); 
        } else { 
            $_SESSION['mensaje'] = 'ERROR_/_Ocurrió un problema al procesar la solicitud'; 
            header("location:personas_add.php");
        }
?>
        


       

        