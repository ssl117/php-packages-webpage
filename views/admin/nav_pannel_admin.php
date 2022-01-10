<?php
	include "llamada_metodos_admin.php";
?>

<div id="header-wrapper">
	<div class="container">
		<div class="row">
			<div class="col-12">

				<header id="header">
					<h1><a href="/Maxima_Entrega/views/admin/inicio_admin.php" id="logo">Máxima Entrega</a></h1>
					<nav id="nav">
							<a class="current-page-item"><?php echo "Hola ".$_SESSION['nomUsuario']."!"; ?></a>
							<a href="/Maxima_Entrega/views/admin/mensajes_admin.php">Mensajes (<?php echo $mensajesNoLeidos->mensajesNoLeidos(); ?>)</a>
							<a href="/Maxima_Entrega/views/admin/encomiendas_admin.php">Encomiendas</a>
							<a href="/Maxima_Entrega/views/admin/recepcion_admin.php">Recepción</a>
							<a href="/Maxima_Entrega/views/admin/usuarios.php">Usuarios</a>
							<a href="/Maxima_Entrega/views/admin/logout.php"">Salir</a>
					</nav>
				</header>

			</div>
		</div>
	</div>
</div>