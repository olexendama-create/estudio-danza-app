<?php
session_start();
include("conexion.php");

if(!isset($_SESSION['id_alumno'])){
    header("Location: alumnos.php");
    exit();
}

$id_alumno = $_SESSION['id_alumno'];

$sql = "SELECT
            p.nombre_producto,
            cd.cantidad,
            cd.precio_unitario
        FROM carrito c
        JOIN carrito_detalle cd
        ON c.id_carrito = cd.id_carrito
        JOIN productos p
        ON cd.id_producto = p.id_producto
        WHERE c.id_alumno = '$id_alumno'
        AND c.estado = 'pendiente'";

$resultado = mysqli_query($conexion, $sql);

if(mysqli_num_rows($resultado) == 0){
    header("Location: carrito.php");
    exit();
}

$total = 0;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Pago de compra</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Anton&family=Montserrat:wght@400;500;700;800&display=swap"
          rel="stylesheet">

    <style>
        :root{
            --fondo:#f6f4ee;
            --rosa:#f4c9d6;
            --rosa-fuerte:#e86b98;
            --negro:#111;
        }

        *{
            box-sizing:border-box;
        }

        body{
            margin:0;
            min-height:100vh;
            background:
                radial-gradient(#e8e4d8 28%, transparent 28%);
            background-size:50px 50px;
            background-color:var(--fondo);
            font-family:'Montserrat', sans-serif;
            display:flex;
            justify-content:center;
            align-items:center;
            padding:40px 20px;
        }

        .checkout{
            width:100%;
            max-width:1100px;
            display:grid;
            grid-template-columns:.9fr 1.1fr;
            gap:25px;
        }

        .resumen{
            background:linear-gradient(135deg,#111,#2c2c2c);
            color:white;
            border-radius:30px;
            padding:40px;
            box-shadow:0 15px 40px rgba(0,0,0,.15);
        }

        .resumen small{
            color:var(--rosa);
            font-weight:800;
            letter-spacing:2px;
        }

        .resumen h1{
            font-family:'Anton', sans-serif;
            font-size:48px;
            margin:12px 0 25px;
        }

        .item-compra{
            border-bottom:1px solid rgba(255,255,255,.15);
            padding:14px 0;
        }

        .item-compra:last-child{
            border-bottom:none;
        }

        .item-compra p{
            margin:0;
        }

        .item-compra span{
            color:#ddd;
            font-size:14px;
        }

        .total{
            margin-top:25px;
            font-family:'Anton', sans-serif;
            font-size:42px;
            color:var(--rosa);
        }

        .formulario{
            background:white;
            border-radius:30px;
            padding:40px;
            box-shadow:0 15px 40px rgba(0,0,0,.10);
        }

        .formulario h2{
            font-family:'Anton', sans-serif;
            font-size:40px;
            margin-bottom:25px;
        }

        .form-label{
            font-size:13px;
            font-weight:800;
            text-transform:uppercase;
        }

        .form-select,
        .form-control{
            border-radius:15px;
            padding:13px;
        }

        .transferencia-box{
            background:#fdf2f6;
            border:1px solid var(--rosa);
            border-radius:20px;
            padding:25px;
            text-align:center;
            margin-bottom:20px;
        }

        .qr-transferencia{
            width:180px;
            max-width:100%;
            display:block;
            margin:15px auto;
            border-radius:14px;
            border:8px solid white;
        }

        .aviso{
            background:#fdf2f6;
            border-left:5px solid var(--rosa-fuerte);
            padding:14px;
            margin:20px 0;
            font-size:13px;
        }

        .btn-pagar{
            width:100%;
            background:var(--negro);
            color:white;
            border:none;
            border-radius:25px;
            padding:14px;
            font-weight:800;
        }

        .btn-pagar:hover{
            background:var(--rosa-fuerte);
        }

        .cancelar{
            display:block;
            text-align:center;
            margin-top:16px;
            color:#111;
            text-decoration:none;
            font-weight:700;
        }

        @media(max-width:800px){
            .checkout{
                grid-template-columns:1fr;
            }
        }
    </style>
</head>

<body>

<div class="checkout">

    <section class="resumen">

        <small>RESUMEN DE COMPRA</small>

        <h1>Tu pedido</h1>

        <?php while($fila = mysqli_fetch_assoc($resultado)){ ?>

            <?php
            $subtotal =
                $fila['cantidad'] *
                $fila['precio_unitario'];

            $total += $subtotal;
            ?>

            <div class="item-compra">

                <p>
                    <?php echo htmlspecialchars($fila['nombre_producto']); ?>
                </p>

                <span>
                    Cantidad:
                    <?php echo $fila['cantidad']; ?>
                    ·
                    $<?php echo number_format(
                        $subtotal,
                        0,
                        ',',
                        '.'
                    ); ?>
                </span>

            </div>

        <?php } ?>

        <div class="total">
            Total:
            $<?php echo number_format(
                $total,
                0,
                ',',
                '.'
            ); ?>
        </div>

    </section>

    <section class="formulario">

        <h2>Confirmar pago</h2>

        <form action="procesar_pago_compra.php" method="POST">

            <div class="mb-4">

                <label class="form-label">
                    Método de pago
                </label>

                <select
                    name="metodo_pago"
                    id="metodoPago"
                    class="form-select"
                    required
                >
                    <option value="">Seleccionar método</option>
                    <option value="Tarjeta de débito">
                        Tarjeta de débito
                    </option>
                    <option value="Tarjeta de crédito">
                        Tarjeta de crédito
                    </option>
                    <option value="Transferencia">
                        Transferencia
                    </option>
                    <option value="Efectivo">
                        Efectivo en recepción
                    </option>
                </select>

            </div>

            <div id="datosTarjeta" style="display:none;">

                <div class="mb-3">
                    <label class="form-label">
                        Nombre del titular
                    </label>

                    <input
                        type="text"
                        class="form-control"
                        placeholder="Nombre y apellido"
                    >
                </div>

                <div class="mb-3">
                    <label class="form-label">
                        Número de tarjeta
                    </label>

                    <input
                        type="text"
                        class="form-control"
                        placeholder="0000 0000 0000 0000"
                        maxlength="19"
                    >
                </div>

                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            Vencimiento
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            placeholder="MM/AA"
                            maxlength="5"
                        >
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            Código de seguridad
                        </label>

                        <input
                            type="password"
                            class="form-control"
                            placeholder="123"
                            maxlength="4"
                        >
                    </div>

                </div>

            </div>

            <div id="datosTransferencia" style="display:none;">

                <div class="transferencia-box">

                    <h4>Pago por transferencia</h4>

                    <p>
                        Escaneá el QR o transferí al alias:
                    </p>

                    <img
                        src="qr-transferencia.png"
                        alt="QR de transferencia"
                        class="qr-transferencia"
                    >

                    <p>
                        Alias:
                        <strong>STUDIO.GYM.DANCE</strong>
                    </p>

                </div>

            </div>

            <div class="aviso">
                Esta compra es una simulación académica. No ingreses datos reales.
            </div>

            <button type="submit" class="btn-pagar">
                Confirmar pago
            </button>

            <a href="carrito.php" class="cancelar">
                Volver al carrito
            </a>

        </form>

    </section>

</div>

<script>
const metodoPago = document.getElementById("metodoPago");
const datosTarjeta = document.getElementById("datosTarjeta");
const datosTransferencia = document.getElementById("datosTransferencia");

metodoPago.addEventListener("change", function(){

    datosTarjeta.style.display = "none";
    datosTransferencia.style.display = "none";

    if(
        this.value === "Tarjeta de débito" ||
        this.value === "Tarjeta de crédito"
    ){
        datosTarjeta.style.display = "block";
    }

    if(this.value === "Transferencia"){
        datosTransferencia.style.display = "block";
    }

});
</script>

</body>
</html>