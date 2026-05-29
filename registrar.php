<?php 

include("conexion.php");

$nombre = $_POST ['nombre'];
$apellido = $_POST ['apellido'];
$dni = $_POST ['dni'];
$telefono = $_POST ['telefono'];
$email = $_POST ['email'];
$fecha_nacimiento = $_POST ['fecha_nacimiento'];
$id_pack = $_POST ['id_pack'];
$password = $_POST ['password'];
$id_tipo_documento = $_POST ['password'];

$sql ="INSERT INTO alumnos
(nombre, apellido, numero_documento, telefono, email, fecha_nacimiento, id_pack, password)

VALUES 

('$nombre', '$apellido', '$dni', '$telefono', '$email', '$fecha_nacimiento', '$id_pack', '$password')";

if(mysqli_query($conexion, $sql)){ 
echo "<script>
     alert('cuenta creada correctamente');
     window.location='alumnos.php';
</script>";
} else { 
echo "Error:" . mysqli_error($conexion);
}


?>