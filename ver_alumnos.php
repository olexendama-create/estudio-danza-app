<?php

include("conexion.php");

$sql = "SELECT * FROM alumnos";
$resultado = mysqli_query($conexion,$sql);

?>

<!DOCTYPE html>
<html>
<head>
<title>Alumnos</title>
</head>
<body>

<h2>Listado de alumnos</h2>

<table border="1">

<tr>
    <th>Nombre</th>
    <th>Apellido</th>
    <th>DNI</th>
    <th>Teléfono</th>
    <th>Email</th>
</tr>

<?php while($fila = mysqli_fetch_assoc($resultado)){ ?>

<tr>
    <td><?php echo $fila['nombre']; ?></td>
    <td><?php echo $fila['apellido']; ?></td>
    <td><?php echo $fila['numero_documento']; ?></td>
    <td><?php echo $fila['telefono']; ?></td>
    <td><?php echo $fila['email']; ?></td>
</tr>

<?php } ?>

</table>

</body>
</html>