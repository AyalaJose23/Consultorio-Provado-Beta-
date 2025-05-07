<?php
include '../../conexion.php';

$doctores = consultas::get_datos("
    SELECT
        d.dia_descri,
        d.cod_dia,
        t.descrip_tur, 
        ad.hora_inicio, 
        ad.hora_fin,
        ad.cod_agenda,
        ad.cupos - (
            SELECT COUNT(c.cod_cita) FROM citas c WHERE c.cod_agenda = ad.cod_agenda  AND c.cod_dia = d.cod_dia  AND c.cita_fecha = '" . $_GET['fecha'] . "') AS cantidad
    FROM detalle_agenda ad 
    JOIN dias d ON d.cod_dia = ad.cod_dia
    JOIN turnos t ON t.cod_turnos = ad.cod_turnos
    JOIN agenda a ON a.cod_agenda = ad.cod_agenda
    WHERE ad.cod_doctor = " . $_GET['vcod_doctor'] . " 
    AND a.agen_estado = 'ACTIVO'
");

if (!empty($doctores)) { ?>            
    <option value="">FAVOR SELECCIONE EL DIA</option>        
    <?php
    foreach ($doctores as $doctor) {
        if (intval($doctor['cantidad']) > 0) {
            ?>
            <option value="<?php echo $doctor['cod_agenda'] ?>">
                <?= $doctor['dia_descri'] ?> | <?= $doctor['descrip_tur'] ?> <?= $doctor['hora_inicio'] ?> | <?= $doctor['hora_fin'] ?>  | CUPOS DISPONIBLES <?= $doctor['cantidad'] ?>
            </option>            
            <?php
        }
    }
} else {
    ?>
    <option value="">ESTA ESPECIALIDAD NO TIENE DOCTOR DISPONIBLE</option> 
<?php } ?>
