<?php
$sql_categorias = "SELECT * FROM categorias;";
$db_categorias = mysqli_query($conexion, $sql_categorias);

$sql_monedas = "SELECT * FROM monedas;";
$db_monedas = mysqli_query($conexion, $sql_monedas);

$errores = [];
if (!empty($_GET['campos']))
    $errores = json_decode($_GET['campos']);

$prod_cate = [];
$producto = [];
$accion = 'Crear';
$archivo = 'proceso_alta.php';

if (!empty($_GET['id'])) {
    $producto_id = $_GET['id'];
    $sql_productos = "SELECT * FROM productos WHERE productos_id = $producto_id";
    $db_productos = mysqli_query($conexion, $sql_productos);

    if (!$db_productos->num_rows) {
        header('Location: index.php?secciones=lista_productos&status=error');
        exit;
    }

    $accion = 'Editar';
    $archivo = 'proceso_editar.php';
    $producto = mysqli_fetch_assoc($db_productos);

    $sql_categorias_productos = "SELECT categorias_id_fk FROM productos_tienen_categorias WHERE productos_id_fk=$producto_id;";
    $db_categorias_productos = mysqli_query($conexion, $sql_categorias_productos);
    while ($res_categorias_productos = mysqli_fetch_assoc($db_categorias_productos)) {
        $prod_cate[] = $res_categorias_productos['categorias_id_fk'];
    }
}

?>
<?php
if (!empty($_GET['tipo']) && $_GET['tipo'] == 'producto'):
    ?>
    <div class="alert alert-danger fade show" role="alert">
        Hubo un error al crear el producto. Intentá nuevamente
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php
endif;
?>
<section class="container">
    <div class="row">
        <h2 class="col-12 text-center pt-5 pb-5"><?= $accion ?> Producto</h2>

        <form action="procesos/<?= $archivo ?>" method="POST" enctype="multipart/form-data" class="col-12 col-md-8 m-auto pb-5">
            <div>
                <?php if(isset($producto['productos_id'])){?>
                <input type="hidden" name="id" value="<?= $producto['productos_id'] ?>">
                <?php } ?>
                <label for="nombre">Nombre *</label>
                <input class="w-100 p-3 mb-4" placeholder="Nombre" type="text" id="nombre" name="nombre" value="<?= isset($producto['nombre']) ? $producto['nombre'] : '' ?>">
                <?php
                if (isset($_SESSION['errores']) && isset($_SESSION['errores']['nombre'])){ ?>
                    <div class="alert alert-danger fade show mt-2" role="alert">
                        <?= $_SESSION['errores']['nombre'] ?>
                    </div>
                <?php } ?>
            </div>
            <div>
                <label for="precio">Precio *</label>
                <input class="w-100 p-3 mb-4" placeholder="Precio" type="number" id="precio" name="precio" min="0.01" step="0.01" value="<?= isset($producto['precio']) ? $producto['precio'] : '' ?>">
                <?php
                if (isset($_SESSION['errores']) && isset($_SESSION['errores']['precio'])){ ?>
                    <div class="alert alert-danger fade show mt-2" role="alert">
                        <?= $_SESSION['errores']['precio'] ?>
                    </div>
                <?php } ?>
            </div>
            <div>
                <label>Descripción</label>
                <textarea class="w-100 p-3 mb-4" placeholder="Descripción del producto" name="descripcion" id="descripcion" rows="3"><?= isset($producto['descripcion']) ? $producto['descripcion'] : '' ?></textarea>
                <?php if (isset($errores->descripcion)){ ?>
                <div class="alert alert-danger fade show mt-2" role="alert">
                    <?= $errores->descripcion ?>
                </div>
                <?php } ?>
            </div>
            <div>
                <label for="categoria">Categoría</label>
                <select name="categoria[]" id="categoria" class="w-100 p-3 form-select-lg mb-3" style="height:max-content;" aria-label=".form-select-lg example">
                <?php
                while ($cate = mysqli_fetch_assoc($db_categorias)){ ?>
                    <option value="<?= $cate['categorias_id'] ?>"  <?= in_array($cate['categorias_id'], $prod_cate) ? 'selected' : '' ?> ><?= $cate['categoria'] ?></option>
                <?php } ?>
                </select>
            </div>
            <div>
                <label for="stock">Stock *</label>
                <input class="w-100 p-3 mb-4" placeholder="Stock" type="number" id="stock" name="stock" min="0.01" step="0.01" value="<?= isset($producto['stock']) ? $producto['stock'] : '' ?>">
                <?php
                if (isset($_SESSION['errores']) && isset($_SESSION['errores']['stock'])){ ?>
                    <div class="alert alert-danger fade show mt-2" role="alert">
                        <?= $_SESSION['errores']['stock'] ?>
                    </div>
                <?php } ?>
            </div>
            <div>
                <label class="d-block">Moneda *</label>
                <ul>
                <?php
                while ($moneda = mysqli_fetch_assoc($db_monedas)){ ?>
                    <li>
                        <input type="radio" name="moneda" value="<?= $moneda['monedas_id'] ?>" class=" text-dark" id="<?= $moneda['monedas_id'] ?>" <?= (isset($producto['monedas_id_fk']) && $producto['monedas_id_fk'] == $moneda['monedas_id']) ? 'checked' : '' ?>>
                        <label for="<?= $moneda['monedas_id'] ?>"><?= $moneda['moneda'] ?></label>
                    </li>
                <?php } ?>
                </ul>
            </div>
            <div>
                <label class="d-block">Destacado</label>
                <ul>
                    <li>
                        <input type="radio" name="destacado" value="1" class=" text-dark" id="si" <?= (isset($producto['destacado']) && $producto['destacado'] == 1) ? 'checked' : '' ?>>
                        <label for="si">Si</label>
                    </li>
                    <li>
                        <input type="radio" name="destacado" value="0"
                       class=" text-dark" id="no" <?= (isset($producto['destacado']) && $producto['destacado'] == 0) ? 'checked' : '' ?>>
                        <label for="no">No</label>
                    </li>
                </ul>
            </div>
            <div class="center">
                <input type="submit" value="<?= $accion ?> producto" class="w-50 mb-4 p-2 mt-4">
            </div>
            <div class="center">
                <a href="../panel/index.php" class="volver" >Volver al panel</a>
            </div>
        </form>
    </div>
</section>