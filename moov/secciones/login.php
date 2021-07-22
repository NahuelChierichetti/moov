<?php
//Mensaje que nos nostificarán sobre el registro del usuario
if (!empty($_SESSION['ok'])): ?>
    <div class="alert alert-success fade show" role="alert">
        <?= $_SESSION['ok'] ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php
elseif (!empty($_SESSION['error'] )): ?>
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

<section class="container">
	<div class="row">
		<h2 class="col-12 text-center pt-5 pb-5">Login</h2>
	
		<form action="procesos/proceso_login.php" method="POST" class="col-12 col-md-8 m-auto pb-5">
            <div>
                <label for="usuario">Usuario</label>
                <input class="w-100 p-3 mb-4" placeholder="Usuario" type="text" name="usuario"  id ="usuario" value="<?= isset($_SESSION['campos']) && isset($_SESSION['campos']['usuario']) ?  $_SESSION['campos']['usuario'] : ''?>"/>
                <?php
                    if (isset($_SESSION['errores']) && isset($_SESSION['errores']['usuario'])):
                    ?>
                    <div class="alert alert-danger fade show mt-2" role="alert">
                        <?= $_SESSION['errores']['usuario'] ?>
                    </div>
                <?php
                endif;
                ?>
            </div>
            <div>
                <label for="contrasena">Contraseña</label>
                <input class="w-100 p-3 mb-4" placeholder="Contraseña" type="password" name="contrasena" id ="contrasena" value="<?= isset($_SESSION['campos']) && isset($_SESSION['campos']['contrasena']) ?  $_SESSION['campos']['contrasena'] : ''?>"/>
                <?php
                    if (isset($_SESSION['errores']) && isset($_SESSION['errores']['contrasena'])):
                    ?>
                    <div class="alert alert-danger fade show mt-2" role="alert">
                        <?= $_SESSION['errores']['contrasena'] ?>
                    </div>
                <?php
                endif;
                ?>
            </div>
            <div class="center">
                <input type="submit" class="w-50 mb-4 p-2 mt-4" value="Iniciar Sesión">
            </div>
		</form>				
	</div>
</section>