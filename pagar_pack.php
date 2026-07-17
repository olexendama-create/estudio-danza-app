<?php
session_start();
include("conexion.php");

if (!isset($_SESSION["id_alumno"])) {
    header("Location: alumnos.php");
    exit();
}

if (!isset($_GET["id_pack"]) || $_GET["id_pack"] == "") {
    header("Location: packs.php");
    exit();
}

$id_pack = $_GET["id_pack"];

$sqlPack = "SELECT * FROM packs
            WHERE id_pack='$id_pack'";

$resultadoPack = mysqli_query($conexion, $sqlPack);

if (mysqli_num_rows($resultadoPack) == 0) {
    die("El pack seleccionado no existe.");
}

$pack = mysqli_fetch_assoc($resultadoPack);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Pago del pack</title>

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
            align-items:center;
            justify-content:center;
            padding:40px 20px;
        }

        .pago-contenedor{
            width:100%;
            max-width:1050px;
            display:grid;
            grid-template-columns:.8fr 1.2fr;
            gap:25px;
        }

        .resumen-compra{
            background:linear-gradient(135deg,#111,#2a2a2a);
            color:white;
            border-radius:30px;
            padding:45px;
            display:flex;
            flex-direction:column;
            justify-content:center;
            box-shadow:0 15px 40px rgba(0,0,0,.15);
        }

        .resumen-compra small{
            color:var(--rosa);
            font-weight:800;
            letter-spacing:2px;
        }

        .resumen-compra h1{
            font-family:'Anton', sans-serif;
            font-size:50px;
            margin:12px 0 15px;
        }

        .resumen-compra h1 span{
            color:var(--rosa);
        }

        .resumen-compra p{
            color:#ddd;
        }

        .cantidad-pack{
            margin-top:25px;
            padding:18px;
            border:1px solid rgba(255,255,255,.2);
            border-radius:18px;
        }

        .precio-pack{
            font-family:'Anton', sans-serif;
            font-size:42px;
            color:var(--rosa);
            margin-top:18px;
        }

        .formulario-pago{
            background:white;
            border-radius:30px;
            padding:45px;
            box-shadow:0 15px 40px rgba(0,0,0,.1);
        }

        .formulario-pago h2{
            font-family:'Anton', sans-serif;
            font-size:40px;
            margin-bottom:25px;
        }

        .form-label{
            font-size:13px;
            font-weight:800;
            text-transform:uppercase;
        }

        .form-control,
        .form-select{
            padding:13px;
            border-radius:15px;
            border:1px solid #ccc;
        }

        .form-control:focus,
        .form-select:focus{
            border-color:var(--rosa-fuerte);
            box-shadow:0 0 0 .2rem rgba(232,107,152,.15);
        }

        .aviso-simulacion{
            background:#fdf2f6;
            border-left:5px solid var(--rosa-fuerte);
            padding:14px;
            margin:20px 0;
            font-size:13px;
        }

        .btn-pagar{
            width:100%;
            background:#111;
            color:white;
            border:none;
            border-radius:25px;
            padding:14px;
            font-weight:800;
            transition:.3s;
        }

        .btn-pagar:hover{
            background:var(--rosa-fuerte);
        }

        .btn-cancelar{
            display:block;
            text-align:center;
            color:#111;
            text-decoration:none;
            margin-top:16px;
            font-weight:700;
        }

        .transferencia-box{
    background:#fdf2f6;
    border:1px solid #f4c9d6;
    border-radius:20px;
    padding:25px;
    text-align:center;
    margin-bottom:20px;
}

.transferencia-box h4{
    font-family:'Anton', sans-serif;
    font-size:28px;
    margin-bottom:12px;
}

.qr-transferencia{
    width:190px;
    max-width:100%;
    margin:15px auto;
    display:block;
    border-radius:15px;
    border:8px solid white;
    box-shadow:0 8px 20px rgba(0,0,0,.1);
}

.alias-transferencia{
    margin-top:15px;
    font-size:16px;
}

        @media(max-width:800px){
            .pago-contenedor{
                grid-template-columns:1fr;
            }
        }
    </style>
</head>

<body>

<div class="pago-contenedor">

    <section class="resumen-compra">

        <small>RESUMEN DE COMPRA</small>

        <h1>
            <?php echo htmlspecialchars($pack["nombre_pack"]); ?>
        </h1>

        <p>
            Activá tu pack y empezá a disfrutar tus clases.
        </p>

        <div class="cantidad-pack">
            <?php echo $pack["cantidad_clases"]; ?>
            <?php echo $pack["cantidad_clases"] == 1 ? "clase disponible" : "clases disponibles"; ?>
        </div>

        <div class="precio-pack">
            $<?php echo number_format(
                $pack["precio_actual"],
                0,
                ",",
                "."
            ); ?>
        </div>

    </section>

    <section class="formulario-pago">

        <h2>Confirmar pago</h2>

        <form action="procesar_pago_pack.php" method="POST">

            <input
                type="hidden"
                name="id_pack"
                value="<?php echo $pack["id_pack"]; ?>"
            >

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
                    <option value="Tarjeta de débito">Tarjeta de débito</option>
                    <option value="Tarjeta de crédito">Tarjeta de crédito</option>
                    <option value="Transferencia">Transferencia</option>
                    <option value="Efectivo">Efectivo en recepción</option>
                </select>

            </div>

            <div id="datosTarjeta" style="display:none;">

                <div class="mb-3">

                    <label class="form-label">
                        Nombre del titular
                    </label>

                    <input
                        type="text"
                        name="titular"
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
                        name="numero_tarjeta"
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
                            name="vencimiento"
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
                            name="codigo_seguridad"
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
            Escaneá el código QR o transferí al alias:
        </p>

        <img
            src="qr-transferencia.png"
            alt="Código QR para transferencia"
            class="qr-transferencia"
        >

        <p class="alias-transferencia">
            Alias: <strong>STUDIO.GYM.DANCE</strong>
        </p>

        <p class="small text-muted">
            Luego de realizar la transferencia, tocá “Confirmar pago”.
        </p>

    </div>

</div>

            <div class="aviso-simulacion">
                Esta compra es una simulación académica. No ingreses datos reales.
            </div>

            <button type="submit" class="btn-pagar">
                Confirmar pago
            </button>

            <a href="packs.php" class="btn-cancelar">
                Cancelar compra
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