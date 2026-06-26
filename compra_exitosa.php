<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Compra realizada</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body style="background:#F6F4EE;">

<div class="container text-center mt-5">
    <div class="card p-5 shadow" style="border-radius:25px;">
        <h1 style="color:#E86B98;">Compra realizada con éxito</h1>
        <p>Tu compra fue registrada correctamente.</p>

        <a href="tienda.php" class="btn btn-dark mt-3">
            Volver a la tienda
        </a>

        <a href="panel_alumno.php" class="btn mt-3" style="background:#F4C9D6;">
            Ir a mi panel
        </a>
    </div>
</div>

</body>
</html>