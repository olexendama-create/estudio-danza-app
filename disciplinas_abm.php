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

    <input type="text" name="nombre_disciplina" placeholder="Nombre Disciplina" required>

    <button type="submit">
        Guardar Disciplina
    </button>

</form>

<br><br>

<table border="1">

<tr>
    <th>ID</th>
    <th>Disciplina</th>
    <th>Acciones</th>
</tr>

<?php while($fila = mysqli_fetch_assoc($resultado)){ ?>

<tr>

    <td><?php echo $fila['id_disciplina']; ?></td>
    <td><?php echo $fila['nombre_disciplina']; ?></td>

    <td>

        <a href="editar.php?id=<?php echo $fila['id_disciplina']; ?>&tabla=disciplinas">
            Editar
        </a>

        |

        <a href="eliminar.php?id=<?php echo $fila['id_disciplina']; ?>&tabla=disciplinas">
            Eliminar
        </a>

    </td>

</tr>

<?php } ?>

</table>

</body>
</html>