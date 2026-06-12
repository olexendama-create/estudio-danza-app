<?php
session_start();

if(!isset($_SESSION['id_alumno']))
{
    header("Location: login.php");
    exit();
}

include("conexion.php");
?>