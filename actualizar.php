<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

include("conexion.php");

$tabla = $_POST['tabla'];

if($tabla == "alumnos") { 

$id_alumno = $_POST['id_alumno'];
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$numero_documento = $_POST['numero_documento'];
$telefono = $_POST['telefono'];
$email = $_POST['email'];
$fecha_nacimiento = $_POST['fecha_nacimiento'];
$id_tipo_documento = $_POST['id_tipo_documento'];
$password = $_POST['password'];

$sql = "UPDATE alumnos
SET nombre='$nombre',
apellido='$apellido',
numero_documento='$numero_documento',
telefono='$telefono',
email='$email',
fecha_nacimiento='$fecha_nacimiento',
id_tipo_documento='$id_tipo_documento',
password='$password'
WHERE id_alumno='$id_alumno'";

mysqli_query($conexion,$sql);

header("Location:alumnos_abm.php");
exit();

} else {
    echo "Error al actualizar: " . mysqli_error($conexion);
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

header("Location:profesores_abm.php");
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

header("Location:packs_abm.php");
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

if($tabla=="tipos_documento"){

$id_tipo_documento=$_POST['id_tipo_documento'];
$nombre_documento=$_POST['nombre_documento'];

$sql="UPDATE tipos_documento
SET nombre_documento='$nombre_documento'
WHERE id_tipo_documento='$id_tipo_documento'";

mysqli_query($conexion,$sql);

header("Location:tipos_documento_abm.php");
exit();
}

if($tabla=="dias_semanas"){

    $id_dia=$_POST['id_dia'];
    $nombre_dia=$_POST['nombre_dia'];

    $sql="UPDATE dias_semanas
    SET nombre_dia='$nombre_dia'
    WHERE id_dia='$id_dia'";

    mysqli_query($conexion,$sql);

    header("Location:dias_semanas_abm.php");
    exit();
}

if($tabla=="productos"){

    $id_producto=$_POST['id_producto'];
    $nombre_producto=$_POST['nombre_producto'];
    $descripcion=$_POST['descripcion'];
    $stock=$_POST['stock'];
    $imagen=$_POST['imagen'];
    $precio=$_POST['precio'];

    $sql="UPDATE productos
    SET nombre_producto='$nombre_producto',
        descripcion='$descripcion',
        stock='$stock',
        imagen='$imagen',
        precio='$precio'
    WHERE id_producto='$id_producto'";

    mysqli_query($conexion,$sql);

    header("Location:productos_abm.php");
    exit();
}

if($tabla=="categorias_disciplinas"){

    $idcategorias_disciplinas=$_POST['idcategorias_disciplinas'];
    $nombrecategoria=$_POST['nombrecategoria'];
    $imagen_url=$_POST['imagen_url'];
    $descripcion=$_POST['descripcion'];

    $sql="UPDATE categorias_disciplinas
    SET nombrecategoria='$nombrecategoria',
        imagen_url='$imagen_url',
        descripcion='$descripcion'
    WHERE idcategorias_disciplinas='$idcategorias_disciplinas'";

    mysqli_query($conexion,$sql);

    header("Location:categorias_disciplinas_abm.php");
    exit();
}

else if($tabla == "ventas"){

    $id_venta = $_POST['id_venta'];
    $id_alumno = $_POST['id_alumno'];
    $fecha_venta = str_replace("T", " ", $_POST['fecha_venta']);
    $metodo_pago = $_POST['metodo_pago'];

    $sql = "UPDATE ventas
            SET id_alumno='$id_alumno',
                fecha_venta='$fecha_venta',
                metodo_pago='$metodo_pago'
            WHERE id_venta='$id_venta'";

    $resultado = mysqli_query($conexion, $sql);

    if(!$resultado){
        die("Error al actualizar venta: " . mysqli_error($conexion));
    }

    header("Location: ventas_abm.php");
    exit();
}


else if($tabla == "carrito"){

    $id_carrito = $_POST['id_carrito'];
    $id_alumno = $_POST['id_alumno'];
    $fecha = str_replace("T", " ", $_POST['fecha']);
    $estado = $_POST['estado'];

    if(
        empty($id_carrito) ||
        empty($id_alumno) ||
        empty($fecha) ||
        empty($estado)
    ){
        die("Faltan datos para actualizar el carrito");
    }

    $sql = "UPDATE carrito
            SET id_alumno='$id_alumno',
                fecha='$fecha',
                estado='$estado'
            WHERE id_carrito='$id_carrito'";

    $resultado = mysqli_query($conexion, $sql);

    if(!$resultado){
        die("Error al actualizar carrito: " . mysqli_error($conexion));
    }

    header("Location: carrito_abm.php");
    exit();
}




















?>