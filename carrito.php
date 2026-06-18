<?php
session_start();
include("conexion.php");

if(!isset($_SESSION['id_alumno'])){
    header("Location: login.php");
    exit();
}

$id_alumno = $_SESSION['id_alumno'];

$sql = "SELECT p.nombre_producto, p.imagen, t.nombre_talle, cd.cantidad, cd.precio_unitario
        FROM carrito c
        JOIN carrito_detalle cd ON c.id_carrito = cd.id_carrito
        JOIN productos p ON cd.id_producto = p.id_producto
        JOIN talles t ON cd.id_talle = t.id_talle
        WHERE c.id_alumno='$id_alumno'
        AND c.estado='pendiente'";

$resultado = mysqli_query($conexion, $sql);
$total = 0;
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Carrito</title>
<link rel="stylesheet" href="style.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h1 class="text-center mb-4">🛍️ Mi Carrito</h1>

<table class="table table-striped table-hover text-center">
<tr>
    <th>Imagen</th>
    <th>Producto</th>
    <th>Talle</th>
    <th>Cantidad</th>
    <th>Precio</th>
</tr>

<?php while($fila = mysqli_fetch_assoc($resultado)){ 
$total += $fila['precio_unitario'] * $fila['cantidad'];
?>

<tr>
    <td><img src="<?php echo $fila['imagen']; ?>"
     width="100"
     style="border-radius:10px;"></td>
    <td><?php echo $fila['nombre_producto']; ?></td>
    <td><?php echo $fila['nombre_talle']; ?></td>
    <td><?php echo $fila['cantidad']; ?></td>
    <td>$<?php echo $fila['precio_unitario']; ?></td>
</tr>

<?php } ?>

</table>

<div class="text-end">
    <h3>Total: $<?php echo number_format($total,0,',','.'); ?></h3>
</div>

<div class="d-flex justify-content-between mt-4">

    <a href="tienda.php" class="btn btn-secondary">
        ← Seguir comprando
    </a>

    <a href="finalizar_compra.php" class="btn btn-success">
        Finalizar compra
    </a>

</div>

</body>
</html>