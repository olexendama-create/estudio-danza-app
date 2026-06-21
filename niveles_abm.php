<?php

include("conexion.php");

$sql = "SELECT * FROM niveles";
$resultado = mysqli_query($conexion,$sql);

?>

<!DOCTYPE html>
<html>
<head>
<title>ABM Niveles</title>
</head>
<body>

<h1>ABM de Niveles</h1>

<form action="guardar.php" method="POST">

<input type="hidden" name="tabla" value="niveles">

<input type="text"
       name="nombre_nivel"
       placeholder="Nombre nivel"
       required>

<button type="submit">
Guardar Nivel
</button>

</form>

<br><br>

<table border="1">

<tr>
    <th>ID</th>
    <th>Nombre Nivel</th>
    <th>Acciones</th>
</tr>

<?php while($fila=mysqli_fetch_assoc($resultado)){ ?>

<tr>

<td><?php echo $fila['id_nivel']; ?></td>

<td><?php echo $fila['nombre_nivel']; ?></td>

<td>

<a href="editar.php?id=<?php echo $fila['id_nivel']; ?>&tabla=niveles">
Editar
</a>

<a href="eliminar.php?id=<?php echo $fila['id_nivel']; ?>&tabla=niveles">
Eliminar
</a>

</td>

</tr>

<?php } ?>

</table>

</body>
</html>