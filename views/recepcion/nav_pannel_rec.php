<?php
	include "llamada_metodos_rec.php";
?>

<div id="header-wrapper">
	<div class="container">
		<div class="row">
			<div class="col-12">

				<header id="header">
					<h1><a href="/Maxima_Entrega/views/recepcion/inicio_rec.php" id="logo">Máxima Entrega</a></h1>
					<nav id="nav">
						<a class="current-page-item"><?php echo "Hola ".$_SESSION['nomUsuario']."!"; ?></a>
						<a href="/Maxima_Entrega/views/recepcion/mensajes_rec.php">Mensajes (<?php echo $mensajesNoLeidos->mensajesNoLeidos(); ?>)</a>
						<a href="/Maxima_Entrega/views/recepcion/encomiendas_rec.php">Encomiendas</a>
						<a href="/Maxima_Entrega/views/recepcion/recepcion_rec.php">Recepción</a>
						<a href="/Maxima_Entrega/views/recepcion/despacho.php">Despacho</a>
						<a href="/Maxima_Entrega/views/recepcion/logout.php"">Salir</a>
					</nav>
				</header>

			</div>
		</div>
	</div>
</div>