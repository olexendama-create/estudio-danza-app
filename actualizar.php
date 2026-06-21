<?php

include("conexion.php");

$tabla = $_POST['tabla'];

if($tabla == "alumnos") { 

$id_alumno = $_POST ['id_alumno'];
$nombre = $_POST ['nombre'];
$apellido = $_POST ['apellido'];
$numero_documento = $_POST ['numero_documento'];
$telefono = $_POST ['telefono'];
$email = $_POST ['email'];
$fecha_nacimiento = $_POST ['fecha_nacimiento'];
$id_tipo_documento = $_POST ['id_tipo_documento'];
$password = $_POST ['password'];
$id_pack = $_POST ['id_pack'];

$sql = "UPDATE alumnos 
SET nombre='$nombre',
apellido='$apellido',
numero_documento='$numero_documento',
telefono='$telefono',
email='$email',
fecha_nacimiento='$fecha_nacimiento',
id_tipo_documento='$id_tipo_documento',
password='$password',
id_pack='$id_pack'
WHERE id_alumno='$id_alumno'";

mysqli_query($conexion,$sql);

header("Location:index.php");
exit();

}

if($tabla == "profesores") { 

$id_profesor = $_POST['id_profesor'];
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$telefono = $_POST['telefono'];

$sql = "UPDATE profesores 
SET nombre='$nombre',
apellido='$apellido',
telefono='$telefono'
WHERE id_profesor='$id_profesor'";

mysqli_query($conexion, $sql);

header("Location:profesores.php");
exit();

}

if($tabla == "packs") { 

$id_pack = $_POST['id_pack'];
$nombre_pack = $_POST['nombre_pack'];
$cantidad_clases = $_POST['cantidad_clases'];
$precio_actual = $_POST['precio_actual'];

$sql = "UPDATE packs 
SET nombre_pack='$nombre_pack',
cantidad_clases='$cantidad_clases',
precio_actual='$precio_actual'
WHERE id_pack='$id_pack'";

mysqli_query($conexion, $sql);

header("Location:packs.php");
exit();

}

if($tabla=="disciplinas"){

$id_disciplina = $_POST['id_disciplina'];
$nombre_disciplina = $_POST['nombre_disciplina'];

$sql = "UPDATE disciplinas
SET nombre_disciplina='$nombre_disciplina'
WHERE id_disciplina='$id_disciplina'";

mysqli_query($conexion,$sql);

header("Location:disciplinas_abm.php");
exit();

}

if($tabla=="niveles"){

$id_nivel = $_POST['id_nivel'];
$nombre_nivel = $_POST['nombre_nivel'];

$sql = "UPDATE niveles
SET nombre_nivel='$nombre_nivel'
WHERE id_nivel='$id_nivel'";

mysqli_query($conexion,$sql);

header("Location:niveles_abm.php");
exit();

}

if($tabla=="talles"){

$id_talle = $_POST['id_talle'];
$nombre_talle = $_POST['nombre_talle'];

$sql = "UPDATE talles
SET nombre_talle='$nombre_talle'
WHERE id_talle='$id_talle'";

mysqli_query($conexion,$sql);

header("Location:talles_abm.php");
exit();

}

if($tabla=="materiales"){

$id_material = $_POST['id_material'];
$id_clase = $_POST['id_clase'];
$titulo = $_POST['titulo'];
$descripcion = $_POST['descripcion'];
$archivo = $_POST['archivo'];
$fecha_subida = $_POST['fecha_subida'];

$sql="UPDATE materiales SET
id_clase='$id_clase',
titulo='$titulo',
descripcion='$descripcion',
archivo='$archivo',
fecha_subida='$fecha_subida'
WHERE id_material='$id_material'";

mysqli_query($conexion,$sql);

header("Location:materiales_abm.php");
exit();

}

if($tabla=="clases"){

$id_clase = $_POST['id_clase'];
$id_profesor = $_POST['id_profesor'];
$id_disciplina = $_POST['id_disciplina'];
$horario = $_POST['horario'];
$cupo_maximo = $_POST['cupo_maximo'];
$id_dia = $_POST['id_dia'];
$id_nivel = $_POST['id_nivel'];

$sql="UPDATE clases SET

id_profesor='$id_profesor',
id_disciplina='$id_disciplina',
horario='$horario',
cupo_maximo='$cupo_maximo',
id_dia='$id_dia',
id_nivel='$id_nivel'

WHERE id_clase='$id_clase'";

mysqli_query($conexion,$sql);

header("Location:clases_abm.php");
exit();

}





























?>