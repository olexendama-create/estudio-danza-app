<?php
session_start();
include("conexion.php");

$sql = "SELECT * FROM productos";
$resultado = mysqli_query($conexion, $sql);
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
    --rosa-fuerte:#E86B98;
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

/* NAVBAR */

.navbar{
    background:#111;
    padding:14px 28px;
}

.navbar-brand{
    color:var(--rosa) !important;
    font-weight:900;
    letter-spacing:1px;
}

.nav-link{
    color:white !important;
    margin:0 8px;
    font-size:15px;
}

.nav-link.active,
.nav-link:hover{
    background:var(--rosa);
    color:#2E2723 !important;
    border-radius:25px;
    padding-left:16px !important;
    padding-right:16px !important;
}

/* CONTENEDOR */

.shop-container{
    width:92%;
    max-width:1250px;
    margin:30px auto;
}

/* HERO ESTILO REFERENCIA */

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
    color:var(--rosa-fuerte);
    text-decoration:none;
    font-weight:800;
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
    color:var(--rosa-fuerte);
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
    color:var(--rosa-fuerte);
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
    background:var(--rosa-fuerte);
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
    color:var(--rosa-fuerte);
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
    grid-template-columns:2fr 1fr 1fr;
    align-items:start;
    gap:22px;
}

.card-productos{
    background:#fff;
    border-radius:28px;
    padding:18px;
    overflow:visible;
    box-shadow:0 12px 30px rgba(0,0,0,0.08);
    display:flex;
    flex-direction:column;
    justify-content:space-between;
    transition:.3s;
    cursor:pointer;
    height:auto;
}

.card-productos form{
    margin-top:auto;
}

.card-productos select{
    margin-top:10px;
}

.card-productos button{
    margin-top:10px;
}

.card-productos:hover{
    transform:translateY(-8px);
}

.card-productos.destacado{
    grid-column: span 2;
}

.card-productos img{
    width:100%;
    height:150px;
    object-fit:cover;
    border-radius:22px;
    background:#f8e9ee;
}

.card-productos.destacado img{
    height:360px;
}

.card-productos h3{
    font-family:'Anton', sans-serif;
    font-size:30px;
    line-height:1;
    color:#222;
    margin:12px 0 5px;
}

.card-productos.destacado h3{
    font-size:52px;
}

.precio{
    color:var(--rosa-fuerte);
    font-weight:900;
    font-size:24px;
    margin-bottom:6px;
}

.card-productos.destacado .precio{
    font-size:34px;
}

.descripcion{
    color:#666;
    font-size:13px;
    line-height:1.4;
    margin:0 0 8px;
}

.card-productos.destacado .descripcion{
    font-size:15px;
    max-width:560px;
}

.stock,
.talles{
    font-size:13px;
    font-weight:700;
    color:#333;
}

.form-select{
    border-radius:20px;
    font-size:13px;
    margin:8px 0;
}

.btn-carrito{
    width:100%;
    border:none;
    background:#111;
    color:white;
    border-radius:25px;
    padding:11px;
    font-weight:900;
    font-size:13px;
}

.btn-carrito:hover{
    background:var(--rosa-fuerte);
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
    color:var(--rosa-fuerte);
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
        <a class="nav-link active" style="color: #F2F1ED;" href="index.html">Inicio</a>
        <a class="nav-link" style="background-color: #F4C9D6; color: #3E2723; border-radius: 80%;" href="alumnos.php">Alumnos</a>
        <a class="nav-link"style="color: #F2F1ED;"  href="disciplinas_panel.php">Disciplinas y Horarios</a>
        <a class="nav-link"style="color: #F2F1ED;"  href="profesores.html">Profesores</a>
        <a class="nav-link" style="background-color: #F4C9D6; color: #3E2723; border-radius: 80%;" href="tienda.php">Tienda</a>
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

        <div class="card-productos <?php echo ($contador == 0) ? 'destacado' : ''; ?>"
        onclick="window.location='producto.php?id=<?php echo $fila['id_producto'];?>'">

            <div>
                <img src="<?php echo $fila['imagen']; ?>">

                <h3><?php echo $fila['nombre_producto']; ?></h3>

                <div class="precio">
                    $<?php echo number_format($fila['precio'],0,',','.'); ?>
                </div>
            </div>

        </div>

        <?php
        $contador++;
        }
        ?>

    </div>

    <section class="beneficios">
        <div class="beneficio">
            <i class="bi bi-truck"></i>
            <p>Envíos disponibles</p>
        </div>

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

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
