<?php
session_start();

include("conexion.php");

$sql = "SELECT * FROM categorias_disciplinas";
$resultado = mysqli_query($conexion, $sql);

if(!$resultado){
    die("Error al cargar las disciplinas: " . mysqli_error($conexion));
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

    <title>Disciplinas y Horarios</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    >

    <link
        href="https://fonts.googleapis.com/css2?family=Anton&family=Montserrat:wght@400;500;600;700;800;900&family=Playfair+Display:wght@400;500;600;700&display=swap"
        rel="stylesheet"
    >

    <link
        rel="stylesheet"
        href="style.css?v=1.7"
    >

    <style>

        :root{
            --rosa:#f4c9d6;
            --rosa-fuerte:#e86b98;
            --negro:#111111;
            --crema:#f8f4ef;
            --blanco:#ffffff;
            --gris:#666666;
        }

        *{
            box-sizing:border-box;
        }

        html{
            scroll-behavior:smooth;
        }

        body{
            margin:0;
            background:var(--crema);
            color:#222;
            font-family:"Montserrat", sans-serif;
        }

       

        .hero-disciplinas{
            position:relative;
            overflow:hidden;
            padding:135px 60px 85px;
            background:
                radial-gradient(
                    circle at 90% 10%,
                    rgba(244,201,214,.55),
                    transparent 26%
                ),
                var(--crema);
        }

        .hero-disciplinas::before{
            content:"";
            position:absolute;
            width:270px;
            height:270px;
            left:-120px;
            bottom:-150px;
            border-radius:50%;
            background:rgba(244,201,214,.28);
        }

        .hero-contenido{
            width:100%;
            max-width:1350px;
            display:grid;
            grid-template-columns:.85fr 1.15fr;
            align-items:center;
            gap:55px;
            position:relative;
            z-index:1;
            margin:auto;
        }

        .hero-texto{
            position:relative;
        }

        .hero-etiqueta{
            display:inline-flex;
            align-items:center;
            gap:9px;
            margin:0 0 18px;
            color:var(--rosa-fuerte);
            font-size:12px;
            font-weight:900;
            letter-spacing:3px;
            text-transform:uppercase;
        }

        .hero-etiqueta::before{
            content:"";
            width:40px;
            height:3px;
            border-radius:20px;
            background:var(--rosa-fuerte);
        }

        .hero-titulo{
            margin:0 0 25px;
            color:var(--negro);
            font-family:"Anton", sans-serif;
            font-size:78px;
            font-weight:400;
            line-height:.94;
            letter-spacing:.5px;
        }

        .hero-titulo span{
            color:var(--rosa-fuerte);
        }

        .hero-descripcion{
            max-width:520px;
            margin:0 0 32px;
            color:#5e5a57;
            font-size:17px;
            line-height:1.8;
        }

        .btn-horarios{
            display:inline-flex;
            align-items:center;
            justify-content:center;
            gap:9px;
            padding:14px 28px;
            border-radius:30px;
            background:var(--negro);
            color:white;
            font-size:14px;
            font-weight:900;
            text-decoration:none;
            box-shadow:0 10px 25px rgba(0,0,0,.16);
            transition:.3s;
        }

        .btn-horarios:hover{
            background:var(--rosa-fuerte);
            color:white;
            transform:translateY(-3px);
            box-shadow:0 15px 30px rgba(232,107,152,.28);
        }

        .hero-video-contenedor{
            position:relative;
            padding:12px;
            border-radius:33px;
            background:white;
            box-shadow:0 18px 50px rgba(0,0,0,.13);
        }

        .hero-video-contenedor::before{
            content:"";
            position:absolute;
            width:110px;
            height:110px;
            top:-25px;
            right:-25px;
            z-index:-1;
            border-radius:50%;
            background:var(--rosa);
        }

        .hero-video{
            width:100%;
            height:430px;
            display:block;
            border-radius:25px;
            object-fit:cover;
            background:#111;
        }

        .video-etiqueta{
            display:flex;
            align-items:center;
            gap:12px;
            position:absolute;
            left:30px;
            bottom:30px;
            padding:13px 20px;
            border-radius:30px;
            background:rgba(255,255,255,.91);
            color:#111;
            font-size:13px;
            font-weight:900;
            backdrop-filter:blur(7px);
            box-shadow:0 8px 25px rgba(0,0,0,.15);
        }

        .video-etiqueta i{
            color:var(--rosa-fuerte);
            font-size:20px;
        }

        

        .seccion-disciplinas{
            padding:75px 60px 95px;
            background:
                radial-gradient(#ebe6df 20%, transparent 20%);
            background-size:45px 45px;
            background-color:var(--crema);
        }

        .contenedor-disciplinas{
            width:100%;
            max-width:1250px;
            margin:auto;
        }

        .encabezado-disciplinas{
            display:flex;
            justify-content:space-between;
            align-items:flex-end;
            gap:30px;
            margin-bottom:35px;
        }

        .encabezado-disciplinas small{
            display:block;
            margin-bottom:8px;
            color:var(--rosa-fuerte);
            font-size:12px;
            font-weight:900;
            letter-spacing:3px;
        }

        .encabezado-disciplinas h2{
            margin:0;
            color:var(--negro);
            font-family:"Anton", sans-serif;
            font-size:52px;
            font-weight:400;
            text-transform:uppercase;
        }

        .encabezado-disciplinas h2 span{
            color:var(--rosa-fuerte);
        }

        .encabezado-disciplinas p{
            max-width:480px;
            margin:0;
            color:#666;
            font-size:14px;
            line-height:1.7;
        }

        .grilla-disciplinas{
            display:grid;
            grid-template-columns:repeat(4,1fr);
            gap:24px;
        }

        .card-disciplina{
            display:flex;
            flex-direction:column;
            position:relative;
            overflow:hidden;
            border:1px solid #eee8e0;
            border-radius:28px;
            background:white;
            box-shadow:0 12px 32px rgba(0,0,0,.08);
            transition:.3s;
        }

        .card-disciplina::after{
            content:"";
            position:absolute;
            width:120px;
            height:120px;
            top:-60px;
            right:-60px;
            border-radius:50%;
            background:rgba(244,201,214,.35);
            pointer-events:none;
        }

        .card-disciplina:hover{
            transform:translateY(-8px);
            border-color:var(--rosa);
            box-shadow:0 20px 42px rgba(0,0,0,.13);
        }

        .contenedor-img-disciplina{
            height:260px;
            overflow:hidden;
            background:#f4e4e9;
        }

        .img-disciplina{
            width:100%;
            height:100%;
            display:block;
            object-fit:cover;
            transition:.45s;
        }

        .card-disciplina:hover .img-disciplina{
            transform:scale(1.06);
        }

        .info-disciplina{
            display:flex;
            flex-direction:column;
            flex:1;
            padding:25px;
        }

        .tag-disciplina{
            display:inline-block;
            width:max-content;
            margin-bottom:10px;
            padding:6px 13px;
            border-radius:20px;
            background:#fdf0f5;
            color:var(--rosa-fuerte);
            font-size:10px;
            font-weight:900;
            letter-spacing:1.5px;
            text-transform:uppercase;
        }

        .info-disciplina h3{
            margin:0 0 12px;
            color:var(--negro);
            font-family:"Anton", sans-serif;
            font-size:29px;
            font-weight:400;
        }

        .info-disciplina p{
            margin:0;
            color:#666;
            font-size:13px;
            line-height:1.7;
        }

        

        .modal-horarios{
            position:fixed;
            z-index:9999;
            top:0;
            left:0;
            width:100%;
            height:100%;
            padding:25px;
            overflow:auto;
            background:rgba(0,0,0,.70);
        }

        .contenido-modal{
            width:95%;
            max-width:1250px;
            position:relative;
            margin:25px auto;
            padding:30px;
            border-radius:25px;
            background:#292929;
            box-shadow:0 20px 60px rgba(0,0,0,.45);
        }

        .calendario-modal{
            color:white;
        }

        .cerrar-modal{
            width:40px;
            height:40px;
            display:flex;
            align-items:center;
            justify-content:center;
            position:absolute;
            top:18px;
            right:18px;
            border-radius:50%;
            background:white;
            color:#111;
            font-size:20px;
            font-weight:900;
            text-decoration:none;
        }

        .cerrar-modal:hover{
            background:#f4c2f7;
            color:#111;
        }

        .titulo{
            margin:0 50px 5px;
            color:white;
            font-family:"Anton", sans-serif;
            font-size:35px;
            text-align:center;
        }

        .subtitulo-modal{
            margin-bottom:25px;
            color:#f4c2f7;
            text-align:center;
        }

        .calendarios{
            display:grid;
            grid-template-columns:90px repeat(6,1fr);
            gap:8px;
            overflow-x:auto;
        }

        .celda{
            min-width:120px;
            min-height:78px;
            padding:10px;
            border-radius:15px;
            color:#222;
            font-size:13px;
        }

        .encabezado{
            min-height:55px;
            display:flex;
            align-items:center;
            justify-content:center;
            background:#f4c2f7;
            color:#222;
            font-weight:900;
            text-align:center;
        }

        .hora{
            display:flex;
            align-items:center;
            justify-content:center;
            min-width:90px;
            background:rgba(255,255,255,.22);
            color:white;
            font-weight:900;
        }

        .clase{
            border:3px solid transparent;
            font-weight:800;
            cursor:pointer;
            box-shadow:0 6px 15px rgba(0,0,0,.18);
            transition:.2s;
        }

        .clase:hover{
            transform:scale(1.02);
        }

        .clase span{
            display:block;
            margin-top:5px;
            font-size:11px;
            font-weight:500;
        }

        .clase.seleccionada{
            border-color:white;
            background:green !important;
            color:white !important;
        }

        .vacia{
            background:rgba(255,255,255,.08);
        }

        .clasica{
            background:#ffd6e8;
        }

        .reggaeton{
            background:#ffc2f2;
        }

        .tap{
            background:#d9c2ff;
        }

        .latinos{
            background:#ffe0a8;
        }

        .arabe{
            background:#ffe7a8;
        }

        .urbano{
            background:#c9d6ff;
        }

        .femme{
            background:#ffb3d9;
        }

        .contemporaneo{
            background:#c7f0ff;
        }

        .heels{
            background:#ff9ecb;
        }

        .zona-inscripcion{
            display:flex;
            flex-direction:column;
            align-items:center;
            margin-top:28px;
        }

        .btn-inscribirse{
            min-width:220px;
            padding:14px 35px;
            border:none;
            border-radius:30px;
            background:#f4c2f7;
            color:#222;
            font-size:16px;
            font-weight:900;
            cursor:pointer;
            transition:.3s;
        }

        .btn-inscribirse:hover{
            background:white;
            transform:translateY(-2px);
        }

        .texto-seleccion{
            margin:12px 0 0;
            color:#ddd;
            font-size:13px;
            text-align:center;
        }

       

        .mensaje-fondo{
            display:none;
            align-items:center;
            justify-content:center;
            position:fixed;
            z-index:20000;
            inset:0;
            padding:20px;
            background:rgba(0,0,0,.78);
            backdrop-filter:blur(7px);
        }

        .mensaje-fondo.visible{
            display:flex;
        }

        .mensaje-caja{
            width:100%;
            max-width:470px;
            overflow:hidden;
            border-radius:30px;
            background:white;
            box-shadow:0 25px 75px rgba(0,0,0,.40);
            animation:mostrarMensaje .25s ease;
        }

        @keyframes mostrarMensaje{

            from{
                opacity:0;
                transform:translateY(15px) scale(.94);
            }

            to{
                opacity:1;
                transform:translateY(0) scale(1);
            }
        }

        .mensaje-header{
            display:flex;
            align-items:center;
            justify-content:space-between;
            padding:20px 24px;
            background:linear-gradient(135deg,#f4c9d6,#eca9c2);
        }

        .mensaje-header h3{
            margin:0;
            color:#111;
            font-family:"Anton", sans-serif;
            font-size:27px;
            font-weight:400;
        }

        .cerrar-mensaje{
            border:none;
            background:transparent;
            color:#111;
            font-size:28px;
            font-weight:900;
            cursor:pointer;
        }

        .mensaje-contenido{
            padding:37px 30px 25px;
            text-align:center;
        }

        .icono-mensaje{
            width:86px;
            height:86px;
            display:flex;
            align-items:center;
            justify-content:center;
            margin:auto;
            border-radius:50%;
            background:#fff0f5;
            color:var(--rosa-fuerte);
            font-size:45px;
        }

        .mensaje-contenido h4{
            margin:19px 0 10px;
            color:#111;
            font-size:23px;
            font-weight:900;
        }

        .mensaje-contenido p{
            margin:0;
            color:#666;
            font-size:14px;
            line-height:1.7;
        }

        .mensaje-botones{
            display:flex;
            justify-content:center;
            gap:10px;
            padding:0 26px 30px;
        }

        .mensaje-botones a,
        .mensaje-botones button{
            display:flex;
            align-items:center;
            justify-content:center;
            gap:7px;
            padding:12px 21px;
            border-radius:27px;
            font-size:13px;
            font-weight:900;
            text-decoration:none;
            transition:.3s;
            cursor:pointer;
        }

        .btn-iniciar-sesion{
            border:none;
            background:#111;
            color:white;
        }

        .btn-iniciar-sesion:hover{
            background:var(--rosa-fuerte);
            color:white;
        }

        .btn-seguir-viendo{
            border:2px solid var(--rosa);
            background:white;
            color:var(--rosa-fuerte);
        }

        .btn-seguir-viendo:hover{
            background:var(--rosa);
            color:#111;
        }

        

        .footer-pagina{
            padding:42px 20px 25px;
            background:#111;
            color:white;
            text-align:center;
        }

        .footer-pagina h3{
            margin:0 0 9px;
            color:var(--rosa);
            font-family:"Anton", sans-serif;
            font-size:27px;
            font-weight:400;
        }

        .footer-pagina p{
            margin:0 0 18px;
            color:#ccc;
            font-size:13px;
        }

        .footer-redes{
            display:flex;
            justify-content:center;
            gap:12px;
            flex-wrap:wrap;
            margin-bottom:25px;
        }

        .footer-redes a{
            padding:9px 18px;
            border:1px solid rgba(255,255,255,.25);
            border-radius:25px;
            color:white;
            text-decoration:none;
            font-size:13px;
            transition:.3s;
        }

        .footer-redes a:hover{
            border-color:var(--rosa);
            background:var(--rosa);
            color:#111;
        }

        .copyright{
            padding-top:20px;
            border-top:1px solid rgba(255,255,255,.12);
            color:#999;
            font-size:12px;
        }

         #mainNavbar {
            background: rgba(17, 17, 17, .92);
            backdrop-filter: blur(10px);
            transition: .3s;
            box-shadow: 0 4px 20px rgba(0, 0, 0, .15);
        }

        #mainNavbar.nav-colored {
            background: #111111;
        }

        .navbar-brand {
            color: var(--rosa) !important;
            font-family: "Anton", sans-serif;
            font-size: 25px;
            letter-spacing: 1px;
        }

        .navbar-toggler {
            background: var(--rosa);
            border: none;
        }

        .nav-link {
            color: #f2f1ed !important;
            font-size: 14px;
            font-weight: 700;
            padding: 9px 14px !important;
            border-radius: 25px;
            margin: 2px;
            transition: .3s;
        }

        .nav-link:hover {
            background: rgba(244, 201, 214, .18);
        }

        .nav-destacado {
            background: var(--rosa);
            color: var(--negro) !important;
        }

        .nav-destacado:hover {
            background: var(--rosa-fuerte);
            color: white !important;
        }

        .usuario-navbar {
            color: var(--rosa);
            font-size: 14px;
            font-weight: 800;
        }

        .btn-sesion {
            border: 1px solid white;
            color: white;
            border-radius: 25px;
            padding: 7px 15px;
            text-decoration: none;
            font-size: 13px;
            font-weight: 700;
        }

        .btn-sesion:hover {
            background: var(--rosa);
            border-color: var(--rosa);
            color: var(--negro);
        }


        @media(max-width:1050px){

            .hero-contenido{
                grid-template-columns:1fr;
            }

            .hero-video-contenedor{
                width:100%;
            }

            .grilla-disciplinas{
                grid-template-columns:repeat(2,1fr);
            }
        }

        @media(max-width:700px){

            .hero-disciplinas{
                padding:115px 20px 55px;
            }

            .hero-titulo{
                font-size:54px;
            }

            .hero-video{
                height:300px;
            }

            .seccion-disciplinas{
                padding:55px 20px 70px;
            }

            .encabezado-disciplinas{
                align-items:flex-start;
                flex-direction:column;
            }

            .encabezado-disciplinas h2{
                font-size:43px;
            }

            .grilla-disciplinas{
                grid-template-columns:1fr;
            }

            .modal-horarios{
                padding:10px;
            }

            .contenido-modal{
                width:100%;
                padding:25px 15px;
            }

            .titulo{
                margin-top:40px;
                font-size:28px;
            }

            .mensaje-botones{
                flex-direction:column;
            }

            .mensaje-botones a,
            .mensaje-botones button{
                width:100%;
            }
        }

    </style>

</head>

<body>

<nav
    id="mainNavbar"
    class="navbar navbar-expand-lg fixed-top py-3"
>
    <div class="container">

        <a class="navbar-brand" href="index.php">
            Studio Gym Dance
        </a>

        <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarNavAltMarkup"
        >
            <span class="navbar-toggler-icon"></span>
        </button>

        <div
            class="collapse navbar-collapse"
            id="navbarNavAltMarkup"
        >

            <div class="navbar-nav ms-auto align-items-lg-center">

                <a class="nav-link" href="index.php">
                    Inicio
                </a>

                <?php if (isset($_SESSION["id_alumno"])) { ?>

                    <a
                        class="nav-link nav-destacado"
                        href="panel_alumno.php"
                    >
                        Mi panel
                    </a>

                <?php } else { ?>

                    <a
                        class="nav-link nav-destacado"
                        href="alumnos.php"
                    >
                        Alumnos
                    </a>

                <?php } ?>

                <a
                    class="nav-link"
                    href="disciplinas_panel.php"
                >
                    Disciplinas y horarios
                </a>

                <a
                    class="nav-link"
                    href="profesores.php"
                >
                    Profesores
                </a>

                <a
                    class="nav-link nav-destacado"
                    href="tienda.php"
                >
                    Tienda
                </a>

                <?php if (isset($_SESSION["nombre_alumno"])) { ?>

                    <span class="usuario-navbar ms-lg-3 my-2 my-lg-0">

                        <i class="bi bi-person-circle"></i>

                        <?php echo htmlspecialchars(
                            $_SESSION["nombre_alumno"] . " " .
                            $_SESSION["apellido_alumno"]
                        ); ?>

                    </span>

                    <a
                        href="cerrar_sesion.php"
                        class="btn-sesion ms-lg-3"
                    >
                        Cerrar sesión
                    </a>

                <?php } ?>

            </div>

        </div>

    </div>
</nav>

<section class="hero-disciplinas">

    <div class="hero-contenido">

        <div class="hero-texto">

            <p class="hero-etiqueta">
                Nuestras disciplinas
            </p>

            <h1 class="hero-titulo">
                MOVETE.<br>
                EXPRESÁ.<br>

                <span>
                    VIVÍ.
                </span>
            </h1>

            <p class="hero-descripcion">
                Explorá todas nuestras disciplinas, conocé los horarios
                disponibles y elegí las clases que más se adapten a vos.
            </p>

            <a
                href="disciplinas_panel.php?ver_horarios=1#calendario"
                class="btn-horarios"
            >

                <i class="bi bi-calendar3"></i>

                Ver horarios

            </a>

        </div>

        <div class="hero-video-contenedor">

            <video
                class="hero-video"
                controls
                autoplay
                muted
                loop
            >

                <source
                    src="../Studio Gym Dance/videos e imagenes/v1c044g50000d7t7gpnog65p5kgt4fmg.mp4"
                    type="video/mp4"
                >

                Tu navegador no puede reproducir el video.

            </video>

            <div class="video-etiqueta">

                <i class="bi bi-play-circle-fill"></i>

                Viví la experiencia Studio Gym Dance

            </div>

        </div>

    </div>

</section>

<!-- DISCIPLINAS -->

<section class="seccion-disciplinas">

    <div class="contenedor-disciplinas">

        <div class="encabezado-disciplinas">

            <div>

                <small>
                    ENCONTRÁ TU ESTILO
                </small>

                <h2>
                    Nuestras
                    <span>disciplinas</span>
                </h2>

            </div>

            <p>
                Tenemos propuestas para diferentes edades, niveles y estilos.
                Descubrí la disciplina que mejor representa tu forma de bailar.
            </p>

        </div>

        <div class="grilla-disciplinas">

            <?php while($fila = mysqli_fetch_assoc($resultado)){ ?>

                <?php
                $nombreCategoria = "Disciplina";

                if(isset($fila['nombre_categoria'])){
                    $nombreCategoria = $fila['nombre_categoria'];
                }elseif(isset($fila['nombrecategoria'])){
                    $nombreCategoria = $fila['nombrecategoria'];
                }elseif(isset($fila['nombre_disciplina'])){
                    $nombreCategoria = $fila['nombre_disciplina'];
                }
                ?>

                <article class="card-disciplina">

                    <div class="contenedor-img-disciplina">

                        <img
                            class="img-disciplina"
                            src="<?= htmlspecialchars($fila['imagen_url']); ?>"
                            alt="<?= htmlspecialchars($nombreCategoria); ?>"
                        >

                    </div>

                    <div class="info-disciplina">

                        <span class="tag-disciplina">
                            Studio Gym Dance
                        </span>

                        <h3>
                            <?= htmlspecialchars($nombreCategoria); ?>
                        </h3>

                        <p>
                            <?= htmlspecialchars($fila['descripcion']); ?>
                        </p>

                    </div>

                </article>

            <?php } ?>

        </div>

    </div>

    <?php if(isset($_GET['ver_horarios'])){ ?>

        <!-- CALENDARIO VIEJO -->

        <div
            class="modal-horarios"
            id="calendario"
        >

            <div class="contenido-modal calendario-modal">

                <a
                    href="disciplinas_panel.php"
                    class="cerrar-modal"
                    aria-label="Cerrar"
                >
                    ×
                </a>

                <h2 class="titulo">
                    Horarios y Clases Disponibles
                </h2>

                <p class="subtitulo-modal">
                    Calendario semanal del estudio
                </p>

                <div class="calendarios">

                    <div class="celda encabezado">
                        Hora
                    </div>

                    <div class="celda encabezado">
                        Lunes
                    </div>

                    <div class="celda encabezado">
                        Martes
                    </div>

                    <div class="celda encabezado">
                        Miércoles
                    </div>

                    <div class="celda encabezado">
                        Jueves
                    </div>

                    <div class="celda encabezado">
                        Viernes
                    </div>

                    <div class="celda encabezado">
                        Sábado
                    </div>

                    <!-- 16:00 -->

                    <div class="celda hora">
                        16:00
                    </div>

                    <div
                        class="celda clase clasica"
                        onclick="seleccionarClase(1,this)"
                    >
                        Danza Clásica
                        <br>
                        <span>Kids · Sala 1</span>
                    </div>

                    <div class="celda vacia"></div>

                    <div
                        class="celda clase clasica"
                        onclick="seleccionarClase(2,this)"
                    >
                        Danza Clásica
                        <br>
                        <span>Kids · Sala 1</span>
                    </div>

                    <div class="celda vacia"></div>

                    <div class="celda vacia"></div>

                    <div
                        class="celda clase arabe"
                        onclick="seleccionarClase(3,this)"
                    >
                        Árabe
                        <br>
                        <span>Kids · Sala 2</span>
                    </div>

                    <!-- 17:00 -->

                    <div class="celda hora">
                        17:00
                    </div>

                    <div
                        class="celda clase tap"
                        onclick="seleccionarClase(4,this)"
                    >
                        Tap
                        <br>
                        <span>Kids · Sala 1</span>
                    </div>

                    <div
                        class="celda clase latinos"
                        onclick="seleccionarClase(5,this)"
                    >
                        Ritmos Latinos
                        <br>
                        <span>Kids · Sala 2</span>
                    </div>

                    <div
                        class="celda clase tap"
                        onclick="seleccionarClase(6,this)"
                    >
                        Tap
                        <br>
                        <span>Kids · Sala 1</span>
                    </div>

                    <div class="celda vacia"></div>

                    <div
                        class="celda clase reggaeton"
                        onclick="seleccionarClase(7,this)"
                    >
                        Reggaetón
                        <br>
                        <span>Kids · Sala 2</span>
                    </div>

                    <div
                        class="celda clase arabe"
                        onclick="seleccionarClase(26,this)"
                    >
                        Árabe
                        <br>
                        <span>Juveniles · Sala 2</span>
                    </div>

                    <!-- 18:00 -->

                    <div class="celda hora">
                        18:00
                    </div>

                    <div
                        class="celda clase urbano"
                        onclick="seleccionarClase(8,this)"
                    >
                        Urbano
                        <br>
                        <span>Juveniles · Sala 2</span>
                    </div>

                    <div
                        class="celda clase clasica"
                        onclick="seleccionarClase(9,this)"
                    >
                        Danza Clásica
                        <br>
                        <span>Juveniles · Sala 1</span>
                    </div>

                    <div
                        class="celda clase urbano"
                        onclick="seleccionarClase(10,this)"
                    >
                        Urbano
                        <br>
                        <span>Juveniles · Sala 2</span>
                    </div>

                    <div
                        class="celda clase tap"
                        onclick="seleccionarClase(11,this)"
                    >
                        Tap
                        <br>
                        <span>Juveniles · Sala 1</span>
                    </div>

                    <div
                        class="celda clase clasica"
                        onclick="seleccionarClase(12,this)"
                    >
                        Danza Clásica
                        <br>
                        <span>Juveniles · Sala 1</span>
                    </div>

                    <div class="celda vacia"></div>

                    <!-- 19:00 -->

                    <div class="celda hora">
                        19:00
                    </div>

                    <div class="celda vacia"></div>

                    <div
                        class="celda clase femme"
                        onclick="seleccionarClase(13,this)"
                    >
                        Femme
                        <br>
                        <span>Juveniles · Sala 2</span>
                    </div>

                    <div
                        class="celda clase arabe"
                        onclick="seleccionarClase(14,this)"
                    >
                        Árabe
                        <br>
                        <span>Adultos · Sala 2</span>
                    </div>

                    <div
                        class="celda clase urbano"
                        onclick="seleccionarClase(15,this)"
                    >
                        Urbano
                        <br>
                        <span>Juveniles · Sala 2</span>
                    </div>

                    <div class="celda vacia"></div>

                    <div class="celda vacia"></div>

                    <!-- 20:00 -->

                    <div class="celda hora">
                        20:00
                    </div>

                    <div
                        class="celda clase latinos"
                        onclick="seleccionarClase(16,this)"
                    >
                        Ritmos Latinos
                        <br>
                        <span>Adultos · Sala 2</span>
                    </div>

                    <div
                        class="celda clase contemporaneo"
                        onclick="seleccionarClase(17,this)"
                    >
                        Contemporáneo
                        <br>
                        <span>Adultos · Sala 1</span>
                    </div>

                    <div
                        class="celda clase latinos"
                        onclick="seleccionarClase(18,this)"
                    >
                        Ritmos Latinos
                        <br>
                        <span>Adultos · Sala 2</span>
                    </div>

                    <div
                        class="celda clase clasica"
                        onclick="seleccionarClase(19,this)"
                    >
                        Danza Clásica
                        <br>
                        <span>Adultos · Sala 1</span>
                    </div>

                    <div
                        class="celda clase femme"
                        onclick="seleccionarClase(20,this)"
                    >
                        Femme
                        <br>
                        <span>Adultos · Sala 2</span>
                    </div>

                    <div class="celda vacia"></div>

                    <!-- 21:00 -->

                    <div class="celda hora">
                        21:00
                    </div>

                    <div
                        class="celda clase urbano"
                        onclick="seleccionarClase(21,this)"
                    >
                        Urbano
                        <br>
                        <span>Adultos · Sala 2</span>
                    </div>

                    <div
                        class="celda clase reggaeton"
                        onclick="seleccionarClase(22,this)"
                    >
                        Reggaetón
                        <br>
                        <span>Adultos · Sala 2</span>
                    </div>

                    <div
                        class="celda clase heels"
                        onclick="seleccionarClase(23,this)"
                    >
                        Heels
                        <br>
                        <span>Adultos · Sala 1</span>
                    </div>

                    <div
                        class="celda clase reggaeton"
                        onclick="seleccionarClase(24,this)"
                    >
                        Reggaetón
                        <br>
                        <span>Adultos · Sala 2</span>
                    </div>

                    <div
                        class="celda clase heels"
                        onclick="seleccionarClase(25,this)"
                    >
                        Heels
                        <br>
                        <span>Adultos · Sala 1</span>
                    </div>

                    <div class="celda vacia"></div>

                </div>

                <div class="zona-inscripcion">

                    <?php if(isset($_SESSION['id_alumno'])){ ?>

                        <form
                            action="inscribirse.php"
                            method="POST"
                            onsubmit="return prepararInscripcion()"
                        >

                            <input
                                type="hidden"
                                name="clases"
                                id="clases"
                            >

                            <button
                                type="submit"
                                class="btn-inscribirse"
                            >
                                Inscribirme
                            </button>

                        </form>

                    <?php }else{ ?>

                        <button
                            type="button"
                            class="btn-inscribirse"
                            onclick="mostrarMensajeSesion()"
                        >
                            Inscribirme
                        </button>

                    <?php } ?>

                    <p class="texto-seleccion">
                        Seleccioná una o más clases antes de inscribirte.
                    </p>

                </div>

            </div>

        </div>

    <?php } ?>

</section>

<!-- MENSAJE PARA PERSONAS SIN SESIÓN -->

<div
    class="mensaje-fondo"
    id="mensajeSesion"
>

    <div class="mensaje-caja">

        <div class="mensaje-header">

            <h3>
                Iniciar sesión
            </h3>

            <button
                type="button"
                class="cerrar-mensaje"
                onclick="cerrarMensajeSesion()"
                aria-label="Cerrar mensaje"
            >
                ×
            </button>

        </div>

        <div class="mensaje-contenido">

            <div class="icono-mensaje">

                <i class="bi bi-person-lock"></i>

            </div>

            <h4>
                Necesitás iniciar sesión
            </h4>

            <p>
                Para inscribirte en una clase primero tenés que
                ingresar con tu cuenta de alumno. Si todavía no
                tenés una cuenta, también podés registrarte.
            </p>

        </div>

        <div class="mensaje-botones">

            <a
                href="alumnos.php"
                class="btn-iniciar-sesion"
            >

                <i class="bi bi-box-arrow-in-right"></i>

                Iniciar sesión

            </a>

            <button
                type="button"
                class="btn-seguir-viendo"
                onclick="cerrarMensajeSesion()"
            >
                Seguir viendo
            </button>

        </div>

    </div>

</div>

<!-- FOOTER -->

<footer class="footer-pagina">

    <h3>
        Studio Gym Dance
    </h3>

    <p>
        Contactanos y seguinos en nuestras redes sociales.
    </p>

    <div class="footer-redes">

        <a href="#">

            <i class="bi bi-instagram"></i>

            Instagram

        </a>

        <a href="#">

            <i class="bi bi-whatsapp"></i>

            WhatsApp

        </a>

    </div>

    <div class="copyright">
        © 2026 Studio Gym Dance — Todos los derechos reservados.
    </div>

</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

<script>

    var clasesSeleccionadas = [];

    function seleccionarClase(idClase, elemento){

        var posicion = clasesSeleccionadas.indexOf(idClase);

        if(posicion !== -1){

            clasesSeleccionadas.splice(posicion, 1);

            elemento.classList.remove("seleccionada");

        }else{

            clasesSeleccionadas.push(idClase);

            elemento.classList.add("seleccionada");
        }
    }

    
    function prepararInscripcion(){

        if(clasesSeleccionadas.length === 0){

            alert("Seleccioná al menos una clase.");

            return false;
        }

        var campoClases = document.getElementById("clases");

        if(!campoClases){

            alert("No se pudieron preparar las clases seleccionadas.");

            return false;
        }

        campoClases.value = clasesSeleccionadas.join(",");

        return true;
    }

    /*
     * Mostrar mensaje cuando no hay una sesión de alumno.
     */
    function mostrarMensajeSesion(){

        var mensaje = document.getElementById("mensajeSesion");

        if(mensaje){

            mensaje.classList.add("visible");

        }else{

            alert(
                "Para inscribirte primero tenés que iniciar sesión como alumno."
            );
        }
    }

   
    function cerrarMensajeSesion(){

        var mensaje = document.getElementById("mensajeSesion");

        if(mensaje){

            mensaje.classList.remove("visible");
        }
    }


    document.addEventListener("click", function(event){

        var mensaje = document.getElementById("mensajeSesion");

        if(
            mensaje &&
            event.target === mensaje
        ){

            cerrarMensajeSesion();
        }
    });

</script>

</body>
</html>