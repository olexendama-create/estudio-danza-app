<?php
include("conexion.php");

$sql = "SELECT * FROM productos";
$resultado = mysqli_query($conexion,$sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Tienda Studio Gym Dance</title>

<style>

body{
    font-family: Arial, sans-serif;
    background:#f8f4ef;
    margin:0;
}

.barra{
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:20px;
    background:white;
    border-bottom:1px solid #ddd;
}

.productos{
    display:grid;
    grid-template-columns:repeat(4,1fr);
    gap:20px;
    padding:20px;
}

.card-productos{
    background:white;
    border:1px solid #ddd;
    border-radius:10px;
    padding:15px;
    text-align:center;
}

.card-productos img{
    width:150px;
    height:150px;
    object-fit:cover;
    border-radius:10px;
}

.btn-carrito{
    background:black;
    color:white;
    border:none;
    padding:10px 15px;
    border-radius:5px;
    cursor:pointer;
}

.btn-carrito:hover{
    background:#444;
}

</style>

</head>
<body>

<div class="barra">
    <h2>Studio Gym Dance</h2>

    <h3>
        🛒 Carrito (<span id="contador">0</span>)
    </h3>
</div>

<div class="productos">

<?php while($fila = mysqli_fetch_assoc($resultado)){ ?>

<div class="card-productos">

    <img src="<?php echo $fila['imagen']; ?>">

    <h3><?php echo $fila['nombre_producto']; ?></h3>

     <h3><?php echo $fila['precio']; ?></h3>

    <p><?php echo $fila['descripcion']; ?></p>

    <p>
        <strong>Stock:</strong>
        <?php echo $fila['stock']; ?>
    </p>


    <a href="carrito.php"><?php echo $fila['id_producto']; ?>
       <button class="btn-carrito">
        🛒 Agregar al carrito
       </button>
    </a>
   

</div>

<?php } ?>

</div>

<script>


</script>

</body>
</html>
