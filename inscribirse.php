<?php

session_start();
include("conexion.php");

if (!isset($_SESSION['id_alumno'])) {

    echo "<script>
    alert(
        'Para inscribirse primero tenesque iniciar sesion como alumno.'
    );
    
    window.location.href = 'alumno.php';
    </script>
";

    exit();
}

$id_alumno = $_SESSION['id_alumno'];


if (!isset($_POST['clases']) || $_POST['clases'] == "") {

    echo "<script>
            alert('No seleccionaste ninguna clase');
            window.location.href='disciplinas_panel.php';
          </script>";

    exit();
}

$clases = explode(',', $_POST['clases']);

$inscriptas = 0;
$repetidas = 0;
$sin_cupo = 0;
$sin_clases_pack = 0;

$sqlPack = "SELECT *
            FROM pagos
            WHERE id_alumno='$id_alumno'
            AND estado='Activo'
            AND clases_restantes > 0
            ORDER BY id_pago ASC
            LIMIT 1";

$resultadoPack = mysqli_query($conexion, $sqlPack);

if (mysqli_num_rows($resultadoPack) == 0) {

    echo "<script>
            alert('No podés inscribirte porque no tenés un pack activo');
            window.location.href='packs.php';
          </script>";

    exit();
}

$pack = mysqli_fetch_assoc($resultadoPack);

$id_pago = $pack['id_pago'];
$id_pack = $pack['id_pack'];
$clases_restantes = $pack['clases_restantes'];


foreach ($clases as $id_clase) {

    $id_clase = (int) $id_clase;

    if ($id_clase <= 0) {
        continue;
    }


    if ($clases_restantes <= 0) {
        $sin_clases_pack++;
        continue;
    }


    $verificar = mysqli_query(
        $conexion,
        "SELECT *
         FROM inscripciones
         WHERE id_alumno='$id_alumno'
         AND id_clase='$id_clase'
         AND estado='Activa'"
    );

    if (mysqli_num_rows($verificar) > 0) {
        $repetidas++;
        continue;
    }


    $consultaClase = mysqli_query(
        $conexion,
        "SELECT cupo_maximo
         FROM clases
         WHERE id_clase='$id_clase'"
    );

    if (mysqli_num_rows($consultaClase) == 0) {
        continue;
    }

    $clase = mysqli_fetch_assoc($consultaClase);

    if ($clase['cupo_maximo'] <= 0) {
        $sin_cupo++;
        continue;
    }

    $sqlInscripcion = "INSERT INTO inscripciones
                       (
                           id_alumno,
                           id_pack,
                           id_clase,
                           estado,
                           fecha_inscripcion
                       )
                       VALUES
                       (
                           '$id_alumno',
                           '$id_pack',
                           '$id_clase',
                           'Activa',
                           CURDATE()
                       )";

    if (mysqli_query($conexion, $sqlInscripcion)) {

        $inscriptas++;


        mysqli_query(
            $conexion,
            "UPDATE clases
             SET cupo_maximo = cupo_maximo - 1
             WHERE id_clase='$id_clase'
             AND cupo_maximo > 0"
        );



        mysqli_query(
            $conexion,
            "UPDATE pagos
             SET clases_restantes = clases_restantes - 1
             WHERE id_pago='$id_pago'
             AND clases_restantes > 0"
        );

        $clases_restantes--;



        if ($clases_restantes <= 0) {

            mysqli_query(
                $conexion,
                "UPDATE pagos
                 SET clases_restantes=0,
                     estado='Agotado'
                 WHERE id_pago='$id_pago'"
            );
        }
    }
}



$mensaje = "";

if ($inscriptas > 0) {
    $mensaje .= "Te inscribiste correctamente a $inscriptas clase(s). ";
}

if ($repetidas > 0) {
    $mensaje .= "$repetidas clase(s) ya estaban inscriptas. ";
}

if ($sin_cupo > 0) {
    $mensaje .= "$sin_cupo clase(s) no tenían cupo. ";
}

if ($sin_clases_pack > 0) {
    $mensaje .= "No tenías suficientes clases disponibles en el pack para completar todas las inscripciones. ";
}

if ($mensaje == "") {
    $mensaje = "No se pudo realizar ninguna inscripción.";
}




echo "<script>
        alert(" . json_encode($mensaje) . ");
        window.location.href='disciplinas_panel.php';
      </script>";

exit();

?>