<!DOCTYPE html>
<?php
require_once('../config/config.php');
require_once('../config/funciones.php');

$title = 'MOOV';
$alumno = 'Chierichetti Nahuel Nicolás | Rodríguez Manzanero Tamara';
$materia = 'Programación II';

if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['tipo_usuarios_id_fk'] != 1){
   header('Location: ../index.php?seccion=home');
}

?>
<html lang="es">
<head>
	 <meta charset="UTF-8" />
	 <title><?= $title ?></title>
	 <meta name="viewport" content="initial-scale=1, maximum-scale=1"/>
	 <meta name="author" content="Tamara Rodríguez Manznaero | Nahuel Nicolás Chierichetti"/>
	 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
	 <link rel="stylesheet" href="../css/estilos.css"/>
	 <link rel="icon" href="../img/favicon-min.png" type="image/png"/>
</head>

<body>
	<header>
	   <div class="container-fluid bg-light">
		   <nav class="menu navbar navbar-expand-md navbar-light">
			   <div>
			      <h1 class="logo"><a href="index.php?seccion=home"><?= $title ?></a></h1>
			   </div>
		          	
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#barra" aria-controls="barra" aria-expanded="false" aria-label="Menú Hamburguesa">
		         <span class="navbar-toggler-icon"></span>
		      </button>
					    
				<div class="collapse navbar-collapse" id="barra">
					<ul class="navbar-nav text-center ml-auto">			            
		            <?php if (isset($_SESSION['usuario'])): ?>
                     <li class="nav-item">
                        <a href="../procesos/proceso_logout.php" class="nav-link"> Cerrar Sesión </a>
                     </li>
                     <li class="nav-item mt-2"><span>Bienvenido <?= $_SESSION['usuario']['usuario'] ?></span>
                     </li>
						<?php endif; ?>
		      	</ul>
			   </div>
			</nav>
	   </div>
	</header>

  	<?php
     $seccion = $_GET['seccion'] ?? 'lista_productos';

     if (empty($seccion))
         $seccion = 'lista_productos';

     $ruta = SECCIONES . $seccion . '.php';

     if (file_exists($ruta))
         require_once($ruta);
     else
         require_once(SECCIONES . 'lista_productos');
    ?>

	<footer class="container-fluid px-0 py-5">
	   <div class="row m-0 p-0">
        	<div class="col-12 px-0">
         	<p class="text-center m-0"><?= $materia ?> | <?= $alumno ?> | <?= $title ?></p>
        	</div>
	   </div>
	</footer>

   <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
</body>
</html>