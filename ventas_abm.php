<?php

include("conexion.php");

$sql = "SELECT ventas.*, alumnos.nombre, alumnos.apellido
FROM ventas
INNER JOIN alumnos
ON ventas.id_alumno = alumnos.id_alumno";

$resultado = mysqli_query($conexion,$sql);

$sql2 = "SELECT * FROM alumnos";
$alumnos = mysqli_query($conexion,$sql2);

?>

<!DOCTYPE html>
<html>
<head>
<title>ABM Ventas</title>
</head>

<body>

<h1>ABM de Ventas</h1>

<form action="guardar.php" method="POST">

<input type="hidden" name="tabla" value="ventas">

<select name="id_alumno" required>

<?php while($a=mysqli_fetch_assoc($alumnos)){ ?>

<option value="<?php echo $a['id_alumno']; ?>">

<?php echo $a['nombre']." ".$a['apellido']; ?>

</option>

<?php } ?>

</select>

<input type="datetime-local"
name="fecha_venta"
required>

<input type="text"
name="metodo_pago"
placeholder="Método de pago"
required>

<button type="submit">

Guardar Venta

</button>

</form>

<br><br>

<table border="1">

<tr>

<th>ID</th>
<th>Alumno</th>
<th>Fecha</th>
<th>Método</th>
<th>Acciones</th>

</tr>

<?php while($fila=mysqli_fetch_assoc($resultado)){ ?>

<tr>

<td><?php echo $fila['id_venta']; ?></td>

<td>

<?php

echo $fila['nombre']." ".$fila['apellido'];

?>

</td>

<td><?php echo $fila['fecha_venta']; ?></td>

<td><?php echo $fila['metodo_pago']; ?></td>

<td>

<a href="editar.php?id=<?php echo $fila['id_venta']; ?>&tabla=ventas">

Editar

</a>

<a href="eliminar.php?id=<?php echo $fila['id_venta']; ?>&tabla=ventas">

Eliminar

</a>

</td>

</tr>

<?php } ?>

</table>

</body>

</html>

   