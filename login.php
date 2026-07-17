<?php

session_start();

include("conexion.php");

$dni = "";

if (isset($_POST["dni"])) {
    $dni = trim($_POST["dni"]);
} elseif (isset($_POST["email"])) {
    $dni = trim($_POST["email"]);
}

$password = isset($_POST["password"])
    ? $_POST["password"]
    : "";

$id_tipo_documento = isset($_POST["id_tipo_documento"])
    ? (int) $_POST["id_tipo_documento"]
    : 0;

$sqlAdmin = "SELECT * FROM administradores
             WHERE usuario = ?
             AND password = ?
             LIMIT 1";

$consultaAdmin = mysqli_prepare($conexion, $sqlAdmin);

mysqli_stmt_bind_param(
    $consultaAdmin,
    "ss",
    $dni,
    $password
);

mysqli_stmt_execute($consultaAdmin);

$resultadoAdmin = mysqli_stmt_get_result($consultaAdmin);

if (mysqli_num_rows($resultadoAdmin) > 0) {

    $filaAdmin = mysqli_fetch_assoc($resultadoAdmin);

    $_SESSION["id_admin"] = $filaAdmin["id_admin"];
    $_SESSION["usuario_admin"] = $filaAdmin["usuario"];
    $_SESSION["rol"] = "administrador";

    header("Location: panel_admin.php");
    exit();
}


$sqlProfesor = "SELECT * FROM profesores
                WHERE email = ?
                AND password = ?
                LIMIT 1";

$consultaProfesor = mysqli_prepare($conexion, $sqlProfesor);

mysqli_stmt_bind_param(
    $consultaProfesor,
    "ss",
    $dni,
    $password
);

mysqli_stmt_execute($consultaProfesor);

$resultadoProfesor = mysqli_stmt_get_result($consultaProfesor);

if (mysqli_num_rows($resultadoProfesor) > 0) {

    $filaProfesor = mysqli_fetch_assoc($resultadoProfesor);

    $_SESSION["id_profesor"] = $filaProfesor["id_profesor"];
    $_SESSION["nombre_profesor"] = $filaProfesor["nombre"];
    $_SESSION["apellido_profesor"] = $filaProfesor["apellido"];
    $_SESSION["rol"] = "profesor";

    header("Location: profesores_panel.php");
    exit();
}


if ($id_tipo_documento <= 0) {
     echo  "<script>
              alert('Para ingresar como alumno debe seleccionar el tipo de documento');
              window.history.back();
       </script>";
   exit();
}

$sqlAlumno = "SELECT * FROM alumnos
              WHERE numero_documento = ?
              AND id_tipo_documento = ?
              AND password = ?
              LIMIT 1";

$consultaAlumno = mysqli_prepare($conexion, $sqlAlumno);

mysqli_stmt_bind_param(
    $consultaAlumno,
    "sis",
    $dni,
    $id_tipo_documento,
    $password
);

mysqli_stmt_execute($consultaAlumno);

$resultadoAlumno = mysqli_stmt_get_result($consultaAlumno);

if (mysqli_num_rows($resultadoAlumno) > 0) {

    $filaAlumno = mysqli_fetch_assoc($resultadoAlumno);

    $_SESSION["id_alumno"] = $filaAlumno["id_alumno"];
    $_SESSION["nombre_alumno"] = $filaAlumno["nombre"];
    $_SESSION["apellido_alumno"] = $filaAlumno["apellido"];
    $_SESSION["rol"] = "alumno";

    header("Location: panel_alumno.php");
    exit();

} else {

    echo "Usuario, tipo de documento o contraseña incorrectos.";
}

?>