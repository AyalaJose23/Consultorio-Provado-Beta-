<?php
require './conexion.php';

$sql = "select * from v_usuarios where usu_nick = '" . $_REQUEST['usuario'] . 
        "' and usu_clave = md5('" . $_REQUEST['pass'] . "')";
 $resultado = consultas::get_datos($sql);
 session_start();

 if ($resultado[0]['usu_cod'] == null) {
     $_SESSION['error'] = 'usuario o clave incorrecta';
     header('location:index.php');
    
} else {
    $_SESSION['usu_cod'] = $resultado[0]['usu_cod'];
    $_SESSION['usu_nick'] = $resultado[0]['usu_nick'];
    $_SESSION['id_empleado'] = $resultado[0]['id_empleado'];
    $_SESSION['per_nombre'] = $resultado[0]['per_nombre'];
    $_SESSION['per_apellido'] = $resultado[0]['per_apellido'];
    $_SESSION['id_cargo'] = $resultado[0]['id_cargo'];
    $_SESSION['car_descri'] = $resultado[0]['car_descri'];
    $_SESSION['gru_cod'] = $resultado[0]['gru_cod'];
    $_SESSION['usu_imagen'] = $resultado[0]['usu_imagen'];
    $_SESSION['nombres'] = $resultado[0]['nombres'];
    header('location:menu.php');
}
 
?>