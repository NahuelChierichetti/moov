<?php
require_once('../../config/config.php');
require_once('../../config/funciones.php');

$errores = [];

if (empty($_POST['nombre'])) {
    $errores['nombre'] = 'El nombre no puede estar vacío';

} elseif (strlen($_POST['nombre']) > 80) {
    $errores['nombre'] = 'El nombre puede tener hasta 80 caracteres';
}

if (empty($_POST['descripcion'])) {
    $errores['descripcion'] = 'La descripción no puede estar vacía';

} elseif (strlen($_POST['descripcion']) > 400) {
    $errores['descripcion'] = 'La descripción puede tener hasta 400 caracteres';
}

if (empty($_POST['moneda'])) {
    $errores['moneda'] = 'Tenés que seleccionar un tipo de moneda';
}

if (empty($_POST['precio'])) {
    $errores['precio'] = 'El precio no puede estar vacío';
}

if (empty($_POST['stock'])) {
    $errores['stock'] = 'El stock no puede estar vacío';
}

if (count($errores)) {
    $_SESSION['errores'] = $errores;
    $_SESSION['campos'] = $_POST;

    header("Location: ../index.php?seccion=alta_producto&status=error");
    exit;
}

// Escapamos valores antes de utilizarlos en la base de datos
$nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
$descripcion = mysqli_real_escape_string($conexion, $_POST['descripcion']);
$moneda_id_fk = $_POST['moneda'];
$precio = $_POST['precio'];
$stock = $_POST['stock'];
$destacado =  mysqli_real_escape_string($conexion, $_POST['destacado']) ?? 0;

$sql_crear = "INSERT INTO productos (nombre, descripcion, precio, stock, destacado, monedas_id_fk) VALUES ('$nombre', '$descripcion', '$precio', $stock, '$destacado', '$moneda_id_fk')";
$db_crear = mysqli_query($conexion, $sql_crear);

if ($db_crear) {

    if (empty($_POST['categoria'])) {
        header("Location: ../index.php?seccion=lista_productos&status=ok&accion=creado");
        exit;
    }

    $producto_id_fk = mysqli_insert_id($conexion);
    $categorias = $_POST['categoria'];

    $values = '';
    foreach ($categorias as $categoria_id_fk) {
        $values .= "($producto_id_fk,$categoria_id_fk),";
    }

    $values = substr($values, 0, -1);
    $values .= ';';

    $insert_cat = "INSERT INTO productos_tienen_categorias (productos_id_fk, categorias_id_fk) VALUES $values";
    $res_insert_cat = mysqli_query($conexion, $insert_cat);

    if ($res_insert_cat) {
        header("Location: ../index.php?seccion=lista_productos&status=ok&accion=creado");
        exit;
    } else {
        header("Location: ../index.php?seccion=lista_productos&status=error&tipo=categoria");
        exit;
    }
} else {
    header("Location: ../index.php?seccion=alta_producto&status=error&tipo=producto");
    exit;
}