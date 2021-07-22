<?php
ini_set('display_errors', true);
error_reporting(E_ALL);
date_default_timezone_set("America/Argentina/Buenos_Aires");

define('RUTA', 'img/zapatillas/');
define('SECCIONES', 'secciones/');

//Conectamos con la base de datos "moov"
$server = 'localhost';
$user = 'root';
$password = '';
$db = 'moov';
$conexion = mysqli_connect($server, $user, $password, $db);

session_start();