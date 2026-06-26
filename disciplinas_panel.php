<?php 
session_start();

include("conexion.php");

$sql = "SELECT * FROM categorias_disciplinas";
$resultado = mysqli_query($conexion,$sql);

?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400..700&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="style.css?v=1.5">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
    
    <title>Disciplinas y Horarios</title>
</head>
<style>
    .seccion-grilla-premium {
    max-width: 1100px !important;
    margin: 60px auto !important;
    padding: 0 20px !important;
    display: flex !important;
    flex-direction: column !important;
    gap: 80px !important;
    box-sizing: border-box !important;
}

.fila-premium {
    display: flex !important;
    flex-direction: row !important;
    background-color: #ffffff !important;
    border: 1px solid #eaeae8 !important;
    overflow: hidden !important;
    height: 400px !important;
    width: 100% !important; 
   box-sizing: border-box !important;
}

.fila-espejo {
    flex-direction: row-reverse !important;
}


.bloque-informacion {
    flex: 0 0 50% !important;
    padding: 40px !important;
    display: flex !important;
    flex-direction: column !important;
    justify-content: center !important;
   box-sizing: border-box !important;
}

.categoria-tag {
    font-family: sans-serif !important;
    font-size: 11px !important;
    text-transform: uppercase !important;
    letter-spacing: 2px !important;
    color: #999 !important;
    margin-bottom: 12px !important;
}

.titulo-disciplina {
    font-family: "Playfair Display", serif !important;
    font-size: 32px !important;
    color-scheme: #111 !important;
    margin: 0 0 20px 0 !important;
    font-weight: 500 !important;
}

.detalles {
    font-family: sans-serif !important;
    font-size: 14px !important;
    color: #555 !important;
    margin: 0 0 8px 0 !important;
}

.detalles strong {
    color: #111 !important;
}

.profesor {
    font-family: Georgia, serif;
    font-style: italic;
    font-size: 15px !important;
    color: #222 !important;
    margin-top: 16px !important;
}

.bloque-video {
    flex: 0 0 50% !important;
    height: 100% !important;
    position: relative !important;
    background-color: #000 !important;
    box-sizing: border-box !important;
}

.video-preview {
    position: absolute !important;
    top: 0 !important;
    left: 0 !important;
    width: 100% !important;
    height: 100% !important;
    object-fit: cover !important;
    display: block !important;
    opacity: 0.7 !important;
    filter: grayscale(30%) !important;
    transition: all 0.4s ease !important;
}    
</style>


  <nav id="mainNavbar" class="navbar navbar-expand-lg fixed-top py-3" style="background-color: #000;">
  <div class="container-fluid">
    <a class="navbar-brand fw-bold" href="#" style="color: #F4C9D6; letter-spacing: 1px;">Studio Gym Dance</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <a class="nav-link active" style="color: #F2F1ED;" href="index.php">Inicio</a>
        <?php if(isset($_SESSION['id_alumno'])){ ?>
          <a class="nav-link" style="background-color: #F4C9D6; color: #3E2723; border-radius: 80%;" href="panel_alumno.php">Mi Panel</a>
            <?php }else{ ?>
          <a class="nav-link" style="background-color: #F4C9D6; color: #3E2723; border-radius: 80%;" href="alumnos.php">Alumnos</a>
        <?php } ?>
        <a class="nav-link"style="color: #F2F1ED;"  href="disciplinas_panel.php">Disciplinas y Horarios</a>
        <a class="nav-link"style="color: #F2F1ED;"  href="profesores.php">Profesores</a>
        <a class="nav-link" style="background-color: #F4C9D6; color: #3E2723; border-radius: 80%;" href="tienda.php">Tienda</a>
      
       <?php if(isset($_SESSION['nombre_alumno'])){ ?>
         <span class="navbar-text ms-4" style="color:#F4C9D6; font-weight:bold;">
          <i class="bi bi-person-circle"></i>
          <?= $_SESSION['nombre_alumno']; ?>
          <?= $_SESSION['apellido_alumno']; ?>
         </span>

        <a href="cerrar_sesion.php" class="btn btn-outline-light ms-3">
           Cerrar sesión
         </a>
       <?php } ?>
    
    </div>
    </div>
  </div>
</nav>


<body>
    
<section style="padding: 80px 60px; background: #f8f4ef;">
  <div style="display: flex; align-items: center; justify-content: space-between; gap: 50px; flex-wrap: nowrap;">

  <div style="flex: 1; min-width: 35%;">
    <p style="letter-spacing: 2px; text-transform: uppercase; color: #999;">Nuestras disciplinas</p>

    <h1 style="font-size: 70px; font-weight: 900; line-height: 1; margin-bottom: 20px; font-family: Anton , sans-serif;">
        MOVETE. <br>
        EXPRESA.<br>
        <span style="color: #e8b4d8;">
            VIVI.
        </span>
    </h1>

    <P style="font-size: 18px; color: #555; margin-bottom: 30px;">
        Explora todas nuestras disciplinas,
        horarios y profesores.
    </P>

    <a href="disciplinas_panel.php?ver_horarios=1" class="btn-horarios">
        Ver Horarios
    </a>

    </div>

    <div style="flex: 1; min-width: 65%;">
        <video width="100%" height="350" controls autoplay muted loop style="border-radius: 25px; object-fit: cover; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);">
            <source src="../Studio Gym Dance/videos e imagenes/v1c044g50000d7t7gpnog65p5kgt4fmg.mp4" type="video/mp4">
        </video>
    </div>
  </div>
</section>


<section style="padding: 50px 60px; background: #f8f4ef;">
    <h2 style="font-family: Anton , sans-serif ; font-size: 28px; margin-bottom: 25px; color: #111; text-transform: uppercase;">
        DISCIPLINAS
    </h2>

    <div style="display: grid; grid-template-columns: repeat(4,1fr); gap: 22px;">

    <?php while($fila = mysqli_fetch_assoc($resultado)){ ?>

   <div class="card-disciplina">
    
        <img class="img-disciplina"
             src="<?php echo $fila['imagen_url']; ?>">

         <div class="info-disciplina">
            <h3><?php echo $fila['nombrecategoria']; ?></h3>
                       
            <p>
               <?php echo $fila['descripcion']; ?>
            </p>
        </div>
     </div>

<?php  } ?>

</div>

<?php if(isset($_GET['ver_horarios'])) { ?>


<div class="modal-horarios" id="calendario">
     <div class="contenido-modal calendario-modal">

     <a href="disciplinas_panel.php" class="cerrar-modal">x</a>

     <h2 class="titulo">Horarios y Clases Disponibles</h2>
     <p class="subtitulo-modal">Calendario semanal del estudio</p>

     <div class="calendarios">
        
        <div class="celda encabezado">Hora</div>
        <div class="celda encabezado">Lunes</div>
        <div class="celda encabezado">Martes</div>
        <div class="celda encabezado">Miercoles</div>
        <div class="celda encabezado">Jueves</div>
        <div class="celda encabezado">Viernes</div>
        <div class="celda encabezado">Sabado</div>

        <div class="celda hora">16:00</div>
        <div class="celda clase clasica" onclick="seleccionarClase(1,this)">Danza Clasica<br><span>Kids . Sala 1</span></div>
        <div class="celda vacia"></div>
        <div class="celda clase clasica" onclick="seleccionarClase(2,this)">Danza Clasica<br><span>Kids . Sala 1</span></div>
        <div class="celda vacia"></div>
        <div class="celda vacia"></div>
        <div class="celda clase arabe" onclick="seleccionarClase(3,this)">Arabe <br><span>Kids . Sala 2</span></div>

        <div class="celda hora">17:00</div>
        <div class="celda clase tap" onclick="seleccionarClase(4,this)">Tap <br><span>Kids . Sala 1</span></div>
        <div class="celda clase latinos"onclick="seleccionarClase(5,this)" >Ritmos Latinos <br><span>Kids . Sala 2</span></div>
        <div class="celda clase tap" onclick="seleccionarClase(6,this)">Tap <br><span>Kids . Sala 1</span></div>
        <div class="celda vacia"></div>
        <div class="celda clase reggaeton" onclick="seleccionarClase(7,this)">Reggaeton <br><span>Kids . Sala 2</span></div>
        <div class="celda clase arabe" onclick="seleccionarClase(26,this)">Arabe <br><span>Juveniles . Sala 2</span></div>

        <div class="celda hora">18:00</div>
        <div class="celda clase urbano" onclick="seleccionarClase(8,this)">Urbano <br><span>Juveniles . Sala 2</span></div>
        <div class="celda clase clasica" onclick="seleccionarClase(9,this)">Danza Clasica <br><span>Juveniles . Sala 1</span></div>
        <div class="celda clase urbano" onclick="seleccionarClase(10,this)">Urbano <br><span>Juveniles . Sala 2</span></div>
        <div class="celda clase tap" onclick="seleccionarClase(11,this)">Tap <br><span>Juveniles . Sala 1</span></div>
        <div class="celda clase clasica" onclick="seleccionarClase(12,this)">Danza Clasica <br><span>Juveniles . Sala 1</span></div>
        <div class="celda vacia"></div>

        <div class="celda hora">19:00</div>
        <div class="celda vacia"></div>
        <div class="celda clase femme" onclick="seleccionarClase(13,this)">Femme <br><span>Juveniles . sala 2</span></div>
        <div class="celda clase arabe" onclick="seleccionarClase(14,this)">Arabe <br><span>Adultos . Sala 2</span></div>
        <div class="celda clase urbano" onclick="seleccionarClase(15,this)">Urbano <br><span>Juveniles . Sala 2</span></div>
        <div class="celda vacia"></div>
        <div class="celda vacia"></div>

        <div class="celda hora">20:00</div>
        <div class="celda clase latinos" onclick="seleccionarClase(16,this)">Ritmos Latinos <br><span>Adultos . Sala 2</span></div>
        <div class="celda clase contemporaneo" onclick="seleccionarClase(17,this)">Contemporaneo <br><span>Adultos . Sala 1</span></div>
        <div class="celda clase latinos" onclick="seleccionarClase(18,this)">Ritmos Latinos <br><span>Adultos . Sala 2</span></div>
        <div class="celda clase clasica" onclick="seleccionarClase(19,this)">Danza Clasica <br><span>Adultos . Sala 1</span></div>
        <div class="celda clase femme" onclick="seleccionarClase(20,this)">Femme <br><span>Adultos . Sala 2</span></div>
        <div class="celda vacia"></div>

        <div class="celda hora">21:00</div>
        <div class="celda clase urbano"  onclick="seleccionarClase(21,this)">Urbano <br><span>Adultos . Sala 2</span> </div>
        <div class="celda clase reggaeton"  onclick="seleccionarClase(22,this)">Reggaeton <br><span>Adultos . Sala 2</span></div>
        <div class="celda clase heels" onclick="seleccionarClase(23,this)" >Heels <br><span>Adultos . Sala 1</span></div>
        <div class="celda clase reggaeton"  onclick="seleccionarClase(24,this)">Reggaeton <br><span>Adultos . Sala 2</span></div>
        <div class="celda clase heels"  onclick="seleccionarClase(25,this)">Heels <br><span>Adultos . Sala 1</span></div>
        <div class="celda vacia"></div>
        
     </div>

     <form action="inscribirse.php" method="POST" onsubmit="return inscribirme()">
        <input type="hidden" name="clases" id="clases">
        <button type="submit">Inscribirme</button>
     </form>
       
     

     

     </div>
</div>

<?php  } ?>






</section>












 <footer class="py-4 text-center" style="background-color: #F4C9D6; color: black;">
  <P>Contacto y Redes Sociales</P>
     <div class="social-icons">
      <a href="" class="btn btn" style="color: black;">
         <i class="bi bi-instagram"></i> Instragram
     </a>
     <a href="" class="btn btn" style="color:black;">
      <i class="bi bi-whatsapp"></i> Whatsapp
     </a>
     </div>
     <div class=" color black">
       © 2026 Studio Gym Danza - Todos los derechos reservados
     </div>
</footer>

 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>


<script>
    var clasesSeleccionadas = [];

    function seleccionarClase(idClase, elemento) {
      
        
    if(clasesSeleccionadas.indexOf(idClase) !== -1){ 

        clasesSeleccionadas = clasesSeleccionadas.filter(function(id){ 
            return id != idClase;

        });

         elemento.style.background = "";

    }else{

        clasesSeleccionadas.push(idClase);
        
        elemento.style.background = "green";

     }

     console.log(clasesSeleccionadas);
}

function inscribirme(){
    
     if(clasesSeleccionadas.length == 0){
     alert("Selecciona al menos una clase");
     return false;
   }

   document.getElementById("clases").value = clasesSeleccionadas;
    
   return true;
}
    
</script>
























</body>
</html>