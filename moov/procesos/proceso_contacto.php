<?php
require_once('../config/config.php');
require_once('../config/funciones.php');

$errores = [];

// Comprobamos que los campos requeridos no estén vacios
if (empty($_POST['nombre']))
    $errores['nombre'] = 'El nombre no puede estar vacío';

if (empty($_POST['apellido']))
    $errores['apellido'] = 'El apellido no puede estar vacío';


if (empty($_POST['email']))
    $errores['email'] = 'El email no puede estar vacío';

if (count($errores)) {
    $_SESSION['errores'] = $errores;
    $_SESSION['campos'] = $_POST;

    header("Location: ../index.php?seccion=contacto");
    exit;
}

// Guardamos en las variables los datos que nos pasa el usuario al enviar
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$email = $_POST['email'];

// Verificamos si hay o no errores
if (!empty($nombre) && !empty($apellido) && !empty($email)) {
    unset($_SESSION['errores']);
    unset($_SESSION['campos']);

    $_SESSION['ok'] = 'Gracias por su consulta';

    header('Location: ../index.php?seccion=inicio');
} else {
    $_SESSION['campos'] = $_POST;
    unset($_SESSION['errores']);

    header('Location: ../index.php?seccion=contacto&status=error');
}