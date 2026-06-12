<?php 

include("conexion.php");

$sql = "SELECT * FROM alumnos";
$resultado = mysqli_query($conexion,$sql);

?> 

<!DOCTYPE html>
<html>
<head>
   <title>ABM Alumnos</title>
</head>
<body>

<h1>ABM de Alumnos</h1>

<form action="guardar.php" method="POST">

<input type="hidden" name="tabla" value="alumnos">

    <input type="text" name="nombre" placeholder="Nombre" required>
    <input type="text" name="apellido" placeholder="Apellido">
    <input type="number" name="numero_documento" placeholder="Documento">
    <input type="number" name="telefono" placeholder="Telefono">
    <input type="email" name="email" placeholder="Email">
    <input type="date" name="fecha_nacimiento">
    <input type="number" name="id_tipo_documento" placeholder="Tipo documento">
    <input type="password" name="password" placeholder="Contraseña">


    <button type="submit">
        Guardar Alumno
    </button>

</form>

<br><br>

<table border="1">
<tr>
    <th>ID</th>
    <th>Nombre</th>
    <th>Apellido</th>
    <th>Documento</th>
    <th>Telefono</th>
    <th>Email</th>
    <th>Fecha de Nacimiento</th>
    <th>Tipo Doc</th>
</tr>

<?php while($fila = mysqli_fetch_assoc($resultado)){ ?>

<TR>
    <td><?php echo $fila['id_alumno']; ?></td>
    <td><?php echo $fila['nombre']; ?></td>
    <td><?php echo $fila['apellido']; ?></td>
    <td><?php echo $fila['numero_documento']; ?></td>
    <td><?php echo $fila['telefono']; ?></td>
    <td><?php echo $fila['email']; ?></td>
    <td><?php echo $fila['fecha_nacimiento']; ?></td>
    <td><?php echo $fila['id_tipo_documento']; ?></td>


    <td>
        <a href="editar.php?id=<?php echo $fila['id_alumno']; ?>&tabla=alumnos">
            Editar
        </a>

        <a href="eliminar.php?id=<?php echo $fila['id_alumno']; ?>&tabla=alumnos">
            Eliminar
        </a>

    </td>
</TR>

<?php  } ?>

</table>

</body>
</html>