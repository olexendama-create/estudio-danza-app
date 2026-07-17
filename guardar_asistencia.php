<?php
session_start();
include("conexion.php");

if (!isset($_SESSION["id_profesor"])) {
    header("Location: alumnos.php");
    exit();
}

$id_profesor = $_SESSION["id_profesor"];
$id_clase = $_POST["id_clase"];
$fecha = $_POST["fecha"];

$presentes = isset($_POST["asistencia"])
    ? $_POST["asistencia"]
    : [];

/* Verificar que la clase pertenezca al profesor */

$sqlClase = "SELECT id_clase
             FROM clases
             WHERE id_clase = '$id_clase'
             AND id_profesor = '$id_profesor'";

$resultadoClase = mysqli_query($conexion, $sqlClase);

if (mysqli_num_rows($resultadoClase) == 0) {
    exit("No tenés permiso para registrar asistencia en esta clase.");
}

/* Buscar todos los alumnos inscriptos en la clase */

$sqlAlumnos = "SELECT id_alumno
               FROM inscripciones
               WHERE id_clase = '$id_clase'
               AND estado = 'Activa'";

$resultadoAlumnos = mysqli_query($conexion, $sqlAlumnos);

while ($alumno = mysqli_fetch_assoc($resultadoAlumnos)) {

    $id_alumno = $alumno["id_alumno"];

    if (in_array($id_alumno, $presentes)) {
        $presente = 1;
    } else {
        $presente = 0;
    }

    /* Comprobar si ya existe asistencia de ese día */

    $sqlExiste = "SELECT *
                  FROM asistencias
                  WHERE id_alumno = '$id_alumno'
                  AND id_clase = '$id_clase'
                  AND fecha = '$fecha'";

    $resultadoExiste = mysqli_query($conexion, $sqlExiste);

    if (mysqli_num_rows($resultadoExiste) > 0) {

        $sqlGuardar = "UPDATE asistencias
                       SET presente = '$presente'
                       WHERE id_alumno = '$id_alumno'
                       AND id_clase = '$id_clase'
                       AND fecha = '$fecha'";

    } else {

        $sqlGuardar = "INSERT INTO asistencias
                       (
                           id_alumno,
                           id_clase,
                           fecha,
                           presente
                       )
                       VALUES
                       (
                           '$id_alumno',
                           '$id_clase',
                           '$fecha',
                           '$presente'
                       )";
    }

    mysqli_query($conexion, $sqlGuardar);
}

header(
    "Location: registrar_asistencia.php?id_clase="
    . $id_clase
    . "&fecha="
    . $fecha
    . "&guardado=1"
);

exit();
?>