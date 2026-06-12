<?php
include("conexion.php");

if(isset($_POST['subir'])){

    $id_clase = $_POST['id_clase'];
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];

    $archivo = $_FILES['archivo']['name'];
    $ruta_temporal = $_FILES['archivo']['tmp_name'];

    $carpeta = "materiales/";

    $ruta_final = $carpeta . $archivo;

    move_uploaded_file($ruta_temporal, $ruta_final);

    $sql = "INSERT INTO materiales 
            (id_clase, titulo, descripcion, archivo, fecha_subida)
            VALUES
            ('$id_clase', '$titulo', '$descripcion', '$ruta_final', CURDATE())";

    mysqli_query($conexion, $sql);

    echo "<script>
    alert('Material subido correctamente');
    window.location.href='subir_material.php';
    </script>";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Subir Material</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">

<h2>Subir material de clase</h2>

<form method="POST" enctype="multipart/form-data">

    <label>Clase</label>
    <select name="id_clase" class="form-control mb-3" required>
        <option value="1">Danza Clásica - Lunes 16:00</option>
        <option value="26">Árabe - Sábado 17:00</option>
    </select>

    <label>Título</label>
    <input type="text" name="titulo" class="form-control mb-3" required>

    <label>Descripción</label>
    <textarea name="descripcion" class="form-control mb-3"></textarea>

    <label>Archivo</label>
    <input type="file" name="archivo" class="form-control mb-3" required>

    <button type="submit" name="subir" class="btn btn-dark">
        Subir material
    </button>

</form>

</body>
</html>