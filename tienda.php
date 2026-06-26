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
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Tienda Studio Gym Dance</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Anton&family=Montserrat:wght@400;500;700;900&display=swap" rel="stylesheet">

<style>
:root{
    --negro:#111111;
    --rosa:#F4C9D6;

    
    --fondo:#F6F4EE;
    --blanco:#FFFFFF;
    --texto:#2E2723;
}

*{
    box-sizing:border-box;
}

body{
    margin:0;
    background:var(--fondo);
    font-family:'Montserrat', sans-serif;
    color:var(--texto);
}



/* CONTENEDOR */

.shop-container{
    width:92%;
    max-width:1250px;
    margin:30px auto;
}



.hero-shop{
    display:grid;
    grid-template-columns:1.1fr 1fr;
    gap:25px;
    margin-bottom:30px;
}

.hero-card-img{
    background:#fff;
    border-radius:30px;
    padding:25px;
    min-height:380px;
    position:relative;
    overflow:hidden;
    box-shadow:0 12px 35px rgba(0,0,0,0.08);
}

.hero-card-img img{
    width:100%;
    height:330px;
    object-fit:cover;
    border-radius:25px;
}

.mini-info{
    position:absolute;
    left:40px;
    bottom:40px;
    background:rgba(255,255,255,0.85);
    backdrop-filter:blur(6px);
    padding:22px;
    border-radius:22px;
    max-width:230px;
}

.mini-info h3{
    font-family:'Anton', sans-serif;
    font-size:28px;
    margin:0;
}

.mini-info p{
    font-size:13px;
    margin:8px 0 12px;
}

.mini-info a{
    color: #F4C9D6;
    text-decoration:none;
    font-weight:800;
}

.modal-content{
    border:none;
    border-radius:25px;
    overflow:hidden;
    box-shadow: 0 20px 60px rgba(0,0,0,.25);
}

.modal-backdrop.show{
    opacity:.75;
}

.hero-text{
    background:#fff;
    border-radius:30px;
    padding:45px;
    min-height:380px;
    box-shadow:0 12px 35px rgba(0,0,0,0.08);
    display:flex;
    flex-direction:column;
    justify-content:center;
}

.hero-text small{
    color: #F4C9D6;
    font-weight:900;
    letter-spacing:2px;
}

.hero-text h1{
    font-family:'Anton', sans-serif;
    font-size:78px;
    line-height:.95;
    margin:10px 0 20px;
    color:var(--negro);
}

.hero-text h1 span{
    color: #F4C9D6;
}

.hero-text p{
    font-size:17px;
    line-height:1.6;
    color:#555;
}

.btn-negro{
    display:inline-block;
    background:#111;
    color:white;
    text-decoration:none;
    padding:13px 25px;
    border-radius:30px;
    font-weight:800;
    width:max-content;
    margin-top:15px;
}

.btn-negro:hover{
    background: #F4C9D6;
    color:white;
}

/* BLOQUES TIPO REFERENCIA */

.bloques-shop{
    display:grid;
    grid-template-columns:repeat(4, 1fr);
    gap:20px;
    margin-bottom:30px;
}

.bloque{
    background:#fff;
    border-radius:25px;
    padding:25px;
    min-height:160px;
    box-shadow:0 8px 25px rgba(0,0,0,0.07);
}

.bloque h3{
    font-family:'Anton', sans-serif;
    font-size:32px;
    margin:0 0 8px;
}

.bloque p{
    color:#666;
    font-size:14px;
    margin:0;
}

.bloque.rosa{
    background:linear-gradient(135deg,#f4c9d6,#fff);
}

.bloque.negro{
    background:#111;
}

.bloque.negro h3,
.bloque.negro p{
    color:white;
}

/* PROMO */

.promo-shop{
    background:linear-gradient(90deg,#fff,#f4c9d6);
    border-radius:30px;
    padding:40px;
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:40px;
    box-shadow:0 10px 30px rgba(0,0,0,0.08);
}

.promo-shop h2{
    font-family:'Anton', sans-serif;
    font-size:58px;
    margin:0;
    color:#111;
}

.promo-shop span{
    color: #F4C9D6;
}

/* TITULO PRODUCTOS */

.titulo-productos{
    font-family:'Anton', sans-serif;
    font-size:46px;
    margin:20px 0;
    color:#111;
    text-transform:uppercase;
}

/* PRODUCTOS */

.productos{
    display:grid;
    grid-template-columns:repeat(auto-fit, minmax(260px, 1fr));
    gap:28px;
    margin-top:25px;
}

.card-productos{
    background:#fff;
    border-radius:28px;
    padding: 18px;
    box-shadow: 0 12px 30px rgba(0,0,0,0.08);
    transition 3s;
}

.card-productos:hover{
    transform:translateY(-7px);
}

.producto-img{
    width:100%;
    height:240px;
    border-radius:22px;
    overflow:hidden;
    background:#f8e9ee;
}

.producto-img img{
    width:100%;
    height:100%;
    object-fit:cover;
}

.badge-nuevo{
    display:inline-block;
    background:#F4C9D6;
    color:#2E2723;
    padding:6px 14px;
    border-radius:20px;
    font-size:12px;
    font-weight:800;
    margin:14px 0 8px;
}

.card-productos h3{
    font-family:'Anton', sans-serif;
    font-size:30px;
    color:#111;
    margin:5px 0;
}

.precio{
    color:#E86B98;
    font-weight:900;
    font-size:25px;
    margin-bottom:12px;
}

.campo-producto label{
    font-size:13px;
    font-weight:800;
    margin-bottom:5px;
}

.campo-producto select,
.campo-producto input{
    border-radius:14px;
    padding:9px;
    border:1px solid #ddd;
}

.botones-producto{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:10px;
    margin-top:15px;
}

.btn-agregar{
    border:none;
    background:#F4C9D6;
    color:#2E2723;
    border-radius:18px;
    padding:11px;
    font-weight:900;
}

.btn-agregar:hover{
    background:#E86B98;
    color:white;
}

.btn-ver{
    background:#111;
    color:white;
    text-decoration:none;
    text-align:center;
    border-radius:18px;
    padding:11px;
    font-weight:900;
}



.btn-ver:hover{
    background:#333;
    color:white;
}

/* BENEFICIOS */

.beneficios{
    display:grid;
    grid-template-columns:repeat(4,1fr);
    gap:18px;
    margin-bottom:30px;
}

.beneficio{
    background:#fff;
    border-radius:25px;
    padding:25px;
    display:flex;
    gap:15px;
    align-items:center;
    box-shadow:0 8px 25px rgba(0,0,0,0.06);
}

.beneficio i{
    color: #F4C9D6;
    font-size:28px;
}

.beneficio p{
    margin:0;
    font-weight:800;
    font-size:14px;
}

/* RESPONSIVE */

@media(max-width:900px){
    .hero-shop{
        grid-template-columns:1fr;
    }

    .bloques-shop{
        grid-template-columns:1fr 1fr;
    }

    .productos{
        grid-template-columns:1fr;
        grid-auto-rows:auto;
    }

    .card-productos.destacado{
        grid-row:auto;
    }

    .beneficios{
        grid-template-columns:1fr 1fr;
    }

    .hero-text h1{
        font-size:52px;
    }
}
</style>
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


<div class="shop-container">

    <section class="hero-shop">

        <div class="hero-card-img">
            <img src="https://i.ibb.co/gL0y3wdf/IMG-5280.png" alt="Productos de danza">

            <div class="mini-info">
                <h3>Todo para tus clases</h3>
                <p>Productos seleccionados para acompañarte en cada paso.</p>
                <a href="#productos">Ver productos →</a>
            </div>
        </div>

        <div class="hero-text">
            <small>TIENDA STUDIO GYM DANCE</small>
            <h1>TU DANZA,<br><span>TU ESENCIA.</span></h1>
            <p>Encontrá indumentaria, accesorios y productos para tus clases, ensayos y presentaciones.</p>
            <a href="carrito.php" class="btn-negro">
                <i class="bi bi-cart3"></i> Ver carrito
            </a>
        </div>

    </section>

    <section class="bloques-shop">
        <div class="bloque rosa">
            <h3>Calzado</h3>
            <p>Zapatillas para tus clases.</p>
        </div>

        <div class="bloque">
            <h3>Ropa</h3>
            <p>Mallas, polleras y prendas de danza.</p>
        </div>

        <div class="bloque negro">
            <h3>Accesorios</h3>
            <p>Mochilas y elementos para entrenar.</p>
        </div>

        <div class="bloque rosa">
            <h3>Clases</h3>
            <p>Todo pensado para bailar mejor.</p>
        </div>
    </section>

    <section class="promo-shop">
        <div>
            <h2><span>-10%</span> OFF</h2>
            <p>En tu primera compra en la tienda del estudio.</p>
        </div>

        <a href="#productos" class="btn-negro">Ver productos</a>
    </section>

    <h2 class="titulo-productos" id="productos">Productos destacados</h2>

    <?php
    mysqli_data_seek($resultado, 0);
    $contador = 0;
    ?>

   <div class="productos">

<?php while($fila = mysqli_fetch_assoc($resultado)){ ?>

    <div class="card-productos">

        <div class="producto-img">
            <img src="<?php echo $fila['imagen']; ?>" alt="<?php echo $fila['nombre_producto']; ?>">
        </div>

        <span class="badge-nuevo">Nuevo</span>

        <h3><?php echo $fila['nombre_producto']; ?></h3>

        <div class="precio">
            $<?php echo number_format($fila['precio'],0,',','.'); ?>
        </div>

        <form action="agregar_carrito.php" method="POST">

            <input type="hidden" name="id_producto" value="<?php echo $fila['id_producto']; ?>">

            <div class="campo-producto mb-3">
                <label>Talle</label>

                <select name="id_talle" class="form-select" required>
                    <option value="">Elegir talle</option>

                    <?php foreach($talles as $talle){ ?>
                        <option value="<?php echo $talle['id_talle']; ?>">
                            <?php echo $talle['nombre_talle']; ?>
                        </option>
                    <?php } ?>

                </select>
            </div>

            <div class="campo-producto mb-3">
                <label>Cantidad</label>
                <input type="number" name="cantidad" class="form-control" value="1" min="1" required>
            </div>

            <div class="botones-producto">

                <button type="submit" class="btn-agregar">
                    <i class="bi bi-cart-plus"></i> Agregar
                </button>

                <a href="producto.php?id=<?php echo $fila['id_producto']; ?>" class="btn-ver">
                    Ver
                </a>

            </div>

        </form>

    </div>

<?php } ?>

</div>


    <section class="beneficios">


        <div class="beneficio">
            <i class="bi bi-credit-card"></i>
            <p>Medios de pago</p>
        </div>

        <div class="beneficio">
            <i class="bi bi-heart-fill"></i>
            <p>Productos de calidad</p>
        </div>

        <div class="beneficio">
            <i class="bi bi-stars"></i>
            <p>Ideal para clases</p>
        </div>
    </section>

<div class="modal fade" id="loginModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content rounded-4">

      <div class="modal-header border-0" style="background: #f4c9d6;">
        <h4 class="modal-title fw-bold text-dark">
            <i class="bi bi-person-heart me-2"></i>
           Iniciar sesión
        </h4>

        <button
        type="button"
        class="btn-close"
        data-bs-dismiss="modal">
        </button>
      </div>

      <div class="modal-body text-center py-4">

      <i class=" bi bi-cart-x-fill"
         style="font-size: 65px; color: #e86b98;"></i>

         <h4 class=" mt-3 fw-bold">
            Necesitas iniciar sesion
         </h4>

        <p class="text-secondary mb-2">
        Para comprar productos de la tienda 
        primero tenes que ingresar con tu cuenta
        de alumno.
        </p>

        <small class="text-muted">
            Todavia no sos alumno? <br>
            Inscribite y vas a poder comprar,
            reservar clases y acceder a tu panel.
        </small>

      </div>

      <div class="modal-footer border-0 justify-content-center">

        <a href="alumnos.php"
        class="btn"
        style="background: #111; color: white; border-radius:30px; padding: 10px 30px; font-weight: bold">
          <i class="bi bi-box-arrow-in-right"></i>

        Iniciar sesión

        </a>

        <a href="alumnos.php"
        class="btn"
        style="color: #e86b98; border:2px solid #f4c9d6; border-radius:30px; padding: 10px 30px; font-weight: bold">
          <i class="bi bi-person-plus"></i>>

         Inscribirme

        </a>

      </div>

    </div>
  </div>
</div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

<?php if(isset($_GET['login'])){ ?>

<script>

window.onload=function(){

var modal=new bootstrap.Modal(
document.getElementById('loginModal')
);

modal.show();

}

</script>

<?php } ?>

</body>
</html>
