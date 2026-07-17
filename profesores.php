<?php
session_start();
include("conexion.php");
?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Profesores</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    >

    <link
        href="https://fonts.googleapis.com/css2?family=Anton&family=Montserrat:wght@400;500;600;700;800;900&display=swap"
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
            background:
                radial-gradient(#e8e4d8 28%, transparent 28%);
            background-size:50px 50px;
            background-color:var(--fondo);
            font-family:"Montserrat", sans-serif;
            color:var(--negro);
        }

   

        .zona-profesores{
            min-height:100vh;
            padding:130px 20px 90px;
        }

        .contenedor-profesores{
            width:100%;
            max-width:1100px;
            margin:auto;
            display:grid;
            grid-template-columns:.9fr 1.1fr;
            gap:28px;
            align-items:stretch;
        }

      

        .presentacion-profesores{
            background:linear-gradient(135deg,#111,#2b2b2b);
            color:white;
            border-radius:32px;
            padding:48px;
            display:flex;
            flex-direction:column;
            justify-content:center;
            position:relative;
            overflow:hidden;
            box-shadow:0 15px 45px rgba(0,0,0,.14);
        }

        .presentacion-profesores::after{
            content:"";
            position:absolute;
            width:220px;
            height:220px;
            border-radius:50%;
            background:rgba(244,201,214,.17);
            top:-85px;
            right:-75px;
        }

        .presentacion-profesores > *{
            position:relative;
            z-index:1;
        }

        .etiqueta-profesor{
            color:var(--rosa);
            font-size:12px;
            font-weight:900;
            letter-spacing:3px;
            text-transform:uppercase;
        }

        .presentacion-profesores h1{
            font-family:"Anton", sans-serif;
            font-size:58px;
            line-height:1;
            margin:16px 0 22px;
        }

        .presentacion-profesores h1 span{
            color:var(--rosa);
        }

        .presentacion-profesores p{
            color:#dddddd;
            line-height:1.7;
            font-size:16px;
            margin:0;
        }

        .detalle-profesor{
            margin-top:28px;
            padding:18px;
            border:1px solid rgba(255,255,255,.18);
            border-radius:18px;
            color:#e8e8e8;
            font-size:14px;
        }

        .detalle-profesor strong{
            display:block;
            color:var(--rosa);
            margin-bottom:5px;
        }

     

        .formulario-profesor{
            background:white;
            border-radius:32px;
            padding:48px;
            box-shadow:0 15px 45px rgba(0,0,0,.10);
            position:relative;
            overflow:hidden;
        }

        .formulario-profesor::before{
            content:"";
            position:absolute;
            width:145px;
            height:145px;
            border-radius:50%;
            background:rgba(244,201,214,.30);
            bottom:-50px;
            left:-50px;
        }

        .formulario-contenido{
            position:relative;
            z-index:1;
        }

        .formulario-profesor h2{
            font-family:"Anton", sans-serif;
            font-size:42px;
            margin-bottom:8px;
        }

        .subtexto-formulario{
            color:#666;
            line-height:1.7;
            margin-bottom:28px;
        }

        .linea-rosa{
            width:65px;
            border:none;
            border-top:4px solid var(--rosa-fuerte);
            opacity:1;
            margin:0 0 28px;
        }

        .form-label{
            font-size:12px;
            font-weight:900;
            letter-spacing:1px;
            text-transform:uppercase;
            color:#666;
        }

        .form-control{
            border:1px solid #d9d5cf;
            border-radius:15px;
            padding:13px 15px;
            background:#fcfbf8;
        }

        .form-control:focus{
            background:white;
            border-color:var(--rosa-fuerte);
            box-shadow:0 0 0 .2rem rgba(232,107,152,.14);
        }

        .form-check-input:checked{
            background-color:var(--rosa-fuerte);
            border-color:var(--rosa-fuerte);
        }

        .campos-obligatorios{
            color:#666;
            font-size:12px;
            margin-top:12px;
        }

        .btn-ingresar{
            width:100%;
            background:var(--negro);
            color:white;
            border:none;
            border-radius:27px;
            padding:14px;
            font-size:13px;
            font-weight:900;
            letter-spacing:1px;
            text-transform:uppercase;
            transition:.3s;
        }

        .btn-ingresar:hover{
            background:var(--rosa-fuerte);
            color:white;
            transform:translateY(-2px);
        }

     

        .footer-profesores{
            background:#111;
            color:white;
            padding:48px 0 23px;
        }

        .footer-marca{
            color:var(--rosa);
            font-family:"Anton", sans-serif;
            font-size:29px;
        }

        .footer-texto{
            color:#cccccc;
            font-size:14px;
        }

        .footer-redes a{
            color:white;
            text-decoration:none;
            margin-right:17px;
        }

        .footer-redes a:hover{
            color:var(--rosa);
        }

        .copyright{
            border-top:1px solid rgba(255,255,255,.12);
            margin-top:30px;
            padding-top:20px;
            color:#aaa;
            font-size:13px;
            text-align:center;
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


        @media(max-width:850px){

            .contenedor-profesores{
                grid-template-columns:1fr;
            }

            .presentacion-profesores,
            .formulario-profesor{
                padding:35px 27px;
            }

            .presentacion-profesores h1{
                font-size:47px;
            }
        }

        @media(max-width:550px){

            .zona-profesores{
                padding:110px 14px 60px;
            }

            .formulario-profesor h2{
                font-size:36px;
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

<main class="zona-profesores">

    <div class="contenedor-profesores">

        <section class="presentacion-profesores">

            <span class="etiqueta-profesor">
                Acceso para profesores
            </span>

            <h1>
                ENSEÑÁ,
                <span>INSPIRÁ</span>
                Y ACOMPAÑÁ
            </h1>

            <p>
                Ingresá a tu panel para administrar tus clases,
                registrar asistencias, compartir materiales y consultar
                los alumnos que tenés asignados.
            </p>

            <div class="detalle-profesor">

                <strong>
                    Panel exclusivo
                </strong>

                Este acceso está disponible únicamente para profesores
                registrados por la administración del estudio.

            </div>

        </section>

        <section class="formulario-profesor">

            <div class="formulario-contenido">

                <h2>
                    Iniciar sesión
                </h2>

                <hr class="linea-rosa">

                <p class="subtexto-formulario">
                    Ingresá tu correo electrónico y contraseña para acceder
                    a las herramientas del profesor.
                </p>

                <form action="login.php" method="POST">

                    <div class="mb-4">

                        <label
                            for="loginEmail"
                            class="form-label"
                        >
                            Correo electrónico
                            <span style="color:red;">*</span>
                        </label>

                        <input
                            type="email"
                            id="loginEmail"
                            name="email"
                            class="form-control"
                            placeholder="ejemplo@gmail.com"
                            required
                        >

                    </div>

                    <div class="mb-4">

                        <label
                            for="loginPassword"
                            class="form-label"
                        >
                            Contraseña
                            <span style="color:red;">*</span>
                        </label>

                        <input
                            type="password"
                            id="loginPassword"
                            name="password"
                            class="form-control"
                            placeholder="Ingresá tu contraseña"
                            required
                        >

                    </div>

                    <div class="form-check mb-4">

                        <input
                            class="form-check-input"
                            type="checkbox"
                            id="checkSesion"
                        >

                        <label
                            class="form-check-label small"
                            for="checkSesion"
                        >
                            Recordar mi sesión
                        </label>

                    </div>

                    <p class="campos-obligatorios">
                        <span style="color:red;">*</span>
                        Campos obligatorios
                    </p>

                    <button
                        type="submit"
                        class="btn-ingresar"
                    >
                        Ingresar al panel
                    </button>

                </form>

            </div>

        </section>

    </div>

</main>

<footer class="footer-profesores">

    <div class="container">

        <div class="row align-items-center g-4">

            <div class="col-md-6">

                <div class="footer-marca">
                    Studio Gym Dance
                </div>

                <p class="footer-texto mt-2 mb-0">
                    Enseñar danza también es acompañar, motivar e inspirar.
                </p>

            </div>

            <div class="col-md-6 text-md-end footer-redes">

                <a href="#">
                    <i class="bi bi-instagram"></i>
                    Instagram
                </a>

                <a href="#">
                    <i class="bi bi-whatsapp"></i>
                    WhatsApp
                </a>

            </div>

        </div>

        <div class="copyright">
            © 2026 Studio Gym Dance — Todos los derechos reservados.
        </div>

    </div>

</footer>

<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
></script>

</body>
</html>