<?php
	include "llamada_metodos_rec.php";
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
				include "nav_pannel_rec.php";
				?>

			<!-- Main -->
				<div id="main">
					<div class="container">
						<div class="row main-row">
							<div class="col-8 col-12-medium">
								<h1 id="titulo-encomiendas">despacho encomiendas</h1>
								<table>	
									<thead>
										<tr class="info">
											<th>Fecha Recibido</th>
											<th>Hora Recibido</th>
											<th>Ciudad Origen</th>
											<th>Ciudad Destino</th>
											<th>Direccion Destino</th>
											<th>Nom. Destinatario</th>
											<th>Tel. Destinatario</th> 
											<th>Nom. Remitente</th>
											<th>Tel. Remitente</th>
											<th>Codigo Encomienda</th>
											<th>Estado Despachado</th>
											<th>Acción</th>
										</tr>
									</thead>
									<tbody>
										<?php 
											foreach($datos as $dato) {
										 ?>
										 <tr>
										 	<td><?php echo $dato['fecha_rec'] ?></td>
										 	<td><?php echo $dato['hora_rec'] ?></td>
										 	<td><?php echo $dato['ciudad_origen'] ?></td>
										 	<td><?php echo $dato['ciudad_destino'] ?></td>
										 	<td><?php echo $dato['direccion_destino'] ?></td>
										 	<td><?php echo $dato['nombre_dest'] ?></td>
										 	<td><?php echo $dato['tel_dest'] ?></td>
										 	<td><?php echo $dato['nombre_remit'] ?></td>
										 	<td><?php echo $dato['tel_remit'] ?></td>
										 	<td><?php echo $dato['codigo'] ?></td>
										 	<td><?php if($dato['estado_desp'] == 0){
										 				echo "No";
										 			}else{
										 				echo "Sí";
										 			} ?></td>
								

										 	<td>
									 			<form action="" id="<?php echo $dato['codigo'] ?>" onsubmit="return confirm('¿Está seguro que desea despachar esta encomienda?');" method="POST">

									 				<input type="hidden" name="clave" value="<?php echo $dato['codigo'] ?>" />

									 				<button type="submit" name="despachar" class="button" value="<?php echo $dato['codigo'] ?>" />Despachar</button>
									 	
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
							<div class="col-4 col-12-medium" id="buscar-paginado">

								<form action="encomiendas_rec_desp_buscar.php" method="POST">
									<p>Ingrese Código Encomienda o Nombre Remitente</p>
									<input type="text" name="codigoNomRem" placeholder ="Código o Nombre" autofocus="true"/>
									<button type="submit" class="button" name="buscarEncRec"/>Buscar</button>
								</form>							

							</div>
							<div class="col-4 col-12-medium" id="buscar-paginado">
								<?php print $paginado->getPaginadoEncomiendasDespacho(); ?>
							</div>
							
							<div class="col-4 col-12-medium">

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