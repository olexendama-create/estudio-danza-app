<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    <title>Alumnos</title>
</head>
<body>
    
<nav id="mainNavbar" class="navbar navbar-expand-lg fixed-top navbar-transparentpy-3" style="background-color: black;">
  <div class="container-fluid">
    <a class="navbar-brand fw-bold" href="#" style="color: #F4C9D6; letter-spacing: 1px;">Studio Gym Dance</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <div class="navbar-nav">
        <a class="nav-link active" style="color: #F2F1ED;" href="index.html">Inicio</a>
        <a class="nav-link" style="background-color: #F4C9D6; color: #3E2723; border-radius: 80%;" href="alumnos.html">Alumnos</a>
        <a class="nav-link"style="color: #F2F1ED;"  href="disciplinas.html">Disciplinas y Horarios</a>
        <a class="nav-link"style="color: #F2F1ED;"  href="profesores.html">Profesores</a>
        <a class="nav-link" style="background-color: #F4C9D6; color: #3E2723; border-radius: 80%;" href="tienda.html">Tienda</a>
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
                    <label for="LoginDni" class="form-label fw-bold text-uppercase small text-muted" style="font-family: Montserrat, sans-serif; letter-spacing: 1px;">Numero de DNI</label>
                    <input type="text" id="loginDni" name="dni" class="form-control rounded-0 border-dark p-3" placeholder="Tu documento sin puntos" style="font-family:  Montserrat, sans-serif;">
                </div>

                <div class="mb-4">
                    <label for="loginPassword" class="form-label fw-bold text-uppercase small text-muted" style="font-family: Montserrat, sans-serif; letter-spacing: 1px;">Contraseña</label>
                    <input type="password"  id="loginPassword" name="password" class="form-control rounded-0 border-dark p-3" placeholder="........" style="font-family:  Montserrat, sans-serif;">
                </div>

                <div class="mb-4">
                     <div class="form-check">
                        <input class="form-check-input border-dark rounded-0" type="checkbox" id="checkSesion">
                        <label class="form-check-label small fw-medium" for="checkSesion" style="font-family: Montserrat, sans-serif;">
                            Recordar mi sesion.
                        </label>
                    </div>
                </div>

                <button type="submit" class="btn btn-dark w-100 rounded-0 fw-bold text-uppercase py-3" style="font-family: Montserrat, sans-serif; letter-spacing: 1px;">
                    Ingresar al panel
                </button>
               </fieldset>
            </form>
        </div>


        <div class="col-md-6">
            <form  action="registrar.php" method="POST" class="bg-white p-4 p-md-5 border border-dark shadow-sm h-100">
                <fieldset>
                    <legend class="fw-bold text-uppercase mb-4" style="font-family: Anton , sans-serif; font-size: 1.8rem; letter-spacing: 1px; color: #000;">
                        Registrarme e inscribirme
                    </legend>
                    <hr style="border-top: 3px solid #F4C9D6; width: 60px; opacity: 1; margin-bottom: 25px;">
                   
                    <div class="row">
                        <div class="col-md-6 mb-3">
                        <label for="regNombre" class="form-label fw-bold text-uppercase small text-muted" style="font-family: Montserrat, sans-serif; letter-spacing: 1px;">Nombre</label>
                        <input type="text" id="regNombre" name="nombre" class="form-control rounded-0 border-dark p-3" placeholder="Tu nombre completo" style="font-family: Montserrat, sans-serif;"
                        required>
                       </div>
                    
                     <div class=" col-md-6 mb-3">
                        <label for="regApe" class="form-label fw-bold text-uppercase small text-muted" style="font-family: Montserrat, sans-serif; letter-spacing: 1px;">Apellido</label>
                        <input type="text" id="regApellido" name="apellido" class="form-control rounded-0 border-dark p-3" placeholder="Tu nombre completo" style="font-family: Montserrat, sans-serif;"
                        required>
                    </div>
                     </div>

                    <div class="mb-3">
                        <label for="regDni" class="form-label fw-bold text-uppercase small text-muted" style="font-family: Montserrat, sans-serif; letter-spacing: 1px;">Numero de DNI</label>
                        <input type="text" id="regDni" name="dni" class="form-control rounded-0 border-dark p-3" placeholder="Tu documento sin puntos" style="font-family: Montserrat, sans-serif;">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold text-uppercase small text-muted" style="font-family: Montserrat, sans-serif; letter-spacing: 1px;">
                            Tipo de documento
                        </label>
                        <select name="id_tipo_documento"  class="form-label fw-bold text-uppercase small text-muted" style="font-family: Montserrat, sans-serif; letter-spacing: 1px;">
                            <option value="">Seleccionar</option>
                            <option value="1">DNI</option>
                            <option value="2">Pasaporte</option>
                        </select>
                    </div>

                     <div class="mb-3">
                        <label  class="form-label fw-bold text-uppercase small text-muted" style="font-family: Montserrat, sans-serif; letter-spacing: 1px;">Fecha de Nacimiento</label>
                        <input type="date" id="regFch" name="fecha_nacimiento" class="form-control rounded-0 border-dark p-3" style="font-family: Montserrat, sans-serif;"
                        required
                        >
                    </div>

                    <div class="row">
                         <div class=" col-md-6 mb-3">
                        <label class="form-label fw-bold text-uppercase small text-muted" style="font-family: Montserrat, sans-serif; letter-spacing: 1px;">Telefono</label>
                        <input type="tel" id="regTel" name="telefono" class="form-control rounded-0 border-dark p-3" placeholder="Tu telefono" style="font-family: Montserrat, sans-serif;"
                        required
                        >
                    </div>
                    
                    <div class=" col-md-6 mb-3">
                        <label for="regEmail" class="form-label fw-bold text-uppercase small text-muted" style="font-family: Montserrat, sans-serif; letter-spacing: 1px;">Correo Electronico (Gmail)</label>
                        <input type="email" id="regEmail" name="email" class="form-control rounded-0 border-dark p-3" placeholder="ejemplo@gmail.com" required style="font-family: Montserrat, sans-serif;">
                    </div>
                    </div>
                    

                    <div class="mb-4">
                        <label for="regPack" class="form-label fw-bold text-uppercase small text-muted" style="font-family: Montserrat, sans-serif; letter-spacing: 1px;">Selecciona tu Pack de Clases</label>
                        <select id="regPack" name="id_pack" class="form-label fw-bold text-uppercase small text-muted" style="font-family: Montserrat, sans-serif; letter-spacing: 1px;">                    
                            <option value="">Seleccionar pack</option>
                            <option value="1">Clase suelta ($5000)</option>
                            <option value="2">Pack 4 clases ($18000)</option>
                            <option value="3">Pack 8 clases ($38000)</option>
                            <option value="4">Pack 12 clases ($58000)</option>
                        </select>
                    </div>
                    
                    <div class="row">
                        <div class=" col-md-6 mb-3">
                        <label class="form-label fw-bold text-uppercase small text-muted" style="font-family: Montserrat, sans-serif; letter-spacing: 1px; ">
                            contraseña
                        </label>
                        <input type="password" id="regPassword" name="password" class="form-control rounded-0 border-dark p-3" placeholder="Contraseña" required style="font-family: Montserrat, sans-serif;" required>
                    </div>

                     <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold text-uppercase small text-muted" style="font-family: Montserrat, sans-serif; letter-spacing: 1px; ">
                            Confirmar contraseña
                        </label>
                        <input type="password" id="regPassword1" name="confirmar_password" class="form-control rounded-0 border-dark p-3" placeholder="Repeti tu contraseña" required style="font-family: Montserrat, sans-serif;" required>
                    </div>
                    </div>
                   




                    <button type="submit" class="btn btn-dark w-100 rounded-0 fw-bold text-uppercase" style="font-family:  Montserrat, sans-serif; letter-spacing: 1px;  border-color: #F4C9D6;">Crear Cuenta y Comprar</button>
                </fieldset>
            </form>
        </div>

   </div>
</div>



<footer class="py-4 text-center" style="background-color: #F4C9D6; color: black;">
  <P>Contacto y Redes Sociales</P>
     <div class="social-icons">
      <a href="" class="btn btn" style="color: black;">
         <i class="bi bi-instagram"></i> Istragram
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
</body>
</html>