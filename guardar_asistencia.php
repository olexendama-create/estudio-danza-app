<?php

include("conexion.php");

$fecha = date("Y-m-d");

if(isset($_POST['asistencia'])){

foreach($_POST['asistencia'] as $id_alumno){

$sql = "INSERT INTO asistencias
        (id_alumno,fecha,presente)
        VALUES
        ('$id_alumno','$fecha',1)";

mysqli_query($conexion,$sql);

}

}

echo "Asistencia guardada";
?>