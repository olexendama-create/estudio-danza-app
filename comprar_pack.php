<?php
session_start();
include("conexion.php");

if (!isset($_SESSION['id_alumno'])) {
    header("Location: alumnos.php");
    exit();
}

$id_alumno = $_SESSION['id_alumno'];
$id_pack = $_GET['id_pack'];

$sqlPack = "SELECT * FROM packs WHERE id_pack='$id_pack'";
$resultadoPack = mysqli_query($conexion, $sqlPack);
$pack = mysqli_fetch_assoc($resultadoPack);

if (!$pack) {
    die("El pack no existe.");
}

$cantidad_clases = $pack['cantidad_clases'];
$precio = $pack['precio_actual'];
$fecha_pago = date("Y-m-d");

$sqlActivo = "SELECT * FROM pagos
              WHERE id_alumno='$id_alumno'
              AND estado='Activo'
              AND clases_restantes > 0";

$resultadoActivo = mysqli_query($conexion, $sqlActivo);

if (mysqli_num_rows($resultadoActivo) > 0) {

    echo "<script>
            alert('Ya tenés un pack activo.');
            window.location='packs.php';
          </script>";
    exit();
}

$sqlCompra = "INSERT INTO pagos
(
    id_alumno,
    id_inscripcion,
    fecha_pago,
    monto_pagado,
    metodo_pago,
    id_pack,
    clases_restantes,
    estado
)
VALUES
(
    '$id_alumno',
    NULL,
    '$fecha_pago',
    '$precio',
    'Pendiente',
    '$id_pack',
    '$cantidad_clases',
    'Activo'
)";

if (mysqli_query($conexion, $sqlCompra)) {

    echo "<script>
            alert('Pack adquirido correctamente.');
            window.location='panel_alumno.php';
          </script>";

} else {

    echo "Error al comprar el pack: " . mysqli_error($conexion);
}
?>