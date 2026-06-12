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


?>