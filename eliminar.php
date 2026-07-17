<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

include("conexion.php");

$id = $_GET['id'];
$tabla = $_GET['tabla'];

if($tabla == "alumnos"){

    /* Primero buscamos los carritos del alumno */
    $sql_buscar_carritos = "SELECT id_carrito
                            FROM carrito
                            WHERE id_alumno='$id'";

    $resultado_carritos = mysqli_query(
        $conexion,
        $sql_buscar_carritos
    );

    if(!$resultado_carritos){
        die(
            "Error al buscar carritos: "
            . mysqli_error($conexion)
        );
    }

    /* Eliminamos los detalles de cada carrito */
    while($carrito = mysqli_fetch_assoc($resultado_carritos)){

        $id_carrito = $carrito['id_carrito'];

        $sql_detalle = "DELETE FROM carrito_detalle
                        WHERE id_carrito='$id_carrito'";

        $resultado_detalle = mysqli_query(
            $conexion,
            $sql_detalle
        );

        if(!$resultado_detalle){
            die(
                "Error al eliminar detalles del carrito: "
                . mysqli_error($conexion)
            );
        }
    }

    /* Eliminamos los carritos del alumno */
    $sql_carrito = "DELETE FROM carrito
                    WHERE id_alumno='$id'";

    $resultado_carrito = mysqli_query(
        $conexion,
        $sql_carrito
    );

    if(!$resultado_carrito){
        die(
            "Error al eliminar carrito: "
            . mysqli_error($conexion)
        );
    }

    /* Finalmente eliminamos al alumno */
    $sql_alumno = "DELETE FROM alumnos
                   WHERE id_alumno='$id'";

    $resultado_alumno = mysqli_query(
        $conexion,
        $sql_alumno
    );

    if(!$resultado_alumno){
        die(
            "Error al eliminar alumno: "
            . mysqli_error($conexion)
        );
    }

    header("Location: alumnos_abm.php");
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


else if($tabla == "ventas"){

    /* Primero eliminamos los detalles de la venta */
    $sql_detalles = "DELETE FROM detalle_ventas
                     WHERE id_venta='$id'";

    $resultado_detalles = mysqli_query($conexion, $sql_detalles);

    if(!$resultado_detalles){
        die(
            "Error al eliminar los detalles de la venta: "
            . mysqli_error($conexion)
        );
    }

    /* Después eliminamos la venta */
    $sql_venta = "DELETE FROM ventas
                  WHERE id_venta='$id'";

    $resultado_venta = mysqli_query($conexion, $sql_venta);

    if(!$resultado_venta){
        die(
            "Error al eliminar la venta: "
            . mysqli_error($conexion)
        );
    }

    header("Location: ventas_abm.php");
    exit();
}

else if($tabla == "carrito"){

    /* Primero eliminamos los detalles del carrito */
    $sql_detalle = "DELETE FROM carrito_detalle
                    WHERE id_carrito='$id'";

    $resultado_detalle = mysqli_query($conexion, $sql_detalle);

    if(!$resultado_detalle){
        die(
            "Error al eliminar los detalles del carrito: "
            . mysqli_error($conexion)
        );
    }

    /* Después eliminamos el carrito */
    $sql_carrito = "DELETE FROM carrito
                    WHERE id_carrito='$id'";

    $resultado_carrito = mysqli_query($conexion, $sql_carrito);

    if(!$resultado_carrito){
        die(
            "Error al eliminar el carrito: "
            . mysqli_error($conexion)
        );
    }

    header("Location: carrito_abm.php");
    exit();
}

?>