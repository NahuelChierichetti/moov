<?php
$editar = '<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 20 20"><path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/><path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/></svg>';
$eliminar = '<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 20 20">  <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/></svg>';

$db_productos = 'SELECT * FROM productos
LEFT JOIN monedas ON monedas_id=monedas_id_fk
LEFT JOIN productos_tienen_categorias ON productos_id = productos_id_fk
LEFT JOIN categorias ON categorias_id=categorias_id_fk;';
$datos_db = mysqli_query($conexion, $db_productos);
?>

<?php
if (!empty($_GET['tipo']) && $_GET['tipo'] == 'categoria'): ?>
    <div class="alert alert-danger fade show" role="alert">
        El producto fue creado exitosamente pero no se pudieron asignar las categorias
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php
elseif ((!empty($_GET['status']) && $_GET['status'] == 'ok') && (!empty($_GET['accion']) && ($_GET['accion'] == 'creado' || $_GET['accion'] == 'eliminado' || $_GET['accion'] == 'modificado'))):
    $accion = $_GET['accion'];
    ?>
    <div class="alert alert-success fade show" role="alert">
        El producto fue <?= $accion ?> exitosamente
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif; ?>
<section class="container">
    <div class="row">
        <h2 class="col-12 text-center pt-5 pb-5">Lista de Productos</h2>
    
        <div class="row m-0 p-0">
            <div class="col-12 m-0 p-0">
                <a class="btn-moov mb-5" href="index.php?seccion=alta_producto" >Nuevo producto</a>
                <div class="table-responsive mt-5">
                    <table class="table table-striped">
                        <thead class="text-center">
                            <tr>
                                <th>Cod.</th>
                                <th>Stock</th>
                                <th class="text-left">Nombre</th>
                                <th class="text-right">Precio</th>
                                <th>Moneda</th>
                                <th>Destacado</th>
                                <th>Descripción</th>
                                <th>Categoría</th>
                                <th>Editar</th>
                                <th>Eliminar</th>
                            </tr>
                        </thead>
                        <tbody>

                        <?php
                        while ($producto = mysqli_fetch_assoc($datos_db)):
                            ?>
                            <tr>
                                <td class="text-center"><?= $producto['productos_id'] ?></td>
                                <td class="text-center"><?= $producto['stock'] ?></td>
                                <td><?= $producto['nombre'] ?></td>
                                <td class="text-right"><?= $producto['precio'] ?></td>
                                <td class="text-center"><?= $producto['moneda'] ?></td>
                                <td class="text-center"><?= $producto['destacado'] ? 'Si' : 'No' ?></td>
                                <td class="text-center"><?= $producto['descripcion'] ?></td>
                                <td class="text-center"><?= $producto['categoria'] ?></td>
                                <td class="text-center">
                                    <a class="btn-editar" href="index.php?seccion=alta_producto&id=<?= $producto['productos_id'] ?>"><?= $editar ?></a>
                                </td>
                                <td class="text-center">
                                    <form action="procesos/proceso_baja.php" method="POST">
                                        <input type="hidden" name="id" value="<?= $producto['productos_id'] ?>">
                                        <input type="submit" value="Eliminar" class="btn btn-eliminar">
                                    </form>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
