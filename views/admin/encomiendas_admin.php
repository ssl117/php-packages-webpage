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
								<h1 id="titulo-encomiendas-admin">encomiendas recibidas y despachadas</h1>
								<table>	
										<tr>
											<th>Fecha Recibido</th>
											<th>Hora</th>
											<th>Ciudad Origen</th>
											<th>Ciudad Destino</th>
											<th>Tipo de Paquete</th>
											<th>Direccion Destino</th>
											<th>Nom. Destinatario</th>
											<th>Tel. Destinatario</th> 
											<th>Nom. Remitente</th>
											<th>Tel. Remitente</th>
											<th>Codigo Encomienda</th>
											<th>Editar</th>
											<th>Estado Despachado</th>
											<th>Modif.</th>
											<th>Estado Cancelado</th>
											<th>Cancelar</th>
										</tr>
									<tbody>
										<?php 
											foreach($datos as $dato) {
										 ?>
										 <tr>
										 	<td><?php echo $dato['fecha_rec'] ?></td>
										 	<td><?php echo $dato['hora_rec'] ?></td>
										 	<td><?php echo $dato['ciudad_origen'] ?></td>
										 	<td><?php echo $dato['ciudad_destino'] ?></td>
										 	<td><?php echo $dato['tipo_paquete'] ?></td>
										 	<td><?php echo $dato['direccion_destino'] ?></td>
										 	<td><?php echo $dato['nombre_dest'] ?></td>
										 	<td><?php echo $dato['tel_dest'] ?></td>
										 	<td><?php echo $dato['nombre_remit'] ?></td>
										 	<td><?php echo $dato['tel_remit'] ?></td>
										 	<td><?php echo $dato['codigo'] ?></td>
										 	<td>		
										 		<form action="editar_enc.php" onsubmit="return confirm('¿Está seguro que desea editar esta encomienda?');" method="POST">

										 			<input type="hidden" name="fecha_rec" value="<?php echo $dato['fecha_rec'] ?>" />

										 			<input type="hidden" name="hora_rec" value="<?php echo $dato['hora_rec'] ?>" />

										 			<input type="hidden" name="ciudad_origen" value="<?php echo $dato['ciudad_origen'] ?>" />

										 			<input type="hidden" name="ciudad_destino" value="<?php echo $dato['ciudad_destino'] ?>" />

										 			<input type="hidden" name="tipo_paquete" value="<?php echo $dato['tipo_paquete'] ?>" />

										 			<input type="hidden" name="direccion_destino" value="<?php echo $dato['direccion_destino'] ?>" />

										 			<input type="hidden" name="nombre_dest" value="<?php echo $dato['nombre_dest'] ?>" />

										 			<input type="hidden" name="tel_dest" value="<?php echo $dato['tel_dest'] ?>" />

										 			<input type="hidden" name="nombre_remit" value="<?php echo $dato['nombre_remit'] ?>" />

										 			<input type="hidden" name="tel_remit" value="<?php echo $dato['tel_remit'] ?>" />

										 			<input type="hidden" name="codigo" value="<?php echo $dato['codigo'] ?>" />

										 			<input type="hidden" name="observaciones" value="<?php echo $dato['observaciones'] ?>" />

										 			<input type="hidden" name="estado_desp" value="<?php echo $dato['estado_desp'] ?>" />

										 			<input type="hidden" name="estado_cancel" value="<?php echo $dato['estado_cancel'] ?>" />

										 			<button id="botones" type="submit" name="chequeoEditar" class="btn btn-primary" value="<?php echo $dato['codigo'] ?>">
										 			<i class="fas fa-edit"></i>
										 			</button>

										 		</form>
								 			</td>
										 	<td><?php if($dato['estado_desp'] == 0){
										 				echo "No";
										 			}else{
										 				echo "Sí";
										 			} ?>
										 	</td>
										 	<td>

										 		<form action="" onsubmit="return confirm('¿Está seguro que desea modificar esta encomienda?');" method="POST">

										 			<input type="hidden" name="clave" value="<?php echo $dato['codigo'] ?>" />

										 			<input type="hidden" name="estado_desp" value="<?php echo $dato['estado_desp'] ?>" />

										 			<button id="botones" type="submit" name="despachar" class="btn btn-primary" value="<?php echo $dato['codigo'] ?>">
										 			<i class="fas fa-exchange-alt"></i>
										 			</button>

										 		</form>		
										 		
								 			</td>
								 			<td><?php if($dato['estado_cancel'] == 0){
										 				echo "No";
										 			}else{
										 				echo "Sí";
										 			} ?>
										 	</td>
										 	<td>
										 		<form action="" onsubmit="return confirm('¿Está seguro que desea cancelar esta encomienda?');" method="POST">

											 		<input type="hidden" name="clave" value="<?php echo $dato['codigo'] ?>" />

											 		<input type="hidden" name="estado_cancel" value="<?php echo $dato['estado_cancel'] ?>" />

											 		<button id="botones" type="submit" name="cancelar" class="btn btn-primary" value="<?php echo $dato['codigo'] ?>">
										 			<i class="fas fa-ban"></i>
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
							<div class="col-4 col-12-medium" id="buscar-paginado">

								<form action="encomiendas_admin_buscar.php" method="POST">
									<p>Ingrese Código Encomienda o Nombre Remitente</p>
									<input type="text" name="codigoNomRem" placeholder ="Código o Nombre" autofocus="true"/>
									<button type="submit" class="button" name="buscarEncAdmin"/>Buscar</button>
								</form>								

							</div>
							<div class="col-4 col-12-medium" id="buscar-paginado">
								<?php print $paginado->getPaginadoEncomiendasAdmin(); ?>
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