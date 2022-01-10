<?php
	include "llamada_metodos_admin.php";
?>

<!DOCTYPE HTML>
<!--
	Minimaxing by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>

	<!-- Header -->
		<?php
		include "../header.php";
		?>
	
	<body>
		<div id="page-wrapper">

			<!-- Nav -->
				<?php
				include "nav_pannel_admin.php";
				?>

			<!-- Main -->
				<div id="main">
					<div class="container">
						<div class="row main-row">
							<div class="col-8 col-12-medium">
								<h1 id="titulo-mensajes">mensajes recibidos</h1>
								<table>	
									<thead>
										<tr class="info">
											<th>ID</th>
											<th>Nombre</th>
											<th>Mail</th>
											<th>Telefono</th>
											<th>Asunto</th>
											<th>Consulta</th>
											<th>Leído</th>
											<th>Cambiar</th>
										</tr>
									</thead>
									<tbody>
										<?php 
											foreach($formularios as $dato) {
										 ?>
										 <tr>
										 	<td><?php echo $dato['id'] ?></td>
										 	<td><?php echo $dato['nombre'] ?></td>
										 	<td><?php echo $dato['mail'] ?></td>
										 	<td><?php echo $dato['telefono'] ?></td>
										 	<td><?php echo $dato['asunto'] ?></td>
										 	<td><?php echo $dato['consulta'] ?></td>
										 	<td><?php if($dato['estado'] == 0){
										 				echo "No";
										 			}else{
										 				echo "Sí";
										 			} ?>
										 	</td>
										 	<td>
										 		<form action="" onsubmit="return confirm('¿Está seguro que desea archivar este mensaje?');" method="POST">

													<input type="hidden" name="estado" value="<?php echo $dato['estado'] ?>" />
									 			
									 				<input type="hidden" name="id" value="<?php echo $dato['id'] ?>" />

										 			<button type="submit" name="archivar" class="btn btn-primary">
										 			<i class="fas fa-exchange-alt"></i>
										 			</button>

										 		</form>
										 	</td>
										 </tr>
										 <?php 
										 	}
										 ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>

			<!-- Main -->
				<div id="main">
					<div class="container">
						<div class="row main-row">
							<div class="col-4 col-12-medium" id="buscar-paginado">				<?php print $paginado->getPaginadoMensajesAdmin(); ?>
							</div>
						</div>
					</div>
				</div>

			<!-- Footer -->
				<?php
				include "../footer.php";
				?>

		</div>

	</body>
</html>