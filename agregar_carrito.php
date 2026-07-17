<?php

session_start();
include("conexion.php");

if (!isset($_SESSION["id_alumno"])) {
    header("Location: tienda.php?login=1");
    exit();
}

if (
    !isset($_POST["id_producto"]) ||
    !isset($_POST["id_talle"]) ||
    !isset($_POST["cantidad"])
) {
    header("Location: tienda.php?error=datos");
    exit();
}

$id_alumno = (int) $_SESSION["id_alumno"];
$id_producto = (int) $_POST["id_producto"];
$id_talle = (int) $_POST["id_talle"];
$cantidad = (int) $_POST["cantidad"];

/* No permitimos cantidades menores a 1 */
if ($cantidad < 1) {
    $cantidad = 1;
}

/* Buscar el precio real del producto */

$sqlPrecio = "SELECT precio
              FROM productos
              WHERE id_producto = ?
              LIMIT 1";

$consultaPrecio = mysqli_prepare($conexion, $sqlPrecio);

mysqli_stmt_bind_param(
    $consultaPrecio,
    "i",
    $id_producto
);

mysqli_stmt_execute($consultaPrecio);

$resultadoPrecio = mysqli_stmt_get_result($consultaPrecio);
$producto = mysqli_fetch_assoc($resultadoPrecio);

if (!$producto) {
    header("Location: tienda.php?error=producto");
    exit();
}

$precio = $producto["precio"];

$sqlCarrito = "SELECT id_carrito
               FROM carrito
               WHERE id_alumno = ?
               AND estado = 'pendiente'
               LIMIT 1";

$consultaCarrito = mysqli_prepare($conexion, $sqlCarrito);

mysqli_stmt_bind_param(
    $consultaCarrito,
    "i",
    $id_alumno
);

mysqli_stmt_execute($consultaCarrito);

$resultadoCarrito = mysqli_stmt_get_result($consultaCarrito);
$carrito = mysqli_fetch_assoc($resultadoCarrito);

if ($carrito) {

    $id_carrito = (int) $carrito["id_carrito"];

} else {

    $sqlCrearCarrito = "INSERT INTO carrito
                        (id_alumno, estado)
                        VALUES (?, 'pendiente')";

    $crearCarrito = mysqli_prepare($conexion, $sqlCrearCarrito);

    mysqli_stmt_bind_param(
        $crearCarrito,
        "i",
        $id_alumno
    );

    mysqli_stmt_execute($crearCarrito);

    $id_carrito = mysqli_insert_id($conexion);
}

$sqlExiste = "SELECT id_detalle, cantidad
              FROM carrito_detalle
              WHERE id_carrito = ?
              AND id_producto = ?
              AND id_talle = ?
              LIMIT 1";

$consultaExiste = mysqli_prepare($conexion, $sqlExiste);

mysqli_stmt_bind_param(
    $consultaExiste,
    "iii",
    $id_carrito,
    $id_producto,
    $id_talle
);

mysqli_stmt_execute($consultaExiste);

$resultadoExiste = mysqli_stmt_get_result($consultaExiste);
$detalleExistente = mysqli_fetch_assoc($resultadoExiste);

if ($detalleExistente) {

    $id_detalle = (int) $detalleExistente["id_detalle"];

    $sqlActualizar = "UPDATE carrito_detalle
                      SET cantidad = cantidad + ?,
                          precio_unitario = ?
                      WHERE id_detalle = ?";

    $actualizar = mysqli_prepare($conexion, $sqlActualizar);

    mysqli_stmt_bind_param(
        $actualizar,
        "idi",
        $cantidad,
        $precio,
        $id_detalle
    );

    mysqli_stmt_execute($actualizar);

} else {

    $sqlDetalle = "INSERT INTO carrito_detalle
                   (
                       id_carrito,
                       id_producto,
                       id_talle,
                       cantidad,
                       precio_unitario
                   )
                   VALUES (?, ?, ?, ?, ?)";

    $insertarDetalle = mysqli_prepare($conexion, $sqlDetalle);

    mysqli_stmt_bind_param(
        $insertarDetalle,
        "iiiid",
        $id_carrito,
        $id_producto,
        $id_talle,
        $cantidad,
        $precio
    );

    mysqli_stmt_execute($insertarDetalle);
}

header("Location: carrito.php?agregado=1");
exit();

?>