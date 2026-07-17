<?php

session_start();
include("conexion.php");

if (!isset($_SESSION["id_alumno"])) {
    header("Location: alumnos.php");
    exit();
}

$id_alumno = (int) $_SESSION["id_alumno"];

$sql = "SELECT
            cd.id_detalle,
            p.nombre_producto,
            p.imagen,
            t.nombre_talle,
            cd.cantidad,
            cd.precio_unitario
        FROM carrito c
        JOIN carrito_detalle cd
            ON c.id_carrito = cd.id_carrito
        JOIN productos p
            ON cd.id_producto = p.id_producto
        JOIN talles t
            ON cd.id_talle = t.id_talle
        WHERE c.id_alumno = ?
        AND c.estado = 'pendiente'";

$consulta = mysqli_prepare($conexion, $sql);

mysqli_stmt_bind_param(
    $consulta,
    "i",
    $id_alumno
);

mysqli_stmt_execute($consulta);

$resultado = mysqli_stmt_get_result($consulta);

$total = 0;

?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Mi carrito</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link
        rel="stylesheet"
        href="style.css"
    >

</head>

<body style="background-color:#f8f7f2;">

<div class="container py-5">

    <div class="bg-white p-4 shadow-sm border">

        <h1 class="text-center mb-4">
            Mi carrito
        </h1>

        <?php if (mysqli_num_rows($resultado) > 0) { ?>

            <div class="table-responsive">

                <table class="table table-striped table-hover align-middle text-center">

                    <thead class="table-dark">

                        <tr>
                            <th>Imagen</th>
                            <th>Producto</th>
                            <th>Talle</th>
                            <th>Cantidad</th>
                            <th>Precio unitario</th>
                            <th>Subtotal</th>
                            <th>Acción</th>
                        </tr>

                    </thead>

                    <tbody>

                    <?php while ($fila = mysqli_fetch_assoc($resultado)) { ?>

                        <?php

                        $subtotal =
                            $fila["precio_unitario"] *
                            $fila["cantidad"];

                        $total += $subtotal;

                        ?>

                        <tr>

                            <td>

                                <img
                                    src="<?php echo htmlspecialchars($fila["imagen"]); ?>"
                                    alt="<?php echo htmlspecialchars($fila["nombre_producto"]); ?>"
                                    width="90"
                                    height="90"
                                    style="object-fit:cover; border-radius:10px;"
                                >

                            </td>

                            <td>
                                <?php echo htmlspecialchars($fila["nombre_producto"]); ?>
                            </td>

                            <td>
                                <?php echo htmlspecialchars($fila["nombre_talle"]); ?>
                            </td>

                            <td>
                                <?php echo (int) $fila["cantidad"]; ?>
                            </td>

                            <td>

                                $<?php echo number_format(
                                    $fila["precio_unitario"],
                                    0,
                                    ",",
                                    "."
                                ); ?>

                            </td>

                            <td>

                                $<?php echo number_format(
                                    $subtotal,
                                    0,
                                    ",",
                                    "."
                                ); ?>

                            </td>

                            <td>

                                <a
                                    href="quitar_carrito.php?id_detalle=<?php echo $fila["id_detalle"]; ?>"
                                    class="btn btn-danger btn-sm"
                                    onclick="return confirm('¿Querés quitar este producto del carrito?');"
                                >
                                    Quitar
                                </a>

                            </td>

                        </tr>

                    <?php } ?>

                    </tbody>

                </table>

            </div>

            <div class="text-end mt-4">

                <h3>
                    Total:
                    $<?php echo number_format(
                        $total,
                        0,
                        ",",
                        "."
                    ); ?>
                </h3>

            </div>

            <div class="d-flex justify-content-between mt-4">

                <a
                    href="tienda.php"
                    class="btn btn-secondary"
                >
                    ← Seguir comprando
                </a>

                <a
                    href="pagar_compra.php"
                    class="btn btn-success"
                >
                    Finalizar compra
                </a>

            </div>

        <?php } else { ?>

            <div class="alert alert-info text-center">

                <h4>Tu carrito está vacío</h4>

                <p>
                    Todavía no agregaste productos.
                </p>

                <a
                    href="tienda.php"
                    class="btn btn-dark"
                >
                    Ir a la tienda
                </a>

            </div>

        <?php } ?>

    </div>

</div>

</body>

</html>