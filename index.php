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

    <title>Studio Gym Dance</title>

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

        :root {
            --fondo: #f6f4ee;
            --rosa: #f4c9d6;
            --rosa-fuerte: #e86b98;
            --negro: #111111;
            --blanco: #ffffff;
            --gris: #666666;
        }

        * {
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            margin: 0;
            background-color: var(--fondo);
            color: var(--negro);
            font-family: "Montserrat", sans-serif;
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

        .hero-inicio {
            min-height: 760px;
            display: flex;
            align-items: center;
            position: relative;
            background-image:
                linear-gradient(
                    90deg,
                    rgba(17, 17, 17, .88) 0%,
                    rgba(17, 17, 17, .58) 50%,
                    rgba(17, 17, 17, .25) 100%
                ),
                url("https://i.pinimg.com/1200x/3f/a3/e2/3fa3e2c11e404223ff7f815326d70656.jpg");
            background-size: cover;
            background-position: center;
            overflow: hidden;
        }

        .hero-inicio::after {
            content: "";
            position: absolute;
            width: 420px;
            height: 420px;
            border-radius: 50%;
            background: rgba(244, 201, 214, .18);
            right: -140px;
            bottom: -170px;
        }

        .hero-contenido {
            position: relative;
            z-index: 1;
            max-width: 800px;
            padding-top: 90px;
        }

        .hero-etiqueta {
            color: var(--rosa);
            font-size: 13px;
            font-weight: 900;
            letter-spacing: 4px;
            text-transform: uppercase;
        }

        .hero-inicio h1 {
            color: white;
            font-family: "Anton", sans-serif;
            font-size: clamp(55px, 8vw, 105px);
            line-height: .95;
            margin: 18px 0 25px;
            text-transform: uppercase;
        }

        .hero-inicio h1 span {
            color: var(--rosa);
        }

        .hero-inicio p {
            max-width: 650px;
            color: #eeeeee;
            font-size: 18px;
            line-height: 1.7;
        }

        .hero-botones {
            display: flex;
            gap: 14px;
            flex-wrap: wrap;
            margin-top: 32px;
        }

        .btn-principal,
        .btn-secundario {
            display: inline-block;
            border-radius: 28px;
            padding: 14px 26px;
            text-decoration: none;
            font-weight: 900;
            transition: .3s;
        }

        .btn-principal {
            background: var(--rosa);
            color: var(--negro);
        }

        .btn-principal:hover {
            background: var(--rosa-fuerte);
            color: white;
            transform: translateY(-3px);
        }

        .btn-secundario {
            border: 1px solid white;
            color: white;
        }

        .btn-secundario:hover {
            background: white;
            color: var(--negro);
            transform: translateY(-3px);
        }

        .seccion-clara {
            padding: 100px 0;
            background:
                radial-gradient(#e8e4d8 25%, transparent 25%);
            background-size: 50px 50px;
            background-color: var(--fondo);
        }

        .bloque-presentacion {
            background: white;
            border-radius: 35px;
            padding: 35px;
            box-shadow: 0 18px 50px rgba(0, 0, 0, .09);
        }

        .imagen-presentacion {
            width: 100%;
            height: 520px;
            object-fit: cover;
            border-radius: 28px;
            filter: grayscale(100%);
        }

        .texto-presentacion {
            padding: 30px 35px;
        }

        .etiqueta-seccion {
            color: var(--rosa-fuerte);
            font-size: 12px;
            font-weight: 900;
            letter-spacing: 3px;
            text-transform: uppercase;
        }

        .titulo-seccion {
            font-family: "Anton", sans-serif;
            font-size: clamp(40px, 5vw, 62px);
            line-height: 1.05;
            margin: 14px 0 24px;
            text-transform: uppercase;
        }

        .titulo-seccion span {
            color: var(--rosa-fuerte);
        }

        .texto-seccion {
            color: #606060;
            font-size: 17px;
            line-height: 1.8;
        }

        .firma {
            display: inline-block;
            color: var(--rosa-fuerte);
            font-weight: 900;
            margin-top: 15px;
        }

        .filosofia {
            padding: 100px 0;
            background: #111111;
            color: white;
        }

        .filosofia-imagen {
            min-height: 500px;
            border-radius: 32px;
            background-image:
                linear-gradient(
                    rgba(17, 17, 17, .05),
                    rgba(17, 17, 17, .35)
                ),
                url("https://i.pinimg.com/736x/b5/a6/81/b5a68130f49274c22595b7b88348600a.jpg");
            background-size: cover;
            background-position: center;
            box-shadow: 0 15px 40px rgba(0, 0, 0, .25);
        }

        .filosofia-texto {
            padding: 45px;
        }

        .filosofia .texto-seccion {
            color: #dddddd;
        }

        .dato-filosofia {
            margin-top: 30px;
            border: 1px solid rgba(255, 255, 255, .18);
            border-radius: 22px;
            padding: 22px;
        }

        .dato-filosofia strong {
            display: block;
            color: var(--rosa);
            margin-bottom: 6px;
        }

        .packs-inicio {
            padding: 100px 0;
            background: var(--fondo);
        }

        .encabezado-packs {
            text-align: center;
            max-width: 760px;
            margin: 0 auto 45px;
        }

        .packs-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 24px;
        }

        .pack-card {
            background: white;
            border-radius: 28px;
            padding: 30px 25px;
            min-height: 350px;
            box-shadow: 0 12px 30px rgba(0, 0, 0, .08);
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            transition: .3s;
        }

        .pack-card::after {
            content: "";
            position: absolute;
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background: rgba(244, 201, 214, .40);
            top: -40px;
            right: -40px;
        }

        .pack-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 18px 40px rgba(0, 0, 0, .13);
        }

        .pack-card.destacado {
            background: linear-gradient(135deg, #ffffff, #f4c9d6);
        }

        .pack-etiqueta {
            position: relative;
            z-index: 1;
            display: inline-block;
            width: max-content;
            background: #111;
            color: white;
            border-radius: 20px;
            padding: 6px 13px;
            font-size: 11px;
            font-weight: 900;
        }

        .pack-card h3 {
            position: relative;
            z-index: 1;
            font-family: "Anton", sans-serif;
            font-size: 33px;
            margin: 30px 0 10px;
        }

        .pack-precio {
            font-family: "Anton", sans-serif;
            font-size: 40px;
            color: var(--rosa-fuerte);
            margin-bottom: 18px;
        }

        .pack-card p {
            color: #666666;
            line-height: 1.6;
            font-size: 14px;
        }

        .pack-boton {
            display: block;
            margin-top: auto;
            background: #111111;
            color: white;
            text-align: center;
            text-decoration: none;
            border-radius: 25px;
            padding: 12px;
            font-weight: 900;
        }

        .pack-boton:hover {
            background: var(--rosa-fuerte);
            color: white;
        }

        .cta {
            width: 92%;
            max-width: 1200px;
            margin: 0 auto 100px;
            background: linear-gradient(135deg, #111111, #2b2b2b);
            color: white;
            border-radius: 35px;
            padding: 55px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 30px;
            overflow: hidden;
            position: relative;
        }

        .cta::after {
            content: "";
            position: absolute;
            width: 260px;
            height: 260px;
            border-radius: 50%;
            background: rgba(244, 201, 214, .16);
            right: -85px;
            top: -90px;
        }

        .cta-contenido {
            position: relative;
            z-index: 1;
        }

        .cta h2 {
            font-family: "Anton", sans-serif;
            font-size: 48px;
            margin-bottom: 10px;
        }

        .cta h2 span {
            color: var(--rosa);
        }

        .cta p {
            color: #dddddd;
            margin: 0;
        }

        .cta a {
            position: relative;
            z-index: 1;
            background: var(--rosa);
            color: var(--negro);
            border-radius: 28px;
            padding: 14px 25px;
            text-decoration: none;
            font-weight: 900;
            white-space: nowrap;
        }

        .cta a:hover {
            background: var(--rosa-fuerte);
            color: white;
        }

        footer {
            background: #111111;
            color: white;
            padding: 55px 0 25px;
        }

        .footer-marca {
            color: var(--rosa);
            font-family: "Anton", sans-serif;
            font-size: 30px;
        }

        .footer-texto {
            color: #cccccc;
            font-size: 14px;
            line-height: 1.7;
        }

        .footer-enlace {
            display: block;
            color: #dddddd;
            text-decoration: none;
            margin-bottom: 9px;
        }

        .footer-enlace:hover {
            color: var(--rosa);
        }

        .redes a {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            color: white;
            text-decoration: none;
            margin-right: 16px;
        }

        .redes a:hover {
            color: var(--rosa);
        }

        .copyright {
            border-top: 1px solid rgba(255, 255, 255, .12);
            margin-top: 35px;
            padding-top: 22px;
            color: #aaaaaa;
            font-size: 13px;
            text-align: center;
        }

        @media (max-width: 992px) {

            .packs-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .texto-presentacion,
            .filosofia-texto {
                padding: 30px 10px;
            }

            .cta {
                flex-direction: column;
                align-items: flex-start;
            }
        }

        @media (max-width: 600px) {

            .hero-inicio {
                min-height: 680px;
            }

            .hero-inicio p {
                font-size: 16px;
            }

            .hero-botones {
                flex-direction: column;
            }

            .btn-principal,
            .btn-secundario {
                text-align: center;
                width: 100%;
            }

            .imagen-presentacion {
                height: 380px;
            }

            .packs-grid {
                grid-template-columns: 1fr;
            }

            .cta {
                padding: 38px 26px;
            }

            .cta h2 {
                font-size: 39px;
            }

            .cta a {
                width: 100%;
                text-align: center;
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

<header class="hero-inicio">

    <div class="container">

        <div class="hero-contenido">

            <span class="hero-etiqueta">
                Studio Gym Dance
            </span>

            <h1>
                Bailá,
                <span>sentí</span>
                y expresate
            </h1>

            <p>
                Un espacio pensado para descubrir tu estilo, crecer,
                disfrutar y convertir cada movimiento en una forma
                de expresión.
            </p>

            <div class="hero-botones">

                <a
                    href="disciplinas_panel.php"
                    class="btn-principal"
                >
                    Conocer las disciplinas
                </a>

                <?php if (isset($_SESSION["id_alumno"])) { ?>

                    <a
                        href="panel_alumno.php"
                        class="btn-secundario"
                    >
                        Ir a mi panel
                    </a>

                <?php } else { ?>

                    <a
                        href="alumnos.php"
                        class="btn-secundario"
                    >
                        Registrarme
                    </a>

                <?php } ?>

            </div>

        </div>

    </div>

</header>

<section class="seccion-clara">

    <div class="container">

        <div class="bloque-presentacion">

            <div class="row align-items-center g-4">

                <div class="col-lg-5">

                    <img
                        src="https://i.pinimg.com/1200x/7d/13/8d/7d138dd7611da41959b643119dcf4da4.jpg"
                        class="imagen-presentacion"
                        alt="Directora del estudio"
                    >

                </div>

                <div class="col-lg-7">

                    <div class="texto-presentacion">

                        <span class="etiqueta-seccion">
                            Sobre nuestra directora
                        </span>

                        <h2 class="titulo-seccion">
                            Más de diez años de
                            <span>experiencia</span>
                        </h2>

                        <p class="texto-seccion">
                            Nuestra directora busca crear un espacio donde
                            cada bailarín pueda encontrar su propia voz,
                            desarrollar confianza y disfrutar cada etapa
                            de su aprendizaje.
                        </p>

                        <span class="firma">
                            Pasión, disciplina y expresión.
                        </span>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

<section class="filosofia">

    <div class="container">

        <div class="row align-items-center g-5">

            <div class="col-lg-6">

                <div class="filosofia-texto">

                    <span class="etiqueta-seccion">
                        Nuestra filosofía
                    </span>

                    <h2 class="titulo-seccion">
                        La danza comunica lo que
                        <span>las palabras no pueden</span>
                    </h2>

                    <p class="texto-seccion">
                        Creemos en la confianza, la creatividad y la
                        constancia como pilares fundamentales. Cada clase
                        es una oportunidad para aprender, expresarse y
                        compartir con otros.
                    </p>

                    <div class="dato-filosofia">

                        <strong>
                            Un espacio para todas las personas
                        </strong>

                        Clases adaptadas a diferentes niveles, edades,
                        objetivos y estilos de danza.

                    </div>

                </div>

            </div>

            <div class="col-lg-6">

                <div class="filosofia-imagen"></div>

            </div>

        </div>

    </div>

</section>

<section class="packs-inicio">

    <div class="container">

        <div class="encabezado-packs">

            <span class="etiqueta-seccion">
                Elegí tu ritmo
            </span>

            <h2 class="titulo-seccion">
                Packs de <span>clases</span>
            </h2>

            <p class="texto-seccion">
                Encontrá la opción que mejor se adapte a tu rutina
                y empezá a disfrutar tus clases.
            </p>

        </div>

        <div class="packs-grid">

            <div class="pack-card">

                <span class="pack-etiqueta">
                    INDIVIDUAL
                </span>

                <h3>Clase suelta</h3>

                <div class="pack-precio">
                    $5.000
                </div>

                <p>
                    Ideal para probar una disciplina o asistir a una
                    clase puntual.
                </p>

                <a href="packs.php" class="pack-boton">
                    Ver pack
                </a>

            </div>

            <div class="pack-card">

                <span class="pack-etiqueta">
                    INICIAL
                </span>

                <h3>Pack 4 clases</h3>

                <div class="pack-precio">
                    $18.000
                </div>

                <p>
                    Una opción flexible para comenzar y entrenar
                    una vez por semana.
                </p>

                <a href="packs.php" class="pack-boton">
                    Ver pack
                </a>

            </div>

            <div class="pack-card destacado">

                <span class="pack-etiqueta">
                    MÁS ELEGIDO
                </span>

                <h3>Pack 8 clases</h3>

                <div class="pack-precio">
                    $38.000
                </div>

                <p>
                    Perfecto para entrenar dos veces por semana
                    y mantener continuidad.
                </p>

                <a href="packs.php" class="pack-boton">
                    Ver pack
                </a>

            </div>

            <div class="pack-card">

                <span class="pack-etiqueta">
                    INTENSIVO
                </span>

                <h3>Pack 12 clases</h3>

                <div class="pack-precio">
                    $58.000
                </div>

                <p>
                    Pensado para quienes quieren avanzar y entrenar
                    con mayor frecuencia.
                </p>

                <a href="packs.php" class="pack-boton">
                    Ver pack
                </a>

            </div>

        </div>

    </div>

</section>

<section class="cta">

    <div class="cta-contenido">

        <h2>
            Tu próxima clase puede ser
            <span>hoy</span>
        </h2>

        <p>
            Conocé nuestros horarios y elegí la disciplina que más te guste.
        </p>

    </div>

    <a href="disciplinas_panel.php">
        Ver horarios
    </a>

</section>

<footer>

    <div class="container">

        <div class="row g-4">

            <div class="col-md-5">

                <div class="footer-marca">
                    Studio Gym Dance
                </div>

                <p class="footer-texto mt-3">
                    Un espacio para aprender, expresarse, crecer
                    y disfrutar la danza.
                </p>

            </div>

            <div class="col-md-3">

                <h5>Enlaces</h5>

                <a href="index.php" class="footer-enlace">
                    Inicio
                </a>

                <a href="disciplinas_panel.php" class="footer-enlace">
                    Disciplinas
                </a>

                <a href="profesores.php" class="footer-enlace">
                    Profesores
                </a>

                <a href="tienda.php" class="footer-enlace">
                    Tienda
                </a>

            </div>

            <div class="col-md-4">

                <h5>Contacto y redes</h5>

                <div class="redes mt-3">

                    <a href="#">
                        <i class="bi bi-instagram"></i>
                        Instagram
                    </a>

                    <a href="#">
                        <i class="bi bi-whatsapp"></i>
                        WhatsApp
                    </a>

                </div>

                <p class="footer-texto mt-4">
                    Aceptamos distintos medios de pago.
                </p>

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

<script>

const navbar = document.getElementById("mainNavbar");

window.addEventListener("scroll", function () {

    if (window.scrollY > 50) {
        navbar.classList.add("nav-colored");
    } else {
        navbar.classList.remove("nav-colored");
    }

});

</script>

</body>

</html>

