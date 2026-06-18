<?php 

include("conexion.php");

$nombre = $_POST ['nombre'];
$apellido = $_POST ['apellido'];
$dni = $_POST ['dni'];
$telefono = $_POST ['telefono'];
$email = $_POST ['email'];
$fecha_nacimiento = $_POST ['fecha_nacimiento'];
$password = $_POST ['password'];
$id_tipo_documento = $_POST ['password'];

$password = $_POST['password'];
$confirmar_password = $_POST['confirmar_password'];

if($password != $repetir_password){
    echo "<script>
            alert('Las contraseñas no coinciden');
            window.history.back();
          </script>";
    exit();
}

$numero_documento = $_POST['numero_documento'];

$verificar = mysqli_query($conexion,
"SELECT * FROM alumnos
WHERE numero_documento = '$numero_documento'");

if(mysqli_num_rows($verificar) > 0){
    echo "<script>
            alert('Ya existe un alumno registrado con ese DNI');
            window.history.back();
          </script>";
    exit();
}

$sql ="INSERT INTO alumnos
(nombre, apellido, numero_documento, telefono, email, fecha_nacimiento, password)

VALUES 

('$nombre', '$apellido', '$dni', '$telefono', '$email', '$fecha_nacimiento', '$password')";

if(mysqli_query($conexion, $sql)){ 
echo "<script>
     alert('cuenta creada correctamente');
     window.location='alumnos.php';
</script>";
} else { 
echo "Error:" . mysqli_error($conexion);
}


?>