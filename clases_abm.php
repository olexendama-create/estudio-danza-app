<?php

include("conexion.php");

$sql = "SELECT * FROM clases";
$resultado = mysqli_query($conexion,$sql);

?>

<!DOCTYPE html>
<html>
<head>
    <title>ABM Clases</title>
</head>
<body>

<h1>ABM de Clases</h1>

<form action="guardar.php" method="POST">

<input type="hidden" name="tabla" value="clases">

<input type="number" name="id_profesor" placeholder="ID Profesor">

<input type="number" name="id_disciplina" placeholder="ID Disciplina">

<input type="time" name="horario">

<input type="number" name="cupo_maximo" placeholder="Cupo Máximo">

<input type="number" name="id_dia" placeholder="ID Día">

<input type="number" name="id_nivel" placeholder="ID Nivel">

<button type="submit">
Guardar Clase
</button>

</form>

<br><br>

<table border="1">

<tr>
<th>ID</th>
<th>Profesor</th>
<th>Disciplina</th>
<th>Horario</th>
<th>Cupo</th>
<th>Día</th>
<th>Nivel</th>
<th>Acciones</th>
</tr>

<?php while($fila = mysqli_fetch_assoc($resultado)){ ?>

<tr>

<td><?php echo $fila['id_clase']; ?></td>
<td><?php echo $fila['id_profesor']; ?></td>
<td><?php echo $fila['id_disciplina']; ?></td>
<td><?php echo $fila['horario']; ?></td>
<td><?php echo $fila['cupo_maximo']; ?></td>
<td><?php echo $fila['id_dia']; ?></td>
<td><?php echo $fila['id_nivel']; ?></td>

<td>

<a href="editar.php?id=<?php echo $fila['id_clase']; ?>&tabla=clases">
Editar
</a>

<a href="eliminar.php?id=<?php echo $fila['id_clase']; ?>&tabla=clases">
Eliminar
</a>

</td>

</tr>

<?php } ?>

</table>

</body>
</html>