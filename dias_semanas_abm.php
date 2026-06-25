<?php

include("conexion.php");

$sql="SELECT * FROM dias_semanas";
$resultado=mysqli_query($conexion,$sql);

?>

<h1>ABM Días de la Semana</h1>

<form action="guardar.php" method="POST">

<input type="hidden" name="tabla" value="dias_semanas">

<input type="text" name="nombre_dia" placeholder="Nombre día">

<button type="submit">
Guardar
</button>

</form>

<hr>

<table border="1">

<tr>
    <th>ID</th>
    <th>Día</th>
    <th>Editar</th>
    <th>Eliminar</th>
</tr>

<?php while($fila=mysqli_fetch_assoc($resultado)){ ?>

<tr>

<td><?php echo $fila['id_dia']; ?></td>

<td><?php echo $fila['nombre_dia']; ?></td>

<td>
<a href="editar.php?tabla=dias_semanas&id=<?php echo $fila['id_dia']; ?>">
Editar
</a>
</td>

<td>
<a href="eliminar.php?tabla=dias_semanas&id=<?php echo $fila['id_dia']; ?>">
Eliminar
</a>
</td>

</tr>

<?php } ?>

</table>