<?php
include("conexion.php");

$sql = "SELECT * FROM alumnos";
$resultado = mysqli_query($conexion,$sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registrar asistencia</title>
</head>
<body>

<h2>Registrar asistencia</h2>

<form action="guardar_asistencia.php" method="POST">

<?php while($alumno = mysqli_fetch_assoc($resultado)){ ?>

<p>
    <?php echo $alumno['nombre']; ?>

    <input type="checkbox"
           name="asistencia[]"
           value="<?php echo $alumno['id_alumno']; ?>">
</p>

<?php } ?>

<button type="submit">
Guardar asistencia
</button>

</form>

</body>
</html>