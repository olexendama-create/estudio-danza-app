<?php
session_start();

?>

<h1>Panel Profesor</h1>

<p>Bienvenida/o <?php echo $_SESSION['nombre_profesor']; ?></p>

<hr>

<a href="subir_material.php">Subir material</a>
<br><br>

<a href="registrar_asistencia.php">Registrar asistencia</a>
<br><br>

<a href="ver_alumnos.php">Ver alumnos</a>
<br><br>

<a href="profesores.html">Cerrar sesión</a>