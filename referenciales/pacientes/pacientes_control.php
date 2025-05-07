<?php
require '../../conexion.php';
session_start();
// Verificamos que se hayan recibido los parámetros necesarios
if (isset($_REQUEST['accion'], $_REQUEST['vcod_pacientes'], $_REQUEST['vid_persona'])) {
    // Obtén los valores de los parámetros
    $ban = (int)$_REQUEST['accion'];
    $vcod_pacientes = (int)$_REQUEST['vcod_pacientes'];
    $vid_persona = (int)$_REQUEST['vid_persona'];

    // Sanitización de Datos
    $ban = filter_var($ban, FILTER_SANITIZE_NUMBER_INT);
    $vcod_pacientes = filter_var($vcod_pacientes, FILTER_SANITIZE_NUMBER_INT);
    $vid_persona = filter_var($vid_persona, FILTER_SANITIZE_NUMBER_INT);

    // Validación de Parámetros
    if ($ban !== false && $vcod_pacientes !== false && $vid_persona !== false) {
        // Preparamos la consulta SQL para llamar a la función sp_doctor
        $sql = "SELECT sp_pacientes($ban, $vcod_pacientes, $vid_persona, 'ACTIVO') as resul";

        // Iniciamos la sesión
        session_start();

        try {
            // Ejecutamos la consulta
            $resultado = consultas::get_datos($sql);

            if (!empty($resultado) && isset($resultado[0]['resul'])) {
                $_SESSION['mensaje'] = $resultado[0]['resul'];
            } else {
                $_SESSION['mensaje'] = 'Error al activar el doctor.';
            }
        } catch (Exception $e) {
            // Manejo de errores
            $_SESSION['mensaje'] = 'Error en la consulta: ' . $e->getMessage();
        }

        // Cerramos la sesión después de configurar el mensaje
        session_write_close();

        // Redirigimos de nuevo a la página doctor_index.php
        header("Location: pacientes_index.php");
        exit();
    } else {
        // Manejar el caso en el que los parámetros no son válidos
        $_SESSION['mensaje'] = 'Parámetros no válidos.';
    }
} else {
    // Si no se proporcionaron todos los parámetros necesarios, mostrar un mensaje de error
    $_SESSION['mensaje'] = 'Doctor registrado exitosamente';
    header("Location: pacientes_index.php");
    exit();
}
?>
