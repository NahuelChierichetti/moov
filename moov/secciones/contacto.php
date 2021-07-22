<section class="container">
	<div class="row">
		<h2 class="col-12 text-center pt-5 pb-5">Contacto</h2>
			
		<form action="procesos/proceso_contacto.php" method="POST" class="col-12 col-md-8 m-auto pb-5">
			<div>
                <label for="nombre">Nombre *</label>
                <input class="w-100 p-3 mb-4" placeholder="Nombre" type="text" name="nombre" id ="nombre" value="<?= isset($_SESSION['campos']) && isset($_SESSION['campos']['nombre']) ?  $_SESSION['campos']['nombre'] : ''?>"/>
                <?php
                    if (isset($_SESSION['errores']) && isset($_SESSION['errores']['nombre'])):
                    ?>
                    <div class="alert alert-danger fade show mt-2" role="alert">
                        <?= $_SESSION['errores']['nombre'] ?>
                    </div>
                <?php
                endif;
                ?>
            </div>
			<div>
                <label for="apellido">Apellido *</label>
                <input class="w-100 p-3 mb-4" placeholder="Apellido" type="text" name="apellido" id ="apellido" value="<?= isset($_SESSION['campos']) && isset($_SESSION['campos']['apellido']) ?  $_SESSION['campos']['apellido'] : ''?>"/>
                <?php
                    if (isset($_SESSION['errores']) && isset($_SESSION['errores']['apellido'])):
                    ?>
                    <div class="alert alert-danger fade show mt-2" role="alert">
                        <?= $_SESSION['errores']['apellido'] ?>
                    </div>
                <?php
                endif;
                ?>
            </div>
			<div>
                <label for="email">Email *</label>
                <input class="w-100 p-3 mb-4" placeholder="Email" type="email" name="email" id ="email" value="<?= isset($_SESSION['campos']) && isset($_SESSION['campos']['email']) ?  $_SESSION['campos']['email'] : ''?>"/>
                <?php
                    if (isset($_SESSION['errores']) && isset($_SESSION['errores']['email'])):
                    ?>
                    <div class="alert alert-danger fade show mt-2" role="alert">
                        <?= $_SESSION['errores']['email'] ?>
                    </div>
                <?php
                endif;
                ?>
            </div>
			<div>
                <label for="mensaje">Mensaje</label>
                <textarea class="w-100 p-3 mb-4" placeholder="Mensaje" name="mensaje" id ="mensaje" value="<?= isset($_SESSION['campos']) && isset($_SESSION['campos']['mensaje']) ?  $_SESSION['campos']['mensaje'] : ''?>"></textarea>
            </div>
			<div>
				<span>Informar sobre: </span>
				<label class="d-block "><input type="checkbox" value="Ofertas" name="opcion[]" /> Ofertas</label>
				<label class="d-block"><input type="checkbox" value="Nuevos ingresos" name="opcion[]" /> Nuevos ingresos</label>
				<label class="d-block "><input type="checkbox" value="Producto agotado" name="opcion[]" /> Producto agotado</label>
				<label class="d-block "><input type="checkbox" value="Productos relacionados" name="opcion[]" /> Productos relacionados</label>
			</div>
			<!--<input type="text" name="nombre" placeholder="Nombre" class="w-100 p-3" value=""/>
			<input type="text" name="apellido" placeholder="Apellido" class="w-100 p-3" value=""/>
			<input type="email" name="email" placeholder="Email" class="w-100 p-3" value="" />
			<input type="textarea" name="mensaje" placeholder="Mensaje" value="" class="w-100 p-3">
			<span>Informar sobre: </span>
			<label class="d-block "><input type="checkbox" value="Ofertas" name="opcion[]" /> Ofertas</label>
			<label class="d-block"><input type="checkbox" value="Nuevos ingresos" name="opcion[]" /> Nuevos ingresos</label>
			<label class="d-block "><input type="checkbox" value="Producto agotado" name="opcion[]" /> Producto agotado</label>
			<label class="d-block "><input type="checkbox" value="Productos relacionados" name="opcion[]" /> Productos relacionados</label>-->	
			<div class="pt-3 center">	
				<input type="submit" class="w-50 mb-4 p-2 m-auto" value="Enviar">
			</div>	
		</form>		
		<div class="col-12 col-md-4 text-right">
			<h4 class="info">Número de Contacto</h4>
			<p>+549114576554</p>
			<p>+549114576555</p>
			<h4 class="info">Locales</h4>
			<p>Alto Avellaneda</p>
			<p>Shopping Palermo</p>
			<p>Av. Corrientes 2087 - CABA</p>
			<p>Calle 8 n°453 - La Plata</p>
		</div>
	</div>
</section>

