<?php
require_once('../../config/config.php');
require_once('../../config/funciones.php');

if (empty($_POST['id'])) {
    header("Location: ../index.php?seccion=lista_productos&status=error");
    exit;
}

$producto_id = $_POST['id'];
$sql_producto = "SELECT productos_id FROM productos WHERE productos_id=$producto_id";
$db_producto = mysqli_query($conexion, $sql_producto);

if (!$db_producto->num_rows) {
    header("Location: ../index.php?seccion=lista_productos&status=error");
    exit;
}

$sql_delete = "DELETE FROM productos WHERE productos_id=$producto_id";
$db_delete = mysqli_query($conexion, $sql_delete);

if ($db_delete) {
    header("Location: ../index.php?seccion=lista_productos&status=ok&accion=eliminado");
} else {
    header("Location: ../index.php?seccion=lista_productos&status=error");
}