<?php
require_once('../../config/config.php');
require_once('../../config/funciones.php');

$id = intval($_POST['id']);
$sql_producto = "SELECT * FROM productos WHERE productos_id=$id";
$db_producto = mysqli_query($conexion, $sql_producto);

if (!$db_producto->num_rows) {
    header('Location: index.php?secciones=alta_producto&status=error');
    exit;
}

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
    $errores['moneda'] = 'Tienes que seleccionar un tipo de moneda';
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

$sql_update = "UPDATE productos SET nombre='$nombre', descripcion='$descripcion', precio='$precio', stock='$stock', destacado='$destacado', monedas_id_fk='$moneda_id_fk' WHERE productos_id = $id";
$db_modificado = mysqli_query($conexion, $sql_update);

if ($db_modificado) {

    $sql_cate_prod = "SELECT categorias_id_fk FROM productos_tienen_categorias WHERE productos_id_fk=$id";
    $res_sql_cate_prod = mysqli_query($conexion, $sql_cate_prod);


    while ($prod_cate_res = mysqli_fetch_assoc($res_sql_cate_prod)) {
        $prod_cate[] = $prod_cate_res['categorias_id_fk'];
    }

    $cate_eliminada = array_diff($prod_cate, $_POST['categoria']);
    $cate_agregada = array_diff($_POST['categoria'], $prod_cate);

    if (!count($cate_agregada) && !count($cate_eliminada)) {
        header("Location: ../index.php?seccion=lista_productos&status=ok&accion=modificado");
        exit;
    }

    if (count($cate_agregada)) {
        $values = '';
        foreach ($cate_agregada as $categoria_id_fk) {
            $values .= "($id,$categoria_id_fk),";
        }
        $values = substr($values, 0, -1);
        $values .= ';';

        $sql_insert_categoria = "INSERT INTO productos_tienen_categorias (productos_id_fk, categorias_id_fk) VALUES $values";
        $db_insert_categoria = mysqli_query($conexion, $sql_insert_categoria);
    }

    if (count($cate_eliminada)) {
        $values_del = '';
        foreach ($cate_eliminada as $categoria_id_fk) {
            $values_del .= "categorias_id_fk = $categoria_id_fk OR";
        }
        $values_del = substr($values_del, 0, -3);
        $values_del .= ';';

        $sql_delete_categoria = "DELETE FROM productos_tienen_categorias WHERE $values_del";
        $db_delete_categoria = mysqli_query($conexion, $sql_delete_categoria);
    }


    if ($db_insert_categoria || $db_delete_categoria) {
        header("Location: ../index.php?seccion=lista_productos&status=ok&accion=modificado");
        exit;
    } else {
        header("Location: ../index.php?seccion=lista_productos&status=error&tipo=categoria");
        exit;
    }

} else {
    header("Location: ../index.php?seccion=alta_producto&id=$id&status=error&tipo=producto");
    exit;
}