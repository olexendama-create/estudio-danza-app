<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start(); 
include("conexion.php");


$id_alumno = $_SESSION['id_alumno'];

$alumno = mysqli_query($conexion, "SELECT * FROM alumnos WHERE id_alumno='$id_alumno'");
$datosAlumno = mysqli_fetch_assoc($alumno);

$sql = "SELECT 
            d.nombre_disciplina,
            ds.nombre_dia,
            c.horario,
            i.estado
        FROM inscripciones i
        JOIN clases c 
            ON i.id_clase = c.id_clase
        JOIN disciplinas d 
            ON c.id_disciplina = d.id_disciplina
        JOIN dias_semanas ds 
            ON c.id_dia = ds.id_dia
        WHERE i.id_alumno = '$id_alumno'
        AND i.estado = 'Activa'
        AND NOT EXISTS (
            SELECT 1
            FROM asistencias a
            WHERE a.id_alumno = i.id_alumno
            AND a.id_clase = i.id_clase
            AND a.fecha >= DATE_SUB(
                CURDATE(),
                INTERVAL WEEKDAY(CURDATE()) DAY
            )
            AND a.fecha < DATE_ADD(
                DATE_SUB(
                    CURDATE(),
                    INTERVAL WEEKDAY(CURDATE()) DAY
                ),
                INTERVAL 7 DAY
            )
        )";

$resultado = mysqli_query($conexion, $sql);

$cantidadClases = mysqli_num_rows($resultado);

$resultado = mysqli_query($conexion, $sql);

$cantidadClases = mysqli_num_rows($resultado);

$id_alumno = $_SESSION['id_alumno'];

$sqlAsistencias = "SELECT COUNT(*) as total
                   FROM asistencias
                   WHERE id_alumno = '$id_alumno'
                   AND presente = 1
                   AND MONTH(fecha) = MONTH(CURDATE())
                   AND YEAR(fecha) = YEAR(CURDATE())";

$resultadoAsistencias = mysqli_query($conexion, $sqlAsistencias);
$filaAsistencias = mysqli_fetch_assoc($resultadoAsistencias);

$totalAsistencias = $filaAsistencias['total'];

$sqlPack = "SELECT 
                p.nombre_pack,
                pg.clases_restantes,
                pg.estado
            FROM pagos pg
            JOIN packs p ON pg.id_pack = p.id_pack
            WHERE pg.id_alumno = '$id_alumno'
            AND pg.estado = 'Activo'
            AND pg.clases_restantes > 0
            ORDER BY pg.id_pago DESC
            LIMIT 1";

$resultadoPack = mysqli_query($conexion, $sqlPack);

if(mysqli_num_rows($resultadoPack) > 0){

    $packActivo = mysqli_fetch_assoc($resultadoPack);

    $nombrePack = $packActivo['nombre_pack'];
    $clasesRestantes = $packActivo['clases_restantes'];

}else{

    $nombrePack = "Sin pack";
    $clasesRestantes = 0;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet">
    <title>Panel Alumno</title>


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
    background-color:var(--fondo) !important;
    font-family:'Montserrat', sans-serif;
    color:var(--negro);
}

.panel-hero{
    padding-top:100px !important;
    padding-bottom:55px !important;
}

.panel-hero .container{
    background:var(--blanco);
    border-radius:32px;
    padding:45px;
    box-shadow:0 15px 45px rgba(0,0,0,.09);
    overflow:hidden;
    position:relative;
}

.panel-hero .container::before{
    content:"";
    position:absolute;
    width:210px;
    height:210px;
    border-radius:50%;
    background:rgba(244,201,214,.35);
    top:-85px;
    left:-75px;
}

.panel-hero .row{
    position:relative;
    z-index:1;
}

.subtitulo-panel{
    color:var(--rosa-fuerte);
    font-size:13px;
    font-weight:900;
    letter-spacing:3px;
    margin-bottom:12px;
}

.hero-title{
    font-family:'Anton', sans-serif;
    font-size:68px;
    line-height:1;
    margin-bottom:20px;
    color:var(--negro);
}

.hero-title span{
    color:var(--rosa-fuerte);
}

.texto-panel{
    color:#555;
    font-size:17px;
    line-height:1.7;
    max-width:520px;
}

.img-hero{
    width:100%;
    max-width:500px;
    height:360px;
    object-fit:cover;
    border-radius:28px;
    filter:grayscale(100%);
    box-shadow:0 15px 35px rgba(0,0,0,.12);
}


.botones-panel{
    display:flex;
    gap:14px;
    flex-wrap:wrap;
    margin-top:28px;
}

.btn-horarios,
.btn-pack-panel{
    display:inline-block;
    text-decoration:none;
    padding:13px 24px;
    border-radius:30px;
    font-weight:800;
    transition:.3s;
}

.btn-horarios{
    background:var(--negro);
    color:white;
}

.btn-horarios:hover{
    background:var(--rosa-fuerte);
    color:white;
    transform:translateY(-2px);
}

.btn-pack-panel{
    background:var(--rosa);
    color:var(--negro);
}

.btn-pack-panel:hover{
    background:var(--negro);
    color:white;
    transform:translateY(-2px);
}


.alert-warning{
    background:#fff4f7;
    border:none;
    border-left:6px solid var(--rosa-fuerte);
    color:#4c3a40;
    border-radius:18px;
    padding:18px 22px;
    box-shadow:0 8px 25px rgba(0,0,0,.06);
}

.alert-warning .alert-link{
    color:var(--rosa-fuerte);
}


.cards-panel{
    margin-top:28px;
    margin-bottom:45px;
}

.card-info{
    background:var(--blanco);
    border:none;
    border-radius:25px;
    padding:28px;
    min-height:175px;
    box-shadow:0 12px 30px rgba(0,0,0,.08);
    transition:.3s;
    position:relative;
    overflow:hidden;
}

.card-info::after{
    content:"";
    position:absolute;
    width:100px;
    height:100px;
    border-radius:50%;
    background:rgba(244,201,214,.45);
    right:-35px;
    top:-35px;
}

.card-info:hover{
    transform:translateY(-7px);
    box-shadow:0 18px 40px rgba(0,0,0,.13);
}

.card-info p{
    margin:0 0 12px;
    color:#555;
    font-size:14px;
    font-weight:900;
    text-transform:uppercase;
    letter-spacing:1px;
    position:relative;
    z-index:1;
}

.card-info h2{
    font-family:'Anton', sans-serif;
    font-size:48px;
    margin:0 0 8px;
    color:var(--negro);
    position:relative;
    z-index:1;
}

.card-info span{
    color:#666;
    font-size:14px;
    position:relative;
    z-index:1;
}


.mis-clases{
    width:94%;
    margin:0 auto 60px;
    padding:45px !important;
    border-radius:32px;
    background:var(--blanco);
    box-shadow:0 15px 45px rgba(0,0,0,.09);
}

.mis-clases h3{
    font-family:'Anton', sans-serif;
    font-size:38px;
    text-transform:uppercase;
    margin-bottom:28px;
    color:var(--negro);
}

.clase-card{
    background:#faf8f5;
    border:1px solid #eee9e2;
    border-radius:20px;
    padding:22px 25px;
    margin-bottom:16px;
    display:flex;
    justify-content:space-between;
    align-items:center;
    transition:.3s;
}

.clase-card:hover{
    background:#fff4f7;
    border-color:var(--rosa);
    transform:translateX(5px);
}

.clase-card h4{
    font-size:20px;
    font-weight:900;
    margin-bottom:6px;
    color:var(--negro);
}

.clase-card p{
    margin:0;
    color:#666;
}

.clase-card small{
    color:#777;
}



.frase-card{
    min-height:390px;
    border-radius:28px;
    padding:42px;
    display:flex;
    align-items:flex-end;
    background-image:
        linear-gradient(
            rgba(17,17,17,.30),
            rgba(17,17,17,.75)
        ),
        url("https://i.ibb.co/fVGYvHNd/descarga-9.jpg");
    background-size:cover;
    background-position:center;
    box-shadow:0 12px 30px rgba(0,0,0,.12);
}

.frase-card h2{
    font-family:'Anton', sans-serif;
    font-size:39px;
    line-height:1.15;
    margin:0;
    color:white;
    text-transform:uppercase;
}

.frase-card h2 span{
    color:var(--rosa);
}



.boton-rosa{
    background:var(--rosa);
    color:var(--negro);
    border:none;
    border-radius:25px;
    padding:10px 20px;
    font-weight:800;
}

.boton-rosa:hover{
    background:var(--negro);
    color:white;
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

@media(max-width:992px){

    .hero-title{
        font-size:52px;
    }

    .img-hero{
        margin-top:35px;
        height:320px;
    }

    .mis-clases{
        width:92%;
        padding:30px !important;
    }

    .frase-card{
        margin-top:25px;
    }
}

@media(max-width:600px){

    .panel-hero .container{
        padding:28px;
        border-radius:24px;
    }

    .hero-title{
        font-size:43px;
    }

    .botones-panel{
        flex-direction:column;
    }

    .btn-horarios,
    .btn-pack-panel{
        width:100%;
        text-align:center;
    }

    .cards-panel{
        padding-left:20px !important;
        padding-right:20px !important;
    }

    .mis-clases{
        width:94%;
        padding:22px !important;
    }

    .clase-card{
        flex-direction:column;
        align-items:flex-start;
        gap:15px;
    }
}

.mensaje-vacio{
    background:#faf8f5;
    border:2px dashed #f4c9d6;
    border-radius:22px;
    padding:32px;
    text-align:center;
    color:#555;
    margin-bottom:25px;
}

.mensaje-vacio h4{
    color:#111;
    font-weight:900;
    margin-bottom:12px;
}

.mensaje-vacio p{
    margin-bottom:18px;
    line-height:1.6;
}

.mensaje-vacio a{
    display:inline-block;
    background:#111;
    color:white;
    text-decoration:none;
    padding:11px 22px;
    border-radius:25px;
    font-weight:800;
}

.mensaje-vacio a:hover{
    background:#e86b98;
    color:white;
}


</style>

   
</head>
<body class="panel_alumno">
    
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

<section class="panel-hero py-5 mt-5">
    <div class="container">

        <div class="row align-items-center">

            <div class="col-lg-6">

                <p class="subtitulo-panel">BIENVENIDA/O</p>

                <h1 class="hero-title">
                    ¡HOLA,
                    <span><?php echo strtoupper($datosAlumno['nombre']); ?>!</span>
                </h1>

                <p class="texto-panel">
                    Este es tu espacio personal para vivir tu pasión por la danza.
                </p>

                <div class="botones-panel">
               
                <a href="./disciplinas_panel.php?ver_horarios=1#calendario"
                   class="btn-horarios">
                    Inscribirme a nuevas clases →
                </a>

                <a href="packs.php" class="btn-pack-panel">
                    Comprar pack
                </a> 

                </div>
            </div>

            <div class="col-lg-6 text-center">

                <img src="https://i.ibb.co/fVGYvHNd/descarga-9.jpg"
                     class="img-fluid img-hero"
                     alt="Danza">

            </div>

        </div>

    </div>
</section>

  <?php  if((int)$clasesRestantes == 0): ?>   
  
  <div class="container mt-4">
    
     <div class="alert alert-warning text-center">

        <strong>No tenes un pack activo.</strong>

        Para inscribirte a clases primero tenes que adquerir uno.

        <a href="packs.php" class="alert-link">
            Ver packs disponibles
        </a>

     </div>

  </div>

  <?php endif; ?>

<section class="container-fluid px-5 cards-panel">
    <div class="row g-4">

        <div class="col-md-3">
            <div class="card-info">
                <p>Mis Clases</p>
                <h2><?php echo $cantidadClases; ?></h2>
                <span>clases activas</span>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card-info">
                <p>Asistencias</p>
                <h2><?php echo $totalAsistencias; ?></h2>
                <span>este mes</span>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card-info">
                <p>Mi Pack</p>
                <h2><?php echo $clasesRestantes; ?></h2>
                <span><?php echo $nombrePack; ?> 
                  - clases disponibles            
            </span>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card-info">
                <p>Próximas clases</p>
                <h2><?php echo $cantidadClases; ?></h2>
                <span>esta semana</span>
            </div>
        </div>

    </div>
</section>

<section class="container-fluid px-5 mis-clases">
    <div class="row">
        <div class="col-md-7">
            <h3>Mis clases</h3>

    <?php if(mysqli_num_rows($resultado) > 0){ ?>

    <?php while($fila = mysqli_fetch_assoc($resultado)){ ?>

        <div class="clase-card">
            <div>
                <h4><?php echo $fila['nombre_disciplina']; ?></h4>

                <p>
                    <?php echo $fila['nombre_dia']; ?>
                    -
                    <?php echo $fila['horario']; ?> hs
                </p>
            </div>
        </div>

    <?php } ?>

<?php }else{ ?>

    <div class="mensaje-vacio">

        <h4>Todavía no estás inscripto a ninguna clase</h4>

        <p>
            Para ver tus clases en este espacio, primero tenés que elegir
            un horario e inscribirte.
        </p>

        <a href="disciplinas_panel.php?ver_horarios=1#calendario">
            Ver clases disponibles
        </a>

    </div>

<?php } ?>

        </div>

        <div class="col-md-5">
            <div class="frase-card">
                <h2>Seguí <span>bailando,</span><br>
                    seguí <span>creciendo,</span><br>
                    seguí <span>brillando.</span>
                </h2>

            </div>
        </div>
    </div>

<h3>Material de clases</h3>

<?php
$sqlMaterial = "SELECT 
                    m.titulo,
                    m.descripcion,
                    m.archivo,
                    d.nombre_disciplina
                FROM materiales m
                JOIN clases c ON m.id_clase = c.id_clase
                JOIN disciplinas d ON c.id_disciplina = d.id_disciplina
                JOIN inscripciones i ON i.id_clase = c.id_clase
                WHERE i.id_alumno = '$id_alumno'";

$materiales = mysqli_query($conexion, $sqlMaterial);
?>

<?php if(mysqli_num_rows($materiales) > 0){ ?>

    <?php while($mat = mysqli_fetch_assoc($materiales)){ ?>

        <div class="clase-card">

            <div>
                <h4><?php echo $mat['titulo']; ?></h4>

                <p>
                    <?php echo $mat['nombre_disciplina']; ?>
                </p>

                <small>
                    <?php echo $mat['descripcion']; ?>
                </small>
            </div>

            <a
                href="./<?php echo $mat['archivo']; ?>"
                target="_blank"
                class="btn boton-rosa"
            >
                Ver material
            </a>

        </div>

    <?php } ?>

<?php }else{ ?>

    <div class="mensaje-vacio">

        <h4>No tenés material disponible</h4>

        <p>
            El material de estudio aparecerá acá cuando estés inscripto
            a una clase y el profesor publique contenido.
        </p>

    </div>

<?php } ?>

</section>














</body>
</html>

































<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
