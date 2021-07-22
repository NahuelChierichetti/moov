<section class="container">
	<div class="row">
		<h2 class="col-12 text-center pt-5 pb-5">Registro</h2>
	
		<form action="procesos/proceso_registro.php" method="POST" class="col-12 col-md-8 m-auto pb-5">
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
                <label for="apellido">Apellido</label>
                <input class="w-100 p-3 mb-4" placeholder="Apellido" type="text" name="apellido" id ="apellido" value="<?= isset($_SESSION['campos']) && isset($_SESSION['campos']['apellido']) ?  $_SESSION['campos']['apellido'] : ''?>"/>
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
                <label for="usuario">Usuario *</label>
                <input class="w-100 p-3 mb-4" placeholder="Usuario" type="text" name="usuario" id ="usuario" value="<?= isset($_SESSION['campos']) && isset($_SESSION['campos']['usuario']) ?  $_SESSION['campos']['usuario'] : ''?>"/>
                <?php if (isset($_SESSION['errores']) && isset($_SESSION['errores']['usuario'])): ?>
                    <div class="alert alert-danger fade show mt-2" role="alert">
                        <?= $_SESSION['errores']['usuario'] ?>
                    </div>
                <?php endif; ?>
            </div>
            <div>
                <label for="contrasena">Contraseña *</label>
                <input class="w-100 p-3 mb-4" placeholder="Contraseña" type="password" name="contrasena" id ="contrasena" value="<?= isset($_SESSION['campos']) && isset($_SESSION['campos']['contrasena']) ?  $_SESSION['campos']['contrasena'] : ''?>"/>
                <?php if (isset($_SESSION['errores']) && isset($_SESSION['errores']['contrasena'])): ?>
                    <div class="alert alert-danger fade show mt-2" role="alert">
                        <?= $_SESSION['errores']['contrasena'] ?>
                    </div>
                <?php endif; ?>
            </div>	
            <div class="center">
                <input type="submit" class="w-50 mb-4 p-2 mt-4" value="Registrarme">
            </div>
		</form>				
	</div>
</section>