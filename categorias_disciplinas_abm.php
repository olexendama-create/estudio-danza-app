<?php

include("conexion.php");

$sql="SELECT * FROM categorias_disciplinas";
$resultado=mysqli_query($conexion,$sql);

?>

<h1>ABM Categorías Disciplinas</h1>

<form action="guardar.php" method="POST">

<input type="hidden" name="tabla" value="categorias_disciplinas">

Nombre:
<input type="text" name="nombrecategoria">

<br><br>

Imagen:
<input type="text" name="imagen_url">

<br><br>

Descripción:
<input type="text" name="descripcion">

<br><br>

<button type="submit">Guardar</button>

</form>

<hr>

<table border="1">

<tr>
<th>ID</th>
<th>Nombre</th>
<th>Editar</th>
<th>Eliminar</th>
</tr>

<?php while($fila=mysqli_fetch_assoc($resultado)){ ?>

<tr>

<td><?php echo $fila['idcategorias_disciplinas']; ?></td>
<td><?php echo $fila['nombrecategoria']; ?></td>

<td>
<a href="editar.php?tabla=categorias_disciplinas&id=<?php echo $fila['idcategorias_disciplinas']; ?>">
Editar
</a>
</td>

<td>
<a href="eliminar.php?tabla=categorias_disciplinas&id=<?php echo $fila['idcategorias_disciplinas']; ?>">
Eliminar
</a>
</td>

</tr>

<?php } ?>

</table>