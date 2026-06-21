<?php

include("conexion.php");

$sql = "SELECT * FROM materiales";
$resultado = mysqli_query($conexion,$sql);

?>

<!DOCTYPE html>
<html>
<head>
    <title>ABM Materiales</title>
</head>
<body>

<h1>ABM Materiales</h1>

<form action="guardar.php" method="POST">

<input type="hidden" name="tabla" value="materiales">

<input type="number" name="id_clase" placeholder="ID Clase">

<input type="text" name="titulo" placeholder="Título">

<input type="text" name="descripcion" placeholder="Descripción">

<input type="text" name="archivo" placeholder="Ruta archivo">

<input type="date" name="fecha_subida">

<button type="submit">
Guardar Material
</button>

</form>

<br><br>

<table border="1">

<tr>
<th>ID</th>
<th>Clase</th>
<th>Título</th>
<th>Descripción</th>
<th>Archivo</th>
<th>Fecha</th>
<th>Acciones</th>
</tr>

<?php while($fila=mysqli_fetch_assoc($resultado)){ ?>

<tr>

<td><?php echo $fila['id_material']; ?></td>
<td><?php echo $fila['id_clase']; ?></td>
<td><?php echo $fila['titulo']; ?></td>
<td><?php echo $fila['descripcion']; ?></td>
<td><?php echo $fila['archivo']; ?></td>
<td><?php echo $fila['fecha_subida']; ?></td>

<td>

<a href="editar.php?id=<?php echo $fila['id_material']; ?>&tabla=materiales">
Editar
</a>

<a href="eliminar.php?id=<?php echo $fila['id_material']; ?>&tabla=materiales">
Eliminar
</a>

</td>

</tr>

<?php } ?>

</table>

</body>
</html