<?php
session_start();
include("conexion.php");

if (!isset($_SESSION['id_profesor'])) {
    header("Location: alumnos.php");
    exit();
}

$mensaje = "";

if (isset($_POST['subir'])) {

    $id_clase = $_POST['id_clase'];
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];

    $archivo = $_FILES['archivo']['name'];
    $ruta_temporal = $_FILES['archivo']['tmp_name'];

    $carpeta = "materiales/";
    $ruta_final = $carpeta . $archivo;

    if (move_uploaded_file($ruta_temporal, $ruta_final)) {

        $sql = "INSERT INTO materiales
                (id_clase, titulo, descripcion, archivo, fecha_subida)
                VALUES
                ('$id_clase', '$titulo', '$descripcion', '$ruta_final', CURDATE())";

        if (mysqli_query($conexion, $sql)) {
            $mensaje = "Material subido correctamente.";
        } else {
            $mensaje = "Ocurrió un error al guardar el material.";
        }

    } else {
        $mensaje = "No se pudo subir el archivo.";
    }
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

    <title>Subir material</title>

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
            font-family: 'Montserrat', sans-serif;
            color: var(--negro);
        }

      

        .navbar-profesor {
            background: var(--negro);
            padding: 15px 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 20px rgba(0, 0, 0, .20);
        }

        .navbar-profesor a {
            text-decoration: none;
        }

        .marca {
            color: var(--rosa);
            font-family: 'Anton', sans-serif;
            font-size: 25px;
            letter-spacing: 1px;
        }

        .volver-panel {
            color: white;
            border: 1px solid white;
            border-radius: 25px;
            padding: 9px 20px;
            font-weight: 700;
            transition: .3s;
        }

        .volver-panel:hover {
            background: var(--rosa);
            border-color: var(--rosa);
            color: var(--negro);
        }

       
        .contenedor-material {
            width: 92%;
            max-width: 1100px;
            margin: 55px auto;
        }

        .cabecera-material {
            display: grid;
            grid-template-columns: .85fr 1.15fr;
            gap: 25px;
            align-items: stretch;
        }

      

        .informacion-material {
            background: linear-gradient(135deg, #111, #2b2b2b);
            color: white;
            border-radius: 30px;
            padding: 45px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, .15);
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .informacion-material::after {
            content: "";
            position: absolute;
            width: 190px;
            height: 190px;
            border-radius: 50%;
            background: rgba(244, 201, 214, .18);
            right: -70px;
            top: -65px;
        }

        .informacion-material small {
            color: var(--rosa);
            font-weight: 900;
            letter-spacing: 3px;
            position: relative;
            z-index: 1;
        }

        .informacion-material h1 {
            font-family: 'Anton', sans-serif;
            font-size: 53px;
            line-height: 1;
            margin: 15px 0 20px;
            position: relative;
            z-index: 1;
        }

        .informacion-material h1 span {
            color: var(--rosa);
        }

        .informacion-material p {
            color: #dddddd;
            line-height: 1.7;
            margin: 0;
            position: relative;
            z-index: 1;
        }

        .detalle-info {
            margin-top: 28px;
            padding: 18px;
            border: 1px solid rgba(255, 255, 255, .20);
            border-radius: 18px;
            color: #eeeeee;
            font-size: 14px;
            position: relative;
            z-index: 1;
        }

       

        .formulario-material {
            background: var(--blanco);
            border-radius: 30px;
            padding: 45px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, .10);
        }

        .formulario-material h2 {
            font-family: 'Anton', sans-serif;
            font-size: 42px;
            margin-bottom: 8px;
        }

        .formulario-material .subtexto {
            color: var(--gris);
            margin-bottom: 30px;
        }

        .form-label {
            font-size: 13px;
            font-weight: 900;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .form-control,
        .form-select {
            padding: 13px;
            border-radius: 15px;
            border: 1px solid #cccccc;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--rosa-fuerte);
            box-shadow: 0 0 0 .2rem rgba(232, 107, 152, .15);
        }

        textarea.form-control {
            min-height: 120px;
            resize: vertical;
        }

        .archivo-info {
            background: #fdf2f6;
            border-left: 5px solid var(--rosa-fuerte);
            padding: 14px;
            border-radius: 10px;
            margin-bottom: 22px;
            font-size: 13px;
            color: #555555;
        }

        .btn-subir {
            width: 100%;
            background: var(--negro);
            color: white;
            border: none;
            border-radius: 26px;
            padding: 14px;
            font-weight: 900;
            transition: .3s;
        }

        .btn-subir:hover {
            background: var(--rosa-fuerte);
        }

        .mensaje-exito {
            background: #fdf2f6;
            border: 1px solid var(--rosa);
            border-left: 6px solid var(--rosa-fuerte);
            border-radius: 16px;
            padding: 16px 20px;
            margin-bottom: 25px;
            font-weight: 700;
        }

        @media (max-width: 850px) {

            .cabecera-material {
                grid-template-columns: 1fr;
            }

            .informacion-material,
            .formulario-material {
                padding: 32px 25px;
            }

            .informacion-material h1 {
                font-size: 44px;
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
                padding: 8px 13px;
                font-size: 13px;
            }

            .contenedor-material {
                width: 94%;
                margin-top: 30px;
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

<main class="contenedor-material">

    <div class="cabecera-material">

        <section class="informacion-material">

            <small>
                HERRAMIENTAS DEL PROFESOR
            </small>

            <h1>
                SUBIR
                <span>MATERIAL</span>
            </h1>

            <p>
                Compartí archivos, ejercicios, coreografías y contenido
                complementario para acompañar el aprendizaje de tus alumnos.
            </p>

            <div class="detalle-info">
                El material estará disponible en el panel de los alumnos
                que estén inscriptos en la clase seleccionada.
            </div>

        </section>

        <section class="formulario-material">

            <h2>
                Nuevo material
            </h2>

            <p class="subtexto">
                Completá los datos y seleccioná el archivo que querés compartir.
            </p>

            <?php if ($mensaje != "") { ?>

                <div class="mensaje-exito">
                    <?php echo $mensaje; ?>
                </div>

            <?php } ?>

            <form
                method="POST"
                enctype="multipart/form-data"
            >

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

                        <option value="1">
                            Danza Clásica - Lunes 16:00
                        </option>

                        <option value="26">
                            Árabe - Sábado 17:00
                        </option>

                    </select>

                </div>

                <div class="mb-4">

                    <label class="form-label">
                        Título
                    </label>

                    <input
                        type="text"
                        name="titulo"
                        class="form-control"
                        placeholder="Ejemplo: Coreografía para practicar"
                        required
                    >

                </div>

                <div class="mb-4">

                    <label class="form-label">
                        Descripción
                    </label>

                    <textarea
                        name="descripcion"
                        class="form-control"
                        placeholder="Escribí una breve descripción del material"
                    ></textarea>

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Archivo
                    </label>

                    <input
                        type="file"
                        name="archivo"
                        class="form-control"
                        required
                    >

                </div>

                <div class="archivo-info">
                    Podés subir documentos, imágenes, videos o archivos
                    relacionados con el contenido de la clase.
                </div>

                <button
                    type="submit"
                    name="subir"
                    class="btn-subir"
                >
                    Subir material
                </button>

            </form>

        </section>

    </div>

</main>

</body>
</html>