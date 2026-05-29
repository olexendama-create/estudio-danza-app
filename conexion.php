<?php 

$conexion = mysqli_connect(
    "localhost",
    "root",
    "",
    "bd_estudio_gym_dance"
);

if (!$conexion) {
    die("Error de conexion");
}

?>
