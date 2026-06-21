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

if($tabla=="disciplinas"){

$sql = "SELECT * FROM disciplinas
        WHERE id_disciplina='$id'";

$resultado = mysqli_query($conexion,$sql);

$disciplina = mysqli_fetch_assoc($resultado);

?>

<!DOCTYPE html>
<html>
<head>
<title>Editar Disciplina</title>
</head>
<body>

<h1>Editar Disciplina</h1>

<form action="actualizar.php" method="POST">

<input type="hidden" name="tabla" value="disciplinas">

<input type="hidden"
       name="id_disciplina"
       value="<?php echo $disciplina['id_disciplina']; ?>">

<input type="text"
       name="nombre_disciplina"
       value="<?php echo $disciplina['nombre_disciplina']; ?>">

<button type="submit">
Actualizar
</button>

</form>

</body>
</html>

<?php
}

if($tabla=="niveles"){

$sql = "SELECT * FROM niveles
        WHERE id_nivel='$id'";

$resultado = mysqli_query($conexion,$sql);

$nivel = mysqli_fetch_assoc($resultado);

?>

<!DOCTYPE html>
<html>
<head>
<title>Editar Nivel</title>
</head>
<body>

<h1>Editar Nivel</h1>

<form action="actualizar.php" method="POST">

<input type="hidden" name="tabla" value="niveles">

<input type="hidden"
       name="id_nivel"
       value="<?php echo $nivel['id_nivel']; ?>">

<input type="text"
       name="nombre_nivel"
       value="<?php echo $nivel['nombre_nivel']; ?>">

<button type="submit">
Actualizar
</button>

</form>

</body>
</html>

<?php
}

if($tabla=="talles"){

$sql = "SELECT * FROM talles
        WHERE id_talle='$id'";

$resultado = mysqli_query($conexion,$sql);

$talle = mysqli_fetch_assoc($resultado);

?>

<!DOCTYPE html>
<html>
<head>
<title>Editar Talle</title>
</head>
<body>

<h1>Editar Talle</h1>

<form action="actualizar.php" method="POST">

<input type="hidden" name="tabla" value="talles">

<input type="hidden"
       name="id_talle"
       value="<?php echo $talle['id_talle']; ?>">

<input type="text"
       name="nombre_talle"
       value="<?php echo $talle['nombre_talle']; ?>">

<button type="submit">
Actualizar
</button>

</form>

</body>
</html>

<?php
}

if($tabla=="materiales"){

$sql="SELECT * FROM materiales
WHERE id_material='$id'";

$resultado=mysqli_query($conexion,$sql);

$material=mysqli_fetch_assoc($resultado);

?>
<h1>Editar Material</h1>

<form action="actualizar.php" method="POST">

<input type="hidden" name="tabla" value="materiales">

<input type="hidden"
name="id_material"
value="<?php echo $material['id_material']; ?>">

<input type="number"
name="id_clase"
value="<?php echo $material['id_clase']; ?>">

<input type="text"
name="titulo"
value="<?php echo $material['titulo']; ?>">

<input type="text"
name="descripcion"
value="<?php echo $material['descripcion']; ?>">

<input type="text"
name="archivo"
value="<?php echo $material['archivo']; ?>">

<input type="date"
name="fecha_subida"
value="<?php echo $material['fecha_subida']; ?>">

<button type="submit">
Actualizar
</button>

</form>

<?php
}


if($tabla=="clases"){

$sql="SELECT * FROM clases
WHERE id_clase='$id'";

$resultado=mysqli_query($conexion,$sql);

$clase=mysqli_fetch_assoc($resultado);

?>

<!DOCTYPE html>
<html>
<head>
<title>Editar Clase</title>
</head>
<body>

<h1>Editar Clase</h1>

<form action="actualizar.php" method="POST">

<input type="hidden" name="tabla" value="clases">

<input type="hidden"
name="id_clase"
value="<?php echo $clase['id_clase']; ?>">

<input type="number"
name="id_profesor"
value="<?php echo $clase['id_profesor']; ?>">

<input type="number"
name="id_disciplina"
value="<?php echo $clase['id_disciplina']; ?>">

<input type="time"
name="horario"
value="<?php echo $clase['horario']; ?>">

<input type="number"
name="cupo_maximo"
value="<?php echo $clase['cupo_maximo']; ?>">

<input type="number"
name="id_dia"
value="<?php echo $clase['id_dia']; ?>">

<input type="number"
name="id_nivel"
value="<?php echo $clase['id_nivel']; ?>">

<button type="submit">
Actualizar
</button>

</form>

</body>
</html>

<?php
}
?>





















