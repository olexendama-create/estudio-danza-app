<?php 

include("conexion.php");

$dni = $_POST ['dni'];
$password = $_POST ['password'];

$sql ="SELECT * FROM alumnos
WHERE numero_documento='$dni'
AND password='$password'";

$resultado = mysqli_query($conexion, $sql);

if(mysqli_num_rows($resultado) > 0){

    header("Location: panel_alumno.php");

}else{

    echo "DNI o Contraseña incorrecta";
}


?>