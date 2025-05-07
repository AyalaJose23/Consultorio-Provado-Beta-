<?php
include '../../conexion.php';
?>

<?php
$doctores = consultas::get_datos("SELECT
  de.cod_doctor,
  p.per_nombre,
  p.per_apellido
FROM
  detalle_agenda de
JOIN
  doctor d ON d.cod_doctor = de.cod_doctor
JOIN
  persona p ON p.id_persona = d.id_persona
JOIN
  especialidad tu ON de.cod_especialidad = tu.cod_especialidad
WHERE
  tu.cod_especialidad =" . $_GET['vcod_especialidad'] . " "
                . "GROUP BY de.cod_doctor,  p.per_nombre,  p.per_apellido");
?>
<?php if (!empty($doctores)) { ?>            
    <option value="">FAVOR SELECCIONE EL DOCTOR</option>        
    <?php
    foreach ($doctores as $doctor) {
        ?>
        <option value="<?php echo $doctor['cod_doctor'] ?>"> <?= $doctor['per_nombre'] ?> <?= $doctor['per_apellido'] ?></option>            
        <?php
    }
} else {
    ?>
    <option value="">ESTA ESPECIALIDAD NO TIENE DOCTOR DISPONIBLE</option> 
<?php } ?>        

