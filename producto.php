<?php
include("conexion.php");

$id = $_GET['id'];

$sql = "SELECT * FROM productos WHERE id_producto = $id";
$resultado = mysqli_query($conexion,$sql);
$producto = mysqli_fetch_assoc($resultado);
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title><?php echo $producto['nombre_producto']; ?></title>

<link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet">

<style>

body{
    background:#fdfbf7;
    font-family:Montserrat,sans-serif;
    padding:40px;
}

.contenedor{
    max-width:1200px;
    margin:auto;
    display:flex;
    gap:50px;
    align-items:center;
}

img{
    width:500px;
    border-radius:20px;
}

.info h1{
    font-family:'Anton';
    font-size:60px;
    color:#2e2723;
}

.precio{
    font-size:40px;
    color:#d66ba0;
    font-weight:bold;
}

.descripcion{
    margin-top:20px;
    color:#666;
}

.stock{
    margin-top:15px;
    font-weight:bold;
}

button{
    margin-top:20px;
    background:#2e2723;
    color:white;
    border:none;
    padding:15px 30px;
    border-radius:15px;
}

</style>
</head>

<body>

<div class="contenedor">

<img src="<?php echo $producto['imagen']; ?>">

<div class="info">

<h1><?php echo $producto['nombre_producto']; ?></h1>

<div class="precio">
$<?php echo number_format($producto['precio'],0,',','.'); ?>
</div>

<div class="descripcion">
<?php echo $producto['descripcion']; ?>
</div>

<div class="stock">
Stock: <?php echo $producto['stock']; ?>
</div>

<form action="agregar_carrito.php" method="POST">

    <input type="hidden"
           name="id_producto"
           value="<?php echo $producto['id_producto']; ?>">

    <label>Talle:</label>

    <select name="id_talle" required>

<?php

$idProducto = $producto['id_producto'];

$sqlTalles = "
SELECT t.id_talle, t.nombre_talle
FROM producto_talles pt
INNER JOIN talles t ON pt.id_talle = t.id_talle
WHERE pt.id_producto = $idProducto
AND pt.stock > 0
";

$resTalles = mysqli_query($conexion,$sqlTalles);

while($talle = mysqli_fetch_assoc($resTalles)){
?>

<option value="<?php echo $talle['id_talle']; ?>">
    <?php echo $talle['nombre_talle']; ?>
</option>

<?php } ?>

</select>

    <button type="submit">
        🛒 Agregar al carrito
    </button>

</form>

</div>

</div>

</body>
</html>