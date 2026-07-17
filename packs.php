<?php
session_start();
include("conexion.php");

if (!isset($_SESSION['id_alumno'])) {
    header("Location: alumnos.php");
    exit();
}

$sql = "SELECT * FROM packs ORDER BY cantidad_clases ASC";
$resultado = mysqli_query($conexion, $sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Packs de clases</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Anton&family=Montserrat:wght@400;500;700;800&display=swap"
          rel="stylesheet">

    <style>
        :root{
            --fondo:#f6f4ee;
            --rosa:#f4c9d6;
            --rosa-fuerte:#e86b98;
            --negro:#111;
            --blanco:#fff;
            --gris:#666;
        }

        *{
            box-sizing:border-box;
        }

        body{
            margin:0;
            background:
                radial-gradient(#e8e4d8 28%, transparent 28%);
            background-size:50px 50px;
            background-color:var(--fondo);
            color:var(--negro);
            font-family:'Montserrat', sans-serif;
        }

        .packs-contenedor{
            width:92%;
            max-width:1200px;
            margin:70px auto;
        }

        .encabezado-packs{
            display:grid;
            grid-template-columns:1.2fr .8fr;
            gap:30px;
            margin-bottom:45px;
            align-items:center;
        }

        .encabezado-texto{
            background:white;
            border-radius:30px;
            padding:45px;
            box-shadow:0 12px 35px rgba(0,0,0,.08);
        }

        .encabezado-texto small{
            color:var(--rosa-fuerte);
            font-weight:800;
            letter-spacing:2px;
        }

        .encabezado-texto h1{
            font-family:'Anton', sans-serif;
            font-size:64px;
            line-height:1;
            margin:12px 0 20px;
        }

        .encabezado-texto h1 span{
            color:var(--rosa-fuerte);
        }

        .encabezado-texto p{
            color:#555;
            line-height:1.7;
            margin:0;
        }

        .encabezado-imagen{
            min-height:300px;
            border-radius:30px;
            overflow:hidden;
            box-shadow:0 12px 35px rgba(0,0,0,.08);
        }

        .encabezado-imagen img{
            width:100%;
            height:100%;
            min-height:300px;
            object-fit:cover;
            filter:grayscale(100%);
        }

        .titulo-seccion{
            font-family:'Anton', sans-serif;
            font-size:44px;
            margin-bottom:25px;
        }

        .fila-packs{
            display:grid;
            grid-template-columns:repeat(4, 1fr);
            gap:25px;
        }

        .pack-card{
            position:relative;
            background:white;
            border-radius:28px;
            padding:30px 25px;
            box-shadow:0 12px 30px rgba(0,0,0,.08);
            transition:.3s;
            overflow:hidden;
            min-height:360px;
            display:flex;
            flex-direction:column;
        }

        .pack-card:hover{
            transform:translateY(-8px);
            box-shadow:0 18px 40px rgba(0,0,0,.13);
        }

        .pack-card.destacado{
            background:linear-gradient(135deg, #fff, #f4c9d6);
        }

        .pack-card::before{
            content:"";
            position:absolute;
            width:120px;
            height:120px;
            border-radius:50%;
            background:rgba(244,201,214,.35);
            right:-35px;
            top:-35px;
        }

        .etiqueta{
            display:inline-block;
            width:max-content;
            background:#111;
            color:white;
            padding:6px 13px;
            border-radius:20px;
            font-size:12px;
            font-weight:800;
            margin-bottom:20px;
        }

        .pack-card h2{
            font-family:'Anton', sans-serif;
            font-size:34px;
            margin-bottom:12px;
            position:relative;
            z-index:1;
        }

        .cantidad{
            color:var(--rosa-fuerte);
            font-weight:800;
            font-size:18px;
            margin-bottom:15px;
        }

        .descripcion{
            color:#666;
            font-size:14px;
            line-height:1.6;
            margin-bottom:20px;
        }

        .precio{
            font-family:'Anton', sans-serif;
            font-size:38px;
            margin-top:auto;
            margin-bottom:18px;
        }

        .btn-pack{
            display:block;
            text-align:center;
            background:#111;
            color:white;
            text-decoration:none;
            padding:13px;
            border-radius:25px;
            font-weight:800;
            transition:.3s;
        }

        .btn-pack:hover{
            background:var(--rosa-fuerte);
            color:white;
        }

        .volver{
            margin-top:40px;
            text-align:center;
        }

        .volver a{
            color:#111;
            font-weight:700;
            text-decoration:none;
        }

        @media(max-width:992px){
            .encabezado-packs{
                grid-template-columns:1fr;
            }

            .fila-packs{
                grid-template-columns:repeat(2,1fr);
            }
        }

        @media(max-width:600px){
            .fila-packs{
                grid-template-columns:1fr;
            }

            .encabezado-texto h1{
                font-size:46px;
            }
        }
    </style>
</head>

<body>

<div class="packs-contenedor">

    <section class="encabezado-packs">

        <div class="encabezado-texto">

            <small>STUDIO GYM DANCE</small>

            <h1>
                ELEGÍ TU
                <span>PACK</span>
            </h1>

            <p>
                Elegí la cantidad de clases que mejor se adapte a vos.
                Una vez aprobado el pago, el pack quedará activo en tu panel.
            </p>

        </div>

        <div class="encabezado-imagen">
            <img src="https://i.ibb.co/fVGYvHNd/descarga-9.jpg"
                 alt="Clases de danza">
        </div>

    </section>

    <h2 class="titulo-seccion">
        Packs disponibles
    </h2>

    <div class="fila-packs">

        <?php
        $contador = 0;

        while($pack = mysqli_fetch_assoc($resultado)){
            $contador++;
        ?>

            <div class="pack-card <?php echo $contador == 3 ? 'destacado' : ''; ?>">

                <span class="etiqueta">
                    <?php echo $contador == 3 ? 'MÁS ELEGIDO' : 'PACK'; ?>
                </span>

                <h2>
                    <?php echo htmlspecialchars($pack['nombre_pack']); ?>
                </h2>

                <p class="cantidad">
                    <?php echo $pack['cantidad_clases']; ?>
                    <?php echo $pack['cantidad_clases'] == 1 ? 'clase' : 'clases'; ?>
                </p>

                <p class="descripcion">
                    Acceso a clases del estudio según la cantidad incluida en el pack.
                </p>

                <div class="precio">
                    $<?php echo number_format(
                        $pack['precio_actual'],
                        0,
                        ',',
                        '.'
                    ); ?>
                </div>

                <a
                    href="pagar_pack.php?id_pack=<?php echo $pack['id_pack']; ?>"
                    class="btn-pack"
                >
                    Elegir este pack
                </a>

            </div>

        <?php } ?>

    </div>

    <div class="volver">
        <a href="panel_alumno.php">
            ← Volver a mi panel
        </a>
    </div>

</div>

</body>
</html>