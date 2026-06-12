<?php

include("conexion.php");

$id = $_GET['id'];
$tabla = $_GET['tabla'];

if($tabla == "alumnos"){

$sql = "DELETE FROM alumnos
        WHERE id_alumno='$id'";

mysqli_query($conexion,$sql);

header("Location:index.php");
exit();

}

if($tabla == "profesores"){

    $sql = "DELETE FROM profesores
            WHERE id_profesor='$id'";

    mysqli_query($conexion,$sql);

    header("Location:profesores.php");
    exit();
}

if($tabla == "packs"){

    $sql = "DELETE FROM packs
            WHERE id_pack='$id'";

    mysqli_query($conexion,$sql);

    header("Location:packs.php");
    exit();
}


?>