<?php

include("conexion.php");

$sql="SELECT * FROM productos";
$resultado=mysqli_query($conexion,$sql);

?>

<h1>ABM Productos</h1>

<form action="guardar.php" method="POST">

<input type="hidden" name="tabla" value="productos">

Nombre:
<input type="text" name="nombre_producto">

<br><br>

Descripción:
<input type="text" name="descripcion">

<br><br>

Stock:
<input type="number" name="stock">

<br><br>

Imagen:
<input type="text" name="imagen">

<br><br>

Precio:
<input type="number" name="precio">

<br><br>

<button type="submit">Guardar</button>

</form>

<hr>

<table border="1">

<tr>
<th>ID</th>
<th>Nombre</th>
<th>Stock</th>
<th>Precio</th>
<th>Editar</th>
<th>Eliminar</th>
</tr>

<?php while($fila=mysqli_fetch_assoc($resultado)){ ?>

<tr>

<td><?php echo $fila['id_producto']; ?></td>
<td><?php echo $fila['nombre_producto']; ?></td>
<td><?php echo $fila['stock']; ?></td>
<td><?php echo $fila['precio']; ?></td>

<td>
<a href="editar.php?tabla=productos&id=<?php echo $fila['id_producto']; ?>">
Editar
</a>
</td>

<td>
<a href="eliminar.php?tabla=productos&id=<?php echo $fila['id_producto']; ?>">
Eliminar
</a>
</td>

</tr>

<?php } ?>

</table>