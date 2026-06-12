<?php

include("conexion.php");

$tabla = $_POST['tabla'];

if($tabla=="alumnos"){

$nombre = $_POST ['nombre'];
$apellido = $_POST ['apellido'];
$numero_documento = $_POST ['numero_documento'];
$telefono = $_POST ['telefono'];
$email = $_POST ['email'];
$fecha_nacimiento = $_POST ['fecha_nacimiento'];
$id_tipo_documento = $_POST ['id_tipo_documento'];
$password = $_POST ['password'];
$id_pack = $_POST ['id_pack'];

$sql ="INSERT INTO alumnos
(nombre, apellido, numero_documento, telefono, email, fecha_nacimiento, id_tipo_documento, password, id_pack)
VALUES
('$nombre', '$apellido', '$numero_documento', '$telefono', '$email', '$fecha_nacimiento', '$id_tipo_documento', '$password', '$id_pack')";

mysqli_query($conexion,$sql);

header("Location:index.php");

}

if($tabla=="profesores"){

$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$telefono = $_POST['telefono'];

$sql="INSERT INTO profesores
(nombre,apellido,telefono)
VALUES
('$nombre','$apellido','$telefono')";

mysqli_query($conexion,$sql);

header("Location:profesores.php");
exit();

}

if($tabla=="packs"){

$nombre_pack = $_POST['nombre_pack'];
$cantidad_clases = $_POST['cantidad_clases'];
$precio_actual = $_POST['precio_actual'];

$sql="INSERT INTO packs
(nombre_pack,cantidad_clases,precio_actual)
VALUES
('$nombre_pack','$cantidad_clases','$precio_actual')";

mysqli_query($conexion,$sql);

header("Location:packs.php");
exit();

}

?>