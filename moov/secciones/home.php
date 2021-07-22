<?php
// Mostramos un mensaje para notificar al usuario si hemos recicibo o no su consulta
if (!empty($_SESSION['ok'])):
    ?>
    <div class="alert alert-success fade show" role="alert">
        <?= $_SESSION['ok'] ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php
elseif (!empty($_SESSION['error'] )):
    ?>
    <div class="alert alert-danger fade show" role="alert">
        <?= $_SESSION['error']  ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif;
unset($_SESSION['error']);
unset($_SESSION['ok']);
?>

<div class="">
	<div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
			<div class="carousel-inner">
		    <div class="carousel-item active">
		      <img src="img/banner-min.png" class="d-block w-100" alt="HOT SALE">
		    </div>
			</div>
	</div>
</div>
<section class="container pb-5">
	<div class="row">
		<h2 class="col-12 text-center p-5">Mood Style</h2>
		<div class="mt-5 mb-3 col-12 col-lg-4">
			<h3>Tenemos los mejores precios y la mejor calidad</h3>
			<p>Somos una empresa lider encargada de distribuir las mejores marcas del mercado con el objetivo de acercarte la mayor calidad al menor precio.</p>
			<p>Contamos con más de 20 sucursales a lo largo del territorio argentino y estamos trabajando para seguir acompañandolos en cada momento.</p>
		</div>
		<div class="mt-5 col-12 col-lg-8">
			<img src="img/mood-min.jpg" class="img-fluid" alt="">
		</div>
	</div>
</section>
<section class="container-fluid bg-light">
	<div class="row">
		<div class="col-12 col-md-6 col-lg-4 pt-5 pb-5">
			<div class="text-center">
				<img src="img/tarjeta-min.png" class="img-container" alt="Pagá con tarjeta o efectivo">
			</div>
			<h3 class="text-center py-3 px-4 beneficios">Pagá con Tarjeta</h3>
			<p class="text-center px-4 pbeneficios">Con Mercado Pago, tenés cuotas sin interés con tarjeta o efectivo en puntos de pago.</p>
		</div>
		<div class="col-12 col-md-6 col-lg-4 pt-5 pb-5">
			<div class="text-center">
				<img src="img/paquete-min.png" class="img-container" alt="Pagá con tarjeta o efectivo">
			</div>
			<h3 class="text-center py-3 px-4 beneficios">Envío rápido y seguro</h3>
			<p class="text-center px-4 pbeneficios">Elegí Mercado Envíos y seguí tu compra hasta que la recibas. Todos tus paquetes estarán protegidos.</p>
		</div>
		<div class="col-12 col-md-6 col-lg-4 pt-5 pb-5">
			<div class="text-center">
				<img src="img/seguro-min.png" class="img-container" alt="Pagá con tarjeta o efectivo">
			</div>
			<h3 class="text-center py-3 px-4 beneficios">Compra Protegida</h3>
			<p class="text-center px-4 pbeneficios">Te acompañamos hasta que recibas lo que compraste. Y si no es lo que esperabas, te devolvemos el dinero.</p>
		</div>
	</div>
</section>
<section class="container pb-5">
	<div class="row">
		<div class="mt-5 col-12 col-lg-8">
			<img src="img/online-min.jpg" class="img-fluid" alt="">
		</div>
		<div class="mt-5 mb-3 col-12 col-lg-4 text-right">
			<h3>¡Disfrutá de los beneficios con tu compra online!</h3>
			<p>Somos una empresa lider encargada de distribuir las mejores marcas del mercado con el objetivo de acercarte la mayor calidad al menor precio.</p>
			<p>Contamos con más de 20 sucursales a lo largo del territorio argentino y estamos trabajando para seguir acompañandolos en cada momento.</p>
		</div>
	</div>
</section>
