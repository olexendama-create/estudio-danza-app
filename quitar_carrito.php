<?php

session_start();
include("conexion.php");

if (!isset($_SESSION["id_alumno"])) {
    header("Location: alumnos.php");
    exit();
}

$id_alumno = (int) $_SESSION["id_alumno"];

$id_detalle = isset($_GET["id_detalle"])
    ? (int) $_GET["id_detalle"]
    : 0;

if ($id_detalle <= 0) {
    header("Location: carrito.php");
    exit();
}


$sql = "DELETE cd
        FROM carrito_detalle cd
        JOIN carrito c
            ON cd.id_carrito = c.id_carrito
        WHERE cd.id_detalle = ?
        AND c.id_alumno = ?
        AND c.estado = 'pendiente'";

$consulta = mysqli_prepare($conexion, $sql);

mysqli_stmt_bind_param(
    $consulta,
    "ii",
    $id_detalle,
    $id_alumno
);

mysqli_stmt_execute($consulta);

header("Location: carrito.php");
exit();

?>