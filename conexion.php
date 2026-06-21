<?php

$conexion = mysqli_connect(
    "sql203.infinityfree.com",
    "if0_42165443",
    "Damayandre2112",
    "if0_42165443_studiogymdance"
);

if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

?>