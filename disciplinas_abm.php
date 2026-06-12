<?php

include("conexion.php");

$sql = "SELECT * FROM disciplinas";
$resultado = mysqli_query($conexion,$sql);

?>

<!DOCTYPE html>
<html>
<head>
    <title>ABM Disciplinas</title>
</head>
<body>

<h1>ABM de Disciplinas</h1>

<form action="guardar.php" method="POST">
    
 <input type="hidden" name="tabla" value="disciplinas">

    <input type="text" name="nombre" placeholder="Nombre" required>

    <button type="submit">
        Guardar Profesor
    </button>

</form>

<br><br>

<table border="1">

<tr>
    <th>ID</th>
    <th>Nombre</th>
    <th>Apellido</th>
    <th>Teléfono</th>
    <th>Acciones</th>
</tr>

<?php while($fila = mysqli_fetch_assoc($resultado)){ ?>

<tr>

    <td><?php echo $fila['id_profesor']; ?></td>
    <td><?php echo $fila['nombre']; ?></td>
    <td><?php echo $fila['apellido']; ?></td>
    <td><?php echo $fila['telefono']; ?></td>

    <td>

        <a href="editar.php?id=<?php echo $fila['id_profesor']; ?>&tabla=profesores">
            Editar
        </a>

        |

        <a href="eliminar.php?id=<?php echo $fila['id_profesor']; ?>&tabla=profesores">
            Eliminar
        </a>

    </td>

</tr>

<?php } ?>

</table>

</body>
</html>