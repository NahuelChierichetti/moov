<?php
require_once('../config/config.php');
require_once('../config/funciones.php');

$errores = [];
// Escapamos los valores antes de utilizarlos en la base de datos
$nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
$apellido = mysqli_real_escape_string($conexion, $_POST['apellido']);
$email = mysqli_real_escape_string($conexion, $_POST['email']);
$usuario = mysqli_real_escape_string($conexion, $_POST['usuario']);

//Comprobamos los valores recibidos
if (empty($nombre))
    $errores['nombre'] = 'El nombre no puede estar vacío';
elseif (strlen($_POST['nombre']) > 80)
    $errores['nombre'] = 'El nombre puede tener hasta 80 caracteres';

if (empty($email))
    $errores['email'] = 'El email no puede estar vacío';
else {
    $seleccionar_email = "SELECT email FROM usuarios WHERE email = '$email'";
    $resul_seleccionar_email = mysqli_query($conexion, $seleccionar_email);
    
    if ($resul_seleccionar_email->num_rows)
        $errores['email'] = 'El email ya está registrado';
    elseif (strlen($email) > 100)
        $errores['email'] = 'El email puede tener hasta 100 caracteres';
}

if (empty($usuario))
    $errores['usuario'] = 'El usuario no puede estar vacío';
else {
    $seleccionar_usuario = "SELECT usuario FROM usuarios WHERE usuario = '$usuario'";
    dd2($seleccionar_usuario);
    $resul_seleccionar_usuario = mysqli_query($conexion, $seleccionar_usuario);

    if ($resul_seleccionar_usuario->num_rows)
        $errores['usuario'] = 'El usuario ya está registrado';
    elseif (strlen($usuario) > 60)
        $errores['usuario'] = 'El nombre de usuario puede tener hasta 60 caracteres';
}

if (empty($_POST['contrasena']))
    $errores['contrasena'] = 'La contraseña no puede estar vacío';
elseif (strlen($_POST['contrasena']) < 6)
    $errores['contrasena'] = 'La contraseña no puede tener menos de 6 caracteres';

//Comprobamos si hay errores
if (count($errores)) {
    $_SESSION['errores'] = $errores;
    $_SESSION['campos'] = $_POST;

    header("Location: ../index.php?seccion=registro");
    exit;
}

$apellido = $apellido ?? null;
$contrasena = password_hash($_POST['contrasena'], PASSWORD_DEFAULT);

//Insertamos los valores a la base de datos con la siguiente sentencia SQL
$insertar = "INSERT INTO usuarios (nombre, apellido, usuario, email, password, tipo_usuarios_id_fk)
VALUES('$nombre', '$apellido', '$usuario', '$email', '$contrasena', 2);";
$resul_insertar = mysqli_query($conexion, $insertar);

//Notificamos la acción del registro
if ($resul_insertar) {
    unset($_SESSION['errores']);
    unset($_SESSION['campos']);

    $_SESSION['ok'] = 'Gracias por registrarte! Ya podés iniciar sesión';

    header('Location: ../index.php?seccion=login');
} else {
    $_SESSION['campos'] = $_POST;
    unset($_SESSION['errores']);

    header('Location: ../index.php?seccion=registro&status=error');
}