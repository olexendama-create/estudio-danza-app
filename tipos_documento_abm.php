<?php
include("conexion.php");

$sql="SELECT * FROM tipos_documento";
$resultado=mysqli_query($conexion,$sql);
?>

<h1>ABM Tipos de Documento</h1>

<form action="guardar.php" method="POST">

<input type="hidden" name="tabla" value="tipos_documento">

Nombre:
<input type="text" name="nombre_documento">

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

<?php
while($fila=mysqli_fetch_assoc($resultado)){
?>

<tr>

<td><?php echo $fila['id_tipo_documento']; ?></td>

<td><?php echo $fila['nombre_documento']; ?></td>

<td>
<a href="editar.php?tabla=tipos_documento&id=<?php echo $fila['id_tipo_documento']; ?>">
Editar
</a>
</td>

<td>
<a href="eliminar.php?tabla=tipos_documento&id=<?php echo $fila['id_tipo_documento']; ?>">
Eliminar
</a>
</td>

</tr>

<?php
}
?>

</table>