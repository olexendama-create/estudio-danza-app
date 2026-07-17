<?php
session_start();
include("conexion.php");

if (!isset($_SESSION["id_alumno"])) {
    header("Location: alumnos.php");
    exit();
}

$id_alumno = $_SESSION["id_alumno"];
$id_pack = isset($_POST["id_pack"]) ? $_POST["id_pack"] : "";
$metodo_pago = isset($_POST["metodo_pago"])
    ? $_POST["metodo_pago"]
    : "";

if ($id_pack == "" || $metodo_pago == "") {
    header("Location: packs.php");
    exit();
}



$sqlActivo = "SELECT * FROM pagos
              WHERE id_alumno='$id_alumno'
              AND estado='Activo'
              AND clases_restantes > 0";

$resultadoActivo = mysqli_query($conexion, $sqlActivo);

if (mysqli_num_rows($resultadoActivo) > 0) {

    echo "<script>
            alert('Ya tenés un pack activo. Primero tenés que utilizar las clases disponibles.');
            window.location='panel_alumno.php';
          </script>";
    exit();
}


$sqlPack = "SELECT * FROM packs WHERE id_pack='$id_pack'";
$resultadoPack = mysqli_query($conexion, $sqlPack);
$pack = mysqli_fetch_assoc($resultadoPack);

if (!$pack) {
    die("El pack seleccionado no existe.");
}

$precio = $pack["precio_actual"];
$cantidad_clases = $pack["cantidad_clases"];
$fecha_pago = date("Y-m-d");


$sqlPago = "INSERT INTO pagos
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
    '$metodo_pago',
    '$id_pack',
    '$cantidad_clases',
    'Activo'
)";

if (mysqli_query($conexion, $sqlPago)) {

    header("Location: pago_exitoso.php?tipo=pack");
    exit();

} else {

    echo "Error al registrar el pago: "
         . mysqli_error($conexion);
}
?>