<?php
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
        JOIN clases c ON i.id_clase = c.id_clase
        JOIN disciplinas d ON c.id_disciplina = d.id_disciplina
        JOIN dias_semanas ds ON c.id_dia = ds.id_dia
        WHERE i.id_alumno = '$id_alumno'";

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
   
</head>
<body class="panel_alumno">
    
<nav id="mainNavbar" class="navbar navbar-expand-lg fixed-top py-3" style="background-color: #000;">
  <div class="container-fluid">
    <a class="navbar-brand fw-bold" href="#" style="color: #F4C9D6; letter-spacing: 1px;">Studio Gym Dance</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <a class="nav-link active" style="color: #F2F1ED;" href="index.html">Inicio</a>
        <a class="nav-link" style="background-color: #F4C9D6; color: #3E2723; border-radius: 80%;" href="alumnos.php">Alumnos</a>
        <a class="nav-link"style="color: #F2F1ED;"  href="disciplinas_panel.php">Disciplinas y Horarios</a>
        <a class="nav-link"style="color: #F2F1ED;"  href="profesores.html">Profesores</a>
        <a class="nav-link" style="background-color: #F4C9D6; color: #3E2723; border-radius: 80%;" href="tienda.html">Tienda</a>
      </div>
    </div>
  </div>
</nav>

<section class="panel-hero">
    <div class="container-fluid px-5">
        <div class="row align-items-center">
            <div class="col-md-6">
                <p class="subtitulo-panel">BIENVENIDA/O</p>
                <h1>¡Hola, <span><?php echo $datosAlumno['nombre']; ?>!</span></h1>
                <p class="texto-panel">Este es tu espacio personal para vivir tu pasión por la danza.</p>

                <a href="disciplinas_panel.php" class="btn boton-rosa">
                    Inscribirme a nuevas clases →
                </a>
            </div>

            <div class="col-md-6 text-center">
                <img src="" class="img-hero" alt="Danza">
            </div>
        </div>
    </div>
</section>

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
                <p>Pagos</p>
                <h2></h2>
                <span>cuota </span>
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

            <?php while($fila = mysqli_fetch_assoc($resultado)){ ?>
                <div class="clase-card">
                    <div>
                        <h4><?php echo $fila['nombre_disciplina']; ?></h4>
                        <p><?php echo $fila['nombre_dia']; ?> - <?php echo $fila['horario']; ?> hs</p>
                    </div>
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

<?php while($mat = mysqli_fetch_assoc($materiales)){ ?>

    <div class="clase-card">
        <div>
            <h4><?php echo $mat['titulo']; ?></h4>
            <p><?php echo $mat['nombre_disciplina']; ?></p>
            <small><?php echo $mat['descripcion']; ?></small>
        </div>

        <a href="<?php echo $mat['archivo']; ?>" target="_blank" class="btn boton-rosa">
            Ver material
        </a>
    </div>

<?php } ?>

</section>














</body>
</html>

































<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
