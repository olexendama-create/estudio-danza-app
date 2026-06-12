<?php

include("conexion.php");

$sql = "SELECT * FROM packs";
$resultado = mysqli_query($conexion,$sql);

?>

<!DOCTYPE html>
<html>
<head>
    <title>ABM Packs</title>
</head>
<body>

<h1>ABM de Packs</h1>

<form action="guardar.php" method="POST">

    <input type="hidden" name="tabla" value="packs">

    <input type="text" name="nombre_pack" placeholder="Nombre" required>

    <input type="text" name="cantidad_clases" placeholder="Cantidad de clases" required>

    <input type="number" name="precio_actual" placeholder="Precio">

    <button type="submit">
        Guardar Pack
    </button>

</form>

<br><br>

<table border="1">

<tr>
    <th>ID</th>
    <th>Nombre</th>
    <th>Cantidad de clases</th>
    <th>Precio</th>
    <th>Acciones</th>
</tr>

<?php while($fila = mysqli_fetch_assoc($resultado)){ ?>

<tr>

    <td><?php echo $fila['id_pack']; ?></td>
    <td><?php echo $fila['nombre_pack']; ?></td>
    <td><?php echo $fila['cantidad_clases']; ?></td>
    <td><?php echo $fila['precio_actual']; ?></td>

     <td>

        <a href="editar.php?id=<?php echo $fila['id_pack']; ?>&tabla=packs">
            Editar
        </a>

        |

        <a href="eliminar.php?id=<?php echo $fila['id_pack']; ?>&tabla=packs">
            Eliminar
        </a>

    </td>

    </tr>

<?php } ?>

</table>

</body>
</html>