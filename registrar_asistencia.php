<?php
session_start();
include("conexion.php");

if (!isset($_SESSION["id_profesor"])) {
    header("Location: alumnos.php");
    exit();
}

$id_profesor = $_SESSION["id_profesor"];
$id_clase = isset($_GET["id_clase"]) ? $_GET["id_clase"] : "";
$fecha = isset($_GET["fecha"]) ? $_GET["fecha"] : date("Y-m-d");



$sqlClases = "SELECT
                c.id_clase,
                c.horario,
                d.nombre_disciplina,
                ds.nombre_dia
              FROM clases c
              JOIN disciplinas d
                ON c.id_disciplina = d.id_disciplina
              JOIN dias_semanas ds
                ON c.id_dia = ds.id_dia
              WHERE c.id_profesor = '$id_profesor'
              ORDER BY ds.id_dia, c.horario";

$resultadoClases = mysqli_query($conexion, $sqlClases);


$resultadoAlumnos = null;
$datosClase = null;

if ($id_clase != "") {

}
    $sqlVerificarClase = "SELECT
                            c.id_clase,
                            c.horario,
                            d.nombre_disciplina,
                            ds.nombre_dia
                          FROM clases c
                          JOIN disciplinas d
                            ON c.id_disciplina = d.id_disciplina
                          JOIN dias_semanas ds
                            ON c.id_dia = ds.id_dia
                          WHERE c.id_clase = '$id_clase'
                          AND c.id_profesor = '$id_profesor'";

    $resultadoVerificar = mysqli_query($conexion, $sqlVerificarClase);
    $datosClase = mysqli_fetch_assoc($resultadoVerificar);

    if ($datosClase) {

        $sqlAlumnos = "SELECT
                        a.id_alumno,
                        a.nombre,
                        a.apellido,
                        a.numero_documento,
                        td.nombre_tipo
                       FROM inscripciones i
                       JOIN alumnos a
                         ON i.id_alumno = a.id_alumno
                       LEFT JOIN tipos_documento td
                         ON a.id_tipo_documento = td.id_tipo_doc
                       WHERE i.id_clase = '$id_clase'
                       AND i.estado = 'Activa'
                       ORDER BY a.apellido, a.nombre";

        $resultadoAlumnos = mysqli_query($conexion, $sqlAlumnos);
    }
}

$nombreProfesor = $_SESSION["nombre_profesor"] ?? "Profesor";
?>

<!DOCTYPE html>
<html lang="es">
<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Registrar asistencia</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link
        href="https://fonts.googleapis.com/css2?family=Anton&family=Montserrat:wght@400;500;700;800;900&display=swap"
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

        body {
            margin: 0;
            min-height: 100vh;
            background:
                radial-gradient(#e8e4d8 28%, transparent 28%);
            background-size: 50px 50px;
            background-color: var(--fondo);
            font-family: "Montserrat", sans-serif;
            color: var(--negro);
        }

        .navbar-profesor {
            background: var(--negro);
            padding: 15px 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .marca {
            color: var(--rosa);
            font-family: "Anton", sans-serif;
            font-size: 25px;
            letter-spacing: 1px;
            text-decoration: none;
        }

        .volver-panel {
            color: white;
            border: 1px solid white;
            border-radius: 25px;
            padding: 9px 20px;
            text-decoration: none;
            font-weight: 700;
        }

        .volver-panel:hover {
            background: var(--rosa);
            border-color: var(--rosa);
            color: var(--negro);
        }

        .contenedor-asistencia {
            width: 92%;
            max-width: 1150px;
            margin: 55px auto;
        }

        .encabezado {
            display: grid;
            grid-template-columns: 0.8fr 1.2fr;
            gap: 25px;
            margin-bottom: 30px;
        }

        .encabezado-texto {
            background: linear-gradient(135deg, #111, #2b2b2b);
            color: white;
            border-radius: 30px;
            padding: 42px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            box-shadow: 0 15px 40px rgba(0,0,0,.14);
        }

        .encabezado-texto small {
            color: var(--rosa);
            font-weight: 900;
            letter-spacing: 3px;
        }

        .encabezado-texto h1 {
            font-family: "Anton", sans-serif;
            font-size: 53px;
            line-height: 1;
            margin: 14px 0 18px;
        }

        .encabezado-texto h1 span {
            color: var(--rosa);
        }

        .encabezado-texto p {
            color: #dddddd;
            line-height: 1.7;
            margin: 0;
        }

        .selector-card {
            background: white;
            border-radius: 30px;
            padding: 40px;
            box-shadow: 0 15px 40px rgba(0,0,0,.09);
        }

        .selector-card h2 {
            font-family: "Anton", sans-serif;
            font-size: 38px;
            margin-bottom: 22px;
        }

        .form-label {
            font-size: 13px;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .form-select,
        .form-control {
            border-radius: 15px;
            padding: 13px;
        }

        .form-select:focus,
        .form-control:focus {
            border-color: var(--rosa-fuerte);
            box-shadow: 0 0 0 .2rem rgba(232,107,152,.15);
        }

        .btn-cargar {
            width: 100%;
            border: none;
            border-radius: 25px;
            padding: 13px;
            background: var(--negro);
            color: white;
            font-weight: 900;
        }

        .btn-cargar:hover {
            background: var(--rosa-fuerte);
        }

        .listado-card {
            background: white;
            border-radius: 30px;
            padding: 40px;
            box-shadow: 0 15px 40px rgba(0,0,0,.09);
        }

        .titulo-listado {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            margin-bottom: 25px;
        }

        .titulo-listado h2 {
            font-family: "Anton", sans-serif;
            font-size: 40px;
            margin: 0;
        }

        .contador {
            background: var(--rosa);
            color: var(--negro);
            border-radius: 25px;
            padding: 9px 18px;
            font-weight: 900;
        }

        .alumno-fila {
            background: #faf8f5;
            border: 1px solid #eee8e0;
            border-radius: 20px;
            padding: 20px 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
            transition: .2s;
        }

        .alumno-fila:hover {
            background: #fff3f7;
            border-color: var(--rosa);
            transform: translateX(4px);
        }

        .alumno-nombre {
            font-size: 18px;
            font-weight: 900;
            margin-bottom: 4px;
        }

        .alumno-documento {
            color: var(--gris);
            font-size: 13px;
        }

        .presente-box {
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 800;
        }

        .presente-box input {
            width: 24px;
            height: 24px;
            accent-color: var(--rosa-fuerte);
        }

        .btn-guardar {
            width: 100%;
            background: var(--negro);
            color: white;
            border: none;
            border-radius: 26px;
            padding: 15px;
            font-weight: 900;
            margin-top: 15px;
        }

        .btn-guardar:hover {
            background: var(--rosa-fuerte);
        }

        .mensaje-vacio {
            text-align: center;
            padding: 45px 25px;
            background: #faf8f5;
            border: 2px dashed var(--rosa);
            border-radius: 22px;
        }

        .mensaje-vacio h3 {
            font-family: "Anton", sans-serif;
            font-size: 29px;
        }

        .mensaje-vacio p {
            color: var(--gris);
            margin-bottom: 0;
        }

        @media (max-width: 850px) {
            .encabezado {
                grid-template-columns: 1fr;
            }

            .alumno-fila {
                align-items: flex-start;
                gap: 18px;
            }
        }

        @media (max-width: 550px) {
            .navbar-profesor {
                padding: 14px 16px;
            }

            .marca {
                font-size: 20px;
            }

            .volver-panel {
                font-size: 13px;
                padding: 8px 13px;
            }

            .contenedor-asistencia {
                width: 94%;
            }

            .encabezado-texto,
            .selector-card,
            .listado-card {
                padding: 28px 22px;
            }

            .encabezado-texto h1 {
                font-size: 43px;
            }

            .titulo-listado {
                flex-direction: column;
                align-items: flex-start;
            }

            .alumno-fila {
                flex-direction: column;
            }
        }

    </style>

</head>

<body>

<nav class="navbar-profesor">

    <a href="profesores_panel.php" class="marca">
        Studio Gym Dance
    </a>

    <a href="profesores_panel.php" class="volver-panel">
        ← Volver al panel
    </a>

</nav>

<main class="contenedor-asistencia">

    <section class="encabezado">

        <div class="encabezado-texto">

            <small>HERRAMIENTAS DEL PROFESOR</small>

            <h1>
                REGISTRAR
                <span>ASISTENCIA</span>
            </h1>

            <p>
                Seleccioná una de tus clases, elegí la fecha y marcá
                solamente a los alumnos que estuvieron presentes.
            </p>

        </div>

        <div class="selector-card">

            <h2>Elegir clase</h2>

            <form method="GET">

                <div class="mb-4">

                    <label class="form-label">
                        Clase
                    </label>

                    <select
                        name="id_clase"
                        class="form-select"
                        required
                    >

                        <option value="">
                            Seleccionar una clase
                        </option>

                        <?php while ($clase = mysqli_fetch_assoc($resultadoClases)) { ?>

                            <option
                                value="<?php echo $clase["id_clase"]; ?>"
                                <?php
                                if ($id_clase == $clase["id_clase"]) {
                                    echo "selected";
                                }
                                ?>
                            >
                                <?php echo $clase["nombre_disciplina"]; ?>
                                -
                                <?php echo $clase["nombre_dia"]; ?>
                                <?php echo $clase["horario"]; ?>
                            </option>

                        <?php } ?>

                    </select>

                </div>

                <div class="mb-4">

                    <label class="form-label">
                        Fecha
                    </label>

                    <input
                        type="date"
                        name="fecha"
                        class="form-control"
                        value="<?php echo $fecha; ?>"
                        max="<?php echo date("Y-m-d"); ?>"
                        required
                    >

                </div>

                <button type="submit" class="btn-cargar">
                    Mostrar alumnos
                </button>

            </form>

        </div>

    </section>

    <?php if ($id_clase != "" && $datosClase) { ?>

        <section class="listado-card">

            <div class="titulo-listado">

                <div>
                    <h2>
                        <?php echo $datosClase["nombre_disciplina"]; ?>
                    </h2>

                    <p class="mb-0 text-secondary">
                        <?php echo $datosClase["nombre_dia"]; ?>
                        -
                        <?php echo $datosClase["horario"]; ?>
                        hs ·
                        <?php echo date("d/m/Y", strtotime($fecha)); ?>
                    </p>
                </div>

                <div class="contador">
                    Presentes:
                    <span id="cantidadPresentes">0</span>
                </div>

            </div>

            <?php if (
                $resultadoAlumnos &&
                mysqli_num_rows($resultadoAlumnos) > 0
            ) { ?>

                <form action="guardar_asistencia.php" method="POST">

                    <input
                        type="hidden"
                        name="id_clase"
                        value="<?php echo $id_clase; ?>"
                    >

                    <input
                        type="hidden"
                        name="fecha"
                        value="<?php echo $fecha; ?>"
                    >

                    <?php while ($alumno = mysqli_fetch_assoc($resultadoAlumnos)) { ?>

                        <div class="alumno-fila">

                            <div>

                                <div class="alumno-nombre">
                                    <?php echo $alumno["apellido"]; ?>,
                                    <?php echo $alumno["nombre"]; ?>
                                </div>

                                <div class="alumno-documento">
                                    <?php echo $alumno["nombre_tipo"] ?? "Documento"; ?>:
                                    <?php echo $alumno["numero_documento"]; ?>
                                </div>

                            </div>

                            <label class="presente-box">

                                <input
                                    type="checkbox"
                                    name="asistencia[]"
                                    value="<?php echo $alumno["id_alumno"]; ?>"
                                    class="checkbox-asistencia"
                                >

                                Presente

                            </label>

                        </div>

                    <?php } ?>

                    <button type="submit" class="btn-guardar">
                        Guardar asistencia
                    </button>

                </form>

            <?php } else { ?>

                <div class="mensaje-vacio">

                    <h3>
                        No hay alumnos inscriptos
                    </h3>

                    <p>
                        Todavía no hay alumnos registrados en esta clase.
                    </p>

                </div>

            <?php } ?>

        </section>

    <?php } ?>

</main>

<script>

const casillas = document.querySelectorAll(".checkbox-asistencia");
const contador = document.getElementById("cantidadPresentes");

function actualizarContador() {

    let cantidad = 0;

    casillas.forEach(function(casilla) {
        if (casilla.checked) {
            cantidad++;
        }
    });

    if (contador) {
        contador.textContent = cantidad;
    }
}

casillas.forEach(function(casilla) {
    casilla.addEventListener("change", actualizarContador);
});

</script>

</body>
</html>