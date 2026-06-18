<?php
session_start();
include("conexion.php");

if(!isset($_SESSION['id_alumno'])){
    header("Location: login.php");
    exit();
}

$id_alumno = $_SESSION['id_alumno'];
$id_producto = $_POST['id_producto'];
$id_talle = $_POST['id_talle'];

echo "Alumno: ".$id_alumno."<br>";
echo "Producto: ".$id_producto."<br>";
echo "Talle: ".$id_talle."<br>";

$sqlPrecio = "SELECT precio FROM productos WHERE id_producto='$id_producto'";
$resPrecio = mysqli_query($conexion, $sqlPrecio);
$producto = mysqli_fetch_assoc($resPrecio);
$precio = $producto['precio'];

$sqlCarrito = "SELECT * FROM carrito 
               WHERE id_alumno='$id_alumno' 
               AND estado='pendiente'";

$resCarrito = mysqli_query($conexion, $sqlCarrito);

if(mysqli_num_rows($resCarrito) > 0){
    $carrito = mysqli_fetch_assoc($resCarrito);
    $id_carrito = $carrito['id_carrito'];
}else{
    mysqli_query($conexion, "INSERT INTO carrito (id_alumno) VALUES ('$id_alumno')");
    $id_carrito = mysqli_insert_id($conexion);
}

$sqlDetalle = "INSERT INTO carrito_detalle
               (id_carrito, id_producto, id_talle, cantidad, precio_unitario)
               VALUES
               ('$id_carrito', '$id_producto', '$id_talle', 1, '$precio')";

mysqli_query($conexion, $sqlDetalle);

header("Location: carrito.php");
exit();
?>