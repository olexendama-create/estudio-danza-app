<?php
session_start();

error_reporting(E_ALL);
ini_set("display_errors", 1);

include("conexion.php");


if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    exit("Acceso no permitido.");
}

$nombre = trim($_POST["nombre"] ?? "");
$apellido = trim($_POST["apellido"] ?? "");
$numero_documento = trim($_POST["dni"] ?? "");
$telefono = trim($_POST["telefono"] ?? "");
$email = trim($_POST["email"] ?? "");
$fecha_nacimiento = $_POST["fecha_nacimiento"] ?? "";
$password = $_POST["password"] ?? "";
$confirmar_password = $_POST["confirmar_password"] ?? "";
$id_tipo_documento = (int) ($_POST["id_tipo_documento"] ?? 0);


if (
    $nombre === "" ||
    $apellido === "" ||
    $numero_documento === "" ||
    $telefono === "" ||
    $email === "" ||
    $fecha_nacimiento === "" ||
    $password === "" ||
    $confirmar_password === "" ||
    $id_tipo_documento <= 0
) {
    echo "<script>
            alert('Complete todos los campos obligatorios');
            window.history.back();
          </script>";
    exit();
}


if (!preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑüÜ ]+$/u', $nombre)) {

$_SESSION["error_nombre"] = "El nombre solo puede contener letras.";
$_SESSION["datos_formulario"] = $_POST;

header("Location: alumnos.php#registro");
    exit();
}


if (!preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑüÜ ]+$/u', $apellido)) {
    echo "<script>
            alert('El apellido solo puede contener letras');
            window.history.back();
          </script>";
    exit();
}


if (!preg_match('/^[0-9]{7,15}$/', $numero_documento)) {
    echo "<script>
            alert('El documento debe contener solamente números');
            window.history.back();
          </script>";
    exit();
}


if (!preg_match('/^[0-9]{6,15}$/', $telefono)) {
    echo "<script>
            alert('El teléfono debe contener solamente números');
            window.history.back();
          </script>";
    exit();
}


$fecha_actual = date("Y-m-d");

if ($fecha_nacimiento > $fecha_actual) {
    echo "<script>
            alert('La fecha de nacimiento no puede ser futura');
            window.history.back();
          </script>";
    exit();
}


if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "<script>
            alert('Ingrese un correo electrónico válido');
            window.history.back();
          </script>";
    exit();
}

if (!preg_match('/@gmail\.com$/i', $email)) {
    echo "<script>
            alert('El correo debe terminar en @gmail.com');
            window.history.back();
          </script>";
    exit();
}


if (strlen($password) < 6) {
    echo "<script>
            alert('La contraseña debe tener al menos 6 caracteres');
            window.history.back();
          </script>";
    exit();
}

if ($password !== $confirmar_password) {
    echo "<script>
            alert('Las contraseñas no coinciden');
            window.history.back();
          </script>";
    exit();
}


$sqlDocumento = "SELECT id_alumno
                 FROM alumnos
                 WHERE numero_documento = ?
                 AND id_tipo_documento = ?
                 LIMIT 1";

$consultaDocumento = mysqli_prepare($conexion, $sqlDocumento);

mysqli_stmt_bind_param(
    $consultaDocumento,
    "si",
    $numero_documento,
    $id_tipo_documento
);

mysqli_stmt_execute($consultaDocumento);

$resultadoDocumento = mysqli_stmt_get_result($consultaDocumento);

if (mysqli_num_rows($resultadoDocumento) > 0) {
    echo "<script>
            alert('Ya existe un alumno con ese tipo y número de documento');
            window.history.back();
          </script>";
    exit();
}

$sqlEmail = "SELECT id_alumno
             FROM alumnos
             WHERE email = ?
             LIMIT 1";

$consultaEmail = mysqli_prepare($conexion, $sqlEmail);

mysqli_stmt_bind_param(
    $consultaEmail,
    "s",
    $email
);

mysqli_stmt_execute($consultaEmail);

$resultadoEmail = mysqli_stmt_get_result($consultaEmail);

if (mysqli_num_rows($resultadoEmail) > 0) {
    echo "<script>
            alert('Ya existe un alumno registrado con ese correo electrónico');
            window.history.back();
          </script>";
    exit();
}


$sqlInsertar = "INSERT INTO alumnos
(
    nombre,
    apellido,
    numero_documento,
    telefono,
    email,
    fecha_nacimiento,
    id_tipo_documento,
    password
)
VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

$consultaInsertar = mysqli_prepare($conexion, $sqlInsertar);

mysqli_stmt_bind_param(
    $consultaInsertar,
    "ssssssis",
    $nombre,
    $apellido,
    $numero_documento,
    $telefono,
    $email,
    $fecha_nacimiento,
    $id_tipo_documento,
    $password
);

if (mysqli_stmt_execute($consultaInsertar)) {

    echo "<script>
            alert('Cuenta creada correctamente');
            window.location='alumnos.php';
          </script>";

} else {

    echo "Error al crear el alumno: "
         . mysqli_stmt_error($consultaInsertar);
}

?>