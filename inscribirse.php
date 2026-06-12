<?php
session_start();
include("conexion.php");

$id_alumno = $_SESSION['id_alumno'];

$clases = explode(',', $_POST['clases']);

$isncriptas = 0;
$repetidas = 0;
$sin_cupo = 0;



foreach($clases as $id_clase){

    // Verificar si ya está inscripto
    $verificar = mysqli_query($conexion,
        "SELECT * FROM inscripciones
        WHERE id_alumno='$id_alumno'
        AND id_clase='$id_clase'"
    );

    if(mysqli_num_rows($verificar) > 0){
        $repetidas++;
        continue;
    }

    // Buscar cupos disponibles
    $consulta = mysqli_query($conexion,
        "SELECT cupo_maximo
        FROM clases
        WHERE id_clase='$id_clase'"
    );

    $clase = mysqli_fetch_assoc($consulta);

    if($clase['cupo_maximo'] <= 0){
        $sin_cupo++;
        continue;
    }

    // Registrar inscripción
    $sql = "INSERT INTO inscripciones
            (id_alumno, id_clase, estado, fecha_inscripcion)
            VALUES
            ('$id_alumno', '$id_clase', 'Activa', CURDATE())";

    mysqli_query($conexion, $sql);
    $inscriptas++;

    // Descontar cupo
    $actualizar = "UPDATE clases
                   SET cupo_maximo = cupo_maximo - 1
                   WHERE id_clase='$id_clase'";

    mysqli_query($conexion, $actualizar);
}

if($repetidas > 0){
   echo "<script>
   alert('Ya estas inscripta/o en una clase o mas seleccionadas');
   window.location.href='disciplinas_panel.php';
   </script>";
   exit();
}

if($sin_cupo > 0){
   echo "<script>
   alert('Una o mas clases no tienen cupos disponibles');
   window.location.href='disciplinas_panel.php';
   </script>";
   exit();
}


   echo "<script>
   alert('Inscripcion realizada correctamente');
   window.location.href='disciplinas_panel.php';
   </script>";




?>