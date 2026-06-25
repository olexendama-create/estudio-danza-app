<?php

include("conexion.php");

$id = $_GET['id'];
$tabla = $_GET['tabla'];

if($tabla == "alumnos"){

$sql = "DELETE FROM alumnos
        WHERE id_alumno='$id'";

mysqli_query($conexion,$sql);

header("Location:alumnos_abm.php");
exit();

}

if($tabla == "profesores"){

    $sql = "DELETE FROM profesores
            WHERE id_profesor='$id'";

    mysqli_query($conexion,$sql);

    header("Location:profesores_abm.php");
    exit();
}

if($tabla == "packs"){

    $sql = "DELETE FROM packs
            WHERE id_pack='$id'";

    mysqli_query($conexion,$sql);

    header("Location:packs_abm.php");
    exit();
}

if($tabla=="disciplinas"){

$sql = "DELETE FROM disciplinas
        WHERE id_disciplina='$id'";

mysqli_query($conexion,$sql);

header("Location:disciplinas_abm.php");
exit();

}

if($tabla=="niveles"){

$sql = "DELETE FROM niveles
        WHERE id_nivel='$id'";

mysqli_query($conexion,$sql);

header("Location:niveles_abm.php");
exit();

}

if($tabla=="talles"){

$sql = "DELETE FROM talles
        WHERE id_talle='$id'";

mysqli_query($conexion,$sql);

header("Location:talles_abm.php");
exit();

}

if($tabla=="materiales"){

$sql="DELETE FROM materiales
WHERE id_material='$id'";

mysqli_query($conexion,$sql);

header("Location:materiales_abm.php");
exit();

}

if($tabla=="clases"){

$sql="DELETE FROM clases
WHERE id_clase='$id'";

mysqli_query($conexion,$sql);

header("Location:clases_abm.php");
exit();

}

if($tabla=="tipos_documento"){

$sql="DELETE FROM tipos_documento
WHERE id_tipo_documento='$id'";

mysqli_query($conexion,$sql);

header("Location:tipos_documento_abm.php");
exit();
}

if($tabla=="dias_semanas"){

    $sql="DELETE FROM dias_semanas
    WHERE id_dia='$id'";

    mysqli_query($conexion,$sql);

    header("Location:dias_semanas_abm.php");
    exit();
}

if($tabla=="productos"){

    $sql="DELETE FROM productos
    WHERE id_producto='$id'";

    mysqli_query($conexion,$sql);

    header("Location:productos_abm.php");
    exit();
}

if($tabla=="categorias_disciplinas"){

    $sql="DELETE FROM categorias_disciplinas
    WHERE idcategorias_disciplinas='$id'";

    mysqli_query($conexion,$sql);

    header("Location:categorias_disciplinas_abm.php");
    exit();
}










?>