<?php
session_start();

if (!isset($_SESSION["id_alumno"])) {
    header("Location: alumnos.php");
    exit();
}

$tipo = isset($_GET["tipo"]) ? $_GET["tipo"] : "pack";

if ($tipo == "tienda") {

    $tituloPrimeraParte = "COMPRA";
    $tituloSegundaParte = "APROBADA";

    $textoPrincipal = "Tu compra fue registrada correctamente.";

    $detalleTitulo = "Pedido confirmado";

    $detalleTexto = "Podés retirar tus productos en la recepción del estudio.";

    $avisoTitulo = "Tu compra ya está lista";

    $avisoTexto = "El pedido quedó registrado y el stock fue actualizado correctamente.";

    $botonPrincipalTexto = "Volver a la tienda";
    $botonPrincipalLink = "tienda.php";

    $botonSecundarioTexto = "Volver a mi panel";
    $botonSecundarioLink = "panel_alumno.php";

} else {

    $tituloPrimeraParte = "PAGO";
    $tituloSegundaParte = "APROBADO";

    $textoPrincipal = "Tu pack fue adquirido correctamente y ya está activo.";

    $detalleTitulo = "Pack activado";

    $detalleTexto = "Ya podés inscribirte a las clases disponibles.";

    $avisoTitulo = "Tu pack ya está disponible";

    $avisoTexto = "Cada vez que te inscribas en una clase, se descontará automáticamente una clase de tu pack.";

    $botonPrincipalTexto = "Volver a mi panel";
    $botonPrincipalLink = "panel_alumno.php";

    $botonSecundarioTexto = "Ver clases disponibles";
    $botonSecundarioLink = "disciplinas_panel.php?ver_horarios=1#calendario";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        <?php echo $tituloPrimeraParte . " " . $tituloSegundaParte; ?>
    </title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link
        href="https://fonts.googleapis.com/css2?family=Anton&family=Montserrat:wght@400;500;700;800;900&display=swap"
        rel="stylesheet"
    >

    <style>

        :root{
            --fondo:#f6f4ee;
            --rosa:#f4c9d6;
            --rosa-fuerte:#e86b98;
            --negro:#111111;
            --blanco:#ffffff;
            --gris:#666666;
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
            color:var(--negro);
            display:flex;
            align-items:center;
            justify-content:center;
            padding:40px 20px;
        }

        .contenedor-exito{
            width:100%;
            max-width:1050px;
            display:grid;
            grid-template-columns:.8fr 1.2fr;
            gap:25px;
        }

        .lado-oscuro{
            background:linear-gradient(135deg,#111,#2b2b2b);
            color:white;
            border-radius:30px;
            padding:45px;
            box-shadow:0 15px 40px rgba(0,0,0,.15);
            display:flex;
            flex-direction:column;
            justify-content:center;
            position:relative;
            overflow:hidden;
        }

        .lado-oscuro::after{
            content:"";
            position:absolute;
            width:210px;
            height:210px;
            border-radius:50%;
            background:rgba(244,201,214,.17);
            top:-80px;
            right:-75px;
        }

        .lado-oscuro > *{
            position:relative;
            z-index:1;
        }

        .lado-oscuro small{
            color:var(--rosa);
            font-weight:900;
            letter-spacing:3px;
        }

        .lado-oscuro h1{
            font-family:'Anton', sans-serif;
            font-size:58px;
            line-height:1;
            margin:15px 0 20px;
        }

        .lado-oscuro h1 span{
            color:var(--rosa);
        }

        .lado-oscuro p{
            color:#dddddd;
            line-height:1.7;
            margin:0;
        }

        .detalle-operacion{
            margin-top:28px;
            padding:19px;
            border:1px solid rgba(255,255,255,.20);
            border-radius:18px;
        }

        .detalle-operacion strong{
            display:block;
            color:var(--rosa);
            margin-bottom:5px;
        }

        .tarjeta-exito{
            background:white;
            border-radius:30px;
            padding:50px;
            box-shadow:0 15px 40px rgba(0,0,0,.10);
            position:relative;
            overflow:hidden;
        }

        .tarjeta-exito::before{
            content:"";
            position:absolute;
            width:150px;
            height:150px;
            border-radius:50%;
            background:rgba(244,201,214,.35);
            left:-55px;
            bottom:-55px;
        }

        .contenido-exito{
            position:relative;
            z-index:1;
        }

        .icono-exito{
            width:92px;
            height:92px;
            border-radius:50%;
            background:var(--rosa);
            display:flex;
            align-items:center;
            justify-content:center;
            font-size:48px;
            margin-bottom:25px;
            box-shadow:0 10px 25px rgba(232,107,152,.20);
        }

        .tarjeta-exito h2{
            font-family:'Anton', sans-serif;
            font-size:48px;
            margin-bottom:15px;
        }

        .tarjeta-exito h2 span{
            color:var(--rosa-fuerte);
        }

        .texto-principal{
            font-size:18px;
            line-height:1.7;
            color:#555;
            margin-bottom:25px;
        }

        .aviso-activo{
            background:#fdf2f6;
            border-left:5px solid var(--rosa-fuerte);
            border-radius:15px;
            padding:18px 20px;
            margin-bottom:28px;
        }

        .aviso-activo strong{
            display:block;
            color:#111;
            margin-bottom:5px;
        }

        .aviso-activo p{
            color:#666;
            margin:0;
            font-size:14px;
        }

        .botones-exito{
            display:flex;
            gap:14px;
            flex-wrap:wrap;
        }

        .btn-panel,
        .btn-secundario{
            display:inline-block;
            border-radius:26px;
            padding:13px 24px;
            text-decoration:none;
            font-weight:900;
            transition:.3s;
        }

        .btn-panel{
            background:var(--negro);
            color:white;
        }

        .btn-panel:hover{
            background:var(--rosa-fuerte);
            color:white;
            transform:translateY(-2px);
        }

        .btn-secundario{
            background:var(--rosa);
            color:var(--negro);
        }

        .btn-secundario:hover{
            background:var(--negro);
            color:white;
            transform:translateY(-2px);
        }

        @media(max-width:800px){

            .contenedor-exito{
                grid-template-columns:1fr;
            }

            .lado-oscuro,
            .tarjeta-exito{
                padding:35px 28px;
            }

            .lado-oscuro h1{
                font-size:48px;
            }

            .tarjeta-exito h2{
                font-size:40px;
            }
        }

        @media(max-width:500px){

            .botones-exito{
                flex-direction:column;
            }

            .btn-panel,
            .btn-secundario{
                width:100%;
                text-align:center;
            }
        }

    </style>

</head>

<body>

<div class="contenedor-exito">

    <section class="lado-oscuro">

        <small>
            STUDIO GYM DANCE
        </small>

        <h1>

            <?php echo $tituloPrimeraParte; ?>

            <span>

                <?php echo $tituloSegundaParte; ?>

            </span>

        </h1>

        <p>

            <?php echo $textoPrincipal; ?>

        </p>

        <div class="detalle-operacion">

            <strong>

                <?php echo $detalleTitulo; ?>

            </strong>

            <?php echo $detalleTexto; ?>

        </div>

    </section>


    <section class="tarjeta-exito">

        <div class="contenido-exito">

            <div class="icono-exito">
                ✓
            </div>

            <h2>

                ¡TODO
                <span>LISTO!</span>

            </h2>

            <p class="texto-principal">

                <?php echo $textoPrincipal; ?>

            </p>

            <div class="aviso-activo">

                <strong>

                    <?php echo $avisoTitulo; ?>

                </strong>

                <p>

                    <?php echo $avisoTexto; ?>

                </p>

            </div>

            <div class="botones-exito">

                <a
                    href="<?php echo $botonPrincipalLink; ?>"
                    class="btn-panel"
                >

                    <?php echo $botonPrincipalTexto; ?>

                </a>

                <a
                    href="<?php echo $botonSecundarioLink; ?>"
                    class="btn-secundario"
                >

                    <?php echo $botonSecundarioTexto; ?>

                </a>

            </div>

        </div>

    </section>

</div>

</body>
</html>