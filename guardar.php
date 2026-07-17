<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

include("conexion.php");

if(!isset($_POST['tabla'])){
    die("No se recibió la tabla");
}

$tabla = $_POST['tabla'];


if($tabla == "alumnos"){

    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $numero_documento = $_POST['numero_documento'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $id_tipo_documento = $_POST['id_tipo_documento'];
    $password = $_POST['password'];

    /* Verificamos si ya existe el correo */
    $buscar_email = "SELECT id_alumno
                     FROM alumnos
                     WHERE email='$email'";

    $resultado_email = mysqli_query($conexion, $buscar_email);

    if(mysqli_num_rows($resultado_email) > 0){

        echo "
        <script>
            alert('Ya existe un alumno registrado con ese correo electrónico');
            window.location.href='alumnos_abm.php';
        </script>
        ";

        exit();
    }

    /* Verificamos documento y tipo de documento */
    $buscar_documento = "SELECT id_alumno
                         FROM alumnos
                         WHERE numero_documento='$numero_documento'
                         AND id_tipo_documento='$id_tipo_documento'";

    $resultado_documento = mysqli_query(
        $conexion,
        $buscar_documento
    );

    if(mysqli_num_rows($resultado_documento) > 0){

        echo "
        <script>
            alert('Ya existe un alumno con ese número y tipo de documento');
            window.location.href='alumnos_abm.php';
        </script>
        ";

        exit();
    }

    $sql = "INSERT INTO alumnos
            (
                nombre,
                apellido,
                numero_documento,
                telefono,
                email,
                fecha_nacimiento,
                id_tipo_documento,
                password
            )
            VALUES
            (
                '$nombre',
                '$apellido',
                '$numero_documento',
                '$telefono',
                '$email',
                '$fecha_nacimiento',
                '$id_tipo_documento',
                '$password'
            )";

    $resultado = mysqli_query($conexion, $sql);

    if(!$resultado){
        die("Error al guardar alumno: " . mysqli_error($conexion));
    }

    header("Location: alumnos_abm.php");
    exit();
}

/* PROFESORES */

else if($tabla == "profesores"){

    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $telefono = $_POST['telefono'];

    $sql = "INSERT INTO profesores
            (nombre, apellido, telefono)
            VALUES
            ('$nombre', '$apellido', '$telefono')";

    $resultado = mysqli_query($conexion, $sql);

    if(!$resultado){
        die("Error al guardar profesor: " . mysqli_error($conexion));
    }

    header("Location: profesores_abm.php");
    exit();
}


/* PACKS */

else if($tabla == "packs"){

    $nombre_pack = $_POST['nombre_pack'];
    $cantidad_clases = $_POST['cantidad_clases'];
    $precio_actual = $_POST['precio_actual'];

    $sql = "INSERT INTO packs
            (nombre_pack, cantidad_clases, precio_actual)
            VALUES
            ('$nombre_pack', '$cantidad_clases', '$precio_actual')";

    $resultado = mysqli_query($conexion, $sql);

    if(!$resultado){
        die("Error al guardar pack: " . mysqli_error($conexion));
    }

    header("Location: packs_abm.php");
    exit();
}


/* DISCIPLINAS */

else if($tabla == "disciplinas"){

    $nombre_disciplina = $_POST['nombre_disciplina'];

    $sql = "INSERT INTO disciplinas
            (nombre_disciplina)
            VALUES
            ('$nombre_disciplina')";

    $resultado = mysqli_query($conexion, $sql);

    if(!$resultado){
        die("Error al guardar disciplina: " . mysqli_error($conexion));
    }

    header("Location: disciplinas_abm.php");
    exit();
}


/* NIVELES */

else if($tabla == "niveles"){

    $nombre_nivel = $_POST['nombre_nivel'];

    $sql = "INSERT INTO niveles
            (nombre_nivel)
            VALUES
            ('$nombre_nivel')";

    $resultado = mysqli_query($conexion, $sql);

    if(!$resultado){
        die("Error al guardar nivel: " . mysqli_error($conexion));
    }

    header("Location: niveles_abm.php");
    exit();
}


/* TALLES */

else if($tabla == "talles"){

    $nombre_talle = $_POST['nombre_talle'];

    $sql = "INSERT INTO talles
            (nombre_talle)
            VALUES
            ('$nombre_talle')";

    $resultado = mysqli_query($conexion, $sql);

    if(!$resultado){
        die("Error al guardar talle: " . mysqli_error($conexion));
    }

    header("Location: talles_abm.php");
    exit();
}


/* MATERIALES */

else if($tabla == "materiales"){

    $id_clase = $_POST['id_clase'];
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $archivo = $_POST['archivo'];
    $fecha_subida = $_POST['fecha_subida'];

    $sql = "INSERT INTO materiales
            (id_clase, titulo, descripcion, archivo, fecha_subida)
            VALUES
            ('$id_clase', '$titulo', '$descripcion', '$archivo', '$fecha_subida')";

    $resultado = mysqli_query($conexion, $sql);

    if(!$resultado){
        die("Error al guardar material: " . mysqli_error($conexion));
    }

    header("Location: materiales_abm.php");
    exit();
}


/* CLASES */

else if($tabla == "clases"){

    $id_profesor = $_POST['id_profesor'];
    $id_disciplina = $_POST['id_disciplina'];
    $horario = $_POST['horario'];
    $cupo_maximo = $_POST['cupo_maximo'];
    $id_dia = $_POST['id_dia'];
    $id_nivel = $_POST['id_nivel'];

    $sql = "INSERT INTO clases
            (id_profesor, id_disciplina, horario, cupo_maximo, id_dia, id_nivel)
            VALUES
            ('$id_profesor', '$id_disciplina', '$horario',
             '$cupo_maximo', '$id_dia', '$id_nivel')";

    $resultado = mysqli_query($conexion, $sql);

    if(!$resultado){
        die("Error al guardar clase: " . mysqli_error($conexion));
    }

    header("Location: clases_abm.php");
    exit();
}


/* TIPOS DE DOCUMENTO */

else if($tabla == "tipos_documento"){

    $nombre_documento = $_POST['nombre_documento'];

    $sql = "INSERT INTO tipos_documento
            (nombre_documento)
            VALUES
            ('$nombre_documento')";

    $resultado = mysqli_query($conexion, $sql);

    if(!$resultado){
        die("Error al guardar tipo de documento: " . mysqli_error($conexion));
    }

    header("Location: tipos_documento_abm.php");
    exit();
}


/* DÍAS DE LA SEMANA */

else if($tabla == "dias_semanas"){

    $nombre_dia = $_POST['nombre_dia'];

    $sql = "INSERT INTO dias_semanas
            (nombre_dia)
            VALUES
            ('$nombre_dia')";

    $resultado = mysqli_query($conexion, $sql);

    if(!$resultado){
        die("Error al guardar día: " . mysqli_error($conexion));
    }

    header("Location: dias_semanas_abm.php");
    exit();
}


/* PRODUCTOS */

else if($tabla == "productos"){

    $nombre_producto = $_POST['nombre_producto'];
    $descripcion = $_POST['descripcion'];
    $stock = $_POST['stock'];
    $imagen = $_POST['imagen'];
    $precio = $_POST['precio'];

    $sql = "INSERT INTO productos
            (nombre_producto, descripcion, stock, imagen, precio)
            VALUES
            ('$nombre_producto', '$descripcion', '$stock', '$imagen', '$precio')";

    $resultado = mysqli_query($conexion, $sql);

    if(!$resultado){
        die("Error al guardar producto: " . mysqli_error($conexion));
    }

    header("Location: productos_abm.php");
    exit();
}


/* CATEGORÍAS DE DISCIPLINAS */

else if($tabla == "categorias_disciplinas"){

    $nombrecategoria = $_POST['nombrecategoria'];
    $imagen_url = $_POST['imagen_url'];
    $descripcion = $_POST['descripcion'];

    $sql = "INSERT INTO categorias_disciplinas
            (nombrecategoria, imagen_url, descripcion)
            VALUES
            ('$nombrecategoria', '$imagen_url', '$descripcion')";

    $resultado = mysqli_query($conexion, $sql);

    if(!$resultado){
        die("Error al guardar categoría: " . mysqli_error($conexion));
    }

    header("Location: categorias_disciplinas_abm.php");
    exit();
}




else if($tabla == "ventas"){

    $id_alumno = $_POST['id_alumno'];
    $fecha_venta = str_replace("T", " ", $_POST['fecha_venta']);
    $metodo_pago = $_POST['metodo_pago'];

    $sql = "INSERT INTO ventas
            (id_alumno, fecha_venta, metodo_pago)
            VALUES
            ('$id_alumno', '$fecha_venta', '$metodo_pago')";

    $resultado = mysqli_query($conexion, $sql);

    if(!$resultado){
        die("Error al guardar venta: " . mysqli_error($conexion));
    }

    header("Location: ventas_abm.php");
    exit();
}


else if($tabla == "carrito"){

    $id_alumno = $_POST['id_alumno'];
    $fecha = str_replace("T", " ", $_POST['fecha']);
    $estado = $_POST['estado'];

    if(
        empty($id_alumno) ||
        empty($fecha) ||
        empty($estado)
    ){
        die("Complete todos los campos del carrito");
    }

    $sql = "INSERT INTO carrito
            (id_alumno, fecha, estado)
            VALUES
            ('$id_alumno', '$fecha', '$estado')";

    $resultado = mysqli_query($conexion, $sql);

    if(!$resultado){
        die("Error al guardar carrito: " . mysqli_error($conexion));
    }

    header("Location: carrito_abm.php");
    exit();
}


else{

    echo "La tabla recibida no es válida";

}

?>


?>