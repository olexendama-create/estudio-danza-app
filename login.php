<?php 

session_start();

include("conexion.php");

if(isset($_POST['dni'])){
        $dni = $_POST['dni'];

}else if(isset($_POST['email'])){ 
        $dni = $_POST['email'];
}else{
        $dni ="";
}

if(isset($_POST['password'])){
      $password = $_POST['password'];
}else{
        $password = "";
}

$sqlAdmin =  "SELECT * FROM administradores
             WHERE usuario='$dni'
             AND password='$password'";

$resultadoAdmin = mysqli_query($conexion, $sqlAdmin);

if(mysqli_num_rows($resultadoAdmin) > 0){

     
    $filaProfesor = mysqli_fetch_assoc($resultadoAdmin);

    $_SESSION['id_admin'] = $filaProfesor['id_admin'];
    $_SESSION['usuario_admin'] = $filaProfesor['usuario'];

header("Location: panel_admin.php");
exit();
}

$sqlProfesor = "SELECT * FROM profesores
                WHERE email='$dni'
                AND password='$password'";

$resultadoProfesor = mysqli_query($conexion, $sqlProfesor);

if(mysqli_num_rows($resultadoProfesor) > 0){
        
    $filaProfesor = mysqli_fetch_assoc($resultadoProfesor);

    $_SESSION['id_profesor'] = $filaProfesor['id_profesor'];
    $_SESSION['nombre_profesor'] = $filaProfesor['nombre'];
    $_SESSION['apellido_profesor'] = $fila['apellido'];

    header("Location: profesores_panel.php");
    exit();
}


$sql = "SELECT * FROM alumnos 
        WHERE numero_documento='$dni'
        AND password='$password'";

$resultado = mysqli_query($conexion, $sql);

if(mysqli_num_rows($resultado) > 0){

$fila = mysqli_fetch_assoc($resultado);

$_SESSION['id_alumno'] = $fila['id_alumno'];
$_SESSION['nombre_alumno'] = $fila['nombre'];
$_SESSION['apellido_alumno'] = $fila['apellido'];

header("Location: panel_alumno.php");
exit();

}else{

echo "DNI o Contraseña incorrecta";

} 



?>