<?php
require_once('../config/config.php');
require_once('../config/funciones.php');

$usuario = mysqli_real_escape_string($conexion, $_POST['usuario']);
$seleccionar_usuario = "SELECT * FROM usuarios WHERE usuario = '$usuario'";
$resul_seleccionar_usuario = mysqli_query($conexion, $seleccionar_usuario);
$user = mysqli_fetch_assoc($resul_seleccionar_usuario);

//Comrpobamos que el usuario exites y verificamos la contraseña
if ((!$resul_seleccionar_usuario->num_rows) || !password_verify($_POST['contrasena'], $user['password'])) {
    unset($_SESSION['errores']);
    $_SESSION['error'] = 'El usuario o la contraseña son incorrectos';
    header("Location: ../index.php?seccion=login");
    exit;
} 

unset($user['password']);

unset($_SESSION['errores']);
unset($_SESSION['error']);

$_SESSION['usuario'] = $user;

//Comprobamos que tipo de usuario es para mandarle a la sección correspondiente
if(isset($_SESSION['usuario']) && $_SESSION['usuario']['tipo_usuarios_id_fk'] == 1){
    header("Location: ../panel/index.php");
}else{
    header('Location: ../index.php?seccion=home');
}