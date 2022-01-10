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
								<h1 id="titulo-encomiendas">usuarios registrados - modificación de permisos</h1>
								<table>	
									<thead>
										<tr class="info">
											<th>Cedula</th>
											<th>Nombre</th>
											<th>Apellido</th>
											<th>Contraseña</th>
											<th>Mail</th>
											<th>Tipo de Usuario</th>
											<th>Activo</th>
											<th>Modificar Actividad</th>
											<th>Editar</th>
											<th>Eliminar</th>
										</tr>
									</thead>
									<tbody>
										<?php 
											foreach($personas as $dato) {
										 ?>
										 <tr>
										 	<td><?php echo $dato['cedula'] ?></td>
										 	<td><?php echo $dato['nombre'] ?></td>
										 	<td><?php echo $dato['apellido'] ?></td>
										 	<td><?php echo $dato['clave'] ?></td>
										 	<td><?php echo $dato['mail'] ?></td>
										 	<td><?php echo $dato['tipo_usuario'] ?></td>
										 	<td><?php if($dato['estado'] == 0){
										 				echo "No";
										 			}else{
										 				echo "Sí";
										 			} ?>
										 				
										 	</td>
											<td>
										 		<form action="" onsubmit="return confirm('¿Está seguro que desea modificar los permisos de este usuario?');" method="POST">

										 			<input type="hidden" name="estado" value="<?php echo $dato['estado'] ?>" />
										 			
										 			<input type="hidden" name="cedula" value="<?php echo $dato['cedula'] ?>" />

										 			<button type="submit" name="modificar" class="btn btn-primary">
										 			<i class="fas fa-exchange-alt"></i>
										 			</button>

										 		</form>
										 	</td>
										 	<td>
										 		<form action="editar_usuarios.php" onsubmit="return confirm('¿Está seguro que desea editar este usuario?');" method="POST">

										 			<input type="hidden" name="cedula" value="<?php echo $dato['cedula'] ?>" />

										 			<input type="hidden" name="nombre" value="<?php echo $dato['nombre'] ?>" />

										 			<input type="hidden" name="apellido" value="<?php echo $dato['apellido'] ?>" />

										 			<input type="hidden" name="clave" value="<?php echo $dato['clave'] ?>" />

										 			<input type="hidden" name="mail" value="<?php echo $dato['mail'] ?>" />

										 			<input type="hidden" name="tipo_usuario" value="<?php echo $dato['tipo_usuario'] ?>" />

										 			<input type="hidden" name="estado" value="<?php echo $dato['estado'] ?>" />

										 			<button type="submit" name="editar" class="btn btn-primary">
   													<i class="fas fa-edit"></i>
													</button>

										 		</form>
										 	</td>
										 	<td>
										 		<form action="" onsubmit="return confirm('¿Está seguro que desea eliminar este usuario?');" method="POST">

										 			<input type="hidden" name="estado" value="<?php echo $dato['estado'] ?>" />
										 			
										 			<input type="hidden" name="cedula" value="<?php echo $dato['cedula'] ?>" />

										 			<!-- <button type="submit" name="eliminar" class="button" />Eliminar</button> -->

										 			<button type="submit" name="eliminar" class="btn btn-primary">
   													<i class="fas fa-trash"></i>
													</button>

										 		</form>
										 	</td>									
										 <?php 
										 	}
										 ?>
									</tbody>
								</table>
									</br>
									<form action="alta_usuarios.php">
										<button type="submit" class="button" />Alta Nuevo Usuario</button>
									</form>
							</div>
						</div>
					</div>
				</div>

			<!-- Paginado -->
			
				<div id="main">
					<div class="container">
						<div class="row main-row">
							<div class="col-8 col-12-medium">
								<?php print $paginado->getPaginadoUsuarios(); ?>
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