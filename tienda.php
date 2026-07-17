<?php
session_start();
include("conexion.php");


$sql = "SELECT * FROM productos";
$resultado = mysqli_query($conexion, $sql);



$sqlTalles = "SELECT * FROM talles";
$resultadoTalles = mysqli_query($conexion, $sqlTalles);

$talles = [];

while($talle = mysqli_fetch_assoc($resultadoTalles)){
    $talles[] = $talle;
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

    <title>Tienda Studio Gym Dance</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
        rel="stylesheet"
    >

    <link
        href="https://fonts.googleapis.com/css2?family=Anton&family=Montserrat:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet"
    >

    <style>

        :root{
            --negro:#111111;
            --rosa:#f4c9d6;
            --rosa-fuerte:#e86b98;
            --fondo:#f6f4ee;
            --blanco:#ffffff;
            --texto:#2e2723;
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
            background:
                radial-gradient(#e8e4d8 25%, transparent 25%);
            background-size:50px 50px;
            background-color:var(--fondo);
            color:var(--texto);
            font-family:"Montserrat", sans-serif;
        }

    

        .shop-container{
            width:92%;
            max-width:1250px;
            margin:0 auto;
            padding-top:125px;
            padding-bottom:80px;
        }

        
        .hero-shop{
            display:grid;
            grid-template-columns:1.05fr .95fr;
            gap:28px;
            margin-bottom:32px;
        }

        .hero-card-img{
            min-height:460px;
            position:relative;
            overflow:hidden;
            border-radius:32px;
            background:#111;
            box-shadow:0 15px 45px rgba(0,0,0,.12);
        }

        .hero-card-img img{
            width:100%;
            height:460px;
            display:block;
            object-fit:cover;
            filter:grayscale(12%);
        }

        .hero-card-img::after{
            content:"";
            position:absolute;
            inset:0;
            background:linear-gradient(
                to top,
                rgba(17,17,17,.65),
                rgba(17,17,17,.05) 60%
            );
            pointer-events:none;
        }

        .mini-info{
            position:absolute;
            z-index:2;
            left:28px;
            bottom:28px;
            width:calc(100% - 56px);
            max-width:320px;
            padding:24px;
            border-radius:23px;
            background:rgba(255,255,255,.91);
            backdrop-filter:blur(7px);
        }

        .mini-info h3{
            margin:0;
            color:#111;
            font-family:"Anton", sans-serif;
            font-size:31px;
        }

        .mini-info p{
            margin:8px 0 12px;
            color:#555;
            font-size:13px;
            line-height:1.6;
        }

        .mini-info a{
            color:var(--rosa-fuerte);
            text-decoration:none;
            font-weight:900;
        }

        .hero-text{
            min-height:460px;
            display:flex;
            flex-direction:column;
            justify-content:center;
            position:relative;
            overflow:hidden;
            padding:50px;
            border-radius:32px;
            background:white;
            box-shadow:0 15px 45px rgba(0,0,0,.10);
        }

        .hero-text::after{
            content:"";
            position:absolute;
            width:230px;
            height:230px;
            border-radius:50%;
            top:-90px;
            right:-80px;
            background:rgba(244,201,214,.40);
        }

        .hero-text > *{
            position:relative;
            z-index:1;
        }

        .hero-text small{
            color:var(--rosa-fuerte);
            font-size:12px;
            font-weight:900;
            letter-spacing:3px;
        }

        .hero-text h1{
            margin:14px 0 22px;
            color:#111;
            font-family:"Anton", sans-serif;
            font-size:72px;
            line-height:.95;
        }

        .hero-text h1 span{
            color:var(--rosa-fuerte);
        }

        .hero-text p{
            max-width:520px;
            margin:0;
            color:#555;
            font-size:17px;
            line-height:1.75;
        }

        .btn-negro{
            display:inline-flex;
            align-items:center;
            gap:8px;
            width:max-content;
            margin-top:25px;
            padding:13px 25px;
            border-radius:28px;
            background:#111;
            color:white;
            text-decoration:none;
            font-weight:900;
            transition:.3s;
        }

        .btn-negro:hover{
            background:var(--rosa-fuerte);
            color:white;
            transform:translateY(-2px);
        }

     

        .bloques-shop{
            display:grid;
            grid-template-columns:repeat(4,1fr);
            gap:20px;
            margin-bottom:35px;
        }

        .bloque{
            min-height:170px;
            display:flex;
            flex-direction:column;
            justify-content:flex-end;
            position:relative;
            overflow:hidden;
            padding:27px;
            border:1px solid #eee8e0;
            border-radius:27px;
            background:white;
            box-shadow:0 10px 28px rgba(0,0,0,.07);
            transition:.3s;
        }

        .bloque::after{
            content:"";
            position:absolute;
            width:110px;
            height:110px;
            border-radius:50%;
            right:-40px;
            top:-42px;
            background:rgba(244,201,214,.30);
        }

        .bloque:hover{
            transform:translateY(-6px);
            box-shadow:0 16px 35px rgba(0,0,0,.11);
        }

        .bloque h3,
        .bloque p{
            position:relative;
            z-index:1;
        }

        .bloque h3{
            margin:0 0 7px;
            color:#111;
            font-family:"Anton", sans-serif;
            font-size:33px;
        }

        .bloque p{
            margin:0;
            color:#666;
            font-size:13px;
            line-height:1.6;
        }

        .bloque.rosa{
            background:linear-gradient(135deg,#fff,#f4c9d6);
        }

        .bloque.negro{
            background:linear-gradient(135deg,#111,#2b2b2b);
        }

        .bloque.negro::after{
            background:rgba(244,201,214,.14);
        }

        .bloque.negro h3{
            color:var(--rosa);
        }

        .bloque.negro p{
            color:#ddd;
        }

     

        .promo-shop{
            display:flex;
            justify-content:space-between;
            align-items:center;
            gap:25px;
            position:relative;
            overflow:hidden;
            margin-bottom:65px;
            padding:42px 46px;
            border-radius:31px;
            background:linear-gradient(100deg,#fff,#f4c9d6);
            box-shadow:0 12px 35px rgba(0,0,0,.08);
        }

        .promo-shop::after{
            content:"";
            position:absolute;
            width:230px;
            height:230px;
            border-radius:50%;
            right:-85px;
            bottom:-120px;
            background:rgba(255,255,255,.45);
        }

        .promo-shop > *{
            position:relative;
            z-index:1;
        }

        .promo-shop h2{
            margin:0;
            color:#111;
            font-family:"Anton", sans-serif;
            font-size:56px;
        }

        .promo-shop h2 span{
            color:var(--rosa-fuerte);
        }

        .promo-shop p{
            margin:6px 0 0;
            color:#555;
        }

     

        .encabezado-productos{
            margin-bottom:32px;
        }

        .etiqueta-productos{
            color:var(--rosa-fuerte);
            font-size:12px;
            font-weight:900;
            letter-spacing:3px;
        }

        .titulo-productos{
            margin:8px 0 12px;
            color:#111;
            font-family:"Anton", sans-serif;
            font-size:50px;
            text-transform:uppercase;
        }

        .titulo-productos span{
            color:var(--rosa-fuerte);
        }

        .texto-productos{
            max-width:680px;
            margin:0;
            color:#666;
            line-height:1.7;
        }

     

        .productos{
            display:grid;
            grid-template-columns:repeat(
                auto-fit,
                minmax(260px,1fr)
            );
            gap:27px;
            margin-bottom:65px;
        }

        .card-productos{
            display:flex;
            flex-direction:column;
            position:relative;
            overflow:hidden;
            padding:18px;
            border:1px solid #eee8e0;
            border-radius:28px;
            background:white;
            box-shadow:0 12px 32px rgba(0,0,0,.08);
            transition:.3s;
        }

        .card-productos::after{
            content:"";
            position:absolute;
            width:110px;
            height:110px;
            border-radius:50%;
            top:-48px;
            right:-45px;
            background:rgba(244,201,214,.24);
            pointer-events:none;
        }

        .card-productos:hover{
            transform:translateY(-8px);
            border-color:var(--rosa);
            box-shadow:0 18px 42px rgba(0,0,0,.13);
        }

        .producto-img{
            width:100%;
            height:265px;
            overflow:hidden;
            border-radius:22px;
            background:#f8e9ee;
        }

        .producto-img img{
            width:100%;
            height:100%;
            object-fit:cover;
            transition:.4s;
        }

        .card-productos:hover .producto-img img{
            transform:scale(1.04);
        }

        .badge-nuevo{
            display:inline-block;
            width:max-content;
            position:relative;
            z-index:1;
            margin:15px 0 8px;
            padding:6px 14px;
            border-radius:20px;
            background:#111;
            color:white;
            font-size:11px;
            font-weight:900;
        }

        .card-productos h3{
            min-height:72px;
            margin:4px 0;
            color:#111;
            font-family:"Anton", sans-serif;
            font-size:30px;
        }

        .precio{
            margin-bottom:17px;
            color:var(--rosa-fuerte);
            font-size:26px;
            font-weight:900;
        }

        .card-productos form{
            display:flex;
            flex-direction:column;
            flex:1;
        }

        .campo-producto label{
            display:block;
            margin-bottom:6px;
            color:#555;
            font-size:11px;
            font-weight:900;
            letter-spacing:1px;
            text-transform:uppercase;
        }

        .campo-producto select,
        .campo-producto input{
            width:100%;
            padding:11px 13px;
            border:1px solid #ddd8d2;
            border-radius:14px;
            background:#fcfbf8;
        }

        .campo-producto select:focus,
        .campo-producto input:focus{
            border-color:var(--rosa-fuerte);
            box-shadow:0 0 0 .2rem rgba(232,107,152,.13);
        }

        .botones-producto{
            display:grid;
            grid-template-columns:1fr 1fr;
            gap:10px;
            margin-top:auto;
            padding-top:5px;
        }

        .btn-agregar,
        .btn-ver{
            display:flex;
            justify-content:center;
            align-items:center;
            gap:5px;
            min-height:46px;
            border-radius:22px;
            padding:11px 8px;
            font-size:13px;
            font-weight:900;
            transition:.3s;
        }

        .btn-agregar{
            border:none;
            background:var(--rosa);
            color:#2e2723;
        }

        .btn-agregar:hover{
            background:var(--rosa-fuerte);
            color:white;
            transform:translateY(-2px);
        }

        .btn-ver{
            background:#111;
            color:white;
            text-align:center;
            text-decoration:none;
        }

        .btn-ver:hover{
            background:#333;
            color:white;
            transform:translateY(-2px);
        }

       

        .beneficios{
            display:grid;
            grid-template-columns:repeat(3,1fr);
            gap:20px;
        }

        .beneficio{
            min-height:120px;
            display:flex;
            align-items:center;
            gap:17px;
            padding:25px;
            border:1px solid #eee8e0;
            border-radius:25px;
            background:white;
            box-shadow:0 9px 27px rgba(0,0,0,.06);
            transition:.3s;
        }

        .beneficio:hover{
            transform:translateY(-5px);
            border-color:var(--rosa);
            box-shadow:0 14px 32px rgba(0,0,0,.10);
        }

        .beneficio i{
            width:56px;
            height:56px;
            flex-shrink:0;
            display:flex;
            justify-content:center;
            align-items:center;
            border-radius:50%;
            background:#fdf2f6;
            color:var(--rosa-fuerte);
            font-size:25px;
        }

        .beneficio p{
            margin:0;
            color:#333;
            font-size:14px;
            font-weight:900;
        }

     

        .modal-content{
            overflow:hidden;
            border:none;
            border-radius:30px;
            box-shadow:0 20px 60px rgba(0,0,0,.25);
        }

        .modal-backdrop.show{
            opacity:.75;
        }

        .modal-header-login{
            padding:21px 25px;
            border:none;
            background:var(--rosa);
        }

        .modal-body-login{
            padding:35px 30px;
            text-align:center;
        }

        .modal-body-login .icono-modal{
            color:var(--rosa-fuerte);
            font-size:65px;
        }

        .modal-footer-login{
            display:flex;
            justify-content:center;
            gap:10px;
            padding:0 25px 30px;
            border:none;
        }

        .btn-modal-negro,
        .btn-modal-rosa{
            display:inline-flex;
            align-items:center;
            gap:7px;
            padding:11px 25px;
            border-radius:28px;
            text-decoration:none;
            font-weight:900;
        }

        .btn-modal-negro{
            background:#111;
            color:white;
        }

        .btn-modal-negro:hover{
            background:#333;
            color:white;
        }

        .btn-modal-rosa{
            border:2px solid var(--rosa);
            color:var(--rosa-fuerte);
        }

        .btn-modal-rosa:hover{
            background:var(--rosa);
            color:#111;
        }

        .footer-tienda{
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
            color:#ccc;
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
            margin-top:30px;
            padding-top:20px;
            border-top:1px solid rgba(255,255,255,.12);
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


        @media(max-width:950px){

            .hero-shop{
                grid-template-columns:1fr;
            }

            .bloques-shop{
                grid-template-columns:1fr 1fr;
            }

            .beneficios{
                grid-template-columns:1fr;
            }
        }

        @media(max-width:650px){

            .shop-container{
                width:94%;
                padding-top:105px;
            }

            .hero-card-img,
            .hero-card-img img{
                min-height:380px;
                height:380px;
            }

            .hero-text{
                min-height:auto;
                padding:36px 26px;
            }

            .hero-text h1{
                font-size:50px;
            }

            .mini-info{
                left:18px;
                bottom:18px;
                width:calc(100% - 36px);
                max-width:none;
            }

            .bloques-shop{
                grid-template-columns:1fr;
            }

            .promo-shop{
                flex-direction:column;
                align-items:flex-start;
                padding:35px 25px;
            }

            .promo-shop h2{
                font-size:45px;
            }

            .titulo-productos{
                font-size:41px;
            }

            .botones-producto{
                grid-template-columns:1fr;
            }

            .modal-footer-login{
                flex-direction:column;
            }

            .btn-modal-negro,
            .btn-modal-rosa{
                width:100%;
                justify-content:center;
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


<main class="shop-container">

  

    <section class="hero-shop">

        <div class="hero-card-img">

            <img
                src="https://i.ibb.co/gL0y3wdf/IMG-5280.png"
                alt="Productos de danza"
            >

            <div class="mini-info">

                <h3>
                    Todo para tus clases
                </h3>

                <p>
                    Productos seleccionados para acompañarte
                    en cada paso.
                </p>

                <a href="#productos">
                    Ver productos →
                </a>

            </div>

        </div>

        <div class="hero-text">

            <small>
                TIENDA STUDIO GYM DANCE
            </small>

            <h1>
                TU DANZA,<br>
                <span>TU ESENCIA.</span>
            </h1>

            <p>
                Encontrá indumentaria, accesorios y productos
                pensados para tus clases, ensayos y presentaciones.
            </p>

            <a href="carrito.php" class="btn-negro">

                <i class="bi bi-cart3"></i>

                Ver carrito

            </a>
      
        </div>

    </section>


    <section class="bloques-shop">

        <div class="bloque rosa">

            <h3>
                Calzado
            </h3>

            <p>
                Zapatillas y calzado para tus clases.
            </p>

        </div>

        <div class="bloque">

            <h3>
                Ropa
            </h3>

            <p>
                Mallas, polleras y prendas para bailar.
            </p>

        </div>

        <div class="bloque negro">

            <h3>
                Accesorios
            </h3>

            <p>
                Mochilas y elementos para acompañar tu entrenamiento.
            </p>

        </div>

        <div class="bloque rosa">

            <h3>
                Entrenamiento
            </h3>

            <p>
                Todo lo necesario para disfrutar cada clase.
            </p>

        </div>

    </section>

    <!-- PROMOCIÓN -->

    <section class="promo-shop">

        <div>

            <h2>
                <span>-10%</span> OFF
            </h2>

            <p>
                En tu primera compra en la tienda del estudio.
            </p>

        </div>

        <a href="#productos" class="btn-negro">
            Ver productos
        </a>

    </section>

    <!-- ENCABEZADO PRODUCTOS -->

    <section
        class="encabezado-productos"
        id="productos"
    >

        <span class="etiqueta-productos">
            TIENDA DEL ESTUDIO
        </span>

        <h2 class="titulo-productos">
            Productos
            <span>destacados</span>
        </h2>

        <p class="texto-productos">
            Elegí el producto que más te guste, seleccioná el talle
            y la cantidad, y agregalo a tu carrito.
        </p>

    </section>

    <!-- PRODUCTOS -->

    <section class="productos">

        <?php while($fila = mysqli_fetch_assoc($resultado)){ ?>

            <article class="card-productos">

                <div class="producto-img">

                    <img
                        src="<?php echo $fila['imagen']; ?>"
                        alt="<?php echo $fila['nombre_producto']; ?>"
                    >

                </div>

                <span class="badge-nuevo">
                    NUEVO
                </span>

                <h3>
                    <?php echo $fila['nombre_producto']; ?>
                </h3>

                <div class="precio">

                    $<?php echo number_format(
                        $fila['precio'],
                        0,
                        ',',
                        '.'
                    ); ?>

                </div>

                <form
                    action="agregar_carrito.php"
                    method="POST"
                >

                    <input
                        type="hidden"
                        name="id_producto"
                        value="<?php echo $fila['id_producto']; ?>"
                    >

                    <div class="campo-producto mb-3">

                        <label>
                            Talle
                        </label>

                        <select
                            name="id_talle"
                            class="form-select"
                            required
                        >

                            <option value="">
                                Elegir talle
                            </option>

                            <?php foreach($talles as $talle){ ?>

                                <option
                                    value="<?php echo $talle['id_talle']; ?>"
                                >
                                    <?php echo $talle['nombre_talle']; ?>
                                </option>

                            <?php } ?>

                        </select>

                    </div>

                    <div class="campo-producto mb-3">

                        <label>
                            Cantidad
                        </label>

                        <input
                            type="number"
                            name="cantidad"
                            class="form-control"
                            value="1"
                            min="1"
                            required
                        >

                    </div>

                    <div class="botones-producto">

                        <button
                            type="submit"
                            class="btn-agregar"
                        >

                            <i class="bi bi-cart-plus"></i>

                            Agregar

                        </button>

                        <a
                            href="producto.php?id=<?php echo $fila['id_producto']; ?>"
                            class="btn-ver"
                        >
                            Ver producto
                        </a>

                    </div>

                </form>

            </article>

        <?php } ?>

    </section>

    <!-- BENEFICIOS -->

    <section class="beneficios">

        <div class="beneficio">

            <i class="bi bi-credit-card"></i>

            <p>
                Distintos medios de pago
            </p>

        </div>

        <div class="beneficio">

            <i class="bi bi-heart-fill"></i>

            <p>
                Productos seleccionados
            </p>

        </div>

        <div class="beneficio">

            <i class="bi bi-stars"></i>

            <p>
                Ideales para tus clases
            </p>

        </div>

    </section>

</main>

<!-- MODAL PARA USUARIOS SIN SESIÓN -->

<div
    class="modal fade"
    id="loginModal"
    tabindex="-1"
>

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-header modal-header-login">

                <h4 class="modal-title fw-bold text-dark">

                    <i class="bi bi-person-heart me-2"></i>

                    Iniciar sesión

                </h4>

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                ></button>

            </div>

            <div class="modal-body modal-body-login">

                <i class="bi bi-cart-x-fill icono-modal"></i>

                <h4 class="mt-3 fw-bold">
                    Necesitás iniciar sesión
                </h4>

                <p class="text-secondary mb-3">
                    Para comprar productos de la tienda primero
                    tenés que ingresar con tu cuenta de alumno.
                </p>

                <small class="text-muted">
                    ¿Todavía no sos alumno?<br>
                    Registrate para comprar, reservar clases
                    y acceder a tu panel.
                </small>

            </div>

            <div class="modal-footer modal-footer-login">

                <a
                    href="alumnos.php"
                    class="btn-modal-negro"
                >

                    <i class="bi bi-box-arrow-in-right"></i>

                    Iniciar sesión

                </a>

                <a
                    href="alumnos.php"
                    class="btn-modal-rosa"
                >

                    <i class="bi bi-person-plus"></i>

                    Inscribirme

                </a>

            </div>

        </div>

    </div>

</div>

<!-- FOOTER -->

<footer class="footer-tienda">

    <div class="container">

        <div class="row align-items-center g-4">

            <div class="col-md-6">

                <div class="footer-marca">
                    Studio Gym Dance
                </div>

                <p class="footer-texto mt-2 mb-0">
                    Productos para acompañarte en cada clase,
                    ensayo y presentación.
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

<?php if(isset($_GET['login'])){ ?>

    <script>

        window.addEventListener("load", function(){

            const modalLogin = new bootstrap.Modal(
                document.getElementById("loginModal")
            );

            modalLogin.show();

        });

    </script>

<?php } ?>

</body>
</html>