<?php
session_start();
include("conexion.php");

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
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
    <title>Profesores</title>
</head>
<body>
    

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





<div class="container-fluid py-5" style="background-color: #f8f7f2 !important; background-image: radial-gradient(#e8e4d8 28%, transparent 28%) !important; background-size: 50px 50px !important; min-height: 100vh;">
    <div class="row g-5 my-5 justify-content-center">
        <div class="col-md-5">
            <form  action="login.php" method="POST" class="bg-white p-4 p-md-5 border border-dark shadow-sm h-100">
               <fieldset>
                <legend class="fw-bold text-uppercase mb-4" style="font-family: Anton , sans-serif; font-size: 1.8rem; letter-spacing: 1px; color: #000; ">
                    Iniciar Sesion
                </legend>
                <hr style="border-top: 3px solid #F4C9D6; width: 60px; opacity: 1; margin-bottom: 25px;">

                <div class="mb-3">
                     <label for="regEmail" class="form-label fw-bold text-uppercase small text-muted" style="font-family: Montserrat, sans-serif; letter-spacing: 1px;">Correo Electronico</label>
                        <input type="email" id="regEmail" name="email" class="form-control rounded-0 border-dark p-3" placeholder="ejemplo@gmail.com (opcional)"  style="font-family: Montserrat, sans-serif;" >
                    required
                    >
                </div>

                <div class="mb-4">
                    <label for="loginPassword" class="form-label fw-bold text-uppercase small text-muted" style="font-family: Montserrat, sans-serif; letter-spacing: 1px;">Contraseña <span style="color:red;">*</span></label>
                    <input type="password"  id="loginPassword" name="password" class="form-control rounded-0 border-dark p-3" placeholder="........" style="font-family:  Montserrat, sans-serif;"
                    required
                    >
                </div>

                <div class="mb-4">
                     <div class="form-check">
                        <input class="form-check-input border-dark rounded-0" type="checkbox" id="checkSesion">
                        <label class="form-check-label small fw-medium" for="checkSesion" style="font-family: Montserrat, sans-serif;">
                            Recordar mi sesion.
                        </label>
                    </div>
                </div>

                 <p style="font-size:13px; color:#555;"> <span style="color:red;">*</span> Campos obligatorios </p>

                <button type="submit" class="btn btn-dark w-100 rounded-0 fw-bold text-uppercase py-3" style="font-family: Montserrat, sans-serif; letter-spacing: 1px;">
                    Ingresar al panel
                </button>
               </fieldset>
            </form>
        </div>










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
</body>
</html>