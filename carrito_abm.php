<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

include("conexion.php");

/* Listamos los carritos con el nombre del alumno */
$sql = "SELECT
            carrito.id_carrito,
            carrito.id_alumno,
            carrito.fecha,
            carrito.estado,
            alumnos.nombre,
            alumnos.apellido
        FROM carrito
        INNER JOIN alumnos
        ON carrito.id_alumno = alumnos.id_alumno
        ORDER BY carrito.id_carrito DESC";

$resultado = mysqli_query($conexion, $sql);

if(!$resultado){
    die("Error al consultar carritos: " . mysqli_error($conexion));
}

/* Buscamos alumnos para el select */
$sql_alumnos = "SELECT id_alumno, nombre, apellido
                FROM alumnos
                ORDER BY nombre, apellido";

$resultado_alumnos = mysqli_query($conexion, $sql_alumnos);

if(!$resultado_alumnos){
    die("Error al consultar alumnos: " . mysqli_error($conexion));
}

?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <title>ABM Carrito</title>

</head>

<body>

<h1>ABM de Carritos</h1>

<form action="guardar.php" method="POST">

    <input type="hidden" name="tabla" value="carrito">

    <label>Alumno:</label>

    <select name="id_alumno" required>

        <option value="">Seleccione un alumno</option>

        <?php while($alumno = mysqli_fetch_assoc($resultado_alumnos)){ ?>

            <option value="<?php echo $alumno['id_alumno']; ?>">

                <?php
                echo htmlspecialchars(
                    $alumno['nombre'] . " " . $alumno['apellido']
                );
                ?>

            </option>

        <?php } ?>

    </select>

    <br><br>

    <label>Fecha:</label>

    <input
        type="datetime-local"
        name="fecha"
        value="<?php echo date('Y-m-d\TH:i'); ?>"
        required
    >

    <br><br>

    <label>Estado:</label>

    <select name="estado" required>

        <option value="">Seleccione un estado</option>
        <option value="pendiente">Pendiente</option>
        <option value="finalizado">Finalizado</option>

    </select>

    <br><br>

    <button type="submit">
        Guardar Carrito
    </button>

</form>

<br><br>

<table border="1" cellpadding="10">

    <tr>

        <th>ID</th>
        <th>Alumno</th>
        <th>Fecha</th>
        <th>Estado</th>
        <th>Acciones</th>

    </tr>

    <?php while($fila = mysqli_fetch_assoc($resultado)){ ?>

        <tr>

            <td>
                <?php echo $fila['id_carrito']; ?>
            </td>

            <td>
                <?php
                echo htmlspecialchars(
                    $fila['nombre'] . " " . $fila['apellido']
                );
                ?>
            </td>

            <td>
                <?php echo $fila['fecha']; ?>
            </td>

            <td>
                <?php echo htmlspecialchars($fila['estado']); ?>
            </td>

            <td>

                <a href="editar.php?id=<?php echo $fila['id_carrito']; ?>&tabla=carrito">
                    Editar
                </a>

                |

                <a
                    href="eliminar.php?id=<?php echo $fila['id_carrito']; ?>&tabla=carrito"
                    onclick="return confirm('¿Seguro que desea eliminar este carrito y sus detalles?');"
                >
                    Eliminar
                </a>

            </td>

        </tr>

    <?php } ?>

</table>

</body>

</html>