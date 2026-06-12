<?php

include("conexion.php");

$id = $_GET['id'];
$tabla = $_GET['tabla'];

if($tabla == "alumnos"){

$sql = "SELECT * FROM alumnos
        WHERE id_alumno='$id'";

$resultado = mysqli_query($conexion,$sql);

$alumno = mysqli_fetch_assoc($resultado);

?>

<!DOCTYPE html>
<html>
<head>
   <title>Editar alumno</title>
</head>
<body>

<h1>Editar Alumno</h1>

<form action="actualizar.php" method="POST">

 <input type="hidden" name="tabla" value="alumnos">

   <input type="hidden"
          name="id_alumno"
          value="<?php echo $alumno['id_alumno']; ?>">

     <input type="text"
          name="nombre"
          value="<?php echo $alumno['nombre']; ?>">

    <input type="text"
          name="apellido"
          value="<?php echo $alumno['apellido']; ?>">

    <input type="number"
          name="numero_documento"
          value="<?php echo $alumno['numero_documento']; ?>">
    
    <input type="number"
          name="telefono"
          value="<?php echo $alumno['telefono']; ?>">

    <input type="email"
          name="email"
          value="<?php echo $alumno['email']; ?>">

    <input type="date"
          name="fecha_nacimiento"
          value="<?php echo $alumno['fecha_nacimiento']; ?>">

    <input type="number"
          name="id_tipo_documento"
          value="<?php echo $alumno['id_tipo_documento']; ?>">

    <input type="text"
          name="password"
          value="<?php echo $alumno['password']; ?>">

    <input type="number"
          name="id_pack"
          value="<?php echo $alumno['id_pack']; ?>">

<button type="submit">
    Actualizar
</button>

</form>

</body>
</html>

<?php
}

if($tabla == "profesores"){

    $sql = "SELECT * FROM profesores
            WHERE id_profesor='$id'";

    $resultado = mysqli_query($conexion,$sql);

    $profesor = mysqli_fetch_assoc($resultado);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Editar Profesor</title>
</head>
<body>

<h1>Editar Profesor</h1>

<form action="actualizar.php" method="POST">

    <input type="hidden" name="tabla" value="profesores">

    <input type="hidden"
           name="id_profesor"
            value="<?php echo $profesor['id_profesor']; ?>">

    <input type="text"
           name="nombre"
           value="<?php echo $profesor['nombre']; ?>">

    <input type="text"
           name="apellido"
           value="<?php echo $profesor['apellido']; ?>">

    <input type="number"
           name="telefono"
           value="<?php echo $profesor['telefono']; ?>">

    <button type="submit">Actualizar</button>

</form>

</body>
</html>


<?php
}

if($tabla == "packs"){

    $sql = "SELECT * FROM packs
            WHERE id_pack='$id'";

    $resultado = mysqli_query($conexion,$sql);

    $pack = mysqli_fetch_assoc($resultado);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Editar Pack</title>
</head>
<body>

<h1>Editar Pack</h1>

<form action="actualizar.php" method="POST">

    <input type="hidden" name="tabla" value="packs">

    <input type="hidden"
           name="id_pack"
            value="<?php echo $pack['id_pack']; ?>">

    <input type="text"
           name="nombre_pack"
           value="<?php echo $pack['nombre_pack']; ?>">

    <input type="number"
           name="cantidad_clases"
           value="<?php echo $pack['cantidad_clases']; ?>">

    <input type="number"
           name="precio_actual"
           value="<?php echo $pack['precio_actual']; ?>">

    <button type="submit">Actualizar</button>

</form>

</body>
</html>


<?php
}

?>