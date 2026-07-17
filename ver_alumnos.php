<?php
session_start();
include("conexion.php");

if (!isset($_SESSION["id_profesor"])) {
    header("Location: alumnos.php");
    exit();
}

$id_profesor = $_SESSION["id_profesor"];

$sql = "SELECT DISTINCT
            a.id_alumno,
            a.nombre,
            a.apellido,
            a.numero_documento,
            a.telefono,
            a.email,
            d.nombre_disciplina,
            ds.nombre_dia,
            c.horario
        FROM clases c
        JOIN disciplinas d
            ON c.id_disciplina = d.id_disciplina
        JOIN dias_semanas ds
            ON c.id_dia = ds.id_dia
        JOIN inscripciones i
            ON i.id_clase = c.id_clase
        JOIN alumnos a
            ON i.id_alumno = a.id_alumno
        WHERE c.id_profesor = '$id_profesor'
        AND i.estado = 'Activa'
        ORDER BY a.apellido, a.nombre";

$resultado = mysqli_query($conexion, $sql);

$cantidadAlumnos = mysqli_num_rows($resultado);
?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Listado de alumnos</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link
        href="https://fonts.googleapis.com/css2?family=Anton&family=Montserrat:wght@400;500;700;800;900&display=swap"
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
            min-height:100vh;
            background:
                radial-gradient(#e8e4d8 28%, transparent 28%);
            background-size:50px 50px;
            background-color:var(--fondo);
            font-family:'Montserrat', sans-serif;
            color:var(--negro);
        }

        .navbar-profesor{
            background:var(--negro);
            padding:15px 25px;
            display:flex;
            justify-content:space-between;
            align-items:center;
            box-shadow:0 4px 20px rgba(0,0,0,.20);
        }

        .marca{
            color:var(--rosa);
            font-family:'Anton', sans-serif;
            font-size:25px;
            letter-spacing:1px;
            text-decoration:none;
        }

        .volver-panel{
            color:white;
            border:1px solid white;
            border-radius:25px;
            padding:9px 20px;
            text-decoration:none;
            font-weight:700;
            transition:.3s;
        }

        .volver-panel:hover{
            background:var(--rosa);
            border-color:var(--rosa);
            color:var(--negro);
        }

        

        .contenedor-alumnos{
            width:92%;
            max-width:1200px;
            margin:55px auto;
        }

       
        .cabecera{
            display:grid;
            grid-template-columns:.85fr 1.15fr;
            gap:25px;
            margin-bottom:30px;
        }

        .cabecera-texto{
            background:linear-gradient(135deg,#111,#2b2b2b);
            color:white;
            border-radius:30px;
            padding:45px;
            box-shadow:0 15px 40px rgba(0,0,0,.14);
            position:relative;
            overflow:hidden;
        }

        .cabecera-texto::after{
            content:"";
            position:absolute;
            width:190px;
            height:190px;
            border-radius:50%;
            background:rgba(244,201,214,.18);
            top:-65px;
            right:-60px;
        }

        .cabecera-texto > *{
            position:relative;
            z-index:1;
        }

        .cabecera-texto small{
            color:var(--rosa);
            font-weight:900;
            letter-spacing:3px;
        }

        .cabecera-texto h1{
            font-family:'Anton', sans-serif;
            font-size:54px;
            line-height:1;
            margin:14px 0 18px;
        }

        .cabecera-texto h1 span{
            color:var(--rosa);
        }

        .cabecera-texto p{
            color:#dddddd;
            line-height:1.7;
            margin:0;
        }

        .resumen-card{
            background:white;
            border-radius:30px;
            padding:40px;
            box-shadow:0 15px 40px rgba(0,0,0,.09);
            display:flex;
            flex-direction:column;
            justify-content:center;
        }

        .resumen-card p{
            margin:0 0 10px;
            color:#666;
            font-weight:800;
            text-transform:uppercase;
            letter-spacing:1px;
            font-size:13px;
        }

        .resumen-card h2{
            font-family:'Anton', sans-serif;
            font-size:65px;
            margin:0;
            color:var(--negro);
        }

        .resumen-card span{
            color:var(--rosa-fuerte);
            font-weight:800;
        }


        .listado-card{
            background:white;
            border-radius:30px;
            padding:40px;
            box-shadow:0 15px 40px rgba(0,0,0,.09);
        }

        .listado-card h2{
            font-family:'Anton', sans-serif;
            font-size:40px;
            margin-bottom:25px;
        }

        .tabla-responsive{
            overflow-x:auto;
        }

        table{
            width:100%;
            border-collapse:separate;
            border-spacing:0 12px;
        }

        thead th{
            font-size:12px;
            text-transform:uppercase;
            letter-spacing:1px;
            color:#777;
            padding:0 16px 8px;
            border:none;
        }

        tbody tr{
            background:#faf8f5;
            transition:.25s;
        }

        tbody tr:hover{
            background:#fff3f7;
            transform:translateX(4px);
        }

        tbody td{
            padding:18px 16px;
            border-top:1px solid #eee8e0;
            border-bottom:1px solid #eee8e0;
            vertical-align:middle;
        }

        tbody td:first-child{
            border-left:1px solid #eee8e0;
            border-radius:18px 0 0 18px;
        }

        tbody td:last-child{
            border-right:1px solid #eee8e0;
            border-radius:0 18px 18px 0;
        }

        .nombre-alumno{
            font-weight:900;
            color:#111;
        }

        .dato-secundario{
            color:#666;
            font-size:14px;
        }

        .clase-badge{
            display:inline-block;
            background:var(--rosa);
            color:#111;
            border-radius:20px;
            padding:7px 13px;
            font-size:12px;
            font-weight:800;
        }

      

        .mensaje-vacio{
            background:#faf8f5;
            border:2px dashed var(--rosa);
            border-radius:22px;
            padding:45px 25px;
            text-align:center;
        }

        .mensaje-vacio h3{
            font-family:'Anton', sans-serif;
            font-size:30px;
            margin-bottom:10px;
        }

        .mensaje-vacio p{
            color:#666;
            margin:0;
        }

        @media(max-width:850px){

            .cabecera{
                grid-template-columns:1fr;
            }

            .cabecera-texto,
            .resumen-card,
            .listado-card{
                padding:30px 24px;
            }

            .cabecera-texto h1{
                font-size:45px;
            }
        }

        @media(max-width:550px){

            .navbar-profesor{
                padding:14px 16px;
            }

            .marca{
                font-size:20px;
            }

            .volver-panel{
                padding:8px 13px;
                font-size:13px;
            }

            .contenedor-alumnos{
                width:94%;
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

<main class="contenedor-alumnos">

    <section class="cabecera">

        <div class="cabecera-texto">

            <small>
                HERRAMIENTAS DEL PROFESOR
            </small>

            <h1>
                MIS
                <span>ALUMNOS</span>
            </h1>

            <p>
                Consultá los alumnos inscriptos en las clases
                y disciplinas que tenés asignadas.
            </p>

        </div>

        <div class="resumen-card">

            <p>
                Total de alumnos
            </p>

            <h2>
                <?php echo $cantidadAlumnos; ?>
            </h2>

            <span>
                alumnos inscriptos
            </span>

        </div>

    </section>

    <section class="listado-card">

        <h2>
            Listado de alumnos
        </h2>

        <?php if ($cantidadAlumnos > 0) { ?>

            <div class="tabla-responsive">

                <table>

                    <thead>

                        <tr>
                            <th>Alumno</th>
                            <th>Documento</th>
                            <th>Teléfono</th>
                            <th>Email</th>
                            <th>Clase</th>
                        </tr>

                    </thead>

                    <tbody>

                        <?php while ($fila = mysqli_fetch_assoc($resultado)) { ?>

                            <tr>

                                <td>

                                    <div class="nombre-alumno">
                                        <?php echo htmlspecialchars(
                                            $fila["apellido"] . ", " . $fila["nombre"]
                                        ); ?>
                                    </div>

                                </td>

                                <td>

                                    <span class="dato-secundario">
                                        <?php echo htmlspecialchars($fila["numero_documento"]); ?>
                                    </span>

                                </td>

                                <td>

                                    <span class="dato-secundario">
                                        <?php echo htmlspecialchars($fila["telefono"]); ?>
                                    </span>

                                </td>

                                <td>

                                    <span class="dato-secundario">
                                        <?php echo htmlspecialchars($fila["email"]); ?>
                                    </span>

                                </td>

                                <td>

                                    <span class="clase-badge">

                                        <?php echo htmlspecialchars($fila["nombre_disciplina"]); ?>

                                        ·

                                        <?php echo htmlspecialchars($fila["nombre_dia"]); ?>

                                        <?php echo htmlspecialchars($fila["horario"]); ?>

                                    </span>

                                </td>

                            </tr>

                        <?php } ?>

                    </tbody>

                </table>

            </div>

        <?php } else { ?>

            <div class="mensaje-vacio">

                <h3>
                    Todavía no tenés alumnos inscriptos
                </h3>

                <p>
                    Cuando un alumno se inscriba a una de tus clases,
                    aparecerá automáticamente en este listado.
                </p>

            </div>

        <?php } ?>

    </section>

</main>

</body>
</html>