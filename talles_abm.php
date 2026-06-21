<?php

include("conexion.php");

$sql = "SELECT * FROM talles";
$resultado = mysqli_query($conexion,$sql);

?>

<!DOCTYPE html>
<html>
<head>
<title>ABM Talles</title>
</head>
<body>

<h1>ABM de Talles</h1>

<form action="guardar.php" method="POST">

<input type="hidden" name="tabla" value="talles">

<input type="text"
       name="nombre_talle"
       placeholder="Nombre talle"
       required>

<button type="submit">
Guardar Talle
</button>

</form>

<br><br>

<table border="1">

<tr>
    <th>ID</th>
    <th>Nombre Talle</th>
    <th>Acciones</th>
</tr>

<?php while($fila=mysqli_fetch_assoc($resultado)){ ?>

<tr>

<td><?php echo $fila['id_talle']; ?></td>

<td><?php echo $fila['nombre_talle']; ?></td>

<td>

<a href="editar.php?id=<?php echo $fila['id_talle']; ?>&tabla=talles">
Editar
</a>

<a href="eliminar.php?id=<?php echo $fila['id_talle']; ?>&tabla=talles">
Eliminar
</a>

</td>

</tr>

<?php } ?>

</table>

</body>
</html>