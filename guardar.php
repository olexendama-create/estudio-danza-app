<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

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



$sql ="INSERT INTO alumnos
(nombre, apellido, numero_documento, telefono, email, fecha_nacimiento, id_tipo_documento, password)
VALUES
('$nombre', 
'$apellido', 
'$numero_documento', 
'$telefono', '$email', 
'$fecha_nacimiento', 
'$id_tipo_documento', 
'$password'
)";


$resultado = mysqli_query($conexion,$sql);

if(!$resultado){
    die(mysqli_error($Rconexion));
}

header("Location: alumnos_abm.php");
exit();


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

header("Location:profesores_abm.php");
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

header("Location:packs_abm.php");
exit();

}

if($tabla=="disciplinas"){

$nombre_disciplina = $_POST['nombre_disciplina'];

$sql="INSERT INTO disciplinas
(nombre_disciplina)
VALUES
('$nombre_disciplina')";

mysqli_query($conexion,$sql);

header("Location:disciplinas_abm.php");
exit();

}

if($tabla=="niveles"){

$nombre_nivel = $_POST['nombre_nivel'];

$sql="INSERT INTO niveles
(nombre_nivel)
VALUES
('$nombre_nivel')";

mysqli_query($conexion,$sql);

header("Location:niveles_abm.php");
exit();

}

if($tabla=="talles"){

$nombre_talle = $_POST['nombre_talle'];

$sql="INSERT INTO talles
(nombre_talle)
VALUES
('$nombre_talle')";

mysqli_query($conexion,$sql);

header("Location:talles_abm.php");
exit();

}

if($tabla=="materiales"){

$id_clase = $_POST['id_clase'];
$titulo = $_POST['titulo'];
$descripcion = $_POST['descripcion'];
$archivo = $_POST['archivo'];
$fecha_subida = $_POST['fecha_subida'];

$sql="INSERT INTO materiales
(id_clase,titulo,descripcion,archivo,fecha_subida)
VALUES
('$id_clase','$titulo','$descripcion','$archivo','$fecha_subida')";

mysqli_query($conexion,$sql);

header("Location:materiales_abm.php");
exit();

}

if($tabla=="clases"){

$id_profesor = $_POST['id_profesor'];
$id_disciplina = $_POST['id_disciplina'];
$horario = $_POST['horario'];
$cupo_maximo = $_POST['cupo_maximo'];
$id_dia = $_POST['id_dia'];
$id_nivel = $_POST['id_nivel'];

$sql="INSERT INTO clases
(id_profesor,id_disciplina,horario,cupo_maximo,id_dia,id_nivel)
VALUES
('$id_profesor','$id_disciplina','$horario','$cupo_maximo','$id_dia','$id_nivel')";

mysqli_query($conexion,$sql);

header("Location:clases_abm.php");
exit();

}

if($tabla=="tipos_documento"){

$nombre_documento=$_POST['nombre_documento'];

$sql="INSERT INTO tipos_documento
(nombre_documento)
VALUES
('$nombre_documento')";

mysqli_query($conexion,$sql);

header("Location:tipos_documento_abm.php");
exit();
}

if($tabla=="dias_semanas"){

    $nombre_dia=$_POST['nombre_dia'];

    $sql="INSERT INTO dias_semanas
    (nombre_dia)
    VALUES
    ('$nombre_dia')";

    mysqli_query($conexion,$sql);

    header("Location:dias_semanas_abm.php");
    exit();
}

if($tabla=="productos"){

    $nombre_producto=$_POST['nombre_producto'];
    $descripcion=$_POST['descripcion'];
    $stock=$_POST['stock'];
    $imagen=$_POST['imagen'];
    $precio=$_POST['precio'];

    $sql="INSERT INTO productos
    (nombre_producto,descripcion,stock,imagen,precio)
    VALUES
    ('$nombre_producto','$descripcion','$stock','$imagen','$precio')";

    mysqli_query($conexion,$sql);

    header("Location:productos_abm.php");
    exit();
}

if($tabla=="categorias_disciplinas"){

    $nombrecategoria=$_POST['nombrecategoria'];
    $imagen_url=$_POST['imagen_url'];
    $descripcion=$_POST['descripcion'];

    $sql="INSERT INTO categorias_disciplinas
    (nombrecategoria,imagen_url,descripcion)
    VALUES
    ('$nombrecategoria','$imagen_url','$descripcion')";

    mysqli_query($conexion,$sql);

    header("Location:categorias_disciplinas_abm.php");
    exit();
}








?>