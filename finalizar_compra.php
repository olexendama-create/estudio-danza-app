<?php
session_start();
include("conexion.php");

if(!isset($_SESSION['id_alumno'])){
    header("Location: alumnos.php");
    exit();
}

$id_alumno = $_SESSION['id_alumno'];

$sqlCarrito = "SELECT id_carrito 
               FROM carrito 
               WHERE id_alumno = '$id_alumno' 
               AND estado = 'pendiente'";

$resCarrito = mysqli_query($conexion, $sqlCarrito);

if(mysqli_num_rows($resCarrito) == 0){
    header("Location: carrito.php");
    exit();
}

$carrito = mysqli_fetch_assoc($resCarrito);
$id_carrito = $carrito['id_carrito'];

$sqlItems = "SELECT cd.*, p.stock, p.nombre_producto
             FROM carrito_detalle cd
             INNER JOIN productos p ON cd.id_producto = p.id_producto
             WHERE cd.id_carrito = '$id_carrito'";

$resItems = mysqli_query($conexion, $sqlItems);

if(mysqli_num_rows($resItems) == 0){
    header("Location: carrito.php");
    exit();
}

$items = [];

while($item = mysqli_fetch_assoc($resItems)){
    if($item['cantidad'] > $item['stock']){
        echo "No hay stock suficiente para: " . $item['nombre_producto'];
        exit();
    }

    $items[] = $item;
}

$sqlVenta = "INSERT INTO ventas (id_alumno, fecha_venta)
             VALUES ('$id_alumno', NOW())";

mysqli_query($conexion, $sqlVenta);

$id_venta = mysqli_insert_id($conexion);

foreach($items as $item){

    $id_producto = $item['id_producto'];
    $cantidad = $item['cantidad'];
    $precio = $item['precio_unitario'];

    $sqlDetalle = "INSERT INTO detalle_ventas
                   (id_venta, id_producto, cantidad, precio_unitario)
                   VALUES
                   ('$id_venta', '$id_producto', '$cantidad', '$precio')";

    mysqli_query($conexion, $sqlDetalle);

    $sqlStock = "UPDATE productos
                 SET stock = stock - $cantidad
                 WHERE id_producto = '$id_producto'";

    mysqli_query($conexion, $sqlStock);
}

$sqlEstado = "UPDATE carrito
              SET estado = 'finalizado'
              WHERE id_carrito = '$id_carrito'";

mysqli_query($conexion, $sqlEstado);

header("Location: compra_exitosa.php");
exit();
?>