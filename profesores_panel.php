<?php
session_start();

if (!isset($_SESSION['id_profesor'])) {
    header("Location: alumnos.php");
    exit();
}

$nombreProfesor = $_SESSION['nombre_profesor'] ?? 'Profesor';
$apellidoProfesor = $_SESSION['apellido_profesor'] ?? '';
?>

<!DOCTYPE html>
<html lang="es">
<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Panel Profesor</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link
        rel="preconnect"
        href="https://fonts.googleapis.com"
    >

    <link
        rel="preconnect"
        href="https://fonts.gstatic.com"
        crossorigin
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
            color:var(--negro);
            font-family:'Montserrat', sans-serif;
        }

        /* NAVBAR */

        .navbar{
            background:#111;
            padding:15px 0;
        }

        .navbar-brand{
            color:var(--rosa) !important;
            font-family:'Anton', sans-serif;
            font-size:25px;
            letter-spacing:1px;
        }

        .navbar-text{
            color:white;
            font-weight:700;
        }

        .btn-cerrar{
            border:1px solid white;
            color:white;
            border-radius:25px;
            padding:8px 18px;
            text-decoration:none;
            font-weight:700;
            transition:.3s;
        }

        .btn-cerrar:hover{
            background:var(--rosa);
            border-color:var(--rosa);
            color:#111;
        }

        /* CONTENEDOR */

        .panel-profesor{
            width:92%;
            max-width:1200px;
            margin:105px auto 60px;
        }

        /* HERO */

        .hero-profesor{
            display:grid;
            grid-template-columns:1.1fr .9fr;
            gap:28px;
            margin-bottom:35px;
        }

        .hero-texto{
            background:white;
            border-radius:32px;
            padding:50px;
            box-shadow:0 15px 45px rgba(0,0,0,.09);
            display:flex;
            flex-direction:column;
            justify-content:center;
            position:relative;
            overflow:hidden;
        }

        .hero-texto::before{
            content:"";
            position:absolute;
            width:220px;
            height:220px;
            border-radius:50%;
            background:rgba(244,201,214,.40);
            top:-90px;
            right:-70px;
        }

        .hero-texto > *{
            position:relative;
            z-index:1;
        }

        .subtitulo{
            color:var(--rosa-fuerte);
            font-size:13px;
            font-weight:900;
            letter-spacing:3px;
            margin-bottom:10px;
        }

        .hero-texto h1{
            font-family:'Anton', sans-serif;
            font-size:65px;
            line-height:1;
            margin-bottom:20px;
        }

        .hero-texto h1 span{
            color:var(--rosa-fuerte);
        }

        .hero-texto p{
            color:#555;
            font-size:17px;
            line-height:1.7;
            max-width:570px;
            margin-bottom:0;
        }

        .hero-imagen{
            min-height:390px;
            background-image:
                linear-gradient(
                    rgba(17,17,17,.10),
                    rgba(17,17,17,.45)
                ),
                url("https://i.ibb.co/fVGYvHNd/descarga-9.jpg");
            background-size:cover;
            background-position:center;
            border-radius:32px;
            box-shadow:0 15px 45px rgba(0,0,0,.12);
            position:relative;
            overflow:hidden;
        }

        .hero-imagen-texto{
            position:absolute;
            left:30px;
            right:30px;
            bottom:30px;
            background:rgba(255,255,255,.88);
            padding:22px;
            border-radius:20px;
            backdrop-filter:blur(6px);
        }

        .hero-imagen-texto h3{
            font-family:'Anton', sans-serif;
            font-size:28px;
            margin-bottom:5px;
        }

        .hero-imagen-texto p{
            margin:0;
            color:#555;
            font-size:14px;
        }

        /* OPCIONES */

        .titulo-seccion{
            font-family:'Anton', sans-serif;
            font-size:42px;
            margin-bottom:24px;
        }

        .opciones-profesor{
            display:grid;
            grid-template-columns:repeat(3, 1fr);
            gap:25px;
        }

        .opcion-card{
            background:white;
            border-radius:28px;
            padding:30px;
            min-height:270px;
            box-shadow:0 12px 30px rgba(0,0,0,.08);
            text-decoration:none;
            color:#111;
            transition:.3s;
            position:relative;
            overflow:hidden;
            display:flex;
            flex-direction:column;
        }

        .opcion-card::after{
            content:"";
            position:absolute;
            width:125px;
            height:125px;
            border-radius:50%;
            background:rgba(244,201,214,.40);
            top:-40px;
            right:-40px;
        }

        .opcion-card:hover{
            color:#111;
            transform:translateY(-8px);
            box-shadow:0 18px 40px rgba(0,0,0,.13);
        }

        .opcion-card.destacada{
            background:linear-gradient(135deg,#fff,#f4c9d6);
        }

        .numero{
            font-family:'Anton', sans-serif;
            color:var(--rosa-fuerte);
            font-size:45px;
            line-height:1;
            position:relative;
            z-index:1;
        }

        .opcion-card h2{
            font-family:'Anton', sans-serif;
            font-size:34px;
            margin:35px 0 12px;
            position:relative;
            z-index:1;
        }

        .opcion-card p{
            color:#666;
            line-height:1.6;
            margin-bottom:25px;
            position:relative;
            z-index:1;
        }

        .boton-opcion{
            display:inline-block;
            margin-top:auto;
            width:max-content;
            background:#111;
            color:white;
            padding:11px 21px;
            border-radius:25px;
            font-size:14px;
            font-weight:800;
            position:relative;
            z-index:1;
        }

        .opcion-card:hover .boton-opcion{
            background:var(--rosa-fuerte);
        }

        /* MENSAJE FINAL */

        .mensaje-profesor{
            margin-top:35px;
            background:#111;
            color:white;
            border-radius:28px;
            padding:35px;
            display:flex;
            justify-content:space-between;
            align-items:center;
            gap:25px;
        }

        .mensaje-profesor h3{
            font-family:'Anton', sans-serif;
            font-size:32px;
            margin-bottom:6px;
        }

        .mensaje-profesor p{
            margin:0;
            color:#ddd;
        }

        .mensaje-profesor span{
            color:var(--rosa);
        }

        @media(max-width:900px){

            .hero-profesor{
                grid-template-columns:1fr;
            }

            .opciones-profesor{
                grid-template-columns:1fr;
            }

            .hero-texto h1{
                font-size:50px;
            }

            .hero-imagen{
                min-height:320px;
            }
        }

        @media(max-width:600px){

            .panel-profesor{
                width:94%;
                margin-top:95px;
            }

            .hero-texto{
                padding:32px 25px;
            }

            .hero-texto h1{
                font-size:42px;
            }

            .mensaje-profesor{
                flex-direction:column;
                align-items:flex-start;
            }
        }

    </style>

</head>

<body>

<nav class="navbar fixed-top">

    <div class="container-fluid px-4">

        <a class="navbar-brand" href="index.php">
            Studio Gym Dance
        </a>

        <div class="d-flex align-items-center gap-3">

            <span class="navbar-text">
                <?php
                echo htmlspecialchars(
                    $nombreProfesor . " " . $apellidoProfesor
                );
                ?>
            </span>

            <a href="profesores.php" class="btn-cerrar">
                Cerrar sesión
            </a>

        </div>

    </div>

</nav>

<main class="panel-profesor">

    <section class="hero-profesor">

        <div class="hero-texto">

            <span class="subtitulo">
                PANEL DEL PROFESOR
            </span>

            <h1>
                ¡HOLA,
                <span>
                    <?php
                    echo strtoupper(
                        htmlspecialchars($nombreProfesor)
                    );
                    ?>
                </span>!
            </h1>

            <p>
                Desde este espacio podés administrar tus clases,
                registrar la asistencia de tus alumnos y compartir
                materiales para acompañarlos en su aprendizaje.
            </p>

        </div>

        <div class="hero-imagen">

            <div class="hero-imagen-texto">

                <h3>
                    Inspirá a través de la danza
                </h3>

                <p>
                    Organizá tus clases y acompañá el crecimiento de tus alumnos.
                </p>

            </div>

        </div>

    </section>

    <h2 class="titulo-seccion">
        Mis herramientas
    </h2>

    <section class="opciones-profesor">

        <a href="subir_material.php" class="opcion-card destacada">

            <span class="numero">
                01
            </span>

            <h2>
                Subir material
            </h2>

            <p>
                Compartí archivos, ejercicios, coreografías y contenido
                complementario para tus clases.
            </p>

            <span class="boton-opcion">
                Subir contenido →
            </span>

        </a>

        <a href="registrar_asistencia.php" class="opcion-card">

            <span class="numero">
                02
            </span>

            <h2>
                Registrar asistencia
            </h2>

            <p>
                Marcá la asistencia de los alumnos inscriptos en cada una
                de tus clases.
            </p>

            <span class="boton-opcion">
                Tomar asistencia →
            </span>

        </a>

        <a href="ver_alumnos.php" class="opcion-card">

            <span class="numero">
                03
            </span>

            <h2>
                Ver alumnos
            </h2>

            <p>
                Consultá los alumnos que están inscriptos en las clases
                que tenés asignadas.
            </p>

            <span class="boton-opcion">
                Ver listado →
            </span>

        </a>

    </section>

    <section class="mensaje-profesor">

        <div>

            <h3>
                Enseñar también es
                <span>inspirar.</span>
            </h3>

            <p>
                Cada clase es una oportunidad para acompañar,
                motivar y hacer crecer a tus alumnos.
            </p>

        </div>

    </section>

</main>

</body>
</html>