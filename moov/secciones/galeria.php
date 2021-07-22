<?php  
$db_productos = 'SELECT * FROM productos;';
$datos_db = mysqli_query($conexion, $db_productos);
?>
<section class="container">
	<div class="row">
		<h2 class="col-12 text-center pt-5 pb-5">Productos</h2>
		
       <?php while($producto = mysqli_fetch_assoc($datos_db)){?> 
    
            <div class="col-12 col-md-4 bg-light galeria">
                <?php if($producto['imagen'] == NULL){ ?>
                <img src="img/zapatillas/productosinfoto-min.png" class="card-img-top" alt="Producto sin foto">
                <?php }else { ?>
                <img src="<?= RUTA . $producto['imagen'] ?>" class="card-img-top" alt="<?= $producto['nombre'] ?>">
                <?php } ?>
                <div class="card-body">
                    <h4 class="card-title">$<?= $producto['precio'] ?></h4>
                    <h5 class="card-title"><?= $producto['nombre'] ?></h5>
                    <p class="card-text"><?= $producto['descripcion'] ?></p>
                    <p><?= stock($producto['stock'])?></p>
                    <!--<button class="btn btn-add">Agregar Producto</button>-->
                </div>
            </div>
        <?php }; ?>
	</div>
</section>
<section class="container-fluid bg-light mt-5 py-5">
	<div class="row">
		<h4 class="col-12 text-center" id="enviogratis">¡COMPRAS SUPERIORES A LOS $15.000 ENVÍO GRATIS!</h4>
	</div>
</section>