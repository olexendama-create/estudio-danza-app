<?php

session_start();
include("conexion.php");

$error_nombre = $_SESSION["error_nombre"] ?? "";
$datos_formulario = $_SESSION["datos_formulario"] ?? [];

unset($_SESSION["error_nombre"]);
unset($_SESSION["datos_formulario"]);

$sqlTipoDocumento = "SELECT id_tipo_doc, nombre_tipo
                     FROM tipos_documento
                     ORDER BY nombre_tipo";

$resultadoTipoDocumento = mysqli_query(
    $conexion,
    $sqlTipoDocumento
);

?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Alumnos</title>

    <link
        rel="stylesheet"
        href="style.css"
    >

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
            background-color:var(--fondo);
            font-family:"Montserrat", sans-serif;
            color:var(--negro);
        }

    

        .zona-alumnos{
            min-height:100vh;
            padding:130px 25px 90px;
            background:
                radial-gradient(#e8e4d8 28%, transparent 28%);
            background-size:50px 50px;
            background-color:var(--fondo);
        }

        .encabezado-alumnos{
            max-width:1200px;
            margin:0 auto 35px;
            background:linear-gradient(135deg,#111,#2b2b2b);
            color:white;
            border-radius:32px;
            padding:42px 45px;
            box-shadow:0 15px 40px rgba(0,0,0,.14);
            position:relative;
            overflow:hidden;
        }

        .encabezado-alumnos::after{
            content:"";
            position:absolute;
            width:230px;
            height:230px;
            border-radius:50%;
            background:rgba(244,201,214,.17);
            top:-90px;
            right:-75px;
        }

        .encabezado-contenido{
            position:relative;
            z-index:1;
        }

        .encabezado-alumnos small{
            color:var(--rosa);
            font-size:12px;
            font-weight:900;
            letter-spacing:3px;
        }

        .encabezado-alumnos h1{
            font-family:"Anton", sans-serif;
            font-size:55px;
            margin:12px 0 13px;
        }

        .encabezado-alumnos h1 span{
            color:var(--rosa);
        }

        .encabezado-alumnos p{
            color:#dddddd;
            margin:0;
            max-width:720px;
            line-height:1.7;
        }


        .contenedor-formularios{
            width:100%;
            max-width:1200px;
            margin:auto;
        }

        .formulario-card{
            background:white;
            border:none !important;
            border-radius:30px;
            padding:42px !important;
            box-shadow:0 15px 40px rgba(0,0,0,.10);
            height:100%;
            position:relative;
            overflow:hidden;
        }

        .formulario-card::before{
            content:"";
            position:absolute;
            width:135px;
            height:135px;
            border-radius:50%;
            background:rgba(244,201,214,.30);
            top:-48px;
            right:-48px;
        }

        .formulario-card fieldset{
            position:relative;
            z-index:1;
        }

        .titulo-formulario{
            font-family:"Anton", sans-serif;
            font-size:32px;
            letter-spacing:1px;
            text-transform:uppercase;
            margin-bottom:8px;
        }

        .linea-rosa{
            border:none;
            border-top:4px solid var(--rosa-fuerte);
            width:65px;
            opacity:1;
            margin:0 0 28px;
        }

        .form-label{
            font-family:"Montserrat", sans-serif;
            font-size:12px;
            font-weight:900;
            letter-spacing:1px;
            text-transform:uppercase;
            color:#666;
        }

        .form-control,
        .form-select{
            font-family:"Montserrat", sans-serif;
            border:1px solid #d9d5cf !important;
            border-radius:15px !important;
            padding:13px 15px !important;
            background:#fcfbf8;
        }

        .form-control:focus,
        .form-select:focus{
            background:white;
            border-color:var(--rosa-fuerte) !important;
            box-shadow:0 0 0 .2rem rgba(232,107,152,.14);
        }

        .texto-ayuda{
            display:block;
            color:#777;
            font-size:12px;
            margin-top:7px;
            line-height:1.5;
        }

        .campos-obligatorios{
            font-size:12px;
            color:#666;
            margin-top:10px;
        }

        .btn-formulario{
            width:100%;
            background:var(--negro);
            color:white;
            border:none;
            border-radius:27px;
            padding:14px;
            font-family:"Montserrat", sans-serif;
            font-size:13px;
            font-weight:900;
            letter-spacing:1px;
            text-transform:uppercase;
            transition:.3s;
        }

        .btn-formulario:hover{
            background:var(--rosa-fuerte);
            color:white;
            transform:translateY(-2px);
        }

        .form-check-input:checked{
            background-color:var(--rosa-fuerte);
            border-color:var(--rosa-fuerte);
        }

        .mensaje-error{
            display:block;
            color:#dc3545;
            font-size:13px;
            margin-top:6px;
            font-weight:700;
        }

        .invalid-feedback{
            font-size:13px;
            font-weight:600;
        }


        .footer-alumnos{
            background:#111;
            color:white;
            padding:45px 0 22px;
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
            margin-right:18px;
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


        @media(max-width:768px){

            .zona-alumnos{
                padding:110px 15px 60px;
            }

            .encabezado-alumnos{
                padding:32px 27px;
                border-radius:25px;
            }

            .encabezado-alumnos h1{
                font-size:43px;
            }

            .formulario-card{
                padding:30px 23px !important;
                border-radius:25px;
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


<main class="zona-alumnos">

    <section class="encabezado-alumnos">

        <div class="encabezado-contenido">

            <small>
                STUDIO GYM DANCE
            </small>

            <h1>
                TU ESPACIO PARA
                <span>BAILAR</span>
            </h1>

            <p>
                Iniciá sesión para acceder a tu panel o creá una cuenta
                para comprar packs, inscribirte a clases y disfrutar
                todo el contenido del estudio.
            </p>

        </div>

    </section>

    <div class="contenedor-formularios">

        <div class="row g-4 justify-content-center">

            <!-- INICIAR SESIÓN -->

            <div class="col-lg-5">

                <form
                    action="login.php"
                    method="POST"
                    class="formulario-card"
                >

                    <fieldset>

                        <legend class="titulo-formulario">
                            Iniciar sesión
                        </legend>

                        <hr class="linea-rosa">

                        <div class="mb-4">

                            <label class="form-label">
                                Tipo de documento
                            </label>

                            <select
                                name="id_tipo_documento"
                                class="form-select"
                            >

                                <option value="">
                                    Seleccionar
                                </option>

                                <?php

                                $consultaTipoLogin = mysqli_query(
                                    $conexion,
                                    "SELECT id_tipo_doc, nombre_tipo
                                     FROM tipos_documento
                                     ORDER BY nombre_tipo"
                                );

                                while (
                                    $tipoLogin =
                                    mysqli_fetch_assoc($consultaTipoLogin)
                                ) {

                                ?>

                                    <option
                                        value="<?php echo $tipoLogin["id_tipo_doc"]; ?>"
                                    >
                                        <?php echo htmlspecialchars(
                                            $tipoLogin["nombre_tipo"]
                                        ); ?>
                                    </option>

                                <?php } ?>

                            </select>

                            <small class="texto-ayuda">
                                Solo los alumnos deben seleccionar un tipo
                                de documento. Profesores y administradores
                                pueden dejarlo vacío.
                            </small>

                        </div>

                        <div class="mb-4">

                            <label
                                for="loginDni"
                                class="form-label"
                            >
                                Documento, correo o usuario
                                <span style="color:red;">*</span>
                            </label>

                            <input
                                type="text"
                                id="loginDni"
                                name="dni"
                                class="form-control"
                                placeholder="Ingresá tu documento, correo o usuario"
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
                            class="btn-formulario"
                        >
                            Ingresar al panel
                        </button>

                    </fieldset>

                </form>

            </div>

            <!-- REGISTRO -->

            <div class="col-lg-7">

                <form
                    action="registrar.php"
                    method="POST"
                    id="formRegistro"
                    class="formulario-card needs-validation"
                    novalidate
                >

                    <fieldset>

                        <legend class="titulo-formulario">
                            Crear mi cuenta
                        </legend>

                        <hr class="linea-rosa">

                        <div class="row">

                            <div class="col-md-6 mb-4">

                                <label
                                    for="regNombre"
                                    class="form-label"
                                >
                                    Nombre
                                    <span style="color:red;">*</span>
                                </label>

                                <input
                                    type="text"
                                    id="regNombre"
                                    name="nombre"
                                    class="form-control
                                    <?php
                                    echo $error_nombre !== ""
                                        ? "is-invalid"
                                        : "";
                                    ?>"
                                    placeholder="Tu nombre"
                                    value="<?php echo htmlspecialchars(
                                        $datos_formulario["nombre"] ?? ""
                                    ); ?>"
                                    pattern="[A-Za-zÁÉÍÓÚáéíóúñÑüÜ ]+"
                                    required
                                >

                                <?php if($error_nombre !== "") { ?>

                                    <div class="mensaje-error">
                                        <?php echo htmlspecialchars(
                                            $error_nombre
                                        ); ?>
                                    </div>

                                <?php } else { ?>

                                    <div class="invalid-feedback">
                                        El nombre solo puede contener letras.
                                    </div>

                                <?php } ?>

                            </div>

                            <div class="col-md-6 mb-4">

                                <label
                                    for="regApellido"
                                    class="form-label"
                                >
                                    Apellido
                                    <span style="color:red;">*</span>
                                </label>

                                <input
                                    type="text"
                                    id="regApellido"
                                    name="apellido"
                                    class="form-control"
                                    placeholder="Tu apellido"
                                    value="<?php echo htmlspecialchars(
                                        $datos_formulario["apellido"] ?? ""
                                    ); ?>"
                                    pattern="[A-Za-zÁÉÍÓÚáéíóúñÑüÜ ]+"
                                    required
                                >

                                <div class="invalid-feedback">
                                    El apellido solo puede contener letras.
                                </div>

                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-6 mb-4">

                                <label
                                    for="regDni"
                                    class="form-label"
                                >
                                    Número de documento
                                    <span style="color:red;">*</span>
                                </label>

                                <input
                                    type="text"
                                    id="regDni"
                                    name="dni"
                                    class="form-control"
                                    placeholder="Sin puntos"
                                    value="<?php echo htmlspecialchars(
                                        $datos_formulario["dni"] ?? ""
                                    ); ?>"
                                    inputmode="numeric"
                                    pattern="[0-9]{7,15}"
                                    required
                                >

                                <div class="invalid-feedback">
                                    Debe contener entre 7 y 15 números.
                                </div>

                            </div>

                            <div class="col-md-6 mb-4">

                                <label class="form-label">
                                    Tipo de documento
                                    <span style="color:red;">*</span>
                                </label>

                                <select
                                    name="id_tipo_documento"
                                    class="form-select"
                                    required
                                >

                                    <option value="">
                                        Seleccionar
                                    </option>

                                    <?php while(
                                        $fila =
                                        mysqli_fetch_assoc(
                                            $resultadoTipoDocumento
                                        )
                                    ) { ?>

                                        <option
                                            value="<?php echo $fila["id_tipo_doc"]; ?>"
                                        >
                                            <?php echo htmlspecialchars(
                                                $fila["nombre_tipo"]
                                            ); ?>
                                        </option>

                                    <?php } ?>

                                </select>

                                <div class="invalid-feedback">
                                    Seleccioná un tipo de documento.
                                </div>

                            </div>

                        </div>

                        <div class="mb-4">

                            <label
                                for="regFch"
                                class="form-label"
                            >
                                Fecha de nacimiento
                                <span style="color:red;">*</span>
                            </label>

                            <input
                                type="date"
                                id="regFch"
                                name="fecha_nacimiento"
                                class="form-control"
                                value="<?php echo htmlspecialchars(
                                    $datos_formulario["fecha_nacimiento"] ?? ""
                                ); ?>"
                                max="<?php echo date("Y-m-d"); ?>"
                                required
                            >

                            <div class="invalid-feedback">
                                Seleccioná una fecha válida que no sea
                                posterior a hoy.
                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-6 mb-4">

                                <label
                                    for="regTel"
                                    class="form-label"
                                >
                                    Teléfono
                                    <span style="color:red;">*</span>
                                </label>

                                <input
                                    type="tel"
                                    id="regTel"
                                    name="telefono"
                                    class="form-control"
                                    placeholder="Tu teléfono"
                                    value="<?php echo htmlspecialchars(
                                        $datos_formulario["telefono"] ?? ""
                                    ); ?>"
                                    inputmode="numeric"
                                    pattern="[0-9]{6,15}"
                                    required
                                >

                                <div class="invalid-feedback">
                                    El teléfono debe contener solamente números.
                                </div>

                            </div>

                            <div class="col-md-6 mb-4">

                                <label
                                    for="regEmail"
                                    class="form-label"
                                >
                                    Correo electrónico
                                    <span style="color:red;">*</span>
                                </label>

                                <input
                                    type="email"
                                    id="regEmail"
                                    name="email"
                                    class="form-control"
                                    placeholder="ejemplo@gmail.com"
                                    value="<?php echo htmlspecialchars(
                                        $datos_formulario["email"] ?? ""
                                    ); ?>"
                                    pattern="[a-zA-Z0-9._%+\-]+@gmail\.com"
                                    title="El correo debe terminar en @gmail.com"
                                    required
                                >

                                <div class="invalid-feedback">
                                    Ingresá un correo válido terminado
                                    en @gmail.com.
                                </div>

                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-6 mb-4">

                                <label
                                    for="regPassword"
                                    class="form-label"
                                >
                                    Contraseña
                                    <span style="color:red;">*</span>
                                </label>

                                <input
                                    type="password"
                                    id="regPassword"
                                    name="password"
                                    class="form-control"
                                    placeholder="Mínimo 6 caracteres"
                                    minlength="6"
                                    required
                                >

                                <div class="invalid-feedback">
                                    La contraseña debe tener al menos
                                    6 caracteres.
                                </div>

                            </div>

                            <div class="col-md-6 mb-4">

                                <label
                                    for="regPassword1"
                                    class="form-label"
                                >
                                    Confirmar contraseña
                                    <span style="color:red;">*</span>
                                </label>

                                <input
                                    type="password"
                                    id="regPassword1"
                                    name="confirmar_password"
                                    class="form-control"
                                    placeholder="Repetí tu contraseña"
                                    minlength="6"
                                    required
                                >

                                <div class="invalid-feedback">
                                    Las contraseñas deben coincidir.
                                </div>

                            </div>

                        </div>

                        <p class="campos-obligatorios">
                            <span style="color:red;">*</span>
                            Campos obligatorios
                        </p>

                        <button
                            type="submit"
                            class="btn-formulario"
                        >
                            Crear cuenta
                        </button>

                    </fieldset>

                </form>

            </div>

        </div>

    </div>

</main>

<footer class="footer-alumnos">

    <div class="container">

        <div class="row align-items-center g-4">

            <div class="col-md-6">

                <div class="footer-marca">
                    Studio Gym Dance
                </div>

                <p class="footer-texto mt-2 mb-0">
                    Un espacio para aprender, expresarte y disfrutar la danza.
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

<script>

document.addEventListener("DOMContentLoaded", function(){

    const formulario = document.getElementById("formRegistro");
    const password = document.getElementById("regPassword");
    const confirmar = document.getElementById("regPassword1");

    function validarPasswords(){

        if(password.value !== confirmar.value){
            confirmar.setCustomValidity(
                "Las contraseñas no coinciden"
            );
        }else{
            confirmar.setCustomValidity("");
        }

    }

    password.addEventListener("input", validarPasswords);
    confirmar.addEventListener("input", validarPasswords);

    formulario.addEventListener("submit", function(evento){

        validarPasswords();

        if(!formulario.checkValidity()){
            evento.preventDefault();
            evento.stopPropagation();
        }

        formulario.classList.add("was-validated");

    });

});

</script>

</body>
</html>